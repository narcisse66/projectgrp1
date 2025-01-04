<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainClasseModel;
use App\Models\ClassModel;

class ClassController extends Controller
{
    // Afficher toutes les classes principales avec leurs sous-classes
    public function index()
    {
        // Utilisez 'subClasses' pour charger les sous-classes
        $mainClasses = MainClasseModel::with('subClasses')->orderBy('name')->get();

        return view('class', compact('mainClasses'));
    }

    // Ajouter une nouvelle classe principale
    public function storeMainClass(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:main_classes,name', // Le nom de la classe principale doit être unique
        ], [
            'name.required' => 'Le nom de la classe principale est requis.',
            'name.unique' => 'Le nom de la classe principale doit être unique.',
        ]);

        // Créer une nouvelle classe principale
        MainClasseModel::create([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Classe principale ajoutée avec succès.');
    }

    // Ajouter une sous-classe à une classe principale existante
    public function storeSubClass(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Le nom de la sous-classe
            'main_class_id' => 'required|exists:main_classes,id', // La sous-classe doit être liée à une classe principale existante
        ], [
            'name.required' => 'Le nom de la sous-classe est requis.',
            'main_class_id.required' => 'La classe principale est requise.',
            'main_class_id.exists' => 'La classe principale doit exister.',
        ]);

        // Créer une nouvelle sous-classe et la lier à la classe principale
        ClassModel::create([
            'name' => $request->name,
            'main_class_id' => $request->main_class_id, // Lier à la classe principale via l'ID
        ]);

        return back()->with('success', 'Sous-classe ajoutée avec succès.');
    }


     public function getClasses()
    {
        $classes = MainClasseModel::all(['id', 'name']); // Sélectionner les colonnes id et name

        return response()->json([
            'success' => true,
            'data' => $classes,
        ]);
    }

}
