Updated 21 Dec 2023

pgpass.conf
C:\Users\postgres\AppData\Roaming\postgresql\pgpass.conf

localhost:5432:postgres:postgres:12345678
to
localhost:5432:*:postgres:12345678

<?php

http://localhost/ems_grp1/dashboardgroup/index/0
C_MVC = Dashboardgroup
           	$list = $this->model_dashboard->get_data_metergroup_paging_list($this->paging_row_perpage, $val_page, $this->session->userdata('username'))->result();
		    foreach ($list as $metergroup)
			$metergroupid    = $metergroup->metergroupid;
			$dtcounter = $this->model_dashboard->dt_counter_group_formatted('pg_counter_min_metergroups', $metergroupid)->row();// tkh

http://localhost/ems_grp1/dashboard/index/0
C_MVC = Dashboard
			Update dashboard :
    		$id_counter = $this->model_dashboard->getcounter_id('pg_counter_live', $id);
			$dtcounter = $this->model_dashboard->dt_counter_formatted('pg_counter_live', $id_counter)->row();

			Update header dassboard group:
			$dtcounter = $this->model_dashboard->dt_counter_formatted('pg_counter_min_metergroups', 'metergroupid', $metergroupid)->row();// tkh

http://localhost/ems_grp1/variablegraphical?id=LT_5_1&idname=LT01_1%20PMAC903
C_MVC = Dashboard
			$dtcounter 	= $this->model_variablegraphical->dt_counter_1('pg_counter_live', 'id', $id)->row();


http://localhost/ems_grp1/trendperiodicmultiple
C_MVC = Trendperiodicmultiple

			if ($tempo == 'Daily') {
					$tablename = 'pg_counter_day'; // tkh
					$condition_trend['id'] 				= $id;
					$condition_trend['date_time >= '] 	= $dari . ' ' . $dari_time;
					$condition_trend['date_time <= '] 	= $sampai . ' ' . $sampai_time;
					$trends = $this->mcrud->searchall($condition_trend, $tablename, 'date_time', 'asc');
				} else if ($tempo == 'Hourly') {
					$tablename = 'pg_counter_hour'; // tkh
					$condition_trend['id'] 				= $id;
					$condition_trend['date_time >= '] 	= $dari . ' ' . $dari_time;
					$condition_trend['date_time <= '] 	= $sampai . ' ' . $sampai_time;
					$trends = $this->mcrud->searchall($condition_trend, $tablename, 'date_time', 'asc');
				} else { // Detail
					$tablename = 'pg_counter_min'; // tkh
					$condition_trend['id'] 				= $id;
					$condition_trend['date_time >= '] 	= $dari . ' ' . $dari_time;
					$condition_trend['date_time <= '] 	= $sampai . ' ' . $sampai_time;
					$trends = $this->mcrud->searchall($condition_trend, $tablename, 'date_time', 'asc');
			}

http://localhost/ems_grp1/billing  (wbp = col kwh1, lwbp = col kwh2)
C_MVC = Billing
            $tablename = 'pg_counter_hour'; // tkh
            $rows 		= $this->model_billing->usagereport($var_date_from, $var_date_thru, $str_meter, $tablename)->result();



Alarm

        CREATE TABLE IF NOT EXISTS public.pg_alarm
        (
            id_alarm SERIAL PRIMARY KEY,
            alarmtype character varying(8),
            id character varying(255),
            alarmlog character varying(1000),
            date_time timestamp without time zone,
            created timestamp without time zone,
            updated timestamp without time zone,
            uuid VARCHAR (50) UNIQUE,
            active smallint DEFAULT 1
        )

///////Log if T Active /////////
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
    NOW(), 
    1,
    CONCAT(tc2.id, '=T:Active=', tc2.date_time), 
    NOW()
    from 
    pg_counter_live tc2 
    inner join data_meter tdm on tc2.id = tdm.id 
    where 
    tdm.dlpd_t_high_yesno = 1 
    and tdm.dlpd_t_high > 0 
    and EXTRACT(EPOCH FROM (NOW() - tc2.date_time)) > (tdm.dlpd_t_high * 60 )

    on conflict (uuid) do update 
    set
    updated = now();
///////Log if T Active /////////

///////Log if T InActive /////////
-- ///////////OK Insert alarmtype T active 0 if not timeout, on duplicate update the Updated 
    INSERT INTO 
    pg_alarm (
    alarmtype, id,
    date_time, alarmlog, created, active, uuid, updated
    ) 
    select 
    'T', 
    tc2.id, 
    tc2.date_time, 
    'T: Timeout InActive', 
    NOW(), 
    0,
    CONCAT(tc2.id, '=T:InActive=', tc2.date_time), 
    NOW() 
    from 
    pg_counter_live tc2 
    inner join data_meter tdm on tc2.id = tdm.id 
    where 
    tc2.id not in (
        select 
        tc2.id 
        from 
        pg_counter_live tc2 
        inner join data_meter tdm on tc2.id = tdm.id 
        where 
        tdm.dlpd_t_high_yesno = 1 
        and tdm.dlpd_t_high > 0 
        and EXTRACT(EPOCH FROM (NOW() - tc2.date_time)) > (tdm.dlpd_t_high * 60 )
    )
    on conflict (uuid) do update 
    set
    updated = now();
///////Log if T InActive /////////



//@24JAN2022
http://localhost/ems_grp1_site/meterdata
C_MVC = Meterdata

add coloums 'lokasi'
C:\xampp\htdocs\ems_grp1_site\application\views\meterdata.php
C:\xampp\htdocs\ems_grp1_site\assets\general\js\ajaxdatameter.js

C:\xampp\htdocs\ems_grp1_site\application\views\meterdata_edit.php
C:\xampp\htdocs\ems_grp1_site\application\controllers\Meterdata.php

// -- Format null => * 
C:\xampp\htdocs\ems_grp1_site\application\controllers\Variablegraphical.php

// -- Edit scale gauge 
C:\xampp\htdocs\ems_grp1_site\assets\general\js\variablegraphical.js
var v_nom = parseFloat(obj.v_nominal);
//  IF(H2>25000,40000,IF(H2>10000,25000,IF(H2>5000,8000,500))) LL
//  IF(H2>25000,22000,IF(H2>10000,18000,IF(H2>5000,5000,250))) LN
var set_max = 500;
if (v_nom > 25000) {
  set_max = 40000;
} else if (v_nom > 10000) {
  set_max = 25000;
} else if (v_nom > 5000) {
  set_max = 8000;
}

