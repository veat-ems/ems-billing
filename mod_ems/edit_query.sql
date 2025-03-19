https://hevodata.com/learn/postgres-export-to-csv/


-- //////////////////////////////

    DELETE FROM pg_counter_hour WHERE
        (date_time_source) < (NOW() - '1825 DAYS'::interval); --5 Years ago

    DELETE FROM pg_counter_min WHERE    
        (date_time_source) < (NOW() - '720 DAYS'::interval); --2 Years ago

DELETE FROM pg_counter_trans WHERE
        extract('EPOCH' from NOW()) + 25200 - extract('EPOCH' from date_time) > (3600+3600+900)--1jam 1jam 15min
 

 grp

 -- "STEP_PgCounterTrans_DelOldRecord_2Hours";
    DELETE FROM pg_counter_trans WHERE
    date_time < (NOW() - '12 HOURS'::interval) --2 HOURS before
-- extract('EPOCH' from NOW()) + 25200 - extract('EPOCH' from date_time) > ((3600*10)+900)--1jam 1jam 15min

-- "STEP_PgCounterMin_n_Hour_DelOldRecord_5_2_Years";
    DELETE FROM 
        pg_counter_hour 
    WHERE 
        (date_time_source) < (NOW() - '1825 DAYS' :: interval);  --5 Years ago
        
    DELETE FROM 
        pg_counter_min 
    WHERE 
        (date_time_source) < (NOW() - '720 DAYS' :: interval);   --2 Years ago



        SELECT * FROM pg_counter_live ORDER BY v1

SELECT * FROM pg_counter ORDER BY date_time desc

SELECT * FROM data_meter ORDER BY id, date_time
SELECT * FROM data_meter WHERE ID NOT IN ('COM11_2')
SELECT * FROM data_meter WHERE ID NOT IN (SELECT ID FROM pg_counter_live) -- mETER TIDAK UPDATE / TIMEOUT
SELECT * FROM pg_counter WHERE pg_counter.id NOT IN (SELECT ID FROM pg_counter_live) -- mETER TIDAK UPDATE / TIMEOUT
--TOTAL 92
--COM12_4
--COM19_3
--COM28_2
DELETE FROM pg_counter_trans WHERE (id NOT LIKE 'COM%' OR v1 IS NULL OR i1 IS NULL OR thd_v1 IS NULL OR kwh_exp IS NULL) 
SELECT * FROM pg_counter_trans WHERE (id NOT LIKE 'COM%' OR v1 IS NULL OR i1 IS NULL OR thd_v1 IS NULL OR kwh_exp IS NULL) 
AND type LIKE 'PM710%'
		
DELETE FROM pg_counter WHERE id NOT LIKE 'COM%'
DELETE FROM pg_counter_live WHERE id NOT LIKE 'COM%'
SELECT * FROM pg_counter_trans WHERE id NOT LIKE 'COM%'
SELECT * FROM pg_counter_min WHERE id NOT LIKE 'COM%'
SELECT * FROM pg_counter_hour WHERE id NOT LIKE 'COM%'
SELECT * FROM pg_counter_day WHERE id NOT LIKE 'COM%'









==========ADIS===================
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
    
















==========ALAMR==========





