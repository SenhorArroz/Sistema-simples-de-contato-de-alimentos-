@extends('feed.app')

@section('title', 'Histórico')

@section('content')
<div class="container py-3">

    <h4 class="mb-4 text-center">Histórico de Interesse</h4>

    @if($historico->isEmpty())
        <div class="alert alert-info text-center">
            Você ainda não demonstrou interesse em nenhum alimento.
        </div>
    @else
        {{-- Dados Visuais --}}
        <div class="row text-center mb-4">
            <div class="col-md-6">
                <div class="p-3 border rounded bg-light">
                    <h6 class="text-muted">Alimentos Reaproveitados</h6>
                    <h4>
                        {{ number_format($historico->sum(fn($h) => $h->alimento?->peso ?? 0), 2) }} kg
                    </h4>
                </div>
            </div>
            <div class="col-md-6 mt-3 mt-md-0">
                <div class="p-3 border rounded bg-light">
                    <h6 class="text-muted">Pessoas Beneficiadas</h6>
                    <h4>{{ $historico->count() }}</h4>
                </div>
            </div>
        </div>

        {{-- Linha do Tempo --}}
        @foreach($historico as $registro)
            @php
                $alimento = $registro->alimento;
                $primeiroPost = $alimento?->posts->first();
                $donoPost = $primeiroPost?->user;
            @endphp

            @if($alimento && $donoPost)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $alimento->nome }}</h5>

                        <p class="mb-1"><strong>Quantidade:</strong> {{ $alimento->quantidade }}</p>
                        <p class="mb-1"><strong>Peso:</strong> {{ number_format($alimento->peso, 2) }} kg</p>
                        <p class="mb-1"><strong>Local:</strong> {{ $alimento->local }}</p>
                        <p class="mb-1"><strong>Validade:</strong> {{ \Carbon\Carbon::parse($alimento->validade)->format('d/m/Y') }}</p>
                        <p class="mb-2">
                            <strong>Tipo:</strong>
                            <span class="badge bg-{{ $alimento->tipo === 'urgente' ? 'danger' : 'secondary' }}">
                                {{ ucfirst($alimento->tipo) }}
                            </span>
                        </p>

                        <small class="text-muted">Interesse registrado em {{ $registro->created_at->format('d/m/Y H:i') }}</small>

                        <div class="mt-3">
                            <a href="{{ route('mensagens.chat', $donoPost->id) }}" class="btn btn-primary btn-sm">
                                Chat com {{ $donoPost->name }}
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif

</div>
@endsection
