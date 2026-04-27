<div> 

    {{--  BUSCADOR + FILTRO --}}
    <div class="flex flex-col sm:flex-row gap-3 mb-5"> 

        <input 
            type="text"
            wire:model.live="search" 
            placeholder="Buscar cliente..."
            class="w-full sm:w-1/2 border border-gray-200 rounded-lg px-4 py-2 text-sm"
        > 

        <select 
            wire:model.live="status"
            class="w-full sm:w-1/4 border border-gray-200 rounded-lg px-4 py-2 text-sm"> 

            <option value="">Todos</option>
            <option value="lead">Lead</option>
            <option value="contactado">Contactado</option>
            <option value="cliente">Cliente</option>
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>

        </select>

    </div>

    {{-- TABLA --}}
    <div class="bg-white border rounded-2xl overflow-hidden"> 

        @foreach($clientes as $cliente) 
          

            @php
                $pendientes = $cliente->tasks->where('completed', false)->count(); 
            @endphp
            
            <div class="border-b"> 

                {{-- FILA PRINCIPAL --}}
                <div 
                    class="grid grid-cols-12 items-center px-5 py-4 hover:bg-gray-50 cursor-pointer"
                    wire:click="toggleCliente({{ $cliente->id }})" 
                >

                    {{-- Nombre --}}
                    <div class="col-span-4">
                        <p class="font-medium text-gray-800">{{ $cliente->nombre }}</p>
                        <p class="text-xs text-gray-400">{{ $cliente->email }}</p>
                    </div>

                    {{-- Estado --}}
                    <div class="col-span-2 text-right text-xs">
                        <span class="px-2 py-1 rounded bg-gray-200">
                            {{ ucfirst($cliente->status) }}
                        </span>
                    </div>

                    {{-- Tareas pendientes --}}
                    <div class="col-span-2 text-right">
                        <span class="text-xs font-semibold px-2 py-1 rounded 
                            {{ $pendientes > 0 ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                            {{ $pendientes }} pendientes
                        </span>
                    </div>

                    {{-- ACCIONES --}}
                    <div 
                        class="col-span-4 flex justify-end gap-2"
                        wire:click.stop
                    >

                        <a 
                            wire:navigate
                            href="{{ route('clientes.show', $cliente->id) }}"
                            class="text-xs px-2 py-1 rounded bg-cyan-50 text-cyan-600 hover:bg-cyan-100">
                            Ver
                        </a>
                       
                        <a 
                            wire:navigate
                            href="{{ route('clientes.edit', $cliente->id) }}"
                            class="text-xs px-2 py-1 rounded bg-yellow-50 text-yellow-600 hover:bg-yellow-100">
                            Editar
                        </a>
                        <button 
                            wire:click="openTaskForm({{ $cliente->id }})"
                            class="text-xs px-2 py-1 rounded bg-green-50 text-green-600 hover:bg-green-100">
                            + Tarea
                        </button>
                        <button 
                            onclick="confirm('¿Eliminar este cliente?') || event.stopImmediatePropagation()"
                            wire:click="deleteCliente({{ $cliente->id }})"
                            class="text-xs px-2 py-1 rounded bg-red-50 text-red-600 hover:bg-red-100">
                            Eliminar
                        </button>

                    </div>

                </div>

                {{-- 🔽 TAREAS DESPLEGABLES --}}
                @if(in_array($cliente->id, $expanded))
                    <div class="px-6 pb-4 bg-gray-50">
                        @if($newTask['cliente_id'] === $cliente->id)

                            <div class="px-6 pb-4 bg-gray-50">
                                @if (session()->has('success'))
                                    <p class="text-green-600 text-xs">
                                        {{ session('success') }}
                                    </p>
                                @endif
                                <form wire:submit.prevent="createTask" class="flex gap-2">

                                    <input 
                                        type="text"
                                        wire:model.defer="newTask.title"
                                        placeholder="Nueva tarea..."
                                        class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm">

                                    <button 
                                        type="submit"
                                        class="bg-cyan-500 text-white px-3 py-2 rounded text-xs"
                                        wire:loading.attr="disabled">
                                        Guardar
                                        <span wire:loading>
                                            <i class="fas fa-spinner fa-spin">Guardando...</i>
                                        </span>
                                    </button>

                                </form>

                                @error('newTask.title')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror

                            </div>

                        @endif
                        @if($cliente->tasks->isEmpty())
                            <p class="text-xs text-gray-400">Sin tareas</p>
                        @else
                            <div class="space-y-2">

                                @foreach($cliente->tasks as $task)
                                    
                                    <div class="flex items-center justify-between bg-white px-3 py-2 rounded border">

                                        <span class="text-sm {{ $task->completed ? 'line-through text-gray-400' : '' }}">
                                            {{ $task->title }}
                                        </span>
                                        <div class="flex items-center gap-2">
                                            <button 
                                                wire:click="deleteTask({{ $task->id }})"
                                                class="text-xs text-red-500 hover:scale-110 transition">
                                                ✖
                                            </button>
                                            <button 
                                                wire:click="toggleTask({{ $task->id }})"
                                                class="text-xs text-cyan-600 hover:scale-110 transition">
                                                ✔
                                            </button>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        @endif

                    </div>
                @endif

            </div>

        @endforeach
            {{-- PAGINACIÓN --}}
            <div class="p-4">
                {{ $clientes->links() }}
            </div>
    </div>

</div>