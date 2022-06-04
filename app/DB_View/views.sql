/*start receive_froms_view*/
CREATE VIEW receive_froms AS
SELECT CONCAT("f","-",id) AS id, CONCAT(factory_name, " - ", IFNULL(unit_name, " ")) AS receive_from_name,  CONCAT(factory_short_name, " - ", IFNULL(unit_short_name, " ")) AS receive_from_short_name
FROM factories
WHERE STATUS <> 'D'
UNION
SELECT CONCAT("l","-",id) AS id, NAME AS receive_from_name, short_name AS receive_from_short_name
FROM locations
WHERE STATUS <> 'D'

SELECT *FROM receive_froms

/*end receive_froms_view*/

/*start issued_tos_view*/
CREATE VIEW issued_tos AS
SELECT CONCAT("v","-",id) AS id, NAME AS issued_to_name
FROM vendors
WHERE STATUS <> 'D'
UNION
SELECT CONCAT("l","-",id) AS id, NAME AS issued_to_name
FROM locations
WHERE STATUS <> 'D'

SELECT *FROM issued_tos

/*end issued_tos_view*/

/*start vendor_issue_details_view*/
DROP VIEW vendor_issue_details

SELECT *FROM vendor_issue_details

CREATE VIEW vendor_issue_details AS
SELECT *
FROM issue_details
WHERE issue_type = 'v'
/*end vendor_issue_details_view*/

/*start transfer_issue_details_view*/
DROP VIEW transfer_issue_details

SELECT *FROM transfer_issue_details

CREATE VIEW transfer_issue_details AS
SELECT *
FROM issue_details
WHERE issue_type = 't'
/*end transfer_issue_details_view*/

/*start view_issue_summary*/
CREATE VIEW view_issue_summary AS
SELECT vendor_issue_details.id, vendor_issue_details.reference_no, vendor_issue_details.issue_date,
       vendor_issue_details.issued_to ,  CONCAT("v","-",vendor_issue_details.issued_to) AS issued_to_v,
       vendor_issue_details.grade_a, vendor_issue_details.grade_b,
       vendor_issue_details.grade_c, vendor_issue_details.grade_d, vendor_issue_details.grade_t,
       units.short_unit,
       receive_masters.receive_from,
       vendor_issue_details.issued_total_quantity,
       locations.name AS location_name,
       buyers.id AS buyer_id, buyers.name AS buyer_name, buyer_styles.style_no,
       garments_types.id AS garments_type_id, garments_types.name AS garments_type,
       vendor_issue_details.issue_type,
       vendor_issue_details.status AS issue_status, vendor_issue_details.location_id
FROM vendor_issue_details
INNER JOIN stocks ON (stocks.receive_detail_id = vendor_issue_details.receive_detail_id AND stocks.receive_master_id =  vendor_issue_details.receive_master_id)
INNER JOIN receive_details ON (receive_details.counter = vendor_issue_details.receive_detail_id AND receive_details.receive_master_id =  vendor_issue_details.receive_master_id)
INNER JOIN receive_masters ON receive_masters.id = stocks.receive_master_id
INNER JOIN locations ON locations.id = vendor_issue_details.location_id
INNER JOIN  buyers ON buyers.id = receive_details.buyer_id
INNER JOIN units ON units.id = receive_details.unit_id
INNER JOIN buyer_styles ON buyer_styles.id = receive_details.buyer_style_id
INNER JOIN garments_types ON garments_types.id = receive_details.garments_type_id
WHERE vendor_issue_details.status  <> 'D'
UNION
SELECT transfer_issue_details.id, transfer_issue_details.reference_no, transfer_issue_details.issue_date,
       transfer_issue_details.issued_to ,  CONCAT("l","-",transfer_issue_details.issued_to) AS issued_to_v,
       transfer_issue_details.grade_a, transfer_issue_details.grade_b,
       transfer_issue_details.grade_c, transfer_issue_details.grade_d, transfer_issue_details.grade_t, units.short_unit,
       receive_masters.receive_from,
       transfer_issue_details.issued_total_quantity,
       locations.name AS location_name,
       buyers.id AS buyer_id, buyers.name AS buyer_name, buyer_styles.style_no,
       garments_types.id AS garments_type_id, garments_types.name AS garments_type,
       transfer_issue_details.issue_type,
       transfer_issue_details.status AS issue_status, transfer_issue_details.location_id
