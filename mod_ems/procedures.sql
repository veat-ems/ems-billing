-- ###### Procedures (7)

-- PROCEDURE: public.copy_pgcounterhour_to_pgcounterday()

-- DROP PROCEDURE public.copy_pgcounterhour_to_pgcounterday();

CREATE OR REPLACE PROCEDURE public.copy_pgcounterhour_to_pgcounterday(
	)
LANGUAGE 'sql'
AS $BODY$
-- "STEP_PgCounterHour_to_PgCounterDay";
    INSERT INTO pg_counter_day (
        date_time, unix_record_id, date_time_source, 
        id, type, com, modbus, status, v1, v2, 
        v3, v12, v23, v31, i1, i2, i3, inet, watt1, 
        watt2, watt3, watt, va1, va2, va3, va, 
        freq, pf1, pf2, pf3, kwh_exp, kwh_imp, 
        kvarh_exp, kvarh_imp, kvah, thd_v1, 
        thd_v2, thd_v3, thd_i1, thd_i2, thd_i3, 
        kwh1, kwh2, kwh
        ) 
    SELECT     -- per day
        date_trunc('day', date_time_source) as date_time_stamp, 
        CONCAT(
          date_trunc('day', date_time_source), 
          ' ', 
          id
        ) as unix_record_id_hour, 
        date_time_source, 
        id, 
        type, 
        com, 
        modbus, 
        status, 
        v1, 
        v2, 
        v3, 
        v12, 
        v23, 
        v31, 
        i1, 
        i2, 
        i3, 
        inet, 
        watt1, 
        watt2, 
        watt3, 
        watt, 
        va1, 
        va2, 
        va3, 
        va, 
        freq, 
        pf1, 
        pf2, 
        pf3, 
        kwh_exp, 
        kwh_imp, 
        kvarh_exp, 
        kvarh_imp, 
        kvah, 
        thd_v1, 
        thd_v2, 
        thd_v3, 
        thd_i1, 
        thd_i2, 
        thd_i3, 
        kwh1, 
        kwh2, 
        kwh 
      from 
        pg_counter_hour -- where id='LT_5_1'-- extract('EPOCH' from NOW()) + 25200 - extract('EPOCH' from date_time) < (3600*3)--1jam*3
      WHERE 
        date_time_source > (NOW() - '5 DAYS' :: interval) --3 Days before
  --    (date_time_source) - '7 HOURS' :: interval > (NOW() - '400 DAYS' :: interval) --3 Days before
      order by 
        date_time_source, 
        id asc --ambil yang pertama dalam rentang REC
        ON CONFLICT (unix_record_id) DO NOTHING
$BODY$;



-- PROCEDURE: public.copy_pgcountermin_to_pgcounterhour()

-- DROP PROCEDURE public.copy_pgcountermin_to_pgcounterhour();

CREATE OR REPLACE PROCEDURE public.copy_pgcountermin_to_pgcounterhour(
	)
LANGUAGE 'sql'
AS $BODY$
   INSERT INTO pg_counter_hour (
        date_time, unix_record_id, date_time_source, 
        id, type, com, modbus, status, v1, v2, 
        v3, v12, v23, v31, i1, i2, i3, inet, watt1, 
        watt2, watt3, watt, va1, va2, va3, va, 
        freq, pf1, pf2, pf3, kwh_exp, kwh_imp, 
        kvarh_exp, kvarh_imp, kvah, thd_v1, 
        thd_v2, thd_v3, thd_i1, thd_i2, thd_i3, 
        kwh1, kwh2, kwh
      ) 
      SELECT -- 3600 per jam
        date_trunc('hour', date_time_source) as date_time_stamp,    -- // tkh bisa pakai ini
        CONCAT(
          date_trunc('hour', date_time_source), 
          ' ', 
          id
        ) as unix_record_id,    --// tkh bisa pakai ini
        date_time_source, 
        id, 
        type, 
        com, 
        modbus, 
        status, 
        v1, 
        v2, 
        v3, 
        v12, 
        v23, 
        v31, 
        i1, 
        i2, 
        i3, 
        inet, 
        watt1, 
        watt2, 
        watt3, 
        watt, 
        va1, 
        va2, 
        va3, 
        va, 
        freq, 
        pf1, 
        pf2, 
        pf3, 
        kwh_exp, 
        kwh_imp, 
        kvarh_exp, 
        kvarh_imp, 
        kvah, 
        thd_v1, 
        thd_v2, 
        thd_v3, 
        thd_i1, 
        thd_i2, 
        thd_i3, 
        kwh1, 
        kwh2, 
        kwh 
      from 
        pg_counter_min --     where id='LT_5_1'
      WHERE 
      date_time > (NOW() - '5 DAYS'::interval) --3 HOURS before
 --       extract(
 --         'EPOCH' 
 --         from 
 --           NOW()
 --       ) + 25200 - extract(
 --        'EPOCH' 
 --         from 
 --           date_time
 --       ) < (3600 * 3 * 7) --1jam*3
      order by 
        date_time_source, 
        id asc --ambil yang pertama dalam rentang epoch
        ON CONFLICT (unix_record_id) DO NOTHING
      
