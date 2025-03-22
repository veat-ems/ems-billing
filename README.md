# ems-billing

CREATE OR REPLACE FUNCTION notify_sensor_data()
RETURNS TRIGGER AS $$
BEGIN
    PERFORM pg_notify('sensor_update', row_to_json(NEW)::text);
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER sensor_data_trigger
AFTER INSERT OR UPDATE ON pg_counter_live
FOR EACH ROW EXECUTE FUNCTION notify_sensor_data();
