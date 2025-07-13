<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mensagem;
use Illuminate\Support\Facades\Auth;

class MensagemController extends Controller
{
    public function chat(User $outroUsuario)
    {
        $authId = Auth::id();
        $outroId = $outroUsuario->id;

        $mensagens = Mensagem::with('usuario')
            ->where(function ($query) use ($authId, $outroId) {
                $query->where('id_usuario', $authId)->where('id_destinatario', $outroId);
            })
            ->orWhere(function ($query) use ($authId, $outroId) {
                $query->where('id_usuario', $outroId)->where('id_destinatario', $authId);
            })
            ->orderBy('created_at')
            ->get();

        return view('mensagens.chat', compact('mensagens', 'outroUsuario'));
    }

    public function enviar(Request $request, User $outroUsuario)
    {
        $request->validate([
            'mensagem' => 'required|string|max:1000',
        ]);

        Mensagem::create([
            'id_usuario' => Auth::id(),
            'id_destinatario' => $outroUsuario->id,
            'mensagem' => $request->mensagem,
        ]);

        return redirect()->route('mensagens.chat', $outroUsuario->id);
    }
}
