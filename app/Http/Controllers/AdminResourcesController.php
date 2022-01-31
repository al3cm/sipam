<?php namespace App\Http\Controllers;

	use Session;
	use DB;
	use CRUDBooster;
use SebastianBergmann\Environment\Console;
use Illuminate\Http\Request;

class AdminResourcesController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = true;
			$this->button_delete = false;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "processes";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Pedido","name"=>"order_id"];
			$this->col[] = ["label"=>"Fecha de inicio","name"=>"start_date"];
			$this->col[] = ["label"=>"Cantidad de prendas","name"=>"batch"];
			$this->col[] = ["label"=>"Fecha de entrega","name"=>"deadline"];
			$this->col[] = ["label"=>"% de Avance","name"=>"advance"];
			$this->col[] = ["label"=>"Fecha de fin","name"=>"finish_date"];
			$this->col[] = ["label"=>"Estado","name"=>"state"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Start Date','name'=>'start_date','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Deadline','name'=>'deadline','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Finish Date','name'=>'finish_date','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Batch','name'=>'batch','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Cutting Batch','name'=>'cutting_batch','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Enabled Batch','name'=>'enabled_batch','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Confection Batch','name'=>'confection_batch','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Finishing Batch','name'=>'finishing_batch','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Advance','name'=>'advance','type'=>'money','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Notes','name'=>'notes','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'State','name'=>'state','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Order Id','name'=>'order_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'order,id'];
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
			
			var url_detalledelprocesosupply_id ='http://sipam.test/admin/resources/modal-data?table=view_list_supplies&columns=id,supply,type,stock&name_column=detalledelprocesosupply_id&where=&select_to=supply%2Cstock%3Astock&columns_name_alias=Insumo%2CTipo%2CStock';
			var url_is_setted_detalledelprocesosupply_id = false;
		
			function showModaldetalledelprocesosupply_id() {
				if (url_is_setted_detalledelprocesosupply_id == false) {
					url_is_setted_detalledelprocesosupply_id = true;
					$('#iframe-modal-detalledelprocesosupply_id').attr('src', url_detalledelprocesosupply_id);
				}
				$('#modal-datamodal-detalledelprocesosupply_id').modal('show');
			}
		
			function hideModaldetalledelprocesosupply_id() {
				$('#modal-datamodal-detalledelprocesosupply_id').modal('hide');
			}
		
			function selectAdditionalDatadetalledelprocesosupply_id(select_to_json) {
				$.each(select_to_json, function (key, val) {
					console.log('#' + key + ' = ' + val);
					if (key == 'datamodal_id') {
						$('#detalledelprocesosupply_id .input-id').val(val);
					}
					if (key == 'datamodal_label') {
						$('#detalledelprocesosupply_id .input-label').val(val);
					}
					$('#detalledelproceso' + key).val(val).trigger('change');
				})
				url_is_setted_detalledelprocesosupply_id = false;
				hideModaldetalledelprocesosupply_id();
			}

			var currentRow = null;

			function resetFormdetalledelprocesoi() {
				$('#panel-form-detalledelprocesoi').find(\"input[type=text],input[type=number],select,textarea\").val('');
				$('#panel-form-detalledelprocesoi').find(\".select2\").val('').trigger('change');
				$('#escogerdatoi').prop('disabled', false);
				if(currentRow != null){
					currentRow.removeClass('warning');
					currentRow = null;
					$('#btn-add-table-detalledelprocesoi').val('Agregar a la Tabla');
				}
			}
		
			function deleteRowdetalledelprocesoi(t) {
		
				swal({
					title: \"¿Estás seguro de eliminar el insumo?\",
					text: \"Una vez eliminado, no se podrá recuperar\",
					type: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Si',
					cancelButtonText: 'No',
					reverseButtons: true
				}, function (willDelete){
					if (willDelete){
						var p = $(t).parent().parent(); //parentTR
						var id = p.find(\".supply_id .detail_id\").val();
						eliminardetalleinsumo(id);
						console.log(\"Elemento eliminado\");
						refreshdetalledelprocesoi();
					}else{
						console.log(\"Eliminación cancelada\");
					}
				});

	
			}



			function eliminardetalleinsumo(id){
				
				var _token = $('input[name=_token]').val();
								
				console.log(\"id a eliminar: \" + id);
				
				$.ajax({
					type	: 'POST',
					url 	: 'delete-supply-detail',
					data	: {
						id : id,
						_token : _token
					},
					success	: function(response){
						if(response){
							
							refreshdetalledelprocesoi();
							
						}
					}
				}).fail(function(){
					console.log(\"error\");
				});
			}
		
			function editRowdetalledelprocesoi(t) {
				if(currentRow != null){
					currentRow.removeClass('warning');
				}
				var p = $(t).parent().parent(); //parentTR
				currentRow = p;
				p.addClass('warning');
				$('#btn-add-table-detalledelprocesoi').val('Guardar Cambios');
				$('#detalledelprocesosupply_id .input-label').val(p.find(\".supply_id .td-label\").text());
				$('#detalledelprocesosupply_id .input-id').val(p.find(\".supply_id input\").val());
				$('#detalledelprocesosupply_id .input-id-2').val(p.find(\".supply_id .detail_id\").val());
				$('#detalledelprocesostock').val(p.find(\".stock input\").val());
				$('#detalledelprocesoquantity').val(p.find(\".quantity input\").val());
				$('#escogerdatoi').prop('disabled', true);
				
			}
		
			function validateFormdetalledelprocesoi() {
				var is_false = 0;
				$('#panel-form-detalledelprocesoi .required').each(function () {
					var v = $(this).val();
					if (v == '') {
						sweetAlert(\"¡Upss!\", \"Por favor, complete el formulario!\", \"warning\");
						is_false += 1;
					}
				})
		
				if (is_false == 0) {
					return true;
				} else {
					return false;
				}
			}
		

			
			function refreshdetalledelprocesoi(){
				$('#table-detalledelprocesoi tbody').empty();
				console.log(\"Llenando detalles de insumos\");
				var id = $('#process_id').val();
				console.log(\"id: \" + id);
				var trRow = '';
				$.ajax(
					{ 
						type: 'POST', 
						url: 'list-supply-details/' + id, 
						data: '', 
						success: function(result) { 
							console.log(\"Cantidad de elementos: \" + result.length);
						
							if(result.length>0){
								console.log(\"Dentro del if: \" + result.length);
								for (var i = 0; i < result.length; i++) {
									
									trRow += '<tr>';
									trRow += \"<td class='supply_id'><span class='td-label'>\" + result[i].supply + \"</span>\" +
											 \"<input type='hidden' name='detalledelproceso-supply_id[]' value='\" + result[i].supply_id + \"'/>\" +
											 \"<input type='hidden' class='detail_id' name='detalledelproceso-supply_detail_id[]' value='\" + result[i].id + \"'/>\" +
											 \"</td>\";
									trRow += \"<td class='stock'>\" + result[i].stock +
											 \"<input type='hidden' name='detalledelproceso-stock[]' value='\" + result[i].stock + \"'/>\" +
											 \"</td>\";
									trRow += \"<td class='quantity'>\" + result[i].quantity +
											 \"<input type='hidden' name='detalledelproceso-quantity[]' value='\" + result[i].quantity + \"'/>\" +
											 \"</td>\";
									trRow += \"<td>\" +
											 \"<a href='#panel-form-detalledelprocesoi' onclick='editRowdetalledelprocesoi(this)' class='btn btn-warning btn-xs'><i class='fa fa-pencil'></i></a> \" +
											 \"<a href='javascript:void(0)' onclick='deleteRowdetalledelprocesoi(this)' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></a></td>\";
									trRow += '</tr>';
									
								}
																
								$('#table-detalledelprocesoi tbody').prepend(trRow);
								$('#btn-add-table-detalledelprocesoi').val('Agregar a la Tabla');
								$('#btn-reset-form-detalledelprocesoi').click();
	
							}else{
								console.log(\"Dentro del else: \" + result.length);
								if ($('#table-detalledelprocesoi tbody tr').length == 0) {
									var colspan = $('#table-detalledelprocesoi thead tr th').length;
									$('#table-detalledelprocesoi tbody').html(\"<tr class='trNull'><td colspan='\" + colspan + \"' align='center'>No tenemos datos disponibles</td></tr>\");
								}
							}
						}
					}).fail(function() {
						console.log(\"error\");
					  });
			}

			$('#add-supply-detail').submit(function(e){
				e.preventDefault();

				if (validateFormdetalledelprocesoi() == false) {
					return false;
				}
				agregardetalleinsumo();

			});

			function agregardetalleinsumo(){
				var supply_id = $('#detalledelprocesosupply_id .input-id').val();
				var process_id = $('#process_id').val();
				var quantity = $('#detalledelprocesoquantity').val();
				var _token = $('input[name=_token]').val();
				var agrega = 0;
				if (currentRow == null) {
					agrega = 1;
				} else {
					agrega = 0;
					currentRow.removeClass('warning');
					currentRow = null;
				}
				
				console.log(\"Agrega: \" + agrega);
				console.log(\"supply_id: \" + supply_id);
				console.log(\"process_id: \" + process_id);
				console.log(\"quantity: \" + quantity);
				
				$.ajax({
					type	: 'POST',
					url 	: 'add-supply-detail',
					data	: {
						supply_id : supply_id,
						process_id : process_id,
						quantity : quantity,
						agrega : agrega,
						_token : _token
					},
					success	: function(response){
						if(response){
							
							refreshdetalledelprocesoi();
							
						}
					}
				}).fail(function(){
					console.log(\"error\");
				});
			}



            var url_detalledelprocesouser_id ='http://sipam.test/admin/resources/modal-data?table=view_list_workers&columns=id,username,privilege&name_column=detalledelprocesouser_id&where=&select_to=username%2Cprivilege%3Aprivilege&columns_name_alias=Responsable%2CCargo';
			var url_is_setted_detalledelprocesouser_id = false;
		
			function showModaldetalledelprocesouser_id() {
				if (url_is_setted_detalledelprocesouser_id == false) {
					url_is_setted_detalledelprocesouser_id = true;
					$('#iframe-modal-detalledelprocesouser_id').attr('src', url_detalledelprocesouser_id);
				}
				$('#modal-datamodal-detalledelprocesouser_id').modal('show');
			}
		
			function hideModaldetalledelprocesouser_id() {
				$('#modal-datamodal-detalledelprocesouser_id').modal('hide');
			}
		
			function selectAdditionalDatadetalledelprocesouser_id(select_to_json) {
				$.each(select_to_json, function (key, val) {
					console.log('#' + key + ' = ' + val);
					if (key == 'datamodal_id') {
						$('#detalledelprocesouser_id .input-id').val(val);
					}
					if (key == 'datamodal_label') {
						$('#detalledelprocesouser_id .input-label').val(val);
					}
					$('#detalledelproceso' + key).val(val).trigger('change');
				})
				hideModaldetalledelprocesouser_id();
			}

			var currentRow = null;

			function resetFormdetalledelprocesot() {
				$('#panel-form-detalledelprocesot').find(\"input[type=text],input[type=number],select,textarea\").val('');
				$('#panel-form-detalledelprocesot').find(\".select2\").val('').trigger('change');
			}
		
			function deleteRowdetalledelprocesot(t) {
		
				if (confirm(\"Estás Seguro?\")) {
					$(t).parent().parent().remove();
					if ($('#table-detalledelprocesot tbody tr').length == 0) {
						var colspan = $('#table-detalledelprocesot thead tr th').length;
						$('#table-detalledelprocesot tbody').html(\"<tr class='trNull'><td colspan='\" + colspan + \"' align='center'>No tenemos datos disponibles</td></tr>\");
					}
				}
			}
		
			function editRowdetalledelprocesot(t) {
				var p = $(t).parent().parent(); //parentTR
				currentRow = p;
				p.addClass('warning');
				$('#btn-add-table-detalledelprocesot').val('Guardar Cambios');
				$('#detalledelprocesouser_id .input-label').val(p.find(\".user_id .td-label\").text());
				$('#detalledelprocesouser_id .input-id').val(p.find(\".user_id input\").val());
				$('#detalledelprocesotitle').val(p.find(\".title input\").val());
				$('#detalledelprocesodescription').val(p.find(\".description input\").val());
				$('#detalledelprocesocheck').val(p.find(\".checkval\").val());
			}
		
			function validateFormdetalledelprocesot() {
				var is_false = 0;
				$('#panel-form-detalledelprocesot .required').each(function () {
					var v = $(this).val();
					if (v == '') {
						sweetAlert(\"¡Upss!\", \"Por favor, complete el formulario!\", \"warning\");
						is_false += 1;
					}
				})
		
				if (is_false == 0) {
					return true;
				} else {
					return false;
				}
			}
		
			function addToTabledetalledelprocesot() {
		
				if (validateFormdetalledelprocesot() == false) {
					return false;
				}



		
				var trRow = '<tr>';
				trRow += \"<td class='user_id'><span class='td-label'>\" + $('#detalledelprocesouser_id .input-label').val() + \"</span>\" +
						\"<input type='hidden' name='detalledelproceso-user_id[]' value='\" + $('#detalledelprocesouser_id .input-id').val() + \"'/>\" +
						\"</td>\";
				trRow += \"<td class='title'>\" + $('#detalledelprocesotitle').val() +
						\"<input type='hidden' name='detalledelproceso-title[]' value='\" + $('#detalledelprocesotitle').val() + \"'/>\" +
						\"</td>\";
				trRow += \"<td class='description'>\" + $('#detalledelprocesodescription').val() +
						\"<input type='hidden' name='detalledelproceso-description[]' value='\" + $('#detalledelprocesodescription').val() + \"'/>\" +
						\"</td>\";
				trRow += \"<td class='check'>\";
				console.log($('#detalledelprocesocheck').val());
				if($('#detalledelprocesocheck').val() == 'false'){
					console.log('dentro de falso');
					trRow += \"<input type='checkbox' id='\" + $('#detalledelprocesouser_id .input-id').val() + \"'/>\";
				}
				if($('#detalledelprocesocheck').val() == 'true'){
					console.log('dentro de true');
					trRow += \"<input type='checkbox' checked id='\" + $('#detalledelprocesouser_id .input-id').val() + \"'/>\";
				}
				trRow += \"<input type='hidden' name='detalledelproceso-check[]' value='\" + $('#detalledelprocesocheck').val() + \"' class='checkval'/>\" +
						\"</td>\";						
				trRow += \"<td>\" +
						\"<a href='#panel-form-detalledelprocesot' onclick='editRowdetalledelprocesot(this)' class='btn btn-warning btn-xs'><i class='fa fa-pencil'></i></a> \" +
						\"<a href='javascript:void(0)' onclick='deleteRowdetalledelprocesot(this)' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></a></td>\";
				trRow += '</tr>';
				$('#table-detalledelprocesot tbody .trNull').remove();
				if (currentRow == null) {
					$(\"#table-detalledelprocesot tbody\").prepend(trRow);
				} else {
					currentRow.removeClass('warning');
					currentRow.replaceWith(trRow);
					currentRow = null;
				}
				$('#btn-add-table-detalledelprocesot').val('Agregar a la Tabla');
				$('#btn-reset-form-detalledelprocesot').click();
			}	





			$(function(){





				$(document).ready(function() { 
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


				function esEntero(key) {
					var keycode = (key.which) ? key.which : key.keyCode;
					if (keycode > 31 && (keycode < 48 || keycode > 57)) {
						return false;
					}else {
						return true; 
					}
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
	        $this->style_css = "    
			
			.der {text-align:right;} 
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
			.tabla {border: 1px solid #c1bdbd;border-width: 1px}
			.dropdown-menu-action {
				left: -130%;
			}

			.btn-group-action .btn-action {
				cursor: default
			}
	
			#box-header-module {
				box-shadow: 10px 10px 10px #dddddd;
			}
	
			.sub-module-tab li {
				background: #F9F9F9;
				cursor: pointer;
			}
	
			.sub-module-tab li.active {
				background: #ffffff;
				box-shadow: 0px -5px 10px #cccccc
			}
	
			.nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
				border: none;
			}
	
			.nav-tabs > li > a {
				border: none;
			}
	
			.breadcrumb {
				margin: 0 0 0 0;
				padding: 0 0 0 0;
			}
	
			.form-group > label:first-child {
				display: block
			}
	
			#table_dashboard.table-bordered, #table_dashboard.table-bordered thead tr th, #table_dashboard.table-bordered tbody tr td {
				border: 1px solid #bbbbbb !important;
			}


			";
	        
	        
	        
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
								$column_value="Editable";
							}
							if ($column_value==2){
								$column_value="Finalizado";
							}
						}
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

	    }



	    //By the way, you can still create your own method in here... :) 

		public function getEdit($id)
		{
			//dd($id);
			$data['page_title']  = "Agregar recursos a un proceso productivo";
			$data['editar'] = 1;
			$data['row'] = DB::table('processes')
						->where('processes.id',$id)->first();


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
				
				$data['supplies'] = DB::table('list_supply_details_view')
							->where('list_supply_details_view.process_id','=',$id)->get();

				return $this->view('resource_edit',$data);	
			}
		
		}


		public function addSupplyDetail(Request $request){
			$cantidad = 0;

			if($request->agrega == 1){
				$data['supply_detail'] = DB::table('supply_details')
				->where('supply_details.process_id',$request->process_id)
				->where('supply_details.supply_id',$request->supply_id)
				->first();
				//if(count((array)$data['supply_detail'])>0){
				if($data['supply_detail'] <> null){
					$cantidad = $request->quantity + $data['supply_detail']->quantity;
				}else{
					$cantidad = $request->quantity;
				}
				
			}else{
				$cantidad = $request->quantity;
			}

			DB::table('supply_details')->updateOrInsert(
				[
					'process_id' => $request->process_id,
					'supply_id' => $request->supply_id
				],
				[
					'quantity' => $cantidad
				]
			);

			/*
			DB::table('supply_details')->insert([
			'process_id' => $request->process_id,
			'supply_id' => $request->supply_id,
			'quantity' => $request->quantity
			]);
			*/


			return back();


			//return $request['process_id'];	

		}

		
		public function getSupplyDetails($id){
			
			$data = DB::table('view_list_supply_details')
				->where('view_list_supply_details.process_id','=',$id)->get();
			return $data;

		}

		public function deleteSupplyDetail(Request $request){
			
			DB::table('supply_details')
				->where('supply_details.id', '=', $request->id)->delete();

			return back();

		}		

	}