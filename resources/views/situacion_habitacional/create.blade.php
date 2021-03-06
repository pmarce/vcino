@extends('layouts.app')
@section('body-class', 'gray-bg')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="pull-left">Create New Situacion Habitacional</h1>
        </div>
    </div>

    @include('core-templates::common.errors')

    <div class="row">
        {!! Form::open(['route' => 'admin.situacionHabitacional.store']) !!}

            @include('situacion_habitacional.fields')

        {!! Form::close() !!}
    </div>
</div>
@endsection
