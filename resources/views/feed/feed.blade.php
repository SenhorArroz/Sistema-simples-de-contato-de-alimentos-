@extends('feed.app')

@section('title', 'Feed')

@section('content')

{{--
  PASSO 1: Adicionar a meta tag CSRF.
  O ideal é que esta linha esteja no <head> do seu layout principal (feed/app.blade.php),
  mas adicioná-la aqui também funcionará para o script abaixo.
--}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="d-flex align-items-center gap-3 px-3 py-3 border-bottom bg-white sticky-top" style="z-index: 1020;">
    <img src="https://i.ibb.co/SDRT7LGB/OOD.png" alt="FoodRescue Logo" style="height: 60px; width: auto;">
    <h4 class="mb-0 fw-bold text-primary">FoodRescue</h4>
</div>

<div class="row g-3 px-3 pb-4">
    @foreach($posts as $post)
        @if($post->alimento)
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body p-3 d-flex flex-column justify-content-between">

                        <div>
                            <h6 class="fw-bold">{{ $post->titulo }}</h6>
                            @if($post->descricao)
                                <p class="text-muted small mb-2">{{ $post->descricao }}</p>
                            @endif

                            <hr class="my-2">

                            <p class="mb-1"><strong>Nome:</strong> {{ $post->alimento->nome }}</p>
                            <p class="mb-1"><strong>Quantidade:</strong> {{ $post->alimento->quantidade }}</p>
                            <p class="mb-1"><strong>Peso:</strong> {{ number_format($post->alimento->peso, 2) }} kg</p>
                            <p class="mb-1"><strong>Localização:</strong> {{ $post->alimento->local }}</p>
                            <p class="mb-1"><strong>Validade:</strong> {{ \Carbon\Carbon::parse($post->alimento->validade)->format('d/m/Y') }}</p>
                            <p class="mb-2">
                                <strong>Tipo:</strong>
                                <span class="badge bg-{{ $post->alimento->tipo === 'urgente' ? 'danger' : 'secondary' }}">
                                    {{ ucfirst($post->alimento->tipo) }}
                                </span>
                            </p>
                        </div>

                        {{-- Mostra o botão apenas se o usuário logado não for o dono do post --}}
                        @if ($post->user_id != auth()->id())
                            <div class="d-grid mt-auto">
                                <button class="btn btn-sm btn-primary" onclick="interesse('{{ $post->alimento->id }}')">Tenho Interesse</button>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>

<script>
    function interesse(produtoId) {
        // Pega o token CSRF dinamicamente da meta tag que adicionamos
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch("https://d2c16c942951.ngrok-free.app/historico", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken, // <-- O token dinâmico é usado aqui
                'Accept': 'application/json'
            },
            body: JSON.stringify({ produto_id: produtoId })
        })
        .then(response => {
            if (!response.ok) {
                 // Lança o erro para ser pego pelo .catch() e processado como JSON
                throw response;
            }
            return response.json();
        })
        .then(data => {
            alert(data.message || 'Interesse registrado com sucesso!');
        })
        .catch(async errorResponse => {
            let errorMessage = 'Ocorreu um erro ao registrar seu interesse.';

            // Tenta extrair a mensagem de erro do JSON da resposta
            try {
                const err = await errorResponse.json();
                if (err.message) {
                    errorMessage = err.message;
                }
            } catch (e) {
                console.error("Não foi possível processar a resposta de erro como JSON.", e);
            }

            alert(errorMessage);
        });
    }

    function applyFilters() {
        console.log('Filtros aplicados');
        // implementar filtro real aqui se desejar
    }
</script>

@endsection
