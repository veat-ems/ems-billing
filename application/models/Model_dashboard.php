<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_dashboard extends CI_Model
{

	function tampil($metergroupid = false)
	{
		$this->db->from("data_meter");
		if ($metergroupid and $metergroupid <> "") {
			$this->db->where("metergroupid", $metergroupid);
			
		}
		return $this->db->get();
	}

	function filter_dashboard($where, $value, $table)
	{
		$this->db->select("*")
			->from($table)
			->where($where, $value);
		return $this->db->get();
	}


	public function getcounter_id($table, $id)
	{
		$this->db->select("MAX(id_counter) as max_id")
			->from($table)
			->where("id", $id);
		$query = $this->db->get();
		$row = $query->row_array();
		$max_id = $row["max_id"];
		return $max_id;
	}

	public function get_unix_record_id($table, $id)
	{
		$this->db->select("MAX(date_time) as max_dt, ")
			->from($table)
			->where("id", $id);

		$query = $this->db->get();
		$row = $query->row_array();
		$max_dt = $row["max_dt"];
		return $max_dt;
	}


	function dt_counter($table, $id_counter)
	{
		$this->db->select("*")
			->from($table)
			->where("id_counter", $id_counter);
		return $this->db->get();
	}

	function dt_counter_formatted_ORIG($table, $id_counter)
	{
		$this->db->select("date_time, TRUNC((kwh1/1000), 1) as kwh1, TRUNC((kwh2/1000), 1) as kwh2, TRUNC((kwh_exp/1000), 1) as kwh_exp")
			->from($table)
			->where("id_counter", $id_counter);
		return $this->db->get();
	}

	function dt_counter_formatted_old($table, $id_counter)
	{
		$sql = "select min(date_time), 0 as active_energy, sum(t1.watt) as maximum_demand, sum(t1.watt) as average_demand, sum(t1.va) as apparent_power, TRUNC(sum(sqrt(abs( (t1.va*t1.va) - (t1.watt*t1.watt) ))), 2) as reactive_power "; 
		$sql .= "from " . $table . " t1  "; 
		$sql .= "inner join data_meter t2 on t1.id_counter = t2.id "; 
		$sql .= "where t1.id_counter = '" . $id_counter . "' "; 
		$query 	= $this->db->query($sql);

		return $query;
	}	


	function dt_counter_formatted($table, $coloum, $id_counter)
	{
		// $sql = "select 0 as active_energy, sum(t1.watt) as maximum_demand, sum(t1.watt) as average_demand, sum(t1.va) as apparent_power, TRUNC(sum(sqrt(abs( (t1.va*t1.va) - (t1.watt*t1.watt) ))), 2) as reactive_power "; 
		// tkh
		// $sql = "select max(date_time) as date_time, max(t1.kwh_exp) as active_energy, sum(t1.watt) as maximum_demand, sum(t1.watt) as average_demand, sum(t1.va) as apparent_power, TRUNC(sum(sqrt(abs( (t1.va*t1.va) - (t1.watt*t1.watt) ))), 2) as reactive_power "; 
		// $sql .= "from " . $table . " t1  "; 
		// $sql .= "inner join data_meter t2 on t1.id_counter = t2.id "; 
		// $sql .= "where t1.id_counter = '" . $id_counter . "' "; 
		// $query 	= $this->db->query($sql);

		$sql = "select * ";
		$sql .= "from " . $table . " ";
		$sql .= "WHERE ". $coloum ." = '". $id_counter ."' ORDER BY date_time DESC LIMIT 1";
		// var_dump($sql);
		// die;
		$query 	= $this->db->query($sql);

		return $query;
	}

	function dt_counter_group_formatted_old($table, $metergroupid)
	{
		$this->db->select("date_time, TRUNC(((active_energy)/1000), 1) as active_energy, TRUNC((maximum_demand/1000), 1) as maximum_demand, TRUNC((average_demand/1000), 1) as average_demand, TRUNC((apparent_power/1000), 1) as apparent_power, TRUNC((reactive_power/1000), 1) as reactive_power")
			->from($table)
			->where("metergroupid", $metergroupid)
			->order_by('date_time', 'DESC'); // tkh
		return $this->db->get();
	}


	function count_com()
	{
		$this->db->from("com");
		return $this->db->count_all_results();
	}

	function count_modbus()
	{
		$this->db->from("modbus");
		return $this->db->count_all_results();
	}


	function get_data_metergroup_paging_list($limit, $start, $username = false)
	{

		$sql = "select * from  metergroups ";
		$sql .= "where metergroupid in ";
		$sql .= "( ";
		$sql .= "select metergroupid from usermetergroups where username = '" . $username . "' ";
		$sql .= ") order by id_seq asc ";  // Urutkan group by id_seq
		$sql .= "limit " . $limit . " offset " . $start . " ";

		$query 	= $this->db->query($sql);
		return $query;
	}

	function get_data_meter_paging_list($limit, $start, $username = false, $metergroupid = false)
	{
		$sql = "select 	* from data_meter ";
		$sql .= "LEFT JOIN metergroups ON metergroups.metergroupid = data_meter.metergroupid ";
		$sql .= "WHERE data_meter.metergroupid  in ";
		$sql .= "( ";
		$sql .= "select metergroupid from usermetergroups where username = '" . $username . "' ";
		if ($metergroupid and $metergroupid <> '') {
			$sql .= "and metergroupid = '" . $metergroupid . "' ";
		}
		$sql .= ") ";
		$sql .= "order by data_meter.metergroupid, data_meter.id_meter asc "; // urutkan group detail by group & id_meter
		$sql .= "limit " . $limit . " offset " . $start . " ";

		$query 	= $this->db->query($sql);
		return $query;

		// SELECT
		// id_meter, 
		// id,
		// id_serial,
		// id_name, 
		// data_meter.metergroupid,
		// metergroupname
		// FROM data_meter 
		// LEFT JOIN metergroups 
		// ON metergroups.metergroupid = data_meter.metergroupid 
		// WHERE data_meter.metergroupid in ( select metergroupid from usermetergroups where username = 'superadmin' ) 
		// order by 
		// data_meter.id desc limit 12 offset 0;


	}
	function get_data_meter_paging_list_Ori($limit, $start, $username = false, $metergroupid = false)
	{
		//$query = $this->db->get("data_meter", $limit, $start);
		//return $query;


		$sql = "select * from  data_meter ";
		$sql .= "where metergroupid in ";
		$sql .= "( ";
		$sql .= "select metergroupid from usermetergroups where username = '" . $username . "' ";
		if ($metergroupid and $metergroupid <> '') {
			$sql .= "and metergroupid = '" . $metergroupid . "' ";
		}
		$sql .= ") ";
		$sql .= "order by data_meter.id desc ";
		$sql .= "limit " . $limit . " offset " . $start . " ";
		//$sql .= "limit 1 offset 0 "; 

		// echo $sql;
		// die;
		$query 	= $this->db->query($sql);
		return $query;
	}
	function count_rows($table, $username = false, $metergroupid = false)
	{
		//$query = $this->db->get("data_meter", $limit, $start);
		//return $query;

		$sql = "select * from " . $table . " ";
		$sql .= "where metergroupid in ";
		$sql .= "( ";
		$sql .= "select metergroupid from usermetergroups where username = '" . $username . "' ";
		if ($metergroupid and $metergroupid <> '') {
			$sql .= "and metergroupid = '" . $metergroupid . "' ";
		}
		$sql .= ") ";

		$query 	= $this->db->query($sql);
		return $query->num_rows();
	}
}
