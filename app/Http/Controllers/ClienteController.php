<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
class ClienteController extends Controller


{
    public function index(Request $request)
    {
        $query = Cliente::query();
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('telefono', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->filled('status')) { 
            $query->where('status', $request->status);
        }
        $clientes = $query->with('tasks')->latest()->paginate(10);
        return view('clientes.index', compact('clientes'));
    }
    
    public function show($id)
    {
        $cliente = Cliente::with('tasks')->findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    public function create()
    {
        return view('clientes.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:4',
            'email' => 'required|email|unique:clientes,email',
            'telefono' => 'required|min:6',
            'status' => 'required|string|in:activo,inactivo,cliente,contactado',
        ]);
       Cliente::create([
        'nombre' => $request->nombre,
        'email' => $request->email,
        'telefono' => $request->telefono,
        'status' => $request->status,
       ]);

        return redirect()->route('clientes.index');
    }
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|min:4',
            'email' => 'required|email|unique:clientes,email,' . $id,
            'telefono' => 'required|min:6',
        

        ]);
        $cliente = Cliente::findOrFail($id);
        $cliente->update([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'status' => 'required|string|in:activo,inactivo,cliente,contactado',
        ]);
        return redirect('/clientes') ->with('success', 'Cliente actualizado exitosamente');
    }
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect('/clientes') ->with('success', 'Cliente eliminado exitosamente');
    }
}