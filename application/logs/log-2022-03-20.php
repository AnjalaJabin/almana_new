<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-03-20 22:58:22 --> Severity: Notice --> Trying to access array offset on value of type null /home/softwarecompany/public_html/subapp/application/controllers/Settings.php 992
ERROR - 2022-03-20 22:58:22 --> Severity: Notice --> Undefined index: root_id /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 222
ERROR - 2022-03-20 22:58:24 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/softwarecompany/public_html/subapp/system/core/Exceptions.php:271) /home/softwarecompany/public_html/subapp/application/controllers/Settings.php 24
ERROR - 2022-03-20 22:58:24 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/softwarecompany/public_html/subapp/system/core/Exceptions.php:271) /home/softwarecompany/public_html/subapp/application/controllers/Settings.php 25
ERROR - 2022-03-20 23:00:28 --> Severity: Notice --> Undefined index: root_id /home/softwarecompany/public_html/subapp/application/controllers/Purchase.php 588
ERROR - 2022-03-20 23:00:28 --> Severity: Notice --> Trying to access array offset on value of type null /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3304
ERROR - 2022-03-20 23:00:28 --> Severity: Notice --> Trying to access array offset on value of type null /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3305
ERROR - 2022-03-20 23:00:28 --> Severity: Notice --> Trying to get property 'user_role_id' of non-object /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3305
ERROR - 2022-03-20 23:00:28 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3307
ERROR - 2022-03-20 23:00:28 --> Severity: Notice --> Trying to get property 'role_resources' of non-object /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3307
ERROR - 2022-03-20 23:00:28 --> Severity: Notice --> Trying to access array offset on value of type null /home/softwarecompany/public_html/subapp/application/controllers/Purchase.php 593
ERROR - 2022-03-20 23:00:28 --> Severity: Notice --> Trying to access array offset on value of type null /home/softwarecompany/public_html/subapp/application/controllers/Purchase.php 594
ERROR - 2022-03-20 23:00:28 --> Severity: Notice --> Trying to get property 'pricing_company' of non-object /home/softwarecompany/public_html/subapp/application/controllers/Purchase.php 594
ERROR - 2022-03-20 23:00:28 --> Severity: Notice --> Undefined index: root_id /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3466
ERROR - 2022-03-20 23:00:28 --> Severity: Notice --> Trying to access array offset on value of type null /home/softwarecompany/public_html/subapp/application/controllers/Purchase.php 611
ERROR - 2022-03-20 23:00:28 --> Severity: Notice --> Undefined index: order /home/softwarecompany/public_html/subapp/application/controllers/Purchase.php 632
ERROR - 2022-03-20 23:00:28 --> Severity: Notice --> Trying to access array offset on value of type null /home/softwarecompany/public_html/subapp/application/controllers/Purchase.php 632
ERROR - 2022-03-20 23:00:28 --> Severity: Notice --> Trying to access array offset on value of type null /home/softwarecompany/public_html/subapp/application/controllers/Purchase.php 632
ERROR - 2022-03-20 23:00:28 --> Severity: Notice --> Undefined index:  /home/softwarecompany/public_html/subapp/application/controllers/Purchase.php 632
ERROR - 2022-03-20 23:00:28 --> Severity: Notice --> Undefined index: order /home/softwarecompany/public_html/subapp/application/controllers/Purchase.php 632
ERROR - 2022-03-20 23:00:28 --> Severity: Notice --> Trying to access array offset on value of type null /home/softwarecompany/public_html/subapp/application/controllers/Purchase.php 632
ERROR - 2022-03-20 23:00:28 --> Severity: Notice --> Trying to access array offset on value of type null /home/softwarecompany/public_html/subapp/application/controllers/Purchase.php 632
ERROR - 2022-03-20 23:00:28 --> Severity: Notice --> Undefined index: start /home/softwarecompany/public_html/subapp/application/controllers/Purchase.php 632
ERROR - 2022-03-20 23:00:28 --> Severity: Notice --> Undefined index: length /home/softwarecompany/public_html/subapp/application/controllers/Purchase.php 632
ERROR - 2022-03-20 23:00:28 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'LIMIT  ,' at line 1 - Invalid query: select p.invoice_number,p.purchase_number,p.currency,p.id,p.g_total,p.total_tax,p.invoice_date,p.reference,s.name,e.first_name,e.last_name,c.name as company_name FROM purchase p, xin_employees e, suppliers s, xin_companies c where p.root_id = '' and p.company_id = c.company_id and p.added_by = '' and p.supplier_id = s.id and p.added_by = e.user_id ORDER BY      LIMIT  ,   
ERROR - 2022-03-20 23:00:28 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/softwarecompany/public_html/subapp/system/core/Exceptions.php:271) /home/softwarecompany/public_html/subapp/system/core/Common.php 570
ERROR - 2022-03-20 23:00:43 --> Severity: Notice --> Trying to access array offset on value of type null /home/softwarecompany/public_html/subapp/application/controllers/Settings.php 992
ERROR - 2022-03-20 23:00:43 --> Severity: Notice --> Undefined index: root_id /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 222
ERROR - 2022-03-20 23:00:43 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/softwarecompany/public_html/subapp/system/core/Exceptions.php:271) /home/softwarecompany/public_html/subapp/application/controllers/Settings.php 24
ERROR - 2022-03-20 23:00:43 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/softwarecompany/public_html/subapp/system/core/Exceptions.php:271) /home/softwarecompany/public_html/subapp/application/controllers/Settings.php 25
