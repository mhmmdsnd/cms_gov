<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#session_start(); //we need to call PHP's session object to access it through CI
class Casestep extends CI_Controller {

	private $limit = 10;
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('mstcase_model');
        $this->load->library('pagination');
    }
    
    function index($offset=0, $order_column='casestepId', $order_type='asc')
    {
        if($this->session->userdata('logged_in'))
        {
            if (!$offset) $offset=0;
            if (!$order_column) $order_column = 'casestepId';
            if (!$order_type) $order_type = 'asc';
            
            $data['result'] = $this->mstcase_model->get_paged_list($this->limit, $offset, $order_column, $order_type);
            
            $config['base_url']=site_url('casestep/index/');
            $config['total_rows']=$this->mstcase_model->count_all();
            $config['per_page']=$this->limit;
            $config['uri_segment']='3';
            $this->pagination->initialize($config);
            $data['paginator']=$this->pagination->create_links();
            
            //table data
            $this->template->set('title','Case Step');
            $this->template->load('cpanel/template','casestep_view',$data);
        }
        else
        {
             //If no session, redirect to login page
             redirect('login', 'refresh');
        }
    }
    function create () 
    {
        if($this->input->post('action')=="Save"){
        	$data_grp = array('casestepName' => $this->input->post('casestepname'));
        	$id = $this->mstcase_model->save($data_grp);
        	//redirect
        	redirect('casestep/index/');
        }
        // load view
        $this->template->set('title','Case Step :: Add Case Step');
        $this->template->load('cpanel/template','casestepAddUpdate');
    }
    
    function update ($id)
    {
        $data['detail'] = $this->mstcase_model->get_by_id($id)->row();
        
        if($this->input->post('action')){
        	$id = $this->input->post('id');
        	$data_grp = array('casestepName' => $this->input->post('casestepname'));
        	$this->mstcase_model->update($id,$data_grp);
        	
            //redirect
            redirect('casestep/index/');
        }
        
        $this->template->set('title','Case Step :: Edit Case Step');
        $this->template->load('cpanel/template','casestepAddUpdate',$data);
    }/**/
    function delete ($id)
    {
    	$this->mstcase_model->delete($id);
    	redirect('casestep/index/');
    }
}
?>