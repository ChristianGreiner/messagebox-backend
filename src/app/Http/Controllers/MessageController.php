<?php

namespace App\Http\Controllers;

use App\Helpers\Color;
use App\Models\Device;
use App\Models\User;
use App\Models\Message;
use App\Models\Settings;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $messages = [];
        $type = $request->get('type', 'received');

        $messagesQuery = auth()->user();

        if ($type == 'received') {
            $messages = $messagesQuery->messages()->orderBy('created_at', 'DESC')->paginate(15);
        } else {
            $messages = $messagesQuery->sentMessages()->orderBy('created_at', 'DESC')->where('author_id', auth()->user()->id)->paginate(15);
        }

        return view('messages.index', [
            'messages' => $messages,
            'type' => $type
        ]);
    }

    public function create()
    {
        $friends = auth()->user()->friends()->get();

        if(count($friends) == 0) {
            return redirect()->route('messages');
        }

        return view('messages.create', [
            'friends' => $friends 
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'addressee' => 'required|exists:App\Models\User,email',
            'text' => 'required|min:1|max:140',
        ]);
        
        if($validated) {
            
            $addresseeMail = $request->get('addressee');
            $text = $request->get('text');
            $textColor = $request->get('text-color', 'white');
            $backgroundColor = $request->get('bg-color', 'black');

            $addressee = User::where('email', $addresseeMail)->first();
            $textColorHex = Color::$colors[$textColor]['hex'];
            $backgroundColorHex = Color::$colors[$backgroundColor]['hex'];

            Message::create([
                'addressee_id' => $addressee->id,
                'author_id' => auth()->user()->id,
                'text' => $text,
                'text_color' => $textColorHex,
                'background_color' => $backgroundColorHex
            ]);

            return redirect()->route('messages')->with('success', 'Your message has been successfully sent.');
        }
       
        return redirect()->route('messages.create')->withErrors([])->withInput();
    }

    public function update($id)
    {
    }

    public function destory($id)
    {
    }
}
