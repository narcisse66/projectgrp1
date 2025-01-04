<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ParentAccountConfirmationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ParentAuthController extends Controller
{
    /**
     * Enregistrer un parent.
     */
    public function register(Request $request)
    {

        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Vérification dans la table users
            'password' => 'required|string|min:8|confirmed',
            'contact' => 'nullable|string|max:15', // Optionnel
            'profession' => 'nullable|string|max:255', // Optionnel
        ]);

        // Générer un token de confirmation
        $confirmationToken = Str::random(60);

        // Créer un utilisateur parent
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'confirmation_token' => $confirmationToken,
            'role' => 'parent',
        ]);

        // Créer un parent lié à cet utilisateur
        $parent = Parents::create([
            'user_id' => $user->id,
            'contact' => $validated['contact'] ?? null,
            'profession' => $validated['profession'] ?? null,
            'is_active' => true, // Par défaut, le compte n'est pas actif
        ]);

        // Envoyer un email de confirmation
        Mail::to($user->email)->send(new ParentAccountConfirmationMail($user));

        // Retourner une réponse JSON
        return response()->json([
            'success' => true,
            'message' => 'Veuillez vérifier votre email pour confirmer votre compte.',
            'token' => $confirmationToken,
        ], 201);
    }

    /**
     * Confirmer un compte parent avec un token.
     */
    public function confirm($token)
    {
        // Recherche de l'utilisateur par token
        $user = User::where('confirmation_token', $token)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Token de confirmation invalide ou expiré.',
            ], 404);
        }

        // Activation du compte
        $user->confirmation_token = null;
        $user->save();

        // Activer le parent associé
        $parent = $user->parent;
        if ($parent) {
            $parent->is_active = true;
            $parent->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Compte parent confirmé avec succès.',
        ], 200);
    }

    /**
     * Connexion d'un parent.
     */
    public function login(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Authentification de l'utilisateur
        if (Auth::attempt($validated)) {
            $user = Auth::user();

            // Vérifier le rôle et l'activation
            if ($user->role !== 'parent' || !$user->parent->is_active) {
                return response()->json([
                    'success' => false,
                    'message' => 'Votre compte parent n\'est pas encore actif.',
                ], 403);
            }

            // Générer un token d'API
            $token = $user->createApiToken(); // Utilisez la méthode définie sur User

            return response()->json([
                'success' => true,
                'message' => 'Connexion réussie',
                'token' => $token,
                'redirectUrl' => '/dashboard', // URL du dashboard parent
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Les informations d’identification ne correspondent pas.',
        ], 401);
    }

}
