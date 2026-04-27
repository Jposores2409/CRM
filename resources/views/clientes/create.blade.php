@extends('layouts.app')
@section('content')

<div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-10 pt-16">

    {{-- Encabezado --}}
    <div class="mb-8">
        <a href="{{ route('clientes.index') }}"
           class="inline-flex items-center gap-1.5 text-xs text-cyan-600 hover:text-cyan-700 border border-cyan-500/20 hover:border-cyan-400 bg-white px-3 py-1.5 rounded-full transition-all mb-5">
            ← Volver a clientes
        </a>
        <h1 class="font-['Syne'] text-3xl font-extrabold text-gray-900">
            Nuevo <span class="text-cyan-600">Cliente</span>
        </h1>
        <p class="text-gray-400 text-sm mt-1">Completá los datos para registrar un cliente</p>
    </div>

    {{-- Errores de validación --}}
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-xl px-4 py-3 mb-6">
            <p class="text-red-600 text-xs font-semibold uppercase tracking-wider mb-2">
                Corregí los siguientes errores
            </p>
            <ul class="space-y-1">
                @foreach ($errors->all() as $error)
                    <li class="text-red-500 text-sm flex items-center gap-2">
                        <span class="w-1 h-1 rounded-full bg-red-400 inline-block"></span>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario --}}
    <div class="bg-white border border-cyan-500/10 rounded-2xl p-6 shadow-sm">
        <form method="POST" action="{{ url('clientes') }}">
            @csrf

            {{-- Nombre --}}
            <div class="mb-5">
                <label class="block text-[11px] tracking-widest uppercase text-gray-400 mb-1.5">
                    Nombre
                </label>
                <input type="text" name="nombre"
                    placeholder="Ej: Juan García"
                    value="{{ old('nombre') }}"
                    class="w-full bg-gray-50 border rounded-lg px-4 py-2.5 text-sm text-gray-800 outline-none transition-all placeholder-gray-300
                        focus:bg-white focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/10
                        @error('nombre') border-red-400 bg-red-50 @else border-gray-200 @enderror">
                @error('nombre')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-5">
                <label class="block text-[11px] tracking-widest uppercase text-gray-400 mb-1.5">
                    Email
                </label>
                <input type="email" name="email"
                    placeholder="Ej: juan@empresa.com"
                    value="{{ old('email') }}"
                    class="w-full bg-gray-50 border rounded-lg px-4 py-2.5 text-sm text-gray-800 outline-none transition-all placeholder-gray-300
                        focus:bg-white focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/10
                        @error('email') border-red-400 bg-red-50 @else border-gray-200 @enderror">
                @error('email')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Teléfono --}}
            <div class="mb-7">
                <label class="block text-[11px] tracking-widest uppercase text-gray-400 mb-1.5">
                    Teléfono
                </label>
                <input type="text" name="telefono"
                    placeholder="Ej: +54 381 000 0000"
                    value="{{ old('telefono') }}"
                    class="w-full bg-gray-50 border rounded-lg px-4 py-2.5 text-sm text-gray-800 outline-none transition-all placeholder-gray-300
                        focus:bg-white focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/10
                        @error('telefono') border-red-400 bg-red-50 @else border-gray-200 @enderror">
                @error('telefono')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Estados</label>
                <select name="status" class="w-full border rounded px-3 py-2" value="lead"{{ old('status') }}>
                    <option value="lead">Lead</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                    <option value="cliente">Cliente</option>
                    <option value="contactado">Contactado</option>
                </select>
            </div>

            {{-- Botones --}}
            <div class="flex items-center gap-3">
                <button type="submit"
                    class="flex-1 bg-cyan-500 hover:bg-cyan-600 text-white font-semibold text-sm py-2.5 rounded-lg transition-all hover:-translate-y-0.5 hover:shadow-[0_8px_20px_rgba(0,188,212,0.25)]">
                    Guardar cliente
                </button>
                <a href="{{ route('clientes.index') }}"
                    class="flex-1 text-center bg-white border border-gray-200 hover:border-gray-300 text-gray-500 hover:text-gray-700 font-medium text-sm py-2.5 rounded-lg transition-all">
                    Cancelar
                </a>
            </div>

        </form>
    </div>

</div>

@endsection