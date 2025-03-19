<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcrud extends CI_Model {
	
	public $table;
	
	public function __construct() {
		parent::__construct();
		$this->table = get_Class($this);
		$this->load->database();
	}

	
	public function save($data,$tablename="")
	{
		if($tablename=="")
		{
			$tablename = $this->table;
		}
		$op = 'update';
		$keyExists = FALSE;
		$fields = $this->db->field_data($tablename);
		foreach ($fields as $field)
		{
			if($field->primary_key==1)
			{
				$keyExists = TRUE;
				if(isset($data[$field->name]))
				{
					$this->db->where($field->name, $data[$field->name]);
				}
				else
				{
					$op = 'insert';
				}
			}
		}

		if($keyExists && $op=='update')
		{
			$this->db->set($data);
			$this->db->update($tablename);
			if($this->db->affected_rows()==1)
			{
				return $this->db->affected_rows();
			}
		}

		$this->db->insert($tablename,$data);

		return $this->db->affected_rows();

	}

	// return list of records
	function searchall($conditions=NULL,$tablename="", $orderbyfield=NULL, $orderbytype=NULL,$limit=0,$offset=0)
	{
		//echo $conditions;
		if($tablename=="")
		{
			$tablename = $this->table;
		}
		
		if($limit>0)
		{
			$this->db->limit($limit, $offset);
		}

		if($conditions != NULL)
			$this->db->where($conditions);
			
		if ($orderbytype == NULL)
			$orderbytype = 'ASC';

		if ($orderbyfield != NULL)
			$this->db->order_by($orderbyfield, $orderbytype); 

		$result = $this->db->get($tablename);
		return $result->result();
		// return $result->row();
	}
	
	// return list of records
	function searchall_row($conditions=NULL,$tablename="", $orderbyfield=NULL, $orderbytype=NULL,$limit=0,$offset=0)
	{
		//echo $conditions;
		if($tablename=="")
		{
			$tablename = $this->table;
		}
		
		if($limit>0)
		{
			$this->db->limit($limit, $offset);
		}

		if($conditions != NULL)
			$this->db->where($conditions);
			
		if ($orderbytype == NULL)
			$orderbytype = 'ASC';

		if ($orderbyfield != NULL)
			$this->db->order_by($orderbyfield, $orderbytype); 

		$result = $this->db->get($tablename);
		// return $result->result();
		return $result->row();
	}

	// return 1 row
	function search($conditions=NULL,$tablename="",$limit=0,$offset=0)
	{
		if($tablename=="")
		{
			$tablename = $this->table;
		}
		
		if($limit>0)
		{
			$this->db->limit($limit, $offset);
		}
		
		if($conditions != NULL)
			$this->db->where($conditions);

		$result = $this->db->get($tablename);
		return $result->row();
	}

	// return count of records
	function searchcount($conditions=NULL,$tablename="")
	{
		if($tablename=="")
		{
			$tablename = $this->table;
		}
		
		if($conditions != NULL)
			$this->db->where($conditions);
			
		$result = $this->db->get($tablename);
		return $result->num_rows();
	}
	
	function searchmax($tablename, $fieldname, $conditions=NULL) {
		$this->db->select_max($fieldname);
		
		if($conditions != NULL)
			$this->db->where($conditions);
			
		$result = $this->db->get($tablename);
		$row = $result->row();
		
		return $row->$fieldname;
	}
	
	function searchmin($tablename, $fieldname, $conditions=NULL) {
		$this->db->select_min($fieldname);
		
		if($conditions != NULL)
			$this->db->where($conditions);
			
		$result = $this->db->get($tablename);
		$row = $result->row();
		
		return $row->$fieldname;
	}	
	
	function insert($data,$tablename="")
	{
		if($tablename=="")
			$tablename = $this->table;
		$this->db->insert($tablename,$data);
		return $this->db->affected_rows();
		//return $this->db->insert_id();
	}

	function update($data,$conditions,$tablename="")
	{
		if($tablename=="")
			$tablename = $this->table;
		$this->db->where($conditions);
		$this->db->update($tablename,$data);
		return $this->db->affected_rows();
	}

	function delete($conditions,$tablename="")
	{
		if($tablename=="")
			$tablename = $this->table;
		$this->db->where($conditions);
		$this->db->delete($tablename);
		return $this->db->affected_rows();
	}


	function getvalue($table, $value, $field=false, $criteria=false){
		$this->db->select($value);
		if ($field) {
			$this->db->where($field, $criteria);
			if ($table == 'employees' or $table == 'users') {
				$where['active <>'] = '-1';
				$this->db->where($where);
			}
			if ($table == 'projects') {
				$where['status <>'] = '-1';
				$this->db->where($where);
			}
		} else {
			$this->db->where($criteria); // array criteria
		}
		
		$Q = $this->db->get($table);
		if ($Q->num_rows() > 0){
			foreach ($Q->result_array() as $row){
			}
			$return = $row[$value];
		} else {
			if ($field) {
				$return = $criteria;
			} else {
				$return = '';
			}
		}
		$Q->free_result();
		return $return;		
	}
	
	function getsetting($settingid = false, $username = false, $fieldname = false) {
		$condition['settingid'] = $settingid;
		$condition['username'] 	= $username;
		$row = $this->search($condition, 'settings');
		if ($row) {
			$return = $row->$fieldname;
		} else {
			
			$condition2['settingid'] 	= $settingid;
			$condition2['username'] 	= 'default';
			$row2 = $this->search($condition2, 'settings');
			
			if ($row2) {
				$return = $row2->$fieldname;
			} else {
				$return = '0';
			}
			
		} 
		
		return $return;
	}
}

?>