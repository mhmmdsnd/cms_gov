<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#session_start(); //we need to call PHP's session object to access it through CI
class Kebijakan extends CI_Controller {
	
	private $limit = 10;
	function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('trnnewcase_model');
        $this->load->model('mstlocation_model');
        $this->load->library('pagination');
        $this->load->library('uploadcase');
    }
    function index($offset=0, $order_column='caseId', $order_type='asc')
    {
		if($this->session->userdata('logged_in'))
		{
			if (!$offset) $offset=0;
            if (!$order_column) $order_column = 'caseId';
            if (!$order_type) $order_type = 'asc';
            
            $data['result'] = $this->trnnewcase_model->get_paged_list('3',$this->limit, $offset, $order_column, $order_type);
            
            $config['base_url']=site_url('kebijakan/index/');
            $config['total_rows']=$this->trnnewcase_model->count_all();
            $config['per_page']=$this->limit;
            $config['uri_segment']='3';
            $this->pagination->initialize($config);
            $data['paginator']=$this->pagination->create_links();
            
			$this->template->set('title','Draft Policy');
            $this->template->load('cpanel/template','kebijakan_view',$data); //$data
		}
		else {
			redirect('login', 'refresh');
		}
    	
    }
    function create()
    {
    	$session = $this->session->userdata('logged_in');
    	if($session['username']) $author = $session['username'];
    	else $author = $session['loginname'];
        
    	$data['getlocation'] = $this->mstlocation_model->get_location(); #location
    	if($this->input->post('action')=='Submit'){
        	$caseDate = explode("/", $this->input->post('casedate'));
        	$data_grp = array('caseTitle' => $this->input->post('casetitle'),
        	'caseDateStart'=>$caseDate[0],
        	'caseDateEnd'=>$caseDate[1],
        	'caseType' => $this->input->post('casetype'),
        	'caseState' => $this->input->post('casestate'),
        	'caseLocation' => $this->input->post('caselocation'),
        	'caseHeader' => $this->input->post('caseheader'),
        	'caseAuthor'=>$author,
        	'createdBy'=>$session['loginname'],
        	'updateBy'=>$session['loginname']);
    		$id = $this->trnnewcase_model->save($data_grp);
        	#CASE WITH ATTACHMENT
        	#$this->uploadcase->upload_attach($id, 'caseImages', 'dialog-'.$id);
        	$this->uploadcase->upload_files($id, 'caseFile', 'draftfile-'.$id);
        	//redirect
        	redirect('kebijakan/index/');
        }
    	
    	$this->template->set('title','Create Draft Policy');
        $this->template->load('cpanel/template','kebijakan_AddUpdate',$data);
    }
    function update($id)
    {
    	$session = $this->session->userdata('logged_in');
    	if($session['username']) $author = $session['username'];
    	else $author = $session['loginname'];
        
    	$data['detail'] = $this->trnnewcase_model->get_by_id($id)->row();
        $data['getlocation'] = $this->mstlocation_model->get_location(); #location
    	if($this->input->post('action')){
        	$id = $this->input->post('id');
        	$caseDate = explode("/", $this->input->post('casedate'));
        	$data_grp = array('caseTitle' => $this->input->post('casetitle'),
        	'caseDateStart'=>$caseDate[0],
        	'caseDateEnd'=>$caseDate[1],
        	'caseType' => $this->input->post('casetype'),
        	'caseState' => $this->input->post('casestate'),
        	'caseLocation' => $this->input->post('caselocation'),
        	'caseHeader' => $this->input->post('caseheader'),
        	'caseAuthor'=>$author,
        	'createdBy'=>$session['loginname'],
        	'updateBy'=>$session['loginname']);
        	$this->trnnewcase_model->update($id,$data_grp);
        	#CASE WITH ATTACHMENT
        	$this->uploadcase->upload_attach($id, 'caseImages', 'case-'.$id);
        	$this->uploadcase->upload_files($id, 'caseFile', 'draftfile-'.$id);
        	//redirect
            redirect('kebijakan/index/');
        }
    	$this->template->set('title','Update Draft Policy');
		$this->template->load('cpanel/template','kebijakan_AddUpdate',$data);
    }
    function delete()
    {
    $case = array();
    	$id = $this->uri->segment(3);
    	$data = $this->trnnewcase_model->get_by_id($id);
    	foreach ($data->result() as $rst)
		{
			if ($rst->caseImages){
				unlink(FCPATH."upload/gallery/".$rst->caseImages);
			}
			if ($rst->caseFile){
				unlink(FCPATH."upload/file/".$rst->caseFile);
			}
		}
		$this->trnnewcase_model->delete($id);
    	redirect('kebijakan/', '');
    }
    #APPROVE
    function approve ($id)
    {
    	$approval = array('caseApproval' => '2');
    	$this->trnnewcase_model->update($id,$approval);
    	redirect('kebijakan/','');    	
    }
	function reject ($id)
    {
    	$rejected = array('caseApproval' => '3');
    	$this->trnnewcase_model->update($id,$rejected);
    	redirect('kebijakan/','');    	
    }
	
}