$BODY$;




-- PROCEDURE: public.copy_pgcountermin_to_pgcountermingroups()

-- DROP PROCEDURE public.copy_pgcountermin_to_pgcountermingroups();

CREATE OR REPLACE PROCEDURE public.copy_pgcountermin_to_pgcountermingroups(
	)
LANGUAGE 'sql'
AS $BODY$
-- "STEP_PgCounterMin_Calc_to_PgCounterMinMeterGroups";
    INSERT INTO pg_counter_min_metergroups (
        metergroupid, date_time, 
        active_energy, maximum_demand, average_demand, 
        apparent_power, reactive_power, 
        unix_record_id )
        select t2.metergroupid, t1.date_time, 
        TRUNC(sum(t1.kwh_exp),1) as group_active_energy, 
        TRUNC(sum(t1.va2),1) as group_maximum_demand, 
        TRUNC(sum(t1.watt),1) as group_average_demand, 
        TRUNC(sum(t1.va),1) as group_apparent_power, 
        TRUNC(sum(t1.va3),1) as group_reactive_power, 
        CONCAT(t2.metergroupid,' ',t1.date_time) as unix_record_id
        from pg_counter_min t1 
        inner join data_meter t2 on t1.id = t2.id
    -- WHERE (t1.date_time) - '7 HOURS'::interval > (NOW() - '1 HOURS'::interval) --1 HOURS before
    WHERE (t1.date_time)> (NOW() - '1 HOURS'::interval) --1 HOURS before
    group by t2.metergroupid, t1.date_time
    order by t1.date_time
    ON CONFLICT(unix_record_id) DO UPDATE
    SET
        active_energy  = EXCLUDED.active_energy,
        maximum_demand = EXCLUDED.maximum_demand,
        average_demand = EXCLUDED.average_demand,
        apparent_power = EXCLUDED.apparent_power,
        reactive_power = EXCLUDED.reactive_power
  
$BODY$;




-- PROCEDURE: public.copy_pgcountertrans_to_pgcountermin()

-- DROP PROCEDURE public.copy_pgcountertrans_to_pgcountermin();

CREATE OR REPLACE PROCEDURE public.copy_pgcountertrans_to_pgcountermin(
	)
LANGUAGE 'sql'
AS $BODY$
INSERT INTO pg_counter_min (
        date_time,
        unix_record_id,
        date_time_source, id, type, com, modbus, status,
        v1, v2, v3, v12, v23, v31,
        i1, i2, i3, inet,
        watt1, watt2, watt3, watt,
        va1, va2, va3, va, freq,
        pf1, pf2, pf3,
        kwh_exp, kwh_imp, kvarh_exp, kvarh_imp, kvah,
        thd_v1, thd_v2, thd_v3, thd_i1, thd_i2, thd_i3,
        kwh1, kwh2, kwh
        )	
        SELECT -- 300 per 5 MIN
        to_timestamp(floor((extract('EPOCH' from date_time) / 900 )) * 900) AT TIME ZONE 'UTC' as date_time_stamp, 
        CONCAT(to_timestamp(floor((extract('EPOCH' from date_time) / 900 )) * 900) AT TIME ZONE 'UTC',' ', id) as unix_record_id,
        date_time, id, type, com, modbus, status,
        v1, v2, v3, v12, v23, v31,
        i1, i2, i3, inet,
        watt1, watt2, watt3, watt,
        va1, va2, va3, va, freq,
        pf1, pf2, pf3,
        kwh_exp, kwh_imp, kvarh_exp, kvarh_imp, kvah,
        thd_v1, thd_v2, thd_v3, thd_i1, thd_i2, thd_i3,
        kwh1, kwh2, kwh
        from 
        pg_counter_trans -- 		where id='LT_5_1'
        order by date_time, id asc --ambil yang pertama dalam rentang epoch
        ON CONFLICT (unix_record_id) DO NOTHING

$BODY$;




-- PROCEDURE: public.maintenance_data_daily()

-- DROP PROCEDURE public.maintenance_data_daily();

CREATE OR REPLACE PROCEDURE public.maintenance_data_daily(
	)
