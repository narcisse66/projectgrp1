<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use App\Models\Reinscription;
use App\Models\SchoolYear;
use App\Models\ClassModel;
use App\Models\MainClasseModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InscriptionController extends Controller
{
    /**
     * Soumettre une inscription.
     */
    public function store(Request $request)
    {
        // Parent actuellement connecté de la table 'parents'
        $parent = Auth::user();

        if (!$parent) {
            return response()->json([
                'success' => false,
                'message' => 'Vous devez être connecté en tant que parent pour soumettre une inscription.'
            ], 401);
        }

        $request->validate([
            "student_first_name" => "required|string|max:255",
            "student_last_name" => "required|string|max:255",
            "student_sex" => "required|in:M,F",
            "student_birth_date" => "required|date",
            "new_class" => "required|string|max:50",
            "birth_certificate_path" => "nullable|file|mimes:pdf,jpg,png|max:2048",
            "school_report_path" => "nullable|file|mimes:pdf,jpg,png|max:2048",
            "student_picture" => "nullable|file|mimes:jpg,png|max:2048"
        ]);

        // Récupérer l'année scolaire active
        $activeSchoolYear = SchoolYear::where('is_active', 1)->first();

        if (!$activeSchoolYear) {
            return response()->json([
                'success' => false,
                'message' => 'Aucune année scolaire active trouvée.'
            ], 404);
        }

        $inscription = new Inscription();
        $inscription->student_first_name = $request->student_first_name;
        $inscription->student_last_name = $request->student_last_name;
        $inscription->student_sex = $request->student_sex;
        $inscription->student_birth_date = $request->student_birth_date;
        $inscription->new_class = $request->new_class;
        $inscription->parent_id = $parent->id;
        $inscription->school_year_id = $activeSchoolYear->id;

        if ($request->hasFile('birth_certificate_path')) {
            $inscription->birth_certificate_path = $request->file('birth_certificate_path')->store('birth_certificates', 'public');
        }

        if ($request->hasFile('school_report_path')) {
            $inscription->school_report_path = $request->file('school_report_path')->store('school_reports', 'public');
        }

        if ($request->hasFile('student_picture')) {
            $inscription->student_picture = $request->file('student_picture')->store('student_pictures', 'public');
        }

        $inscription->save();

        // Création de la reinscription automatique
        $nextClass = $this->getNextClass($request->new_class);
        Reinscription::create([
            'inscription_id' => $inscription->id,
            'next_class' => $nextClass,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Inscription soumise avec succès.'
        ]);
    }

    /**
     * Afficher toutes les inscriptions pour le parent connecté.
     */
   public function list()
{
    // Parent actuellement connecté
    $parent = Auth::user(); // En supposant que Auth::user() vous donne l'utilisateur connecté (parent)

    if (!$parent) {
        return response()->json([
            'success' => false,
            'message' => 'Vous devez être connecté en tant que parent pour voir les inscriptions.'
        ], 401);
    }

    // Récupérer toutes les inscriptions liées au parent avec les informations de l'année scolaire
    $inscriptions = Inscription::with('schoolYear') // Charger la relation avec l'année scolaire
        ->where('parent_id', $parent->id)
        ->select('student_first_name', 'student_last_name', 'student_sex', 'student_birth_date', 'new_class', 'student_picture', 'school_year_id') // Inclure l'id de l'année scolaire
        ->get();

    if ($inscriptions->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'Vous n\'avez pas d\'enfants inscrits.'
        ], 404);
    }

    // Retourner les inscriptions avec l'année scolaire associée sous forme de nom
    $data = $inscriptions->map(function ($inscription) {
        return [
            'student_first_name' => $inscription->student_first_name,
            'student_last_name' => $inscription->student_last_name,
            'student_sex' => $inscription->student_sex,
            'student_birth_date' => $inscription->student_birth_date,
            'new_class' => $inscription->new_class,
            'student_picture' => $inscription->student_picture,
            'school_year' => $inscription->schoolYear->year, // Accéder à l'année scolaire
        ];
    });

    return response()->json([
        'success' => true,
        'data' => $data,
    ], 200);
}

    /**
     * Obtenir la prochaine classe en fonction de la classe actuelle.
     */
    private function getNextClass($currentClass)
    {
        // Exemple de logique simple pour déterminer la classe suivante
        $classes = [
            '6ème' => '5ème',
            '5ème' => '4ème',
            '4ème' => '3ème',
            '3ème' => '2nde',
            '2nde' => '1ère',
            '1ère' => 'Terminale',
            'Terminale' => 'Terminale',
            // Dernière classe, reste la même
        ];

        return isset($classes[$currentClass]) ? $classes[$currentClass] : null;
    }


    public function Indexstudent()
    {
        // Récupère uniquement les inscriptions validées
        $inscriptions = Inscription::where('status', 'valider')->get();

        // Récupère toutes les années scolaires
        $schoolYears = SchoolYear::all();

        // Récupère toutes les classes depuis la table main_classes
        $mainClasses = MainClasseModel::all(); // On récupère les classes depuis main_classes

        // Retourne la vue avec les données nécessaires
        return view('studentall', [
            'inscriptions' => $inscriptions,
            'schoolYears' => $schoolYears,
            'mainClasses' => $mainClasses, // Passer mainClasses à la vue
        ]);
    }

    public function search(Request $request)
    {
        $schoolYearId = $request->input('school_year');
        $className = $request->input('class'); // Nom de la classe choisi dans le formulaire

        // Récupère les inscriptions validées avec un filtre sur l'année scolaire et le nom de la classe
        $inscriptions = Inscription::where('status', 'valider') // Filtre par statut 'validé'
            ->when($schoolYearId, function ($query) use ($schoolYearId) {
                return $query->where('school_year_id', $schoolYearId); // Filtre par l'année scolaire
            })
            ->when($className, function ($query) use ($className) {
                return $query->where('new_class', $className); // Filtre par le nom de la classe (new_class dans inscription)
            })
            ->get(); // Récupère les inscriptions filtrées

        // Récupère toutes les années scolaires et les classes principales (nom de classe dans main_classes)
        $schoolYears = SchoolYear::all();
        $mainClasses = MainClasseModel::all(); // Récupère toutes les classes principales

        // Retourne la vue avec les inscriptions filtrées et les filtres de recherche
        return view('studentall', [
            'inscriptions' => $inscriptions,
            'schoolYears' => $schoolYears,
            'mainClasses' => $mainClasses, // Passe les classes principales à la vue
        ]);
    }










}
