<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Inscription;
use App\Models\Parents;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    

    public function signin()
    {
        return view('signin');
    }

    public function signup_traitement(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $auth = new User(); // Utilisation du modèle avec la casse correcte

        $auth->name = $request->name;
        $auth->email = $request->email;

        $auth->password = Hash::make($request->password);

        
        $auth->role = 'admin';
        $auth->save();

        return redirect('/')->with('status', 'Administrateur crée avec succès');



    }


    public function dosignin(Request $request)
    {
        // Valider les données du formulaire
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tentative d'authentification
        if (Auth::attempt($credentials, $request->remember)) {
            // Vérifier si l'utilisateur a le rôle admin
            $user = Auth::user(); // Récupérer l'utilisateur connecté

            if ($user->role === 'admin') { // Supposons que le rôle est stocké dans une colonne `role`
                return redirect('/')->with('status', 'Connexion réussie'); // Rediriger l'admin
            }

            // Déconnecter l'utilisateur si ce n'est pas un admin
            Auth::logout();
           
        }

        // Si l'authentification échoue, rediriger avec un message d'erreur
        return redirect()->back()->withInput()->withErrors(['message' => 'Email ou mot de passe incorrect']);
    }



    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/signin');
    }


    public function tables()
    {
        $users = User::where('role', 'admin')->get(); // Filtrer uniquement les admins
        return view('tables', compact('users'));
    }


    public function parents()
    {
        $users = User::where('role', 'parent')
            ->whereNull('confirmation_token')  // Filtrer les utilisateurs dont confirmation_token est null
            ->get();

        return view('parentlist', compact('users'));
    }



    public function delete_admin($id){
        $user = User::find($id);
        $user ->delete();
        return redirect('tables')->with('status', 'L\'administrateur a bien été supprimé avec succès.');
    }

    public function dashboard()
    {
        // Nombre d'inscriptions validées
        $nbreInscriptionsValidees = Inscription::where('status', 'valider')->count();

        // Nombre d'inscriptions en attente
        $nbreInscriptionsEnAttente = Inscription::where('status', 'en attente')->count();

        // Nombre de parents ayant un compte actif
        $nbreParentsActifs = Parents::where('is_active', 1)->count();

        // Passer les données à la vue
        return view('welcome', compact('nbreInscriptionsValidees', 'nbreInscriptionsEnAttente', 'nbreParentsActifs'));
    }


}
