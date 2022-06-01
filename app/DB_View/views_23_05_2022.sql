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
locations.name AS stock_location, stock_thresholds.color_code, stock_thresholds.stock_threshold_status,
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

/* view_rm_update_access */
CREATE VIEW view_current_stock AS
SELECT receive_masters.id AS receive_master_id, receive_masters.receive_date,
locations.short_name AS location_short_name, stocks.receive_detail_id,
buyers.name AS buyer_name, buyer_styles.style_no,
garments_types.name AS garments_type, units.short_unit,
stocks.received_total_quantity,
stocks.grade_a, stocks.grade_b, stocks.grade_c, stocks.grade_d, stocks.grade_t,
stocks.issued_grade_a, stocks.issued_grade_b, stocks.issued_grade_c, stocks.issued_grade_d, stocks.issued_grade_t,
stocks.issued_total_quantity,
(stocks.grade_a - stocks.issued_grade_a) AS current_grade_a,
(stocks.grade_b - stocks.issued_grade_b) AS current_grade_b,
(stocks.grade_c - stocks.issued_grade_c) AS current_grade_c,
(stocks.grade_d - stocks.issued_grade_d) AS current_grade_d,
(stocks.grade_t - stocks.issued_grade_t) AS current_grade_t,
(stocks.received_total_quantity - stocks.issued_total_quantity) AS total_current_stock,
stocks.status AS stock_status, stocks.location_id,
DATEDIFF(CURDATE(), receive_masters.receive_date) AS age,  stock_thresholds.color_code, stock_thresholds.stock_threshold_status
FROM stocks
INNER JOIN receive_details ON (receive_details.counter = stocks.receive_detail_id AND receive_details.receive_master_id = stocks.receive_master_id)
INNER JOIN receive_masters ON receive_masters.id = stocks.receive_master_id
INNER JOIN locations ON locations.id = stocks.location_id
INNER JOIN buyers ON buyers.id = receive_details.buyer_id
INNER JOIN units ON units.id = receive_details.unit_id
INNER JOIN buyer_styles ON buyer_styles.id = receive_details.buyer_style_id
INNER JOIN garments_types ON garments_types.id = receive_details.garments_type_id
LEFT JOIN stock_thresholds ON (stock_thresholds.min_day <= DATEDIFF(CURDATE(), receive_masters.receive_date)
AND stock_thresholds.max_day >= DATEDIFF(CURDATE(), receive_masters.receive_date))
ORDER BY stocks.receive_date, receive_masters.id, receive_details.counter
/* view_rm_update_access */

/* view_issue_details_from */
CREATE VIEW view_issue_details_to AS
SELECT issue_details.id, IF(issue_details.issue_type = 'v', CONCAT("v","-",issue_details.issued_to), CONCAT("l","-",issue_details.issued_to)) AS issued_to,
DATEDIFF(CURDATE(), issue_details.issue_date) AS age
FROM issue_details
/* view_issue_details_from */


