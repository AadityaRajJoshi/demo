<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller{

	public function index(){

		if(is_logged_in())
			do_redirect('dashboard');

		$cookie = json_decode( get_cookie( 'user_logged_in' ) );
		$user = false;
		if('' != $cookie && isset($cookie->user)){
			$user = array(
				'name' => $cookie->user,
				'pass' => $cookie->pass
			);
		}
		$this->data['meta'] = get_msg('meta_login');
		$this->data['page'] = 'login_v';
		$this->data['cookie'] = $user;
		
		$this->load->view('login_template_v', $this->data);
	}

	public function login(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', get_msg('label_username'), 'required');
		$this->form_validation->set_rules('password', get_msg('label_password'), 'required');
		# check validation
		if ( $this->form_validation->run() ){
			$username = $this->input->post( 'username' );
			$remember = $this->input->post( 'remember_me' );
			$password = md5( $this->input->post( 'password' ) );
			$select = strpos( $username, '@' ) ? 'email' : 'username' ;

			$condition = array(
				$select    => $username,
				'password' => $password
			);

			$this->load->model( 'user_m' );
			$db_user = $this->user_m->get( 'u.*', $condition, 1 );
			if ( !$db_user ) {
				$this->data['error'][] = get_msg( 'up_mismatched' );
			}else{
				$this->session->set_userdata(array(
					'id' => $db_user->id,	
					'name' => $username,
					'role' => get_role_by_id($db_user->role_id)
				));

				if( $this->input->post( 'remember_me' ) && 'on' == $this->input->post( 'remember_me' ) ) {

					set_cookie( 
						'user_logged_in', 
						json_encode([
							'user' => $username,
							'pass' => $this->input->post( 'password' ),
						]),
						30*60*60 
					);
				}
				do_redirect('dashboard');
			}
		}

		$this->index();
	}

	public function forgot(){
		$this->data['meta'] = get_msg('meta_forgot');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', get_msg('label_email'), 'trim|required|valid_email');
		if($this->form_validation->run()){
			$this->load->model('user_m');
			$user = $this->user_m->get( 'u.*', array( 'email' =>  $this->input->post( 'email' ) ), 1 );
			if($user){
				$new_pass = $this->random_password();
				$update = $this->user_m->save(
					array(
						'password' => md5($new_pass)
					),
					array('id' => $user->id)
				);
				if( $update ){
					// TODO SEND EMAIL
					file_put_contents(__DIR__.'../password.txt', print_r( $this->input->post( 'email' ).' => '. $new_pass, 1) );
					$this->session->set_flashdata( 'success', get_msg( 'pass_reset' ) );
					do_redirect('login');
				}else{
					$this->session->set_flashdata( 'error', get_msg( 'pass_reset' ) );
					do_redirect('login');
				}
			}else{
				$this->data['error'][] = get_msg( 'user_not_found' );
			}
		}
		$this->data['page'] = 'forgot_v';
		$this->load->view( 'login_template_v', $this->data );
	}

	public function logout() {
	    $this->session->sess_destroy();
	    do_redirect('login');
	}

	public function profile(){
		$this->edit(get_session('id'), 'own');
	} 

	public function edit($id=null, $mode='other'){

		$start_date = $this->input->get( 'f' );
		$end_date = $this->input->get('t');

        if((is_staff() && get_session('id') != $id) ||  $id <= 0 ){
        	$this->invalid_access();
        }

        $this->load->model('user_m');
        $user = $this->user_m->get('u.*', array('u.id'=>$id ), 1);
       
        if(! $user){
        	$this->invalid_access();
        }
		
		if( $mode == 'own' ){
        	$id = $this->input->post('id');
		}

        if($id){
        	if($id<=0)
        		$this->invalid_access();

        	if( is_staff() && get_session( 'id' ) != $id )
        		$this->invalid_access();

        	$update = $this->save($id);
        	if($update)
        		$user = $this->user_m->get('u.*', array('u.id'=>$id ), 1);
        }

        $this->data['user'] = $user;

        if('own' == $mode){
        	# Editing own profile
    		$this->data['meta'] = get_msg('meta_edit_staff');
	        $this->data['breadcrumb'] = get_msg('breadcrumb_user_edit_own');
	        $this->data['body_class'] = 'template-profile';
        	$this->data['current_menu'] = 'dashboard';
        }else{
        	$this->load->model( 'event_m' );
			$events = $this->user_m->get_events($id);
        	$this->data['events'] = $events;
    		$this->data['meta'] = get_msg('meta_edit_profile');
	        $this->data[ 'breadcrumb' ] = get_msg('breadcrumb_user_edit_other');
	        $this->data['body_class'] = 'template-staff-profile';
        	$this->data['current_menu'] = 'staff';
	        $mode = 'other';
        }

        $this->data['mode'] = $mode;
        $this->data['common'] = true;
        $this->data['page'] = 'profile_v';
        $this->data['current_menu'] = 'dashboard';

        $this->load->view('dashboard_template_v', $this->data);    
    }

    public function add(){
    	
    	if(! is_admin())
    		$this->invalid_access();

    	$this->data[ 'meta' ] = get_msg('meta_add_staff');
    	$this->data['page'] = 'profile_v';
    	$this->data['common'] = true;
    	$this->data['user'] = false;
    	$this->data['mode'] = 'add';
    	$this->data['breadcrumb'] = get_msg('breadcrumb_add_staff');
    	$this->data['current_menu'] = 'staff';

    	$this->save();
    	$this->load->view( 'dashboard_template_v', $this->data );
    }

	public function save($id=false){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', get_msg('label_name'), 'trim|required' );
		$this->form_validation->set_rules('email', get_msg('label_email'), 'trim|required|valid_email|is_unique[users.email]',
			array( 'is_unique' => get_msg( 'email_taken' ) )
		);
		$this->form_validation->set_rules('phone_number', get_msg('label_phone_number'), 'required|regex_match[/^[0-9]{10}$/]' );

		if(! $id)
			$this->form_validation->set_rules('password', get_msg('label_password'), 'required' );
		
		if($this->form_validation->run()){
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$phone_number = $this->input->post('phone_number');
			$password = $this->input->post('password');
			
			$data = array(
				'username'=> $username,
				'email' => $email,
				'phone_number' => $phone_number,
			);

			if( $password != '' ){
				$data['password'] = md5($password);
			}
			$where = $id ? array('id'=>$id) : false;
			if( $where ){
				# do update 
				if(isset($_FILES['userfile']) && $_FILES['userfile']['size'] > 0){
					$config = $this->config->item('profile_picture');
					$config['file_name'] = $id;
					$this->load->library('upload', $config);
					if($this->upload->do_upload('userfile')){
						$upload_data = $this->upload->data();
				
						foreach(explode('|',$config['allowed_types']) as $ext){
							$file_name = $id . '.' . $ext;
							$path = $config['upload_path'] . $file_name;
							if($upload_data['file_name'] != $file_name && file_exists($path)){
								unlink($path);
							}
						}
					}else{
						$this->data['error'][] = $this->upload->display_errors();
					}
				}
			}else{
				# do insert
				$data['role_id'] = get_role_id("staff");
			}
			
			$this->load->model( 'user_m' );
			$operation = $this->user_m->save( $data, $where );

			if( $id ){
				# Need to update staff
				if($operation){
					$this->data['success'][] = get_msg('user_updated');
					return true;
				}else{
					$this->data['error'][] = get_msg('user_update_failed');
					return false;
				}
			}else{
				# Need to create staff
				if($operation){
					$this->session->set_flashdata( 'success', get_msg( 'staff_added' ) );
					do_redirect('staff');
				}else{
					$this->data['error'][] = get_msg('up_mismatched');
					return false;
				}
			}
		}else{
			return false;
		}
	}

	public function download_pdf( $id ){

		if(!is_admin())
			$this->invalid();

		$this->load->model( 'user_m' );
		$user = $this->user_m->get('*',['id' => $id], 1);
		if(!$user)
			$this->invalid();

		$pdf_name = $user->username.'-'.$user->id.'.pdf';

		$this->load->library("Pdf");
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
	    $pdf->SetAuthor('Eagle Vision IT');
	    $pdf->SetTitle(get_msg('tcpdf_title'));
	    $pdf->SetSubject(get_msg('tcpdf_subject'));
	    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');	  
		  
	    // set margins
	    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);	  
	  
	    // Set font
	    // dejavusans is a UTF-8 Unicode font, if you only need to
	    // print standard ASCII chars, you can use core fonts like
	    // helvetica or times to reduce file size.
	    $pdf->SetFont('dejavusans', '', 14, '', true);   
	  
	    // Add a page
	    // This method has several options, check the source code documentation for more information.
	    $pdf->AddPage(); 
	   
	    // Set some content to print
		$this->data['events'] = $this->user_m->get_events($id);
		$this->data['user'] = $user;
		ob_start();
		$this->load->view('pdf', $this->data);
		$html = ob_get_clean();
	    // Print text using writeHTMLCell()
	    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);   
	  
	    // ---------------------------------------------------------    
	    // Close and output PDF document
	    // This method has several options, check the source code documentation for more information.
	    $pdf->Output($pdf_name, 'I'); 
	}
}