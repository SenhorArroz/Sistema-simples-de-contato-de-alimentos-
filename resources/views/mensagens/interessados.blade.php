@extends('feed.app')

@section('title', 'Interessados')

@section('content')
<div class="container mt-4">
    <h4>Interessados na publicação: {{ $alimento->nome }}</h4>

    @if($usuarios->isEmpty())
        <div class="alert alert-info mt-3">Nenhum interessado até o momento.</div>
    @else
        <ul class="list-group mt-3">
            @foreach($usuarios as $usuario)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $usuario->name }}
                    <a href="{{ route('mensagens.chat', $usuario->id) }}" class="btn btn-sm btn-outline-primary">
                        Abrir Chat
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
