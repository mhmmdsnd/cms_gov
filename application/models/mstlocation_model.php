<?php
Class Mstlocation_model extends CI_Model
{
	private $mst_location = 'mst_location';
	private $primary_key = 'locationId';
	function get_paged_list($order_column='',$order_type='asc')
	{
        if (empty($order_column)||empty($order_type))
            $this->db->order_by($this->primary_key,'asc');
        else
            $this->db->order_by($order_column,$order_type);
        return $this->db->get($this->mst_location);
	}
	function count_all()
	{
		return $this->db->count_all($this->mst_location);
	}
	function get_by_id ($id)
	{
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->mst_location);
	}
	function save($data)
	{
		$this->db->insert($this->mst_location,$data);
		return $this->db->insert_id();
	}
    function update ($id, $data)
	{
		$this->db->where($this->primary_key,$id);
		$this->db->update($this->mst_location,$data);
	}
	function delete ($id)
	{
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->mst_location);
	}
	function get_location()
	{
		$this->db->order_by('locationId','asc');
        $hasil = $this->db->get($this->mst_location);
        foreach ($hasil->result_array() as $list)
        {
            $result[''] = "Select ...";
            $result[$list['locationId']] = $list['locationName'];
        }
        return $result;
	}
    
}
?>