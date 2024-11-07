<?php 
	$centername = "HAL";
	$server1 = "localhost";
	$username1 = "root";
	$password1 = "";
	// $password1 = "sumysql";
	$database1='amnirechiva';
	$server2 = "31.207.34.83";
	$username2 = "amnir_echiva";
	$password2 = "NF5oopx1AIUt52XS";
	$database2='amnirechiva';
	$conn1=connect($server1,$username1,$password1,$database1);
	$conn2=connect($server2,$username2,$password2,$database2);
envoi:
	try{
		$sql1 ="SELECT * FROM $database1.log_query WHERE etat = 0 and prov='' LIMIT 0 , 1;";
		if(!checkconnect($conn1))
			$conn1=connect($server1,$username1,$password1,$database1);
		if(!checkconnect($conn2))
			$conn2=connect($server2,$username2,$password2,$database2);
		$result1 = $conn1->query($sql1);
		if($result1->num_rows > 0) { 
			if($row1 = $result1->fetch_row()) {
				$row1 = utf8_decodage($row1);
				$conn1->autocommit(FALSE);
				$conn2->autocommit(FALSE);
				$resul2=$conn2->query("INSERT INTO $database2.log_central (`id`, `req`, `prov`, `recu`,`date`) VALUES (NULL, \"$row1[1]\",\"$centername\", \"\",\"".date('Y-m-d H:i:s')."\");");
				$resul3=$conn1->query("UPDATE $database1.log_query SET etat=1 WHERE id=".$row1[0]);
				if(!$resul2 && $resul3)
				{
					$f=fopen("/var/www/log/envoi.log","a");
					fwrite($f,date('Y-m-d H:i:s')." $row1[0] n'a pas pu etre envoyé\n");
					$conn1->rollback();
				}
				else
				if(!$resul3 && $resul2)
				{
					$f=fopen("/var/www/log/envoi.log","a");
					fwrite($f,date('Y-m-d H:i:s')." $row1[0] n'a pas pu etre mise a jour a 1\n");
					$conn2->rollback();
				}
				else
				{
					$conn1->commit();
					$conn2->commit();
				}			
			}
		}
		else{
			$f=fopen("/var/www/log/envoi.log","a");
			fwrite($f,date('Y-m-d H:i:s')." pas de nouvelle requete\n");
			sleep(300);
			mysqli_close($conn1);
			$conn1=connect($server1,$username1,$password1,$database1);
			mysqli_close($conn2);
			$conn2=connect($server2,$username2,$password2,$database2);
		}
	}
	catch(Exception $ex){
		//ecrire l'erreur dans un fichier
		$f=fopen("/var/www/log/envoi.log","a");
			fwrite($f,date('Y-m-d H:i:s').' Erreur : ' . $e->getMessage()."\n");
	}
goto envoi;

	function connect($server1,$username1,$password1,$database1) {
		start:
		mysqli_report(MYSQLI_REPORT_STRICT);
		$i=1;
		$connect=false;
		while($i<6 && !$connect){
		   try{
				$conn1 = new mysqli($server1, $username1, $password1, $database1);
				if (!$conn1->connect_error) {
					$connect=true;
				}
				else{
					$i++;
				}
		    }
			catch(mysqli_sql_exception $e){
				$f=fopen("/var/www/log/envoi.log","a");
				fwrite($f,date('Y-m-d H:i:s')." Connection failed: " . $e->getMessage()."\n");
			    $i++;
				sleep(60);
			}

		} 
		if($i==6)
		{
			sleep(600);
			goto start;
		}	
		return $conn1;
	}

	function checkconnect($conn1) {
		$bool=true;
		if (!mysqli_ping($conn1)) {
			$bool=false;
			mysqli_close($conn1);
		} 
		return $bool;
	}

	function utf8_decodage($array) {
		array_walk_recursive($array, function(&$item, $key) {
			if (mb_detect_encoding($item, 'utf-8', true)) {
				$item = utf8_decode($item);
			}
		});
		return $array;
	}
?>
