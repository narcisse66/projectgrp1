<?php
// app/Http/Controllers/ProfileController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function viewprofil()
    {
        $user = auth()->user();
        return view('profil', compact('user'));
    }

    public function editprofil(Request $request)
    { $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
    ]);

     

    auth()->user()->update($request->only('name', 'email'));

    return redirect()->route('profil')->with('success', 'Votre profil a été mis à jour.');
}
    }
