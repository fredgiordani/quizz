<?php

require_once("header.php");

?>

<?php

    var_dump($_POST);

    $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
    // On récupère tous les résultats en tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

    



    $prepare = $objectPdo->prepare('SELECT questions.id, questions.question, questions.points, reponses.id,reponses.reponse,reponses.valide,reponses.id_question
    FROM questions
    INNER JOIN reponses ON questions.id = reponses.id_question WHERE reponses.id_questionnaire = :id_questionnaire' );
    
    $prepare->bindvalue(':id_questionnaire', $_GET['id_questionnaire'], PDO::PARAM_INT);

    $prepare->execute();

    $jointures = $prepare->fetchAll();

    var_dump($jointures);

?>

<form action="result.php?id_questionnaire=<?=  $_GET['id_questionnaire'] ?>" method="POST">
<?php

$question = "";
$reponse = "";

foreach ($jointures as $jointure) {

    if($question !== $jointure['question']){
        $question = $jointure['question'];
        echo '<div class="container bg-primary question">'.$jointure["question"].'</div>';
    }

    if($reponse !== $jointure['reponse']){
        $reponse = $jointure['reponse'];
        echo '<div class="form-check">
        <input class="form-check-input" type="radio" name='.'"'.$jointure["id_question"].'"'.'value='.'"'.$jointure["id"].'"'.' >
        <label class="form-check-label" for="reponse1">'.
          $reponse
        .'</label>
      </div>';
    }
    
}

?>

<button class="btn btn-primary">valider</button>

</form>


<?php

require_once("footer.php");

?>