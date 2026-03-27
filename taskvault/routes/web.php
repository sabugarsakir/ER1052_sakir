<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\TaskAccessMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    
    $stats = [
        'total' => $user->tasks()->count(),
        'pending' => $user->tasks()->where('status', 'pending')->count(),
        'in_progress' => $user->tasks()->where('status', 'in_progress')->count(),
        'completed' => $user->tasks()->where('status', 'completed')->count(),
    ];
    
    $recentTasks = $user->tasks()->latest()->take(5)->get();
    
    return view('dashboard', compact('stats', 'recentTasks'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Applying TaskAccessMiddleware to tasks resources for demonstration
    Route::resource('tasks', TaskController::class)->middleware([TaskAccessMiddleware::class, 'throttle:20,1']);
});

// Demonstrating signed URLs for sharing tasks publicly
Route::get('/tasks/{task}/share', [TaskController::class, 'share'])
    ->name('tasks.share')
    ->middleware('signed');

require __DIR__.'/auth.php';
