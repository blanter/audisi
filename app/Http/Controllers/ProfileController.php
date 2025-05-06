<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // ADMIN MODE
    public function adminindex(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && $request->search !== null) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                ->orWhere('email', 'like', "%{$searchTerm}%");
            });
        }

        $users = $query->get();
        return view('profile.adminuser', compact('users'));
    }

    // ADMIN MODE
    public function admineditRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,user,juri' // sesuaikan dengan role yg valid
        ]);

        $user->role = $request->role;
        $user->save();

        return response()->json(['message' => 'Role updated successfully.']);
    }

    // ADMIN MODE
    public function admindestroy(User $user)
    {
        $user->delete();
        return back()->with('status', 'User deleted.');
    }
}
