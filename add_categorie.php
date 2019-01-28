<?php

    require_once("header.php");

?>

<?php 

if(isset($_POST) && !empty($_POST['categorie'])){
    var_dump($_POST);

    $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
    // On récupère tous les résultats en tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);
    
    $prepare = $objectPdo->prepare('INSERT INTO categorie VALUES(NULL, :categorie)');
    $prepare->bindvalue(":categorie", $_POST['categorie'], PDO::PARAM_STR);
    $prepare->execute();
}

?>
<form action="" method="POST">
  
  <div class="form-group">
    <label for="exampleInputPassword1">ajoutez une categorie</label>
    <input type="text" class="form-control" name="categorie" id="exampleInputPassword1" >
  </div>
  
  <button type="submit" class="btn btn-primary">valider</button>
</form>

<?php

require_once("footer.php");

?>