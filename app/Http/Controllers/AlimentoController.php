<?php

namespace App\Http\Controllers;

use App\Models\Alimento;
use Illuminate\Http\Request;

class AlimentoController extends Controller
{
    public function index()
    {
        $alimentos = Alimento::all();
        return view('alimentos.index', compact('alimentos'));
    }

    public function create()
    {
        return view('alimentos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'imagem' => 'nullable|string',
            'quantidade' => 'required|integer|min:1',
            'peso' => 'required|numeric|min:0',
            'validade' => 'required|date',
            'local' => 'required|string|max:255',
            'tipo' => 'required|in:normal,urgente',
        ]);

        Alimento::create($request->all());
        return redirect()->route('alimentos.index')->with('success', 'Alimento criado!');
    }
}
