<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProfileController;
//use App\Http\Controllers\TaskController;
use App\Models\Cliente;
use App\Models\Task;


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {

        return view('dashboard', [
            'totalClientes' => Cliente::count(),
            'activos' => Cliente::where('status', 'activo')->count(),
            'leads' => Cliente::where('status', 'lead')->count(),
            'tareasPendientes' => Task::where('completed', false)->count(),
            'ultimosClientes' => Cliente::latest()->take(3)->get()
        ]); // Pasa los datos al dashboard

    })->name('dashboard');
    Route::resource('clientes', ClienteController::class); // Rutas para clientes

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Rutas para perfil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Rutas para perfil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Rutas para perfil

});
require __DIR__.'/auth.php';
