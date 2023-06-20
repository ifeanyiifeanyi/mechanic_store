<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
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
}
