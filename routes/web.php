<?php
 
use App\Http\Controllers\PersonnageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupeController;
use Illuminate\Support\Facades\Route;
 
// ─── Routes publiques ────────────────────────────────────────────────────────
 
Route::get('/', [PersonnageController::class, 'home_index']);
Route::get('/personnage/{id}', [PersonnageController::class, 'personnage_show'])
    ->name('personnage.show');
 
// ─── Authentification ────────────────────────────────────────────────────────
 
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
 
// ─── Routes réservées à l'admin ──────────────────────────────────────────────
 
Route::middleware(['auth', 'is_admin'])->group(function () {
 
    // Personnages
    Route::get('/personnage', [PersonnageController::class, 'personnage_index']);
    Route::post('/personnage', [PersonnageController::class, 'personnage_new_post']);
    Route::delete('/personnage/{id}', [PersonnageController::class, 'personnage_delete'])
        ->name('personnage.delete');
 
    // Description
    Route::get('/personnage/{id}/ajouter_description', [PersonnageController::class, 'description_show'])
        ->name('description.ajouter_description');
    Route::post('/personnage/{id}/description', [PersonnageController::class, 'description_store'])
        ->name('description.store');
    Route::get('/personnage/{id}/description/modifier', [PersonnageController::class, 'modifier_description'])
        ->name('description.modifier');
    Route::put('/personnage/{id}/description', [PersonnageController::class, 'update_description'])
        ->name('description.update');
 
    // Costumes
    Route::get('/personnage/{id}/costume/ajouter', [PersonnageController::class, 'costume_ajouter'])
        ->name('costume.ajouter');
    Route::post('/personnage/{id}/costume/enregistrer', [PersonnageController::class, 'costume_enregistrer'])
        ->name('costume.enregistrer');
    Route::delete('/personnage/{id}/costume/{costume_id}', [PersonnageController::class, 'costume_supprimer'])
        ->name('costume.supprimer');
 
    // Animations
    Route::get('/personnage/{id}/animation/ajouter', [PersonnageController::class, 'animation_ajouter'])
        ->name('animation.ajouter');
    Route::post('/personnage/{id}/animation/enregistrer', [PersonnageController::class, 'animation_enregistrer'])
        ->name('animation.enregistrer');
    Route::delete('/personnage/{id}/animation/{animation_id}', [PersonnageController::class, 'animation_supprimer'])
        ->name('animation.supprimer');
 
    // Capacités
    Route::get('/personnage/{id}/capacite/ajouter', [PersonnageController::class, 'capacite_ajouter'])
        ->name('capacite.ajouter');
    Route::post('/personnage/{id}/capacite/enregistrer', [PersonnageController::class, 'capacite_enregistrer'])
        ->name('capacite.enregistrer');
    Route::delete('/personnage/{id}/capacite/{capacite_id}', [PersonnageController::class, 'capacite_supprimer'])
        ->name('capacite.supprimer');

    // Groupes (relation N..N avec les personnages)
    Route::get('/groupes', [GroupeController::class, 'index'])->name('groupes.index');
    Route::post('/groupes', [GroupeController::class, 'store'])->name('groupes.store');
    Route::delete('/groupes/{id}', [GroupeController::class, 'destroy'])->name('groupes.destroy');
    Route::put('/personnage/{id}/groupes', [GroupeController::class, 'syncPersonnage'])
        ->name('personnage.groupes.sync');
});