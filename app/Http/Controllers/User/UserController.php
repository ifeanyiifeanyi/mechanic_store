<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\UserLocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Stevebauman\Location\Facades\Location;

class UserController extends Controller
{
    public function dashboard(Request $request)
    {
        $data = Location::get();
        $user_id = Auth::user()->id;
        $ip = $data->ip;
    
        $locationData = [
            'ip' => $ip,
            'user_id' => $user_id,
            'country_name' => $data->countryName,
            'country_code' => $data->countryCode,
            'region_code' => $data->regionCode,
            'region_name' => $data->regionName,
            'city_name' => $data->cityName,
            'zip_code' => $data->zipCode,
            'latitude' => $data->latitude,
            'logitude' => $data->longitude,
            'area_code' => $data->areaCode,
            'timezone' => $data->timezone,
        ];
    
        $userLocation = UserLocation::updateOrCreate(['ip' => $ip], $locationData);
    
        $user = Auth::user();
        $deviceInformation = $user->getDeviceInformation($request);
    
        return view('user.dashboard', compact('userLocation', 'user', 'deviceInformation'));
    }
    
    public function show()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('user.profile.show', compact('user'));
    }
    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $old_image = $user->photo;

            if (!empty($old_image) && file_exists(public_path($old_image))) {
                unlink(public_path($old_image));
            }

            $thumb = $request->file('photo');
            $extension = $thumb->getClientOriginalExtension();
            $thumbfile = time() . "." . $extension;
            $thumb->move('users/profile/', $thumbfile);
            $user->photo = 'users/profile/' . $thumbfile;
        } elseif (empty($user->photo)) {
            return back()->withErrors(['photo' => 'The image field oh is required.']);
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        $notification = [
            'message' => 'Profile Details Updated!',
            'alert-type' => 'success',
        ];
        return redirect()->route('user.profile')->with($notification);
    }
    public function logout(Request $request): RedirectResponse
    {
        auth()->guard('web')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