FROM transfer_issue_details
INNER JOIN stocks ON (stocks.receive_detail_id = transfer_issue_details.receive_detail_id AND stocks.receive_master_id =  transfer_issue_details.receive_master_id)
INNER JOIN receive_details ON (receive_details.counter = transfer_issue_details.receive_detail_id AND receive_details.receive_master_id =  transfer_issue_details.receive_master_id)
INNER JOIN receive_masters ON receive_masters.id = stocks.receive_master_id
INNER JOIN locations ON locations.id = transfer_issue_details.location_id
INNER JOIN  buyers ON buyers.id = receive_details.buyer_id
INNER JOIN units ON units.id = receive_details.unit_id
INNER JOIN buyer_styles ON buyer_styles.id = receive_details.buyer_style_id
INNER JOIN garments_types ON garments_types.id = receive_details.garments_type_id
WHERE transfer_issue_details.status  <> 'D'


SELECT *FROM view_issue_summary

DROP VIEW view_issue_summary
/*end view_issue_summary*/

/*start factory_receive_details_view*/
SELECT *FROM factory_receive_details

DROP VIEW factory_receive_details

CREATE VIEW factory_receive_details AS
SELECT receive_masters.id, receive_masters.receive_type, receive_masters.reference_no, receive_masters.receive_from, receive_masters.location_id,
receive_masters.receive_date, receive_masters.status AS receive_master_status,
receive_details.counter, receive_details.buyer_id, receive_details.buyer_style_id, receive_details.garments_type_id, receive_details.unit_id,
receive_details.received_total_quantity,
receive_details.grade_a, receive_details.grade_b, receive_details.grade_c, receive_details.grade_d, receive_details.grade_t,
receive_details.qc_date, receive_details.status AS receive_detail_status
FROM receive_details
INNER JOIN receive_masters ON receive_masters.id = receive_details.receive_master_id
WHERE receive_details.status <> 'D' AND receive_masters.status <> 'D' AND receive_masters.receive_type = 'r'
/*end factory_receive_details_view*/

/*start transfer_receive_details_view*/

DROP VIEW transfer_receive_details

SELECT *FROM transfer_receive_details

CREATE VIEW transfer_receive_details AS
SELECT receive_masters.id, receive_masters.receive_type, receive_masters.reference_no, receive_masters.receive_from, receive_masters.location_id,
receive_masters.receive_date, receive_masters.status AS receive_master_status,
receive_details.counter, receive_details.buyer_id, receive_details.buyer_style_id, receive_details.garments_type_id, receive_details.unit_id,
receive_details.received_total_quantity,
receive_details.grade_a, receive_details.grade_b, receive_details.grade_c, receive_details.grade_d, receive_details.grade_t,
receive_details.qc_date, receive_details.status AS receive_detail_status
FROM receive_details
INNER JOIN receive_masters ON receive_masters.id = receive_details.receive_master_id
WHERE receive_details.status <> 'D' AND receive_masters.status <> 'D' AND receive_masters.receive_type = 't'
/*end transfer_receive_details_view*/

