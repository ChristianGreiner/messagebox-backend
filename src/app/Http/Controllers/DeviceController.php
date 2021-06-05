<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class DeviceController extends Controller
{
    public function index(Request $request)
    {
        $device = Device::where('owner_id', auth()->user()->id)->first();

        return view('device.index', [
            'device' => $device
        ]);
    }

    public function show(Request $request, $id)
    {
    }

    public function create(Request $request)
    {
        return view('device.create');
    }

    public function status(Request $request)
    {
        $device = Device::where('owner_id', auth()->user()->id)->first();
        if ($device) {
            return response()->json($device);
        }

        return response()->json();
    }

    public function store(Request $request)
    {
        $messages = [
            'unique' => 'The :attribute is invalid.'
        ];

        $validated = $request->validate([
            'hardware_id' => 'required|unique:devices|min:9|max:9'
        ], $messages);

        
        if ($validated) {
            $id = $request->get('hardware_id');
            $device = Device::create(['hardware_id' => $id, 'owner_id' => auth()->user()->id]);
    
            return redirect()->route('device.index')->with('success', 'The device has been added to your account.');
        }
       
        return redirect()->back()->withErrors()->withInput();
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy(Request $request, $id)
    {
        $device = Device::where('hardware_id', $id)->firstOrFail();
        $device->delete();

        auth()->user()->tokens()->delete();

        return redirect()->route('device.index')->with('success', 'The device has been removed from your account.');
    }
}
