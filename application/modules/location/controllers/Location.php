<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#session_start(); //we need to call PHP's session object to access it through CI
class Location extends CI_Controller {

	private $limit = 10;
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('mstlocation_model');
        $this->load->library('pagination');
    }
    function datalocation(){
        $this->mstlocation_model->get_paged_list();
    }
    function index($offset=0, $order_column='locationId', $order_type='asc')
    {
        if($this->session->userdata('logged_in'))
        {
            if (!$offset) $offset=0;
            if (!$order_column) $order_column = 'locationId';
            if (!$order_type) $order_type = 'asc';

            $data['result'] = $this->mstlocation_model->get_paged_list($this->limit, $offset, $order_column, $order_type);

            $config['base_url']=site_url('location/index/');
            $config['total_rows']=$this->mstlocation_model->count_all();
            $config['per_page']=$this->limit;
            $config['uri_segment']='3';
            $this->pagination->initialize($config);
            $data['paginator']=$this->pagination->create_links();

            //table data
            $this->template->set('title','Location');
            $this->template->load('cpanel/template','location_view',$data);
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
        	$data_grp = array('locationName' => $this->input->post('locationname'),'locationGPS' => $this->input->post('locationgps'));
        	$id = $this->mstlocation_model->save($data_grp);
        	//redirect
        	redirect('location/index/');
        }
        // load view
        $this->template->set('title','Location :: Add Location');
        $this->template->load('cpanel/template','locationAddUpdate');
    }
    
    function update ($id)
    {
        $data['detail'] = $this->mstlocation_model->get_by_id($id)->row();
        
        if($this->input->post('action')){
        	$id = $this->input->post('id');
        	$data_grp = array('locationName' => $this->input->post('locationname'),'locationGPS' => $this->input->post('locationgps'));
        	$this->mstlocation_model->update($id,$data_grp);
        	
            //redirect
            redirect('location/index/');
        }
        
        $this->template->set('title','Location :: Edit Location');
        $this->template->load('cpanel/template','locationAddUpdate',$data);
    }/**/
    function delete ($id)
    {
    	$this->mstlocation_model->delete($id);
    	redirect('location/index/', 'refresh');
    }
}

?>
