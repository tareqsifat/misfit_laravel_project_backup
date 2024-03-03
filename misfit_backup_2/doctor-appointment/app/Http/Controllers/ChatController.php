<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{



    public function index()
    {
        $chat = Chat::firstOrCreate([
            'sent_user_id' => Auth::id(),
            'get_user_id' => 1
        ]);

        // Only load chats where the user is the admin
        $chat = Chat::where('sent_user_id', Auth::user()->id)->with('messages', 'user')->first();

        //   return   $chat;

        return view('patient.chat', compact('chat'));
    }


    public function store(Request $request)
    {


        // return $request->all();


        $chat = Chat::where('sent_user_id', Auth::user()->id)->first();

        if ($chat) {
            $message = new Message([
                'content' => $request->input('message'),
                'sent_user_id' => Auth::id(),
                'get_user_id' => 1,
                'chat_id' =>  $chat->id,
            ]);

            $chat->messages()->save($message);

            return redirect()->back();
        } else {


            $chat = Chat::firstOrCreate([
                'sent_user_id' => Auth::id(),
                'get_user_id' => 1
            ]);


            $message = new Message([
                'content' => $request->input('message'),
                'sent_user_id' => Auth::id(),
                'get_user_id' => 1,
                'chat_id' =>  $chat->id,
            ]);

            $chat->messages()->save($message);

            return redirect()->back();
        }
    }


    // for doctor


    public function getPatientChat()
    {



        $chats = Chat::with('user')->where('get_user_id',Auth::user()->id)->latest('id')->get();
        
        // return $chats;

        if($chats->count() > 0 ){
            return view('admin.pages.chat.index', compact('chats'));
        }

        return redirect()->back();


    }
    public function chat_with_patient($id)
    {




        $patient_id = $id;

        $chat = Chat::firstOrCreate([
            'sent_user_id' => 1,
            'get_user_id' => $patient_id
        ]);

        // Only load chats where the user is the admin
        $chat = Chat::where('sent_user_id', $id)->where('get_user_id', 1)->with('messages', 'user')->first();

        //   return   $chat;

        return view('admin.pages.chat.chat_with_patient', compact('chat', 'patient_id'));
    }

    public function patientChatStore(Request $request)
    {


        // return $request->all();


        $chat = Chat::where('sent_user_id', $request->patient_id)->where('get_user_id', 1)->first();

        if ($chat) {
            $message = new Message([
                'content' => $request->input('message'),
                'sent_user_id' => 1,
                'get_user_id' => $request->patient_id,
                'chat_id' =>  $chat->id,
            ]);

            $chat->messages()->save($message);

            return redirect()->back();
        }
    }












    // without reload data

    public function withoutReloadChatWithDoctor()
    {


        // Only load chats where the user is the admin
        $chat = Chat::where('sent_user_id', Auth::user()->id)->with('messages', 'user')->first();

        //   return   $chat;
        return response()->json($chat);
    }



    public function withoutReloadChatWithPatient($id)
    {

        $patient_id = $id;
        $chat = Chat::firstOrCreate([
            'sent_user_id' => 1,
            'get_user_id' => $patient_id
        ]);

        // Only load chats where the user is the admin
        $chat = Chat::where('sent_user_id', $id)->where('get_user_id', 1)->with('messages', 'user')->first();

        return response()->json($chat);
    }
}
