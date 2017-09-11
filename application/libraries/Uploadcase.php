<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Uploadcase {
	#UPLOAD IMAGE & FILE
	function upload_attach($id,$field_name, $filename)
    {
	    #UPLOAD IMAGE
	    $this->CI =& get_instance();
		$confimg = array(
			'upload_path'=>"./upload/gallery/",
			'allowed_types'=>"gif|jpg|png|jpeg",
			'max_size'=>"2048000",'overwrite'=>true,
		    'max_height'=>"250",'max_width'=>"350",
	        'file_name'=>$filename);
		$this->CI->load->library('upload',$confimg,'imgupload');
		$this->CI->load->imgupload->initialize($confimg);
		#END UPLOAD IMAGE
		if($this->CI->load->imgupload->do_upload($field_name)) {
	    	$data_upload = $this->CI->load->imgupload->data();
	    	$file_upload = array($field_name=>$data_upload['file_name']);
	    	$this->CI->load->trnnewcase_model->update($id,$file_upload);
	    }
    }
    function upload_files($id,$field_name, $filename)
    {
    	#UPLOAD FILE
		$this->CI =& get_instance();
		$confgfile = array(
			'upload_path'=>"./upload/files/",
			'allowed_types'=>"*",
			'max_size'=>"2048000",'overwrite'=>true,
		    'file_name'=>$filename);
		$this->CI->load->library('upload',$confgfile,'fileupload');
		$this->CI->load->fileupload->initialize($confgfile);
		#END UPLOAD FILE
		if($this->CI->load->fileupload->do_upload($field_name)) {
	    	$data_upload = $this->CI->load->fileupload->data();
	    	$file_upload = array($field_name=>$data_upload['file_name']);
	    	$this->CI->load->trnnewcase_model->update($id,$file_upload);
	    }
    }
}