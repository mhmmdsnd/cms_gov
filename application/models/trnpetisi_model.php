<?php
Class Trnpetisi_model extends CI_Model
{
	private $trn_usercase = 'trn_usercase';
	private $trn_petisi = 'trn_userpetisi'; #polling detail
	private $primary_key = 'caseId';
	
	function sign_parameter()
	{
		$this->db->where('parameterId',1);
		return $this->db->get('sys_parameter');
	}
	function update_parameter($data)
	{
		$this->db->where('parameterId',1);
		$this->db->update('sys_parameter',$data);
	}	
	function sign_petisi($data)
	{
		$this->db->insert($this->trn_petisi,$data);
		return $this->db->insert_id();
	}
	function count_petisi($caseId)
	{
		$this->db->where($this->primary_key,$caseId);
		return $this->db->count_all_results($this->trn_petisi);
	}
}