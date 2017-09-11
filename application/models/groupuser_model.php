<?php
Class Groupuser_model extends CI_Model
{
	private $table_group = 'sys_group';
	private $table_groupusers = 'sys_groupusers';
	
	function get_paged_list ($limit=10,$offset=0, $order_column='',$order_type='asc')
	{
		if (empty($order_column)||empty($order_type))
		$this->db->order_by('groupId','asc');
		else 
		$this->db->order_by($order_column,$order_type);
		return $this->db->get($this->table_group,$limit,$offset);
	}
	function count_all()
	{
		return $this->db->count_all($this->table_group);
	}
	function get_by_id ($id)
	{
		$this->db->where('groupId',$id);
		return $this->db->get($this->table_group);
	}
	function save($data)
	{
		$this->db->insert($this->table_group,$data);
		return $this->db->insert_id();
	}
    function update ($id, $data)
	{
		$this->db->where('groupId',$id);
		$this->db->update($this->table_group,$data);
	}
	function delete ($id)
	{
		$this->db->where('groupId',$id);
		$this->db->delete($this->table_group);
	}
    //MODULE LIST
    function save_module ($data)
    {
        $this->db->insert($this->table_groupusers,$data);
		return $this->db->insert_id();
    }
	function delete_module ($id)
	{
		$this->db->where('groupId',$id);
		$this->db->delete($this->table_groupusers);
	}
    function getall_module ($parent=0)
    {
    	$getmod = array();
    	$this->db->from('sys_module');
    	//$this->db->where('parentId !=',$parent);
    	$result = $this->db->get();
    	foreach ($result->result() as $rst)
    	{
    		$getmod[] = array('menuId' =>$rst->menuId, 'menuName'=>$rst->menuName,
    				'parentName'=>$rst->parentName);
    	}
    	return $getmod;
        //return $this->db->get('sys_module');
        
    }
    function get_menu()
    {
    	$menu = array();
    	$where = array('groupId'=>1);
    	$this->db->select('distinct(moduleMenu)');
    	$this->db->from($this->table_groupusers);
    	$this->db->join('module','sys_groupusers.moduleId = module.moduleId','inner');
    	$this->db->where($where);
    	$result = $this->db->get();
    	foreach ($result->result() as $rst)
    	{
    		$menu[] = array('moduleMenu' =>$rst->moduleMenu);
    	}
    	return $menu;
    }
    function get_module($gid,$mMenu)
    {
    	$menu = array();
    	$where = array('groupId'=>$gid,'moduleMenu'=>$mMenu );
    	$this->db->select('moduleName, moduleUrl');
    	$this->db->from($this->table_groupusers);
    	$this->db->join('module','groupusers.moduleId = module.moduleId','inner');
    	$this->db->where($where);
    	$result = $this->db->get();
    	foreach ($result->result() as $rst)
    	{
    		$menu[] = array('moduleName' =>$rst->moduleName);
    	}
    	return $menu;
    }
    function get_by_grpid ($id,$mId,$field)
	{
        $where = array('groupId'=>$id,'moduleId'=>$mId);
        $this->db->select($field);
        $this->db->from($this->table_groupusers);
        $this->db->where($where);
		$query = $this->db->get();
        $hasil = $query->result_array();
        
        if ($query->num_rows() > 0) $dataQty = $hasil[0][$field];
        else $dataQty = 0;
        
        return $dataQty;
	}
	function all_menu ($parent=0,$grpId)
	{
		$menu = array();
		$this->db->from($this->table_groupusers);
		$this->db->join('sys_module','sys_groupusers.moduleId = sys_module.menuId','inner');
		$this->db->where('parentId',$parent);
		$this->db->where('groupId',$grpId);
		$this->db->order_by('menuId asc');
		$result = $this->db->get();
		foreach ($result->result() as $rst)
		{
			
			$menu[] = array('menuId' =>$rst->menuId, 'menuName'=>$rst->menuName,
					'moduleUrl'=>$rst->moduleUrl,
					'parentId'=>$this->all_menu($rst->menuId,$grpId));
		}
		return $menu;
	}
	
}
?>