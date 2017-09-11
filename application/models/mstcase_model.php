<?php
Class Mstcase_model extends CI_Model
{
	private $mst_casestep = 'mst_casestep';
	private $mst_casetype = 'mst_casetype';
	private $primary_key = 'casestepId';
	private $pk_casestype = 'casetypeId';
	//MASTER CASESTEP
	function get_paged_list($limit=10,$offset=0, $order_column='',$order_type='asc')
	{
		if (empty($order_column)||empty($order_type))
		$this->db->order_by($this->primary_key,'asc');
		else 
		$this->db->order_by($order_column,$order_type);
		return $this->db->get($this->mst_casestep,$limit,$offset);
	}
	function count_all()
	{
		return $this->db->count_all($this->mst_casestep);
	}
	function get_by_id ($id)
	{
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->mst_casestep);
	}
	function save($data)
	{
		$this->db->insert($this->mst_casestep,$data);
		return $this->db->insert_id();
	}
    function update ($id, $data)
	{
		$this->db->where($this->primary_key,$id);
		$this->db->update($this->mst_casestep,$data);
	}
	function delete ($id)
	{
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->mst_casestep);
	}
	function get_casestep()
	{
		$this->db->order_by('casestepId','asc');
        $hasil = $this->db->get($this->mst_casestep);
        foreach ($hasil->result_array() as $list)
        {
            $result[''] = "Select ...";
            $result[$list['casestepId']] = $list['casestepName'];
        }
        return $result;
	}
	//MASTER CASETYPE
    function casetype_paged_list ($limit=10,$offset=0, $order_column='',$order_type='asc')
    {
    	if (empty($order_column)||empty($order_type))
		$this->db->order_by($this->pk_casestype,'asc');
		else 
		$this->db->order_by($order_column,$order_type);
		return $this->db->get($this->mst_casetype,$limit,$offset);
    }
    function casetype_count_all()
    {
    	return $this->db->count_all($this->mst_casetype);
    }
    function casetype_by_id($id)
    {
    	$this->db->where($this->pk_casestype,$id);
		return $this->db->get($this->mst_casetype);
    }
    function casetype_save($data)
    {
    	$this->db->insert($this->mst_casetype,$data);
		return $this->db->insert_id();
    }
    function casetype_update($id,$data)
    {
    	$this->db->where($this->pk_casestype,$id);
		$this->db->update($this->mst_casetype,$data);
    }
    function casetype_delete($id)
    {
    	$this->db->where($this->pk_casestype,$id);
		$this->db->delete($this->mst_casetype);
    }
	function get_casetype()
	{
		$this->db->order_by('casetypeId','asc');
        $hasil = $this->db->get($this->mst_casetype);
        foreach ($hasil->result_array() as $list)
        {
            $result[''] = "Select ...";
            $result[$list['casetypeId']] = $list['casetypeName'];
        }
        return $result;
	}
}
?>