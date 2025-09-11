<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $request->validate([
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $user->fill($request->validated());

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            if ($request->hasFile('photo')) {
                if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                    Storage::disk('public')->delete($user->photo);
                }
                $path = $request->file('photo')->store('photos', 'public');
                $user->photo = $path;
            }

            $user->save();
            DB::commit();

            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal memperbarui profil: ' . $e->getMessage());

            return Redirect::route('profile.edit')
                ->with('error', 'Terjadi kesalahan saat memperbarui profil. Silakan coba lagi.');
        }
    }

    public function deletePhoto(Request $request): RedirectResponse
    {
        $user = $request->user();

        try {
            DB::beginTransaction();

            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
                $user->photo = null;
                $user->save();
            }

            DB::commit();
            return Redirect::route('profile.edit')->with('status', 'photo-deleted');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menghapus foto: ' . $e->getMessage());

            return Redirect::route('profile.edit')
                ->with('error', 'Terjadi kesalahan saat menghapus foto. Silakan coba lagi.');
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        try {
            $user = $request->user();

            Auth::logout();

            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus akun: ' . $e->getMessage());

            return Redirect::route('profile.edit')
                ->with('error', 'Terjadi kesalahan saat menghapus akun. Silakan coba lagi.');
        }
    }
}
