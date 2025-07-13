@extends('feed.app')

@section('title', 'Chat')

@section('content')
<div class="container py-4">
    <h5 class="mb-4">Chat com {{ $outroUsuario->name }}</h5>

    <div class="border rounded p-3 mb-4" style="max-height: 400px; overflow-y: auto; background: #f8f9fa;">
        @forelse ($mensagens as $msg)
            <div class="mb-2 text-{{ $msg->id_usuario == auth()->id() ? 'end' : 'start' }}">
                <div class="d-inline-block px-3 py-2 rounded
                    {{ $msg->id_usuario == auth()->id() ? 'bg-primary text-white' : 'bg-light' }}">
                    {{ $msg->mensagem }}
                </div>
                <div class="small text-muted">
                    <strong>
                        {{ $msg->id_usuario == auth()->id() ? 'Você' : ($msg->usuario->name ?? 'Usuário desconhecido') }}
                    </strong>
                    • {{ $msg->created_at->format('d/m H:i') }}
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Nenhuma mensagem ainda.</p>
        @endforelse
    </div>

    <form method="POST" action="{{ route('mensagens.enviar', $outroUsuario->id) }}">
        @csrf
        <div class="input-group">
            <input type="text" name="mensagem" class="form-control" placeholder="Digite sua mensagem..." required>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
        @error('mensagem')
            <small class="text-danger d-block mt-1">{{ $message }}</small>
        @enderror
    </form>
</div>
@endsection
