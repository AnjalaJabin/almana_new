<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-02-25 09:37:10 --> Severity: Notice --> Trying to access array offset on value of type null /home/softwarecompany/public_html/subapp/application/controllers/Reports.php 513
ERROR - 2022-02-25 09:37:10 --> Severity: Notice --> Undefined index: root_id /home/softwarecompany/public_html/subapp/application/controllers/Reports.php 514
ERROR - 2022-02-25 09:37:10 --> Severity: Notice --> Trying to access array offset on value of type null /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3304
ERROR - 2022-02-25 09:37:10 --> Severity: Notice --> Trying to access array offset on value of type null /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3305
ERROR - 2022-02-25 09:37:10 --> Severity: Notice --> Trying to get property 'user_role_id' of non-object /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3305
ERROR - 2022-02-25 09:37:10 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3307
ERROR - 2022-02-25 09:37:10 --> Severity: Notice --> Trying to get property 'role_resources' of non-object /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3307
ERROR - 2022-02-25 09:37:10 --> Severity: Notice --> Trying to access array offset on value of type null /home/softwarecompany/public_html/subapp/application/controllers/Reports.php 531
ERROR - 2022-02-25 09:37:10 --> Severity: Notice --> Trying to access array offset on value of type null /home/softwarecompany/public_html/subapp/application/controllers/Reports.php 532
ERROR - 2022-02-25 09:37:10 --> Severity: Notice --> Trying to get property 'pricing_company' of non-object /home/softwarecompany/public_html/subapp/application/controllers/Reports.php 532
ERROR - 2022-02-25 09:37:10 --> Severity: Notice --> Undefined index: root_id /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3466
ERROR - 2022-02-25 09:37:10 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'and (added_by = 32 || assigned_as = 32 || sub_assigned = 32)' at line 1 - Invalid query: SELECT DATE_FORMAT(created_date, "%Y-%m") AS year,COUNT(*) AS total FROM leads where customer_id>0 and DATE_FORMAT(created_date, "%Y-%m-%d") between "2017-09-11" and "2022-02-25" and root_id= and (added_by = 32 || assigned_as = 32 || sub_assigned = 32)  
ERROR - 2022-02-25 09:37:10 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/softwarecompany/public_html/subapp/system/core/Exceptions.php:271) /home/softwarecompany/public_html/subapp/system/core/Common.php 570
ERROR - 2022-02-25 09:37:13 --> Severity: Notice --> Undefined index: root_id /home/softwarecompany/public_html/subapp/application/models/Reports_model.php 818
ERROR - 2022-02-25 09:37:13 --> Severity: Notice --> Undefined index: user_id /home/softwarecompany/public_html/subapp/application/models/Reports_model.php 819
ERROR - 2022-02-25 09:37:13 --> Severity: Notice --> Trying to access array offset on value of type null /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3304
ERROR - 2022-02-25 09:37:13 --> Severity: Notice --> Trying to access array offset on value of type null /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3305
ERROR - 2022-02-25 09:37:13 --> Severity: Notice --> Trying to get property 'user_role_id' of non-object /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3305
ERROR - 2022-02-25 09:37:13 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3307
ERROR - 2022-02-25 09:37:13 --> Severity: Notice --> Trying to get property 'role_resources' of non-object /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3307
ERROR - 2022-02-25 09:37:13 --> Severity: Notice --> Trying to access array offset on value of type null /home/softwarecompany/public_html/subapp/application/models/Reports_model.php 823
ERROR - 2022-02-25 09:37:13 --> Severity: Notice --> Trying to get property 'pricing_company' of non-object /home/softwarecompany/public_html/subapp/application/models/Reports_model.php 823
ERROR - 2022-02-25 09:37:13 --> Severity: Notice --> Undefined index: root_id /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3466
ERROR - 2022-02-25 09:37:13 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') and DATE_FORMAT(date, '%Y-%m-%d') between '2017-09-11' and '2022-02-25' and...' at line 1 - Invalid query: SELECT item_name, item_id, description, SUM(qty) AS TotalQuantity FROM pricing_quotes_items where root_id = '' and added_by IN () and DATE_FORMAT(date, '%Y-%m-%d') between '2017-09-11' and '2022-02-25' and item_id!=0 GROUP BY item_id ORDER BY SUM(qty) DESC limit 8
ERROR - 2022-02-25 09:37:13 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/softwarecompany/public_html/subapp/system/core/Exceptions.php:271) /home/softwarecompany/public_html/subapp/system/core/Common.php 570
ERROR - 2022-02-25 09:37:14 --> Severity: Warning --> session_destroy(): Trying to destroy uninitialized session /home/softwarecompany/public_html/subapp/application/controllers/Dashboard.php 255
