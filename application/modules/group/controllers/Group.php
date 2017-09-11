<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#session_start(); //we need to call PHP's session object to access it through CI
class Group extends CI_Controller {

	private $limit = 10;
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('groupuser_model');
        $this->load->library('pagination');
    }
    
    function index($offset=0, $order_column='groupId', $order_type='asc')
    {
        if($this->session->userdata('logged_in'))
        {
            if (!$offset) $offset=0;
            if (!$order_column) $order_column = 'groupId';
            if (!$order_type) $order_type = 'asc';
            
            $data['result'] = $this->groupuser_model->get_paged_list($this->limit, $offset, $order_column, $order_type);
            
            $config['base_url']=site_url('group/index/');
            $config['total_rows']=$this->groupuser_model->count_all();
            $config['per_page']=$this->limit;
            $config['uri_segment']='3';
            $this->pagination->initialize($config);
            $data['paginator']=$this->pagination->create_links();
            
            //table data
            $this->template->set('title','Group');
            $this->template->load('cpanel/template','group_view',$data);
        }
        else
        {
             //If no session, redirect to login page
             redirect('login', 'refresh');
        }
    }
    function create () 
    {
        $data['getmodule'] = $this->groupuser_model->getall_module();
        
        if($this->input->post('action')=="Save"){
        	$data_grp = array('groupName' => $this->input->post('groupname'));
        	$id = $this->groupuser_model->save($data_grp);
        	//redirect
        	
            $count = count($this->input->post('moduleid'));
    		for($i=0; $i<$count; $i++) {
    			if (isset($_POST['access'][$i])) {
    			$data_insert = array('groupId'=>$id, 'moduleId' => $_POST['moduleid'][$i],'access' => $_POST['access'][$i]);
    			 $this->groupuser_model->save_module($data_insert);
    		  	}
            }
            
            redirect('group');
        }
        // load view
        $this->template->set('title','Group :: Add Group');
        $this->template->load('cpanel/template','groupAddUpdate',$data);
    }
    
    function update ($id)
    {
        $data['detail'] = $this->groupuser_model->get_by_id($id)->row();
        // set common properties
        $data['getmodule'] = $this->groupuser_model->getall_module();
        
        $data['getakses'] = $this->groupuser_model;
        
        
        if($this->input->post('action')){
        	$id = $this->input->post('id');
        	$data_grp = array('groupName' => $this->input->post('groupname'));
            $this->groupuser_model->update($id,$data_grp);
        	
            $this->groupuser_model->delete_module($id);
            
            $count = count($this->input->post('moduleid'));
    		for($i=0; $i<$count; $i++) {
    			if (isset($_POST['access'][$i])) {
    			$data_insert = array('groupId'=>$id, 'moduleId' => $_POST['moduleid'][$i],'access' => $_POST['access'][$i]);
    			 $this->groupuser_model->save_module($data_insert);
    		  	}
            }
            
            //redirect
            redirect('group');
        }
        
        $this->template->set('title','Group :: Edit Group');
        $this->template->load('cpanel/template','groupAddUpdate',$data);
    }/**/
    function delete ($id)
    {
    	$this->groupuser_model->delete_module($id);
    	$this->groupuser_model->delete($id);
    	redirect('group', 'refresh');
    }
}

?>
