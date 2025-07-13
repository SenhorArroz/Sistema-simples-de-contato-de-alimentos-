<?php

namespace App\Http\Controllers;

use App\Models\Historico;
use App\Models\Alimento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoricoController extends Controller
{
    public function index()
{
    $user = auth()->user();

    // Carrega os historicos com produto + post relacionado (eager loading)
    $historico = Historico::with('alimento.posts.user')
    ->where('user_id', auth()->id())
    ->get();

    return view('history.index', compact('historico'));
}
    public function mostrarInteressados($produto_id)
    {
        // Busca os históricos daquele produto
        $historicos = Historico::where('produto_id', $produto_id)->get();

        // Pega os usuários interessados
        $usuarios = User::whereIn('id', $historicos->pluck('user_id'))->get();

        $alimento = Alimento::findOrFail($produto_id);

        return view('mensagens.interessados', compact('usuarios', 'alimento'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:alimentos,id',
        ]);

        $user = Auth::user();

        // Verifica se já existe para evitar duplicatas
        $exists = Historico::where('produto_id', $request->produto_id)
                           ->where('user_id', $user->id)
                           ->exists();

        if ($exists) {
            return response()->json(['message' => 'Você já demonstrou interesse neste produto.'], 409);
        }

        Historico::create([
            'produto_id' => $request->produto_id,
            'user_id' => $user->id,
        ]);

        return response()->json(['message' => 'Interesse registrado com sucesso!']);
    }
}
