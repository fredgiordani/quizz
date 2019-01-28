<?php

    require_once("header.php")

?>

<?php

    $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
    // On récupère tous les résultats en tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

    $prepare = $objectPdo->prepare('SELECT id FROM categorie WHERE categorie = :categorie');

    $prepare->bindvalue(":categorie", $_GET["categorie"], PDO::PARAM_STR);

    $prepare->execute();

    $categorie = $prepare->fetch();

    // var_dump($categorie);

    $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
    // On récupère tous les résultats en tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

    $prepare = $objectPdo->prepare('SELECT * FROM questionnaire WHERE id_categorie = :id_categorie'  );
    $prepare->bindvalue(":id_categorie", $categorie['id'], PDO::PARAM_INT);
    
    $prepare->execute();

    $questionnaires = $prepare->fetchAll();

    // var_dump($questionnaires);
    // var_dump(count($questionnaires));
?>

<div class="container">
    <h1>choissisez votre quizz</h1>
</div>

<?php

        foreach($questionnaires as $questionnaire){ ?>
            <a href="quizz.php?id_questionnaire=<?= $questionnaire["id"] ?>" class="btn btn-primary"><?= $questionnaire["nom"]  ?></a>


        <?php }

?>


<?php

    require_once("footer.php")

?>