LANGUAGE 'sql'
AS $BODY$
-- run daily
-- maintenance_data_daily
DELETE FROM pg_counter_trans WHERE date_time < (LOCALTIMESTAMP - '7 DAYS'::interval); -- 7 days
DELETE FROM pg_counter_min WHERE date_time < (LOCALTIMESTAMP - '24 MONTH'::interval); -- 2 years
DELETE FROM pg_counter_hour WHERE date_time < (LOCALTIMESTAMP - '60 MONTH'::interval); -- 5 years

$BODY$;



-- PROCEDURE: public.maintenance_data_hourly()

-- DROP PROCEDURE public.maintenance_data_hourly();

CREATE OR REPLACE PROCEDURE public.maintenance_data_hourly(
	)
LANGUAGE 'sql'
AS $BODY$
-- run hourly
-- maintenance_data_hourly
DELETE FROM pg_counter WHERE LENGTH(id) < 6 OR LENGTH(id) > 10;
DELETE FROM pg_counter_live WHERE LENGTH(id) < 6 OR LENGTH(id) > 10;
DELETE FROM pg_counter_trans WHERE LENGTH(id) < 6 OR LENGTH(id) > 10;
DELETE FROM pg_counter_min WHERE LENGTH(id) < 6 OR LENGTH(id) > 10;
DELETE FROM pg_counter_hour WHERE LENGTH(id) < 6 OR LENGTH(id) > 10;
DELETE FROM pg_counter_day WHERE LENGTH(id) < 6 OR LENGTH(id) > 9;
DELETE FROM pg_counter_min WHERE LENGTH(unix_record_id) < 20;
DELETE FROM pg_counter_hour WHERE LENGTH(unix_record_id) < 20;
DELETE FROM pg_counter_day WHERE LENGTH(unix_record_id) < 20;
DELETE FROM pg_counter_live WHERE date_time = null;
DELETE FROM pg_counter_min WHERE date_time = null;
DELETE FROM pg_counter_min_metergroups WHERE date_time = null;

$BODY$;



-- PROCEDURE: public.proc_pg_alarm_t()

-- DROP PROCEDURE public.proc_pg_alarm_t();

CREATE OR REPLACE PROCEDURE public.proc_pg_alarm_t(
	)
LANGUAGE 'sql'
AS $BODY$
    INSERT INTO 
    pg_alarm (
    alarmtype, id,
    date_time, alarmlog, created, active, uuid, updated
    ) 
    select 
    'T', 
    tc2.id, 
    tc2.date_time, 
    'T: Timeout Active', 
    date_trunc('second', LOCALTIMESTAMP), 
    1,
    CONCAT(tc2.id, '=T:Active=', tc2.date_time), 
    date_trunc('second', LOCALTIMESTAMP)
    from 
    pg_counter_live tc2 
    inner join data_meter tdm on tc2.id = tdm.id 
    where 
    tdm.alarm_to_yesno = 1 
    and tdm.alarm_to_high_limit > 0 
    and EXTRACT(EPOCH FROM (NOW() - tc2.date_time)) > (tdm.alarm_to_high_limit * 60 )

    on conflict (uuid) do update 
    set
    updated = date_trunc('second', LOCALTIMESTAMP);

$BODY$;




-- ###### Trigger Function (3)

-- FUNCTION: public.insert_update_pg_counter_to_pg_counter_live_n_trans()

-- DROP FUNCTION public.insert_update_pg_counter_to_pg_counter_live_n_trans();

