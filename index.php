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

// Vérifier si le formulaire a été soumis pour ajouter une commande
if(isset($_POST['add'])) {
    $name = $_POST['name'];
    $command = $_POST['command'];
    $montant = $_POST['montant'];

    // Insérer la nouvelle commande dans la base de données
    $sql = "INSERT INTO commands (name, command, montant) VALUES ('$name', '$command',$montant)";
    if (mysqli_query($conn, $sql)) {
        echo "Commande ajoutée avec succès !";
    } else {
        echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Vérifier si le formulaire a été soumis pour supprimer une commande
if(isset($_POST['delete'])) {
    $id = $_POST['id'];

    // Supprimer la commande de la base de données
    $sql = "DELETE FROM commands WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "Commande supprimée avec succès !";
    } else {
        echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Récupérer les données de la base de données
$sql = "SELECT * FROM commands";
$result = mysqli_query($conn, $sql);

// Fermer la connexion à la base de données
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page d'ajout et de suppression de commandes</title>
</head>
<body>
    <h1>Ajouter une commande</h1>
    <form method="post">
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name"><br><br>
        <label for="command">Commande:</label>
        <input type="text" id="command" name="command"><br><br>
        <label for="montant">Montant:</label>
        <input type="text" id="montant" name="montant"><br><br>
        <input type="submit" name="add" value="Ajouter la commande">
    </form>

    <h1>Supprimer une commande</h1>
    <?php
    // Afficher les commandes existantes avec des boutons pour les supprimer
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Nom</th><th>Commande</th><th>Montant</th><th>Date</th><th>Action</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["name"] . "</td><td>" . $row["command"] . "</td><td>" . $row["montant"] . "</td><td>" . $row["timestamp"] . "</td>";
            echo "<td><form method='post'><input type='hidden' name='id' value='" . $row["id"] . "'><input type='submit' name='delete' value='Supprimer'></form></td></tr>";
        }
        echo "</table>";
    } else {
        echo "Aucune commande n'a été ajoutée pour le moment.";
    }
    ?>
</body>
</html>
