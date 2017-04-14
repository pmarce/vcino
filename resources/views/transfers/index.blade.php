@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Transacciones</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#/">Inicio</a>
            </li>
            <li>
                Transacciones
            </li>
            <li class="active">
                <strong>Lista de transacciones</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Lista de transacciones</h5>
                    <div class="ibox-tools" style="padding-bottom: 7px;">
                        <a href="{{ route('transaction.transfer.create') }}" type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Nuevo comunicado" data-original-title="Nuevo cuota por cobrar" style="margin-right: 10px;"> Nuevo traspaso</a>
                        <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Nuevo comunicado" data-original-title="Nuevo cuota por cobrar" style="margin-right: 5px;">Nuevo gasto  </button>
                    </div>
                </div>

                <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="vertical-align:bottom">Fecha</th>
                                <th style="vertical-align:bottom">Nro.<br/>Documento</th>
                                <th style="vertical-align:bottom">Tipo</th>
								<th style="vertical-align:bottom">Beneficiario</th>
								<th style="vertical-align:bottom">Categoria</th>
                                <th style="vertical-align:bottom">Concepto</th>
								<th style="vertical-align:bottom">Cuenta</th>
                                <th style="vertical-align:bottom">Forma<br/> de pago</th>
                                <th style="vertical-align:bottom">Ref. pago</th>
                                <th style="vertical-align:bottom; text-align: right;">Importe</th>
                                <th style="vertical-align:bottom" width="50"></th>
                            </tr>
                        </thead>
                        <tbody>
							@foreach($transactions as $transaction)
								@if($transaction->tipo_transaccion == "Ingreso")
									<tr>
										<td>{{ date_format(date_create($transaction->fecha_pago),'d/m/Y') }}</td>
										<td>{{$transaction->nro_documento}}</td>
										<td><i class="fa fa-long-arrow-up"></i>&nbsp;&nbsp;Cobranza</td>
										<td>{{$transaction->collection->property->nro}}&nbsp;-&nbsp;{{$transaction->collection->contact->nombre}} {{$transaction->collection->contact->apellido}}</td>
										<td></td>
										<td>{{$transaction->concepto}}</td>
										<td>{{$transaction->collection->account->nombre}}</td>
										<td>{{strtoupper($transaction->forma_pago)}}</td>
										<td>{{$transaction->numero_forma_pago}}</td>
										<td style="text-align: right;">{{$transaction->importe_credito}}</td>
										<td style="vertical-align:middle; text-align:right;">
											<div class="btn-group">
												<a href="{{ route('transaction.collection.show', $transaction->collection->id ) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver comprobante">
													   <i class="fa fa-eye"></i>
												   </a>
											</div>
									   </td>
									</tr>
								@elseif($transaction->tipo_transaccion == "Egreso")
									<tr>
										<td>{{ date_format(date_create($transaction->fecha_pago),'d/m/Y') }}</td>
										<td>{{$transaction->nro_documento}}</td>
										<td><i class="fa fa-long-arrow-down"></i>&nbsp;&nbsp;Gasto</td>
										<td>{{$transaction->expense->supplier->razon_social}}</td>
										<td>{{$transaction->expense->category->nombre}}</td>
										<td>{{$transaction->concepto}}</td>
										<td>{{$transaction->expense->account->nombre}}</td>
										<td>{{strtoupper($transaction->forma_pago)}}</td>
										<td>{{$transaction->numero_forma_pago}}</td>
										<td style="text-align: right;">{{$transaction->importe_debito}}</td>
										<td style="vertical-align:middle; text-align:right;">
											<div class="btn-group">
												<a href="{{ route('transaction.expense.show', $transaction->expense->id) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver comprobante">
													<i class="fa fa-eye"></i>
												</a>
											</div>
									   </td>
									</tr>
								@elseif($transaction->tipo_transaccion == "Traspaso-Egreso")
									<tr>
										<td>{{ date_format(date_create($transaction->fecha_pago),'d/m/Y') }}</td>
										<td>{{$transaction->nro_documento}}</td>
										<td><i class="fa fa fa-arrows-v"></i>&nbsp;&nbsp;{{$transaction->tipo_transaccion}}</td>
										<td></td>
										<td></td>
										<td>{{$transaction->concepto}}</td>
										<td>{{$transaction->transfersOrigin[0]->accountOrigin->nombre}}</td>
										<td>{{strtoupper($transaction->forma_pago)}}</td>
										<td>{{$transaction->numero_forma_pago}}</td>
										<td style="text-align: right;">- {{$transaction->importe_debito}}</td>
										<td style="vertical-align:middle; text-align:right;">
											<div class="btn-group">
												
												<a href="{{ route('transaction.transfer.show', $transaction->transfersOrigin[0]->id) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver comprobante">
													<i class="fa fa-eye"></i>
												</a>
											</div>
									   </td>
									</tr>
								@else
									<tr>
										<td>{{ date_format(date_create($transaction->fecha_pago),'d/m/Y') }}</td>
										<td>{{$transaction->nro_documento}}</td>
										<td><i class="fa fa fa-arrows-v"></i>&nbsp;&nbsp;{{$transaction->tipo_transaccion}}</td>
										<td></td>
										<td></td>
										<td>{{$transaction->concepto}}</td>
										<td>{{$transaction->transfersDestiny[0]->accountDestiny->nombre}}</td>
										<td>{{strtoupper($transaction->forma_pago)}}</td>
										<td>{{$transaction->numero_forma_pago}}</td>
										<td style="text-align: right;">+{{$transaction->importe_credito}}</td>
										<td style="vertical-align:middle; text-align:right;">
											<div class="btn-group">
												
												<a href="{{ route('transaction.transfer.show', $transaction->transfersDestiny[0]->id) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver comprobante">
													<i class="fa fa-eye"></i>
												</a>
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
        </div>

    </div>

</div>



@endsection
@section('style')
    <link rel="stylesheet" href="{{ URL::asset('css/datatables.min.css') }}" />
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
				"pageLength": 25,
                "info":     false,
                "columnDefs": [ { "orderable": false, "targets": 7 } ]
            });
        } );
    </script>
@endsection



