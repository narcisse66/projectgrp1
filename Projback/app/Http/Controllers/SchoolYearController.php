<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolYear;

class SchoolYearController extends Controller
{

    public function index()
    {
        $schoolYears = SchoolYear::all();
        
        
        return view('year', compact('schoolYears'));
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|unique:school_years',
        ], [
            'year.required' => 'Le champ année scolaire est obligatoire.',
            'year.unique' => 'Cette année scolaire existe déjà.',

        ]);

        SchoolYear::create(['year' => $request->year]);
        return back()->with('success', 'Année scolaire ajoutée avec succès.');
    }


    public function activate($id)
    {
        SchoolYear::query()->update(['is_active' => false]);
        $schoolYear = SchoolYear::find($id);
        $schoolYear->is_active = true;
        $schoolYear->save();

        return back()->with('success', 'Année scolaire activée avec succès.');
    }
}
