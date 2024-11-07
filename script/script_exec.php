<?php 
//execution des requete contenu dans le log
$server1 = "localhost";
$username1 = "root";
// $password1 = "sumysql";
$password1 = "";
$database1 = "amnirechivacnls";
$conn1 = new mysqli($server1, $username1, $password1, $database1);
if ($conn1->connect_error) {
    die("Connection failed: " . $conn1->connect_error);
	exit;
} 

	
$sql1 = "SELECT * FROM $database1.log_query WHERE etat = 0 and prov<>'' LIMIT 0 , 1000;";

$result1 = $conn1->query($sql1);
if ($result1->num_rows > 0) {
	
	while($row1 = $result1->fetch_row()) {
		try {
			$req = $row1[1];
			
			$resul2=$conn1->query($req);
			
			
			if($resul2)
			{
				$resul3 = $conn1->query("UPDATE $database1.log_query SET etat=1,date='".date('Y-m-d H:i:s')."' WHERE id=".$row1[0]);			
			}
			else{/*************/
				$errno=$conn1->errno;
				$error=$conn1->error;
				echo date('Y-m-d H:i:s')." Erreur $errno: $error\n";
				$f=fopen("/var/www/log/exec.log","a");
				fwrite($f,date('Y-m-d H:i:s')." Erreur $errno: $error\n");
				$resul4 = $conn1->query("UPDATE $database1.log_query SET etat=$errno,date='".date('Y-m-d H:i:s')."' WHERE id=".$row1[0]);			
			}
		}
		catch (Exception $e) {
		}
    }
}
mysqli_close($conn1);
?>
