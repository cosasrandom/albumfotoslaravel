<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash; // Asegúrate de que esta línea esté aquí

class ProfileController extends Controller
{

    public function edit(Request $request): View
    {
        return view('usuario.actualizar', [
            'user' => $request->user(),
        ]);
    }
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill(array_filter($request->validated()));
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->filled('password')) { 
            $user->password = Hash::make($request->input('password'));
        }
        try {
            $user->save();
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['error' => 'No se pudo actualizar el perfil: ' . $e->getMessage()]);
        }
        return Redirect::route('dashboard')->with('correcto', 'Su perfil ha sido actualizado');
    }
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
}