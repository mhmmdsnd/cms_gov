<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#session_start(); //we need to call PHP's session object to access it through CI
class Parameter extends CI_Controller {
	
	private $limit = 10;
	function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('trnpetisi_model');
        $this->load->model('mstlocation_model');
        $this->load->library('pagination');
    }
    function index()
    {
		$session = $this->session->userdata('logged_in');
    	if($session['username']) $updateBy = $session['username'];
    	else $updateBy = $session['loginname'];
    	
    	if($this->session->userdata('logged_in'))
		{
			$data['getparam'] = $this->trnpetisi_model->sign_parameter()->row();
			
			if($this->input->post('action')=="Submit")
			{
				$data = array('maxsign'=>$this->input->post('maxsign'),'debate'=>$this->input->post('debate'),
				'updateBy'=>$updateBy,'updateDate'=>date('Y-m-d H:i:s'));
				$this->trnpetisi_model->update_parameter($data);
				
				redirect($_SERVER['REQUEST_URI']);
			}
			
			$this->template->set('title','Cases Parameter');
            $this->template->load('cpanel/template','parameter_addUpdate',$data); //$data
		}
		else {
			redirect('login', 'refresh');
		}
    	
    }
    
}