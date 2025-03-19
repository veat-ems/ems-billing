SOHO_EVERY_1_DAY
SOHO_EVERY_1_HOUR
SOHO_EVERY_1_MONTH
SOHO_EVERY_5_MIN

------------------------------

DO $$
DECLARE
    jid integer;
    scid integer;
BEGIN
-- Creating a new job
INSERT INTO pgagent.pga_job(
    jobjclid, jobname, jobdesc, jobhostagent, jobenabled
) VALUES (
    1::integer, 'SOHO_EVERY_1_DAY'::text, ''::text, ''::text, true
) RETURNING jobid INTO jid;

-- Steps
-- Inserting a step (jobid: NULL)
INSERT INTO pgagent.pga_jobstep (
    jstjobid, jstname, jstenabled, jstkind,
    jstconnstr, jstdbname, jstonerror,
    jstcode, jstdesc
) VALUES (
    jid, 'st_1day'::text, true, 's'::character(1),
    ''::text, 'dbemspg_soho'::name, 'f'::character(1),
    'CALL maintenance_data_daily();'::text, ''::text
) ;

-- Schedules
-- Inserting a schedule
INSERT INTO pgagent.pga_schedule(
    jscjobid, jscname, jscdesc, jscenabled,
    jscstart, jscend,    jscminutes, jschours, jscweekdays, jscmonthdays, jscmonths
) VALUES (
    jid, 'CALL_maintenance_data_daily'::text, ''::text, true,
    '2022-04-05 22:51:00+07'::timestamp with time zone, '2100-01-01 02:09:00+07'::timestamp with time zone,
    -- Minutes
    ARRAY[false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,true,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false]::boolean[],
    -- Hours
    ARRAY[true,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false]::boolean[],
    -- Week days
    ARRAY[true,true,true,true,true,true,true]::boolean[],
    -- Month days
    ARRAY[false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false]::boolean[],
    -- Months
    ARRAY[false,false,false,false,false,false,false,false,false,false,false,false]::boolean[]
) RETURNING jscid INTO scid;
END
$$;


DO $$
DECLARE
    jid integer;
    scid integer;
BEGIN
-- Creating a new job
INSERT INTO pgagent.pga_job(
    jobjclid, jobname, jobdesc, jobhostagent, jobenabled
) VALUES (
    1::integer, 'SOHO_EVERY_1_HOUR'::text, ''::text, ''::text, true
) RETURNING jobid INTO jid;

-- Steps
-- Inserting a step (jobid: NULL)
INSERT INTO pgagent.pga_jobstep (
    jstjobid, jstname, jstenabled, jstkind,
    jstconnstr, jstdbname, jstonerror,
    jstcode, jstdesc
) VALUES (
    jid, 'CALL_copy_pgcounterhour_to_pgcounterday'::text, true, 's'::character(1),
    ''::text, 'dbemspg_soho'::name, 'f'::character(1),
    'CALL copy_pgcounterhour_to_pgcounterday();

'::text, ''::text
) ;-- Inserting a step (jobid: NULL)
INSERT INTO pgagent.pga_jobstep (
    jstjobid, jstname, jstenabled, jstkind,
    jstconnstr, jstdbname, jstonerror,
    jstcode, jstdesc
) VALUES (
    jid, 'CALL_maintenance_data_hourly'::text, true, 's'::character(1),
    ''::text, 'dbemspg_soho'::name, 'f'::character(1),
    'CALL maintenance_data_hourly();'::text, ''::text
) ;

-- Schedules
-- Inserting a schedule
INSERT INTO pgagent.pga_schedule(
    jscjobid, jscname, jscdesc, jscenabled,
    jscstart, jscend,    jscminutes, jschours, jscweekdays, jscmonthdays, jscmonths
) VALUES (
    jid, 'st_1hour'::text, ''::text, true,
    '2022-03-24 17:23:00+07'::timestamp with time zone, '2100-01-01 00:30:00+07'::timestamp with time zone,
    -- Minutes
    ARRAY[false,false,false,false,false,true,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false]::boolean[],
    -- Hours
    ARRAY[true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true]::boolean[],
    -- Week days
    ARRAY[false,false,false,false,false,false,false]::boolean[],
    -- Month days
    ARRAY[false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false]::boolean[],
    -- Months
    ARRAY[false,false,false,false,false,false,false,false,false,false,false,false]::boolean[]
) RETURNING jscid INTO scid;
END
$$;


DO $$
DECLARE
    jid integer;
    scid integer;
BEGIN
-- Creating a new job
INSERT INTO pgagent.pga_job(
    jobjclid, jobname, jobdesc, jobhostagent, jobenabled
) VALUES (
    1::integer, 'SOHO_EVERY_1_MONTH'::text, ''::text, ''::text, true
) RETURNING jobid INTO jid;

