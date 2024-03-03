<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Doctor;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index($doctor_id)
    {
        $doctor = User::whereIn('role', [0, 2])->where('activated',1)->get();
        $chat = Chat::firstOrCreate([
            'sent_user_id' => Auth::id(),
            'get_user_id' => $doctor_id ?? 1
        ]);
        $chat = Chat::where(['sent_user_id' => Auth::user()->id,
                            'get_user_id' => $doctor_id
                            ])->with('messages', 'user')
                            ->first();

        return view('patient.chat', compact(['chat','doctor']));
    }


    public function store(Request $request)
    {
        $chat = Chat::where(['sent_user_id' => Auth::user()->id,'get_user_id' => $request->get_user_id])->first();

        if (!$chat) {
            $chat = Chat::firstOrCreate([
                'sent_user_id' => Auth::id(),
                'get_user_id' => $request->get_user_id
            ]);
        }
        $message = new Message([
            'content' => $request->input('message'),
            'sent_user_id' => Auth::id(),
            'get_user_id' => $request->get_user_id,
            'chat_id' =>  $chat->id,
        ]);
        $chat->messages()->save($message);
        return redirect()->back();
    }


    // for doctor
    public function getPatientChat()
    {
        $chats = Chat::with('user')->where('get_user_id',Auth::user()->id)->orderByDesc('created_at')->get();
        return view('admin.pages.chat.index', compact('chats'));
    }
    public function chat_with_patient($id)
    {
        $chat = Chat::firstOrCreate([
            'sent_user_id' => Auth::user()->id,
            'get_user_id' => $id
        ]);

        // Only load chats where the user is the admin
        $chat = Chat::where('sent_user_id', $id)->where('get_user_id', Auth::user()->id)->with('messages', 'user')->first();

        return view('admin.pages.chat.chat_with_patient', compact('chat', 'id'));
    }

    public function patientChatStore(Request $request)
    {
        $chat = Chat::where('sent_user_id', $request->patient_id)->where('get_user_id', Auth::id())->first();

        if ($chat) {
            $message = new Message([
                'content' => $request->input('message'),
                'sent_user_id' => Auth::id(),
                'get_user_id' => $request->patient_id,
                'chat_id' =>  $chat->id,
            ]);

            $chat->messages()->save($message);

            return redirect()->back();
        }
    }

    public function withoutReloadChatWithDoctor($doctor_id)
    {
        $chat = Chat::where(['sent_user_id' => Auth::id(),
                             'get_user_id' => $doctor_id])->with('messages', 'user')->first();

        return response()->json($chat);
    }



    public function withoutReloadChatWithPatient($id)
    {
//        $chat = Chat::firstOrCreate([
//            'sent_user_id' => 1,
//            'get_user_id' => $id
//        ]);

        $chat = Chat::where('sent_user_id', $id)->where('get_user_id', Auth::id())->with('messages', 'user')->first();

        return response()->json($chat);
    }

}
