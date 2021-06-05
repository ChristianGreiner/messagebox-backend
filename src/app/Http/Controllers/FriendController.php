<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Message;
use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\FriendRequestSend;
use Illuminate\Support\Facades\Mail;

class FriendController extends Controller
{
    public function index()
    {
        return view('friends.index', [
            'friends' => auth()->user()->friends()->get(),
            'friendRequests' => auth()->user()->friendRequests()->get()
        ]);
    }

    public function show($id)
    {
    }

    public function create()
    {
        return view('friends.create', []);
    }

    public function accept(Request $request, $id)
    {
        if($request->has('accept')) {
            // add new friend
            Friend::where(['user_id' => auth()->user()->id, 'friend_id' => $id])->update(['accepted' => true]);
            // create a friend for the requestor
            Friend::create(['user_id' => $id, 'friend_id' => auth()->user()->id, 'accepted' => true]);
        
        } else if($request->has('decline')) {
            Friend::where(['user_id' => $this->id])->delete();
        }

        return redirect()->route('friends.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:App\Models\User,email'
        ]);

        if($validated) {
            $recipient = $request->get('email');
           
            $user = User::where([['email', "=", $recipient], ['email', "!=", auth()->user()->email]])->first();        
            
            if($user) {
                Friend::create(['user_id' => $user->id, 'friend_id' => auth()->user()->id]);
                
                return redirect()->route('friends.index')->with('success', 'Your friend request was sent successfully.');
            }
                
            return redirect()->back()->withErrors(["You can't add yourself as a friend."])->withInput();
        }

        return redirect()->back()->withErrors([])->withInput();
        
}

    public function update(Request $request, $id)
    {
    }

    public function destroy(Request $request, $id)
    {
        // optimize
        Friend::where([['friend_id', '=', $id], ['user_id', '=', auth()->user()->id]])->delete();
        Friend::where([['friend_id', '=', auth()->user()->id], ['user_id', '=', $id]])->delete();

        return redirect()->route('friends.index');
    }
}
