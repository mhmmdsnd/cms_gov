<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	  	$this->load->model('user_model');
	}
	
	function index()
	{
	  $this->load->view('login_view');
      //phpinfo();
	}
	function check_database()
	{
		//Field validation succeeded.  Validate against database
		//$loginname = $this->input->post('loginname');
		$loginname  = $_POST['loginname'];
		$password  = $_POST['password'];
		if(($_POST['loginname'] == "")|| ($_POST['password'] == "")) 
		{
			$message = "Please, insert username and password";
			$status = "0";
			
			$output = '{"status": "'.$status.'","message" : "'.$message.'"}';
		}
		//query the database
		elseif (($_POST['loginname']!="")|| ($_POST['password']!= ""))
		{
			$result = $this->user_model->login($loginname, $password);
			if($result)
			{
				$sess_array = array();
				foreach($result as $row)
				{
					$sess_array = array(
					 'id' => $row->id,
					 'loginname' => $row->loginname,
					'groupId'=>$row->groupId,
					'username'=>$row->username);
					 
					$this->session->set_userdata('logged_in', $sess_array);
					//array_push($response[login],$sess_array);
				}
				$message = "OK";
				$status = "1";
				
				$output = '{"status": "'.$status.'","message" : "'.$message.'","uname":"'.$sess_array['loginname'].'"}';
			}
			else
			{
			 	$message = "Login failed, please try again";
				$status = "0";
				
				$output = '{"status": "'.$status.'","message" : "'.$message.'"}';
			}
		}
		
		echo $output;
	}
}
?>
