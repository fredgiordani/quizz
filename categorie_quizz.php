<?php

$objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
    // On récupère tous les résultats en tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

    $prepare = $objectPdo->prepare('SELECT * FROM categorie');

    $prepare->execute();

    $categories = $prepare->fetchAll();

    // var_dump($categories);

?>

<?php

require_once("header.php");

?>

<?php 

foreach ($categories as $categorie) {?>

<a href="choice
_quizz.php?categorie=<?= $categorie["categorie"] ?>" class="btn btn-primary bg-primary"><?= $categorie["categorie"] ?></a>
<?php }

?>


<?php

require_once("footer.php");

?>