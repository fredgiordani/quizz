<?php

    require_once("header.php");

?>

<?php 

    var_dump($_POST);
    if(isset($_POST['nom']) && !empty($_POST['nom'])){

        $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
        // On récupère tous les résultats en tableau associatif
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

        $prepare = $objectPdo->prepare('UPDATE questionnaire SET nom = :nom WHERE id = :id_questionnaire');

        $prepare->bindvalue(":nom", $_POST['nom'], PDO::PARAM_STR);
        $prepare->bindvalue(":id_questionnaire", $_GET['id_questionnaire'], PDO::PARAM_INT);
        
        $execute = $prepare->execute();

        if($execute){
            $message = "modification effectuée";
        }else{
            $message = "erreur";
        }
 } 
?>


<form action="" method="POST">

    <div class="container">

        <h4>nom actuel du quizz: <?= $_GET['nom'] ?></h4>
    
    </div>


    <div class="form-group">
    
        <label class="form-check-label mt-3 mb-3" for="nom">Nouveau nom</label>
        <input type="text" name="nom" class="form-control" placeholder="nouveau nom ">
        <div class="container"><?php if(isset($message)){ echo $message; } ?></div>
    
  </div>

  <button type="submit" class="btn btn-primary">confirmer</button>

</form>

<?php

    require_once("footer.php");

?>