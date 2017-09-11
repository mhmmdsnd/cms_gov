<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#session_start(); //we need to call PHP's session object to access it through CI
class User extends CI_Controller {

	private $limit = 10;
 function __construct()
 {
   parent::__construct();
   	$this->load->library('form_validation');
	$this->load->model('user_model');
   	$this->load->library('pagination');
 }

 function index($offset=0, $order_column='id', $order_type='asc')
 {
   if($this->session->userdata('logged_in'))
   {
	if (!$offset) $offset=0;
	if (!$order_column) $order_column = 'id';
	if (!$order_type) $order_type = 'asc';
	
	$data['result'] = $this->user_model->get_paged_list($this->limit, $offset, $order_column, $order_type);
	$config['base_url']=site_url('user/index/');
	$config['total_rows']=$this->user_model->count_all();
	$config['per_page']=$this->limit;
	$config['uri_segment']='3';
	$this->pagination->initialize($config);
	$data['paginator']=$this->pagination->create_links();
	
	//$data = array('result'=>$result, 'paginator'=>$paginator);

	//table data
	$this->template->set('title','User');
	$this->template->load('cpanel/template','user_view',$data);
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }
 function create () 
 {
    $data['getgroup'] = $this->user_model->get_group();
	if($this->input->post('action')){
		$data_user = array('firstname' => $this->input->post('firstname'),'lastname' => $this->input->post('lastname'),
                            'loginname' => $this->input->post('loginname'),'groupId' => $this->input->post('groupId'),
						'password' => md5($this->input->post('password')));
		$id = $this->user_model->save($data_user);
		//validasi ID
		$this->validation->id = $id;
		//redirect
		redirect('user/index/');
	}
	// load view
	$this->template->set('title','User :: Add User');
	$this->template->load('cpanel/template','userAddUpdate',$data);
 }
 function update ($id)
 {
 	$data['detail'] = $this->user_model->get_by_id($id)->row();
    $data['getgroup'] = $this->user_model->get_group();
	
	// set common properties
	
	if($this->input->post('action')){
		$id = $this->input->post('id');
		$data_user = array('firstname' => $this->input->post('firstname'),'lastname' => $this->input->post('lastname'),
                            'loginname' => $this->input->post('loginname'),'groupId' => $this->input->post('groupId'));
        $this->user_model->update($id,$data_user);
        
        if ($_POST['password']) {
            $data_user = array('password'=> md5($this->input->post('password')));
            $this->user_model->update($id,$data_user);
		}//redirect
		redirect('user/index/');
	}
	
	$this->template->set('title','User :: Edit User');
	$this->template->load('cpanel/template','userAddUpdate',$data);
 }/**/
function delete ($id)
{
	$this->user_model->delete($id);
	redirect('user/index/', 'refresh');
}
}

?>
