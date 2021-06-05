<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        return redirect()->route('settings.profile');
    }

    public function profile()
    {
        return view('settings.profile', []);
    }

    public function storeProfile(Request $request)
    {
        return redirect()->route('settings');
    }

    public function device()
    {
        return view('settings.device', []);
    }

    public function storeDevice(Request $request)
    {
        $validated = $request->validate([
            'rotation_count' => 'min:1|max:3|numeric|required',
            'fetch_interval' => 'min:30|max:3600|numeric|required',
            'rotation_interval' => 'min:30|max:120|numeric|required',
        ]);

        $data = $request->only([
            'rotation_count',
            'fetch_interval',
            'rotation_interval',
            'no_disturbance_enabled',
            'no_disturbance_from',
            'no_disturbance_to'
        ]);

        auth()->user()->update($data);
        auth()->user()->save();

        /*if($data->has('no_disturbance_enabled'))
        {

            $fromValues = $request->get('no_disturbance_from');
            $toValues = $request->get('no_disturbance_to');

            $fromTimeStamp = strtotime($fromValues);
            $toTimeStamp = strtotime($toValues);
        }*/
        
        return redirect()->route('settings.device')->with('success', 'Your settings have been saved.');
    }

    public function store(Request $request)
    {
    }

    public function update($id)
    {
    }

    public function destory($id)
    {
    }

    public function mute(Request $request) {
        $validated = $request->validate([
            'mute' => 'boolean',
        ]);
        $mute = $request->input('mute');

        if (!(is_null($mute))) {
            auth()->user()->mute = $mute;
            auth()->user()->save();
        }

        return response()->json("OK", 200);
    } 
}
