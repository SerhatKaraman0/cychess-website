<?php
define('DBSERVER', 'localhost');
define('DBUSERNAME', 'root');
define('DBPASSWORD','serhat2003');
define('DBNAME', 'cychessdb')

$db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

if ($db === false){
    die('Error: connection error. ' . mysqli_connect_error());
}
?>