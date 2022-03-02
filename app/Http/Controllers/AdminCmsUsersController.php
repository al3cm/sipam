<?php namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use CRUDbooster;
use crocodicstudio\crudbooster\controllers\CBController;

class AdminCmsUsersController extends CBController {


	public function cbInit() {
		# START CONFIGURATION DO NOT REMOVE THIS LINE
		$this->table               = 'cms_users';
		$this->primary_key         = 'id';
		$this->title_field         = "name";
		$this->button_action_style = 'button_icon';	
		$this->button_import 	   = FALSE;	
		$this->button_export 	   = true;	
		# END CONFIGURATION DO NOT REMOVE THIS LINE
	
		# START COLUMNS DO NOT REMOVE THIS LINE
		$this->col = array();
		$this->col[] = array("label"=>"Name","name"=>"name");
		$this->col[] = array("label"=>"Email","name"=>"email");
		$this->col[] = array("label"=>"Privilege","name"=>"id_cms_privileges","join"=>"cms_privileges,name");
		$this->col[] = array("label"=>"Photo","name"=>"photo","image"=>1);		
		# END COLUMNS DO NOT REMOVE THIS LINE

		# START FORM DO NOT REMOVE THIS LINE
		$this->form = array(); 		
		$this->form[] = array("label"=>"Name","name"=>"name",'required'=>true,'validation'=>'required|alpha_spaces|min:3');
		$this->form[] = array("label"=>"E-mail","name"=>"email",'required'=>true,'type'=>'email','validation'=>'required|email|unique:cms_users,email,'.CRUDBooster::getCurrentId());		
		$this->form[] = array("label"=>"Photo","name"=>"photo","type"=>"upload","help"=>"Recommended resolution is 200x200px",'required'=>true,'validation'=>'required|image|max:1000','resize_width'=>90,'resize_height'=>90);											
		$this->form[] = array("label"=>"Privilege","name"=>"id_cms_privileges","type"=>"select","datatable"=>"cms_privileges,name",'required'=>true);						
		// $this->form[] = array("label"=>"Password","name"=>"password","type"=>"password","help"=>"Please leave empty if not change");
		$this->form[] = array("label"=>"Password","name"=>"password","type"=>"password","help"=>"Favor de dejar vacío si no se desea cambiar");
		$this->form[] = array("label"=>"Password Confirmation","name"=>"password_confirmation","type"=>"password","help"=>"Favor de dejar vacío si no se desea cambiar");

		$this->form[] = array('label'=>'Tipo de documento','name'=>'id_type','type'=>'select','validation'=>'min:1|max:30','width'=>'col-sm-4','dataenum'=>'1|DNI;2|C.E.','default'=>'** Elija un tipo de documento');
		$this->form[] = array('label'=>'N° de documento','name'=>'id_number','type'=>'text','validation'=>'min:1|max:9|unique:cms_users','width'=>'col-sm-4');
		$this->form[] = array('label'=>'Fecha de nacimiento','name'=>'dob','type'=>'date','width'=>'col-sm-4');
		$this->form[] = array('label'=>'Nacionalidad','name'=>'nacionality','type'=>'select','validation'=>'min:1|max:20','width'=>'col-sm-4','dataenum'=>'Peruano;Venezolano;Colombiano;Chileno;Argentino;Ecuatoriano;Otro','default'=>'** Seleccione una nacionalidad');
		$this->form[] = array('label'=>'Género','name'=>'gender','type'=>'select','validation'=>'min:1|max:30','width'=>'col-sm-4','dataenum'=>'1|Masculino;2|Femenino;3|Otro','default'=>'** Seleccione un género');
		$this->form[] = array('label'=>'Teléfono','name'=>'phone','type'=>'text','validation'=>'min:1|max:9','width'=>'col-sm-4');
		$this->form[] = array('label'=>'E-mail personal','name'=>'personal_email','type'=>'email','validation'=>'max:50|email|unique:cms_users');		
		$this->form[] = array('label'=>'Dirección','name'=>'address','type'=>'text','validation'=>'min:1|max:100');
		$this->form[] = array('label'=>'Salario S/','name'=>'salary','type'=>'number', 'step'=>0.05,'validation'=>'numeric|min:0','decimals'=>'2','dec_point'=>'.','width'=>'col-sm-2');

		# END FORM DO NOT REMOVE THIS LINE
				
	}

	public function getProfile() {			

		$this->button_addmore = FALSE;
		$this->button_cancel  = FALSE;
		$this->button_show    = FALSE;			
		$this->button_add     = FALSE;
		$this->button_delete  = FALSE;	
		$this->hide_form 	  = ['id_cms_privileges'];

		$data['page_title'] = cbLang("label_button_profile");
		$data['row']        = CRUDBooster::first('cms_users',CRUDBooster::myId());

        return $this->view('crudbooster::default.form',$data);
	}
	public function hook_before_edit(&$postdata,$id) { 
		unset($postdata['password_confirmation']);
	}
	public function hook_before_add(&$postdata) {      
	    unset($postdata['password_confirmation']);
	}
	public function hook_after_add($id) {
		//Your code here
		DB::table('cms_users')
		->where('id', $id)
		->update(['status' => 'Active']);
	}
	public function hook_after_delete($id) {
		//Your code here
		DB::table('cms_users')
		->where('id', $id)
		->update(['status' => 'Inactive']);
	}
}
