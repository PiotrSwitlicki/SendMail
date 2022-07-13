<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Response;
use Mail;
use App\Mail\TestEmail;


class TodoController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        return view('home', compact('messages'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'title' => 'required',
            'message' => 'required',
            ]);
        $data[0]=$request->message;
        $email=$request->email;
        $title=$request->title;
        $mailTitle=$request->title;

        $message = new Message();
        $message->email = $request->email;
        $message->title = $request->title;
        $message->message = $request->message;
        $message->save();
        $messages = Message::all();


        
        $mailData = [
                        "message" => $request->message,                     
                    ];

        Mail::to($request->email)->send(new TestEmail($mailData, $mailTitle));

        return redirect()->route('main')->with('success', 'Wysłano pomyślnie');;


    }

    public function destroy(Message $message)
    {
        //dd($message);
        $message->delete();
        return redirect()->route('main')->with('success', 'Usunięto pomyślnie');
    }
}