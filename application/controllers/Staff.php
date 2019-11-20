<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('user_m');
	} 

	public function index(){

		if(! is_admin() )
			do_redirect('dashboard');

		$this->data[ 'meta' ][ 'title' ] = get_msg( 'staff' );
		$this->data[ 'breadcrumb' ] = get_msg( 'breadcrumb_all_staff' );	
		$this->data['staffs'] = $this->user_m->get( '*', array(
			'role_id' =>get_role_id("staff")
		));
		$this->data['page'] = 'staff_list_v';
		$this->data['current_menu'] = 'staff';
		$this->load->view( 'dashboard_template_v', $this->data );	
	}
	
	public function delete( $id = false ){
		if( $this->is_admin() ){

			$this->data['id'] = $id;
			$this->data['action'] = "staff/delete"; 
			$this->data['confirm'] = "Are You sure want to delete?";
			$this->data['page'] = 'delete_v';
			$this->load->view( 'dashboard_template_v', $this->data );

			if( $this->input->post('yes') ){
				$id = $this->input->post('id');
			
				if($this->user_m->delete(array('id'=>$id))){
					$this->session->set_flashdata( 'success', get_msg( 'staff_delete' ) );
				}
				do_redirect('staff');
			}
		}
	}

	public function download_pdf(){
		if(!is_admin()){
			$this->invalid();
		}
		$staff_id = 48;
		$user = $this->user_m->get('*',['id' => $staff_id], 1);
		if(!$user){
			$this->invalid();
		}

		$pdf_name = $user->username.'-'.$user->id.'.pdf';
		$events = $this->user_m->get_events($staff_id);

		$this->load->library("Pdf");
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
	    $pdf->SetAuthor('Muhammad Saqlain Arif');
	    $pdf->SetTitle('My Title');
	    $pdf->SetSubject('TCPDF Tutorial');
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
	    $html = <<<EOD
	    <h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
	    <i>This is the first example of TCPDF library.</i>
	    <p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
	    <p>Please check the source code documentation and other examples for further information.</p>
	     
	EOD;
		  
	    // Print text using writeHTMLCell()
	    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);   
	  
	    // ---------------------------------------------------------    
	  
	    // Close and output PDF document
	    // This method has several options, check the source code documentation for more information.
	    $pdf->Output($pdf_name, 'I'); 
	}	
}