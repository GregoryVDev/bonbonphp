<?php

session_start();

require_once("connect.php");

// Étape 1 : Créer la requête SQL

$sql = "SELECT * FROM bonbon";
// Cette ligne de code crée une requête SQL qui sélectionne toutes les lignes de la table stagiaire.

// Étape 2 : Préparer la requête SQL

$query = $db->prepare($sql);
// Cette ligne de code prépare la requête SQL pour l'exécution. Cela signifie que la base de données analysera la requête et vérifiera les erreurs.

// Étape 3 : Exécuter la requête SQL

$query->execute();
// Cette ligne de code exécute la requête SQL préparée. Cela permettra de récupérer toutes les lignes de la table stagiaire et de les stocker dans un objet de résultat.

// Étape 4 : Récupérer les résultats de la requête SQL

$result = $query->fetchAll(PDO::FETCH_ASSOC);
// Cette ligne de code récupère toutes les lignes de l'objet de résultat et les stocke dans un tableau associatif. Le drapeau PDO::FETCH_ASSOC indique à PHP de récupérer les lignes sous forme de tableaux associatifs, où les clés sont les noms des colonnes et les valeurs sont les valeurs des colonnes.

// Ce code php me donne une variable qui s'appelle $result et qui contient toutes les données de la table selectionné via select * from xxx, sous forme de tableau 

// Le echo "<pre>" permet de présenter le print_r plus proprement et le print_r sert à faire un test des valeurs $

// echo "<pre>";
// print_r($result[0]);
// print_r($result[1]['couleur']);
// print_r($result[2]['box']);
// echo "</pre>";

// print_r($_SESSION);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Bonbons</title>
</head>
<body>
    <h1>Les bons bonbons</h1>

    <!-- if (condition) : ?> -->
    <!-- Code HTML à exécuter si la condition est vraie -->
    <!-- endif; ?> -->

    <!-- Cela vérifie si la variable de session 'delete_confirm' existe et si sa valeur est 'true'.
        Si cette condition est vraie, alors le code entre php et endif; est exécuté: -->
    <?php if (isset($_SESSION['delete_confirm']) && $_SESSION['delete_confirm'] === true) : ?>
    <!-- Cela affiche un message indiquant que le bonbon avec l'identifiant stocké dans 'bonbon_name' a été supprimé. -->
    <div><p>Le bonbon <?= $_SESSION['bonbon_name'] ?> a été supprimé </p></div>
    <!-- Cela supprime la variable de session 'delete_confirm'. -->
    <?php unset($_SESSION['delete_confirm']); ?>
    <?php endif; ?>



    <table>
        <thead>
            <th>ID</th>
            <th>Nom</th>
            <th>Couleur</th>
            <th>Box</th>
        </thead>
        <?php foreach($result as $bonbon): ?>
        <tbody>
            <tr>
                <td><?= $bonbon['id'] ?></td>
                <td><?= $bonbon['nom'] ?></td>
                <!-- Une autre façon plus simple d'écrire le php dans le html -->
                <td><?= $bonbon['couleur'] ?></td>
                <td><?= $bonbon['box'] ?></td>
                <td>
                    <a href="show.php?id=<?= $bonbon["id"] ?>">Voir</a>
                    <a href="edit.php?id=<?= $bonbon["id"] ?>">Modifier</a>
                    <a href="delete.php?id=<?= $bonbon["id"] ?>">Supprimer</a>
                </td>
            </tr>
        </tbody>
        <?php endforeach; ?>
    </table>
    <a href="add.php">Ajouter</a>
</body>
</html>