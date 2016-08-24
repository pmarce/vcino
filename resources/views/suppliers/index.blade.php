@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Proveedores</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#/">Inicio</a>
                </li>
                <li>
                    Configuración
                </li>
                <li class="active">
                    <strong>Lista de proveedores</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-9">
                @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {!! session('message') !!}
                    </div>
                @endif
                <div class="ibox">
                    <div class="ibox-content">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Razón social / Nombre</th>
                                <th>E-mail</th>
                                <th>Teléfono emergencia</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($suppliers as $supplier)
                                @if($supplier->activa == 1)
                                    <tr>
                                        <td>{{ $supplier->razon_social }} {{ $supplier->contacto_nombre }} {{ $supplier->contacto_apellido }}</td>
                                        <td>{{ $supplier->email }}</td>
                                        <td>{{ $supplier->telefono_oficina }} - {{ $supplier->telefono_movil }}</td>
                                        <td><span class="text-success">Activo</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    Opciones
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <li><a href="{{ route('config.supplier.show', $supplier->id) }}">Ver Cuenta</a></li>
                                                    <li><a href="{{ route('config.supplier.edit', $supplier->id) }}">Editar Cuenta</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td><span class="text-muted">{{ $supplier->razon_social }} {{ $supplier->contacto_nombre }} {{ $supplier->contacto_apellido }}</span></td>
                                        <td><span class="text-muted">{{ $supplier->email }}</span></td>
                                        <td><span class="text-muted">{{ $supplier->telefono_oficina }} - {{ $supplier->telefono_movil }}</span></td>
                                        <td><span class="text-danger">Inactiva</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    Opciones
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <li><a href="{{ route('config.supplier.show', $supplier->id) }}">Ver Proveedor</a></li>
                                                    <li><a href="{{ route('config.supplier.edit', $supplier->id) }}">Editar Proveedor</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title text-left" style="padding-left: 20px;">
                        <a href="{{ route('config.supplier.create') }}" type="button" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Nuevo Proveedor" data-original-title="Nuevo Proveedor" style="margin-right: 10px;"> Nuevo </a>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Imprimir lista de Proveedores..." data-original-title="Imprimir lista de Proveedores..." style="margin-right: 10px;"> <i class="fa fa-print fa-lg"></i> </button>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar Proveedores" data-original-title="Exportar Proveedores"> <i class="fa fa-file-excel-o fa-lg"></i> </button>
                    </div>
                    <div class="ibox-content">
                        <h5>
                            Proveedores
                        </h5>
                        <p>
                            Los Proveedores son todas las empresas, prefesionales o técnicos que prestan diferentes servicios a la empresa. Los Proveedores son todas las empresas, prefesionales o técnicos que prestan diferentes servicios a la empresa.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>




@endsection