/*start view_receive_summary*/
CREATE VIEW view_receive_summary AS
SELECT factory_receive_details.id, factory_receive_details.counter, factory_receive_details.receive_type, factory_receive_details.reference_no,
factory_receive_details.receive_from, CONCAT("f","-",factory_receive_details.receive_from) AS receive_from_v,
factory_receive_details.receive_date, factory_receive_details.receive_master_status,
factory_receive_details.buyer_id, buyers.name AS buyer_name,
factory_receive_details.buyer_style_id, buyer_styles.style_no,
factory_receive_details.garments_type_id, garments_types.name AS garments_type,
factory_receive_details.location_id, locations.name AS location_name,
units.short_unit,
factory_receive_details.received_total_quantity, factory_receive_details.grade_a, factory_receive_details.grade_b,
factory_receive_details.grade_c, factory_receive_details.grade_d, factory_receive_details.grade_t, factory_receive_details.qc_date, factory_receive_details.receive_detail_status
FROM factory_receive_details
INNER JOIN locations ON locations.id = factory_receive_details.location_id
INNER JOIN buyers ON buyers.id = factory_receive_details.buyer_id
INNER JOIN units ON units.id = factory_receive_details.unit_id
INNER JOIN buyer_styles ON buyer_styles.id = factory_receive_details.buyer_style_id
INNER JOIN garments_types ON garments_types.id = factory_receive_details.garments_type_id
UNION
SELECT transfer_receive_details.id, transfer_receive_details.counter, transfer_receive_details.receive_type, transfer_receive_details.reference_no,
transfer_receive_details.receive_from, CONCAT("l","-",transfer_receive_details.receive_from) AS receive_from_v,
transfer_receive_details.receive_date, transfer_receive_details.receive_master_status,
transfer_receive_details.buyer_id, buyers.name AS buyer_name,
transfer_receive_details.buyer_style_id, buyer_styles.style_no,
transfer_receive_details.garments_type_id, garments_types.name AS garments_type,
transfer_receive_details.location_id, locations.name AS location_name,
units.short_unit,
transfer_receive_details.received_total_quantity, transfer_receive_details.grade_a, transfer_receive_details.grade_b,
transfer_receive_details.grade_c, transfer_receive_details.grade_d, transfer_receive_details.grade_t, transfer_receive_details.qc_date, transfer_receive_details.receive_detail_status
FROM transfer_receive_details
INNER JOIN locations ON locations.id = transfer_receive_details.location_id
INNER JOIN buyers ON buyers.id = transfer_receive_details.buyer_id
INNER JOIN units ON units.id = transfer_receive_details.unit_id
INNER JOIN buyer_styles ON buyer_styles.id = transfer_receive_details.buyer_style_id
INNER JOIN garments_types ON garments_types.id = transfer_receive_details.garments_type_id

DROP VIEW view_receive_summary

SELECT *FROM view_receive_summary

/*end view_receive_summary*/

/*start view_current_stock_summary*/
CREATE VIEW view_current_stock_summary AS
SELECT
receive_masters.id AS receive_master_id, stocks.receive_detail_id,
receive_masters.receive_from, receive_froms.receive_from_short_name,
IF(receive_masters.receive_type = 'r', CONCAT("f","-",receive_masters.receive_from), CONCAT("l","-",receive_masters.receive_from)) AS receive_from_id,
receive_masters.receive_type, receive_masters.reference_no,
buyers.name AS buyer_name, buyers.id AS buyer_id,
buyer_styles.style_no,
units.short_unit,
garments_types.id AS garments_type_id, garments_types.name AS garments_type,
locations.name AS location_name, stocks.location_id,
stocks.receive_date, stocks.received_total_quantity,
stocks.grade_a, stocks.grade_b, stocks.grade_c, stocks.grade_d, stocks.grade_t,
stocks.issued_grade_a, stocks.issued_grade_b, stocks.issued_grade_c, stocks.issued_grade_d, stocks.issued_grade_t,
stocks.issued_total_quantity, DATEDIFF(CURRENT_DATE, stocks.receive_date) AS age, stocks.status
FROM stocks
INNER JOIN receive_masters ON receive_masters.id = stocks.receive_master_id
INNER JOIN receive_details ON
	receive_details.receive_master_id = stocks.receive_master_id
	AND receive_details.counter = stocks.receive_detail_id
	AND receive_details.status <> 'D'
INNER JOIN buyers ON buyers.id = receive_details.buyer_id
INNER JOIN buyer_styles ON buyer_styles.id = receive_details.buyer_style_id
INNER JOIN units ON units.id = stocks.unit_id
INNER JOIN locations ON locations.id = stocks.location_id
INNER JOIN garments_types ON garments_types.id = receive_details.garments_type_id
INNER JOIN receive_froms ON receive_froms.id = IF(receive_masters.receive_type = 'r', CONCAT("f","-",receive_masters.receive_from), CONCAT("l","-",receive_masters.receive_from))
ORDER BY stocks.receive_date, receive_masters.id

DROP VIEW view_current_stock_summary

SELECT *FROM view_current_stock_summary

/*end view_current_stock_summary*/


/*start view_max_counter_rc_image*/
CREATE VIEW view_max_counter_rc_image AS
SELECT MAX(counter)+1 AS max_counter, receive_master_id, receive_detail_id
FROM receive_images
GROUP BY receive_master_id, receive_detail_id
/*end view_max_counter_rc_image*/

