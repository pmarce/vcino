@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Tareas</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Tareas & Solicitudes
            </li>
            <li>
                <a href="#">Tareas</a>
            </li>
            <li class="active">
                <strong>Ver tarea</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Editar tarea</h5>
                </div>

                <div class="ibox-content">
					
                    <form action="#" class="form-horizontal">
					<input type="hidden" name="tipo_tarea" value="{{$task->tipo_tarea}}">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tipo</label>
                        <div class="col-sm-5">
							{{ Form::select('tipo_tarea_select',
							array(
							'0' => 'Seleccione el tipo de tarea',
							'mis_tareas' => 'Mis tareas',
							'solicitudes_recibidas' => 'Solicitudes recibidas',
							'reserva_instalaciones' => 'Reserva de instalaciones',
							'reclamos' => 'Reclamos',
							'sugerencias' => 'Sugerencias',
							'notificacion_mudanza' => 'Notificacion de mudanza',
							'notificacion_trabajos' => 'Notificacion de trabajos'
							),
							$task->tipo_tarea,
							['class' => 'form-control input-sm','id' => 'tipo-tarea','disabled'=>'disabled']) }}
							@if ($errors->has('tipo_tarea'))
								<span class="help-block">
										<strong>{{ $errors->first('tipo_tarea') }}</strong>
									</span>
							@endif
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}" id="fecha-tarea">
                        <label class="col-sm-2 control-label">Fecha</label>
                        <div class="col-sm-3">
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control input-sm date-picker" name="fecha" value="{{ date_format(date_create($task->fecha),'d/m/Y') }}" disabled="disabled">
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('titulo_tarea') ? ' has-error' : '' }}" id="titulo-tarea">
						<label class="col-sm-2 control-label">Tarea</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-sm" name="titulo_tarea" value="{{$task->titulo_tarea}}" disabled="disabled">
							@if ($errors->has('titulo_tarea'))
								<span class="help-block">
										<strong>{{ $errors->first('titulo_tarea') }}</strong>
									</span>
							@endif
                        </div>
                    </div>

                    <div class="form-group" id="nota">
						<label class="col-sm-2 control-label">Nota</label>
                        <div class="col-sm-10">
                            <div class="ibox-content no-padding">
                                <?php echo $task->nota ?>
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group" id="prioridad">
                        <label class="col-sm-2 control-label">Prioridad</label>
                        <div class="col-sm-3">
							{{ Form::select('prioridad',
							array(
							'normal' => 'Normal',
							'alta' => 'Alta',
							),
							$task->prioridad,
							['class' => 'form-control input-sm','disabled'=>'disabled']) }}
							@if ($errors->has('prioridad'))
								<span class="help-block">
										<strong>{{ $errors->first('prioridad') }}</strong>
									</span>
							@endif
                        </div>
                    </div>

                    <div class="form-group" id="frecuencia">
                        <label class="col-sm-2 control-label">Frecuencia</label>
                        <div class="col-sm-3">
							{{ Form::select('frecuencia',
							array(
							'unica' => 'Única vez',
							'semanal' => 'Semanal',
							'mensual' => 'Mensual',
							'trimestral' => 'Trimestral',
							'semestral' => 'Semestral',
							'anual' => 'Anual',
							),
							$task->frecuencia,
							['class' => 'form-control input-sm','disabled'=>'disabled']) }}
							@if ($errors->has('frecuencia'))
								<span class="help-block">
										<strong>{{ $errors->first('frecuencia') }}</strong>
									</span>
							@endif
                        </div>
                    </div>

                    <div class="form-group" id="medio-solicitud">
                        <label class="col-sm-2 control-label">Medio solicitud</label>
                        <div class="col-sm-3">
							{{ Form::select('medio_solicitud',
							array(
							'personalmente' => 'Personalmente',
							'email' => 'E-mail',
							'telefono' => 'Teléfono',
							'aplicacion' => 'Aplicación móvil',
							'texting' => 'Texting',
							'otro' => 'Otro',
							),
							$task->medio_solicitud,
							['class' => 'form-control input-sm','disabled'=>'disabled']) }}
							@if ($errors->has('medio_solicitud'))
								<span class="help-block">
									<strong>{{ $errors->first('medio_solicitud') }}</strong>
								</span>
							@endif
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
					@if($task->tipo_tarea =='solicitudes_recibidas' ||
					$task->tipo_tarea =='solicitudes_recibidas' ||
					$task->tipo_tarea =='reclamos' ||
					$task->tipo_tarea =='sugerencias' ||
					$task->tipo_tarea =='reclamos' ||
					$task->tipo_tarea =='notificacion_mudanza' ||
					$task->tipo_tarea =='notificacion_trabajos')
					<input type="hidden" name="tipo_tarea_id" value="{{$task->taskrequest->id}}">
					<div class="form-group{{ $errors->has('propiedad') ? ' has-error' : '' }}" id="propiedad">
                        <label class="col-sm-2 control-label">Propiedad</label>
                        <div class="col-sm-3">
                            {{ Form::select('propiedad',['0'=>'Selecciona una propiedad']+$properties, $task->taskrequest->property->id, ['class' => 'form-control input-sm','id'=>'propiedades','disabled'=>'disabled']) }}
							@if ($errors->has('propiedad'))
								<span class="help-block">
									<strong>{{ $errors->first('propiedad') }}</strong>
								</span>
							@endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('contacto') ? ' has-error' : '' }}" id="contacto">
                        <label class="col-sm-2 control-label">Contacto</label>
                        <div class="col-sm-3">
                            {{ Form::select('contacto',$contacts, $task->taskrequest->contact->id, ['class' => 'form-control input-sm','id'=>'contactos','disabled'=>'disabled']) }}
							@if ($errors->has('contacto'))
								<span class="help-block">
									<strong>{{ $errors->first('contacto') }}</strong>
								</span>
							@endif
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group{{ $errors->has('instalacion') ? ' has-error' : '' }}" id="instalacion">
                        <label class="col-sm-2 control-label">Instalación</label>
                        <div class="col-sm-5">
                           {{ Form::select('instalacion',$installations,$task->instalacion, ['class' => 'form-control input-sm','id'=>'instalaciones','disabled'=>'disabled']) }}
						   @if ($errors->has('instalacion'))
								<span class="help-block">
									<strong>{{ $errors->first('instalacion') }}</strong>
								</span>
							@endif
                        </div>
                    </div>
					@elseif($task->tipo_tarea =='reserva_instalaciones')
					<input type="hidden" name="tipo_tarea_id" value="{{$task->taskreservation->id}}">
					<div class="form-group{{ $errors->has('propiedad') ? ' has-error' : '' }}" id="propiedad">
                        <label class="col-sm-2 control-label">Propiedad</label>
                        <div class="col-sm-3">
                            {{ Form::select('propiedad',['0'=>'Selecciona una propiedad']+$properties, $task->taskreservation->property->id, ['class' => 'form-control input-sm','id'=>'propiedades','disabled'=>'disabled']) }}
							@if ($errors->has('propiedad'))
								<span class="help-block">
									<strong>{{ $errors->first('propiedad') }}</strong>
								</span>
							@endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('contacto') ? ' has-error' : '' }}" id="contacto">
                        <label class="col-sm-2 control-label">Contacto</label>
                        <div class="col-sm-3">
                             {{ Form::select('contacto',$contacts, $task->taskreservation->contact->id, ['class' => 'form-control input-sm','id'=>'contactos','disabled'=>'disabled']) }}
							@if ($errors->has('contacto'))
								<span class="help-block">
									<strong>{{ $errors->first('contacto') }}</strong>
								</span>
							@endif
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group{{ $errors->has('instalacion') ? ' has-error' : '' }}" id="instalacion">
                        <label class="col-sm-2 control-label">Instalación</label>
                        <div class="col-sm-5">
                           {{ Form::select('instalacion',['0'=>'Selecciona una instalacion']+$installations,$task->taskreservation->installation->id, ['class' => 'form-control input-sm','id'=>'instalaciones','disabled'=>'disabled']) }}
						   @if ($errors->has('instalacion'))
								<span class="help-block">
									<strong>{{ $errors->first('instalacion') }}</strong>
								</span>
							@endif
                        </div>
                    </div>
					@else
					<div class="form-group{{ $errors->has('propiedad') ? ' has-error' : '' }}" id="propiedad">
                        <label class="col-sm-2 control-label">Propiedad</label>
                        <div class="col-sm-3">
                            {{ Form::select('propiedad',['0'=>'Selecciona una propiedad']+$properties, $task->propiedad, ['class' => 'form-control input-sm','id'=>'propiedades','disabled'=>'disabled']) }}
							@if ($errors->has('propiedad'))
								<span class="help-block">
									<strong>{{ $errors->first('propiedad') }}</strong>
								</span>
							@endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('contacto') ? ' has-error' : '' }}" id="contacto">
                        <label class="col-sm-2 control-label">Contacto</label>
                        <div class="col-sm-3">
                            <select class="form-control input-sm" name="contacto" id="contactos">
								<option value="0">Seleccione un contacto</option>
							</select>
							@if ($errors->has('contacto'))
								<span class="help-block">
									<strong>{{ $errors->first('contacto') }}</strong>
								</span>
							@endif
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group{{ $errors->has('instalacion') ? ' has-error' : '' }}" id="instalacion">
                        <label class="col-sm-2 control-label">Instalación</label>
                        <div class="col-sm-5">
                           {{ Form::select('instalacion',['0'=>'Selecciona una instalacion']+$installations,$task->instalacion, ['class' => 'form-control input-sm','id'=>'instalaciones','disabled'=>'disabled']) }}
						   @if ($errors->has('instalacion'))
								<span class="help-block">
									<strong>{{ $errors->first('instalacion') }}</strong>
								</span>
							@endif
                        </div>
                    </div>
					@endif
                    

                    <div class="form-group{{ $errors->has('fecha_requerida') ? ' has-error' : '' }}" id="fecha-requerida">
                        <label class="col-sm-2 control-label">Fecha requerida</label>
                        <div class="col-sm-3">
							
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control input-sm date-picker" name="fecha_requerida" value="{{ date_format(date_create($task->fecha_requerida),'d/m/Y') }}" disabled="disabled">
							@if ($errors->has('fecha_requerida'))
								<span class="help-block">
									<strong>{{ $errors->first('fecha_requerida') }}</strong>
								</span>
							@endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('hora_inicio') ? ' has-error' : '' }}" id="hora-inicio">

                        <label class="col-sm-2 control-label">Hora desde</label>
                        <div class="col-sm-3">
                            <div class="input-group clockpicker" data-autoclose="true">
                                <input type="text" class="form-control time-picker" name="hora_inicio" value="{{ date_format(date_create($task->hora_inicio),'H:i') }}" disabled="disabled">

                                <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                </span>
								@if ($errors->has('hora_inicio'))
								<span class="help-block">
									<strong>{{ $errors->first('hora_inicio') }}</strong>
								</span>
								@endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('hora_final') ? ' has-error' : '' }}" id="hora-final">
                        <label class="col-sm-2 control-label">Hora hasta</label>
                        <div class="col-sm-3">
                            <div class="input-group clockpicker" data-autoclose="true">
                                <input type="text" class="form-control time-picker" name="hora_final" value="{{ date_format(date_create($task->hora_final),'H:i') }}" disabled="disabled">

                                <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                </span>
								@if ($errors->has('hora_final'))
								<span class="help-block">
									<strong>{{ $errors->first('hora_final') }}</strong>
								</span>
								@endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('costo') ? ' has-error' : '' }}" id="costo">
						<label class="col-sm-2 control-label">Costo</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control input-sm" name="costo" value="{{$task->costo}}" disabled="disabled">
                        </div>
						@if ($errors->has('costo'))
						<span class="help-block">
							<strong>{{ $errors->first('costo') }}</strong>
						</span>
						@endif
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group" id="adjuntos">
                        <label class="col-sm-2 control-label">Adjuntos</label>
                        <div class="col-sm-8">

                            <div id="adjunto-1" class="fileinput input-group {{!empty($task->documento_1) ? 'fileinput-exists'  : 'fileinput-new'}}" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput">
                                    <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                    <span class="fileinput-filename">{{ (!empty($task->documento_1) ) ? MenuRoute::filename($task->documento_1) : "" }}</span>
                                </div>
                                
                               
                            </div>


                            <!--    Para el caso de mas de un attach        -->
                            <div id="adjunto-2" class="fileinput input-group {{!empty($task->documento_2) ? 'fileinput-exists'  : 'fileinput-new'}}" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput">
                                    <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                    <span class="fileinput-filename">{{ (!empty($task->documento_2) ) ? MenuRoute::filename($task->documento_2) : "" }}</span>
                                </div>
                                
                                
                            </div>
                            <!--    Para el caso de mas de un attach        -->
                            <div id="adjunto-3" class="fileinput input-group {{!empty($task->documento_3) ? 'fileinput-exists'  : 'fileinput-new'}}" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput">
                                    <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                    <span class="fileinput-filename">{{ (!empty($task->documento_3) ) ? MenuRoute::filename($task->documento_3) : "" }}</span>
                                </div>
                                
                              
                            </div>

                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
					<div class="form-group">
                        <label class="col-sm-2 control-label">Estado</label>
                        <div class="col-sm-8">
                            <div data-toggle="buttons" class="btn-group">
                                <label class="btn btn-sm btn-white {{ $task->estado_solicitud == 'pendiente' ? 'active' : '' }}">
                                    <input type="radio" id="option1" name="tarea_estado" disabled value="pendiente" {{ $task->estado_solicitud == 'pendiente' ? 'checked' : '' }}> <span style="color: #F7B77B;"> PENDIENTE</span> </label>
                                <label class="btn btn-sm btn-white {{ $task->estado_solicitud == 'en proceso' ? 'active' : '' }}"> 
                                    <input type="radio" id="option2" name="tarea_estado" disabled value="en proceso" {{ $task->estado_solicitud == 'en proceso' ? 'checked' : '' }}> <span style="color: #5D96CC;">EN PROCESO</span> </label>
                                <label class="btn btn-sm btn-white {{ $task->estado_solicitud == 'completada' ? 'active' : '' }}"> 
                                    <input type="radio" id="option3" name="tarea_estado" disabled value="completada" {{ $task->estado_solicitud == 'completada' ? 'checked' : '' }}> <span style="color: #5CBD7E;">COMPLETADA</span> </label>
                            </div>
                        </div>
                    </div>
					<div class="form-group">
                        <div class="col-sm-12">
                            <a href="{{ route('taskrequest.task.index') }}" class="btn btn-promary">Atras</a>
                        </div>
                    </div>

                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<link rel="stylesheet" href="{{ URL::asset('css/summernote.css') }}" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('javascript')
