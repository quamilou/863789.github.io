<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Commandes</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="Style.css">
    </head>
    <body>   
<?php
// Se connecter à la base de données MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérifier la connexion à la base de données
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Récupérer les données de la base de données
$sql = "SELECT name, command FROM commands";
$result = mysqli_query($conn, $sql);

// Afficher les données sous forme de liste
if (mysqli_num_rows($result) > 0) {
    echo "<h1>Liste des commandes ajoutées</h1>";
    echo "<ul>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<li>" . $row["name"] . " - " . $row["command"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "Aucune commande n'a été ajoutée pour le moment.";
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>
</body> 
</html>