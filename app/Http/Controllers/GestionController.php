<?php

namespace App\Http\Controllers;

use App\Models\Gestion;
use Illuminate\Http\Request;

class GestionController extends Controller
{
    /**
     * Muestra todas las gestiones.
     */
    public function index()
    {
        $gestiones = Gestion::all(); // Obtener todas las gestiones
        return view('admin.gestiones.index', compact('gestiones')); // Mandarlas a la vista
    }

    /**
     * Muestra el formulario para crear una nueva gestión.
     */
    public function create()
    {
        return view('admin.gestiones.create'); // Solo retorna la vista
    }

    /**
     * Guarda una nueva gestión.
     */
    public function store(Request $request)
    {
        // Validar que el campo nombre no esté vacío
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Guardar los datos en la base de datos
        Gestion::create($request->all());

        // Redireccionar a la lista de gestiones con un mensaje
        return redirect()->route('admin.gestiones.index')
            ->with('mensaje', 'Gestión creada correctamente')
            ->with('icono', 'success');
    }

    /**
     * Muestra los detalles de una gestión (aún no implementado).
     */
    public function show(Gestion $gestion)
    {
        // No sé si esto se usará, pero lo dejo por si acaso
    }

    /**
     * Muestra el formulario para editar una gestión.
     */
    public function edit($id)
    {
        $gestion = Gestion::find($id); // Buscar la gestión por ID
        return view('admin.gestiones.edit', compact('gestion')); // Pasarla a la vista
    }

    /**
     * Actualiza una gestión existente.
     */
    public function update(Request $request, $id)
    {
        // Validar el nombre otra vez (por si lo dejan vacío)
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Buscar la gestión por ID y actualizarla
        $gestion = Gestion::find($id);
        $gestion->update($request->all());

        return redirect()->route('admin.gestiones.index')
            ->with('mensaje', 'Gestión actualizada correctamente')
            ->with('icono', 'success');
    }

    /**
     * Elimina una gestión.
     */
    public function destroy($id)
    {
        $gestion = Gestion::find($id); // Buscar la gestión
        $gestion->delete(); // Borrarla

        return redirect()->route('admin.gestiones.index')
            ->with('mensaje', 'Gestión eliminada correctamente')
            ->with('icono', 'success');
    }
}
