@extends('crudbooster::admin_template')
@section('content')

<form method="POST" action="{{CRUDBooster::mainpath('add-save')}}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="state" id="state" value="1">
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
                            <select class="form-control" name="order_id" id="order_id" required>
                                <option value="">** Por favor seleccione un pedido **</option>
                                @foreach ($orders as $o)
                                    <option value="{{$o->id}}">Pedido {{$o->id}}</option>    
                                @endforeach
                            </select>
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
                                <input type="text" readonly required class="form-control notfocus input_date" name="start_date" id="start_date">
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
                            <input type="text" readonly name="customer_name" class="form-control" id="customer_name"> 
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>Límite</label>
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon open-datetimepicker">
                                    <a>
                                        <i class="fa fa-calendar">
                                        </i>
                                    </a>
                                </span>
                                <input type="text" readonly required class="form-control notfocus input_date" name="deadline" id="deadline">
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
                            <label class="control-label">Razón Social</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" readonly name="customer_business_name" class="form-control" id="customer_business_name"> 
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
                            <input type="text" readonly name="customer_document_number" class="form-control" id="customer_document_number"> 
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>RUC</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" readonly name="customer_ruc" class="form-control" id="customer_ruc"> 
                        </div>
                    </div>
                </div>
            </div>
            <p></p>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>Dirección</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" readonly name="customer_address" class="form-control" id="customer_address"> 
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
                            <input type="text" readonly name="customer_email" class="form-control" id="customer_email"> 
                        </div>      
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>Teléfono</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" readonly name="customer_phone_number" class="form-control" id="customer_phone_number"> 
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
                            <input type="text" readonly required name="order_date" id="order_date" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label>Fecha de entrega</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" readonly required name="delivery_date" id="delivery_date" class="form-control"> 
                        </div>
                    </div>                    
                </div>
            </div>
            <p></p>
            <div id="detalle-pedido">

            </div>
            <div class="form-group">
                <input type="hidden" name="batch" id="batch">
            </div>        
        </div>
    </div>    
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>III. Avance productivo</strong>
        </div>
        <div class="panel-body">
            <div class="col-sm-12">
                <table width="100%" border="1" style="border: 1px solid #c1bdbd;">
                    <tr>
                        <th class="cen gris">Fases</th>
                        <th class="cen gris">Prendas</th>
                        <th class="cen gris">Total de prendas</th>
                        <th class="cen gris">% de avance</th>
                    </tr>
                    <tr>
                        <th>1. Fase de corte</th>
                        <td class="cen">
                            <input id="can0" name="cutting_batch" type="text" class="an70 cen" value="0">
                            <input id="acan0" type="hidden" value="0">
                        </td>
                        <td class="cen"><label class="margen0" id="tcan0"></label></td>
                        <td class="cen"><label class="margen0"id="pcan0"></label></td>
                    </tr>
                    <tr>
                        <th>2. Fase de habilitado</th>
                        <td class="cen">
                            <input id="can1" name="enabled_batch" type="text" class="an70 cen" value="0">                            
                            <input id="acan1" type="hidden" value="0">
                        </td>
                        <td class="cen"><label class="margen0" id="tcan1"></label></td>
                        <td class="cen"><label class="margen0" id="pcan1"></label></td>                    
                    </tr>
                    <tr>
                        <th>3. Fase de confección</th>     
                        <td class="cen">
                            <input id="can2" name="confection_batch" type="text" class="an70 cen" value="0">                               
                            <input id="acan2" type="hidden" value="0">                        
                        </td>
                        <td class="cen"><label class="margen0" id="tcan2"></label></td>
                        <td class="cen"><label class="margen0" id="pcan2"></label></td>               
                    </tr>
                    <tr>
                        <th>4. Fase de acabado</th>
                        <td class="cen">
                            <input id="can3" name="finishing_batch" type="textarea" class="an70 cen" value="0">                               
                            <input id="acan3" type="hidden" value="0">                             
                        </td>
                        <td class="cen"><label class="margen0" id="tcan3"></label></td>
                        <td class="cen"><label class="margen0" id="pcan3"></label></td>                    
                    </tr>
                    <tr class="gris">
                        <th class="cen" colspan="3">% Total de avance productivo</th>
                        <td class="cen">
                            <label name="t_advance" class="margen0 negrita" id="t_advance"></label>
                            <input type="hidden" name="advance" id="advance">
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>   
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>IV. Comentarios</strong>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <textarea rows="2" cols="50" name="notes" id="notes" style="width:100%;"></textarea>
            </div>
        </div>
    </div>  
    <div class="panel panel-default">
        <div class="panel-footer">
            <input type="submit" class="btn btn-primary" value="Grabar">
        </div>
    </div>             
</form>
@endsection