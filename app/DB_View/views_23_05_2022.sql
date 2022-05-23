/* view_receive_masters_from */
CREATE VIEW view_receive_masters_from AS
SELECT receive_masters.id, IF(receive_masters.receive_type = 'r', CONCAT("f","-",receive_masters.receive_from), CONCAT("l","-",receive_masters.receive_from)) AS receive_from
FROM receive_masters
/* view_receive_masters_from */

/* view_receive_masters */
CREATE VIEW view_receive_masters AS
SELECT receive_masters.id, receive_masters.receive_type, receive_masters.receive_date, receive_masters.reference_no,
receive_masters.receive_from, receive_masters.location_id, receive_masters.status, receive_masters.remarks,
receive_froms.receive_from_name, receive_froms.receive_from_short_name,
locations.name AS stock_location, stock_thresholds.color_code,
receive_masters.created_at, receive_masters.updated_at, DATEDIFF(CURDATE(), receive_masters.receive_date) AS age
FROM receive_masters
JOIN view_receive_masters_from ON view_receive_masters_from.id = receive_masters.id
JOIN receive_froms ON receive_froms.id = view_receive_masters_from.receive_from
LEFT JOIN stock_thresholds ON (stock_thresholds.min_day <= DATEDIFF(CURDATE(), receive_masters.receive_date)
AND stock_thresholds.max_day >= DATEDIFF(CURDATE(), receive_masters.receive_date))
JOIN locations ON locations.id = receive_masters.location_id
ORDER BY receive_masters.receive_date DESC
/* view_receive_masters */



/* view_rm_update_access */
CREATE VIEW view_rm_update_access AS
SELECT DISTINCT receive_master_id, FALSE AS update_access
FROM receive_details
WHERE receive_details.status = 'QCI' OR receive_details.status = 'QCF'
ORDER BY receive_master_id
/* view_rm_update_access */


