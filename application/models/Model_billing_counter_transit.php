<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_billing extends CI_Model{
	
	function getdata($table){		
		return $this->db->get($table);
	}
	
	function usagereport($var_date_from=false, $var_date_thru=false, $meters=false){
		$sql  = 'select tdm.id, tdm.id_name, get_min_date_time_usage(tdm.id, "' . $var_date_from . '", "' . $var_date_thru . '", "counter_transit") as date_time_start, '; 
		$sql .= 'get_max_date_time_usage(tdm.id, "' . $var_date_from . '", "' . $var_date_thru . '", "counter_transit") as date_time_stop,  ';
		$sql .= 'ifnull(tu.kwh_exp_start, 0) as kwh_exp_start, ifnull(tu.kwh_exp_stop, 0) as kwh_exp_stop, ';
		$sql .= '( ifnull(tu.kwh_exp_stop, 0) - ifnull(tu.kwh_exp_start, 0) ) as kwh_exp_usage ';
		$sql .= 'from data_meter tdm  ';
		$sql .= 'left join ';
		$sql .= '( ';
		$sql .= 'select id, sum(kwh_exp_start) as kwh_exp_start, sum(kwh_exp_stop) as kwh_exp_stop ';
		$sql .= 'from ';
		$sql .= '( ';
		$sql .= 'select id, min(kwh_exp) as kwh_exp_start, 0 as kwh_exp_stop ';
		$sql .= 'from counter_transit ';
		$sql .= 'where id <> "" ';
		$sql .= 'and date_time between "' . $var_date_from . '" and "' . $var_date_thru . '" ';
		$sql .= 'group by id ';
		$sql .= 'UNION ';
		$sql .= 'select id, 0 as kwh_exp_start, max(kwh_exp)  as kwh_exp_stop ';
		$sql .= 'from counter_transit ';
		$sql .= 'where id <> "" ';
		$sql .= 'and date_time between "' . $var_date_from . '" and "' . $var_date_thru . '" ';
		$sql .= 'group by id ';
		$sql .= ') tunion ';
		$sql .= 'group by id ';
		$sql .= ') tu on tdm.id = tu.id ';
		$sql .= 'where tdm.id in (' . $meters . ') ';
		
		$query 	= $this->db->query($sql);

		return $query;
	}
	
	function usagereport_ORIG($var_date_from=false, $var_date_thru=false, $meters=false){
		$sql  = 'select tdm.id, tdm.id_name, get_min_date_time_usage(tdm.id, "' . $var_date_from . '", "' . $var_date_thru . '", "counter_transit") as date_time_start, '; 
		$sql .= 'get_max_date_time_usage(tdm.id, "' . $var_date_from . '", "' . $var_date_thru . '", "counter_transit") as date_time_stop,  ';
		$sql .= 'ifnull(tu.kwh_exp_start, 0) as kwh_exp_start, ifnull(tu.kwh_exp_stop, 0) as kwh_exp_stop, ';
		$sql .= '( ifnull(tu.kwh_exp_stop, 0) - ifnull(tu.kwh_exp_start, 0) ) as kwh_exp_usage ';
		$sql .= 'from data_meter tdm  ';
		$sql .= 'left join ';
		$sql .= '( ';
		$sql .= 'select id, sum(kwh_exp_start) as kwh_exp_start, sum(kwh_exp_stop) as kwh_exp_stop ';
		$sql .= 'from ';
		$sql .= '( ';
		$sql .= 'select id, min(kwh_exp) as kwh_exp_start, 0 as kwh_exp_stop ';
		$sql .= 'from counter_transit ';
		$sql .= 'where id <> "" ';
		$sql .= 'and date_time between "' . $var_date_from . '" and "' . $var_date_thru . '" ';
		$sql .= 'group by id ';
		$sql .= 'UNION ';
		$sql .= 'select id, 0 as kwh_exp_start, max(kwh_exp)  as kwh_exp_stop ';
		$sql .= 'from counter_transit ';
		$sql .= 'where id <> "" ';
		$sql .= 'and date_time between "' . $var_date_from . '" and "' . $var_date_thru . '" ';
		$sql .= 'group by id ';
		$sql .= ') tunion ';
		$sql .= 'group by id ';
		$sql .= ') tu on tdm.id = tu.id ';

		$query 	= $this->db->query($sql);

		return $query;
	}	
}