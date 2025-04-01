<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    /**
     * Muestra todas las carreras disponibles.
     */
    public function index()
    {
        $carreras = Carrera::all(); // Obtiene todas las carreras de la base de datos
        return view('admin.carreras.index', compact('carreras'));
    }

    /**
     * Muestra el formulario para agregar una nueva carrera.
     */
    public function create()
    {
        return view('admin.carreras.create'); // Retorna la vista para crear una carrera
    }

    /**
     * Guarda una nueva carrera en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación para asegurarnos de que el nombre no esté vacío
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Crea la carrera con los datos ingresados
        Carrera::create($request->all());

        // Redirige de nuevo a la lista de carreras con un mensaje
        return redirect()->route('admin.carreras.index')
            ->with('mensaje', 'Carrera creada correctamente')
            ->with('icono', 'success');
    }

    /**
     * Muestra la información de una carrera específica.
     */
    public function show(Carrera $carrera)
    {
        // Esta función no la uso por ahora, pero aquí iría la lógica si la necesito
    }

    /**
     * Muestra el formulario para editar una carrera.
     */
    public function edit($id)
    {
        $carrera = Carrera::findOrFail($id); // Busca la carrera por ID
        return view('admin.carreras.edit', compact('carrera'));
    }

    /**
     * Actualiza los datos de una carrera existente.
     */
    public function update(Request $request, $id)
    {
        // Validación para evitar campos vacíos
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Busca la carrera y actualiza los datos
        $carrera = Carrera::findOrFail($id);
        $carrera->update($request->all());

        // Redirige con un mensaje de éxito
        return redirect()->route('admin.carreras.index')
            ->with('mensaje', 'Carrera actualizada correctamente')
            ->with('icono', 'success');
    }

    /**
     * Elimina una carrera de la base de datos.
     */
    public function destroy($id)
    {
        $carrera = Carrera::findOrFail($id); // Encuentra la carrera por ID
        $carrera->delete(); // La elimina

        // Mensaje de confirmación
        return redirect()->route('admin.carreras.index')
            ->with('mensaje', 'Carrera eliminada correctamente')
            ->with('icono', 'success');
    }
}