var al_c_0 = 0.6;
var al_c_1 = 0.7;
var al_c_2 = 0.9;


            https://www.postgresql.org/docs/current/libpq-connect.html#LIBPQ-CONNSTRING
            https://www.enterprisedb.com/edb-docs/d/pgadmin-4/reference/online-documentation/4.16/pgagent_install.html
            

                                        C:\PROGRA~1\POSTGR~1\14\bin\pgagent.exe RUN pgagent-pg14 host=localhost port=5432 user=postgres dbname=postgres
                                        pgAgent REMOVE pgAgent
                                        
                                        cd C:\Program Files\PostgreSQL\14\bin\
                                        "C:\PROGRA~1\POSTGR~1\14\bin\pgagent.exe" INSTALL pgAgent4 -u TOMMY -p Khalid2015 hostaddr=127.0.0.1 dbname=dbemspg_grp1 user=postgres password=12345678
                                        
                                        "C:\Program Files\PostgreSQL\14\bin\pgagent.exe" INSTALL pgAgent -u postgres -p 12345678 hostaddr=127.0.0.1 dbname=dbemspg_grp1 user=postgres password=12345678
                                        
                                        
                                        C:\PROGRA~1\POSTGR~1\14\bin\pgagent.exe RUN pgagent-pg14 host=localhost port=5432 user=postgres dbname=postgres
                                        
                                        "C:\PROGRA~1\POSTGR~1\14\bin\pgagent.exe" INSTALL pgAgent22 host=localhost port=5432 user=postgres dbname=dbemspg_grp1
                                        C:\PROGRA~1\POSTGR~1\14\bin\pgAgent.exe RUN pgAgent22 host=localhost port=5432 dbname=dbemspg_grp1


                                        pgagent.exe RUN pgagent-pg14 host=localhost port=5432 user=postgres dbname=dbemspg_grp1
                                        "C:\Program Files\PostgreSQL\14\bin\pgAgent.exe" INSTALL pgAgentGrp host=localhost port=5432 user=postgres dbname=dbemspg_grp1

                                        pgAgent INSTALL pgAgentGrp -u postgres -p 12345678 host=localhost port=5432 user=postgres password=12345678 dbname=dbemspg_grp1
                                        pgAgent INSTALL pgAgentGrp1 -u TOMMY -p Khalid2015 host=localhost port=5432 user=postgres password=12345678 dbname=dbemspg_grp1


            runas /user:tommy.kristian.hari cmd.exe
            Pw_4733296971
            C:\Users\tommy.kristian.hari\edb_pgagent_pg14.exe
            C:\Program Files\PostgreSQL\14\bin\pg_dumpall -U postgres -f C:\PMS\BACKUP_DB\db_dumpall.sql
            
            
            Backup satu database postgres
            $ pg_dump -U postgres -d dbemspg_grp1_site -f c:\dump_dbemspg_grp1_site.sql
            pg_dump -U postgres -d dbemspg_soho -f d:\dump_emspg.sql
            Restore
            $ psql -U postgres -d dbemspg_grp1_site -f D:\dbgrp1.sql
            psql -U postgres -d dbemspg_adis -f C:\Users\TOMMY\Downloads\db_dbemspg_adis_20220418\db_dbemspg_adis_20220418.sql
            psql -U postgres -d dbemspg_itb -f D:\dump_emspg.sql

            cd C:\Program Files\PostgreSQL\14\bin

            pg_dump -U postgres -d postgres -f C:\PMS\BACKUP_DB\db_postgres_20220415.sql
            pg_dump -U postgres -d dbemspg_adis -f C:\PMS\BACKUP_DB\db_dbemspg_adis_20220415.sql

            pg_dump -U postgres -d dbemspg_itb -f C:\dbemspg_itb.sql



            C:\Users\TOMMY\AppData\Roaming\postgresql
            localhost:5432:postgres:postgres:12345678
            127.0.0.1:5432:*:TOMMY:Khalid2015

            $ psql -U postgres -d dbemspg_grp1 -f D:\pg_backup\update_counter_live.sql
            --minta paswword
            
            Create manual:
            Publication
            Subscription
            

            
            ---OK---
            ---set DB pg_hba.conf methode password ; postgresql.conf  password authentification = md5----
            Backup Semua Database Postgres
            $ pg_dumpall -U postgres -f c:\db_dumpall.sql
            Restore
            psql -U postgres -f c:\db_dumpall.sql


            Backup spesifik tabel di Postgres
            $ pg_dump --table siswa -U geekstuff sekolah -f hanyatabelsiswa.sql
          
            Restore Tabel Tertentu Kedalam Database
            $ psql -f namafilesql.sql nama_database
            















<tr Aggsoft Queue>
    -- Aggsoft Queue
    INSERT INTO pg_counter (date_time, id, type, com, modbus, status, v1, v2, v3, v12, v23, v31, i1, i2, i3, inet, watt1, watt2, watt3, watt, va1, va2, va3, va, freq, pf1, pf2, pf3, kwh_exp, kwh_imp, kvarh_exp, kvarh_imp, kvah, thd_v1, thd_v2, thd_v3, thd_i1, thd_i2, thd_i3, kwh1, kwh2, kwh)
    VALUES (:date_time, :id, :type, :com, :modbus, :status, :v1, :v2, :v3, :v12, :v23, :v31, :i1, :i2, :i3, :inet, :watt1, :watt2, :watt3, :watt, :va1, :va2, :va3, :va, :freq, :pf1, :pf2, :pf3, :kwh_exp, :kwh_imp, :kvarh_exp, :kvarh_imp, :kvah, :thd_v1, :thd_v2, :thd_v3, :thd_i1, :thd_i2, :thd_i3, :kwh1, :kwh2, :kwh)
    ON CONFLICT(id) DO UPDATE
    SET
    date_time = :date_time,
    type = :type,
    com = :com,
    modbus = :modbus,
    status = :status,
    v1 = :v1,
    v2 = :v2,
    v3 = :v3,
    v12 = :v12,
    v23 = :v23,
    v31 = :v31,
    i1 = :i1,
    i2 = :i2,
    i3 = :i3,
    inet = :inet,
    watt1 = :watt1,
    watt2 = :watt2,
    watt3 = :watt3,
    watt = :watt,
    va1 = :va1,
    va2 = :va2,
    va3 = :va3,
    va = :va,
    freq = :freq,
    pf1 = :pf1,
    pf2 = :pf2,
    pf3 = :pf3,
    kwh_exp = :kwh_exp,
    kwh_imp = :kwh_imp,
    kvarh_exp = :kvarh_exp,
    kvarh_imp = :kvarh_imp,
    kvah = :kvah,
    thd_v1 = :thd_v1,
    thd_v2 = :thd_v2,
    thd_v3 = :thd_v3,
    thd_i1 = :thd_i1,
    thd_i2 = :thd_i2,
    thd_i3 = :thd_i3,
    kwh1 = :kwh1,
    kwh2 = :kwh2,
    kwh = :kwh
    -- Aggsoft Queue
