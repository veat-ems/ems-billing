<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_billing extends CI_Model{
	
	function getdata($table){		
		return $this->db->get($table);
	} 
	 
	function usagereport($var_date_from=false, $var_date_thru=false, $meters=false, $tablename=false ){
		// $sql  = "select tdm.id, tdm.id_name, get_min_date_time_usage(tdm.id, '" . $var_date_from . "', '" . $var_date_thru . "', 'pg_counter_min') as date_time_start, "; 
		
		$sql  = "select tdm.id, tdm.id_name, tdm.p_nominal, tdm.id_serial, tdm.metergroupid, tdm.lokasi, get_min_date_time_usage(tdm.id, '" . $var_date_from . "', '" . $var_date_thru . "', '" . $tablename . "') as date_time_start, "; 

		// $sql .= "get_max_date_time_usage(tdm.id, '" . $var_date_from . "', '" . $var_date_thru . "', 'pg_counter_min') as date_time_stop,  ";
		$sql .= "get_max_date_time_usage(tdm.id, '" . $var_date_from . "', '" . $var_date_thru . "', '" . $tablename . "') as date_time_stop, "; 
		$sql .= "coalesce(tu.kwh_exp_start, 0) as kwh_exp_start, coalesce(tu.kwh_exp_stop, 0) as kwh_exp_stop, ";
		$sql .= "( coalesce(tu.kwh_exp_stop, 0) - coalesce(tu.kwh_exp_start, 0) ) as kwh_exp_usage, ";

		$sql .= "coalesce(tu.kwh1_start, 0) AS kwh1_start, "; 
		$sql .= "coalesce(tu.kwh1_stop, 0) AS kwh1_stop, "; 
		$sql .= "(coalesce(tu.kwh1_stop, 0) - coalesce(tu.kwh1_start, 0)) AS kwh1_usage, ";
		$sql .= "coalesce(tu.kwh2_start, 0) AS kwh2_start, ";  
		$sql .= "coalesce(tu.kwh2_stop, 0) AS kwh2_stop, "; 
		$sql .= "(coalesce(tu.kwh2_stop, 0) - coalesce(tu.kwh2_start, 0)) AS kwh2_usage ";

		$sql .= "from data_meter tdm  ";
		$sql .= "left join ";
		$sql .= "( ";
		$sql .= "select id, sum(kwh_exp_start) as kwh_exp_start, sum(kwh_exp_stop) as kwh_exp_stop, ";

		$sql .= "SUM(kwh1_start) AS kwh1_start, SUM(kwh1_stop) AS kwh1_stop, ";
		$sql .= "SUM(kwh2_start) AS kwh2_start, SUM(kwh2_stop) AS kwh2_stop ";

		$sql .= "from ";
		$sql .= "( ";
		$sql .= "select id, min(kwh_exp) as kwh_exp_start, 0 as kwh_exp_stop, ";

		$sql .= "min(kwh1) as kwh1_start, 0 as kwh1_stop, ";
		$sql .= "min(kwh2) as kwh2_start, 0 as kwh2_stop ";

		// $sql .= "from pg_counter_min ";
		$sql .= "from " . $tablename . " "; 
		$sql .= "where id <> '' ";
		$sql .= "and date_time between '" . $var_date_from . "' and '" . $var_date_thru . "' ";
		$sql .= "group by id ";
		$sql .= "UNION ";
		$sql .= "select id, 0 as kwh_exp_start, max(kwh_exp)  as kwh_exp_stop, ";

		$sql .= "0 as kwh1_start, max(kwh1)  as kwh1_stop, ";
		$sql .= "0 as kwh2_start, max(kwh2)  as kwh2_stop ";


		// $sql .= "from pg_counter_min ";
		$sql .= "from " . $tablename . " ";
		$sql .= "where id <> '' ";
		$sql .= "and date_time between '" . $var_date_from . "' and '" . $var_date_thru . "' ";
		$sql .= "group by id ";
		$sql .= ") tunion ";
		$sql .= "group by id ";
		$sql .= ") tu on tdm.id = tu.id ";
		$sql .= "where tdm.id in (" . $meters . ") order by tdm.metergroupid, tdm.id";
		// var_dump($sql);
		// die();


// string(1582) "select tdm.id, tdm.id_name, get_min_date_time_usage(tdm.id, '2022-01-01 0:00:00', '2022-01-31 23:59:59', 'pg_counter_min') as date_time_start, get_max_date_time_usage(tdm.id, '2022-01-01 0:00:00', '2022-01-31 23:59:59', 'pg_counter_min') as date_time_stop, coalesce(tu.kwh_exp_start, 0) as kwh_exp_start, coalesce(tu.kwh_exp_stop, 0) as kwh_exp_stop, ( coalesce(tu.kwh_exp_stop, 0) - coalesce(tu.kwh_exp_start, 0) ) as kwh_exp_usage, coalesce(tu.kwh1_start, 0) AS kwh1_start, coalesce(tu.kwh1_stop, 0) AS kwh1_stop, (coalesce(tu.kwh1_stop, 0) - coalesce(tu.kwh1_start, 0)) AS kwh1_usage, coalesce(tu.kwh2_start, 0) AS kwh2_start, coalesce(tu.kwh2_stop, 0) AS kwh2_stop, (coalesce(tu.kwh2_stop, 0) - coalesce(tu.kwh2_start, 0)) AS kwh2_usage from data_meter tdm left join ( select id, sum(kwh_exp_start) as kwh_exp_start, sum(kwh_exp_stop) as kwh_exp_stop, SUM(kwh1_start) AS kwh1_start, SUM(kwh1_stop) AS kwh1_stop, SUM(kwh2_start) AS kwh2_start, SUM(kwh2_stop) AS kwh2_stop from ( select id, min(kwh_exp) as kwh_exp_start, 0 as kwh_exp_stop, min(kwh1) as kwh1_start, 0 as kwh1_stop, min(kwh2) as kwh2_start, 0 as kwh2_stop from pg_counter_min where id <> '' and date_time between '2022-01-01 0:00:00' and '2022-01-31 23:59:59' group by id UNION select id, 0 as kwh_exp_start, max(kwh_exp) as kwh_exp_stop, 0 as kwh1_start, max(kwh1) as kwh1_stop, 0 as kwh2_start, max(kwh2) as kwh2_stop from pg_counter_min where id <> '' and date_time between '2022-01-01 0:00:00' and '2022-01-31 23:59:59' group by id ) tunion group by id ) tu on tdm.id = tu.id where tdm.id in ('03811540') "
//if ( var_dump($sql) == true){
	// select 
	//   tdm.id, 
	//   tdm.id_name, 
	//   get_min_date_time_usage(
	//     tdm.id, '2021-12-11 0:00:00', '2021-12-20 23:59:59', 
	//     'pg_counter_min'
	//   ) as date_time_start, 
	//   get_max_date_time_usage(
	//     tdm.id, '2021-12-11 0:00:00', '2021-12-20 23:59:59', 
	//     'pg_counter_min'
	//   ) as date_time_stop, 
	//   coalesce(tu.kwh_exp_start, 0) as kwh_exp_start, 
	//   coalesce(tu.kwh_exp_stop, 0) as kwh_exp_stop, 
	//   (
	//     coalesce(tu.kwh_exp_stop, 0) - coalesce(tu.kwh_exp_start, 0)
	//   ) as kwh_exp_usage, 
	//   coalesce(tu.kwh1_start, 0) AS kwh1_start, 
	//   coalesce(tu.kwh1_stop, 0) AS kwh1_stop, 
	//   (
	//     coalesce(tu.kwh1_stop, 0) - coalesce(tu.kwh1_start, 0)
	//   ) AS kwh1_usage, 
	//   coalesce(tu.kwh2_start, 0) AS kwh2_start, 
	//   coalesce(tu.kwh2_stop, 0) AS kwh2_stop, 
	//   (
	//     coalesce(tu.kwh2_stop, 0) - coalesce(tu.kwh2_start, 0)
	//   ) AS kwh2_usage 
	// from 
	//   data_meter tdm 
	//   left join (
	//     select 
	//       id, 
	//       sum(kwh_exp_start) as kwh_exp_start, 
	//       sum(kwh_exp_stop) as kwh_exp_stop, 
	//       SUM(kwh1_start) AS kwh1_start, 
	//       SUM(kwh1_stop) AS kwh1_stop, 
	//       SUM(kwh2_start) AS kwh2_start, 
	//       SUM(kwh2_stop) AS kwh2_stop 
	//     from 
	//       (
	//         select 
	//           id, 
	//           min(kwh_exp) as kwh_exp_start, 
	//           0 as kwh_exp_stop, 
	//           min(kwh1) as kwh1_start, 
	//           0 as kwh1_stop, 
	//           min(kwh2) as kwh2_start, 
	//           0 as kwh2_stop 
	//         from 
	//           pg_counter_min 
	//         where 
	//           id <> '' 
	//           and date_time between '2021-12-11 0:00:00' 
	//           and '2021-12-20 23:59:59' 
	//         group by 
	//           id 
	//         UNION 
	//         select 
	//           id, 
	//           0 as kwh_exp_start, 
	//           max(kwh_exp) as kwh_exp_stop, 
	//           0 as kwh1_start, 
	//           max(kwh1) as kwh1_stop, 
	//           0 as kwh2_start, 
	//           max(kwh2) as kwh2_stop 
	//         from 
	//           pg_counter_min 
	//         where 
	//           id <> '' 
	//           and date_time between '2021-12-11 0:00:00' 
	//           and '2021-12-20 23:59:59' 
	//         group by 
	//           id
	//       ) tunion 
	//     group by 
	//       id
	//   ) tu on tdm.id = tu.id 
	// where 
	//   tdm.id in ('LT_5_2')
// }


// if ( function di_postgres == true){

	// 	-- FUNCTION: public.get_max_date_time_usage(character varying, timestamp without time zone, timestamp without time zone, character varying)
		
	// 	-- DROP FUNCTION public.get_max_date_time_usage(character varying, timestamp without time zone, timestamp without time zone, character varying);
		
	// 	CREATE OR REPLACE FUNCTION public.get_max_date_time_usage(
	// 		var_id character varying,
	// 		var_date_time_from timestamp without time zone,
	// 		var_date_time_thru timestamp without time zone,
	// 		var_tablename character varying)
	// 		RETURNS timestamp without time zone
	// 		LANGUAGE 'plpgsql'
	// 		COST 100
	// 		VOLATILE PARALLEL UNSAFE
	// 	AS $BODY$
	// 	declare
	// 	var_date_time timestamp without time zone;
	// 	begin
	// 		if (var_tablename = 'counter2') then
	// 			select max(date_time) into var_date_time from counter2
	// 			where id = var_id
	// 			and date_time BETWEEN var_date_time_from AND var_date_time_thru;
	// 		elseif (var_tablename = 'counter_jam') then
	// 			select max(date_time) into var_date_time from counter_jam
	// 			where id = var_id
	// 			and date_time BETWEEN var_date_time_from AND var_date_time_thru;
	// 		ELSE
	// 			select max(date_time) into var_date_time from pg_counter_min
	// 			where id = var_id
	// 			and date_time BETWEEN var_date_time_from AND var_date_time_thru;
	// 		end if;
		
	// 	return var_date_time;
	// 	end;
	// 	$BODY$;
		
	// 	ALTER FUNCTION public.get_max_date_time_usage(character varying, timestamp without time zone, timestamp without time zone, character varying)
	// 		OWNER TO postgres;
		
		
		
	// 	-- FUNCTION: public.get_min_date_time_usage(character varying, timestamp without time zone, timestamp without time zone, character varying)
		
	// 	-- DROP FUNCTION public.get_min_date_time_usage(character varying, timestamp without time zone, timestamp without time zone, character varying);
		
	// 	CREATE OR REPLACE FUNCTION public.get_min_date_time_usage(
	// 		var_id character varying,
	// 		var_date_time_from timestamp without time zone,
	// 		var_date_time_thru timestamp without time zone,
	// 		var_tablename character varying)
	// 		RETURNS timestamp without time zone
	// 		LANGUAGE 'plpgsql'
	// 		COST 100
	// 		VOLATILE PARALLEL UNSAFE
	// 	AS $BODY$
	// 	declare
	// 	var_date_time timestamp without time zone;
	// 	begin
	// 		if (var_tablename = 'counter2') then
	// 			select min(date_time) into var_date_time from counter2
	// 			where id = var_id
	// 			and date_time BETWEEN var_date_time_from AND var_date_time_thru;
	// 		elseif (var_tablename = 'counter_jam') then
	// 			select min(date_time) into var_date_time from counter_jam
	// 			where id = var_id
	// 			and date_time BETWEEN var_date_time_from AND var_date_time_thru;
	// 		ELSE
	// 			select min(date_time) into var_date_time from pg_counter_min
	// 			where id = var_id
	// 			and date_time BETWEEN var_date_time_from AND var_date_time_thru;
	// 		end if;
		
	// 	return var_date_time;
	// 	end;
	// 	$BODY$;
		
	// 	ALTER FUNCTION public.get_min_date_time_usage(character varying, timestamp without time zone, timestamp without time zone, character varying)
	// 		OWNER TO postgres;

// }

// test function min max
// select public.get_min_date_time_usage('LT_5_2', '2021-12-11 0:00:00', '2021-12-20 23:59:59', 'pg_counter_min') as date_time_start;

		
		//echo $sql;
		$query 	= $this->db->query($sql);
	
		return $query;
	}

}