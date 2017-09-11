<?php
Class Trnnewcase_model extends CI_Model
{
	private $trn_newcase = 'trn_newcase';
	private $trn_polling = 'trn_polling'; #polling detail
	private $mst_casestep = 'mst_casestep';
	private $mst_location = 'mst_location';
	private $primary_key = 'caseId';
	
	//START NEWCASE
	function get_paged_list ($casetype, $limit=10,$offset=0, $order_column='',$order_type='asc')
	{
		$newcase = array();
		$this->db->select('caseId, caseTitle, caseDateStart, caseDateEnd, caseAuthor, casestepName, casetypeName, locationName, reftypeName ');
		$this->db->from($this->trn_newcase);
		$this->db->join($this->mst_casestep,'trn_newcase.caseState = mst_casestep.casestepId','inner'); #CASESTEP
		$this->db->join('mst_casetype','trn_newcase.caseType = mst_casetype.casetypeId','inner'); #CASETYPE
    	$this->db->join('mst_location','trn_newcase.caseLocation = mst_location.locationId','inner'); #LOCATION
    	$this->db->join('sys_reftype','trn_newcase.caseApproval = sys_reftype.reftypeCode and reftypeGroup = "caseStatus"','inner');
    	$this->db->where('caseType = "'.$casetype.'"');
    	if (empty($order_column)||empty($order_type))
			$this->db->order_by($this->primary_key,'asc');
		else
			$this->db->order_by($order_column,$order_type);
		$this->db->limit($limit,$offset);
		$result = $this->db->get();
		foreach ($result->result() as $rst)
		{
			$newcase[] = array('caseId' =>$rst->caseId, 'caseTitle'=>$rst->caseTitle,'caseDateStart'=>$rst->caseDateStart,
			'caseDateEnd'=>$rst->caseDateEnd,'caseAuthor'=>$rst->caseAuthor, 'caseState'=>$rst->casestepName,
			'caseType'=>$rst->casetypeName,'caseLocation'=>$rst->locationName,'reftypeName'=>$rst->reftypeName);
		}
		return $newcase;
	}
	function count_all()
	{
		return $this->db->count_all($this->trn_newcase);
	}
	function get_by_id ($id)
	{
        $this->db->select('caseId, caseTitle, caseDateStart, caseDateEnd, caseType, caseState, caseLocation, 
        locationName, caseHeader, caseContent, caseFile,caseImages, caseAuthor, caseApproval, 
        '.$this->trn_newcase.'.createdDate, '.$this->trn_newcase.'.createdBy');
	    $this->db->from($this->trn_newcase);
        $this->db->join($this->mst_location,$this->trn_newcase.'.caseLocation = '.$this->mst_location.'.locationId','inner');
	    $this->db->where($this->primary_key,$id);
		return $this->db->get();
	}
	function save($data)
	{
		$this->db->insert($this->trn_newcase,$data);
		return $this->db->insert_id();
	}
    function update ($id, $data)
	{
		$this->db->where($this->primary_key,$id);
		$this->db->update($this->trn_newcase,$data);
	}
	function delete ($id)
	{
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->trn_newcase);
	}
	#START CASE POLLING
	function get_by_pollid($id)
	{
		$this->db->from($this->trn_polling);
		$this->db->where($this->primary_key,$id);
		$result = $this->db->get();
		foreach ($result->result() as $rst)
		{
			$polldetail[] = array('caseId' =>$rst->caseId, 'pollingId'=>$rst->pollingId,
			'pollingValue'=>$rst->pollingValue,'pollingCount'=>$rst->pollingCount);
		}
		return $polldetail;
	}
	function save_polling($data)
	{
		$this->db->insert($this->trn_polling,$data);
		return $this->db->insert_id();
	}
	function update_polling($id, $data)
	{
		$this->db->where('pollingId',$id);
		$this->db->update($this->trn_polling,$data);
	}
	#END CASE POLLING
	
	#LIST CASE FRONT END
	function getcaseList()
	{
		$newcase = array();
		$this->db->select('caseId, caseTitle, trn_newcase.createdDate,caseHeader, caseAuthor, casetypeName, locationName ');
		$this->db->from($this->trn_newcase);
		$this->db->join('mst_casetype','trn_newcase.caseType = mst_casetype.casetypeId','inner'); #CASETYPE
    	$this->db->join('mst_location','trn_newcase.caseLocation = mst_location.locationId','inner'); #LOCATION
    	$this->db->where('caseApproval = 2');
    	/*$this->db->where('caseType = "'.$casetype.'"');
    	if (empty($order_column)||empty($order_type))
			$this->db->order_by($this->primary_key,'asc');
		else
			$this->db->order_by($order_column,$order_type);
		$this->db->limit($limit,$offset);*/
		$result = $this->db->get();
		foreach ($result->result() as $rst)
		{
			$newcase[] = array('caseId' =>$rst->caseId, 'caseTitle'=>$rst->caseTitle,
			'caseDate'=>$rst->createdDate,'caseAuthor'=>$rst->caseAuthor,'caseHeader'=>$rst->caseHeader,
			'caseType'=>$rst->casetypeName,'caseLocation'=>$rst->locationName);
		}
		return $newcase;
	}
	//END NEWCASE
	
	#MOBILE VERSION
	function listView($casetype)
	{	
		$this->db->select('caseId, caseTitle, caseHeader, casestepName, casetypeName, locationName, reftypeName');
		$this->db->from($this->trn_newcase);
		$this->db->join($this->mst_casestep,'trn_newcase.caseState = mst_casestep.casestepId','inner'); #CASESTEP
		$this->db->join('mst_casetype','trn_newcase.caseType = mst_casetype.casetypeId','inner'); #CASETYPE
    	$this->db->join('mst_location','trn_newcase.caseLocation = mst_location.locationId','inner'); #LOCATION
    	$this->db->join('sys_reftype','trn_newcase.caseApproval = sys_reftype.reftypeCode and reftypeGroup = "caseStatus"','inner'); #REFTYPE
    	$this->db->where('caseType = "'.$casetype.'"');
    	return $this->db->get();
	}
	function detailView($caseId)
	{
		$this->db->where($this->primary_key,$caseId);
		$this->db->select('caseId, caseTitle, caseHeader, locationName, reftypeName');
		$this->db->from($this->trn_newcase);
		$this->db->join('mst_location','trn_newcase.caseLocation = mst_location.locationId','inner'); #LOCATION
    	$this->db->join('sys_reftype','trn_newcase.caseApproval = sys_reftype.reftypeCode and reftypeGroup = "caseStatus"','inner'); #REFTYPE
    	return $this->db->get();
	}
	
	#CHART 
	function caseChart()
	{
		$this->db->select('casetypeName, count(caseId) as total');
		$this->db->from($this->trn_newcase);
		$this->db->join('mst_casetype','trn_newcase.caseType = mst_casetype.casetypeId','inner');
		$this->db->group_by('caseType');
		return $this->db->get();
	}
	function pollchart($id)
	{
		$this->db->select('pollingValue, pollingCount');
		$this->db->from($this->trn_polling);
		$this->db->where($this->primary_key,$id);
		return $this->db->get();
	}
}
?>