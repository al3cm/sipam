<?php namespace App\Http\Controllers;

	use Session;

	use DB;
	use CRUDBooster;

	use Illuminate\Http\Request;
	
	class AdminPurchasesController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->table = "purchases";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"N° de compra","name"=>"id","callback"=>function($row) {
				return str_pad($row->id,8,"0",STR_PAD_LEFT) ;
			}];
			$this->col[] = ["label"=>"N° de documento","name"=>"document"];
			$this->col[] = ["label"=>"Tipo de documento","name"=>"doc_type","callback"=>function($row) {
				if ($row->doc_type == 1)
					return "Boleta";
				elseif ($row->doc_type == 2)
					return "Factura";
				else
				return "No precisa";
			}];
			$this->col[] = ["label"=>"Fecha de compra","name"=>"purchase_date","callback"=>function($row) {
				return date("d/m/Y",strtotime($row->purchase_date));
			}];
			$this->col[] = ["label"=>"Proveedor","name"=>"provider_id","join"=>"providers,business_name"];
			$this->col[] = ["label"=>"Total","name"=>"total","callback"=>function($row) {
				return 'S/ ' . number_format($row->total, 2);
			}];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Tipo de documento','name'=>'doc_type','type'=>'select','dataenum'=>'0|No precisa;1|Boleta;2|Factura','validation'=>'required','width'=>'col-sm-3'];
			$this->form[] = ['label'=>'N° de documento','name'=>'document','type'=>'text','validation'=>'required|min:1|max:50','width'=>'col-sm-3'];
			$this->form[] = ['label'=>'Fecha de la compra','name'=>'purchase_date','type'=>'date','validation'=>'required|date','width'=>'col-sm-3',"callback_php"=>'($row->purchase_date!=null?date("d-m-Y",strtotime($row->purchase_date)):"")'];
			$this->form[] = ['label'=>'Proveedor','name'=>'provider_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-3','datatable'=>'providers,business_name','datatable_where'=>'type = 2'];


			$columns[] = [
				'label'=>'Insumos',
				'name'=>'supply_id',
				'type'=>'datamodal',
				'datamodal_table'=>'view_list_supplies',
				'datamodal_columns'=>'supply,type,stock',
				'datamodal_columns_alias'=>'Insumo,Tipo,Stock',
				'datamodal_select_to'=>'supply',
				'required'=>true];

			//$columns[] = ['label'=>'Stock','name'=>'stock','type'=>'text','readonly'=>true];
			$columns[] = ['label'=>'Precio S/','name'=>'price','type'=>'text','required'=>true];
			$columns[] = ['label'=>'Cantidad','name'=>'quantity','type'=>'text','required'=>true];
			$columns[] = ['label'=>'Sub Total S/','name'=>'subtotal','type'=>'number','formula'=>"[quantity] * [price]","readonly"=>true,'required'=>true];

			$this->form[] = [
				'label'=>'Detalle de la compra',
				'name'=>'purchase_details',
				'type'=>'child',
				'columns'=>$columns,
				'table'=>'purchase_details',
				'foreign_key'=>'purchase_id'];

			$this->form[] = ['label'=>'Total S/','name'=>'total','type'=>'money','validation'=>'required|integer|min:0',"readonly"=>true,'width'=>'col-sm-2'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Doc Type","name"=>"doc_type","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Document","name"=>"document","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Purchase Date","name"=>"purchase_date","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"Total","name"=>"total","type"=>"money","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"State","name"=>"state","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Provider Id","name"=>"provider_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"provider,id"];
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

					setInterval(function(){
						calcularTotal();

					},500);

				});
	

				$('#detalledelacompraprice').keypress(function(e){
					return filterFloat(e,this);
				});
				$('#detalledelacompraquantity').keypress(function(e){
					return filterFloat(e,this);
				});



				$('.input_date').datepicker({
					format: 'dd-mm-yyyy',
					todayHighlight: true,
					autoclose: true,						
					language: 'es'
				});

				function filterFloat(evt,input){
					// Backspace = 8, Enter = 13, '0' = 48, '9' = 57, '.' = 46, '-' = 43
					var key = window.Event ? evt.which : evt.keyCode;    
					var chark = String.fromCharCode(key);
					var tempValue = input.value+chark;
					if(key >= 48 && key <= 57){
						if(filter(tempValue)=== false){
							return false;
						}else{       
							return true;
						}
					}else{
						  if(key == 8 || key == 13 || key == 0) {     
							  return true;              
						  }else if(key == 46){
								if(filter(tempValue)=== false){
									return false;
								}else{       
									return true;
								}
						  }else{
							  return false;
						  }
					}
				}
				function filter(__val__){
					var preg = /^([0-9]+\.?[0-9]{0,2})$/; 
					if(preg.test(__val__) === true){
						return true;
					}else{
					   return false;
					}
					
				}

				function calcularTotal(){
					var total = 0;

					$('#table-detalledelacompra tbody .subtotal').each(function(){
						var amount = parseInt($(this).text());
						total += amount;
					});

					$('#total').val(round(total));
					
				}

				function round(num, decimales = 2) {
					var signo = (num >= 0 ? 1 : -1);
					num = num * signo;
					if (decimales === 0) //con 0 decimales
						return signo * Math.round(num);
					// round(x * 10 ^ decimales)
					num = num.toString().split('e');
					num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
					// x * 10 ^ (-decimales)
					num = num.toString().split('e');
					return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
				}

				function formuladetalledelacomprasubtotal() {
					var v = $('#detalledelacompraquantity').val() * $('#detalledelacompraprice').val();
					$('#detalledelacomprasubtotal').val(v);
				}
					
				$('#detalledelacompraprice').change(function() {
					formuladetalledelacomprasubtotal();
				});
				
				$('#detalledelacompraquantity').change(function() {
					formuladetalledelacomprasubtotal();
				});

			});
		
			//------------------------------------------------------------------------------

			var url_detalledelacomprasupply_id ='http://sipam.test/admin/resources/modal-data?table=view_list_supplies&columns=id,supply,type,stock&name_column=detalledelacomprasupply_id&where=&select_to=supply%2Cstock%3Astock&columns_name_alias=Insumo%2CTipo%2CStock';
			var url_is_setted_detalledelacomprasupply_id = false;
		
			function showModaldetalledelacomprasupply_id() {
				if (url_is_setted_detalledelacomprasupply_id == false) {
					url_is_setted_detalledelacomprasupply_id = true;
					$('#iframe-modal-detalledelacomprasupply_id').attr('src', url_detalledelacomprasupply_id);
				}
				$('#modal-datamodal-detalledelacomprasupply_id').modal('show');
				url_is_setted_detalledelacomprasupply_id = false;
			}
		
			function hideModaldetalledelacomprasupply_id() {
				
				$('#modal-datamodal-detalledelacomprasupply_id').modal('hide');
			}
		
			function selectAdditionalDatadetalledelacomprasupply_id(select_to_json) {
				$.each(select_to_json, function (key, val) {
					console.log('#' + key + ' = ' + val);
					if (key == 'datamodal_id') {
						$('#detalledelacomprasupply_id .input-id').val(val);
					}
					if (key == 'datamodal_label') {
						$('#detalledelacomprasupply_id .input-label').val(val);
					}
					$('#detalledelacompra' + key).val(val).trigger('change');
				})
				url_is_setted_detalledelacomprasupply_id = false;
				hideModaldetalledelacomprasupply_id();
			}

			var currentRow = null;

			function resetFormdetalledelacompra() {
				$('#panel-form-detalledelacompra').find(\"input[type=text],input[type=number],select,textarea\").val('');
				$('#panel-form-detalledelacompra').find(\".select2\").val('').trigger('change');
				$('#escogerdato').prop('disabled', false);
				if(currentRow != null){
					currentRow.removeClass('warning');
					currentRow = null;
					$('#btn-add-table-detalledelacompra').val('Agregar a la Tabla');
				}
			}
		
			function deleteRowdetalledelacompra(t) {
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
						var supply_id = p.find(\".supply_id input\").val();
						var cant = p.find(\".quantity input\").val();
						validarstockeliminar(id,supply_id,cant);
						
					}else{
					
						console.log(\"Eliminación cancelada\");
					}
				});
				
			}
			function validarstockeliminar(id,supply_id,cant){
				console.log(\"---Verificando stock para eliminar detalle de compra---\");
				is_false = 0;
				var stock = 0;
				console.log(\"Id: \" + id);
				console.log(\"Supply Id: \" + supply_id);
				
				$.ajax(
					{ 
						type: 'POST', 
						url: 'get-stock/' + supply_id, 
						data: '', 
						success: function(result) { 
							console.log(\"---Resultados de verificación de stock---\");	
							if(result.length>0){
								stock=result[0].stock;
								
								console.log(\"Stock obtenido(verf.): \" + stock);

								console.log(\"Eliminar-Iniciando comparación\");
								var quantity = cant;
								console.log(\"Cantidad a eliminar: \" + quantity);
								if (quantity>stock){
									setTimeout(function(){
										sweetAlert(\"¡Upss!\",\"La cantidad del detalle a eliminar (\"+quantity+\") no puede ser mayor al stock disponible (\"+stock+\")\");
									  }, 250);
									
									console.log(\"--Comparación ERROR--\");
									is_false += 1;
								}else{
									console.log(\"--Comparación OK--\");
								}

								if (is_false == 0) {
									eliminardetallecompra(id);
								} else {
									return false;
								}
							}
						}
					}).fail(function() {
						console.log(\"error\");
					});
				console.log(\"---Fin de la verificación de stock---\");	
			}


			function eliminardetallecompra(id){
				var _token = $('input[name=_token]').val();
				console.log(\"id a eliminar: \" + id);
				$.ajax({
					type	: 'POST',
					url 	: 'delete-purchase-detail',
					data	: {
						id : id,
						_token : _token
					},
					success	: function(response){
						if(response){
							refreshdetalledelacompra();
							console.log(\"Elemento eliminado\");
						}
					}
				}).fail(function(){
					console.log(\"error\");
				});
			}
		
			function editRowdetalledelacompra(t) {
				if(currentRow != null){
					currentRow.removeClass('warning');
				}
				var p = $(t).parent().parent(); //parentTR
				currentRow = p;
				p.addClass('warning');
				$('#btn-add-table-detalledelacompra').val('Guardar Cambios');
				$('#detalledelacomprasupply_id .input-label').val(p.find(\".supply_id .td-label\").text());
				$('#detalledelacomprasupply_id .input-id').val(p.find(\".supply_id input\").val());
				$('#detalledelacomprasupply_id .input-id-2').val(p.find(\".supply_id .detail_id\").val());
				$('#detalledelacompraprice').val(p.find(\".price input\").val());
				$('#detalledelacompraquantity').val(p.find(\".quantity input\").val());
				$('#detalledelacomprasubtotal').val(p.find(\".subtotal input\").val());
				$('#escogerdato').prop('disabled', true);
			}
		
			function validateStock(){
				console.log(\"---Verificando stock---\");
				is_false = 0;
				var quantity = parseFloat($('#detalledelacompraquantity').val());
				var supply_id = $('#detalledelacomprasupply_id .input-id').val();
				var stock = 0;
				console.log(\"Supply Id: \" + supply_id);
				console.log(\"Cantidad: \" + quantity);
				$.ajax(
					{ 
						type: 'POST', 
						url: 'get-stock/' + supply_id, 
						data: '', 
						success: function(result) { 
							console.log(\"---Resultados de verificación de stock---\");	
							if(result.length>0){
								stock=result[0].stock;
								
								console.log(\"Stock obtenido(verf.): \" + stock);
								console.log(\"currentRow (verf.): \" + currentRow);

								if (currentRow == null) {
									console.log(\"Nuevo\");
								}else{
									console.log(\"Edición-Iniciando comparación\");
									var oquantity = parseFloat(currentRow.find('[name=\"detalledelacompra-quantity[]\"]').val());
									console.log(\"Cantidad anterior: \" + oquantity);
									if (quantity<(oquantity-stock)){
										sweetAlert(\"¡Upss!\",\"La cantidad ingresada no puede ser menor a la diferencia de la cantidad adquirida (\"+oquantity+\") y el stock disponible (\"+stock+\")\");
										console.log(\"--Comparación ERROR--\");
										is_false += 1;
									}else{
										console.log(\"--Comparación OK--\");
									}

									if (is_false == 0) {
										agregardetallecompra();
									} else {
										return false;
									}
								}
							}
						}
					}).fail(function() {
						console.log(\"error\");
					});
				console.log(\"---Fin de la verificación de stock---\");	

			}

			function validateFormdetalledelacompra() {
				var is_false = 0;
				$('#panel-form-detalledelacompra .required').each(function () {
					var v = $(this).val();
					if (v == '') {
						sweetAlert(\"¡Upss!\", \"Por favor, complete el formulario!\", \"warning\");
						is_false += 1;
					}
				});
				
				if (is_false == 0) {
					return true;
				} else {
					return false;
				}
			}
		
			$('#add-purchase-detail').submit(function(e){
				e.preventDefault();
				if (validateFormdetalledelacompra() == false) {
					return false;
				}
				if (currentRow == null) {
					agregardetallecompra();
				}else{
					validateStock();
				}

			});

			function agregardetallecompra(){
				var supply_id = $('#detalledelacomprasupply_id .input-id').val();
				var purchase_id = $('#purchase_id').val();
				var quantity = $('#detalledelacompraquantity').val();
				var price = $('#detalledelacompraprice').val();
				var subtotal = $('#detalledelacomprasubtotal').val();
				var _token = $('input[name=_token]').val();
				var agrega = 0;
				if (currentRow == null) {
					agrega = 1;
				} else {
					agrega = 0;
					currentRow.removeClass('warning');
					currentRow = null;
				}
				console.log(\"---Agregando detalle de compra---\");
				console.log(\"Agrega: \" + agrega);
				console.log(\"supply_id: \" + supply_id);
				console.log(\"purchase_id: \" + purchase_id);
				console.log(\"quantity: \" + quantity);
				console.log(\"price: \" + price);
				console.log(\"subtotal: \" + subtotal);
				
				$.ajax({
					type	: 'POST',
					url 	: 'add-purchase-detail',
					data	: {
						supply_id : supply_id,
						purchase_id : purchase_id,
						quantity : quantity,
						price : price,
						subtotal : subtotal,
						agrega : agrega,
						_token : _token
					},
					success	: function(response){
						if(response){
							refreshdetalledelacompra();
						}
					}
				}).fail(function(){
					console.log(\"error\");
				});
			}

			function guardarCompra(){
				
				var id = $('#purchase_id').val();
				var doc_type = $('#doc_type').val();
				var document = $('#document').val();
				
				var purchase_date = $('#purchase_date').val();
				var provider_id = $('#provider_id').val();
				var _token = $('input[name=_token]').val();
				
				console.log(\"---Editando compra---\");
				console.log(\"id: \" + id);
				console.log(\"doc_type: \" + doc_type);
				console.log(\"document: \" + document);
				console.log(\"purchase_date: \" + purchase_date);
				console.log(\"provider_id: \" + provider_id);
				
				$.ajax({
					type	: 'POST',
					url 	: 'edit-purchase',
					data	: {
						id : id,
						doc_type : doc_type,
						document : document,
						purchase_date : purchase_date,
						provider_id : provider_id,
						_token : _token
					},
					success	: function(response){
						if(response){
							sweetAlert(\"Listo\", \"Se actualizaron los datos\", \"success\");
						}
					}
				}).fail(function(){
					console.log(\"error\");
				});
			}

			function refreshdetalledelacompra(){
				$('#table-detalledelacompra tbody').empty();
				console.log(\"---Llenando detalles de compras---\");
				var id = $('#purchase_id').val();
				console.log(\"id: \" + id);
				var trRow = '';
				$.ajax(
					{ 
						type: 'POST', 
						url: 'list-purchase-details/' + id, 
						data: '', 
						success: function(result) { 
							console.log(\"Cantidad de elementos: \" + result.length);
						
							if(result.length>0){
								console.log(\"Dentro del if: \" + result.length);
								for (var i = 0; i < result.length; i++) {
									
									trRow += '<tr>';
									trRow += \"<td class='supply_id'><span class='td-label'>\" + result[i].supply + \"</span>\" +
											 \"<input type='hidden' name='detalledelacompra-supply_id[]' value='\" + result[i].supply_id + \"'/>\" +
											 \"<input type='hidden' class='detail_id' name='detalledelacompra-supply_detail_id[]' value='\" + result[i].id + \"'/>\" +
											 \"</td>\";
									trRow += \"<td class='price'>\" + result[i].price +
											 \"<input type='hidden' name='detalledelacompra-price[]' value='\" + result[i].price + \"'/>\" +
											 \"</td>\";
									trRow += \"<td class='quantity'>\" + result[i].quantity +
											 \"<input type='hidden' name='detalledelacompra-quantity[]' value='\" + result[i].quantity + \"'/>\" +
											 \"</td>\";
									trRow += \"<td class='subtotal'>\" + result[i].subtotal +
											 \"<input type='hidden' name='detalledelacompra-subtotal[]' value='\" + result[i].subtotal + \"'/>\" +
											 \"</td>\";											 
									trRow += \"<td>\" +
											 \"<a href='javascript:void(0)' onclick='editRowdetalledelacompra(this)' class='btn btn-warning btn-xs' title='Editar detalle'><i class='fa fa-pencil'></i></a> \" +
											 \"<a href='javascript:void(0)' onclick='deleteRowdetalledelacompra(this)' class='btn btn-danger btn-xs' title='Eliminar detalle'><i class='fa fa-trash'></i></a></td>\";
									trRow += '</tr>';
									
								}
																
								$('#table-detalledelacompra tbody').prepend(trRow);
								$('#btn-add-table-detalledelacompra').val('Agregar a la Tabla');
								$('#btn-reset-form-detalledelacompra').click();
	
							}else{
								console.log(\"Dentro del else: \" + result.length);
								if ($('#table-detalledelacompra tbody tr').length == 0) {
									var colspan = $('#table-detalledelacompra thead tr th').length;
									$('#table-detalledelacompra tbody').html(\"<tr class='t'><td colspan='\" + colspan + \"' align='center'>No tenemos datos disponibles</td></tr>\");
								}
							}
						}
					}).fail(function() {
						console.log(\"error\");
					  });
			}
			";


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
	        $this->style_css = NULL;
	        
	        
	        
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
			$postdata['purchase_date'] = date("Y-m-d",strtotime($postdata['purchase_date']));
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
			$postdata['purchase_date'] = date("Y-m-d",strtotime($postdata['purchase_date']));

			//dd($postdata);
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

			// se consultarán los detalles de la compra
			$cantidades="";
			$error = 0;
			$mensaje="<p>No se puede eliminar la compra debido a: <p>";
			$data = DB::table('purchase_details')
			->where('purchase_details.purchase_id','=',$id)->get();
			foreach($data as $d){
				//$cantidades = $cantidades . $d->quantity . ' ';
				$supply = DB::table('supplies')
				->where('supplies.id','=',$d->supply_id)->get();
				if($d->quantity > $supply[0]->stock){
					$mensaje = $mensaje . "La cantidad del detalle de la compra de <b>". $supply[0]->description . "</b> a eliminar (". $d->quantity . ") no puede ser mayor al stock disponible (" . $supply[0]->stock . ")";
					$error++;
				}
			}
			
			// detendiendo la operación
			if($error>0){
				CRUDBooster::redirectBack(
					$mensaje
				);
			}else{
				/*CRUDBooster::redirectBack(
					'OK'
				);*/
			}

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

			DB::table('purchase_details')->where('purchase_id', $id)->delete();

			DB::table('purchases')
			->where('id', $id)
			->update(['state' => 0]);
	    }



	    //By the way, you can still create your own method in here... :) 


		public function getStock($id){
			$data = DB::table('supplies')
				->select('stock')				
				->where('supplies.id','=',$id)->get();
			return $data;
		}


		public function getEdit($id)
		{
		
			$data['page_title']  = "Editar compras";
			$data['editar'] = 1;
			$data['row'] = DB::table('purchases')
						->where('purchases.id',$id)->first();
				
			$data['supplies'] = DB::table('view_list_purchase_details')
						->where('view_list_purchase_details.purchase_id','=',$id)->get();
			$data['providers'] = DB::table('providers')
						->where('providers.type',"=",2)->get();	

			return $this->view('purchase_edit',$data);	
		
		}

		public function getPurchaseDetails($id){
			
			$data = DB::table('view_list_purchase_details')
				->where('view_list_purchase_details.purchase_id','=',$id)->get();
			return $data;

		}

		public function editPurchase(Request $request){

			DB::table('purchases')
              ->where('id', $request->id)
              ->update([
						'doc_type' => $request->doc_type,
						'document' => $request->document,
						'purchase_date' => date("Y-m-d",strtotime($request->purchase_date)),
						'provider_id' => $request->provider_id
					]);

			return back();
		}

		public function addPurchaseDetail(Request $request){
			$cantidad = 0;
			$subtotal = 0;
			$total = 0;
			
			if($request->agrega == 1){
				$data['purchase_detail'] = DB::table('purchase_details')
				->where('purchase_details.supply_id',$request->supply_id)
				->where('purchase_details.purchase_id',$request->purchase_id)
				->first();

				if($data['purchase_detail'] <> null){
					$cantidad = $request->quantity + $data['purchase_detail']->quantity;
					$subtotal = $cantidad * $request->price;
				}else{
					$cantidad = $request->quantity;
					$subtotal = $request->subtotal;
				}
				
			}else{
				$cantidad = $request->quantity;
				$subtotal = $request->subtotal;
			}

			DB::table('purchase_details')->updateOrInsert(
				[
					'supply_id' => $request->supply_id,
					'purchase_id' => $request->purchase_id
				],
				[
					'quantity' => $cantidad,
					'price' => $request->price,
					'subtotal' => $subtotal
				]
			);

			DB::table('purchases')
			->where('id',$request->purchase_id)
			->update(
				[
					'total' => DB::table('purchase_details')
									->where(
										[
											'purchase_id' => $request->purchase_id
										]
										)->sum('subtotal')
				]
			);


			return back();
		}
		
		public function deletePurchaseDetail(Request $request){
			
			DB::table('purchase_details')
				->where('purchase_details.id', '=', $request->id)->delete();

			return back();

		}	

	}