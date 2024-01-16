<?php

session_start();



// Le POST il cherche le formulaire qui est lui-même en POST (<form method="post">) il récupère les infos qui ont été submit via le bouton
// Le GET il sert à afficher les données 


// Vérifie si dans $_POST si il y a bien le nom, la couleur et le box qui existe
if ($_POST) {
    if(isset($_POST['nom']) && isset($_POST['couleur']) && ($_POST['box']))
    {

        require_once('connect.php');

        $id = strip_tags($_POST['id']);
        $nom = strip_tags($_POST['nom']);
        $couleur = strip_tags($_POST['couleur']);
        $box = strip_tags($_POST['box']);

        $sql = "UPDATE bonbon SET nom=:nom, couleur=:couleur, box=:box WHERE id=:id";
        $query = $db->prepare($sql);

        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->bindValue(":nom", $nom);
        $query->bindValue(":couleur", $couleur);
        $query->bindValue(":box", $box);
        
        $query->execute();

        require_once("close.php");

        $_SESSION['nom_apres_modification'] = $nom; // où $nom est la nouvelle valeur du nom du bonbon
        


        header("Location: index.php");


    }

};

// Vérifie si dans $_GET si il y a bien le nom, la couleur et le box qui existe

if (isset($_GET['id']) && !empty($_GET['id'])) {

    require_once('connect.php');

    $id = strip_tags($_GET['id']);

    $sql = "SELECT * FROM bonbon WHERE id=:id";
    $query = $db->prepare($sql);

    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();

    $result = $query->fetch();
    echo "<pre>";
    print_r($result);
    echo "</pre>";

    require_once("close.php");

    
    $_SESSION['update_confirm'] = "valid";
    $_SESSION['nom_du_bonbon'] = $result[1];


}else{
    header("Location: index.php");
};

// $_SESSION['add_confirm'] = "confirm";
// $_SESSION['stagiaire_nom'] = $result[1] .' ' . $result[2];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Modifier</title>
</head>

<body>

    <form method="post">
        <div>
            <label for="nom">Nom</label>
            <input type="text" name="nom" value="<?= $result['nom'] ?>" required>

            <label for="couleur">Couleur</label>
            <input type="text" name="couleur" value="<?= $result['couleur'] ?>" required>

            <input type="radio" name="box" id="sachet" value="sachet" <?= ($result['box'] === 'sachet') ? 'checked' : '' ?> required>
            <label for="sachet">Sachet</label>

            <input type="radio" name="box" id="moyenne" value="moyenne" <?= ($result['box'] === 'moyenne') ? 'checked' : '' ?> required>
            <label for="moyenne">Moyenne boite</label>

            <input type="radio" name="box" id="grosse" value="grosse" <?= ($result['box'] === 'grosse') ? 'checked' : '' ?> required>
            <label for="grosse">Grosse boite</label>


            <input type="hidden" name="id" value="<?= $result['id'] ?>">
            <input type="submit" value="modifier"></input>
        </div>
    </form>
</body>

</html>