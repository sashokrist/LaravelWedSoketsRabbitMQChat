<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageSentMail;

Route::middleware(['web', 'auth'])->group(function () {
    Broadcast::routes();
});



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->post('/send-message', [ChatController::class, 'send']);

Route::get('/whoami', fn () => auth()->user());

Route::get('/db-test', function () {
    try {
        DB::connection()->getPdo();
        return "✅ DB connected!";
    } catch (\Exception $e) {
        return "❌ DB connection error: " . $e->getMessage();
    }
});

Route::get('/test-mail', function () {
    Mail::to('inbox@mailtrap.io')->send(new MessageSentMail("This is a test"));
    return 'Sent';
});
