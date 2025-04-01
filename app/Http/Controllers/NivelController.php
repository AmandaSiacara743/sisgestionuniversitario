<?php

namespace App\Http\Controllers;

use App\Models\Nivel;
use Illuminate\Http\Request;

class NivelController extends Controller
{
    /**
     * Muestra todos los niveles.
     */
    public function index()
    {
        $niveles = Nivel::all(); // Obtener todos los niveles de la base de datos
        return view('admin.niveles.index', compact('niveles')); // Enviar datos a la vista
    }

    /**
     * Muestra el formulario para agregar un nivel.
     */
    public function create()
    {
        return view('admin.niveles.create'); // Simplemente muestra la vista del formulario
    }

    /**
     * Guarda un nuevo nivel en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar que el campo no esté vacío
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Guardar el nuevo nivel
        Nivel::create($request->all());

        // Redirigir a la lista de niveles con un mensaje de éxito
        return redirect()->route('admin.niveles.index')
            ->with('mensaje', 'Nivel creado correctamente')
            ->with('icono', 'success');
    }

    /**
     * Muestra los detalles de un nivel (no implementado por ahora).
     */
    public function show(Nivel $nivel)
    {
        // Por ahora, no hace nada
    }

    /**
     * Muestra el formulario para editar un nivel.
     */
    public function edit($id)
    {
        $nivel = Nivel::findOrFail($id); // Buscar el nivel en la base de datos
        return view('admin.niveles.edit', compact('nivel')); // Pasarlo a la vista
    }

    /**
     * Actualiza un nivel en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // Validar el campo nombre
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Buscar el nivel y actualizarlo
        $nivel = Nivel::findOrFail($id);
        $nivel->update($request->all());

        return redirect()->route('admin.niveles.index')
            ->with('mensaje', 'Nivel actualizado correctamente')
            ->with('icono', 'success');
    }

    /**
     * Elimina un nivel de la base de datos.
     */
    public function destroy($id)
    {
        $nivel = Nivel::findOrFail($id); // Buscar el nivel
        $nivel->delete(); // Eliminarlo

        return redirect()->route('admin.niveles.index')
            ->with('mensaje', 'Nivel eliminado correctamente')
            ->with('icono', 'success');
    }
}
