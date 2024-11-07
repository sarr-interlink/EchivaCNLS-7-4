<?php

$server1 = "localhost";
$username1 = "root";
$password1 = "";
$database1 = "amnirechivacnls";

// Connexion à la base de données locale
$conn1 = new mysqli($server1, $username1, $password1, $database1);
if ($conn1->connect_error) {
    die("Connection failed: " . $conn1->connect_error);
}

// Sélection des requêtes non traitées dans le journal
$sql1 = "SELECT id, req FROM $database1.log_query WHERE etat = 0 AND prov<>'' LIMIT 1000";
$result1 = $conn1->query($sql1);

if ($result1->num_rows > 0) {
    while ($row1 = $result1->fetch_assoc()) {
        try {
            // Exécution de la requête
            $req = $row1['req'];
            $resul2 = $conn1->query($req);
            
            // Mise à jour de l'état de la requête
            if ($resul2) {
                $updateQuery = "UPDATE $database1.log_query SET etat = 1, date = '" . date('Y-m-d H:i:s') . "' WHERE id = " . $row1['id'];
                $conn1->query($updateQuery);
            } else {
                // Loguer l'erreur et mettre à jour l'état de la requête avec le code d'erreur
                $errno = $conn1->errno;
                $error = $conn1->error;
                echo date('Y-m-d H:i:s') . " Erreur $errno: $error\n";
                $logFile = fopen("C:/wamp64New/www/EchivaCNLS/log/exec.log", "a");
                fwrite($logFile, date('Y-m-d H:i:s') . " Erreur $errno: $error\n");
                fclose($logFile);

                $updateQuery = "UPDATE $database1.log_query SET etat = $errno, date = '" . date('Y-m-d H:i:s') . "' WHERE id = " . $row1['id'];
                $conn1->query($updateQuery);
            }
        } catch (Exception $e) {
            // Gérer l'exception si nécessaire
        }
    }
}

// Fermeture de la connexion à la base de données
$conn1->close();

?>