-- Steps
-- Inserting a step (jobid: NULL)
INSERT INTO pgagent.pga_jobstep (
    jstjobid, jstname, jstenabled, jstkind,
    jstconnstr, jstdbname, jstonerror,
    jstcode, jstdesc
) VALUES (
    jid, 'CALL_backup_data'::text, true, 's'::character(1),
    ''::text, 'dbemspg_soho'::name, 'f'::character(1),
    'SELECT backup_data(''pg_counter_min'', ''C:\BACKUP_DB\'',''BACKUP_PG_COUNTER_MIN'');'::text, ''::text
) ;

-- Schedules
-- Inserting a schedule
INSERT INTO pgagent.pga_schedule(
    jscjobid, jscname, jscdesc, jscenabled,
    jscstart, jscend,    jscminutes, jschours, jscweekdays, jscmonthdays, jscmonths
) VALUES (
    jid, 'st_1month'::text, ''::text, true,
    '2022-04-04 22:48:00+07'::timestamp with time zone, '2100-01-01 02:22:00+07'::timestamp with time zone,
    -- Minutes
    ARRAY[true,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false]::boolean[],
    -- Hours
    ARRAY[false,true,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false]::boolean[],
    -- Week days
    ARRAY[false,false,false,false,false,false,false]::boolean[],
    -- Month days
    ARRAY[false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false]::boolean[],
    -- Months
    ARRAY[true,true,true,true,true,true,true,true,true,true,true,true]::boolean[]
) RETURNING jscid INTO scid;
END
$$;


DO $$
DECLARE
    jid integer;
    scid integer;
BEGIN
-- Creating a new job
INSERT INTO pgagent.pga_job(
    jobjclid, jobname, jobdesc, jobhostagent, jobenabled
) VALUES (
    1::integer, 'SOHO_EVERY_5_MIN'::text, ''::text, ''::text, true
) RETURNING jobid INTO jid;

-- Steps
-- Inserting a step (jobid: NULL)
INSERT INTO pgagent.pga_jobstep (
    jstjobid, jstname, jstenabled, jstkind,
    jstconnstr, jstdbname, jstonerror,
    jstcode, jstdesc
) VALUES (
    jid, 'CALL_copy_pgcountermin_to_pgcounterhour'::text, true, 's'::character(1),
    ''::text, 'dbemspg_soho'::name, 'f'::character(1),
    'CALL copy_pgcountermin_to_pgcounterhour();
'::text, ''::text
) ;-- Inserting a step (jobid: NULL)
INSERT INTO pgagent.pga_jobstep (
    jstjobid, jstname, jstenabled, jstkind,
    jstconnstr, jstdbname, jstonerror,
    jstcode, jstdesc
) VALUES (
    jid, 'CALL_copy_pgcountertrans_to_pgcountermin'::text, true, 's'::character(1),
    ''::text, 'dbemspg_soho'::name, 'f'::character(1),
    'CALL copy_pgcountertrans_to_pgcountermin();
-- copy_PgCounterMin_Calc_to_PgCounterMinMeterGroups;
'::text, ''::text
) ;-- Inserting a step (jobid: NULL)
INSERT INTO pgagent.pga_jobstep (
    jstjobid, jstname, jstenabled, jstkind,
    jstconnstr, jstdbname, jstonerror,
    jstcode, jstdesc
) VALUES (
    jid, 'CALL_proc_pg_alarm_t'::text, true, 's'::character(1),
    ''::text, 'dbemspg_soho'::name, 'f'::character(1),
    'CALL proc_pg_alarm_t();'::text, ''::text
) ;

-- Schedules
-- Inserting a schedule
INSERT INTO pgagent.pga_schedule(
    jscjobid, jscname, jscdesc, jscenabled,
    jscstart, jscend,    jscminutes, jschours, jscweekdays, jscmonthdays, jscmonths
) VALUES (
    jid, 'st_5min'::text, ''::text, true,
    '2022-03-23 21:42:00+07'::timestamp with time zone, '2100-01-01 00:00:00+07'::timestamp with time zone,
    -- Minutes
    ARRAY[false,false,true,false,false,false,false,true,false,false,false,false,true,false,false,false,false,true,false,false,false,false,true,false,false,false,false,true,false,false,false,false,true,false,false,false,false,true,false,false,false,false,true,false,false,false,false,true,false,false,false,false,true,false,false,false,false,true,false,false]::boolean[],
    -- Hours
    ARRAY[true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true]::boolean[],
    -- Week days
    ARRAY[false,false,false,false,false,false,false]::boolean[],
    -- Month days
    ARRAY[false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false]::boolean[],
    -- Months
    ARRAY[false,false,false,false,false,false,false,false,false,false,false,false]::boolean[]
) RETURNING jscid INTO scid;
END
$$;