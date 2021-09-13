@extends('crudbooster::admin_template')
@section('content')

<style type="text/css">
                    
    .der {text-align:right;} 
    .izq {text-align:left;} 
    .cen {text-align:center;} 
    label {font-weight: normal;} 
    .edita{width:70px; text-align:center} 
    .panel-default>.panel-heading {font-weight: bold;}
    .gris {background-color: #eeeeee;}
    .flota1 {float: right; margin-top: -5px;}
    .margen1 {margin: 5px;}
    .margen2 {margin: 0px 8px 0px 8px;}
    .margen3 {margin: 0px 10px 0px 10px;}
    .pad0808 {padding: 0px 8px 0px 8px;}
    .an5 {width:5%}
    .an7 {width:7%}
    .an8 {width:8%}
    .an10 {width:10%}
    .an15 {width:15%}
    .an20 {width:20%}
    .an25 {width:25%}
    .an35 {width:35%}
    .an50 {width:50%}
    .dlin {display:inline}
    .filacel {background-color: aliceblue}
    .tabla {border: 1px solid #c1bdbd;border-width: 1px}
</style>
<form method="POST" action="{{CRUDBooster::mainpath('add-save')}}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="state" id="state" value="1">
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
                            <input type="text" readonly name="customer_name" class="form-control"> 
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
                            <input type="text" readonly name="customer_business_name" class="form-control"> 
                        </div>
                    </div>
                </div>
            </div>
            <p></p>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>DNI</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" readonly name="customer_document_number" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>RUC</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" readonly name="customer_ruc" class="form-control"> 
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
                            <input type="text" readonly name="customer_address" class="form-control"> 
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
                            <input type="text" readonly name="customer_email" class="form-control"> 
                        </div>      
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>Teléfono</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" readonly name="customer_phone_number" class="form-control"> 
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
                            <input type="text" readonly name="order_date" id="order_date" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label>Fecha de entrega</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" readonly name="delivery_date" class="form-control"> 
                        </div>
                    </div>                    
                </div>
            </div>
            <p></p>
            <table width="100%" border="1" style="border: 1px solid #c1bdbd;">
                <tr>
                    <th class="cen gris">Prenda</th>
                    <th class="cen gris">Género</th>
                    <th class="cen gris">Talla</th>
                    <th class="cen gris">Color</th>
                    <th class="cen gris">Material</th>
                    <th class="cen gris">Cantidad</th>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <p></p>
            <div class="form-group">
                <div class="col-sm-2">
                    <label>Total de prendas</label>
                </div>
                <div class="col-sm-2">
                    <input type="text" readonly name="total_garments" class="form-control"> 
                </div>
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
                            <input id="can0" name="cutting_batch" type="text" class="an70 cen" value="0" onchange="calculaMin(0)" onkeypress="return esEntero(event)">
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>2. Fase de habilitado</th>
                        <td class="cen">
                            <input id="can1" name="enabled_batch" type="text" class="an70 cen" value="0" onchange="calculaMin(0)" onkeypress="return esEntero(event)">                            
                        </td>
                        <td></td>
                        <td></td>                    
                    </tr>
                    <tr>
                        <th>3. Fase de confección</th>     
                        <td class="cen">
                            <input id="can1" name="confection_batch" type="text" class="an70 cen" value="0" onchange="calculaMin(0)" onkeypress="return esEntero(event)">                               
                        </td>
                        <td></td>
                        <td></td>               
                    </tr>
                    <tr>
                        <th>4. Fase de acabado</th>
                        <td class="cen">
                            <input id="can1" name="finishing_batch" type="textarea" class="an70 cen" value="0" onchange="calculaMin(0)" onkeypress="return esEntero(event)">                               
                        </td>
                        <td></td>
                        <td></td>                    
                    </tr>
                    <tr class="gris">
                        <th class="cen" colspan="3">Total</th>
                        <td>
                            <label name="advance"></label>
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
                <textarea rows="2" cols="50" name="notes" style="width:100%;"></textarea>
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