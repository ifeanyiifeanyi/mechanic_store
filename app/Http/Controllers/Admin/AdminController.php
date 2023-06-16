<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function show()
    {
        $user = User::findOrFail(Auth::user()->id);
        
        return view('admin.profile.show', compact('user'));
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        if ($request->hasFile('photo')) {
            $old_image = $user->photo;

            if (!empty($old_image) && file_exists(public_path($old_image))) {
                unlink(public_path($old_image));
            }

            $thumb = $request->file('photo');
            $extension = $thumb->getClientOriginalExtension();
            $thumbfile = time() . "." . $extension;
            $thumb->move('admins/profile/', $thumbfile);
            $user->photo = 'admins/profile/' . $thumbfile;
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
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.profile')->with($notification);

    }

    public function showPassword(){
        return view('admin.profile.update_password');
    }
    public function updatePassword(Request $request){
        $request->validate([
            'current_password' => 'required|string|min:6|max:10',
            'password' => 'required|string|confirmed',
        ]);
        $user = User::find(Auth::user()->id);

        if(Hash::check($request->current_password, $user->password)){
            if(!Hash::check($request->password, $user->password)){
                $user->password = Hash::make($request->password);
                $user->save();
                $notification = [
                    'message' => 'New Password Created!',
                    'alert-type' => 'success'
                ];
                auth()->guard('web')->logout();
                return redirect()->route('admin.login')->with($notification);
            }else{
                $notification = [
                    'message' => 'New password must be different from the current password!',
                    'alert-type' => 'error'
                ];
                return redirect()->back()->with($notification);
            }
        }else{
            $notification = [
                'message' => 'Incorrect Password!',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
        
        


    }

    public function logout(Request $request): RedirectResponse {
        auth()->guard('web')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }


    public function login(){
        return view('admin.auth.login');
    }
}
