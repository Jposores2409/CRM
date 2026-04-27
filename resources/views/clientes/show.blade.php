@extends('layouts.app')
@section('content')

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10 pt-16">


{{-- Navegación --}}
<div class="flex items-center justify-between mb-6">

    <div class="flex items-center gap-2">
        <a href="{{ route('clientes.index') }}"
           class="inline-flex items-center gap-1.5 text-xs text-cyan-600 hover:text-cyan-700 border border-cyan-500/20 hover:border-cyan-400 bg-white px-3 py-1.5 rounded-full transition-all">
            ← Clientes
        </a>

       

        
    </div>

    <a href="{{ route('dashboard') }}"
       class="text-xs text-gray-400 hover:text-gray-600">
        Dashboard
    </a>

</div>

{{-- Cliente --}}
<div class="bg-white border border-cyan-500/10 rounded-2xl p-6 shadow-sm mb-8">
    <div class="flex items-center gap-4">

        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-500 flex items-center justify-center text-white font-bold">
            {{ strtoupper(substr($cliente->nombre, 0, 2)) }}
        </div>

        <div>
            <h1 class="text-xl font-bold text-gray-900">
                {{ $cliente->nombre }}
            </h1>
            <p class="text-sm text-gray-400">{{ $cliente->email }}</p>
            <p class="text-sm text-gray-400">{{ $cliente->telefono }}</p>
        </div>

        <div class="ml-auto">
            <a href="{{ route('clientes.edit', $cliente->id) }}"
               class="text-xs text-cyan-600 hover:underline">
                Editar
            </a>
        </div>

    </div>
</div>

{{-- Tareas --}}
<div class="mb-8">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-bold text-gray-900">Tareas</h2>
        <span class="text-xs text-gray-400">
            {{ $cliente->tasks->count() }}
        </span>
    </div>

    @if($cliente->tasks->isEmpty())
        <div class="bg-white border rounded-xl p-6 text-center text-sm text-gray-400">
            Sin tareas
        </div>
    @else
        <div class="space-y-2">
            @foreach($cliente->tasks as $task)
                <div class="bg-white border rounded-xl px-4 py-3 flex justify-between items-center">

                    <div>
                        <p class="text-sm font-medium {{ $task->completed ? 'line-through text-gray-400' : 'text-gray-800' }}">
                            {{ $task->title }}
                        </p>

                        @if($task->due_date)
                            <p class="text-xs text-gray-400 mt-1">
                                {{ $task->due_date }}
                            </p>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                        @csrf
                        @method('PATCH')

                        <button class="text-xs text-cyan-600 hover:underline">
                            {{ $task->completed ? 'Undo' : 'OK' }}
                        </button>
                    </form>

                </div>
            @endforeach
        </div>
    @endif

</div>

{{-- FORMULARIO --}}
<div class="bg-white border border-cyan-500/10 rounded-2xl p-6 shadow-sm">

    <h3 class="text-lg font-bold text-gray-900 mb-5">
        Nueva tarea
    </h3>

    <form wire:submit.prevent="createTask" class="space-y-4">
        @csrf

        <input type="text" name="title" required placeholder="Título"
            class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-cyan-400">

        <textarea name="description" rows="3" placeholder="Descripción"
            class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-cyan-400"></textarea>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <input type="date" name="due_date"
                class="border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-cyan-400">

            <select name="priority"
                class="border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-cyan-400">
                <option value="low">Baja</option>
                <option value="medium">Media</option>
                <option value="high">Alta</option>
            </select>
        </div>

        <button type="submit"
            class="w-full bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-semibold py-2.5 rounded-lg transition">
            Guardar tarea
        </button>

    </form>

    {{-- Botón volver abajo --}}
    <div class="mt-4 text-center">
        <a href="{{ route('clientes.index') }}"
           class="text-xs text-gray-400 hover:text-gray-600">
            ← Volver a clientes
        </a>
    </div>

</div>


</div>

@endsection