CREATE OR REPLACE FUNCTION public.insert_update_pg_counter_to_pg_counter_live_n_trans()
    RETURNS trigger
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE NOT LEAKPROOF
AS $BODY$
        BEGIN
		
		IF NEW.id LIKE 'COM%' AND NEW.v1 IS NOT NULL AND NEW.i1 IS NOT NULL AND NEW.thd_v1 IS NOT NULL AND NEW.kwh_exp IS NOT NULL THEN
		
        INSERT INTO pg_counter_live
            (
            date_time, id, type, com, modbus, status,
            v1, v2, v3, v12, v23, v31,
            i1, i2, i3, inet,
            watt1, watt2, watt3, watt,
            va1, va2, va3, va, freq,
            pf1, pf2, pf3,
            kwh_exp, kwh_imp, kvarh_exp, kvarh_imp, kvah,
            thd_v1, thd_v2, thd_v3, thd_i1, thd_i2, thd_i3,
            kwh1, kwh2, kwh
            )
            VALUES (
            NEW.date_time, NEW.id, NEW.type, NEW.com, NEW.modbus, NEW.status,
            NEW.v1, NEW.v2, NEW.v3, NEW.v12, NEW.v23, NEW.v31,
            NEW.i1, NEW.i2, NEW.i3, NEW.inet,
            NEW.watt1, NEW.watt2, NEW.watt3,NEW.watt,
            NEW.va1, NEW.va2, NEW.va3, NEW.va, NEW.freq,
            NEW.pf1, NEW.pf2, NEW.pf3,
            NEW.kwh_exp, NEW.kwh_imp, NEW.kvarh_exp, NEW.kvarh_imp, NEW.kvah,
            NEW.thd_v1, NEW.thd_v2, NEW.thd_v3, NEW.thd_i1, NEW.thd_i2, NEW.thd_i3,
            NEW.kwh1, NEW.kwh2, NEW.kwh
            )
            ON CONFLICT(id) DO UPDATE
            SET
            date_time = NEW.date_time,    type = NEW.type,    com = NEW.com,    modbus = NEW.modbus,    status = NEW.status,
            v1 = NEW.v1,    v2 = NEW.v2,    v3 = NEW.v3,    v12 = NEW.v12,    v23 = NEW.v23,    v31 = NEW.v31,
            i1 = NEW.i1,    i2 = NEW.i2,    i3 = NEW.i3,    inet = NEW.inet,
            watt1 = NEW.watt1,    watt2 = NEW.watt2,    watt3 = NEW.watt3,    watt = NEW.watt,
            va1 = NEW.va1,    va2 = NEW.va2,    va3 = NEW.va3,    va = NEW.va,    freq = NEW.freq,
            pf1 = NEW.pf1,    pf2 = NEW.pf2,    pf3 = NEW.pf3,
            kwh_exp = NEW.kwh_exp,    kwh_imp = NEW.kwh_imp,    kvarh_exp = NEW.kvarh_exp,    kvarh_imp = NEW.kvarh_imp,    kvah = NEW.kvah,
            thd_v1 = NEW.thd_v1,    thd_v2 = NEW.thd_v2,    thd_v3 = NEW.thd_v3,    thd_i1 = NEW.thd_i1,    thd_i2 = NEW.thd_i2,    thd_i3 = NEW.thd_i3,
            kwh1 = NEW.kwh1,    kwh2 = NEW.kwh2,    kwh = NEW.kwh
            ;
        INSERT INTO pg_counter_trans
            (
            date_time, id, type, com, modbus, status,
            v1, v2, v3, v12, v23, v31,
            i1, i2, i3, inet,
            watt1, watt2, watt3, watt,
            va1, va2, va3, va, freq,
            pf1, pf2, pf3,
            kwh_exp, kwh_imp, kvarh_exp, kvarh_imp, kvah,
            thd_v1, thd_v2, thd_v3, thd_i1, thd_i2, thd_i3,
            kwh1, kwh2, kwh
            )
            VALUES (
            NEW.date_time, NEW.id, NEW.type, NEW.com, NEW.modbus, NEW.status,
            NEW.v1, NEW.v2, NEW.v3, NEW.v12, NEW.v23, NEW.v31,
            NEW.i1, NEW.i2, NEW.i3, NEW.inet,
            NEW.watt1, NEW.watt2, NEW.watt3,NEW.watt,
            NEW.va1, NEW.va2, NEW.va3, NEW.va, NEW.freq,
            NEW.pf1, NEW.pf2, NEW.pf3,
            NEW.kwh_exp, NEW.kwh_imp, NEW.kvarh_exp, NEW.kvarh_imp, NEW.kvah,
            NEW.thd_v1, NEW.thd_v2, NEW.thd_v3, NEW.thd_i1, NEW.thd_i2, NEW.thd_i3,
            NEW.kwh1, NEW.kwh2, NEW.kwh
            )
            ;
		
		END IF;
		
        RETURN NEW;
        END;
    
$BODY$;

ALTER FUNCTION public.insert_update_pg_counter_to_pg_counter_live_n_trans()
    OWNER TO postgres;





-- FUNCTION: public.iud_datameter_to_metergroups()

-- DROP FUNCTION public.iud_datameter_to_metergroups();

CREATE OR REPLACE FUNCTION public.iud_datameter_to_metergroups()
    RETURNS trigger
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE NOT LEAKPROOF
AS $BODY$
BEGIN
		
		UPDATE metergroups 
		SET num_member = (SELECT COUNT(*) FROM data_meter WHERE metergroupid = metergroups.metergroupid);
        RETURN NEW;
END;
    
$BODY$;

ALTER FUNCTION public.iud_datameter_to_metergroups()
    OWNER TO postgres;




-- FUNCTION: public.trig_func_pg_alarm()

