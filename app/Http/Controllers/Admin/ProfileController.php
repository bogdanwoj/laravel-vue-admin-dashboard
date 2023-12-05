<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Fortify\UpdateUserPassword;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->only(['name', 'email', 'role', 'avatar']);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($request->user()->id)],

        ]);

        $request->user()->update($validated);

        return response()->json(['success' => true]);

    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $previousPath = $request->user()->getRawOriginal('avatar');

            if ($previousPath && Storage::exists($previousPath)) {
                Storage::delete($previousPath);
            }

            $link = Storage::putFile('/photos', $request->file('profile_picture'));

            $request->user()->update(['avatar' => $link]);

            return response()->json(['avatar' => $link, 'message' => 'Profile picture uploaded successfully!'], 201);
        }

        return response()->json(['message' => 'No profile picture provided.'], 400);
    }

    public function changePassword(Request $request, UpdateUserPassword $updater)
    {
        $updater->update(auth()->user(), [
            'current_password' => $request->currentPassword,
            'password' => $request->password,
            'password_confirmation' => $request->passwordConfirmation,
        ]);
        return response()->json(['message' => 'Password changed successfully!']);
    }
}
