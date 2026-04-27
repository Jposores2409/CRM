@extends('layouts.app')
@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 pt-16">
{{-- Encabezado --}}
<div class="flex items-center justify-between mb-8">
    <div>
        <a href="{{ route('dashboard') }}"
           class="inline-flex items-center gap-1.5 text-xs text-cyan-600 hover:text-cyan-700 border border-cyan-500/20 hover:border-cyan-400 bg-white px-3 py-1.5 rounded-full transition-all mb-4">
            ← Volver al dashboard
        </a>

        <h1 class="font-['Syne'] text-3xl font-extrabold text-gray-900">
            Lista de <span class="text-cyan-600">Clientes</span>
        </h1>

        <p class="text-gray-400 text-sm mt-1">
            {{ $clientes->total() }} cliente(s) registrado(s)
        </p>
    </div>

    <a href="{{ route('clientes.create') }}"
       class="inline-flex items-center gap-2 bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-all hover:-translate-y-0.5 hover:shadow">
        + Nuevo cliente
    </a>
</div>

<livewire:clientes-manager />

@endsection