-- DROP FUNCTION public.trig_func_pg_alarm();

CREATE OR REPLACE FUNCTION public.trig_func_pg_alarm()
    RETURNS trigger
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE NOT LEAKPROOF
AS $BODY$
DECLARE			
	idm	VARCHAR = NEW.id;
	dt	timestamp without time zone = NEW.date_time;
	v1	NUMERIC = NEW.v1;
	v2	NUMERIC = NEW.v2;
	v3	NUMERIC = NEW.v3;
	i1	NUMERIC = NEW.i1;
	i2	NUMERIC = NEW.i2;
	i3	NUMERIC = NEW.i3;
	p1	NUMERIC = NEW.watt1;
	p2	NUMERIC = NEW.watt2;
	p3	NUMERIC = NEW.watt3;
	p	NUMERIC = NEW.watt;
	s1	NUMERIC = NEW.va1;
	s2	NUMERIC = NEW.va2;
	s3	NUMERIC = NEW.va3;
	s	NUMERIC = NEW.va;
	freq	NUMERIC = NEW.freq;
	pf1	NUMERIC = NEW.pf1;
	pf2	NUMERIC = NEW.pf2;
	pf3	NUMERIC = NEW.pf3;
	pf	NUMERIC = NEW.pf2; -- no pf cloumn
	thd_v1	NUMERIC = NEW.thd_v1;
	thd_v2	NUMERIC = NEW.thd_v2;
	thd_v3	NUMERIC = NEW.thd_v3;
	thd_i1	NUMERIC = NEW.thd_i1;
	thd_i2	NUMERIC = NEW.thd_i2;
	thd_i3	NUMERIC = NEW.thd_i3;
	
	-- Alarm code assigment
	var_alarm_v 	VARCHAR = '..'; -- VT voltage tolerance
	var_alarm_c 	VARCHAR = '..'; -- UC unbalance current / load
	var_alarm_o	 	VARCHAR = '..'; -- OC over current
	var_alarm_q 	VARCHAR = '..'; -- PF power factor
	var_alarm_p 	VARCHAR = '..'; -- RP reverse power
	var_alarm_hv 	VARCHAR = '..'; -- HV harmonic v
	var_alarm_hc 	VARCHAR = '..'; -- HC harmonic i
	var_alarm_all 	VARCHAR = '.._.._.._.._.._..';	-- var_alarm_all = CONCAT(var_alarm_v, '_', var_alarm_c, '_', var_alarm_o, '_', var_alarm_q, '_', var_alarm_p, '_',var_alarm_hv, '_',var_alarm_hc);
	log_alarm_v 	VARCHAR = ''; -- VT voltage tolerance
	log_alarm_c 	VARCHAR = ''; -- UC unbalance current / load
	log_alarm_o	 	VARCHAR = ''; -- OC over current
	log_alarm_q 	VARCHAR = ''; -- PF power factor
	log_alarm_p 	VARCHAR = ''; -- RP reverse power
	log_alarm_hv 	VARCHAR = ''; -- HV harmonic v
	log_alarm_hc 	VARCHAR = ''; -- HC harmonic i
	log_alarm_all 	VARCHAR = '';	
	
	is_alarm 				SMALLINT = 0;
    alarm_disable_limit 	FLOAT = 5; -- %
	v_nom_ln 				FLOAT;
	i_unbalance 			FLOAT;
	Iavg					FLOAT;
	Imax					FLOAT;
	Idis					FLOAT;
	-- data_meter variable 
	v_nom 			NUMERIC;
	i_nom 			NUMERIC;
	p_nom 			NUMERIC;
	vt_low_limit 	NUMERIC; -- Voltage toleran Low
	vt_high_limit 	NUMERIC; -- Voltage toleran High
	uc_high_limit 	NUMERIC; -- high unbalance
	oc_high_limit 	NUMERIC; -- high curent
	pf_low_limit 	NUMERIC; -- low power factor
	rp_low_limit 	NUMERIC = 0; -- no needed ( fixed < 0)
	hv_high_limit 	NUMERIC; -- high thd v
	hc_high_limit 	NUMERIC; -- high thd c
	vt_yesno 	SMALLINT;
	uc_yesno 	SMALLINT;
	oc_yesno 	SMALLINT;
	pf_yesno 	SMALLINT;
	rp_yesno 	SMALLINT;
	hv_yesno 	SMALLINT;
	hc_yesno 	SMALLINT;
	
