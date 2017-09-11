<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#session_start(); //we need to call PHP's session object to access it through CI
class Cases extends CI_Controller {

	private $limit = 10;
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('trnnewcase_model');
        $this->load->model('trnpolling_model');
        $this->load->model('trnpetisi_model');
        $this->load->model('trncomment_model');
        $this->load->model('mstlocation_model');
        $this->load->library('pagination');
    }
    
    function index($offset=0, $order_column='caseId', $order_type='asc')
    {
        if (!$offset) $offset=0;
        if (!$order_column) $order_column = 'caseId';
        if (!$order_type) $order_type = 'asc';
            
        $data['getlocation'] = $this->mstlocation_model->get_location(); #location
    	$data['result'] = $this->trnnewcase_model->getcaseList();
            
        $config['base_url']=site_url('cases');
        $config['total_rows']= 1;//$this->mstcase_model->casetype_count_all();
        $config['per_page']=$this->limit;
        $config['uri_segment']='3';
        $this->pagination->initialize($config);
        $data['paginator']=$this->pagination->create_links();
            
        //table data
        $this->template->set('title','Featured Cases');
        $this->template->load('front/vw_Home','cases_view',$data);
    }
    function detail($caseId)
    {
    	$session_data = $this->session->userdata('logged_in');
			
    	$data['casedetail'] = $this->trnpolling_model->get_user_case($session_data['id'],$caseId); #USERID, CASEID
    	$data['detail'] = $this->trnnewcase_model->get_by_id($caseId)->row(); #DETAIL CASE

        $ct = $data['detail']->caseType; #CASETYPE
    	$now = date('Y-m-d H:i:s'); #DATE TODAY
        #CHECKING CASETYPE
    	if($ct == 4) $data['polldetail'] = $this->trnnewcase_model->get_by_pollid($caseId); #POLLING
    	if($ct == 5) {
    		$data['signparam'] = $this->trnpetisi_model->sign_parameter()->row(); #PETISI PARAMETER
    		$data['count'] = $this->trnpetisi_model->count_petisi($caseId);    		
    	}
    	if($ct == 3 || $ct == 2)
        {
            $data['comment'] = $this->trncomment_model->getCommentCase($caseId);
        }
    	
    	#UPDATE DATA PETISI
	    if($this->input->post('action')=="Sign")
		    {
		    	if($this->session->userdata('logged_in'))
		    	{
			   		//add usercase
	       			$data2 = array('userId'=>$session_data['id'],'caseId'=>$caseId,'caseTypeId'=>$ct,
		   			'statusApproved'=>1,'userreqDate'=>$now,'userjoinDate'=>$now);
	       			$this->trnpolling_model->user_case($data2);
        		
	       			//add userpetisi
		   			$data3 = array('userId'=>$session_data['id'],
		   			'caseId'=>$caseId,'dateSignPetisi'=>$now);
	       			$this->trnpetisi_model->sign_petisi($data3);
        			
	       			redirect($_SERVER['REQUEST_URI']);
		    	}
		    	else {
		    			redirect('login', 'refresh');
		    	}
		    }
    	#UPDATE DATA POLLING
    	if($this->input->post('action')=="Poll")
	    {
	    	if($this->session->userdata('logged_in'))
	    	{
		   		$pollingId = $this->input->post('pollingId');
		   		if($pollingId){
		       		//add usercase
	       			$data2 = array('userId'=>$session_data['id'],'caseId'=>$caseId,'caseTypeId'=>$ct,
		   			'statusApproved'=>1,'userreqDate'=>$now,'userjoinDate'=>$now);
	       			$this->trnpolling_model->user_case($data2);
        		    //update polling count
	       			$this->trnpolling_model->update($pollingId);
	       			//add userpolling
		   			$data3 = array('pollingId'=>$pollingId,'userId'=>$session_data['id'],
		   			'caseId'=>$caseId,'datePolling'=>$now);
	       			$this->trnpolling_model->save($data3);
        			
	       			redirect($_SERVER['REQUEST_URI']);
		       	}
	    	}
	    	else {
	    			redirect('login', 'refresh');
	    	}
	    }

	    #ADD COMMENT BASED ON CASE
        if($this->input->post('action')=='Submit')
        {
            if($this->session->userdata('logged_in'))
            {
                $data4 = array('caseId'=>$caseId,'dateComment'=>$now,'userId'=>$session_data['id'],
                    'caseTypeId'=>$ct,'statusComment'=>'P','comment'=>$this->input->post('comment'));
                $this->trncomment_model->addComment($data4);
                redirect($_SERVER['REQUEST_URI']);
            } else {
                redirect('login','refresh');
            }
        }
	       	
        $this->template->set('title','Detail Cases');
        $this->template->load('front/vw_Home','cases_detail',$data);
    }
}
?>