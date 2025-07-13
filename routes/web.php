<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AlimentoController;
use App\Http\Controllers\DoacaoController;
use App\Http\Controllers\MensagemController;
use App\Http\Controllers\HistoricoController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

use Illuminate\Support\Facades\Artisan;

Route::get('/clear-config', function () {
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return 'git Configuração recarregada!';
});


// Login
Route::get('/login', [LoginController::class, 'create'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Registro (usando store do mesmo controller)
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [LoginController::class, 'store'])->name('register');

// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect("/");
})->name('logout');

// Perfil


// Página inicial (Feed)
Route::get('/feed', [PostController::class, 'index'])->name('feed');

// Listar alimentos (opcional)
Route::get('/alimentos', [AlimentoController::class, 'index'])->name('alimentos.index');
Route::get('/alimentos/create', [AlimentoController::class, 'create'])->name('alimentos.create');
Route::post('/alimentos', [AlimentoController::class, 'store'])->name('alimentos.store');

// Doações
Route::get('/doacoes', [DoacaoController::class, 'index'])->name('doacoes.index');
Route::post('/doacoes', [DoacaoController::class, 'store'])->name('doacoes.store');

// Mensagens
Route::get('/mensagens', [MensagemController::class, 'index'])->name('mensagens.index');
Route::post('/mensagens', [MensagemController::class, 'store'])->name('mensagens.store');

// Perfil e histórico (rotas simbólicas)
Route::middleware('auth')->group(function () {
    Route::get('/perfil', [LoginController::class, 'index'])->name('perfil');
    Route::get('/history', [HistoricoController::class, "index"])->name('history');
    Route::post('/historico', [HistoricoController::class, 'store'])->name('historico.store');
    Route::get('/interessados/{produto_id}', [HistoricoController::class, 'mostrarInteressados'])->name('mensagens.usuarios');


    Route::get('chat/{outroUsuario}', [MensagemController::class, 'chat'])->name('mensagens.chat');
    Route::post('chat/{outroUsuario}', [MensagemController::class, 'enviar'])->name('mensagens.enviar');


    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});



