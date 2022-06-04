@extends('crudbooster::admin_template')
@section('content')

    <input type="hidden" name="editar" id="editar" value="{{$editar}}">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>I. Datos principales la compra</strong> 
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>Tipo de documento</label>
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control" name="doc_type" id="doc_type" value="{{$row->doc_type}}" required>
                                <option value="">** Por favor seleccione un pedido **</option>
                                <option value="0" @if ($row->doc_type==0) selected @endif>No precisa </option>
                                <option value="1" @if ($row->doc_type==1) selected @endif>Boleta</option>
                                <option value="2" @if ($row->doc_type==2) selected @endif>Factura</option>
                            </select>
                            <input type="hidden" name="purchase_id" id="purchase_id" value="{{$row->id}}">
                        </div>
                    </div>                        
                </div>
            </div>
            <p></p>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label">N° de documento</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" readonly name="document" class="form-control" id="document" value="{{$row->document}}"> 
                        </div>
                    </div>
                </div>
            </div>
            <p></p>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>Fecha de compra</label>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon open-datetimepicker">
                                    <a>
                                        <i class="fa fa-calendar">
                                        </i>
                                    </a>
                                </span>
                                <input type="text" readonly required name="purchase_date" id="purchase_date" class="form-control" value="{{date('d-m-Y', strtotime($row->purchase_date))}}"> 
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
                            <label>Proveedor</label>
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control" name="purchase_id" id="purchase_id" value="{{$row->provider_id}}" required>
                                <option value="">** Selecciona un proveedor **</option>
                                @foreach ($providers as $p)
                                    <option value="{{$p->id}}" @if ($p->id==$row->provider_id) selected @endif>{{$p->business_name}}</option>    
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id='panel-form-detalledelacompra' class="panel panel-default">
        <div class="panel-heading">
            <strong>II. Detalle de la compra</strong>
        </div>
        <div class="panel-body">
            <div class='row'>
                <div class='col-sm-10'>
                    <form id="add-purchase-detail" class="panel panel-default">
                        @csrf
                        <div class="panel-heading">
                            <i class="fa fa-pencil-square-o"></i> Formulario
                        </div>
                        <div class="panel-body child-form-area">
                            <div class='form-group bloque'>
                                <label class="control-label col-sm-2">Insumos<span class="text-danger" title="Este campo es requerido">*</span></label>
                                <div class="col-sm-10">
                                    <div id='detalledelacomprasupply_id' class="input-group">
                                        <input type="hidden" class="input-id">
                                        <input type="hidden" class="input-id-2">
                                        <input type="text" class="form-control input-label required" readonly>
                                        <span class="input-group-btn">
                                            <button id="escogerdato" class="btn btn-primary" onclick="showModaldetalledelacomprasupply_id()" type="button"><i class='fa fa-search'></i> Escoger Dato</button>
                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                    <div id='modal-datamodal-detalledelacomprasupply_id' class="modal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog  " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title"><i class='fa fa-search'></i> Escoger Insumo </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <iframe id='iframe-modal-detalledelacomprasupply_id' style="border:0;height: 430px;width: 100%" src=""></iframe>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                </div>
                            </div>
                            &nbsp;
                            <div class='form-group bloque'>
                                <label class="control-label col-sm-2">Precio S/<span class="text-danger" title="Este campo es requerido">*</span></label>
                                <div class="col-sm-10">
                                    <input id='detalledelacompraprice' type='text' name='child-price' class='form-control'/>
                                </div>
                            </div>
                            &nbsp;
                            <div class='form-group bloque'>
                                <label class="control-label col-sm-2">Cantidad<span class="text-danger" title="Este campo es requerido">*</span></label>
                                <div class="col-sm-10">
                                    <input id='detalledelacompraquantity' type='text' name='child-quantity' class='form-control required' maxlength="10"/>
                                </div>
                            </div>
                            &nbsp;
                            <div class='form-group bloque'>
                                <label class="control-label col-sm-2">Sub Total S/<span class="text-danger" title="Este campo es requerido">*</span></label>
                                <div class="col-sm-10">
                                    <input id='detalledelacomprasubtotal' type='number' name='child-subtotal' class='form-control required' readonly />
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer" align="right">
                            <input type='button' class='btn btn-default' id="btn-reset-form-detalledelacompra" onclick="resetFormdetalledelacompra()" value='Resetear'/>
                           <!-- <input type='button' id='btn-add-table-detalledelacompra' class='btn btn-primary' onclick="addToTabledetalledelacompra()" value='Agregar a la Tabla'/>-->
                           <input type='submit' id='btn-add-table-detalledelacompra' class='btn btn-primary' value='Agregar a la Tabla'/>
                        </div>
                    </form>
                </div>
            </div>
    
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class='fa fa-table'></i> Detalle de la compra
                </div>
                <div class="panel-body no-padding table-responsive" style="max-height: 400px;overflow: auto;">
                    <table id='table-detalledelacompra' class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>Insumo</th>
                                <th>Precio S/</th>
                                <th>Cantidad</th>
                                <th>Sub Total S/</th>
                                <th width="90px">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($supplies)>0)
                                @foreach ($supplies as $s)
                                    <tr>
                                        <td class='supply_id'>
                                            <span class='td-label'> {{$s->supply}} </span>
                                            <input type='hidden' name='detalledelacompra-supply_id[]' value=' {{$s->supply_id}}'/>
                                            <input type='hidden' class="detail_id" name='detalledelacompra-supply_detail_id[]' value='{{$s->id}}'/>
                                        </td>
                                        <td class='price'> {{$s->price}}
                                            <input type='hidden' name='detalledelacompra-price[]' value='{{$s->price}}'/>
                                        </td>
                                        <td class='quantity'> {{$s->quantity}} 
                                            <input type='hidden' name='detalledelacompra-quantity[]' value='{{$s->quantity}}'/>
                                        </td>
                                        <td class='subtotal'> {{$s->subtotal}} 
                                            <input type='hidden' name='detalledelacompra-subtotal[]' value='{{$s->subtotal}}'/>
                                        </td>
                                        <td>
                                            <a href='javascript:void(0)' onclick='editRowdetalledelacompra(this)' class='btn btn-warning btn-xs' title='Editar detalle'><i class='fa fa-pencil'></i></a>
                                            <a href='javascript:void(0)' onclick='deleteRowdetalledelacompra(this)' class='btn btn-danger btn-xs' title='Eliminar detalle'><i class='fa fa-trash'></i></a>
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

            <div class="form-group header-group-0 " id="form-group-total" style="">
                <label class="control-label col-sm-2">Total S/
                    <span class='text-danger' title='Este campo es requerido'>*</span>
                </label>
            
                <div class="col-sm-2">
                    <input type="text" title="Total S/" required readonly class="form-control inputMoney"
                           name="total" id="total" value="{{$row->total}}">
                    <div class="text-danger"></div>
                    <p class="help-block"></p>
                </div>
            </div>
        </div>
    </div>         
   

    <div class="panel panel-default">
        <div class="panel-footer">
            
            <a href="{{ url('/admin/purchases') }}" class="btn btn-primary" >Regresar</a>
        </div>
    </div>             
@endsection