<?php 
$centername = "HAL";

$server1 = getenv('DB_SERVER1');
$username1 = getenv('DB_USERNAME1');
$password1 = getenv('DB_PASSWORD1');
$database1 = getenv('DB_DATABASE1');

$server2 = getenv('DB_SERVER2');
$username2 = getenv('DB_USERNAME2');
$password2 = getenv('DB_PASSWORD2');
$database2 = getenv('DB_DATABASE2');

while (true) { // Boucle infinie pour la réception des requêtes
    try {
        // Connexion aux bases de données distante et locale
        $conn1 = connect($server1, $username1, $password1, $database1);
        $conn2 = connect($server2, $username2, $password2, $database2);

        // Récupération de la prochaine requête non reçue
        $stmt1 = $conn1->prepare("SELECT * FROM log_central WHERE recu NOT LIKE ? AND prov <> ? LIMIT 1");
        $likeCentername = "%$centername%";
        $stmt1->bind_param("ss", $likeCentername, $centername);
        $stmt1->execute();
        $result1 = $stmt1->get_result();

        if ($result1 && $result1->num_rows > 0) {
            $row1 = $result1->fetch_assoc();
            
            // Début de la transaction
            $conn1->autocommit(FALSE);
            $conn2->autocommit(FALSE);

            // Insertion de la requête dans la base de données locale
            $insertQuery = "INSERT INTO log_query (`id`, `req`, `prov`, `date`) VALUES (?, ?, ?, ?)";
            $stmt2 = $conn2->prepare($insertQuery);
            $stmt2->bind_param("isss", $row1['id'], $row1['req'], $row1['prov'], $row1['date']);
            $stmt2->execute();

            // Validation de la transaction
            $conn1->commit();
            $conn2->commit();
        }

        // Pause pour réduire la charge sur le serveur
        sleep(1);

    } catch (Exception $e) {
        // Gestion des erreurs
        if ($conn1) $conn1->rollback();
        if ($conn2) $conn2->rollback();
        error_log($e->getMessage());
    }
}
?>