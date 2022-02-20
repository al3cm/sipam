@extends('crudbooster::admin_template')
@section('content')

<form method="POST" action="{{CRUDBooster::mainpath('edit-p-save/'.$order->id)}}" id="formulario">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="enproceso" id="enproceso" value="1">
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
                            <input type="text" readonly name="order_name" class="form-control" value="Pedido {{$order->id}}"> 
                            <input type="hidden" name="order_id" id="order_id" value="{{$order->id}}">
                            <input type="hidden" name="state" id="state" value="{{$order->state}}">
                            <input type="hidden" name="type" id="type" value="{{$order->type}}">
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
                            <input type="hidden" name="customer_id" id="customer_id" value="{{$order->customer_id}}">
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
                <div class="col-sm-4">
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

                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label class="control-label">Fecha límite del proceso productivo</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" readonly required name="deadline" id="deadline" class="form-control" value="{{date('d-m-Y', strtotime($process->deadline))}}"> 
                            <input type="hidden" id="deadline_o" value="{{$process->deadline}}">

                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label>Fecha de entrega (*)</label>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon open-datetimepicker">
                                    <a>
                                        <i class="fa fa-calendar">
                                        </i>
                                    </a>
                                </span>
                                <input type="text" readonly required class="form-control notfocus input_date" name="delivery_date" id="delivery_date" value="{{date('d-m-Y', strtotime($order->delivery_date))}}" >
                                <input type="hidden" id="delivery_date_o" value="{{$order->delivery_date}}">


                            </div>

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

            <p>(*) La fecha de entrega no puede ser menor a la fecha límite de entrega registrado en el proceso productivo</p>     
        </div>
    </div>    

    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>III. Pago del pedido</strong>
        </div>
        <div class="panel-body">
            <div id="pago-pedido">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <label class="control-label">Sub total S/ </label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" readonly name="subtotal" class="form-control" id="subtotal" value="{{$order->subtotal}}"> 
                            </div>
                        </div>
                    </div>
                </div>
                <p></p>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <label class="control-label">Impuesto S/ </label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" readonly name="tax" class="form-control" id="tax" value="{{$order->tax}}"> 
                            </div>
                        </div>
                    </div>
                </div>
                <p></p>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <label class="control-label">Total S/ </label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" readonly name="total" class="form-control" id="total" value="{{$order->total}}"> 
                            </div>
                        </div>
                    </div>
                </div>
                <p></p>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <label class="control-label">Pago S/ </label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" name="advance_payment" class="form-control" id="advance_payment" value="{{$order->advance_payment}}"> 
                                <input type="hidden" name="a_advance_payment" class="form-control" id="a_advance_payment" value="{{$order->advance_payment}}"> 
                            </div>
                        </div>
                    </div>
                </div>
                <p></p>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <label class="control-label">Pago restante S/ </label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" readonly name="pending_payment" class="form-control" id="pending_payment" value="{{$order->pending_payment}}"> 
                            </div>
                        </div>
                    </div>
                </div>



            </div>
      
        </div>
    </div>  
    
    <div class="panel panel-default">
        <div class="panel-footer">
            <input type="button" class="btn btn-primary" value="Grabar" id="grabar">
            <input type="button" class="btn btn-success" id="grabarfinalizar" value="Grabar y Finalizar pedido">
        </div>
    </div>             
</form>
@endsection