<?php

require_once("header.php");

?>

<?php

$score = 0;
$answer = 0;



$objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
// On récupère tous les résultats en tableau associatif
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

$prepare = $objectPdo->prepare('SELECT questions.id, questions.question, questions.points, reponses.id,reponses.reponse,reponses.valide,reponses.id_question
FROM questions
INNER JOIN reponses ON questions.id = reponses.id_question WHERE valide= :true AND reponses.id_questionnaire = :id_questionnaire' );


$prepare->bindvalue(':true', true, PDO::PARAM_BOOL);
$prepare->bindvalue(':id_questionnaire', $_GET['id_questionnaire'], PDO::PARAM_INT);
$prepare->execute();
$jointures = $prepare->fetchAll();



foreach ($jointures as $jointure) {
    $id = $jointure['id_question'];
    echo $_POST[$id]."   ";
    echo $jointure['id']."   ";

    if( $jointure['id'] === $_POST[$id] ){
        echo "égalité";
        $score += $jointure['points'];
        $answer += 1;
        echo $score."   ";
    }else{
        echo "erreur";
    }
}







    


echo '<div class="container bg-primary"> vous avez repondu correctement à '.$answer.' question. </div><br>';
echo '<div class="container bg-primary"> votre score est de:  '.$score.' points';

?>


<?php

require_once("footer.php");

?>