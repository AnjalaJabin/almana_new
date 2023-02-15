<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-05-26 13:06:33 --> Query error: Unknown column 'after_item_contents' in 'field list' - Invalid query: INSERT INTO `credit_notes` (`customer_id`, `customer_contact_id`, `email`, `credit_note_number`, `reference`, `currency`, `discount_type`, `tax_included`, `tax_percentage`, `credit_note_date`, `discount_option`, `discount_percentage`, `adjustment`, `adjustment_text`, `shipping_amount`, `total_tax`, `g_total`, `after_item_contents`, `add_company_seal`, `add_personal_sign`, `invoice_id`, `added_date`, `warehouse_id`, `added_by`, `stock_update`, `root_id`) VALUES ('8623', 0, 'Forcecomputer25@gmail.com', 'CN-000001', 'INV-044549', 'AED', 'before_tax', '1', '5', '2020-09-23', '1', '', '0', 'Adjustment', '0', '6.80', '142.8', '', NULL, NULL, '3916', '2021-05-26 13:06:33', '13', '32', 1, '8')
ERROR - 2021-05-26 13:08:17 --> Severity: Notice --> Undefined variable: id /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 3351
ERROR - 2021-05-26 13:08:17 --> Severity: error --> Exception: Call to undefined method Invoices::query() /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 3382
ERROR - 2021-05-26 13:08:17 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/softwarecompany/public_html/subapp/system/core/Exceptions.php:271) /home/softwarecompany/public_html/subapp/system/core/Common.php 564
ERROR - 2021-05-26 13:08:52 --> Severity: error --> Exception: Call to undefined method Invoices::query() /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 3382
ERROR - 2021-05-26 13:28:02 --> Severity: Notice --> Undefined index: viewpendinginvoices /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 3066
ERROR - 2021-05-26 13:28:02 --> Query error: Unknown column 'p.invoice_date' in 'field list' - Invalid query: select p.credit_note_number,p.id,p.g_total,p.total_tax,p.invoice_date,p.expiry_date,p.reference,p.status,c.customer_id,c.company_name,e.first_name,e.last_name,e.profile_picture,e.user_id,p.adjustment,p.currency,p.discount_percentage,p.discount_type,p.tax_percentage FROM credit_notes p, xin_employees e, customers c where p.root_id = 8 and p.customer_id = c.customer_id and p.added_by = e.user_id ORDER BY invoice_date   desc  LIMIT 0 ,10   
ERROR - 2021-05-26 13:28:02 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/softwarecompany/public_html/subapp/system/core/Exceptions.php:271) /home/softwarecompany/public_html/subapp/system/core/Common.php 564
ERROR - 2021-05-26 13:29:17 --> Severity: Notice --> Undefined index: viewpendinginvoices /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 3066
ERROR - 2021-05-26 13:29:17 --> Query error: Unknown column 'p.invoice_date' in 'field list' - Invalid query: select p.credit_note_number,p.id,p.g_total,p.total_tax,p.invoice_date,p.expiry_date,p.reference,p.status,c.customer_id,c.company_name,e.first_name,e.last_name,e.profile_picture,e.user_id,p.adjustment,p.currency,p.discount_percentage,p.discount_type,p.tax_percentage FROM credit_notes p, xin_employees e, customers c where p.root_id = 8 and p.customer_id = c.customer_id and p.added_by = e.user_id ORDER BY invoice_date   desc  LIMIT 0 ,10   
ERROR - 2021-05-26 13:29:17 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/softwarecompany/public_html/subapp/system/core/Exceptions.php:271) /home/softwarecompany/public_html/subapp/system/core/Common.php 564
ERROR - 2021-05-26 13:31:50 --> Query error: Unknown column 'p.invoice_date' in 'field list' - Invalid query: select p.credit_note_number,p.id,p.g_total,p.total_tax,p.invoice_date,p.expiry_date,p.reference,p.status,c.customer_id,c.company_name,e.first_name,e.last_name,e.profile_picture,e.user_id,p.adjustment,p.currency,p.discount_percentage,p.discount_type,p.tax_percentage FROM credit_notes p, xin_employees e, customers c where p.root_id = 8 and p.customer_id = c.customer_id and p.added_by = e.user_id and DATE_FORMAT(p.credit_note_date, '%Y-%m-%d') between '2017-09-11' and '2021-05-26' ORDER BY invoice_date   desc  LIMIT 0 ,10   
ERROR - 2021-05-26 13:32:27 --> Query error: Unknown column 'invoice_date' in 'order clause' - Invalid query: select p.credit_note_number,p.id,p.g_total,p.total_tax,p.credit_note_date,p.expiry_date,p.reference,p.status,c.customer_id,c.company_name,e.first_name,e.last_name,e.profile_picture,e.user_id,p.adjustment,p.currency,p.discount_percentage,p.discount_type,p.tax_percentage FROM credit_notes p, xin_employees e, customers c where p.root_id = 8 and p.customer_id = c.customer_id and p.added_by = e.user_id and DATE_FORMAT(p.credit_note_date, '%Y-%m-%d') between '2017-09-11' and '2021-05-26' ORDER BY invoice_date   desc  LIMIT 0 ,10   
ERROR - 2021-05-26 13:33:04 --> Query error: Unknown column 'invoice_date' in 'order clause' - Invalid query: select p.credit_note_number,p.id,p.g_total,p.total_tax,p.credit_note_date,p.expiry_date,p.reference,p.status,c.customer_id,c.company_name,e.first_name,e.last_name,e.profile_picture,e.user_id,p.adjustment,p.currency,p.discount_percentage,p.discount_type,p.tax_percentage FROM credit_notes p, xin_employees e, customers c where p.root_id = 8 and p.customer_id = c.customer_id and p.added_by = e.user_id and DATE_FORMAT(p.credit_note_date, '%Y-%m-%d') between '2017-09-11' and '2021-05-26' ORDER BY invoice_date   desc  LIMIT 0 ,10   
ERROR - 2021-05-26 13:33:32 --> Severity: Notice --> Undefined property: stdClass::$read_status /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 3135
ERROR - 2021-05-26 13:34:08 --> Severity: Notice --> Undefined variable: read_status /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 3165
ERROR - 2021-05-26 13:45:57 --> Severity: Notice --> Undefined property: stdClass::$invoice_number /home/softwarecompany/public_html/subapp/application/views/invoices/view_credit_note.php 198
ERROR - 2021-05-26 13:45:57 --> Severity: Notice --> Undefined property: stdClass::$invoice_date /home/softwarecompany/public_html/subapp/application/views/invoices/view_credit_note.php 200
ERROR - 2021-05-26 14:14:22 --> Query error: Unknown column 'invoice_id' in 'where clause' - Invalid query: DELETE FROM `credit_note_items`
WHERE `invoice_id` = '3' and `root_id` = '8'
ERROR - 2021-05-26 14:14:59 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 3637
ERROR - 2021-05-26 14:14:59 --> Severity: Notice --> Trying to get property 'invoice_id' of non-object /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 3637
ERROR - 2021-05-26 14:14:59 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 3642
ERROR - 2021-05-26 14:14:59 --> Severity: Notice --> Trying to get property 'invoice_id' of non-object /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 3642
ERROR - 2021-05-26 14:14:59 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 3642
ERROR - 2021-05-26 14:14:59 --> Severity: Notice --> Trying to get property 'invoice_id' of non-object /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 3642
ERROR - 2021-05-26 14:14:59 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 3642
ERROR - 2021-05-26 14:14:59 --> Severity: Notice --> Trying to get property 'invoice_id' of non-object /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 3642
ERROR - 2021-05-26 14:14:59 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 3642
ERROR - 2021-05-26 14:14:59 --> Severity: Notice --> Trying to get property 'invoice_id' of non-object /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 3642
ERROR - 2021-05-26 14:14:59 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 3642
ERROR - 2021-05-26 14:14:59 --> Severity: Notice --> Trying to get property 'invoice_id' of non-object /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 3642
ERROR - 2021-05-26 14:14:59 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/softwarecompany/public_html/subapp/system/core/Exceptions.php:271) /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 33
ERROR - 2021-05-26 14:14:59 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/softwarecompany/public_html/subapp/system/core/Exceptions.php:271) /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 34
ERROR - 2021-05-26 14:15:35 --> Severity: Notice --> Trying to get property 'invoice_id' of non-object /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 3637
ERROR - 2021-05-26 14:15:35 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/softwarecompany/public_html/subapp/system/core/Exceptions.php:271) /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 33
ERROR - 2021-05-26 14:15:35 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/softwarecompany/public_html/subapp/system/core/Exceptions.php:271) /home/softwarecompany/public_html/subapp/application/controllers/Invoices.php 34
ERROR - 2021-05-26 19:07:25 --> Query error: Column 'cost_price' cannot be null - Invalid query: INSERT INTO `credit_note_items` (`credit_note_id`, `item_name`, `item_id`, `description`, `qty`, `unit`, `rate`, `amount`, `date`, `added_by`, `cost_price`, `warehouse_id`, `root_id`) VALUES ('10', 'Cash Refund', '', 'Cash Refund', '1', 'Unit', '150', 150, '2021-05-26 19:07:25', '32', NULL, '13', '8')
ERROR - 2021-05-26 19:08:20 --> Query error: Column 'cost_price' cannot be null - Invalid query: INSERT INTO `credit_note_items` (`credit_note_id`, `item_name`, `item_id`, `description`, `qty`, `unit`, `rate`, `amount`, `date`, `added_by`, `cost_price`, `warehouse_id`, `root_id`) VALUES ('11', 'Cash Refund', '', 'Cash Refund', '1', 'Unit', '150', 150, '2021-05-26 19:08:20', '32', NULL, '13', '8')
ERROR - 2021-05-26 19:12:13 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:13 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:13 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:12:13 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:13 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:13 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:12:13 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:13 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:13 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:12:13 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:13 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:13 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:12:13 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:13 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:13 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:12:15 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:15 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:15 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:12:15 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:15 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:15 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:12:15 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:15 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:15 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:12:17 --> Severity: Notice --> Undefined variable: show_all_list /home/softwarecompany/public_html/subapp/application/views/customers/customers_list.php 91
ERROR - 2021-05-26 19:12:22 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:22 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:22 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:12:23 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:23 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:23 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:12:28 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:28 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:28 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:12:29 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:29 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:29 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:12:29 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:29 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:29 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:12:31 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:31 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:31 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:12:31 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:31 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:31 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:12:31 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:31 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:12:31 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:15:16 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:15:16 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:15:16 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:15:16 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:15:16 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:15:16 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:15:16 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:15:16 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:15:16 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:15:16 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:15:16 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:15:16 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:15:16 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:15:16 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:15:16 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:15:18 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:15:18 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:15:18 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:15:18 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:15:18 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:15:18 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:15:18 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:15:18 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:15:18 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:15:20 --> Severity: Notice --> Undefined variable: show_all_list /home/softwarecompany/public_html/subapp/application/views/customers/customers_list.php 91
ERROR - 2021-05-26 19:15:26 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:15:26 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:15:26 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:15:26 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:15:26 --> Severity: Notice --> Trying to get property 'one_usd' of non-object /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
ERROR - 2021-05-26 19:15:26 --> Severity: Warning --> Division by zero /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 96
ERROR - 2021-05-26 19:15:32 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Accounts_model.php 79
