<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class EmailsController extends Controller
{
    public function emails_get(Request $request){
        $j = [];
        $query = DB::table('emails')
                    ->select(DB::raw('email,isUnsubscribed,date'));
        //sort column
        if ( $request->has('order') ) {
          $sort_nam = ['email','isUnsubscribed','date']; //array de los nombres de cada columna a mostrar en la tabla
          $sort_col = $request['order'][0]['column'];
          $sort_dir = $request['order'][0]['dir'];
          $query = $query->orderBy($sort_nam[$sort_col], $sort_dir);
        }
        //end sort
    
        $array_data = $query->get();
        // dd($array_data);
    
        $iTotalRecords = $array_data->count();
        $iDisplayLength = intval($request['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($request['start']);
        $sEcho = intval($request['draw']);
        $j["data"] = array();
        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;
            $ite = 0;
    
        foreach($array_data as $data) {

          $reg=json_encode($data);
          if($ite >= $iDisplayStart && $ite < $end) {
 
            $j["data"][] = array(
              $data->email,
              $data->isUnsubscribed,
              $data->date
            );
    
          }
          $ite++;
        }
        $j["draw"] = $sEcho;
        $j["recordsTotal"] = $iTotalRecords;
        $j["recordsFiltered"] = $iTotalRecords;
        return response()->json($j);
    }
    public function create_emails(Request $request){
        // dd($request->all());
        try{
            $emails = explode(',',$request->emails);
            foreach($emails as $email){
                $data= [
                    'email'=>$email
                  ];
                  $id=DB::table('emails')->insertGetId($data,'id');
            }
            DB::commit();
            $j['success'] = true;
            $j['msg'] = "Added succesfully";
            $j['data'] = $request->emails;
            return response()->json($j);
        }
        catch(Exception $e) {
            DB::rollBack();
            return $e;
        }
    }
    public function unsubscribe(Request $request){
        // dd($request->all());
        try{
            $data_email = [
                "isUnsubscribed" => 1,
            ];
            $query = DB::table('emails')->where('email', $request->email)->update($data_email);
            DB::commit();
            return "OK";
        }
        catch(Exception $e) {
            DB::rollBack();
            return $e;
        }
    }
}