BEGIN
SELECT 
		v_nominal,
		i_nominal,
		p_nominal,
		alarm_vt_low_limit,
		alarm_vt_high_limit,
		alarm_uc_high_limit,
		alarm_oc_high_limit,
		alarm_pf_low_limit,
		alarm_hv_high_limit,
		alarm_hc_high_limit,
		alarm_vt_yesno,
		alarm_uc_yesno,
		alarm_oc_yesno,
		alarm_pf_yesno,
		alarm_rp_yesno,
		alarm_hv_yesno,
		alarm_hc_yesno
INTO 
		-- data_meter variable 
		v_nom,
		i_nom,
		p_nom,
		vt_low_limit,
		vt_high_limit,
		uc_high_limit,
		oc_high_limit,
		pf_low_limit,
		hv_high_limit,
		hc_high_limit,
		vt_yesno,
		uc_yesno,
		oc_yesno,
		pf_yesno,
		rp_yesno,
		hv_yesno,
		hc_yesno

FROM 
		data_meter
WHERE 
		id  = NEW.id;

	v_nom_ln 	= v_nom / 1.7321;
	Imax 		= GREATEST(i1, i2, i3);
	Idis		= ((alarm_disable_limit / 100) * i_nom); 
	
	-- var_alarm_all = 'VT UC OC PF AP HC HV';
	IF  ( Imax > Idis) THEN -- Check alarm disable by minumum current 
	
		IF vt_yesno = 1 THEN -- VT
			IF 	(v1 <> 0 OR v2 <> 0 OR v3 <> 0)
				AND
				(
					( v1 < (vt_low_limit / 100 * v_nom_ln) OR v1 > (vt_high_limit / 100 * v_nom_ln) )
					OR
					( v2 < (vt_low_limit / 100 * v_nom_ln) OR v2 > (vt_high_limit / 100 * v_nom_ln) )
					OR
					( v3 < (vt_low_limit / 100 * v_nom_ln) OR v3 > (vt_high_limit / 100 * v_nom_ln) )
				)
			THEN
					is_alarm = 1;
					var_alarm_v = 'VT';
					log_alarm_v = 'VT-Voltage Tolerance';
			END IF;
		END IF;

		-- As per NEMA MG1-14.34, Voltage and Current Unbalance percentage is calculated based on the following formula:
		-- IU = 100 * max ( |I1 - Iavg| , |I2 - Iavg| , |I3 - Iavg| ) / Iavg
		Iavg = (i1 + i2 + i3) / 3;
		i_unbalance = 100 * GREATEST( ABS(i1-Iavg), ABS(i2-Iavg), ABS(i3-Iavg)) / Iavg;
		
		IF uc_yesno = 1 THEN -- UC
			IF 	( i1 > 0 OR i2 > 0 OR i3 > 0 )
				AND
				( i_unbalance > uc_high_limit )
			THEN		
					is_alarm = 1;
					var_alarm_c = 'UC';
					log_alarm_c = 'UC-Unbalance Current Load';	
			END IF;	
		END IF;

		IF oc_yesno = 1 THEN -- OC
			IF 	(
					(i1 > (oc_high_limit / 100 * i_nom))
					OR
					(i2 > (oc_high_limit / 100 * i_nom))
					OR
					(i3 > (oc_high_limit / 100 * i_nom))
				)
			THEN
				
					is_alarm = 1;
					var_alarm_o = 'OC';
					log_alarm_o	= 'OC-Over Current';
			END IF;
		END IF;

		IF pf_yesno = 1 THEN -- PF
			IF 	(
					(abs(pf1) < pf_low_limit )
					OR
					(abs(pf2) < pf_low_limit )
					OR
					(abs(pf3) < pf_low_limit )
					OR
					(abs(pf) < pf_low_limit )
				)			
			THEN
					is_alarm = 1;
					var_alarm_q = 'PF';
					log_alarm_q = 'PF-Power Factor Low';
					-- SET var_alarm_q = CONCAT('Q : Power Factor , pf1=', var_pf1, ' pf2=', var_pf2, ' pf3=', var_pf3, ' ', var_date_time);
					-- SET var_alarm_all = CONCAT(TRIM(var_alarm_all), ' ', var_alarm_q);
			END IF;
		END IF;

		IF (rp_yesno = 1) THEN -- RP
			IF 	( 
					p1 < rp_low_limit OR p2 < rp_low_limit OR p3 < rp_low_limit OR p < rp_low_limit 
				)
			THEN
				
					is_alarm = 1;
					var_alarm_p = 'RP';
					log_alarm_p = 'RP-Reverse Power';
					-- SET var_alarm_p = CONCAT('P : Reserve Power , watt1=', var_watt1, ' watt2=', var_watt2, ' watt3=', var_watt3, 'watt=', var_watt , ' ', var_date_time);
					-- SET var_alarm_all = CONCAT(TRIM(var_alarm_all), ' ', var_alarm_p);
			-- ELSE
			-- 	SET var_alarm_p = '';
			END IF;
		END IF;

		IF hv_yesno = 1 THEN -- HV

			IF 	(
					(thd_v1 > (hv_high_limit))
					OR
					(thd_v2 > (hv_high_limit))
					OR
					(thd_v3 > (hv_high_limit))
				)
			THEN		
					is_alarm = 1;
					var_alarm_hv = 'HV';
					log_alarm_hv = 'HV-Harmonic Voltage High';
			END IF;
		END IF;

		IF hc_yesno = 1 THEN -- HC
			IF 	(
					(thd_i1 > (hc_high_limit))
					OR
					(thd_i2 > (hc_high_limit))
					OR
					(thd_i3 > (hc_high_limit))
				)
			THEN
					is_alarm = 1;
					var_alarm_hc = 'HC';
					log_alarm_hc = 'HC-Harmonic Current High';
			END IF;

		END IF;

		IF is_alarm = 1 THEN
			var_alarm_all = CONCAT(var_alarm_v, '_', var_alarm_c, '_', var_alarm_o, '_', var_alarm_q, '_', var_alarm_p, '_',var_alarm_hv, '_',var_alarm_hc);
			log_alarm_all = CONCAT(log_alarm_v, '; ', log_alarm_c, '; ', log_alarm_o, '; ', log_alarm_q, '; ', log_alarm_p, '; ',log_alarm_hv, '; ',log_alarm_hc);
			log_alarm_all = CONCAT(log_alarm_all, ' <=> ', ' v1=', v1, ' v2=', v2, ' v3=', v3, ' i1=', i1, ' i2=', i2, ' i3=', i3, ' p1=', p1, ' p2=', p2, ' p3=', p3, ' pf1=', pf1, ' pf2=', pf2, ' pf3=', pf3, ' thd_v1=', thd_v1, ' thd_v2=', thd_v2, ' thd_v3=', thd_v3, ' thd_i1=', thd_i1, ' thd_i2=', thd_i2, ' thd_i3=', thd_i3);
			INSERT INTO pg_alarm (alarmtype, id, alarmlog, date_time, created, updated) 
			VALUES (var_alarm_all, idm, log_alarm_all, dt, dt, date_trunc('second', LOCALTIMESTAMP) );
		ELSE
			-- INSERT INTO pg_alarm (alarmtype, id, alarmlog, date_time, created, updated) 
			-- VALUES (var_alarm_all, idm, log_alarm_all, dt, dt, NOW() );
		END IF;
		
			
	ELSE
		-- NOTHING
		--	var_alarm_all = CONCAT(var_alarm_v, '_', var_alarm_c, '_', var_alarm_o, '_', var_alarm_q, '_', var_alarm_p, '_',var_alarm_hv, '_',var_alarm_hc);
		--	log_alarm_all = CONCAT(log_alarm_v, '; ', log_alarm_c, '; ', log_alarm_o, '; ', log_alarm_q, '; ', log_alarm_p, '; ',log_alarm_hv, '; ',log_alarm_hc);
		--	log_alarm_all = CONCAT(log_alarm_all, '<== ', Idis, '|', Imax, ' ==>', ' v1=', v1, ' v2=', v2, ' v3=', v3, ' i1=', i1, ' i2=', i2, ' i3=', i3, ' p1=', p1, ' p2=', p2, ' p3=', p3, ' pf1=', pf1, ' pf2=', pf2, ' pf3=', pf3, ' thd_v1=', thd_v1, ' thd_v2=', thd_v2, ' thd_v3=', thd_v3, ' thd_i1=', thd_i1, ' thd_i2=', thd_i2, ' thd_i3=', thd_i3);
		--	INSERT INTO pg_alarm (alarmtype, id, alarmlog, date_time, created, updated) 
		--	VALUES ('diasble', idm, log_alarm_all, dt, dt, NOW() );
	END IF;

