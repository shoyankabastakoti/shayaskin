<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AdminSettingsController extends Controller
{
    public function password(): View
    {
        return view('admin.settings.password');
    }

    public function createAdmin(): View
    {
        return view('admin.settings.admins.create');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(12)],
        ]);

        $admin = $request->user();
        $admin->password = $validated['password'];
        $admin->save();

        $request->session()->regenerate();

        return redirect()->route('admin.settings.password.edit')->with('status', 'Your password was changed successfully.');
    }

    public function storeAdmin(Request $request): RedirectResponse
    {
        $request->merge([
            'email' => mb_strtolower($request->string('email')->trim()->toString()),
        ]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(12)],
        ]);

        $admin = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);
        $admin->forceFill(['is_admin' => true])->save();

        return redirect()->route('admin.settings.admins.create')->with('status', 'Admin account created successfully.');
    }
}
