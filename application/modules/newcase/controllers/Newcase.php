<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#session_start(); //we need to call PHP's session object to access it through CI
class Newcase extends CI_Controller {

	private $limit = 10;
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('trnkomunitas_model');
        $this->load->library('pagination');
    }
    
    function index($offset=0, $order_column='komunitasId', $order_type='asc')
    {
        if($this->session->userdata('logged_in'))
        {
            if (!$offset) $offset=0;
            if (!$order_column) $order_column = 'komunitasId';
            if (!$order_type) $order_type = 'asc';
            
            $data['result'] = $this->trnkomunitas_model->get_paged_list($this->limit, $offset, $order_column, $order_type);
            
            $config['base_url']=site_url('newcase/index/');
            $config['total_rows']=$this->trnkomunitas_model->count_all();
            $config['per_page']=$this->limit;
            $config['uri_segment']='3';
            $this->pagination->initialize($config);
            $data['paginator']=$this->pagination->create_links();
            
            //table data
            $this->template->set('title',$this->lang->line('title_kom_list'));
            $this->template->load('cpanel/template','newcase_view',$data);
        }
        else
        {
             //If no session, redirect to login page
             redirect('login', 'refresh');
        }
    }
    function create () 
    {
    	$session = $this->session->userdata('logged_in');
    	if($session['id']) $author = $session['id'];
    	else $author = $session['id'];
        
    	if($this->input->post('action')==$this->lang->line('btn_submit')){
        	$data_grp = array('komunitasName' => $this->input->post('komunitasName'),
        	'komunitasDesc' => $this->input->post('komunitasDesc'),
        	'Author'=>$author,'komunitasStatus'=>1);
    		$id = $this->trnkomunitas_model->save($data_grp);
        	//redirect
        	redirect('newcase/index/');
        }
        // load view
        $this->template->set('title',$this->lang->line('title_kom_form'));
        $this->template->load('cpanel/template','newcaseAddUpdate');
    }
    
    function update ($id)
    {
        $session = $this->session->userdata('logged_in');
        if($session['id']) $author = $session['id'];
        else $author = $session['id'];
        
    	$data['detail'] = $this->trnkomunitas_model->get_by_id($id)->row();
        
        if($this->input->post('action')){
        	$id = $this->input->post('id');
        	$caseDate = explode("/", $this->input->post('casedate'));
            $data_grp = array('komunitasName' => $this->input->post('komunitasName'),
                'komunitasDesc' => $this->input->post('komunitasDesc'),
                'Author'=>$author,'komunitasStatus'=>1);
        	$this->trnkomunitas_model->update($id,$data_grp);
        	//redirect
            redirect('newcase/index/');
        }
        
        $this->template->set('title',$this->lang->line('title_kom_form'));
        $this->template->load('cpanel/template','newcaseAddUpdate',$data);
    }/**/
    function delete ()
    {
    	$id = $this->uri->segment(3);
    	$this->trnkomunitas_model->delete($id);
    	redirect('newcase/', '');
    }
}
?>