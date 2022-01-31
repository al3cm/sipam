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
                            <label class="control-label">Razón Social</label>
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
                            <label>Dirección</label>
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
                            <label>Teléfono</label>
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
                        <th class='cen gris'>Género</th>
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
                </table>
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
                            <input id="can0" readonly name="cutting_batch" type="text" class="an70 cen" value="{{$row->cutting_batch}}">
                        </td>
                        <td class="cen"><label class="margen0" id="tcan0" value="{{$total_prendas}}">{{$total_prendas}}</label></td>
                        <td class="cen"><label class="margen0"id="pcan0">{{round((($row->cutting_batch / $total_prendas)*100)/4,2)}} %</label></td>
                    </tr>
                    <tr>
                        <th>2. Fase de habilitado</th>
                        <td class="cen">
                            <input id="can1" readonly name="enabled_batch" type="text" class="an70 cen" value="{{$row->enabled_batch}}">                            
                        </td>
                        <td class="cen"><label class="margen0" id="tcan1" value="{{$total_prendas}}">{{$total_prendas}}</label></td>
                        <td class="cen"><label class="margen0" id="pcan1">{{round((($row->enabled_batch / $total_prendas)*100)/4,2)}} %</label></td>                    
                    </tr>
                    <tr>
                        <th>3. Fase de confección</th>     
                        <td class="cen">
                            <input id="can2" readonly name="confection_batch" type="text" class="an70 cen" value="{{$row->confection_batch}}">                               
                        </td>
                        <td class="cen"><label class="margen0" id="tcan2" value="{{$total_prendas}}">{{$total_prendas}}</label></td>
                        <td class="cen"><label class="margen0" id="pcan2">{{round((($row->confection_batch / $total_prendas)*100)/4,2)}} %</label></td>               
                    </tr>
                    <tr>
                        <th>4. Fase de acabado</th>
                        <td class="cen">
                            <input id="can3" readonly name="finishing_batch" type="textarea" class="an70 cen" value="{{$row->finishing_batch}}">                               
                        </td>
                        <td class="cen"><label class="margen0" id="tcan3" value="{{$total_prendas}}">{{$total_prendas}}</label></td>
                        <td class="cen"><label class="margen0" id="pcan3">{{round((($row->finishing_batch / $total_prendas)*100)/4,2)}} %</label></td>                    
                    </tr>
                    <tr class="gris">
                        <th class="cen" colspan="3">% Total de avance productivo</th>
                        <td class="cen">
                            <label name="t_advance" class="margen0 negrita" id="t_advance">{{$row->advance}} %</label>
                            <input type="hidden" name="advance" id="advance" value="{{$row->advance}}">
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
                <textarea readonly rows="2" cols="50" name="notes" id="notes" style="width:100%;">{{$row->notes}}</textarea>
            </div>
        </div>
    </div>  
    <div class="panel panel-default">
        <div class="panel-footer">
            
            <a href="{{ url('/admin/processes') }}" class="btn btn-primary" >Regresar</a>
        </div>
    </div>             

@endsection