<!--Lenguaje datepicker español-->
<script type="text/javascript" src="{{ URL::asset('js/moment.es.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/summernote.min.js') }}"></script>

<script>
	$(document).ready(function(){
		
		tipo_tarea = $('#tipo-tarea option:selected').val();
		
		if(tipo_tarea == "mis_tareas"){
			$('#fecha-tarea').show("slow");
			$('#titulo-tarea').show("slow");
			$('#nota').show("slow");
			$('#prioridad').show("slow");
			$('#frecuencia').show("slow");
			$('#medio-solicitud').hide();
			$('#propiedad').hide();
			$('#contacto').hide();
			$('#instalacion').hide();
			$('#fecha-requerida').hide();
			$('#hora-inicio').hide();
			$('#hora-final').hide();
			$('#costo').hide();
			$('#adjuntos').show("slow");

		}else if(tipo_tarea == "solicitudes_recibidas"){
			$('#fecha-tarea').show("slow");
			$('#titulo-tarea').show("slow");
			$('#nota').show("slow");
			$('#prioridad').show("slow");
			$('#frecuencia').hide();
			$('#medio-solicitud').show("slow");
			$('#propiedad').show("slow");
			$('#contacto').show("slow");
			$('#instalacion').hide();
			$('#fecha-requerida').hide();
			$('#hora-inicio').hide();
			$('#hora-final').hide();
			$('#costo').hide();
			$('#adjuntos').show("slow");

		}else if(tipo_tarea == "reserva_instalaciones"){
			$('#fecha-tarea').show("slow");
			$('#titulo-tarea').show("slow");
			$('#nota').show("slow");
			$('#prioridad').hide();
			$('#frecuencia').hide();
			$('#medio-solicitud').show("slow");
			$('#propiedad').show("slow");
			$('#contacto').show("slow");
			$('#instalacion').show("slow");
			$('#fecha-requerida').show("slow");
			$('#hora-inicio').show("slow");
			$('#hora-final').show("slow");
			$('#costo').show("slow");
			$('#adjuntos').hide();

		}else if(tipo_tarea == "reclamos"){
			$('#fecha-tarea').show("slow");
			$('#titulo-tarea').show("slow");
			$('#nota').show("slow");
			$('#prioridad').show("slow");
			$('#frecuencia').hide();
			$('#medio-solicitud').show("slow");
			$('#propiedad').show("slow");
			$('#contacto').show("slow");
			$('#instalacion').hide();
			$('#fecha-requerida').hide();
			$('#hora-inicio').hide();
			$('#hora-final').hide();
			$('#costo').hide();
			$('#adjuntos').show("slow");

		}else if(tipo_tarea == "sugerencias"){
			$('#fecha-tarea').show("slow");
			$('#titulo-tarea').show("slow");
			$('#nota').show("slow");
			$('#prioridad').hide();
			$('#frecuencia').hide();
			$('#medio-solicitud').show("slow");
			$('#propiedad').show("slow");
			$('#contacto').show("slow");
			$('#instalacion').hide();
			$('#fecha-requerida').hide();
			$('#hora-inicio').hide();
			$('#hora-final').hide();
			$('#costo').hide();
			$('#adjuntos').show("slow");

		}else if(tipo_tarea == "notificacion_mudanza"){
			$('#fecha-tarea').show("slow");
			$('#titulo-tarea').show("slow");
			$('#nota').show("slow");
			$('#prioridad').hide();
			$('#frecuencia').hide();
			$('#medio-solicitud').show("slow");
			$('#propiedad').show("slow");
			$('#contacto').show("slow");
			$('#instalacion').hide();
			$('#fecha-requerida').show("slow");
			$('#hora-inicio').hide();
			$('#hora-final').hide();
			$('#costo').hide();
			$('#adjuntos').hide();

		}else if(tipo_tarea == "notificacion_trabajos"){
			$('#fecha-tarea').show("slow");
			$('#titulo-tarea').show("slow");
			$('#nota').show("slow");
			$('#prioridad').hide();
			$('#frecuencia').hide();
			$('#medio-solicitud').show("slow");
			$('#propiedad').show("slow");
			$('#contacto').show("slow");
			$('#instalacion').hide();
			$('#fecha-requerida').show("slow");
			$('#hora-inicio').hide();
			$('#hora-final').hide();
			$('#costo').hide();
			$('#adjuntos').show("slow");

		}else{
			$('#fecha-tarea').hide();
			$('#titulo-tarea').hide();
			$('#nota').hide();
			$('#prioridad').hide();
			$('#frecuencia').hide();
			$('#medio-solicitud').hide();
			$('#propiedad').hide();
			$('#contacto').hide();
			$('#instalacion').hide();
			$('#fecha-requerida').hide();
			$('#hora-inicio').hide();
			$('#hora-final').hide();
			$('#costo').hide();
			$('#adjuntos').hide();
		}
		
		//ajax contactos por propiedad
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
		$('#propiedades').change(function(){
		var propiedad_id = $(this).val();
		console.log(propiedad_id);
		$.post('/contact/'+propiedad_id+'/property', function(response){
			
				if(response.success)
				{
					var contactos = $('#contactos').empty();
					$('<option/>', {
							value:0,
							text:"Seleccione un contacto"
						}).appendTo(contactos);
					$.each(response.contacts, function(i, contact){
						$('<option/>', {
							value:i,
							text:contact
						}).appendTo(contactos);
					})
				}
			}, 'json');
		});

		$('.date-picker').datetimepicker({
			locale:'es',
			format: 'DD/MM/YYYY',
				widgetPositioning: {
				horizontal: 'left',
						vertical: 'bottom'
				}
		});
		
		$('.time-picker').datetimepicker({
            format: 'HH:mm',
			widgetPositioning: {
			horizontal: 'left',
				vertical: 'bottom'
			}
        });
		$('#summernote').summernote({
			height: 300,
			toolbar: [
			    ['style', ['style']],
			    ['font', ['bold', 'italic', 'underline']],
			    ['color', ['color']],
			    ['para', ['ul', 'ol', 'paragraph']],
			    ['insert', ['hr']],
			    ['view', ['codeview']],
			    ['help', ['help']]
			],
		});
		
		$('#adjunto-1').on('clear.bs.fileinput', function(event) {
			$('#adjunto-ori-1').val('');
		});
		$('#adjunto-2').on('clear.bs.fileinput', function(event) {
			$('#adjunto-ori-2').val('');
		});
		$('#adjunto-3').on('clear.bs.fileinput', function(event) {
			$('#adjunto-ori-3').val('');
		});
		
	});
	</script>
@endsection