<?php 

    require_once("header.php"); 

?>

<?php

    $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
    // On récupère tous les résultats en tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

    $prepare = $objectPdo->prepare('SELECT id,question FROM questions WHERE id_questionnaire = :id_questionnaire' );
    
    $prepare->bindvalue(':id_questionnaire', $_GET["id_questionnaire"], PDO::PARAM_INT);

    $prepare->execute();

    $questions = $prepare->fetchAll();

    var_dump($questions);
    
    var_dump($_POST);
    
    for ($i=0; $i < count($questions) ; $i++) {
        
    if(isset($_POST['question'.$i]) && !empty($_POST['question'.$i])){


        if($questions[$i]['question'] !== $_POST['question'.$i]){
            
            $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
            // On récupère tous les résultats en tableau associatif
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);
    
            $prepare = $objectPdo->prepare('UPDATE questions SET question = :question WHERE id = :id_question');
    
            $prepare->bindvalue(":question", $_POST['question'.$i], PDO::PARAM_STR);
            $prepare->bindvalue(":id_question", $questions[$i]['id'], PDO::PARAM_INT);
            $execute = $prepare->execute();

            if($execute){
                $message = "modification effectuée";
            }else{
                $message = "erreur";
            }

            }
        }
    }
?>

<form action="" method="POST">

    <?php

        for ($i=0; $i < count($questions) ; $i++) { ?>
            <div class="form_group">
                <label class="form-check-label mt-3 mb-3" for="nom">question <?= $i + 1 ?> : <?= $questions[$i]['question'] ?>
                </label>
                <input type="text" name="question<?= $i ?>" class="form-control" placeholder="nouvelle question ">
                <div class="container"><?php if(isset($message)){ echo $message; } ?></div>
            </div>
            
    <?php
        }

    ?>


  <button type="submit" class="btn btn-primary">confirmer</button>

</form>

<?php 

    require_once("footer.php"); 

?>