@extends('layouts.app')
@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10"> 

    {{-- Saludo --}}
    <h1 class="font-['Syne'] text-5xl font-extrabold text-gray-800 mb-1"> 
        Hola, <span class="text-cyan-600">{{ Auth::user()->name }}</span> 👋
    </h1>
    <p class="font-[Cursive] text-black-600 text-sm mb-8">¿Qué querés gestionar hoy?</p>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8"> 

        <div class="bg-white p-4 rounded-2xl shadow-sm border"> 
            <p class="text-xs text-gray-400">Clientes</p> 
            <h2 class="text-2xl font-bold text-gray-800">{{ $totalClientes }}</h2> 
        </div>

        <div class="bg-white p-4 rounded-2xl shadow-sm border"> 
            <p class="text-xs text-gray-400">Activos</p> 
            <h2 class="text-2xl font-bold text-green-600">{{ $activos }}</h2> 
        </div>

        <div class="bg-white p-4 rounded-2xl shadow-sm border"> 
            <p class="text-xs text-gray-400">Leads</p> 
            <h2 class="text-2xl font-bold text-yellow-500">{{ $leads }}</h2> 
        </div>
        

        <div class="bg-white p-4 rounded-2xl shadow-sm border">
            <p class="text-xs text-gray-400">Tareas pendientes</p>
            <h2 class="text-2xl font-bold text-red-500">{{ $tareasPendientes }}</h2>
        </div>

    </div>
    @if($tareasPendientes > 0) 
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
            <p class="text-sm text-red-600"> 
                Tenés {{ $tareasPendientes }} tareas pendientes ⚠️
            </p>
        </div>
    @endif
    <div class="mt-8"> 
        <h3 class="text-sm font-semibold text-gray-600 mb-3">Últimos clientes</h3> 

        <div class="bg-white border rounded-2xl shadow-sm divide-y"> 

            @foreach($ultimosClientes as $cliente) 
                <div class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 transition"> 

                    <div>
                        <p class="text-sm font-medium text-gray-800">
                            {{ $cliente->nombre }}
                        </p>
                        <p class="text-xs text-gray-400">
                            {{ $cliente->email }}
                        </p>
                    </div>

                    <span class="text-xs px-2 py-1 rounded 
                        {{ $cliente->status === 'activo' ? 'bg-green-100 text-green-600' : '' }}
                        {{ $cliente->status === 'lead' ? 'bg-yellow-100 text-yellow-600' : '' }}
                        {{ $cliente->status === 'inactivo' ? 'bg-gray-100 text-gray-500' : '' }}
                        ">
                        {{ ucfirst($cliente->status) }} 
                    </span>

                </div>
            @endforeach

        </div>
    </div>
    <br></br>
    {{-- Grid de tarjetas --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4"> 

        {{-- Tarjeta Ver Clientes --}}
        <a href="{{ route('clientes.index') }}
            "class="group bg-white border border-cyan-500/15 rounded-2xl p-5 hover:-translate-y-1 hover:border-cyan-400/40 hover:shadow-[0_12px_32px_rgba(0,188,212,0.12)] transition-all duration-250 relative overflow-hidden"> 
            <div class="w-10 h-10 rounded-xl bg-cyan-500/10 flex items-center justify-center mb-4">
                <svg class="w-5 h-5 text-cyan-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div> 
            <p class="font-semibold text-gray-800 text-sm mb-0.5">Ver Clientes</p>
            <p class="text-[11px] text-gray-400">Gestionar contactos y cuentas</p>
            <span class="absolute bottom-4 right-4 w-6 h-6 border border-cyan-300 rounded-full flex items-center justify-center text-[10px] text-cyan-600 group-hover:bg-cyan-500 group-hover:border-cyan-500 group-hover:text-white transition-all">→</span>
        </a>

        {{-- Tarjeta Mi Perfil --}}
        <a href="{{ route('profile.edit') }}"
           class="group bg-white border border-slate-200 rounded-2xl p-5 hover:-translate-y-1 hover:border-slate-300 hover:shadow-[0_12px_32px_rgba(100,116,139,0.1)] transition-all duration-250 relative overflow-hidden">
            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center mb-4">
                <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                </svg>
            </div>
            <p class="font-semibold text-gray-800 text-sm mb-0.5">Mi Perfil</p>
            <p class="text-[11px] text-gray-400">Ver y editar tu cuenta</p>
            <span class="absolute bottom-4 right-4 w-6 h-6 border border-slate-200 rounded-full flex items-center justify-center text-[10px] text-slate-400 group-hover:bg-slate-500 group-hover:border-slate-500 group-hover:text-white transition-all">→</span>
        </a>

        {{-- Tarjeta Cerrar Sesión --}}
        <div class="group bg-white border border-red-100 rounded-2xl p-5 hover:-translate-y-1 hover:border-red-300/50 hover:shadow-[0_12px_32px_rgba(239,68,68,0.08)] transition-all duration-250 relative overflow-hidden cursor-pointer"
             onclick="document.getElementById('logout-form').submit()">
            <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center mb-4">
                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
            </div>
            <p class="font-semibold text-gray-800 text-sm mb-0.5">Cerrar sesión</p>
            <p class="text-[11px] text-gray-400">Salir del sistema de forma segura</p>
            <span class="absolute bottom-4 right-4 w-6 h-6 border border-red-200 rounded-full flex items-center justify-center text-[10px] text-red-400 group-hover:bg-red-500 group-hover:border-red-500 group-hover:text-white transition-all">→</span>
        </div>

    </div>
</div>

{{-- Form oculto para logout --}}
<form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
    @csrf
</form>

@endsection