<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {
        $posts = Post::with('alimento')
                    ->where('user_id', auth()->id())
                    ->latest()
                    ->get();

        return view('Login.index', compact('posts'));
    }


    public function create()
    {
        $types = ['Pessoa Física/Mercado', 'Organização'];
        return view('Login.login', compact('types'));
    }
    public function showRegisterForm()
    {
        $types = ['Pessoa Física/Mercado', 'Organização'];
        return view('Login.register', compact('types'));
    }

public function login(Request $request)
{
    $messages = [
        'email.required' => 'O campo e-mail é obrigatório.',
        'email.email' => 'Digite um e-mail válido.',
        'password.required' => 'O campo senha é obrigatório.',
    ];

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ], $messages);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/feed');
    }

    return back()->withErrors([
        'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
    ])->onlyInput('email');
}
    public function store(Request $request)
{
    $messages = [
        'name.required' => 'O campo nome é obrigatório.',
        'name.string' => 'O nome deve ser um texto válido.',
        'name.max' => 'O nome pode ter no máximo 255 caracteres.',

        'type.required' => 'O campo tipo de conta é obrigatório.',
        'type.in' => 'O tipo de conta selecionado é inválido.',

        'email.required' => 'O campo e-mail é obrigatório.',
        'email.email' => 'Digite um e-mail válido.',
        'email.unique' => 'Este e-mail já está em uso.',

        'password.required' => 'O campo senha é obrigatório.',
        'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
        'password.confirmed' => 'A confirmação da senha não corresponde.',
    ];

    $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|in:Pessoa Física/Mercado,Organização',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ], $messages);

    $user = User::create([
        'name' => $request->name,
        'type' => $request->type,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

    return redirect()->route('feed');
}
    public function edit(User $user)
    {
        $types = ['Pessoa Física/Mercado', 'Organização'];
        return view('users.edit', compact('user', 'types'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Pessoa Física/Mercado,Organização',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'type' => $request->type,
            'email' => $request->email,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário atualizado!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuário excluído!');
    }
}
