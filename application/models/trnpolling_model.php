<?php
Class Trnpolling_model extends CI_Model
{
	private $trn_userpolling = 'trn_userpolling';
	private $trn_usercase = 'trn_usercase';
	private $trn_polling = 'trn_polling'; #polling detail
	private $primary_key = 'caseId';
	
	#START TRN_USERCASE
	function get_user_case($userId,$caseId)
	{
		$where = array($this->primary_key => $caseId, 'userId'=>$userId);
		$this->db->where($where);
		return $this->db->count_all_results($this->trn_usercase);
		//return $this->db->get($this->trn_usercase);
	}
	function user_case($data)
	{
		$this->db->insert($this->trn_usercase,$data);
		return $this->db->insert_id();
	}
	#END TRN_USERCASE
	#START TRN_USERPOLLING
	function save($data)
	{
		$this->db->insert($this->trn_userpolling,$data);
		return $this->db->insert_id();
	}
	#END TRN_USERPOLLING
	#START TRN_POLLING
	function update($id)
	{
		$this->db->set('pollingCount','pollingCount+1',false);
		$this->db->where('pollingId',$id);
		$this->db->update($this->trn_polling);
	}
	#END TRN_POLLING
}