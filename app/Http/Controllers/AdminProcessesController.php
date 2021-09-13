<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

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
			$this->form[] = ['label'=>'Fecha de inicio','name'=>'start_date','type'=>'date','validation'=>'required|date','width'=>'col-sm-2',"callback_php"=>'($row->start_date!=null?date("d-m-Y",strtotime($row->start_date)):"")'];
			$this->form[] = ['label'=>'Fecha de entrega','name'=>'deadline','type'=>'date','validation'=>'required|date','width'=>'col-sm-2',"callback_php"=>'($row->deadline!=null?date("d-m-Y",strtotime($row->deadline)):"")'];
			$this->form[] = ['label'=>'Lote del pedido','name'=>'batch','type'=>'text','validation'=>'integer|min:0','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Lote para corte','name'=>'cutting_batch','type'=>'text','validation'=>'integer|min:0','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Lote para habilitado','name'=>'enabled_batch','type'=>'text','validation'=>'integer|min:0','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Lote para confección','name'=>'confection_batch','type'=>'text','validation'=>'integer|min:0','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Lote para acabado','name'=>'finishing_batch','type'=>'text','validation'=>'integer|min:0','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'% de avance','name'=>'advance','type'=>'money','validation'=>'integer|min:0','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Anotaciones','name'=>'notes','type'=>'textarea','validation'=>'min:1|max:500','width'=>'col-sm-5'];
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
			$(document).ready(function() { 

				$('#cutting_batch').val(0);
				$('#enabled_batch').val(0);
				$('#confection_batch').val(0);
				$('#finishing_batch').val(0);
			});
			
			$(function(){
				indice=$('#order_id option:selected').val();

				var getDate = function (input) {
					return new Date(input.date.valueOf());
				}

				$('#start_date, #deadline').datepicker({
					format: 'dd/mm/yyyy',
					todayHighlight: true,
					autoclose: true,						
					language: 'es'
				});

				$('#deadline').datepicker({
					startDate: '+6d',
					endDate: '+36d',
				});

				$('#start_date').datepicker({
					startDate: '+5d',
					endDate: '+35d',
				}).on('changeDate',
					function (selected) {
						$('#deadline').datepicker('clearDates');
						$('#deadline').datepicker('setStartDate', getDate(selected));
					});

				$('#cutting_batch').keypress(function(e){
					return esEntero(e);
				});

				$('#enabled_batch').keypress(function(e){
					return esEntero(e);
				});

				$('#confection_batch').keypress(function(e){
					return esEntero(e);
				});

				$('#finishing_batch').keypress(function(e){
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

				$('#order_id').on('change', function(e){
					indice = $('#order_id option:selected').val();
					actualiza(indice);
				});

				function actualiza(indice){
					
					$('#order_date').val($(''#order_id option:selected'').text());

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

		public function getAdd()
		{
			$data['page_title']  = "Agregar nuevo proceso productivo";
			$data['orders'] = DB::table('orders')->get();
			//$this->cbView('post_add',$data);
			return $this->view('post_add',$data);
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
			// Actualizando el formato de las fechas
			if($column_index == 2 || $column_index == 4){
				$column_value = date("d/m/Y",strtotime($column_value));

			}
			// Formateando porcentaje
			if($column_index == 5){
				$column_value = number_format($column_value, 2) . ' %';
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
			$postdata['start_date'] = date("Y-m-d",strtotime($postdata['start_date']));
			$postdata['deadline'] = date("Y-m-d",strtotime($postdata['deadline']));
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


	}