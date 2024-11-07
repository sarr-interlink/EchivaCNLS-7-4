<?php
function dump($ignore)
{ 
    $prefix = 'alg_';    
    // Configuration de la base de données
    $dbConfig = [
        'host' => 'localhost',
        'database' => 'amnirechivacnls',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8mb4'
    ];
    
    try {
        $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['database']};charset={$dbConfig['charset']}";
        $pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
        
        foreach ($tables as $table) {
            if (strpos($table, $prefix) === 0) {
                dumpTable($pdo, $table);
            }
        }
        
        echo date('Y-m-d H:i:s');
        return true;
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
        return false;
    }
}

function dumpTable($pdo, $tableName)
{
    $createTableStmt = $pdo->query("SHOW CREATE TABLE $tableName")->fetch(PDO::FETCH_ASSOC);
    $createTableQuery = $createTableStmt['Create Table'];
    saveQuery($pdo, $createTableQuery);
    
    $insertQuery = "INSERT INTO $tableName VALUES ";
    $stmt = $pdo->query("SELECT * FROM $tableName");
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $rowValues = array_map(function($value) use ($pdo) {
            return $pdo->quote($value);
        }, $row);
        
        $insertQuery .= "(" . implode(',', $rowValues) . "),";
    }
    
    $insertQuery = rtrim($insertQuery, ',');
    saveQuery($pdo, $insertQuery);
}

function saveQuery($pdo, $query)
{
    try {
        $stmt = $pdo->prepare("INSERT INTO log_query (req, date) VALUES (:query, :date)");
        $stmt->execute(['query' => $query, 'date' => date('Y-m-d H:i:s')]);
    } catch (PDOException $e) {
        echo "Erreur lors de l'enregistrement de la requête : " . $e->getMessage();
    }
}

echo date('Y-m-d H:i:s');
dump(0);
echo "\n" . date('Y-m-d H:i:s');
?>
