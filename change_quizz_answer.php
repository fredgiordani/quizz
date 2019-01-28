<?php

require_once('header.php');

?>

<?php

    $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
    // On récupère tous les résultats en tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

    $prepare = $objectPdo->prepare('SELECT * FROM questions WHERE id = :id_question' );

    $prepare->bindvalue(":id_question", $_GET["id_question"], PDO::PARAM_INT);
    
    $prepare->execute();

    $question = $prepare->fetch();

    // var_dump($question);

    


    $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
    // On récupère tous les résultats en tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

    $prepare = $objectPdo->prepare('SELECT * FROM reponses WHERE id = :id_reponse' );

    $prepare->bindvalue(":id_reponse", $_GET["id_reponse"], PDO::PARAM_INT);
    
    $prepare->execute();

    $reponse = $prepare->fetch();

    // var_dump($reponse);
?>

<?php

    if(isset($_POST) && !empty($_POST)){

        if(isset($_POST['good_answer']) && $_POST['good_answer'] === "true"){
            $_POST['good_answer'] = true;
        }else{
            $_POST['good_answer'] = false; 
        }
        
        $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
        // On récupère tous les résultats en tableau associatif
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

        $prepare = $objectPdo->prepare('UPDATE reponses SET reponse = :reponse, valide = :valide ,id_question = :id_question WHERE id = :id_reponse');
        
         

        $prepare->bindvalue(":reponse", $_POST['reponse'], PDO::PARAM_STR);
        $prepare->bindvalue(":valide", $_POST['good_answer'], PDO::PARAM_BOOL);
        $prepare->bindvalue(":id_question", $_GET['id_question'], PDO::PARAM_INT);
        $prepare->bindvalue(":id_reponse", $_GET['id_reponse'], PDO::PARAM_INT);

        $execute = $prepare->execute();

        if($execute){
            $message = "modification effectuée";
        }else{
            $message = "erreur";
        }
    }

?>
<form action method="POST">
  <div class="form-group">
    <label for="question"><?= $question['question'] ?></label><br>
    <label for="proposition">proposition de réponse numéro <?= $reponse['id'] ?></label>
    <input type="text" name="reponse" class="form-control" placeholder="nouvelle propostion">
    <div class="container">
    
    <?php if(isset($message)){
        echo $message; 
    } ?>
    
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="good_answer" value='true' >
        <label class="form-check-label mt-3 mb-3" for="defaultCheck1">bonne réponse</label>
    </div>
    
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>




<?php

require_once('footer.php');

?>