/* view_total_issue_summary */
DROP VIEW view_total_issue_summary

CREATE VIEW view_total_issue_summary AS
SELECT receive_master_id, receive_detail_id,
SUM(grade_a) AS grade_a, SUM(grade_b) AS grade_b, SUM(grade_c) AS grade_c, SUM(grade_d) AS grade_d, SUM(grade_t) AS grade_t,
SUM(issued_total_quantity) AS issued_total_quantity
FROM issue_details
WHERE STATUS <> 'D'
GROUP BY receive_master_id, receive_detail_id
/* end view_total_issue_summary */

/* view_total_stock_summary */
CREATE VIEW view_total_stock_summary AS
SELECT receive_masters.id, receive_details.counter,
receive_masters.receive_from, receive_froms.receive_from_short_name,
IF(receive_masters.receive_type = 'r', CONCAT("f","-",receive_masters.receive_from), CONCAT("l","-",receive_masters.receive_from)) AS receive_from_id,
receive_masters.receive_type, receive_masters.reference_no,
buyers.name AS buyer_name, buyers.id AS buyer_id,
buyer_styles.style_no,
units.short_unit,
garments_types.id AS garments_type_id, garments_types.name AS garments_type,
locations.name AS location_name, receive_masters.location_id,
receive_masters.receive_date,
receive_details.received_total_quantity AS received_quantity,
receive_details.grade_a AS receive_grade_a, receive_details.grade_b AS receive_grade_b, receive_details.grade_c AS receive_grade_c,
receive_details.grade_d AS receive_grade_d, receive_details.grade_t AS receive_grade_t,
IFNULL(stocks.received_total_quantity, 0) AS received_total_quantity,
IFNULL(stocks.grade_a, 0) AS grade_a,
IFNULL(stocks.grade_b, 0) AS grade_b,
IFNULL(stocks.grade_c, 0) AS grade_c,
IFNULL(stocks.grade_d, 0) AS grade_d,
IFNULL(stocks.grade_t, 0) AS grade_t,
IFNULL(view_total_issue_summary.grade_a, 0) AS issued_grade_a,
IFNULL(view_total_issue_summary.grade_b, 0) AS issued_grade_b,
IFNULL(view_total_issue_summary.grade_c, 0) AS issued_grade_c,
IFNULL(view_total_issue_summary.grade_d, 0) AS issued_grade_d,
IFNULL(view_total_issue_summary.grade_t, 0) AS issued_grade_t,
IFNULL(view_total_issue_summary.issued_total_quantity, 0) AS issued_total_quantity,
DATEDIFF(CURRENT_DATE, receive_masters.receive_date) AS age,
IFNULL(stocks.status, 'NQCA') AS s_status, receive_details.status AS receive_detail_status
FROM receive_details
INNER JOIN receive_masters ON receive_masters.id = receive_details.receive_master_id
LEFT JOIN stocks ON
		receive_details.counter = stocks.receive_detail_id
		AND receive_details.receive_master_id = stocks.receive_master_id
		AND receive_details.status = 'QCF'
		AND stocks.status <> 'D'
LEFT JOIN view_total_issue_summary ON
		receive_details.counter = view_total_issue_summary.receive_detail_id
		AND receive_details.receive_master_id = view_total_issue_summary.receive_master_id
		AND receive_details.status = 'QCF'
INNER JOIN buyers ON buyers.id = receive_details.buyer_id
INNER JOIN buyer_styles ON buyer_styles.id = receive_details.buyer_style_id
INNER JOIN units ON units.id = receive_details.unit_id
INNER JOIN locations ON locations.id = receive_masters.location_id
INNER JOIN garments_types ON garments_types.id = receive_details.garments_type_id
INNER JOIN receive_froms ON receive_froms.id = IF(receive_masters.receive_type = 'r', CONCAT("f","-",receive_masters.receive_from), CONCAT("l","-",receive_masters.receive_from))
WHERE  receive_details.status <> 'D' AND receive_masters.status <> 'D'
ORDER BY receive_masters.receive_date, receive_masters.id

DROP VIEW `view_total_stock_summary`
SELECT *FROM `view_total_stock_summary`
/* view_total_stock_summary */







