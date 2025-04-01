@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de Niveles</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Niveles registrados</h3>
                    <div class="card-tools">
                        <!-- Botón para crear un nuevo nivel -->
                        <a href="{{ url('/admin/niveles/create') }}" class="btn btn-primary">Crear nuevo</a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Tabla para mostrar los niveles -->
                    <table id="example1" class="table table-bordered table-hover table-striped table-sm">
                        <thead>
                            <tr>
                                <th style="text-align: center">Nro</th>
                                <th style="text-align: center">Nombre del nivel</th>
                                <th style="text-align: center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $contador = 1; // Para numerar los registros
                            @endphp
                            @foreach($niveles as $nivel)
                                <tr>
                                    <td style="text-align: center">{{ $contador++ }}</td>
                                    <td>{{ $nivel->nombre }}</td>
                                    <td style="text-align: center">
                                        <div class="btn-group">
                                            <!-- Botón para editar -->
                                            <a href="{{ url('/admin/niveles/' . $nivel->id . '/edit') }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <!-- Formulario para eliminar -->
                                            <form action="{{ url('/admin/niveles/' . $nivel->id) }}" method="post" id="formEliminar{{ $nivel->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="confirmarEliminar(event, {{ $nivel->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        /* Estilos para los botones de exportación */
        .dt-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        /* Estilos para los botones */
        .btn {
            border-radius: 4px;
            padding: 5px 15px;
            font-size: 14px;
        }

        /* Colores para cada botón */
        .btn-danger { background-color: #dc3545; }
        .btn-success { background-color: #28a745; }
        .btn-info { background-color: #17a2b8; }
        .btn-warning { background-color: #ffc107; color: #212529; }
        .btn-default { background-color: #6e7176; color: #212529; }
    </style>
@stop

@section('js')
    <script>
        // Función para confirmar antes de eliminar
        function confirmarEliminar(event, id) {
            event.preventDefault(); // Evita que se envíe el formulario de inmediato
            Swal.fire({
                title: '¿Eliminar este nivel?', // Mensaje de confirmación
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'No, cancelar',
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formEliminar' + id).submit(); // Envía el formulario si el usuario confirma
                }
            });
        }

        $(document).ready(function () {
            // Configuración de la tabla con DataTables
            $("#example1").DataTable({
                "pageLength": 5, // Cantidad de registros por página
                "language": { // Traducción al español
                    "emptyTable": "No hay registros",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Niveles",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "search": "Buscar:",
                    "paginate": { "next": "Siguiente", "previous": "Anterior" }
                },
                "responsive": true,
                "autoWidth": false,
                buttons: [
                    { extend: 'copy', className: 'btn btn-default', text: '<i class="fas fa-copy"></i> Copiar' },
                    { extend: 'pdf', className: 'btn btn-danger', text: '<i class="fas fa-file-pdf"></i> PDF' },
                    { extend: 'csv', className: 'btn btn-info', text: '<i class="fas fa-file-csv"></i> CSV' },
                    { extend: 'excel', className: 'btn btn-success', text: '<i class="fas fa-file-excel"></i> Excel' },
                    { extend: 'print', className: 'btn btn-warning', text: '<i class="fas fa-print"></i> Imprimir' }
                ]
            }).buttons().container().appendTo('#example1_wrapper .row:eq(0)');
        });
    </script>
@stop
