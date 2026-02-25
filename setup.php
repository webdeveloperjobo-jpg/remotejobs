<?php
try {
    $host = "dpg-d6fema8gjchc73fmt0gg-a.oregon-postgres.render.com";
    $port = "5432";
    $db   = "remotejobs_j1ji";
    $user = "remotejobs_user";
    $pass = "Cj9Ia94HOuFItFD2jwvfqDjpcDfFGzOa";

    $dsn = "pgsql:host=$host;port=$port;dbname=$db;";

    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $sql = "
    CREATE TABLE IF NOT EXISTS users (
        id SERIAL PRIMARY KEY,
        fullname VARCHAR(100) NOT NULL,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(150) NOT NULL,
        password VARCHAR(255) NOT NULL,
        activated BOOLEAN DEFAULT FALSE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ";

    $pdo->exec($sql);

    echo "<h2 style='color:green;'>✅ Users table created successfully!</h2>";

} catch (PDOException $e) {
    echo "<h3 style='color:red;'>Database Error:</h3>";
    echo $e->getMessage();
}
?>