RETURN NULL;

END;

$BODY$;

ALTER FUNCTION public.trig_func_pg_alarm()
    OWNER TO postgres;






-- ###### Functions (7)




-- FUNCTION: public.backup_data(character varying, character varying, character varying)

-- DROP FUNCTION public.backup_data(character varying, character varying, character varying);

CREATE OR REPLACE FUNCTION public.backup_data(
	var_table character varying,
	var_path character varying,
	var_prefix character varying)
    RETURNS timestamp without time zone
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $BODY$
DECLARE
	
   qry TEXT;
   file_and_path TEXT;
   suffix TEXT;
   suffix_yymm TEXT;
   last_month TEXT;
   this_month TEXT;
   
BEGIN
	
	suffix := TO_CHAR(NOW(), 'YYMMDDHH24MISS'); 
	suffix_yymm := TO_CHAR(LOCALTIMESTAMP, 'YYMM'); 
    
	file_and_path := RTRIM(var_path,'/') || '/' || var_prefix || '_' || suffix_yymm ||'_' || suffix || '.csv';
	this_month := date_trunc('MONTH', LOCALTIMESTAMP - '0 MONTH'::interval);
	last_month := date_trunc('MONTH', LOCALTIMESTAMP - '1 MONTH'::interval);

	qry := FORMAT('COPY ( SELECT * FROM %s WHERE date_time < %L AND date_time >= %L ) TO %L CSV HEADER', var_table, this_month, last_month, file_and_path);
    EXECUTE qry;
	
	return now();
    

	
