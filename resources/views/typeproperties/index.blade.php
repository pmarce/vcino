@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Tipos de propiedad</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#/">Inicio</a>
                </li>
                <li>
                    Configuración
                </li>
                <li class="active">
                    <strong>Lista de tipos de propiedad</strong>
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
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($typeproperties as $typeproperty)
                                @if($typeproperty->activa == 1)
                            <tr>
                                <td>{{ $typeproperty->tipo_propiedad }}</td>
                                <td><span class="text-success">Activo</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Opciones
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="{{ route('config.typeproperty.edit', $typeproperty->id) }}">Editar Tipo de propiedad</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                                @else

                                <tr>
                                    <td>{{ $typeproperty->tipo_propiedad }}</td>
                                    <td style="vertical-align:middle"><span class="text-danger">Inactiva</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Opciones
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                <li><a href="{{ route('config.typeproperty.edit', $typeproperty->id) }}">Editar Tipo de propiedad</a></li>
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
                        <a href="{{ route('config.typeproperty.create') }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Nuevo tipo de propiedad" data-original-title="Nuevo tipo de propiedad" style="margin-right: 10px;"> Nuevo </a>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Imprimir lista..." data-original-title="Imprimir lista..." style="margin-right: 10px;"> <i class="fa fa-print fa-lg"></i> </button>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar" data-original-title="Exportar"> <i class="fa fa-file-excel-o fa-lg"></i> </button>
                    </div>
                    <div class="ibox-content">
                        <h5>
                            Tipos de propiedad
                        </h5>
                        <p>
                            Los tipos de propiedad sirven para clasificar a cada una de las propiedades.
                        </p>
                        <p>
                            Cada tipo representa una, servirá para... Cada tipo representa una, servirá para... Cada tipo representa una, servirá para... Cada tipo representa una, servirá para...
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>



@endsection