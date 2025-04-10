@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de Roles</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Roles registrados</h3>
                    <div class="card-tools">
                        <!-- Botón para crear un nuevo nivel -->
                        <a href="{{ url('/admin/roles/create') }}" class="btn btn-primary">Crear nuevo</a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Tabla para mostrar los niveles -->
                    <table id="example1" class="table table-bordered table-hover table-striped table-sm">
                        <thead>
                            <tr>
                                <th style="text-align: center">Nro</th>
                                <th style="text-align: center">Nombre del rol</th>
                                <th style="text-align: center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $contador = 1; // Para numerar los registros
                            @endphp
                            @foreach($roles as $rol)
                                <tr>
                                    <td style="text-align: center">{{ $contador++ }}</td>
                                    <td>{{ $rol->name }}</td>
                                    <td style="text-align: center">
                                        <div class="btn-group">
                                            <!-- Botón para editar -->
                                            <a href="{{ url('/admin/roles/' . $rol->id . '/edit') }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <!-- Formulario para eliminar -->
                                            <form action="{{ url('/admin/roles/' . $rol->id) }}" method="post" id="formEliminar{{ $rol->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="confirmarEliminar(event, {{ $rol->id }})">
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
        function confirmarEliminar(event, id) {
            event.preventDefault(); 
            Swal.fire({
                title: '¿Eliminar este nivel?', 
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'No, cancelar',
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formEliminar' + id).submit(); 
                }
            });
        }

        $(document).ready(function () {
            $("#example1").DataTable({
                "pageLength": 5, 
                "language": { 
                    "emptyTable": "No hay registros",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Roles",
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
