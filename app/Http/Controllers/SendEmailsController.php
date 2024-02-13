<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\Mail\MailDemo;
class SendEmailsController extends Controller
{
    //
    public function emails_sent_get(Request $request){
        $j = [];
        $query = DB::table('emails_sent')
                    ->select(DB::raw('filename,emails,date'));
        //sort column
        if ( $request->has('order') ) {
          $sort_nam = ['filename','emails','date']; //array de los nombres de cada columna a mostrar en la tabla
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
            $count = $data->emails;
            $count = explode(',',$count);
            $count = count($count);
 
            $j["data"][] = array(
              $data->filename,
              $count,
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
      public function send_emails(Request $request){
        $emails = DB::table('emails')
        ->select('email')
        ->where('isUnsubscribed',0)
        ->get();
        $tittle = 'Mail from a Storii test';
        $body = 'This is for testing email for Storii.';
        if($request->has('tittle')){
          if($request->tittle != "" AND $request->tittle != null){
            $tittle = $request->tittle;
          }
        }
        if($request->has('body')){
          if($request->body != "" AND $request->body != null){
            $body = $request->body;
          }
        }
        try{
          foreach($emails as $email){
            $emailData = [
              'title' => $tittle,
              'body' => $body,
              'to' => $email->email
            ];
            
            Mail::to($email->email)->send(new MailDemo($emailData));
            $j['success'] = true;
            $j['msg'] = "Sending succesfull";
            $j['data'] = $request->emails;
          }
          $data= [
            'emails'=>$emails,
            'filename'=>$request->attatchment,
            'file'=>$request->attatchment,
          ];
          $id=DB::table('emails_sent')->insertGetId($data,'id');
          DB::commit();
        }
        catch(Exception $e){
          $j['success'] = false;
          $j['msg'] = "error".$e;
          $j['data'] = $request->emails;
          DB::rollBack();
        }
        return response()->json($j);
      }
}
