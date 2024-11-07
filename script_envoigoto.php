<?php

// Configuration des informations de connexion
$localDbConfig = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'amnirechivacnls'
];

$remoteDbConfig = [
    'host' => '31.207.34.83',
    'username' => 'amnir_echiva',
    'password' => 'NF5oopx1AIUt52XS',
    'database' => 'amnirechiva'
];

$centerName = "HAL";
$logFilePath = "C:/wamp64New/www/EchivaCNLS/log/envoi.log";

// Fonction de connexion à la base de données
function connectToDatabase($config)
{
    $mysqli = new mysqli($config['host'], $config['username'], $config['password'], $config['database']);
    if ($mysqli->connect_errno) {
        throw new Exception("Erreur de connexion à la base de données: " . $mysqli->connect_error);
    }
    return $mysqli;
}

// Fonction pour exécuter une requête SQL et récupérer les résultats
function executeQuery($mysqli, $sql)
{
    $result = $mysqli->query($sql);
    if (!$result) {
        throw new Exception("Erreur d'exécution de la requête: " . $mysqli->error);
    }
    return $result;
}

// Fonction pour journaliser les erreurs
function logError($message, $logFilePath)
{
    $logFile = fopen($logFilePath, "a");
    fwrite($logFile, date('Y-m-d H:i:s') . " Erreur : $message\n");
    fclose($logFile);
}

// Fonction pour envoyer les requêtes vers la base de données distante
function sendQueryToRemote($localResult, $mysqliLocal, $mysqliRemote, $centerName, $logFilePath)
{
    $row = $localResult->fetch_row();
    $localResult->free();

    $query = "INSERT INTO amnirechiva.log_central (`id`, `req`, `prov`, `recu`, `date`) 
              VALUES (NULL, '" . $mysqliLocal->real_escape_string($row[1]) . "', '$centerName', '', '" . date('Y-m-d H:i:s') . "')";

    $remoteResult = executeQuery($mysqliRemote, $query);

    $updateQuery = "UPDATE amnirechivacnls.log_query SET etat=1 WHERE id=$row[0]";
    $localResult = executeQuery($mysqliLocal, $updateQuery);

    // Commit ou rollback selon le résultat de l'insertion et de la mise à jour
    if (!$remoteResult || !$localResult) {
        $mysqliRemote->rollback();
        $mysqliLocal->rollback();
        logError("$row[0] n'a pas pu être envoyé ou mise à jour à 1", $logFilePath);
    } else {
        $mysqliRemote->commit();
        $mysqliLocal->commit();
    }
}

// Boucle principale
while (true) {
    try {
        // Connexion aux bases de données locales et distantes
        $mysqliLocal = connectToDatabase($localDbConfig);
        $mysqliRemote = connectToDatabase($remoteDbConfig);

        // Récupération de la prochaine requête non traitée
        $query = "SELECT * FROM amnirechivacnls.log_query WHERE etat = 0 AND prov='' LIMIT 1";
        $localResult = executeQuery($mysqliLocal, $query);

        // Vérification s'il y a des résultats
        if ($localResult->num_rows > 0) {
            // Envoyer la requête à la base de données distante
            sendQueryToRemote($localResult, $mysqliLocal, $mysqliRemote, $centerName, $logFilePath);
        } else {
            // Aucune nouvelle requête, attendre avant de vérifier à nouveau
            sleep(300);
        }
    } catch (Exception $e) {
        // Journaliser l'erreur
        logError($e->getMessage(), $logFilePath);
    } finally {
        // Fermer les connexions
        if ($mysqliLocal) {
            $mysqliLocal->close();
        }
        if ($mysqliRemote) {
            $mysqliRemote->close();
        }
    }
}

?>
