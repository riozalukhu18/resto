
<?php // Rememeber to change the username,password and database name to acutal values
define('DB_HOST','php-mysql-resto');
define('DB_USER','user');
define('DB_PASS','password');
define('DB_NAME','restaurantdb');

//Create Connection
$link = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

//Check COnnection
if($link->connect_error){ //if not Connection
die('Connection Failed'.$link->connect_error);//kills the Connection OR terminate execution
}
?>
