<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    // Elenco di tutti gli utenti
    public function index(): View
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Visualizzazione singolo utente
    public function show(User $user): View
    {
        return view('users.show', compact('user'));
    }

    // Form modifica utente
    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    // Salvataggio modifiche utente
    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // Password opzionale, aggiornata solo se presente
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->only(['name', 'email']);
        
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Utente aggiornato con successo.');
    }

    // Cancellazione utente
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utente eliminato con successo.');
    }
}
