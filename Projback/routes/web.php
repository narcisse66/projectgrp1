<?php

use App\Http\Controllers\InscriptionController;
use App\Models\Inscription;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolYearController;

use App\Http\Controllers\ClassController;
use App\Http\Controllers\ValidateRegisterController;
use App\Http\Controllers\MessageController;


Route::middleware(['admin.auth'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard']);
  

   
    // Ajoute ici toutes les routes nécessitant une authentification
    

    Route::get('/school-years', [SchoolYearController::class, 'index'])->name('index');
    Route::post('/school-years', [SchoolYearController::class, 'store'])->name('school-years.store');
    Route::post('/school-years/activate/{id}', [SchoolYearController::class, 'activate'])->name('school-years.activate');




    Route::get('/profil', function () {
        return view('profil');
    });

    Route::get('/student', function () {
        return view('student');
    });

   

    Route::get('/signup', function () {
        return view('signup');
    });


    Route::get('/classes', [ClassController::class, 'index'])->name('classes.index');
    Route::post('/classes', [ClassController::class, 'store'])->name('classes.store');
    Route::post('/storeMainClass', [ClassController::class, 'storeMainClass'])->name('classes.storeMainClass');



    // Pour stocker la classe principale
    Route::post('classes/store-main', [ClassController::class, 'storeMainClass'])->name('classes.storeMain');

    // Pour stocker la sous-classe
    Route::post('classes/store-sub', [ClassController::class, 'storeSubClass'])->name('classes.storeSub');


    Route::get('/validate', [ValidateRegisterController::class, 'adminIndex'])->name('validate');
    Route::post('/validate/{id}/validate', [ValidateRegisterController::class, 'validateRegistration'])->name('validate.validate');
    Route::delete('/validate/{id}/reject', [ValidateRegisterController::class, 'rejectRegistration'])->name('validate.reject');
    Route::get('/studentvalidate', [ValidateRegisterController::class, 'studentIndex'])->name('valid');
});



   

    //Route::get('/tables', function () {
       // return view('tables');
    //});







Route::get('/signin', [AdminController::class, 'signin'])->name('signin');
Route::post('/signin', [AdminController::class, 'dosignin']);
Route::post('/signup/traitement', [AdminController::class, 'signup_traitement']);
                 
Route::post('/logout', [AdminController::class, 'destroy'])->name('logout');
Route::get('/tables', [AdminController::class, 'tables'])->name('tables');
Route::get('/parentlist', [AdminController::class, 'parents'])->name('parents');

Route::get('/tables/{id}', [AdminController::class, 'delete_admin'])->name(name: 'tables.delete_admin');
Route::get('/message', [MessageController::class, 'create'])->name('message.create');
Route::post('/message/send', [MessageController::class, 'send'])->name('message.send');

Route::get('/profil', [ProfileController::class, 'viewprofil'])->name('profil');
Route::put('/profil.edit', [ProfileController::class, 'editprofil'])->name('profil.edit');
Route::get('/studentall', [InscriptionController::class, 'Indexstudent']);                                         
Route::get('/search-students', [InscriptionController::class, 'search'])->name('search_students');
                                     
                                                                                                                 
                                                                                                                 
                                                                                                                 
                                                                                                                                           
                                                                                                                 
                                                                                                                 
                                                                                                               
                                                                                           
                     
               
                               
                                               
                                                                                                                   
                                                                                                                                                                                                                                                                                                                                                                                                             
                                                                           
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
                                                                                                                                                                                                                                                                                                                                                                                                                                                             
                                                   
                                                                                                                                   
                                                                                                                                                           
                                                                       
                                                                                                         
                                                                       
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                               
                                                                      
                                               
                                                                      
                                               
                                                                      
                                               
                                                                                                                                                                                                                                                      
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
                                                                                                                                                                                                                                                                       
                                                                                                                                                                       
                                                                                                                                                                                                                                                                                                                                                                                                                  
                                                                                                                                                                                                                                                                       
                                                                                                                                                                       
                                                                                                                                                                                                                                                                                                                                                                                                                  
                                                                                                                                                                                                                                                                       
                                                                                                                                                                       
                                                                                                                                                                                                                                                                                                                                                                                                                  
                                                                                                                                                                                                                                                                       
                                                                                                                                                                       
                                                                                                                                                                                                                                                                                                                                                                                                                  
                                                                                                                                                                                                                                                                       
                                                                                                                                                                       
                                                                                                                                                                                                                                                                                                                                                                                                                  
                                                                                                                                                                                                                                                                                                                                                                                                       
                                               
                                                                      
                                               
                                                                      
                                               
                                                                      
                                               
                                                                                                                                                                                                                                                      
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
                                                               
                                                                                                                                                                                                                                                                                                                                                                                                                                     
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
                                                               
                                                                                                                                                                                                                 
                                                                                                                                                                                                                                                                       
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
                                                               
                                                                                                                                                                                                                 
                                                                                                                                                                                                                                                                       
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
                                                               
                                                                                                                                                                                                                 
                                                                                                                                                                                                                                                                       
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
                                                               
                                                                                                                                                                                                                 
                                                                                                                                                                                                                                                                       
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
                                                               
                                                                                                                                                                                                                 
                                                                                                                                                                                                                                                                                                     
                                                                                                 
                                                                                                                                         
                                                                                         
                                                                                         
                                                                                         
                                                                                                                                                                                                                                                                                                                       
                                       
                                       
                                       
                                       
                                       
                                                                                                           
                                 
                                                                                       
                                                                                             
                                                     
                           
                   
                                     
                       
                                           
                                                       
                                                                                                                             