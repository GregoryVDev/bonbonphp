<?php 

// Vérifier si quelque chose est passé via la méthode GET et si 'id' existe et n'est pas vide
if(isset($_GET['id']) && !empty($_GET['id'])){

    // Inclure le fichier de connexion à la base de données
    require_once('connect.php');

    // Récupérer et nettoyer la valeur de 'id' de la requête GET
    $id = strip_tags($_GET['id']);
    
    // Requête SQL pour sélectionner toutes les colonnes de la table 'bonbon' où l'ID correspond à celui fourni
    $sql = 'SELECT * FROM bonbon WHERE id=:id';
    $query = $db->prepare($sql);

    // Attribuer une valeur sécurisée à l'ID dans la requête préparée pour éviter les injections SQL
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    // echo "<pre>";
    // print_r($query);
    // echo "</pre>";

    // Récupérer tous les résultats de la requête sous forme de tableau
    $result = $query->fetch();
    // echo "<pre>";
    // print_r($result);
    // echo "</pre>";

    if(!$result){
        header('Location:index.php');

    }
    // Supprimer un ID qui correspond au lien qui a été cliqué
    $sql = 'DELETE FROM bonbon WHERE id=:id';
    $query = $db->prepare($sql);

    // Attribuer une valeur sécurisée à l'ID dans la requête préparée pour éviter les injections SQL
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();

    require_once('close.php');

    header('Location:index.php');
}else{
    header('Location:index.php');
}

?>
