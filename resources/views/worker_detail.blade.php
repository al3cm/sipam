@extends('crudbooster::admin_template')
@section('content')


    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>I. Datos personales</strong> 
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>Tipo doc.</label>
                        </div>
                        <div class="col-sm-6">
                            @if ($row->id_type==1)
                                <input type="text" readonly name="id_type" class="form-control" value="DNI"> 
                            @else
                                @if ($row->id_type==2)
                                    <input type="text" readonly name="id_type" class="form-control" value="Carnet de extranjería"> 
                                @else    
                                    <input type="text" readonly name="id_type" class="form-control" value=""> 
                                @endif
                            @endif
                        </div>
                    </div>                        
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label>Nro. Documento</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" readonly name="id_number" class="form-control" value="{{$row->id_number}}">     
                        </div>
                    </div>
                </div>
            </div>
            <p></p>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label">Nombre</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" readonly name="name" class="form-control" id="name" value="{{$row->name}}"> 
                        </div>
                    </div>
                </div>
            </div>
            <p></p>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label">Nacionalidad</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" readonly name="nacionality" class="form-control" id="nacionality" value="{{$row->nacionality}}"> 
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label>Género</label>
                        </div>
                        <div class="col-sm-6">
                            @if ($row->gender==1)
                                <input type="text" readonly name="gender" class="form-control" value="Masculino"> 
                            @else
                                @if ($row->gender==2)
                                    <input type="text" readonly name="gender" class="form-control" value="Femenino"> 
                                @else
                                    <input type="text" readonly name="gender" class="form-control" value="No precisa">     
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <p></p>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>Fecha Nac.</label>
                        </div>
                        <div class="col-sm-6">
                            @if ($row->dob)
                                <input type="text" readonly name="dob" class="form-control" id="dob" value="{{ date("d/m/Y",strtotime($row->dob)) }}"> 
                            @else
                                <input type="text" readonly name="dob" class="form-control" id="dob" value=""> 
                            @endif
                        </div>
                    </div>                                          
                </div>
            </div>
           
        </div>
    </div>
   
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>II. Datos de contacto y otros</strong> 
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>E-mail</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" readonly name="email" class="form-control" value="{{$row->email}}"> 
                        </div>
                    </div>                        
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label class="control-label">Teléfono</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" readonly name="phone" class="form-control" id="phone" value="{{$row->phone}}"> 
                        </div>
                    </div>
                </div>
            </div>
            <p></p>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label">E-mail personal</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" readonly name="personal_email" class="form-control" id="personal_email" value="{{$row->personal_email}}"> 
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
                        <div class="col-sm-8">
                            <input type="text" readonly name="address" class="form-control" id="address" value="{{$row->address}}"> 
                        </div>
                    </div>                                          
                </div>
            </div>
            <p></p>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>Pago mensual</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" readonly name="salary" class="form-control" id="salary" value="S/ {{$row->salary}}"> 
                        </div>      
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id='panel-form-detalledelprocesot' class="panel panel-default">
        <div class="panel-heading">
            <strong>III. Tareas pendientes</strong>
        </div>
        <div class="panel-body">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class='fa fa-table'></i> Tareas
                </div>
                <div class="panel-body no-padding table-responsive" style="max-height: 400px;overflow: auto;">
                    <table id='table-detalledelprocesot' class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>Tarea</th>
                                <th>Descripción</th>
                                <th>Pedido</th>
                                <th>Cliente</th>
                                <th>Fecha límite</th>
                                <th>Avance del proceso</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($tasks)>0)
                                @foreach ($tasks as $t)
                                <tr>
                                        <td class='title'> {{$t->t_title}} </td>
                                        <td class='description'> {{$t->t_description}} </td>
                                        <td class='order'> Pedido N° {{str_pad($t->o_id,4,"0",STR_PAD_LEFT)}} </td>
                                        <td class='customer'> {{$t->c_business_name}} </td>
                                        <td class='deadline'> {{date("d/m/Y",strtotime($t->p_deadline))}} </td>
                                        <td class='advance'> {{$t->p_advance}} %</td>
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
            
            <a href="{{ url('/admin/workers') }}" class="btn btn-primary" >Regresar</a>
        </div>
    </div>             
@endsection