</tr>

<tr>


	Insert data from DataLogger to: (Insert Every 1 Minutes)
		pg_counter (Delete Every 3 hours ??)
	Trigger On Insert : Update to pg_counter_live

	Trigger/ Scheduler to: ( Every 15 Minutes)
		pg_counter_transit



	Overview
		C:dashboard (Overview)
		M:pg_counter_live

	Variable
		C:variablegraphical (Graphical)
		M:pg_counter_live

		Hidden:
		Variable -> Table , kWh Per Jam, Table Per Jam

	Trend and Report
		C:trendperiodicmultiple
		M:pg_counter_transit

	Billing
		C:trendperiodicmultiple
		M:pg_counter_hari


</tr>

<tr ok insert or update from pg_counter to pg_counter_live ????>
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
    SELECT
    date_time, id, type, com, modbus, status,
    AVG(v1) as v1,
    AVG(v2) as v2,
    AVG(v3) as v3,
    AVG(v12) as v12,
    AVG(v23) as v23,
    AVG(v31) as v31,
    AVG(i1) as i1,
    AVG(i2) as i2,
    AVG(i3) as i3,
    AVG(inet) as inet,
    AVG(watt1) as watt1,
    AVG(watt2) as watt2,
    AVG(watt3) as watt3,
    AVG(watt) as watt,
    AVG(va1) as va1,
    AVG(va2) as va2,
    AVG(va3) as va3,
    AVG(va) as va,
    AVG(freq) as freq,
    AVG(pf1) as pf1,
    AVG(pf2) as pf2,
    AVG(pf3) as pf3,
    AVG(kwh_exp) as kwh_exp,
    AVG(kwh_imp) as kwh_imp,
    AVG(kvarh_exp) as kvarh_exp,
    AVG(kvarh_imp) as kvarh_imp,
    AVG(kvah) as kvah,
    AVG(thd_v1) as thd_v1,
    AVG(thd_v2) as thd_v2,
    AVG(thd_v3) as thd_v3,
    AVG(thd_i1) as thd_i1,
    AVG(thd_i2) as thd_i2,
    AVG(thd_i3) as thd_i3,
    AVG(kwh1) as kwh1,
    AVG(kwh2) as kwh2,
    AVG(kwh) as kwh
    FROM
    pg_counter
    WHERE
    extract('EPOCH' from NOW()) + 25200 - extract('EPOCH' from date_time) < 600 --10 Menit--(43200+1800+180000) --12 JAM 30 MENIT
	GROUP BY   
	date_time, id, type, com, modbus, status
    ON CONFLICT(id) DO UPDATE
    SET
    date_time = EXCLUDED.date_time,
    type = EXCLUDED.type,
    com = EXCLUDED.com,
    modbus = EXCLUDED.modbus,
    status = EXCLUDED.status,
    v1 = EXCLUDED.v1,
    v2 = EXCLUDED.v2,
    v3 = EXCLUDED.v3,
    v12 = EXCLUDED.v12,
    v23 = EXCLUDED.v23,
    v31 = EXCLUDED.v31,
    i1 = EXCLUDED.i1,
    i2 = EXCLUDED.i2,
    i3 = EXCLUDED.i3,
    inet = EXCLUDED.inet,
    watt1 = EXCLUDED.watt1,
    watt2 = EXCLUDED.watt2,
    watt3 = EXCLUDED.watt3,
    watt = EXCLUDED.watt,
    va1 = EXCLUDED.va1,
    va2 = EXCLUDED.va2,
    va3 = EXCLUDED.va3,
    va = EXCLUDED.va,
    freq = EXCLUDED.freq,
    pf1 = EXCLUDED.pf1,
    pf2 = EXCLUDED.pf2,
    pf3 = EXCLUDED.pf3,
    kwh_exp = EXCLUDED.kwh_exp,
    kwh_imp = EXCLUDED.kwh_imp,
    kvarh_exp = EXCLUDED.kvarh_exp,
    kvarh_imp = EXCLUDED.kvarh_imp,
    kvah = EXCLUDED.kvah,
    thd_v1 = EXCLUDED.thd_v1,
    thd_v2 = EXCLUDED.thd_v2,
    thd_v3 = EXCLUDED.thd_v3,
    thd_i1 = EXCLUDED.thd_i1,
    thd_i2 = EXCLUDED.thd_i2,
    thd_i3 = EXCLUDED.thd_i3,
    kwh1 = EXCLUDED.kwh1,
    kwh2 = EXCLUDED.kwh2,
    kwh = EXCLUDED.kwh
</tr>

=========START=======

<tr Done: InsertUpdatePgCounterToPgCounterLive and InsertToPgCounterTrans>

    CREATE OR REPLACE FUNCTION InsertUpdatePgCounterToPgCounterLive() RETURNS TRIGGER AS
    $$
        BEGIN
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
        RETURN NEW;
        END;
    $$
    LANGUAGE plpgsql;

    CREATE TRIGGER InsertUpdatePgCounterToPgCounterLive
    AFTER INSERT OR UPDATE 
    ON public.pg_counter
    FOR EACH ROW
    EXECUTE PROCEDURE public.InsertUpdatePgCounterToPgCounterLive();

</tr>

