<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('trnnewcase_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
		    $session_data = $this->session->userdata('logged_in');
		    $data['loginname'] = $session_data['loginname'];
		    
		    $data['result'] = $this->trnnewcase_model->getcaseList();
            		    
		    $this->template->set('title','Home');
        	$this->template->load('front/vw_Home','vw_Front',$data);
		} else {
			
			$data['result'] = $this->trnnewcase_model->getcaseList();
            
			$this->template->set('title','Home');
        	$this->template->load('front/vw_Home','vw_Front',$data);
		}
		
		//$this->load->view('vw_Home');
	}
	public function faq()
	{
		$this->template->set('title','About');
        $this->template->load('front/vw_Home','vw_Faq');
		//$this->load->view('vw_Home');
	}
}
