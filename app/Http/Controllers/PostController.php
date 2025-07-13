<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Alimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('alimento')->get();
        return view('feed.feed', compact('posts'));
    }
public function create()
{
    return view('posts.create');
}

public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descricao' => 'nullable|string',

        'nome' => 'required|string|max:255',
        'quantidade' => 'required|integer|min:1',
        'peso' => 'required|numeric|min:0.01',
        'validade' => 'required|date',
        'local' => 'required|string|max:255',
        'tipo' => 'required|in:normal,urgente',
    ]);

    // Cria alimento
    $alimento = \App\Models\Alimento::create([
        'nome' => $request->nome,
        'quantidade' => $request->quantidade,
        'peso' => $request->peso,
        'validade' => $request->validade,
        'local' => $request->local,
        'tipo' => $request->tipo,
    ]);

    // Cria post
    \App\Models\Post::create([
        'titulo' => $request->titulo,
        'descricao' => $request->descricao,
        'id_produto' => $alimento->id,
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('feed')->with('success', 'Doação publicada com sucesso!');
    }
    public function destroy($id)
    {
    $post = \App\Models\Post::findOrFail($id);

    // Verifica se o post pertence ao usuário autenticado
    if ($post->user_id !== auth()->id()) {
        return redirect()->route('perfil')->with('error', 'Você não tem permissão para excluir este post.');
    }

    // Remove o alimento relacionado
    $post->alimento()->delete();

    // Remove o post
    $post->delete();

    return redirect()->route('perfil')->with('success', 'Publicação excluída com sucesso.');
    }

}
