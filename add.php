<?php
// Vérifie si des données ont été envoyées via la méthode POST
if ($_POST) {
    // Vérifie si les clés "nom", "couleur" et "box" existent dans les données POST
    if (
        isset($_POST["nom"]) &&
        isset($_POST["couleur"]) &&
        isset($_POST["box"])
    ) {
        // Connexion à la base de données en incluant le fichier connect.php
        require_once("connect.php");

        // Nettoyage des données entrées par l'utilisateur pour éviter les failles de sécurité (strip_tags) "failles xss"
        $nom = strip_tags($_POST["nom"]);
        $couleur = strip_tags($_POST["couleur"]);
        $box = strip_tags($_POST["box"]);

        // Requête SQL pour insérer les données dans la table "bonbon"
        $sql = "INSERT INTO bonbon (nom, couleur, box) VALUES (:nom, :couleur, :box)";
        $query = $db->prepare($sql); // Préparation de la requête SQL (injection SQL (protection))

        // Liaison des valeurs des paramètres avec les variables
        $query->bindValue(":nom", $nom);
        $query->bindValue(":couleur", $couleur);
        $query->bindValue(":box", $box);

        // Exécution de la requête SQL pour insérer les données
        $query->execute();

        // Fermeture de la connexion à la base de données en incluant le fichier close.php
        require_once("close.php");

        // Redirection vers la page index.php après l'insertion des données
        header("Location: index.php");
        exit(); // Arrête l'exécution du script après la redirection
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ajouter des bonbons</title>
</head>
<body>
    <h1>Ajouter des bonbons</h1>
    <form method="post">
        <div>
            <label for="nom">Nom du bonbon</label>
            <input type="text" name="nom" required>

            <label for="couleur">Couleur du bonbon</label>
            <input type="text" name="couleur" required>

            <label for="box">La boite du bonbon</label>

            <input type="radio" name="box" id="box" value="sachet" required>
            <label for="box">Sachet</label>
            
            <input type="radio" name="box" id="box" value="moyenne" required>
            <label for="box">Moyenne boite</label>
            
            <input type="radio" name="box" id="box" value="grosse" required>
            <label for="box">Grosse boite</label>
            <input type="submit" value="send"></input>
        </div>
    </form>
</body>
</html>