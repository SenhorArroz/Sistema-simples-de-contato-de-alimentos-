<?php

namespace App\Http\Controllers;

use App\Models\Doacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoacaoController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $doacoesRealizadas = Doacao::where('user_doador_id', $userId)->get();
        $doacoesRecebidas = Doacao::where('user_receptor_id', $userId)->get();

        return view('doacoes.index', compact('doacoesRealizadas', 'doacoesRecebidas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_receptor_id' => 'required|exists:users,id',
            'alimento_id' => 'required|exists:alimentos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        Doacao::create([
            'user_doador_id' => Auth::id(),
            'user_receptor_id' => $request->user_receptor_id,
            'alimento_id' => $request->alimento_id,
            'quantidade' => $request->quantidade,
        ]);

        return redirect()->back()->with('success', 'Doação registrada!');
    }
}
