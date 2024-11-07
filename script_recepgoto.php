<?php 
$centername = "HAL";

$server1 = "31.207.34.83";
$username1 = "amnir_echiva";
$password1 = "NF5oopx1AIUt52XS";
$database1 = "amnirechiva";

$server2 = "localhost";
$username2 = "root";
$password2 = "";
$database2 = "amnirechivacnls";

while (true) { // Boucle infinie pour la réception des requêtes
    try {
        // Connexion aux bases de données distante et locale
        $conn1 = connect($server1, $username1, $password1, $database1);
        $conn2 = connect($server2, $username2, $password2, $database2);

        // Récupération de la prochaine requête non reçue
        $sql1 = "SELECT * FROM $database1.log_central WHERE recu NOT LIKE '%$centername%' AND prov <> '$centername' LIMIT 1";
        $result1 = $conn1->query($sql1);

        if ($result1->num_rows > 0) {
            $row1 = $result1->fetch_assoc();
            
            // Début de la transaction
            $conn1->autocommit(FALSE);
            $conn2->autocommit(FALSE);

            // Insertion de la requête dans la base de données locale
            $insertQuery = "INSERT INTO $database2.log_query (`id`, `req`, `prov`, `date`) 
                            VALUES (NULL, '{$row1['req']}', '{$row1['prov']}', '" . date('Y-m-d H:i:s') . "')";
            $resul3 = $conn2->query($insertQuery);

            // Mise à jour de l'état de la requête dans la base de données distante
            $updateQuery = "UPDATE $database1.log_central SET recu = CONCAT(recu, '|$centername') WHERE id = {$row1['id']}";
            $resul4 = $conn1->query($updateQuery);

            // Commit ou rollback selon le résultat des opérations
            if (!$resul3 || !$resul4) {
                $conn1->rollback();
                $conn2->rollback();
                $logFile = fopen("C:/wamp64New/www/EchivaCNLS/log/recep.log", "a");
                fwrite($logFile, date('Y-m-d H:i:s') . " Erreur: La requête {$row1['id']} n'a pas pu être reçue ou mise à jour\n");
                fclose($logFile);
            } else {
                $conn1->commit();
                $conn2->commit();
            }
        } else {
            // Aucune nouvelle requête, attendre avant de vérifier à nouveau
            $logFile = fopen("C:/wamp64New/www/EchivaCNLS/log/recep.log", "a");
            fwrite($logFile, date('Y-m-d H:i:s') . " Pas de nouvelle requête\n");
            fclose($logFile);
            sleep(300);
        }
    } catch (Exception $ex) {
        // Journaliser l'erreur
        $logFile = fopen("C:/wamp64New/www/EchivaCNLS/log/recep.log", "a");
        fwrite($logFile, date('Y-m-d H:i:s') . " Erreur: " . $ex->getMessage() . "\n");
        fclose($logFile);
    } finally {
        // Fermeture des connexions
        if ($conn1) {
            $conn1->close();
        }
        if ($conn2) {
            $conn2->close();
        }
    }
}

function connect($server, $username, $password, $database) {
    mysqli_report(MYSQLI_REPORT_STRICT);
    $conn = new mysqli($server, $username, $password, $database);
    if ($conn->connect_errno) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>
