<?php

    require_once("header.php");

?>
<?php

$objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
// On récupère tous les résultats en tableau associatif
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

$prepare = $objectPdo->prepare('SELECT id FROM questionnaire WHERE id_categorie = :id_categorie');
$prepare->bindvalue(":id_categorie", $_GET["id_categorie"], PDO::PARAM_INT);
$prepare->execute();

$id_questionnaire = $prepare->fetch();

var_dump($id_questionnaire);

echo $id_questionnaire['id'];

$objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
// On récupère tous les résultats en tableau associatif
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

$prepare = $objectPdo->prepare('SELECT id FROM questions WHERE id_questionnaire = :id_questionnaire');
$prepare->bindvalue(":id_questionnaire", $id_questionnaire["id"], PDO::PARAM_INT);
$prepare->execute();

$id_questions = $prepare->fetchAll();

var_dump($id_questions);

foreach ($id_questions as $id_question) {
    # code...

$objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
// On récupère tous les résultats en tableau associatif
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

$prepare = $objectPdo->prepare('DELETE  FROM reponses WHERE id_question = :id_question');
$prepare->bindvalue(":id_question", $id_question["id"], PDO::PARAM_INT);
$prepare->execute();


}

$objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
// On récupère tous les résultats en tableau associatif
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

$prepare = $objectPdo->prepare('DELETE  FROM questions WHERE id_questionnaire = :id_questionnaire');
$prepare->bindvalue(":id_questionnaire", $id_questionnaire["id"], PDO::PARAM_INT);
$prepare->execute();

$objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
// On récupère tous les résultats en tableau associatif
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

$prepare = $objectPdo->prepare('DELETE  FROM questionnaire WHERE id_categorie = :id_categorie');
$prepare->bindvalue(":id_categorie", $_GET["id_categorie"], PDO::PARAM_INT);
$prepare->execute();

$objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
// On récupère tous les résultats en tableau associatif
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

$prepare = $objectPdo->prepare('DELETE  FROM categorie WHERE id = :id_categorie');
$prepare->bindvalue(":id_categorie", $_GET["id_categorie"], PDO::PARAM_INT);
$prepare->execute();

?>

<?php

require_once("footer.php");

?>