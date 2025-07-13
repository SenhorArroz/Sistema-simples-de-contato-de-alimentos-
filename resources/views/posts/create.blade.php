@extends('feed.app')

@section('title', 'Nova Doação')

@section('content')
<div class="container py-4">
    <h4 class="mb-4 text-center">Publicar Doação</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('posts.store') }}">
        @csrf

        <!-- Seção Publicação -->
        <div class="mb-4">
            <h5>Informações da Publicação</h5>

            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required value="{{ old('titulo') }}">
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição (opcional)</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3">{{ old('descricao') }}</textarea>
            </div>
        </div>

        <!-- Seção Alimento -->
        <div class="mb-4">
            <h5>Informações do Alimento</h5>

            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Alimento</label>
                <input type="text" class="form-control" id="nome" name="nome" required value="{{ old('nome') }}">
            </div>

            <div class="mb-3">
                <label for="quantidade" class="form-label">Quantidade</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" required min="1" value="{{ old('quantidade') }}">
            </div>
<div class="mb-3">
    <label for="peso" class="form-label">Peso (em kg)</label>
    <input type="number" step="0.01" class="form-control" id="peso" name="peso" required min="0.01" value="{{ old('peso') }}">
</div>
            <div class="mb-3">
                <label for="validade" class="form-label">Validade</label>
                <input type="date" class="form-control" id="validade" name="validade" required value="{{ old('validade') }}">
            </div>

            <div class="mb-3">
                <label for="local" class="form-label">Bairro / Cidade</label>
                <input type="text" class="form-control" id="local" name="local" required value="{{ old('local') }}">
            </div>

            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select class="form-select" id="tipo" name="tipo" required>
                    <option value="">Selecione</option>
                    <option value="normal" {{ old('tipo') === 'normal' ? 'selected' : '' }}>Normal</option>
                    <option value="urgente" {{ old('tipo') === 'urgente' ? 'selected' : '' }}>Urgente</option>
                </select>
            </div>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-success">Publicar Doação</button>
        </div>
    </form>
</div>
@endsection
