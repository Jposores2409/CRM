<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cliente;
use App\Models\Task;
use Livewire\WithPagination;
//Todo lo controla render()
class ClientesManager extends Component
{

    public $status = '';
    public $search = '';
    public $expanded = [];
    public $newTask = [
    'title' => '',
    'cliente_id' => null, ];
    use WithPagination;
    public function openTaskForm($clienteId)
    {
        $this->newTask['cliente_id'] = $clienteId;
        $this->newTask['title'] = '';
    }
    public function deleteTask($taskId)
    {
        \App\Models\Task::find($taskId)?->delete(); // Elimina la tarea con el ID proporcionado, si existe
    }
       
    public function createTask()
    {
        session()->flash('message', 'Tarea creada exitosamente'); // Agrega un mensaje flash para indicar que la tarea se ha creado exitosamente
        $this->validate([
            'newTask.title' => 'required|string|max:255',
            'newTask.cliente_id' => 'required|exists:clientes,id',

        ]);
    
        \App\Models\Task::create([
            'title' => $this->newTask['title'],
            'cliente_id' => $this->newTask['cliente_id'],
            'completed' => false,
        ]);

        // reset
        $this->newTask = ['title' => '', 'cliente_id' => null];
    }
    public function updatingSearch()
    {
        $this->resetPage(); // Resetea la paginación al actualizar la búsqueda
    }
    public function toggleCliente($clienteId)
    {
        if (in_array($clienteId, $this->expanded)) {
            $this->expanded = array_diff($this->expanded, [$clienteId]);
        } else {
            $this->expanded[] = $clienteId;
        }
    }
    // El método toggleTask se encarga de cambiar el estado de completado de una tarea específica por su ID.
    public function toggleTask($taskId)
    {
        $task = Task::find($taskId); // Busca la tarea con el ID proporcionado
        if (!$task) {
            return; // Si la tarea no existe, simplemente retorna sin hacer nada
        }
        $task->completed = !$task->completed; // Cambia el estado de completado a su valor opuesto
        $task->save(); // Guarda los cambios en la base de datos
    }
    // El método deleteCliente se encarga de eliminar un cliente específico por su ID.
    public function deleteCliente($id)
    {
        Cliente::find($id)?->delete(); // Elimina el cliente con el ID proporcionado, si existe
    }
    // El método render se encarga de obtener los clientes filtrados por búsqueda y estado, y luego los pasa a la vista.
    public function render()
    {
        $query = Cliente::with('tasks'); // Inicia una consulta para obtener los clientes junto con sus tareas relacionadas

        // Filtrar por búsqueda si se ha ingresado algo en el campo de búsqueda (ya sea por nombre o email)
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('nombre', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }
        // Filtrar por estado si se ha seleccionado uno
        if (!empty($this->status)) {
            $query->where('status', $this->status);
        }

        return view('livewire.clientes-manager', [
            'clientes' => $query->paginate(10), // Pagina los resultados para mostrar 10 clientes por página
        ]);
    }
}