<table Done: PG_COUNTER_SCH_5MIN > -- Scheduler Every 5 Min
    <tr Done: STEP INSERT INTO pg_counter_min >
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
        to_timestamp(floor((extract('EPOCH' from date_time) / 300 )) * 300) AT TIME ZONE 'UTC' as date_time_stamp, 
        CONCAT(to_timestamp(floor((extract('EPOCH' from date_time) / 300 )) * 300) AT TIME ZONE 'UTC',' ', id) as unix_record_id,
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
        <p Old not used>
            INSERT INTO pg_counter_min
            (
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
            SELECT -- 300 per 5 minutes
            to_timestamp(floor((extract('EPOCH' from date_time) / 300 )) * 300) AT TIME ZONE 'UTC' as date_time_stamp,
            CONCAT(to_timestamp(floor((extract('EPOCH' from date_time) / 300 )) * 300) AT TIME ZONE 'UTC',' ', id) as unix_record_id,
            MIN(date_time) as date_time, id, type, com, modbus, status,
            AVG(v1) as v1,
            AVG(v2) as v2,
            AVG(v3) as v3,
            AVG(v12) as v12,
            AVG(v23) as v23,
            AVG(v31) as v31,
            AVG(i1) as i1,
            AVG(i2) as i2,
            AVG(i3) as i3,
            AVG(inet) as inet,
            AVG(watt1) as watt1,
            AVG(watt2) as watt2,
            AVG(watt3) as watt3,
            AVG(watt) as watt,
            AVG(va1) as va1,
            AVG(va2) as va2,
            AVG(va3) as va3,
            AVG(va) as va,
            AVG(freq) as freq,
            AVG(pf1) as pf1,
            AVG(pf2) as pf2,
            AVG(pf3) as pf3,
            AVG(kwh_exp) as kwh_exp,
            AVG(kwh_imp) as kwh_imp,
            AVG(kvarh_exp) as kvarh_exp,
            AVG(kvarh_imp) as kvarh_imp,
            AVG(kvah) as kvah,
            AVG(thd_v1) as thd_v1,
            AVG(thd_v2) as thd_v2,
            AVG(thd_v3) as thd_v3,
            AVG(thd_i1) as thd_i1,
            AVG(thd_i2) as thd_i2,
            AVG(thd_i3) as thd_i3,
            AVG(kwh1) as kwh1,
            AVG(kwh2) as kwh2,
            AVG(kwh) as kwh
            FROM
            pg_counter_trans 
            group by
            date_time_stamp, id, type, com, modbus, status
            ON CONFLICT (unix_record_id) DO NOTHING
        </p>    
    </tr>

    <tr Done: STEP DELETE FROM pg_counter_trans >
        DELETE FROM pg_counter_trans WHERE
        extract('EPOCH' from NOW()) + 25200 - extract('EPOCH' from date_time) > (3600+3600+900)--1jam 1jam 15min
    </tr>

    <tr Done: STEP INSERT INTO pg_counter_hour>
        INSERT INTO pg_counter_hour (
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
		SELECT -- 3600 per jam
			date_trunc('hour', date_time_source) as date_time_stamp,  -- // tkh bisa pakai ini
			-- to_timestamp(floor((extract('EPOCH' from date_time_source) / 3600 )) * 3600) AT TIME ZONE 'UTC' as date_time_stamp, 
			CONCAT(date_trunc('hour', date_time_source),' ', id) as unix_record_id, --// tkh bisa pakai ini
			-- CONCAT(to_timestamp(floor((extract('EPOCH' from date_time_source) / 3600 )) * 3600) AT TIME ZONE 'UTC',' ', id) as unix_record_id,
			date_time_source, id, type, com, modbus, status,
			v1, v2, v3, v12, v23, v31,
			i1, i2, i3, inet,
			watt1, watt2, watt3, watt,
			va1, va2, va3, va, freq,
			pf1, pf2, pf3,
			kwh_exp, kwh_imp, kvarh_exp, kvarh_imp, kvah,
			thd_v1, thd_v2, thd_v3, thd_i1, thd_i2, thd_i3,
			kwh1, kwh2, kwh
        from 
        	pg_counter_min -- 		where id='LT_5_1'
		WHERE
			extract('EPOCH' from NOW()) + 25200 - extract('EPOCH' from date_time) < (3600*3) --1jam*3
			order by date_time_source, id asc --ambil yang pertama dalam rentang epoch
		ON CONFLICT (unix_record_id) DO NOTHING
		
        <p For Checking Test Query>
                select date_time,
                unix_record_id,
                date_time_source, id, id_counter,
                v1, kwh 
                from pg_counter_hour
                order by date_time, id

                select date_time,
                unix_record_id,
                date_time_source, id,  id_counter,
                v1, kwh 
                from pg_counter_min
                where id ='LT_5_1'
                order by id_counter desc
        </p>
        
    </tr>

    <tr Done: INSERT INTO pg_counter_day>
        INSERT INTO pg_counter_day (
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
        SELECT -- per day
			date_trunc('day', date_time_source) as date_time_stamp, 
			CONCAT(date_trunc('day', date_time_source),' ', id) as unix_record_id_hour,
			date_time_source, id, type, com, modbus, status,
			v1, v2, v3, v12, v23, v31,
			i1, i2, i3, inet,
			watt1, watt2, watt3, watt,
			va1, va2, va3, va, freq,
			pf1, pf2, pf3,
			kwh_exp, kwh_imp, kvarh_exp, kvarh_imp, kvah,
			thd_v1, thd_v2, thd_v3, thd_i1, thd_i2, thd_i3,
			kwh1, kwh2, kwh
        from 
        pg_counter_hour -- where id='LT_5_1'-- extract('EPOCH' from NOW()) + 25200 - extract('EPOCH' from date_time) < (3600*3)--1jam*3
		WHERE (date_time_source) - '7 HOURS'::interval > (NOW() - '4 DAYS'::interval) --3 Days before
		order by date_time_source, id asc --ambil yang pertama dalam rentang REC
		ON CONFLICT (unix_record_id) DO NOTHING
    </tr>
    

    <tr Done: STEP DELETE FROM PgCounterMin_n_Hour_DelOldRecord_5_2_Years >
		DELETE FROM pg_counter_hour WHERE
		(date_time_source) < (NOW() - '1825 DAYS'::interval); --5 Years ago

		DELETE FROM pg_counter_min WHERE
		(date_time_source) < (NOW() - '720 DAYS'::interval); --2 Years ago
    </tr>


	<tr>
		INSERT INTO pg_counter_min_metergroups (
			metergroupid, date_time, 
			active_energy, maximum_demand, average_demand, 
			apparent_power, reactive_power, 
			unix_record_id )
			select t2.metergroupid, t1.date_time, 
			TRUNC(sum(t1.kwh_exp),1) as group_active_energy, TRUNC(sum(t1.kwh),1) as group_maximum_demand, TRUNC(sum(t1.watt),1) as group_average_demand, 
			TRUNC(sum(t1.va),1) as group_apparent_power, TRUNC(sum(t1.kvah),1) as group_reactive_power, 
			CONCAT(t2.metergroupid,' ',t1.date_time) as unix_record_id
			from pg_counter_min t1 
			inner join data_meter t2 on t1.id = t2.id
		WHERE (t1.date_time) - '7 HOURS'::interval > (NOW() - '1 HOURS'::interval) --1 HOURS before
		group by t2.metergroupid, t1.date_time
		order by t1.date_time
		ON CONFLICT(unix_record_id) DO UPDATE
		SET
			active_energy  = EXCLUDED.active_energy,
			maximum_demand = EXCLUDED.maximum_demand,
			average_demand = EXCLUDED.average_demand,
			apparent_power = EXCLUDED.apparent_power,
			reactive_power = EXCLUDED.reactive_power
	</tr>

</table>


<tr Copy table>
	-- copy table
	-- The `with no data` here means structure only, no actual rows

    create table pg_counter as (select * from counter0) with no data;
    -- Delete MANUAL 1 colom ini & add lagi dengan systax di bawah
    ALTER TABLE pg_counter ADD COLUMN id_counter SERIAL PRIMARY KEY;
    Set MANUAL COLUMN id  as UNIQUE;

    create table pg_counter_live as (select * from counter0) with no data;
    ALTER TABLE pg_counter_live ADD COLUMN id_counter SERIAL PRIMARY KEY;
    Set MANUAL COLUMN id  as UNIQUE;

    create table pg_counter_trans as (select * from pg_counter) with no data;
    -- Delete MANUAL id_counter 
    ALTER TABLE pg_counter_trans ADD COLUMN id_counter SERIAL PRIMARY KEY;
    // Update PROCEDURE public.InsertUpdatePgCounterToPgCounterLive();

    create table pg_counter_min as (select * from pg_counter) with no data;
    -- Delete MANUAL 3 olom ini & add lagi dengan systax di bawah
    ALTER TABLE pg_counter_min ADD COLUMN id_counter SERIAL PRIMARY KEY;
    ALTER TABLE pg_counter_min ADD COLUMN unix_record_id VARCHAR (50) UNIQUE;
    ALTER TABLE pg_counter_min ADD COLUMN date_time_source TIMESTAMP WITHOUT TIME ZONE;
    // Add -> PG_COUNTER_SCH_5MIN
        insert to -> STEP_PgCounterTrans_to_PgCounterMin >
        delete from -> STEP_PgCounterTrans_DelOldRecord_2Hours pg_counter_trans> 2 hours 15 min OLD

    create table pg_counter_hour as (select * from pg_counter) with no data;
    -- Delete MANUAL 3 olom ini & add lagi dengan systax di bawah
    ALTER TABLE pg_counter_hour ADD COLUMN id_counter SERIAL PRIMARY KEY;
    ALTER TABLE pg_counter_hour ADD COLUMN unix_record_id VARCHAR (50) UNIQUE;
    ALTER TABLE pg_counter_hour ADD COLUMN date_time_source TIMESTAMP WITHOUT TIME ZONE;
    // Add -> PG_COUNTER_SCH_5MIN
        insert to -> STEP_PgCounterMin_to_PgCounterHour >

    create table pg_counter_day as (select * from pg_counter) with no data;
    -- Delete MANUAL 3 olom ini & add lagi dengan systax di bawah
    ALTER TABLE pg_counter_day ADD COLUMN id_counter SERIAL PRIMARY KEY;
    ALTER TABLE pg_counter_day ADD COLUMN unix_record_id VARCHAR (50) UNIQUE;
    ALTER TABLE pg_counter_day ADD COLUMN date_time_source TIMESTAMP WITHOUT TIME ZONE;
    // Create Scheduler -> PG_COUNTER_SCH_1HR 
        insert to -> STEP_PgCounterHour_to_PgCounterDay 
        delete from -> STEP DELETE FROM pg_counter_hour> 5 Years OLD => 5 Years / 1825 DAYS ~43.8K Record @1000 ids
					-> STEP DELETE FROM pg_counter_min> 2 Years OLD => 2 Years / 730 DAYS ~70080K Record @1000 ids 15 min


	// Dashboard group,OK 
	create table pg_counter_min_metergroups as (select * from metergroups);
	delete colom id_seg 
		ALTER TABLE pg_counter_min_metergroups ADD COLUMN id_counter SERIAL PRIMARY KEY;
		ALTER TABLE pg_counter_min_metergroups ADD COLUMN unix_record_id VARCHAR (50) UNIQUE;
		insert to -> STEP_PgCounterTrans_to_PgCounterMin > pg_counter_min_metergroups
		// kwh_exp  = Active Energy
		// kwh  	= MD kW
		// watt 	= Avg kW
		// va	 	= Apparent kVA
		// kvah 	= kVAR
		
==============================================
=====================
select t2.metergroupid, t1.date_time, sum(t1.v1) as groupv1, sum(t1.watt) as group_watt, sum(t1.va) as group_va, sum(sqrt(abs( (t1.va*t1.va) - (t1.watt*t1.watt) ))) as group_reactive, 
CONCAT(t2.metergroupid,' ',t1.date_time) as unix_record_id
from pg_counter_min t1 
inner join data_meter t2 on t1.id = t2.id
group by t2.metergroupid, t1.date_time
order by t2.metergroupid, t1.date_time

    -- copy table
    -- The `with no data` here means structure only, no actual rows
    create table pg_counter_transit as (select * from counter01) with no data;
    -- Delete MANUAL 3 olom ini & add lagi dengan systax di bawah
    ALTER TABLE pg_counter_transit ADD COLUMN id_counter SERIAL PRIMARY KEY;
    ALTER TABLE pg_counter_transit ADD COLUMN unix_record_id VARCHAR (50) UNIQUE;
    ALTER TABLE pg_counter_transit ADD COLUMN date_time_source TIMESTAMP WITHOUT TIME ZONE;


    
    INSERT INTO pg_counter (
        date_time, id, kwh_exp, 
        kwh, watt, va, kvah
        )
        VALUES (
        NOW(), 'LT_5_1', trunc(extract('EPOCH' from NOW())/100,1), 
        TRUNC(random()*(1000-900)+600), TRUNC(random()*(900-800)+800), TRUNC(random()*(11000-950)+950), TRUNC(random()*(300-200)+200)  	
        )
        ON CONFLICT (id) DO UPDATE
        SET
        date_time = to_timestamp(floor((extract('EPOCH' from NOW()) / 60 )) * 60),
        kwh_exp = TRUNC(extract('EPOCH' from NOW())/100,1)+12100,
        kwh = TRUNC(random()*(1000-900)+900),
        watt = TRUNC(random()*(900-800)+800),
        va  = TRUNC(random()*(1100-950)+950),
        kvah = TRUNC(random()*(300-200)+200);  
        
        INSERT INTO pg_counter (
        date_time, id, kwh_exp, 
        kwh, watt, va, kvah
        )
        VALUES (
        NOW(), 'LT_5_2', trunc(extract('EPOCH' from NOW())/100,1), 
        TRUNC(random()*(1000-900)+600), TRUNC(random()*(900-800)+800), TRUNC(random()*(11000-950)+950), TRUNC(random()*(300-200)+200)  	
        )
        ON CONFLICT (id) DO UPDATE
        SET
        date_time = to_timestamp(floor((extract('EPOCH' from NOW()) / 60 )) * 60),
        kwh_exp = TRUNC(extract('EPOCH' from NOW())/100,1)+5421,
        kwh = TRUNC(random()*(1000-900)+900),
        watt = TRUNC(random()*(900-800)+800),
        va  = TRUNC(random()*(1100-950)+950),
        kvah = TRUNC(random()*(300-200)+200);  
        
        INSERT INTO pg_counter (
        date_time, id, kwh_exp, 
        kwh, watt, va, kvah
        )
        VALUES (
        NOW(), 'LT_5_3', trunc(extract('EPOCH' from NOW())/100,1), 
        TRUNC(random()*(1000-900)+900), TRUNC(random()*(900-800)+800), TRUNC(random()*(11000-950)+950), TRUNC(random()*(300-200)+200)  	
        )
        ON CONFLICT (id) DO UPDATE
        SET
        date_time = to_timestamp(floor((extract('EPOCH' from NOW()) / 60 )) * 60),
        kwh_exp = TRUNC(extract('EPOCH' from NOW())/100,1)+121,
        kwh = TRUNC(random()*(1000-900)+900),
        watt = TRUNC(random()*(900-800)+800),
        va  = TRUNC(random()*(1100-950)+950),
        kvah = TRUNC(random()*(300-200)+200);  
        INSERT INTO pg_counter (
        date_time, id, kwh_exp, 
        kwh, watt, va, kvah
        )
        VALUES (
        NOW(), 'LT_5_4', trunc(extract('EPOCH' from NOW())/100,1), 
        TRUNC(random()*(1000-900)+600), TRUNC(random()*(900-800)+800), TRUNC(random()*(11000-950)+950), TRUNC(random()*(300-200)+200)  	
        )
        ON CONFLICT (id) DO UPDATE
        SET
        date_time = to_timestamp(floor((extract('EPOCH' from NOW()) / 60 )) * 60),
        kwh_exp = TRUNC(extract('EPOCH' from NOW())/100,1)+1241,
        kwh = TRUNC(random()*(1000-900)+900),
        watt = TRUNC(random()*(900-800)+800),
        va  = TRUNC(random()*(1100-950)+950),
        kvah = TRUNC(random()*(300-200)+200);  
        
        
        


</tr>

<tr>
    ////////////000000000000000//////////
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
        SELECT
        date_time, id, type, com, modbus, status,
        AVG(v1) as v1,
        AVG(v2) as v2,
        AVG(v3) as v3,
        AVG(v12) as v12,
        AVG(v23) as v23,
        AVG(v31) as v31,
        AVG(i1) as i1,
        AVG(i2) as i2,
        AVG(i3) as i3,
        AVG(inet) as inet,
        AVG(watt1) as watt1,
        AVG(watt2) as watt2,
        AVG(watt3) as watt3,
        AVG(watt) as watt,
        AVG(va1) as va1,
        AVG(va2) as va2,
        AVG(va3) as va3,
        AVG(va) as va,
        AVG(freq) as freq,
        AVG(pf1) as pf1,
        AVG(pf2) as pf2,
        AVG(pf3) as pf3,
        AVG(kwh_exp) as kwh_exp,
        AVG(kwh_imp) as kwh_imp,
        AVG(kvarh_exp) as kvarh_exp,
        AVG(kvarh_imp) as kvarh_imp,
        AVG(kvah) as kvah,
        AVG(thd_v1) as thd_v1,
        AVG(thd_v2) as thd_v2,
        AVG(thd_v3) as thd_v3,
        AVG(thd_i1) as thd_i1,
        AVG(thd_i2) as thd_i2,
        AVG(thd_i3) as thd_i3,
        AVG(kwh1) as kwh1,
        AVG(kwh2) as kwh2,
        AVG(kwh) as kwh
        FROM
        pg_counter
        -- WHERE
        -- extract('EPOCH' from NOW()) + 25200 - extract('EPOCH' from date_time) < (43200+1800+1800) --12 JAM 30 MENIT
        GROUP BY   
        date_time, id, type, com, modbus, status
        ON CONFLICT(id) DO UPDATE
        SET
        date_time = EXCLUDED.date_time,
        type = EXCLUDED.type,
        com = EXCLUDED.com,
        modbus = EXCLUDED.modbus,
        status = EXCLUDED.status,
        v1 = EXCLUDED.v1,
        v2 = EXCLUDED.v2,
        v3 = EXCLUDED.v3,
        v12 = EXCLUDED.v12,
        v23 = EXCLUDED.v23,
        v31 = EXCLUDED.v31,
        i1 = EXCLUDED.i1,
        i2 = EXCLUDED.i2,
        i3 = EXCLUDED.i3,
        inet = EXCLUDED.inet,
        watt1 = EXCLUDED.watt1,
        watt2 = EXCLUDED.watt2,
        watt3 = EXCLUDED.watt3,
        watt = EXCLUDED.watt,
        va1 = EXCLUDED.va1,
        va2 = EXCLUDED.va2,
        va3 = EXCLUDED.va3,
        va = EXCLUDED.va,
        freq = EXCLUDED.freq,
        pf1 = EXCLUDED.pf1,
        pf2 = EXCLUDED.pf2,
        pf3 = EXCLUDED.pf3,
        kwh_exp = EXCLUDED.kwh_exp,
        kwh_imp = EXCLUDED.kwh_imp,
        kvarh_exp = EXCLUDED.kvarh_exp,
        kvarh_imp = EXCLUDED.kvarh_imp,
        kvah = EXCLUDED.kvah,
        thd_v1 = EXCLUDED.thd_v1,
        thd_v2 = EXCLUDED.thd_v2,
        thd_v3 = EXCLUDED.thd_v3,
        thd_i1 = EXCLUDED.thd_i1,
        thd_i2 = EXCLUDED.thd_i2,
        thd_i3 = EXCLUDED.thd_i3,
        kwh1 = EXCLUDED.kwh1,
        kwh2 = EXCLUDED.kwh2,
        kwh = EXCLUDED.kwh

    ////////////000000000000000//////////

    ////Contoh mysql update if found or insert
        BEGIN
        IF (SELECT count(*) FROM mas_dbems_v6.counter_live WHERE id=NEW.id) > 0
            THEN
                UPDATE mas_dbems_v6.counter_live
                SET  
                `date_time`= NEW.date_time, `type`= NEW.type, `com`= NEW.com, `modbus`= NEW.modbus, `status`= NEW.status, 
                `v1`= NEW.v1, `v2`= NEW.v2, `v3`= NEW.v3, `v12`= NEW.v12, `v23`= NEW.v23, `v31`= NEW.v31,
                `i1`= NEW.i1, `i2`= NEW.i2, `i3`= NEW.i3, `inet`= NEW.inet,
                `watt1`= NEW.watt1, `watt2`= NEW.watt2, `watt3`= NEW.watt3, `watt`= NEW.watt,
                `va1`= NEW.va1, `va2`= NEW.va2, `va3`= NEW.va3, `va`= NEW.va, `freq`= NEW.freq,
                `pf1`= NEW.pf1, `pf2`= NEW.pf2, `pf3`= NEW.pf3,
                `kwh_exp`= NEW.kwh_exp, `kwh_imp`= NEW.kwh_imp, `kvarh_exp`= NEW.kvarh_exp, `kvarh_imp`= NEW.kvarh_imp, `kvah`= NEW.kvah,
                `thd_v1`= NEW.thd_v1, `thd_v2`= NEW.thd_v2, `thd_v3`= NEW.thd_v3, `thd_i1`= NEW.thd_i1, `thd_i2`= NEW.thd_i2, `thd_i3`= NEW.thd_i3,
                `kwh1`= NEW.kwh1, `kwh2`= NEW.kwh2, `kwh`= NEW.kwh WHERE id=NEW.id;
            ELSE
                INSERT INTO mas_dbems_v6.counter_live
                (
                `id_counter`, `date_time`, `id`, `type`, `com`, `modbus`, `status`, 
                `v1`, `v2`, `v3`, `v12`, `v23`, `v31`,
                `i1`, `i2`, `i3`, `inet`,
                `watt1`, `watt2`, `watt3`, `watt`,
                `va1`, `va2`, `va3`, `va`, `freq`,
                `pf1`, `pf2`, `pf3`,
                `kwh_exp`, `kwh_imp`, `kvarh_exp`, `kvarh_imp`, `kvah`,
                `thd_v1`, `thd_v2`, `thd_v3`, `thd_i1`, `thd_i2`, `thd_i3`,
                `kwh1`, `kwh2`, `kwh`
                )
                VALUES
                (
                NEW.modbus, NEW.date_time, NEW.id, NEW.type, NEW.com, NEW.modbus, NEW.status, 
                NEW.v1, NEW.v2, NEW.v3, NEW.v12, NEW.v23, NEW.v31,
                NEW.i1, NEW.i2, NEW.i3, NEW.inet,
                NEW.watt1, NEW.watt2, NEW.watt3, NEW.watt,
                NEW.va1, NEW.va2, NEW.va3, NEW.va, NEW.freq,
                NEW.pf1, NEW.pf2, NEW.pf3,
                NEW.kwh_exp, NEW.kwh_imp, NEW.kvarh_exp, NEW.kvarh_imp, NEW.kvah,
                NEW.thd_v1, NEW.thd_v2, NEW.thd_v3, NEW.thd_i1, NEW.thd_i2, NEW.thd_i3,
                NEW.kwh1, NEW.kwh2, NEW.kwh
                );
        END IF;
        END
    ////Contoh mysql update if found or insert
</tr>

<p1>

    UPDATE pg_counter
    SET
    date_time = to_timestamp(floor((extract('EPOCH' from NOW()) / 60 )) * 60),
    kwh_exp = TRUNC(extract('EPOCH' from NOW())/100,1)+12100,
    kwh = TRUNC(random()*(1000-900)+900),
    watt = TRUNC(random()*(900-800)+800),
    va  = TRUNC(random()*(1100-950)+950),
    kvah = TRUNC(random()*(300-200)+200);  

    UPDATE pg_counter
    SET
    date_time = to_timestamp(floor((extract('EPOCH' from NOW()) / 60 )) * 60),
    kwh_exp = TRUNC(extract('EPOCH' from NOW())/100,1)+5421,
    kwh = TRUNC(random()*(1000-900)+900),
    watt = TRUNC(random()*(900-800)+800),
    va  = TRUNC(random()*(1100-950)+950),
    kvah = TRUNC(random()*(300-200)+200);  

    UPDATE pg_counter
    SET
    date_time = to_timestamp(floor((extract('EPOCH' from NOW()) / 60 )) * 60),
    kwh_exp = TRUNC(extract('EPOCH' from NOW())/100,1)+121,
    kwh = TRUNC(random()*(1000-900)+900),
    watt = TRUNC(random()*(900-800)+800),
    va  = TRUNC(random()*(1100-950)+950),
    kvah = TRUNC(random()*(300-200)+200);  

    UPDATE pg_counter
    SET
    date_time = to_timestamp(floor((extract('EPOCH' from NOW()) / 60 )) * 60),
    kwh_exp = TRUNC(extract('EPOCH' from NOW())/100,1)+1241,
    kwh = TRUNC(random()*(1000-900)+900),
    watt = TRUNC(random()*(900-800)+800),
    va  = TRUNC(random()*(1100-950)+950),
    kvah = TRUNC(random()*(300-200)+200);  


</p1>










<tr okokoko>
    INSERT INTO counter01
    (
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
    select
    to_timestamp(floor((extract('EPOCH' from date_time) / 300 )) * 300) AT TIME ZONE 'UTC' as date_time_stamp,
    CONCAT(to_timestamp(floor((extract('EPOCH' from date_time) / 300 )) * 300) AT TIME ZONE 'UTC',' ', id) as unix_record_id,
    MIN(date_time) as date_time, id, type, com, modbus, status,
    AVG(v1) as v1,
    AVG(v2) as v2,
    AVG(v3) as v3,
    AVG(v12) as v12,
    AVG(v23) as v23,
    AVG(v31) as v31,
    AVG(i1) as i1,
    AVG(i2) as i2,
    AVG(i3) as i3,
    AVG(inet) as inet,
    AVG(watt1) as watt1,
    AVG(watt2) as watt2,
    AVG(watt3) as watt3,
    AVG(watt) as watt,
    AVG(va1) as va1,
    AVG(va2) as va2,
    AVG(va3) as va3,
    AVG(va) as va,
    AVG(freq) as freq,
    AVG(pf1) as pf1,
    AVG(pf2) as pf2,
    AVG(pf3) as pf3,
    AVG(kwh_exp) as kwh_exp,
    AVG(kwh_imp) as kwh_imp,
    AVG(kvarh_exp) as kvarh_exp,
    AVG(kvarh_imp) as kvarh_imp,
    AVG(kvah) as kvah,
    AVG(thd_v1) as thd_v1,
    AVG(thd_v2) as thd_v2,
    AVG(thd_v3) as thd_v3,
    AVG(thd_i1) as thd_i1,
    AVG(thd_i2) as thd_i2,
    AVG(thd_i3) as thd_i3,
    AVG(kwh1) as kwh1,
    AVG(kwh2) as kwh2,
    AVG(kwh) as kwh
    from
    counter0
    where id = 'LT_5_1' AND date_time > '2021-12-09 12:00:00'
    group by
    date_time_stamp, id, type, com, modbus, status
    order by date_time desc
    ON CONFLICT (unix_record_id) DO NOTHING
</tr>

<tr OK>
  select
    to_timestamp(floor((extract('EPOCH' from date_time) / 300 )) * 300) AT TIME ZONE 'UTC' as date_time_stamp,
    CONCAT(to_timestamp(floor((extract('EPOCH' from date_time) / 300 )) * 300) AT TIME ZONE 'UTC',' ', id) as unix_record_id,
    MIN(date_time) as date_time, id, type, com, modbus, status,
    AVG(v1) as v1,
    AVG(v2) as v2,
    AVG(v3) as v3,
    AVG(v12) as v12,
    AVG(v23) as v23,
    AVG(v31) as v31,
    AVG(i1) as i1,
    AVG(i2) as i2,
    AVG(i3) as i3,
    AVG(inet) as inet,
    AVG(watt1) as watt1,
    AVG(watt2) as watt2,
    AVG(watt3) as watt3,
    AVG(watt) as watt,
    AVG(va1) as va1,
    AVG(va2) as va2,
    AVG(va3) as va3,
    AVG(va) as va,
    AVG(freq) as freq,
    AVG(pf1) as pf1,
    AVG(pf2) as pf2,
    AVG(pf3) as pf3,
    AVG(kwh_exp) as kwh_exp,
    AVG(kwh_imp) as kwh_imp,
    AVG(kvarh_exp) as kvarh_exp,
    AVG(kvarh_imp) as kvarh_imp,
    AVG(kvah) as kvah,
    AVG(thd_v1) as thd_v1,
    AVG(thd_v2) as thd_v2,
    AVG(thd_v3) as thd_v3,
    AVG(thd_i1) as thd_i1,
    AVG(thd_i2) as thd_i2,
    AVG(thd_i3) as thd_i3,
    AVG(kwh1) as kwh1,
    AVG(kwh2) as kwh2,
    AVG(kwh) as kwh
    FROM
    pg_counter
    WHERE
    extract('EPOCH' from NOW()) + 25200 - extract('EPOCH' from date_time) < (43200+1800+1800) --12 JAM 30 MENIT // 2021-12-09 19:00:00
	GROUP BY   
	date_time_stamp, id, type, com, modbus, status
</tr>

<tr>
    select
    to_timestamp(floor((extract('epoch' from date_time) / 300 )) * 300) AT TIME ZONE 'UTC' as date_time_stamp,
    concat(to_timestamp(floor((extract('epoch' from date_time) / 300 )) * 300) AT TIME ZONE 'UTC',' ', id) as unix_record_id,
    MIN(date_time) as date_time, id, type, com, modbus, status,
    AVG(v1) as v1,
    AVG(v2) as v2,
    AVG(v3) as v3,
    AVG(v12) as v12,
    AVG(v23) as v23,
    AVG(v31) as v31,
    AVG(i1) as i1,
    AVG(i2) as i2,
    AVG(i3) as i3,
    AVG(inet) as inet,
    AVG(watt1) as watt1,
    AVG(watt2) as watt2,
    AVG(watt3) as watt3,
    AVG(watt) as watt,
    AVG(va1) as va1,
    AVG(va2) as va2,
    AVG(va3) as va3,
    AVG(va) as va,
    AVG(freq) as freq,
    AVG(pf1) as pf1,
    AVG(pf2) as pf2,
    AVG(pf3) as pf3,
    AVG(kwh_exp) as kwh_exp,
    AVG(kwh_imp) as kwh_imp,
    AVG(kvarh_exp) as kvarh_exp,
    AVG(kvarh_imp) as kvarh_imp,
    AVG(kvah) as kvah,
    AVG(thd_v1) as thd_v1,
    AVG(thd_v2) as thd_v2,
    AVG(thd_v3) as thd_v3,
    AVG(thd_i1) as thd_i1,
    AVG(thd_i2) as thd_i2,
    AVG(thd_i3) as thd_i3,
    AVG(kwh1) as kwh1,
    AVG(kwh2) as kwh2,
    AVG(kwh) as kwh
    from
    counter0
    where id = 'LT_5_1' AND date_time > '2021-12-09 10:00:00'
    group by
    date_time_stamp, id, type, com, modbus, status
    order by date_time desc
</tr>