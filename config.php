<?php
define("DB_SERVER", "mysql.hostinger.co.uk");
define("DB_USERNAME", "u493508619_users");
define("DB_PASSWORD", ";GfJ^xTg9u^FJJ3|UI");
define("DB_DATABASE", "u493508619_datab");
$conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (!$conn) {
    die("connection failed: " .mysqli_connect_error());
}
?>