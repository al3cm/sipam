@extends('crudbooster::admin_template')
@section('content')

<input type="hidden" name="editar" id="editar" value="{{$editar}}">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>I. Datos principales del pedido</strong> 
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>Pedido</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" readonly name="order_name" class="form-control" value="Pedido {{$row->order_id}}"> 
                            <input type="hidden" name="order_id" id="order_id" value="{{$row->order_id}}">
                            <input type="hidden" name="process_id" id="process_id" value="{{$row->id}}">
                        </div>
                    </div>                        
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>Inicio</label>
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon open-datetimepicker">
                                    <a>
                                        <i class="fa fa-calendar">
                                        </i>
                                    </a>
                                </span>
                                
                                <input type="text" readonly required name="start_date_d" id="start_date_d" class="form-control" value="{{date('d-m-Y', strtotime($row->start_date))}}"> 
                                <input type="hidden" id="start_date_o" value="{{$row->start_date}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p></p>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label">Cliente</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" readonly name="customer_name" class="form-control" id="customer_name" value="{{$customer->name}} {{$customer->last_name}} {{$customer->second_last_name}}"> 
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>L??mite</label>
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon open-datetimepicker">
                                    <a>
                                        <i class="fa fa-calendar">
                                        </i>
                                    </a>
                                </span>
                                <input type="text" readonly required name="deadline_d" id="deadline_d" class="form-control" value="{{date('d-m-Y', strtotime($row->deadline))}}"> 
                                <input type="hidden" id="deadline_o" value="{{$row->deadline}}">
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
            <p></p>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label">Raz??n Social</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" readonly name="customer_business_name" class="form-control" id="customer_business_name" value="{{$customer->business_name}}"> 
                        </div>
                    </div>
                </div>
            </div>
            <p></p>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>Doc. Identidad</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" readonly name="customer_document_number" class="form-control" id="customer_document_number" value="{{$customer->document_number}}"> 
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>RUC</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" readonly name="customer_ruc" class="form-control" id="customer_ruc" value="{{$customer->ruc}}"> 
                        </div>
                    </div>
                </div>
            </div>
            <p></p>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>Direcci??n</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" readonly name="customer_address" class="form-control" id="customer_address" value="{{$customer->address}}"> 
                        </div>
                    </div>                                          
                </div>
            </div>
            <p></p>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>E-mail</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" readonly name="customer_email" class="form-control" id="customer_email" value="{{$customer->email}}"> 
                        </div>      
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>Tel??fono</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" readonly name="customer_phone_number" class="form-control" id="customer_phone_number" value="{{$customer->phone_number}}"> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>II. Detalle del pedido</strong>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label class="control-label">Fecha del pedido</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" readonly required name="order_date" id="order_date" class="form-control" value="{{date('d-m-Y', strtotime($order->order_date))}}"> 
                            <input type="hidden" id="order_date_o" value="{{$order->order_date}}">

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label>Fecha de entrega</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" readonly required name="delivery_date" id="delivery_date" class="form-control" value="{{date('d-m-Y', strtotime($order->delivery_date))}}"> 
                            <input type="hidden" id="delivery_date_o" value="{{$order->delivery_date}}">
                        </div>
                    </div>                    
                </div>
            </div>
            <p></p>
            <div id="detalle-pedido">
                <table width='100%' border='1' style='border: 1px solid #c1bdbd;'>
                    <tr>
                        <th class='cen gris'>Prenda</th>
                        <th class='cen gris'>G??nero</th>
                        <th class='cen gris'>Talla</th>
                        <th class='cen gris'>Color</th>
                        <th class='cen gris'>Material</th>
                        <th class='cen gris'>Cantidad</th>
                    </tr>
                    <input type="hidden" name="total_prendas" value="{{$total_prendas=0}}">
                    
                    @foreach ($order_details as $o)
                        <tr>
                            <td class='cen'>{{$o->tg_description}}</td>
                            <td class='cen'>{{$o->gender}}</td>
                            <td class='cen'>{{$o->s_description}}</td>
                            <td class='cen'>{{$o->c_name}}</td>
                            <td class='cen'>{{$o->m_name}}</td>
                            <td class='cen'>{{$o->quantity}}</td>
                        </tr>
                       
                        <input type="hidden" name="total_prendas" value=" {{$total_prendas += $o->quantity}}">
                    @endforeach
                    <tr class="gris">
                        <th class="cen" colspan="5">Total de prendas</th>
                        <th class='cen'>{{$total_prendas}}</td>
                    </tr>
                    <tr class="gris">
                        <th class="cen" colspan="5">% Total de avance productivo</th>
                        <td class="cen">
                            <label name="t_advance" class="margen0 negrita" id="t_advance">{{$row->advance}} %</label>
                            <input type="hidden" name="advance" id="advance" value="{{$row->advance}}">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>    
    <div id='panel-form-detalledelprocesoi' class="panel panel-default">
        <div class="panel-heading">
            <strong>III. Insumos</strong>
        </div>
        <div class="panel-body">
            <div class='row'>
                <div class='col-sm-10'>
                    <form id="add-supply-detail" class="panel panel-default">
                        @csrf
                        <div class="panel-heading">
                            <i class="fa fa-pencil-square-o"></i> Formulario
                        </div>
                        <div class="panel-body child-form-area">
                            <div class='form-group bloque'>
                                <label class="control-label col-sm-2">Insumo<span class="text-danger" title="Este campo es requerido">*</span></label>
                                <div class="col-sm-10">
                                    <div id='detalledelprocesosupply_id' class="input-group">
                                        <input type="hidden" class="input-id">
                                        <input type="hidden" class="input-id-2">
                                        <input type="text" class="form-control input-label required" readonly>
                                        <span class="input-group-btn">
                                            <button id="escogerdatoi" class="btn btn-primary" onclick="showModaldetalledelprocesosupply_id()" type="button"><i class='fa fa-search'></i> Escoger Dato</button>
                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                    <div id='modal-datamodal-detalledelprocesosupply_id' class="modal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog  " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title"><i class='fa fa-search'></i> Escoger Insumo </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <iframe id='iframe-modal-detalledelprocesosupply_id' style="border:0;height: 430px;width: 100%" src=""></iframe>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                </div>
                            </div>
                            &nbsp;
                            <div class='form-group bloque'>
                                <label class="control-label col-sm-2">Stock</label>
                                <div class="col-sm-10">
                                    <input id='detalledelprocesostock' type='text' name='child-stock' class='form-control' readonly/>
                                </div>
                            </div>
                            &nbsp;
                            <div class='form-group bloque'>
                                <label class="control-label col-sm-2">Cantidad<span class="text-danger" title="Este campo es requerido">*</span></label>
                                <div class="col-sm-10">
                                    <input id='detalledelprocesoquantity' type='text' name='child-quantity' class='form-control required' maxlength="10"/>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer" align="right">
                            <input type='button' class='btn btn-default' id="btn-reset-form-detalledelprocesoi" onclick="resetFormdetalledelprocesoi()" value='Resetear'/>
                           <!-- <input type='button' id='btn-add-table-detalledelprocesoi' class='btn btn-primary' onclick="addToTabledetalledelprocesoi()" value='Agregar a la Tabla'/>-->
                           <input type='submit' id='btn-add-table-detalledelprocesoi' class='btn btn-primary' value='Agregar a la Tabla'/>
                        </div>
                    </form>
                </div>
            </div>
    
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class='fa fa-table'></i> Insumos asignados
                </div>
                <div class="panel-body no-padding table-responsive" style="max-height: 400px;overflow: auto;">
                    <table id='table-detalledelprocesoi' class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>Insumo</th>
                                <th>Stock</th>
                                <th>Cantidad</th>
                                <th width="90px">Acci??n</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($supplies)>0)
                                @foreach ($supplies as $s)
                                    <tr>
                                        <td class='supply_id'>
                                            <span class='td-label'> {{$s->supply}} </span>
                                            <input type='hidden' name='detalledelproceso-supply_id[]' value=' {{$s->supply_id}}'/>
                                            <input type='hidden' class="detail_id" name='detalledelproceso-supply_detail_id[]' value='{{$s->id}}'/>
                                        </td>
                                        <td class='stock'> {{$s->stock}}
                                            <input type='hidden' name='detalledelproceso-stock[]' value='{{$s->stock}}'/>
                                        </td>
                                        <td class='quantity'> {{$s->quantity}} 
                                            <input type='hidden' name='detalledelproceso-quantity[]' value='{{$s->quantity}}'/>
                                        </td>
                                        <td>
                                            <a href='javascript:void(0)' onclick='editRowdetalledelprocesoi(this)' class='btn btn-warning btn-xs' title='Editar insumo'><i class='fa fa-pencil'></i></a>
                                            <a href='javascript:void(0)' onclick='deleteRowdetalledelprocesoi(this)' class='btn btn-danger btn-xs' title='Eliminar insumo'><i class='fa fa-trash'></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="trNull">
                                    <td colspan="6" align="center">No tenemos datos disponibles</td>
                                </tr>                                    
                      
                            @endif



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>       
   
    <div id='panel-form-detalledelprocesot' class="panel panel-default">
        <div class="panel-heading">
            <strong>IV. Tareas</strong>
        </div>
        <div class="panel-body">
            <div class='row'>
                <div class='col-sm-10'>
                    <form id="add-task" class="panel panel-default">
                        @csrf
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-pencil-square-o"></i> Formulario
                            </div>
                            <div class="panel-body child-form-area">
                                <div class='form-group bloque'>
                                    <label class="control-label col-sm-2">Responsable<span class="text-danger" title="Este campo es requerido">*</span></label>
                                    <div class="col-sm-10">
                                        <div id='detalledelprocesouser_id' class="input-group">
                                            <input type="hidden" class="input-id">
                                            <input type="hidden" class="input-id-2">
                                            <input type="text" class="form-control input-label required" readonly>
                                            <span class="input-group-btn">
                                                <button id="escogerdatot" class="btn btn-primary" onclick="showModaldetalledelprocesouser_id()" type="button"><i class='fa fa-search'></i> Escoger Dato</button>
                                            </span>
                                        </div>
                                        <!-- /input-group -->
                                        <div id='modal-datamodal-detalledelprocesouser_id' class="modal" tabindex="-1" role="dialog">
                                            <div class="modal-dialog  " role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h4 class="modal-title"><i class='fa fa-search'></i> Escoger responsable de la tarea </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <iframe id='iframe-modal-detalledelprocesouser_id' style="border:0;height: 430px;width: 100%" src=""></iframe>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    </div>
                                </div>
                                &nbsp;
                                <div class='form-group bloque'>
                                    <label class="control-label col-sm-2">Tarea<span class="text-danger" title="Este campo es requerido">*</span></label>
                                    <div class="col-sm-10">
                                        <input id='detalledelprocesotitle' type='text' name='child-title' class='form-control required' maxlength="100"/>
                                    </div>
                                </div>
                                &nbsp;
                                <div class='form-group bloque'>
                                    <label class="control-label col-sm-2">Descripci??n</label>
                                    <div class="col-sm-10">
                                        <input id='detalledelprocesodescription' type='text' name='child-description' class='form-control' maxlength="500"/>
                                    </div>
                                </div>
                                <input type="hidden" id="detalledelprocesocheck" value="false">
                            </div>
                            <div class="panel-footer" align="right">
                                <input type='button' class='btn btn-default' id="btn-reset-form-detalledelprocesot" onclick="resetFormdetalledelprocesot()" value='Resetear'/>
                                <!--<input type='button' id='btn-add-table-detalledelprocesot' class='btn btn-primary' onclick="addToTabledetalledelprocesot()" value='Agregar a la Tabla'/>-->
                                <input type='submit' id='btn-add-table-detalledelprocesot' class='btn btn-primary' value='Agregar a la Tabla'/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class='fa fa-table'></i> Tareas registradas
                </div>
                <div class="panel-body no-padding table-responsive" style="max-height: 400px;overflow: auto;">
                    <table id='table-detalledelprocesot' class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>Tarea</th>
                                <th>Responsable</th>
                                <th>Descripci??n</th>
                                <th>Terminada</th>
                                <th>Fecha de t??rmino</th>
                                <th width="100px">Acci??n</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($tasks)>0)
                                @foreach ($tasks as $t)
                                <tr>
                                        <td class='title'> {{$t->title}}
                                            <input type='hidden' name='detalledelproceso-title[]' value='{{$t->title}}'/>
                                        </td>
                                        <td class='user_id'>
                                            <span class='td-label'> {{$t->responsable}} </span>
                                            <input type='hidden' name='detalledelproceso-user_id[]' value=' {{$t->user_id}}'/>
                                            <input type='hidden' class="task_detail_id" name='detalledelproceso-task_detail_id[]' value='{{$t->id}}'/>
                                        </td>
                                        <td class='description'> {{$t->description}} 
                                            <input type='hidden' name='detalledelproceso-description[]' value='{{$t->description}}'/>
                                        </td>
                                        <td class='finished'>
                                            @if ($t->finished == 1)
                                                Si
                                            @else
                                                No
                                            @endif
                                            <input type='hidden' class='checkval' name='detalledelproceso-finished[]' value='{{$t->finished}}'/>
                                        </td>
                                        <td class='finish_date'> {{$t->finish_date}} 
                                            <input type='hidden' name='detalledelproceso-finish_date[]' value='{{$t->finish_date}}'/>
                                        </td>                                        
                                        <td>
                                            <a href='javascript:void(0)' onclick='editRowdetalledelprocesot(this)' class='btn btn-warning btn-xs' title='Editar tarea'><i class='fa fa-pencil'></i></a>
                                                @if ($t->finished == 1)
                                                    <a href='javascript:void(0)' onclick='finishedRowdetalledelprocesot(this)' class='btn btn-info btn-xs' title='Reactivar tarea'><i class='fa fa-rotate-left'></i></a>
                                                @else
                                                    <a href='javascript:void(0)' onclick='finishedRowdetalledelprocesot(this)' class='btn btn-success btn-xs' title='Terminar tarea'><i class='fa fa-check'></i></a>
                                                @endif                                            
                                            <a href='javascript:void(0)' onclick='deleteRowdetalledelprocesot(this)' class='btn btn-danger btn-xs' title='Eliminar tarea'><i class='fa fa-trash'></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="trNullt">
                                    <td colspan="6" align="center">No tenemos datos disponibles</td>
                                </tr>                                    
                    
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    

   
    <div id='panel-form-detalledelprocesop' class="panel panel-default">
        <div class="panel-heading">
            <strong>V. Proveedores de servicio</strong>
        </div>
        <div class="panel-body">
            <div class='row'>
                <div class='col-sm-10'>
                    <form id="add-provider-detail" class="panel panel-default">
                        @csrf
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-pencil-square-o"></i> Formulario
                            </div>
                            <div class="panel-body child-form-area">
                                <div class='form-group bloque'>
                                    <label class="control-label col-sm-2">Proveedor<span class="text-danger" title="Este campo es requerido">*</span></label>
                                    <div class="col-sm-10">
                                        <div id='detalledelprocesoprovider_id' class="input-group">
                                            <input type="hidden" class="input-id">
                                            <input type="hidden" class="input-id-2">
                                            <input type="text" class="form-control input-label required" readonly>
                                            <span class="input-group-btn">
                                                <button id="escogerdatop" class="btn btn-primary" onclick="showModaldetalledelprocesoprovider_id()" type="button"><i class='fa fa-search'></i> Escoger Dato</button>
                                            </span>
                                        </div>
                                        <!-- /input-group -->
                                        <div id='modal-datamodal-detalledelprocesoprovider_id' class="modal" tabindex="-1" role="dialog">
                                            <div class="modal-dialog  " role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h4 class="modal-title"><i class='fa fa-search'></i> Escoger proveedor de servicio a asignar </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <iframe id='iframe-modal-detalledelprocesoprovider_id' style="border:0;height: 430px;width: 100%" src=""></iframe>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    </div>
                                </div>
                                &nbsp;
                                <div class='form-group bloque'>
                                    <label class="control-label col-sm-2">Servicio<span class="text-danger" title="Este campo es requerido">*</span></label>
                                    <div class="col-sm-10">
                                        <input id='detalledelprocesoservice' type='text' name='child-service' class='form-control required' maxlength="50"/>
                                    </div>
                                </div>
                                &nbsp;
                                <div class='form-group bloque'>
                                    <label class="control-label col-sm-2">Descripci??n</label>
                                    <div class="col-sm-10">
                                        <input id='detalledelprocesopdescription' type='text' name='child-description' class='form-control' maxlength="100"/>
                                    </div>
                                </div>
                                &nbsp;
                                <div class='form-group bloque'>
                                    <label class="control-label col-sm-2">Costo del servicio</label>
                                    <div class="col-sm-10">
                                        <input id='detalledelprocesocost' type='text' name='child-cost' class='form-control'/>
                                    </div>
                                </div>

                            </div>
                            <div class="panel-footer" align="right">
                                <input type='button' class='btn btn-default' id="btn-reset-form-detalledelprocesop" onclick="resetFormdetalledelprocesop()" value='Resetear'/>
                                <!--<input type='button' id='btn-add-table-detalledelprocesop' class='btn btn-primary' onclick="addToTabledetalledelprocesop()" value='Agregar a la Tabla'/>-->
                                <input type='submit' id='btn-add-table-detalledelprocesop' class='btn btn-primary' value='Agregar a la Tabla'/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class='fa fa-table'></i> Proveedores de servicio asignados
                </div>
                <div class="panel-body no-padding table-responsive" style="max-height: 400px;overflow: auto;">
                    <table id='table-detalledelprocesop' class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>Proveedor</th>
                                <th>Servicio</th>
                                <th>Descripci??n</th>
                                <th>Costo</th>
                                <th width="100px">Acci??n</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($providers)>0)
                                @foreach ($providers as $p)
                                    <tr>
                                        <td class='provider_id'> 
                                            <span class='td-label'>{{$p->business_name}}</span>
                                            <input type='hidden' name='detalledelproceso-provider_id[]' value=' {{$p->provider_id}}'/>
                                            <input type='hidden' class="provider_detail_id" name='detalledelproceso-provider_detail_id[]' value='{{$p->id}}'/>
                                        </td>
                                        <td class='service'> {{$p->service}} 
                                            <input type='hidden' name='detalledelproceso-service[]' value='{{$p->service}}'/>
                                        </td>
                                        <td class='pdescription'> {{$p->description}} 
                                            <input type='hidden' name='detalledelproceso-pdescription[]' value='{{$p->description}}'/>
                                        </td>
                                        <td class='cost'> {{$p->cost}} 
                                            <input type='hidden' name='detalledelproceso-cost[]' value='{{$p->cost}}'/>
                                        </td>
                                        <td>
                                            <a href='javascript:void(0)' onclick='editRowdetalledelprocesop(this)' class='btn btn-warning btn-xs' title='Editar proveedor'><i class='fa fa-pencil'></i></a>
                                            <a href='javascript:void(0)' onclick='deleteRowdetalledelprocesop(this)' class='btn btn-danger btn-xs' title='Eliminar proveedor'><i class='fa fa-trash'></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="trNullt">
                                    <td colspan="6" align="center">No tenemos datos disponibles</td>
                                </tr>                                    
                    
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    

    <div class="panel panel-default">
        <div class="panel-footer">
            
            <a href="{{ url('/admin/resources') }}" class="btn btn-primary" >Regresar</a>
        </div>
    </div>             
@endsection