END;
$BODY$;

ALTER FUNCTION public.backup_data(character varying, character varying, character varying)
    OWNER TO postgres;




-- FUNCTION: public.get_max_date_time_usage(character varying, timestamp without time zone, timestamp without time zone, character varying)

-- DROP FUNCTION public.get_max_date_time_usage(character varying, timestamp without time zone, timestamp without time zone, character varying);

CREATE OR REPLACE FUNCTION public.get_max_date_time_usage(
	var_id character varying,
	var_date_time_from timestamp without time zone,
	var_date_time_thru timestamp without time zone,
	var_tablename character varying)
    RETURNS timestamp without time zone
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $BODY$
declare
   var_date_time timestamp without time zone;
begin
   	if (var_tablename = 'counter2') then
		select max(date_time) into var_date_time from counter2
		where id = var_id
		and date_time BETWEEN var_date_time_from AND var_date_time_thru;
	elseif (var_tablename = 'counter_jam') then
		select max(date_time) into var_date_time from counter_jam
		where id = var_id
		and date_time BETWEEN var_date_time_from AND var_date_time_thru;
	ELSE
		select max(date_time) into var_date_time from pg_counter_min
		where id = var_id
		and date_time BETWEEN var_date_time_from AND var_date_time_thru;
	end if;
   
   return var_date_time;
end;
$BODY$;

ALTER FUNCTION public.get_max_date_time_usage(character varying, timestamp without time zone, timestamp without time zone, character varying)
    OWNER TO postgres;






-- FUNCTION: public.get_min_date_time_usage(character varying, timestamp without time zone, timestamp without time zone, character varying)

-- DROP FUNCTION public.get_min_date_time_usage(character varying, timestamp without time zone, timestamp without time zone, character varying);

CREATE OR REPLACE FUNCTION public.get_min_date_time_usage(
	var_id character varying,
	var_date_time_from timestamp without time zone,
	var_date_time_thru timestamp without time zone,
	var_tablename character varying)
    RETURNS timestamp without time zone
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $BODY$
declare
   var_date_time timestamp without time zone;
begin
   	if (var_tablename = 'counter2') then
		select min(date_time) into var_date_time from counter2
		where id = var_id
		and date_time BETWEEN var_date_time_from AND var_date_time_thru;
	elseif (var_tablename = 'counter_jam') then
		select min(date_time) into var_date_time from counter_jam
		where id = var_id
		and date_time BETWEEN var_date_time_from AND var_date_time_thru;
	ELSE
		select min(date_time) into var_date_time from pg_counter_min
		where id = var_id
		and date_time BETWEEN var_date_time_from AND var_date_time_thru;
	end if;
   
   return var_date_time;
end;
$BODY$;

ALTER FUNCTION public.get_min_date_time_usage(character varying, timestamp without time zone, timestamp without time zone, character varying)
    OWNER TO postgres;




-- ###### Trigger (7)

-- Trigger:  insert_update_pg_counter_to_pg_counter_live_n_trans

-- DROP TRIGGER " insert_update_pg_counter_to_pg_counter_live_n_trans" ON public.pg_counter;

CREATE TRIGGER " insert_update_pg_counter_to_pg_counter_live_n_trans"
    AFTER INSERT OR UPDATE 
    ON public.pg_counter
    FOR EACH ROW
    EXECUTE FUNCTION public.insert_update_pg_counter_to_pg_counter_live_n_trans();




    -- Trigger: call_trig_func_pg_alarm

-- DROP TRIGGER call_trig_func_pg_alarm ON public.pg_counter_min;

CREATE TRIGGER call_trig_func_pg_alarm
    AFTER INSERT OR UPDATE OF date_time
    ON public.pg_counter_min
    FOR EACH ROW
    EXECUTE FUNCTION public.trig_func_pg_alarm();