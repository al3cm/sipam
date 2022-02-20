<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use Carbon\Carbon;
use SebastianBergmann\Environment\Console;

class AdminProcessesController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = true;
			$this->table = "processes";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"N° de Pedido","name"=>"order_id","join"=>"orders,id"];
			$this->col[] = ["label"=>"Fecha de inicio","name"=>"start_date"];
			$this->col[] = ["label"=>"Cantidad de prendas","name"=>"batch"];
			$this->col[] = ["label"=>"Fecha de entrega","name"=>"deadline"];
			$this->col[] = ["label"=>"% de Avance","name"=>"advance"];
			$this->col[] = ["label"=>"Fecha de fin","name"=>"finish_date"];
			$this->col[] = ["label"=>"Estado","name"=>"state"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Pedido','name'=>'order_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-2','datatable'=>'orders,id'];
			$this->form[] = ['label'=>'Fecha de inicio','name'=>'start_date','type'=>'date','validation'=>'required','width'=>'col-sm-2',"callback_php"=>'($row->start_date!=null?date("d-m-Y",strtotime($row->start_date)):"")'];
			$this->form[] = ['label'=>'Fecha de entrega','name'=>'deadline','type'=>'date','validation'=>'required','width'=>'col-sm-2',"callback_php"=>'($row->deadline!=null?date("d-m-Y",strtotime($row->deadline)):"")'];
			$this->form[] = ['label'=>'Lote del pedido','name'=>'batch','type'=>'text','validation'=>'integer|min:0','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Lote para corte','name'=>'cutting_batch','type'=>'text','validation'=>'integer|min:0','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Lote para habilitado','name'=>'enabled_batch','type'=>'text','validation'=>'integer|min:0','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Lote para confección','name'=>'confection_batch','type'=>'text','validation'=>'integer|min:0','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Lote para acabado','name'=>'finishing_batch','type'=>'text','validation'=>'integer|min:0','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'% de avance','name'=>'advance','type'=>'double','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Anotaciones','name'=>'notes','type'=>'textarea','validation'=>'min:1|max:500','width'=>'col-sm-5'];
			$this->form[] = ['label'=>'Estado','name'=>'state','type'=>'integer'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Start Date","name"=>"start_date","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"Deadline","name"=>"deadline","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"Finish Date","name"=>"finish_date","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"Batch","name"=>"batch","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Cutting Batch","name"=>"cutting_batch","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Enabled Batch","name"=>"enabled_batch","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Confection Batch","name"=>"confection_batch","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Finishing Batch","name"=>"finishing_batch","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Advance","name"=>"advance","type"=>"money","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Notes","name"=>"notes","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"State","name"=>"state","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Order Id","name"=>"order_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"order,id"];
			# OLD END FORM

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        $this->sub_module = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        $this->addaction = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();

	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();
	                

	        
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button = array();



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          

	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
	        $this->index_statistic = array();



	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = "

			
			$(function(){

				$(document).ready(function() { 
					editar = $('#editar').val();
					console.log('Editar: ' + editar);
					console.log('Cantidad de tareas sin terminar: ' + $('#q_tasks').val());
					if(editar == 0){
						limpiar();
					}else{
						indice_editar = $('#order_id').val();
						console.log('Índice editar: ' + indice_editar);
						
						fecha_pedido=new Date(Date.parse($('#order_date_o').val()+' 00:00:00'));
						fecha_entrega=new Date(Date.parse($('#delivery_date_o').val()+' 00:00:00'));
						

						console.log('Fecha de Hidden Inicio: ' + $('#start_date_o').val());
						fecha_inicio=new Date(Date.parse($('#start_date_o').val()+' 00:00:00'));
						console.log('Fecha de Inicio: ' + fecha_inicio);
						
						var d = fecha_inicio.getDate();
						var m = fecha_inicio.getMonth() + 1;
						var y = fecha_inicio.getFullYear();
						$('#start_date').val((d <= 9 ? '0' + d : d)+'-'+(m<=9 ? '0' + m : m)+'-'+fecha_inicio.getFullYear()); 
					
						$('#start_date').datepicker('setStartDate', fecha_pedido);
						$('#deadline').datepicker('setStartDate', fecha_inicio);								
						console.log('Fecha de control inicio: ' + $('#start_date').val());

						
						fecha_fin=new Date(Date.parse($('#deadline_o').val()+' 00:00:00'));
						d = fecha_fin.getDate();
						m = fecha_fin.getMonth() + 1;
						y = fecha_fin.getFullYear();
						$('#deadline').val((d <= 9 ? '0' + d : d)+'-'+(m<=9 ? '0' + m : m)+'-'+fecha_fin.getFullYear()); 


						$('#start_date').datepicker('setEndDate', fecha_fin);
						$('#deadline').datepicker('setEndDate', fecha_entrega);

						$('#start_date').datepicker('setDate', fecha_inicio);
						$('#deadline').datepicker('setDate', fecha_fin);

						calculaPorcentajes();
					}
				});

				$('#grabar').click(function(){
					$('#formulario').submit();
				});
				
				$('#grabarfinalizar').click(function(){
					if(parseFloat($('#advance').val())<100){
						sweetAlert(\"¡Upss!\", \"No se puede finalizar el proceso productivo hasta encontrarse al 100%\",\"warning\");
						return false;
					}
					if(parseFloat($('#q_tasks').val())>0){
						sweetAlert(\"¡Upss!\", \"No se puede finalizar el proceso productivo hasta terminar todas las tareas asignadas\",\"warning\");
						return false;
					}

					swal({
						title: \"¿Estás seguro de finalizar el proceso productivo?\",
						text: \"Una vez finalizado, no se podrá editar\",
						type: 'warning',
						showCancelButton: true,
						confirmButtonText: 'Si',
						cancelButtonText: 'No',
						reverseButtons: true
					}, function (Finish){
						if (Finish){
							$('#state').val('2');
							$('#formulario').submit();
						}else{
							return false;
						}
					});

				});

				function limpiar(){
	
					$('#start_date').prop('disabled', true);
					$('#deadline').prop('disabled', true);
	
					$('#can0').text(0);
					$('#can1').text(0);
					$('#can2').text(0);
					$('#can3').text(0);
	
					$('#can0').val(0);
					$('#can1').val(0);
					$('#can2').val(0);
					$('#can3').val(0);
	
					$('#can0').prop('disabled', true);
					$('#can1').prop('disabled', true);
					$('#can2').prop('disabled', true);
					$('#can3').prop('disabled', true);
				
					$('#tcan0').text(0);
					$('#tcan1').text(0);
					$('#tcan2').text(0);
					$('#tcan3').text(0);
	
					$('#tcan0').val(0);
					$('#tcan1').val(0);
					$('#tcan2').val(0);
					$('#tcan3').val(0);
	
					$('#pcan0').text(0 + ' %');
					$('#pcan1').text(0 + ' %');
					$('#pcan2').text(0 + ' %');
					$('#pcan3').text(0 + ' %');
	
					$('#t_advance').text(0 + ' %');
					$('#t_advance').val(0);
	
					$('#advance').val(0);
	
					$('#batch').text(0 + ' %');
					$('#batch').val(0);
	
					$('#customer_name').val(''); 
					$('#customer_business_name').val(''); 
					$('#customer_document_number').val(''); 
					$('#customer_ruc').val(''); 
					$('#customer_address').val(''); 
					$('#customer_email').val(''); 
					$('#customer_phone_number').val(''); 
	
					$('#order_date').val('');
					$('#start_date').val('');
					$('#deadline').val('');
					$('#delivery_date').val('');
					
					$('#detalle-pedido').html('');
	
					$('#notes').text('');
					$('#notes').val('');
				}

				
                $('#start_date').on('changeDate',
				function (selected) {
					$('#deadline').datepicker('clearDates');
					$('#deadline').datepicker('setStartDate', $('#start_date').val());
					editar2 = $('#editar').val();
					if(editar2 == 0){
						}
				});

				$('#deadline').on('changeDate',
					function (selected) {
						$('#start_date').datepicker('setEndDate', $('#deadline').val());
						editar2 = $('#editar').val();
						if(editar2 == 0){						
						}
				});

				$('.input_date').datepicker({
					format: 'dd-mm-yyyy',
					todayHighlight: true,
					autoclose: true,						
					language: 'es'
				});

				$('#order_date').text({
					format: 'dd-mm-yyyy',
					todayHighlight: true,
					autoclose: true,						
					language: 'es'
				});

				$('#can0').keypress(function(e){
					return esEntero(e);
				});

				$('#can1').keypress(function(e){
					return esEntero(e);
				});

				$('#can2').keypress(function(e){
					return esEntero(e);
				});
				
				$('#can3').keypress(function(e){
					return esEntero(e);
				});

				$('#can0').blur(function(e){
					if(parseInt($('#can0').val())>parseInt($('#tcan0').val())){
						sweetAlert(\"¡Upss!\", \"El valor no puede ser mayor a la cantidad de bienes\", \"warning\");
						$('#can0').val($('#acan0').val());
						calculaPorcentajes();
						$('#can0').focus();
						return false;
					}else{
						$('#acan0').val($('#can0').val());
						return true;
					}
				});

				$('#can1').blur(function(e){
					if(parseInt($('#can1').val())>parseInt($('#tcan1').val())){
						sweetAlert(\"¡Upss!\", \"El valor no puede ser mayor a la cantidad de bienes\", \"warning\");
						$('#can1').val($('#acan1').val());
						calculaPorcentajes();
						$('#can1').focus();
						return false;
					}else{
						$('#acan1').val($('#can1').val());
						return true;
					}
				});

				$('#can2').blur(function(e){
					if(parseInt($('#can2').val())>parseInt($('#tcan2').val())){
						sweetAlert(\"¡Upss!\", \"El valor no puede ser mayor a la cantidad de bienes\", \"warning\");
						$('#can2').val($('#acan2').val());
						calculaPorcentajes();
						$('#can2').focus();
						return false;
					}else{
						$('#acan2').val($('#can2').val());
						return true;
					}
				});

				$('#can3').blur(function(e){
					if(parseInt($('#can3').val())>parseInt($('#tcan3').val())){
						sweetAlert(\"¡Upss!\", \"El valor no puede ser mayor a la cantidad de bienes\", \"warning\");
						$('#can3').val($('#acan3').val());
						calculaPorcentajes();
						$('#can3').focus();
						return false;
					}else{
						$('#acan3').val($('#can3').val());
						return true;
					}
				});

				function esEntero(key) {
					var keycode = (key.which) ? key.which : key.keyCode;
					if (keycode > 31 && (keycode < 48 || keycode > 57)) {
						return false;
					}else {
						return true; 
					}
				}

				$('#order_id').on('change', function(e){
					editar2 = $('#editar').val();
					console.log('Editar change: ' + editar2);
					if(editar2 == 0){
						indice = $('#order_id option:selected').val();
										
						if(indice == ''){
							limpiar();
						}else{

							$('#can0').text(0);
							$('#can1').text(0);
							$('#can2').text(0);
							$('#can3').text(0);
			
							$('#can0').val(0);
							$('#can1').val(0);
							$('#can2').val(0);
							$('#can3').val(0);

							$('#can0').prop('disabled', false);
							$('#can1').prop('disabled', false);
							$('#can2').prop('disabled', false);
							$('#can3').prop('disabled', false);	
							
							$('#start_date').prop('disabled', false);
							$('#deadline').prop('disabled', false);

							actualizaCliente(indice);
						}
					}else{
						
					}

					
					
				});



				function actualizaCliente(id){
					$.ajax(
						{ 
							type: 'GET', 
							url: 'fill-customer/' + id, 
							data: '', 
							success: function(result) { 
								console.log(\"id \"+id);
								console.log(\"resultado \"+result[0].name);
								$('#customer_name').val(result[0].name+' '+result[0].last_name+' '+result[0].second_last_name); 
								$('#customer_business_name').val(result[0].business_name); 
								$('#customer_document_number').val(result[0].document_number); 
								$('#customer_ruc').val(result[0].ruc); 
								$('#customer_address').val(result[0].address); 
								$('#customer_email').val(result[0].email); 
								$('#customer_phone_number').val(result[0].phone_number); 
								actualizaPedido(id);
							}
						}).fail(function() {
							console.log(\"error\");
						  });
				}

				function actualizaPedido(id){
					$.ajax(
						{ 
							type: 'GET', 
							url: 'fill-order/' + id, 
							data: '', 
							success: function(result) {
								console.log(\"Cantidad de elementos: \" + result.length);
								fecha_pedido=new Date(Date.parse(result[0].order_date+' 00:00:00'));
								console.log('P'+result[0].id+': Fecha del Pedido: ' + fecha_pedido);
								
								var d = fecha_pedido.getDate();
								var m = fecha_pedido.getMonth() + 1;
								var y = fecha_pedido.getFullYear();
								$('#order_date').val((d <= 9 ? '0' + d : d)+'-'+(m<=9 ? '0' + m : m)+'-'+fecha_pedido.getFullYear()); 
							
								$('#start_date').datepicker('setStartDate', fecha_pedido);
								$('#deadline').datepicker('setStartDate', fecha_pedido);								
								console.log('P'+result[0].id+': Fecha de inicio: ' + $('#start_date').val());

								
								fecha_entrega=new Date(Date.parse(result[0].delivery_date+' 00:00:00'));
								d = fecha_entrega.getDate();
								m = fecha_entrega.getMonth() + 1;
								y = fecha_entrega.getFullYear();
								$('#delivery_date').val((d <= 9 ? '0' + d : d)+'-'+(m<=9 ? '0' + m : m)+'-'+fecha_entrega.getFullYear()); 
  

								$('#start_date').datepicker('setEndDate', fecha_entrega);
								$('#deadline').datepicker('setEndDate', fecha_entrega);

								$('#start_date').datepicker('setDate', fecha_pedido);
								$('#deadline').datepicker('setDate', fecha_entrega);
								console.log('P'+result[0].id+': Fecha de entrega: ' + $('#deadline').val());
								actualizaDetallePedido(id);
								console.log('----------------------------------------------------');
							}
						}).fail(function() {
							console.log(\"error\");
						  });
				}

				function actualizaDetallePedido(id){
					$.ajax(
						{ 
							type: 'GET', 
							url: 'fill-order-details/' + id, 
							data: '', 
							success: function(result) { 
								console.log(\"Cantidad de elementos: \" + result.length);
								var total_prendas = 0;
								tab = \"<table width='100%' border='1' style='border: 1px solid #c1bdbd;'>\"
								tab += \"<tr><th class='cen gris'>Prenda</th>\"
								tab += \"<th class='cen gris'>Género</th>\"
								tab += \"<th class='cen gris'>Talla</th>\"
								tab += \"<th class='cen gris'>Color</th>\"
								tab += \"<th class='cen gris'>Material</th>\"
								tab += \"<th class='cen gris'>Cantidad</th></tr>\"
								for (var i = 0; i < result.length; i++) {
									
									tab += \"<tr>\"
									tab += \"<td class='cen'>\" + result[i].tg_description + \"</td>\"
									tab += \"<td class='cen'>\" + result[i].gender + \"</td>\"
									tab += \"<td class='cen'>\" + result[i].s_description + \"</td>\"
									tab += \"<td class='cen'>\" + result[i].c_name + \"</td>\"
									tab += \"<td class='cen'>\" + result[i].m_name + \"</td>\"
									tab += \"<td class='cen'>\" + result[i].quantity + \"</td>\"
									tab += \"</tr>\"
									total_prendas += result[i].quantity;
								}
								tab += \"<tr class='gris'><th class='cen' colspan='5'>Total de prendas</th>\"
								tab += \"<th class='cen'>\" +  total_prendas + \"</td></tr>\"


								tab += \"</table>\"
								$('#detalle-pedido').html(tab);
								$('#batch').val(total_prendas);

								$('#tcan0').text(total_prendas);
								$('#tcan1').text(total_prendas);
								$('#tcan2').text(total_prendas);
								$('#tcan3').text(total_prendas);
			
								$('#tcan0').val(total_prendas);
								$('#tcan1').val(total_prendas);
								$('#tcan2').val(total_prendas);
								$('#tcan3').val(total_prendas);

								calculaPorcentajes();
							}
						}).fail(function() {
							console.log(\"error\");
						  });
				}

				$('#can0').on('change', function(e){
					calculaPorcentajes();
				});

				$('#can1').on('change', function(e){
					calculaPorcentajes();
				});

				$('#can2').on('change', function(e){
					calculaPorcentajes();
				});

				$('#can3').on('change', function(e){
					calculaPorcentajes();
				});


				function roundToTwo(num) {
					return +(Math.round(num + \"e+2\")  + \"e-2\");
				}

				function calculaPorcentajes(){
					
					$('#tcan0').val($('#tcan0').text());
					$('#tcan1').val($('#tcan1').text());
					$('#tcan2').val($('#tcan2').text());
					$('#tcan3').val($('#tcan3').text());


					var porcentaje=0;
				
					if($('#can0').val()==0){
						$('#pcan0').text(0 + ' %');
						$('#pcan0').val(0);
					}else{
						porcentaje = (($('#can0').val() / $('#tcan0').val())*100) / 4;
						$('#pcan0').text(roundToTwo(porcentaje) + ' %');						
						$('#pcan0').val(roundToTwo(porcentaje) + ' %');						
					}

					if($('#can1').val()==0){
						$('#pcan1').text(0 + ' %');
						$('#pcan1').val(0);
					}else{
						porcentaje = (($('#can1').val() / $('#tcan1').val())*100) / 4;
						$('#pcan1').text(roundToTwo(porcentaje) + ' %');						
						$('#pcan1').val(roundToTwo(porcentaje) + ' %');						
					}

					if($('#can2').val()==0){
						$('#pcan2').text(0 + ' %');
						$('#pcan2').val(0);
					}else{
						porcentaje = (($('#can2').val() / $('#tcan2').val())*100) / 4;
						$('#pcan2').text(roundToTwo(porcentaje) + ' %');						
						$('#pcan2').val(roundToTwo(porcentaje) + ' %');						
					}

					if($('#can3').val()==0){
						$('#pcan3').text(0 + ' %');
						$('#pcan3').val(0);
					}else{
						porcentaje = (($('#can3').val() / $('#tcan3').val())*100) / 4;
						$('#pcan3').text(roundToTwo(porcentaje) + ' %');						
						$('#pcan3').val(roundToTwo(porcentaje) + ' %');						
					}

					porcentaje = parseFloat($('#pcan0').val()) + parseFloat($('#pcan1').val()) + parseFloat($('#pcan2').val()) + parseFloat($('#pcan3').val());

					$('#t_advance').text(roundToTwo(porcentaje) + ' %');
					$('#t_advance').val(roundToTwo(porcentaje));
					$('#advance').val(parseFloat(roundToTwo(porcentaje)));
					console.log(\"Porcentaje calculado: \"+$('#advance').val());
				}


			});";


            /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = "    .der {text-align:right;} 
			.izq {text-align:left;} 
			.cen {text-align:center;} 
			
			label {font-weight: normal;} 
			.edita{width:70px; text-align:center} 
			.panel-default>.panel-heading {font-weight: bold;}
			.gris {background-color: #eeeeee;}
			.flota1 {float: right; margin-top: -5px;}
			.margen0 {margin: 0px;}
			.margen1 {margin: 5px;}
			.margen2 {margin: 0px 8px 0px 8px;}
			.margen3 {margin: 0px 10px 0px 10px;}
			.negrita {font-weight:bold;}
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
			.tabla {border: 1px solid #c1bdbd;border-width: 1px}";
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();
	        
	        
	    }

		public function getAdd()
		{
			$data['page_title']  = "Agregar nuevo proceso productivo";
			//$data['orders'] = DB::table('orders')->get();
			$data['editar'] = 0;
			$data['orders'] = DB::table('orders')
						->whereNotExists(function ($query) {
							$query->select(DB::raw(1))
								  ->from('processes')
								  ->whereColumn('processes.order_id', 'orders.id')
								  ->where('processes.state','>', 0);
						})
						->where('orders.type','=', 2)
						->get();
			//$this->cbView('process_add',$data);
			return $this->view('process_add',$data);
		}

		public function getEdit($id)
		{
			//dd($id);
			$data['page_title']  = "Editar un proceso productivo";
			$data['editar'] = 1;
			$data['row'] = DB::table('processes')
						->where('processes.id',$id)->first();
			//dd($data['row']->start_date);
			//dd(date('d-m-Y', strtotime($data['row']->start_date)));


			if ($data['row']->state==2) {
				CRUDBooster::redirectBack(
					'Los procesos en estado <b>Finalizado</b>, no se pueden <b>editar</b>.'
				);
			}else{

				$data['order'] = DB::table('orders')
							->where('orders.id',$data['row']->order_id)->first();
							
				$data['order_details'] = DB::table('order_details')
							->join('garments','garments.id','=','order_details.garment_id')
							->join('types_garments','types_garments.id','=','garments.type_garment_id')
							->join('sizes','sizes.id','=','garments.size_id')
							->join('colors','colors.id','=','garments.color_id')												
							->join('materials','materials.id','=','garments.material_id')
							->select('types_garments.description as tg_description','garments.gender','sizes.description as s_description','colors.name as c_name','materials.name as m_name','order_details.quantity')				
							->where('order_details.order_id',$data['row']->order_id)->get();

				$data['customer'] = DB::table('customers')
							->where('customers.id',$data['order']->customer_id)->first();	
				//dd($id);		
				$data['q_tasks'] = DB::table('tasks')
							->where('tasks.process_id','=',$id)
							->where('tasks.check','=',0)
							->count();
					
				return $this->view('process_edit',$data);	
			}
		
		}

		public function getDetail($id){
			//dd($id);
			$data['page_title']  = "Detalle de un proceso productivo";
			$data['editar'] = 1;
			$data['row'] = DB::table('processes')
						->where('processes.id',$id)->first();
			//dd($data['row']->start_date);
			//dd(date('d-m-Y', strtotime($data['row']->start_date)));


			

			$data['order'] = DB::table('orders')
						->where('orders.id',$data['row']->order_id)->first();
						
			$data['order_details'] = DB::table('order_details')
						->join('garments','garments.id','=','order_details.garment_id')
						->join('types_garments','types_garments.id','=','garments.type_garment_id')
						->join('sizes','sizes.id','=','garments.size_id')
						->join('colors','colors.id','=','garments.color_id')												
						->join('materials','materials.id','=','garments.material_id')
						->select('types_garments.description as tg_description','garments.gender','sizes.description as s_description','colors.name as c_name','materials.name as m_name','order_details.quantity')				
						->where('order_details.order_id',$data['row']->order_id)->get();

			$data['customer'] = DB::table('customers')
						->where('customers.id',$data['order']->customer_id)->first();						
				
			return $this->view('process_detail',$data);	

		}


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	        //Your code here
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
			// Formateando pedido
			if($column_index == 1){
				$column_value = 'Pedido N° '. str_pad($column_value,4,"0",STR_PAD_LEFT);
			}			
			// Actualizando el formato de las fechas
			if($column_index == 2 || $column_index == 4 || $column_index == 6){
				if ($column_value<>""){
					$column_value = date("d/m/Y",strtotime($column_value));
				}else{
					$column_value = "-";
				}

			}
			// Formateando porcentaje
			if($column_index == 5){
				$column_value = number_format($column_value, 2) . ' %';
			}

			// Formateando el estado
			if($column_index == 7){
				if ($column_value==1){
					$column_value="En proceso";
				}
				if ($column_value==2){
					$column_value="Finalizado";
				}
			}
			/*if($column_index == 8){
				dd($column_value);
			}*/
			
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here
			
			$postdata['start_date'] = date("Y-m-d",strtotime($postdata['start_date']));
			$postdata['deadline'] = date("Y-m-d",strtotime($postdata['deadline']));
			
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        //Your code here
			$process = DB::table('processes')
			->where('id','=',$id)->get();
			/*
			Cambiar a estado 2 "En proceso" del pedido, al registrar un avance productivo
			Estado 2 "En proceso", solo permite editar la fecha de entrega y pago del pedido
			*/
			DB::table('orders')
			->where('id', $process[0]->order_id)
			->update(['state' => 2]);


	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {        
	        //Your code here
			//dd($postdata);
			$postdata['start_date'] = date("Y-m-d",strtotime($postdata['start_date']));
			$postdata['deadline'] = date("Y-m-d",strtotime($postdata['deadline']));
			//dd($postdata['finalizar']);
			if($postdata['state']==2){//verificando valor auxiliar si el proceso fue finalizado
				$fecha_fin = Carbon::now();
				//dd($fecha_fin);
				//$postdata['finish_date'] = date("Y-m-d",$fecha_fin->toDateTimeString());
				$postdata['finish_date'] = $fecha_fin->format("Y-m-d");
				//dd($postdata['finish_date'] );
				//$postdata['state'] = 2;
				
			}



	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 
			$process = DB::table('processes')
			->where('id','=',$id)->get();
			/*
			Cambiar a estado 3 "Proceso finalizado" del pedido, al finalizar un avance productivo
			Estado 3 "Proceso finalizado", solo permite editar la fecha de entrega y pago del pedido
			*/
			if($process[0]->state == 2){
				DB::table('orders')
					->where('id', $process[0]->order_id)
					->update(['state' => 3]);
			}
			
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here
			DB::table('processes')
			->where('id', $id)
			->update(['state' => 0]);

			$process = DB::table('processes')
			->where('id','=',$id)->get();
			/*
			Al Anular un avance productivo, se actualiza el estado del pedido a 1 "Registrado"
			*/
			DB::table('orders')
			->where('id', $process[0]->order_id)
			->update(['state' => 1]);
	    }



	    //By the way, you can still create your own method in here... :) 
		
		public function getFillCustomer($id){
			/*$data = DB::table('customers')
				->where('id',DB::table('orders')
					->select('customer_id')
					->where('id','=',$id))->get();
			*/
			//$data = DB::table('orders')->where('id','=',$id)->get();
			$order = DB::table('orders')
				->where('id','=',$id)->get();
			$data = DB::table('customers')
				->where('id','=',$order[0]->customer_id)->get();

			return $data;
			//return $this->view('welcome',$data);
		}

		public function getFillOrder($id){
			$data = DB::table('orders')
				->where('id','=',$id)->get();
			return $data;
		}

		public function getFillOrderDetails($id){
			$data = DB::table('order_details')
				->join('garments','garments.id','=','order_details.garment_id')
				->join('types_garments','types_garments.id','=','garments.type_garment_id')
				->join('sizes','sizes.id','=','garments.size_id')
				->join('colors','colors.id','=','garments.color_id')												
				->join('materials','materials.id','=','garments.material_id')
				->select('types_garments.description as tg_description','garments.gender','sizes.description as s_description','colors.name as c_name','materials.name as m_name','order_details.quantity')				
				->where('order_details.order_id','=',$id)->get();
			return $data;
		}

	}