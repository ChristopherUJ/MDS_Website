<?php defined('COREPATH') or exit('No direct script access allowed'); ?>

Error - 2013-02-19 17:47:28 --> 2002 - SQLSTATE[HY000] [2002] Can't connect to local MySQL server through socket '/var/run/mysqld/mysqld.sock' (2) in /usr/www/users/marinem/stats/fuel/core/classes/database/pdo/connection.php on line 87
Debug - 2013-02-19 17:50:47 --> File uploaded and saved!
Debug - 2013-02-19 17:50:47 --> Dataset entry created!
Debug - 2013-02-19 17:50:51 --> Excel data loaded!
Debug - 2013-02-19 17:50:58 --> Records saved!
Error - 2013-02-19 17:51:11 --> Error - SQLSTATE[42000]: Syntax error or access violation: 1582 Incorrect parameter count in the call to native function 'FROM_UNIXTIME' with query: "SELECT CONCAT(25 * FLOOR(LENGTH / 25), ' - ', 25 * FLOOR(LENGTH / 25) + 25) AS agg, COUNT(*) FROM records WHERE 1 = 1  AND DATE(FROM_UNIXTIME(time_stamp)) BETWEEN DATE(FROM_UNIXTIME()) AND DATE(FROM_UNIXTIME()) GROUP BY 1 ORDER BY LENGTH" in /usr/www/users/marinem/stats/fuel/core/classes/database/pdo/connection.php on line 167
Error - 2013-02-19 17:52:17 --> Error - SQLSTATE[42000]: Syntax error or access violation: 1582 Incorrect parameter count in the call to native function 'FROM_UNIXTIME' with query: "SELECT CONCAT(25 * FLOOR(LENGTH / 25), ' - ', 25 * FLOOR(LENGTH / 25) + 25) AS agg, COUNT(*) FROM records WHERE 1 = 1  AND DATE(FROM_UNIXTIME(time_stamp)) BETWEEN DATE(FROM_UNIXTIME()) AND DATE(FROM_UNIXTIME()) GROUP BY 1 ORDER BY LENGTH" in /usr/www/users/marinem/stats/fuel/core/classes/database/pdo/connection.php on line 167
