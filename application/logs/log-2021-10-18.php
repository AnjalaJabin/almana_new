<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-10-18 23:59:56 --> Severity: Notice --> Undefined index: root_id /home/softwarecompany/public_html/subapp/application/controllers/Customers.php 1839
ERROR - 2021-10-18 23:59:56 --> Severity: Notice --> Undefined index: filter_department /home/softwarecompany/public_html/subapp/application/controllers/Customers.php 1841
ERROR - 2021-10-18 23:59:56 --> Severity: Notice --> Undefined index: filter_service /home/softwarecompany/public_html/subapp/application/controllers/Customers.php 1842
ERROR - 2021-10-18 23:59:56 --> Severity: Notice --> Undefined index: filter_status /home/softwarecompany/public_html/subapp/application/controllers/Customers.php 1843
ERROR - 2021-10-18 23:59:56 --> Severity: Notice --> Trying to get property 'user_role_id' of non-object /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3271
ERROR - 2021-10-18 23:59:56 --> Severity: Notice --> Undefined offset: 0 /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3273
ERROR - 2021-10-18 23:59:56 --> Severity: Notice --> Trying to get property 'role_resources' of non-object /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3273
ERROR - 2021-10-18 23:59:56 --> Severity: Notice --> Trying to get property 'pricing_company' of non-object /home/softwarecompany/public_html/subapp/application/controllers/Customers.php 1868
ERROR - 2021-10-18 23:59:56 --> Severity: Notice --> Undefined index: root_id /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3432
ERROR - 2021-10-18 23:59:56 --> Severity: Notice --> Undefined index: root_id /home/softwarecompany/public_html/subapp/application/models/Xin_model.php 3452
ERROR - 2021-10-18 23:59:56 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and c.status = ''  and (c.added_by =  OR c.customer_id IN (select customer_id fr' at line 1 - Invalid query: select count(*) rowcount  FROM xin_employees e, customers c where c.root_id =   and c.status = ''  and (c.added_by =  OR c.customer_id IN (select customer_id from customer_assigned where user_id='')) and c.added_by = e.user_id 
ERROR - 2021-10-18 23:59:56 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/softwarecompany/public_html/subapp/system/core/Exceptions.php:271) /home/softwarecompany/public_html/subapp/system/core/Common.php 564
