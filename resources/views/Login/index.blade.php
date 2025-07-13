@extends('feed.app')

@section('title', 'Perfil do Usuário')

@section('content')
<div class="container mt-4">
    <!-- Cabeçalho do Perfil -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Perfil do Usuário</h4>
        </div>
        <div class="card-body">
            <p><strong>Nome:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Tipo de conta:</strong> {{ auth()->user()->type }}</p>
            <p><strong>Doações Cadastradas:</strong> {{ $posts->count() }}</p>

            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-danger">Sair</button>
            </form>
        </div>
    </div>

    <!-- Publicações -->
    <h5 class="mb-3">Suas Publicações</h5>

    @if ($posts->isEmpty())
        <div class="alert alert-info text-center">
            Ainda não há publicações.
        </div>
    @else
        <div class="row g-3">
            @foreach ($posts as $post)
                @if($post->alimento)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-between">

                                <!-- Link para interessados -->
                                <a href="{{ route('mensagens.usuarios', $post->alimento->id) }}"
                                   class="btn btn-sm btn-outline-secondary mb-2">
                                    Ver Interessados
                                </a>

                                <!-- Info da publicação -->
                                <h6 class="fw-bold">{{ $post->titulo }}</h6>
                                @if($post->descricao)
                                    <p class="text-muted small">{{ $post->descricao }}</p>
                                @endif

                                <hr class="my-2">

                                <!-- Info do alimento -->
                                <p><strong>Nome:</strong> {{ $post->alimento->nome }}</p>
                                <p><strong>Quantidade:</strong> {{ $post->alimento->quantidade }}</p>
                                <p><strong>Peso:</strong> {{ number_format($post->alimento->peso, 2) }} kg</p>
                                <p><strong>Local:</strong> {{ $post->alimento->local }}</p>
                                <p><strong>Validade:</strong> {{ \Carbon\Carbon::parse($post->alimento->validade)->format('d/m/Y') }}</p>
                                <p>
                                    <strong>Tipo:</strong>
                                    <span class="badge bg-{{ $post->alimento->tipo === 'urgente' ? 'danger' : 'secondary' }}">
                                        {{ ucfirst($post->alimento->tipo) }}
                                    </span>
                                </p>

                                <!-- Botão de excluir -->
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="mt-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-100"
                                            onclick="return confirm('Deseja realmente excluir esta publicação?')">
                                        Excluir Publicação
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>
@endsection
