<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile()
    {
        $id = auth()->id();
        $user = User::findOrFail($id);
        return view('profile.profile',compact('user'));
    }
    public function update(Request $request)
    {
        $id = auth()->id();
        $user = User::findOrFail($id);
        $validated = $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id . ',id'
            ]
        );


        if ($request->password) {
            if (Hash::check($request->password, $user->password)) {
                $password = $request->validate(
                    [
                        'new_password' => 'required'
                    ]
                );
                $validated['password'] = bcrypt($password['new_password']);
            } else {
                return redirect()->back()->withInput()->withErrors(['password' => 'Your password is incorrect.']);
            }
        }


        if ($request->has('image')) {
            $request->validate(
                [
                    'image' => 'mimes:png,jpg,jpeg',
                ]
            );


            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put('profiles/' . $imageName, file_get_contents($image));
            $validated['image'] = 'profiles/' . $imageName;

            // delete old file
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
        }

        // dd($validated);
        $user->update($validated);

        return to_route('profile.index')->with('success', 'Successfully Updated');
    }
}
