<?php 
$prefix='alg_';
$server = "localhost";
$username = "root";
//$password = "sumysql"; sarr
$password = "";
//$database = "amnirechiva"; sarr
$database = "amnirechivacnls";
$conn = new mysqli($server, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	exit;
}

$sql = 'SHOW TABLES FROM '.$database;	
$tables = $conn->query($sql);
$table="centre csi_ dci_ list loca permission resource role role_permission trans user user_role ";
if ($tables->num_rows > 0) { 
	while($donnees = $tables->fetch_row()) {
		if(strpos($donnees[0], $prefix) === 0){
			$table.=$donnees[0]." ";
		}
	}
}

$datesave=date('d-m-Y-H-i-s');
// $requete= "mysqldump --defaults-extra-file=/var/www/Saveamnirechiva/config.cnf amnirechiva $table > /var/www/Saveamnirechiva/amnirechiva$datesave.sql";
$requete= "mysqldump --defaults-extra-file=C:/wamp64/www/EchivaCNLS/Saveamnirechiva/config.cnf amnirechiva $table > C:/wamp64/www/EchivaCNLS/Saveamnirechiva/amnirechiva$datesave.sql";
exec($requete);
mysqli_close($conn);


?>
