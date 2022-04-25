<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email;

class EmailController extends Controller
{
    public function index() {
        return view('menadzer.messages');
    }

    public function sendMessage(Request $request) {
        $email = $request->email;
        $subject = $request->subject;
        $text = $request->text;

        $emailCheck = filter_var($email, FILTER_VALIDATE_EMAIL);

        if(empty($email) || empty($subject) || empty($text)) {
            return response()->json(['error'=>'Morate popuniti sva polja!']);
        }

        else if($emailCheck === false){
            return response()->json(['error'=>'Email nije validan!']);
        }

        else {
            Email::sendMessage($email, $subject, $text);

            return response()->json(['success'=>'Email je poslat, odgovor ćete dobiti u najskorijem roku!']);
        }

        
    }

    public function getMessages() {
        $messages = Email::getMessages();

        return response()->json([
            'messages' => $messages
            
        ]);
    }

    public function message($id) {
        
        return view('menadzer.reply',[
            'id' => $id
        ]); 
    
    }

    public function getMessage($id) {
        
        $msg= Email::getMsg($id);
        

        return response()->json([
            'msg' => $msg
            
        ]);
    
    }
}
