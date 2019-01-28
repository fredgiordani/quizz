<?php 

    require_once("header.php"); 

?>

<?php



    $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
    // On récupère tous les résultats en tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

    $prepare = $objectPdo->prepare('SELECT id,question FROM questions WHERE id_questionnaire = :id_questionnaire' );

    $prepare->bindvalue(":id_questionnaire", $_GET["id_questionnaire"], PDO::PARAM_INT);
    
    $prepare->execute();

    $questions = $prepare->fetchAll();

    var_dump($questions);
?>

<?php

        foreach ($questions as $question) { ?>

<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col"><?= $question['question'] ?></th>
      
    </tr>
  </thead>
  <tbody>
        <?php 
        
        $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
        // On récupère tous les résultats en tableau associatif
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);
    
        $prepare = $objectPdo->prepare('SELECT * FROM reponses WHERE id_question = :id_question' );
    
        $prepare->bindvalue(":id_question", $question['id'], PDO::PARAM_INT);
        
        $prepare->execute();
    
        $reponses = $prepare->fetchAll();
    
        var_dump($reponses);
        
        
        
        foreach ($reponses as $reponse) { ?>
            
        
    <tr>
    
      <th scope="row">1</th>
      <td><?= $reponse['reponse'] ?></td>
      <td><a href="change_quizz_answer.php?id_question=<?= $question['id'] ?>&amp;id_reponse=<?= $reponse['id'] ?>">modifier réponse(s)</a></td>
      
    </tr>
    <?php } ?>
  </tbody>
</table>

    <?php        
        }

?>

<?php 

    require_once("footer.php"); 

?>