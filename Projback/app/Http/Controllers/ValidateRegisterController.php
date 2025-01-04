<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use Illuminate\Http\Request;
use App\Models\Reinscription;
use App\Models\SchoolYear;

class ValidateRegisterController extends Controller
{
    //
    public function adminIndex()
    {
        $inscriptions = Inscription::where('status', 'en attente')->get();
        return view('waiting', compact('inscriptions'));
    }

  

    public function validateRegistration($id)
    {
        $registration = Inscription::findOrFail($id);
        $registration->update(['status' => 'valider']);  // Cela génère et sauvegarde le matricule
        $registration->save();
        
           


        return back()->with('success', 'Inscription validée avec succès.');

        // Si le statut est validé, créez la reinscription
      
    }


    public function rejectRegistration($id)
    {
        $registration = Inscription::findOrFail($id);

        // Supprimer toutes les reinscriptions associées avant de supprimer l'inscription
        Reinscription::where('inscription_id', $id)->delete();

        $registration->delete();

        return back()->with('error', 'Inscription rejetée et supprimée.');
    }


    public function studentIndex()
    {
        // Récupérer l'année scolaire active (en supposant qu'il y a un champ 'is_active' dans la table 'school_years')
        $activeYear = SchoolYear::where('is_active', true)->first(); // Trouve l'année active

        // Vérifier si l'année active existe
        if ($activeYear) {
            // Récupérer les inscriptions avec le statut 'valider' et l'année scolaire active
            $inscriptions = Inscription::where('status', 'valider')
                ->where('school_year_id', $activeYear->id)
                ->get();
        } else {
            // Si l'année active n'est pas définie, retourner un tableau vide ou un message d'erreur
            $inscriptions = collect(); // ou afficher un message d'erreur
        }

        // Retourner la vue avec les inscriptions filtrées
        return view('student', compact('inscriptions'));
    }


}
