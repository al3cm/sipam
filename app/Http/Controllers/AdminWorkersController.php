<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminWorkersController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "name";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = false;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = false;
			$this->button_delete = false;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = true;
			$this->table = "cms_users";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Tipo doc.","name"=>"cms_users.id_type","callback"=>function($row) {
					if ($row->id_type == 1)
						return "DNI";
					elseif ($row->id_type == 2)
						return "CE";
				}];
			//$this->col[] = ["label"=>"Tipo doc.","name"=>"(if(cms_users.id_type = 1,'DNI',if(cms_users.id_type = 2,'CE',''))) as tipo_doc "];
			$this->col[] = ["label"=>"Doc. Id.","name"=>"cms_users.id_number"];
			$this->col[] = ["label"=>"Nombre","name"=>"cms_users.name"];
			$this->col[] = ["label"=>"Cargo","name"=>"cms_privileges.name"/*,"join"=>"cms_privileges,name"*/];
			$this->col[] = ["label"=>"Email","name"=>"cms_users.email"];
			$this->col[] = ["label"=>"Teléfono","name"=>"cms_users.phone"];
			$this->col[] = ["label"=>"Tareas pendientes","name"=>"(select count(*) from tasks where tasks.user_id=cms_users.id and tasks.check=0) as pendientes"];
			$this->col[] = ["label"=>"Procesos activos","name"=>"(select count(distinct tasks.process_id) from tasks where tasks.user_id=cms_users.id and tasks.check=0) as procesos"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Name','name'=>'name','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10','placeholder'=>'Puedes introducir solo una letra'];
			$this->form[] = ['label'=>'Photo','name'=>'photo','type'=>'upload','validation'=>'required|image|max:3000','width'=>'col-sm-10','help'=>'Tipo de imágenes soportados: JPG, JPEG, PNG, GIF, BMP'];
			$this->form[] = ['label'=>'Email','name'=>'email','type'=>'email','validation'=>'required|min:1|max:255|email|unique:cms_users','width'=>'col-sm-10','placeholder'=>'Introduce una dirección de correo electrónico válida'];
			$this->form[] = ['label'=>'Password','name'=>'password','type'=>'password','validation'=>'min:3|max:32','width'=>'col-sm-10','help'=>'Mínimo 5 caracteres. Deja este campo vacio si no solicitaste un cambio de contraseña.'];
			$this->form[] = ['label'=>'Cms Privileges','name'=>'id_cms_privileges','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'cms_privileges,name'];
			$this->form[] = ['label'=>'Status','name'=>'status','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Type','name'=>'id_type','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'type,id'];
			$this->form[] = ['label'=>'Number','name'=>'id_number','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'number,id'];
			$this->form[] = ['label'=>'Dob','name'=>'dob','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Nacionality','name'=>'nacionality','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Gender','name'=>'gender','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Phone','name'=>'phone','type'=>'number','validation'=>'required|numeric','width'=>'col-sm-10','placeholder'=>'Puedes introducir solo un número'];
			$this->form[] = ['label'=>'Personal Email','name'=>'personal_email','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Address','name'=>'address','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Salary','name'=>'salary','type'=>'money','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Name","name"=>"name","type"=>"text","required"=>TRUE,"validation"=>"required|string|min:3|max:70","placeholder"=>"Puedes introducir solo una letra"];
			//$this->form[] = ["label"=>"Photo","name"=>"photo","type"=>"upload","required"=>TRUE,"validation"=>"required|image|max:3000","help"=>"Tipo de imágenes soportados: JPG, JPEG, PNG, GIF, BMP"];
			//$this->form[] = ["label"=>"Email","name"=>"email","type"=>"email","required"=>TRUE,"validation"=>"required|min:1|max:255|email|unique:cms_users","placeholder"=>"Introduce una dirección de correo electrónico válida"];
			//$this->form[] = ["label"=>"Password","name"=>"password","type"=>"password","required"=>TRUE,"validation"=>"min:3|max:32","help"=>"Mínimo 5 caracteres. Deja este campo vacio si no solicitaste un cambio de contraseña."];
			//$this->form[] = ["label"=>"Cms Privileges","name"=>"id_cms_privileges","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"cms_privileges,name"];
			//$this->form[] = ["label"=>"Status","name"=>"status","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Type","name"=>"id_type","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"type,id"];
			//$this->form[] = ["label"=>"Number","name"=>"id_number","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"number,id"];
			//$this->form[] = ["label"=>"Dob","name"=>"dob","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"Nacionality","name"=>"nacionality","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Gender","name"=>"gender","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Phone","name"=>"phone","type"=>"number","required"=>TRUE,"validation"=>"required|numeric","placeholder"=>"Puedes introducir solo un número"];
			//$this->form[] = ["label"=>"Personal Email","name"=>"personal_email","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Address","name"=>"address","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Salary","name"=>"salary","type"=>"money","required"=>TRUE,"validation"=>"required|integer|min:0"];
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
	        $this->script_js = NULL;


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
			$query->join('cms_privileges','cms_privileges.id','=','cms_users.id_cms_privileges')
				  ->where('cms_privileges.is_superadmin',0)
				  ->where('cms_privileges.id','<>',4)
			;
	        /*$query->where('status','Active')
				  ->where('cms_privileges.is_superadmin',0)
				  ->where('cms_privileges.id','<>',4)
				  ->get();*/
			//dd($query);
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
			/*if($column_index == 0){
				if($column_value==1)
					$column_value = 'DNI';
				elseif($column_value==2)
					$column_value = 'CE';
			}*/
/*
			if($column_index == 6){
				$id = $column_value;
				$column_value = DB::table('tasks')
				->where('tasks.user_id','=',$id)
				->where('tasks.check','=',0)
				->count();
			}					
*/
		/*	if($column_index == 7){
				$id = $column_value;
				$column_value = DB::table('tasks')
				->where('tasks.user_id','=',$id)
				->where('tasks.check','=',0)
				->distinct()
				->count('tasks.process_id');
			}		*/
			
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

		public function getDetail($id){
			//dd($id);
			$data['page_title']  = "Detalle de trabajador";

			$data['row'] = DB::table('cms_users')
						->where('cms_users.id',$id)->first();

			$data['privilege'] = DB::table('cms_privileges')
						->where('cms_privileges.id',$data['row']->id_cms_privileges)->first();
						
			$data['tasks'] = DB::table('tasks')
						->join('processes','processes.id','=','tasks.process_id')
						->join('orders','orders.id','=','processes.order_id')
						->join('customers','customers.id','=','orders.customer_id')
						->select('tasks.title as t_title',
								 'tasks.description as t_description',
								 'processes.advance as p_advance',
								 'processes.deadline as p_deadline',
								 'orders.id as o_id',
								 'customers.business_name as c_business_name')				
						->where('tasks.user_id',$data['row']->id)
						->where('tasks.check',0)
						->get();


			return $this->view('worker_detail',$data);	

		}


	    //By the way, you can still create your own method in here... :) 


	}