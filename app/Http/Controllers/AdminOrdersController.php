<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminOrdersController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->table = "orders";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"N° de Pedido","name"=>"id"];
			$this->col[] = ["label"=>"Tipo","name"=>"type"];
			$this->col[] = ["label"=>"Fecha del pedido","name"=>"order_date"];
			$this->col[] = ["label"=>"Cliente","name"=>"customer_id","join"=>"customers,business_name"];
			$this->col[] = ["label"=>"Fecha de entrega","name"=>"delivery_date"];
			$this->col[] = ["label"=>"Costo Total del pedido","name"=>"total"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Tipo','name'=>'type','type'=>'select','dataenum'=>'1|Proforma;2|Pedido','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
			$this->form[] = ['label'=>'Fecha del Pedido','name'=>'order_date','type'=>'date','validation'=>'required','width'=>'col-sm-2',"callback_php"=>'($row->order_date!=null?date("d-m-Y",strtotime($row->order_date)):"")'];
			$this->form[] = ['label'=>'Cliente','name'=>'customer_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-5','datatable'=>'customers,business_name'];
			$this->form[] = ['label'=>'Fecha de entrega','name'=>'delivery_date','type'=>'date','validation'=>'required|date','width'=>'col-sm-2',"callback_php"=>'($row->delivery_date!=null?date("d-m-Y",strtotime($row->delivery_date)):"")'];
			

			$columns[] = [
				'label'=>'Prendas',
				'name'=>'garment_id',
				'type'=>'datamodal',
				'datamodal_table'=>'view_list_products',
				'datamodal_columns'=>'garment_description,price',
				'datamodal_columns_alias'=>'Producto,Precio',
				'datamodal_select_to'=>'garment_description,price:garment_price',
				'required'=>true];
			
			$columns[] = ['label'=>'Precio','name'=>'garment_price','type'=>'text','required'=>true];
			$columns[] = ['label'=>'Cantidad','name'=>'quantity','type'=>'text','required'=>true];
			$columns[] = ['label'=>'Descuento','name'=>'discount','type'=>'text','value'=>'0'];
			$columns[] = ['label'=>'Sub Total','name'=>'subtotal','type'=>'number','formula'=>"[quantity] * [garment_price] - [discount]","readonly"=>true,'required'=>true];


			$this->form[] = [
				'label'=>'Detalle del Pedido',
				'name'=>'order_details',
				'type'=>'child',
				'columns'=>$columns,
				'table'=>'order_details',
				'foreign_key'=>'order_id'];
			
			$this->form[] = ['label'=>'Sub total','name'=>'subtotal','type'=>'number','validation'=>'required|min:0','width'=>'col-sm-2','readonly'=>'1'];
			$this->form[] = ['label'=>'Impuesto','name'=>'tax','type'=>'number','validation'=>'required|min:0','width'=>'col-sm-2','readonly'=>'1'];
			$this->form[] = ['label'=>'Total','name'=>'total','type'=>'number','validation'=>'required|min:0','width'=>'col-sm-2','readonly'=>'1'];
			$this->form[] = ['label'=>'Adelanto','name'=>'advance_payment','type'=>'text','validation'=>'numeric|min:0','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Pago restante','name'=>'pending_payment','type'=>'number','validation'=>'required|min:0','width'=>'col-sm-2','readonly'=>'1'];
			
			
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Tipo','name'=>'type','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'Fecha del Pedido','name'=>'order_date','type'=>'date','validation'=>'required','width'=>'col-sm-2','dataenum'=>'1|Proforma;2|Pedido'];
			//$this->form[] = ['label'=>'Cliente','name'=>'customer_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Fecha de entrega','name'=>'delivery_date','type'=>'date','validation'=>'required|date','width'=>'col-sm-2','datatable'=>'customers,business_name'];
			//$this->form[] = ['label'=>'Detalle del Pedido','name'=>'order_details','type'=>'child','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Sub total','name'=>'subtotal','type'=>'number','validation'=>'required|min:0','width'=>'col-sm-2','table'=>'order_details','foreign_key'=>'order_id'];
			//$this->form[] = ['label'=>'Impuesto','name'=>'tax','type'=>'number','validation'=>'required|min:0','width'=>'col-sm-2','readonly'=>'1'];
			//$this->form[] = ['label'=>'Total','name'=>'total','type'=>'number','validation'=>'required|min:0','width'=>'col-sm-2','readonly'=>'1'];
			//$this->form[] = ['label'=>'Adelanto','name'=>'advance_payment','type'=>'number','validation'=>'numeric|min:0','width'=>'col-sm-2','readonly'=>'1'];
			//$this->form[] = ['label'=>'Pago restante','name'=>'pending_payment','type'=>'number','validation'=>'required|min:0','width'=>'col-sm-2'];
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


					$('.input_date').datepicker({
						format: 'dd-mm-yyyy',
						todayHighlight: true,
						autoclose: true,						
						language: 'es'
					});

					$('#detalledelpedidoquantity').keypress(function(e){
						return esEntero(e);
					});

					$('#detalledelpedidogarment_price').keypress(function(e){
						return filterFloat(e,this);
					});

					$('#detalledelpedidodiscount').keypress(function(e){
						return filterFloat(e,this);
					});

					$('#advance_payment').keypress(function(e){
						//return esDecimal(e);
						return filterFloat(e,this);
					});

					function esEntero(key) {
						var keycode = (key.which) ? key.which : key.keyCode;
						if (keycode > 31 && (keycode < 48 || keycode > 57)) {
							return false;
						}else {
							return true; 
						}
					}

					function esDecimal(key) {
						var keycode = (key.which) ? key.which : key.keyCode;
						if (keycode > 31 && (keycode < 48 || keycode > 57) && keycode != 46) {
							return false;
						}else {
							return true; 
						}
					}

					function filterFloat(evt,input){
						// Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
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

					
					setInterval(function(){
						var subtotal = 0;
						var tax = 0;
						var total = 0;
						var pending = 0;
						var advance = $('#advance_payment').val().replace(/,/g, '');

									
						$('#table-detalledelpedido tbody .subtotal').each(function(){
							var amount = parseInt($(this).text());
							total += amount;
						});

						tax = total * 0.18;
						subtotal = total - round(tax);

						if(isNaN(advance))
							pending = total
						else
							pending = total - advance;

						$('#subtotal').val(round(subtotal));
						$('#tax').val(round(tax));


						$('#total').val(round(total));
						$('#pending_payment').val(pending);
						
					},500);
				});
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
			// Colocando el tipo de Pedido
			if($column_index == 2){
				if($column_value==1)
					$column_value = 'Proforma';
				elseif($column_value==2)
					$column_value = 'Pedido';
			}
			// Actualizando el formato de las fechas de pedido y fecha de entrega
			if($column_index == 3 || $column_index == 5){
				$column_value = date("d/m/Y",strtotime($column_value));

			}
			// Formateando costo del pedido
			if($column_index == 6){
				$column_value = 'S/ ' . number_format($column_value, 2);
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

			//$postdata['delivery_date'] = AdminOrdersController::formateador($postdata['delivery_date']);
			//$postdata['order_date'] = AdminOrdersController::formateador($postdata['order_date']);
			$postdata['delivery_date'] = date("Y-m-d",strtotime($postdata['delivery_date']));
			$postdata['order_date'] = date("Y-m-d",strtotime($postdata['order_date']));
			//dd($postdata['delivery_date']);

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
			$postdata['delivery_date'] = date("Y-m-d",strtotime($postdata['delivery_date']));
			$postdata['order_date'] = date("Y-m-d",strtotime($postdata['order_date']));
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
		public static function formateador($fecha){
			$formatter = new \IntlDateFormatter('es_PE', \IntlDateFormatter::NONE, \IntlDateFormatter::NONE);
			$formatter->setPattern('dd-mm-yyyy');
			$formatter_parse = $formatter->parse($fecha);
			$date_formatted = date('Y-m-d', $formatter_parse);
			dd($formatter);
			dd($fecha);
			dd($date_formatted);
			return $date_formatted;
		}

	}