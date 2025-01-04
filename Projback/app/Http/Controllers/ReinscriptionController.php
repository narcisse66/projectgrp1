<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscription;
use App\Models\Reinscription;

class ReinscriptionController extends Controller
{
    public function reinscrire(Request $request)
    {
        // Vérifier que le parent est connecté
        $parent = auth()->user();
        if (!$parent) {
            return response()->json([
                'success' => false,
                'message' => 'Vous devez être connecté en tant que parent pour réinscrire vos enfants.'
            ], 401);
        }

        // Récupérer toutes les inscriptions du parent
        $inscriptions = Inscription::where('parent_id', $parent->id)->get();

        if ($inscriptions->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Aucun enfant trouvé pour ce parent.'
            ], 404);
        }

        // Mettre à jour `new_class` avec la valeur de `next_class`
        foreach ($inscriptions as $inscription) {
            $reinscription = Reinscription::where('inscription_id', $inscription->id)->first();
            if ($reinscription) {
                $inscription->new_class = $reinscription->next_class;
                $inscription->save();
            }
        }

        // Retourner un message de succès
        return response()->json([
            'success' => true,
            'message' => 'Réinscription validée pour tous vos enfants.',
        ], 200);
    }
}
