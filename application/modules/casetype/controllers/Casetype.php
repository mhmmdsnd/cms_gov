<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#session_start(); //we need to call PHP's session object to access it through CI
class Casetype extends CI_Controller {

	private $limit = 10;
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('mstcase_model');
        $this->load->library('pagination');
    }
    
    function index($offset=0, $order_column='casetypeId', $order_type='asc')
    {
        if($this->session->userdata('logged_in'))
        {
            if (!$offset) $offset=0;
            if (!$order_column) $order_column = 'casetypeId';
            if (!$order_type) $order_type = 'asc';
            
            $data['result'] = $this->mstcase_model->casetype_paged_list($this->limit, $offset, $order_column, $order_type);
            
            $config['base_url']=site_url('casetype/index/');
            $config['total_rows']=$this->mstcase_model->casetype_count_all();
            $config['per_page']=$this->limit;
            $config['uri_segment']='3';
            $this->pagination->initialize($config);
            $data['paginator']=$this->pagination->create_links();
            
            //table data
            $this->template->set('title','Case Type');
            $this->template->load('cpanel/template','casetype_view',$data);
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
        	$data_grp = array('casetypeName' => $this->input->post('casetypename'));
        	$id = $this->mstcase_model->casetype_save($data_grp);
        	//redirect
        	redirect('casetype/index/');
        }
        // load view
        $this->template->set('title','Case Type :: Add Case Type');
        $this->template->load('cpanel/template','casetypeAddUpdate');
    }
    
    function update ($id)
    {
        $data['detail'] = $this->mstcase_model->casetype_by_id($id)->row();
        
        if($this->input->post('action')){
        	$id = $this->input->post('id');
        	$data_grp = array('casetypeName' => $this->input->post('casetypename'));
        	$this->mstcase_model->casetype_update($id,$data_grp);
        	
            //redirect
            redirect('casetype/index/');
        }
        
        $this->template->set('title','Case Type :: Edit Case Type');
        $this->template->load('cpanel/template','casetypeAddUpdate',$data);
    }/**/
    function delete ($id)
    {
    	$this->mstcase_model->casetype_delete($id);
    	redirect('casetype/index/', 'refresh');
    }
}
?>