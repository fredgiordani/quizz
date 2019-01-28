<?php

require_once("header.php");

?>

<?php

$objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
    // On récupère tous les résultats en tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

    $prepare = $objectPdo->prepare('SELECT * FROM categorie');

    $prepare->execute();

    $categories = $prepare->fetchAll();

    // var_dump($categories);

    if(isset($_POST) && !empty($_POST)){

        // requete qui recupère l'id de la categorie choisi
        $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
        // On récupère tous les résultats en tableau associatif
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);
    
        $prepare = $objectPdo->prepare('SELECT id FROM categorie WHERE categorie = :categorie');
    
        $prepare->bindvalue(":categorie", $_POST['categorie'], PDO::PARAM_STR);
    
        $prepare->execute();
    
        $id_categorie = $prepare->fetch();
    
        // var_dump($id_categorie);

        $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
        // On récupère tous les résultats en tableau associatif
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);
        
        $prepare = $objectPdo->prepare('SELECT COUNT(*) FROM questionnaire WHERE nom = :nom');
        $prepare->bindvalue(':nom', $_POST["nom"], PDO::PARAM_STR);
        
        
        $prepare->execute();

        $count = $prepare->fetch();
        
        // requete qui insere dans la table questionnaire le nom du questionnaire plus l'id de la catégorie

        if($count['COUNT(*)'] === '0'){

            $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
            // On récupère tous les résultats en tableau associatif
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

            $prepare = $objectPdo->prepare('INSERT INTO questionnaire VALUES(NULL, :nom, :id_categorie)');

            $prepare->bindvalue(":nom", $_POST['nom'], PDO::PARAM_STR);
            $prepare->bindvalue(":id_categorie", $id_categorie['id'], PDO::PARAM_INT);
            
            $prepare->execute();

        }


        // requete qui recupere l'id du questionnaire
        $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
        // On récupère tous les résultats en tableau associatif
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);
    
        $prepare = $objectPdo->prepare('SELECT * FROM questionnaire WHERE nom = :nom');
    
        $prepare->bindvalue(":nom", $_POST['nom'], PDO::PARAM_STR);
    
        $prepare->execute();
    
        $id_questionnaire = $prepare->fetch();

        // var_dump($id_questionnaire);


        // requete qui insere dans la table question les champs questions,points,id_questionnaire
        $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
        // On récupère tous les résultats en tableau associatif
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

        $prepare = $objectPdo->prepare('INSERT INTO questions VALUES(NULL, :question, :points, :id_questionnaire, :id_categorie)');

        $prepare->bindvalue(":question", $_POST['question'], PDO::PARAM_STR);
        $prepare->bindvalue(":points", $_POST['points'], PDO::PARAM_INT);
        $prepare->bindvalue(":id_questionnaire", $id_questionnaire['id'], PDO::PARAM_INT);
        $prepare->bindvalue(":id_categorie", $id_categorie['id'], PDO::PARAM_INT);
        
        $prepare->execute();

        // requete qui recupere l'id de la question
        $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
        // On récupère tous les résultats en tableau associatif
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);
    
        $prepare = $objectPdo->prepare('SELECT id FROM questions WHERE question = :question AND id_questionnaire = :id_questionnaire '  );
            
        $prepare->bindvalue(":question", $_POST['question'], PDO::PARAM_STR);
        $prepare->bindvalue(":id_questionnaire", $id_questionnaire['id'], PDO::PARAM_INT);
    
        $prepare->execute();
    
        $id_question = $prepare->fetch();

        // var_dump($id_question);

        for ($i=1; $i < 5 ; $i++) { 
            
        if(isset($_POST['good_answer'.$i])){
            $_POST['good_answer'.$i] = true;
        }else{
            $_POST['good_answer'.$i] = false;
        }

        // requete qui insere dans la table reponses les champs reponse,valide,id_question
        $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
        // On récupère tous les résultats en tableau associatif
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

        $prepare = $objectPdo->prepare('INSERT INTO reponses VALUES(NULL, :reponse, :valide, :id_question, :id_questionnaire, :id_categorie)');

        $prepare->bindvalue(":reponse", $_POST['reponse'.$i], PDO::PARAM_STR);
        $prepare->bindvalue(":valide", $_POST['good_answer'.$i], PDO::PARAM_INT);
        $prepare->bindvalue(":id_question", $id_question['id'], PDO::PARAM_INT);
        $prepare->bindvalue(":id_questionnaire", $id_questionnaire['id'], PDO::PARAM_INT);
        $prepare->bindvalue(":id_categorie", $id_categorie['id'], PDO::PARAM_INT);
        
        $prepare->execute();

        
}











        


            






        }
?>



<form action="" method="POST">

      
        <?php if(isset($_POST["nom"]) && !empty($_POST["nom"]))

        {
            $_POST["nom"] = $_POST["nom"];
            
            echo '<label  for="nom">nom du quizz</label><p>'.$_POST["nom"].'</p><input hidden name="nom" value='.$_POST["nom"].' class="form-control " ></p><br><label  for="categorie">categorie du quizz</label><p>'.$_POST["categorie"].'</p><input hidden name="categorie" value='.$_POST["categorie"].' class="form-control " >';
            
            
        }
        ?>
    
    <?php if(isset($_POST) && empty($_POST['nom'])){?>
    <select name="categorie" class="form-control w-25">

        <option value="default">catégorie du quizz</option>
     <?php

        foreach ($categories as $categorie) { ?>

            <option value=<?= $categorie["categorie"] ?>><?= $categorie["categorie"] ?></option>

        <?php
        }

     ?>
    </select>
    <?php } ?>

    
        <?php if(isset($_POST) && empty($_POST['nom']))
        { echo '<div class="form-group">
            <label class="form-check-label mt-3 mb-3" for="nom">nom du quizz</label>
            <input type="text" name="nom" class="form-control" id="nom" placeholder="nom du quizz ">
            <div class="form-group">';
        }

  ?>




  <div class="form-group">
    
    <label class="form-check-label mt-3 mb-3" for="question">question</label>
    <input type="text" name="question" class="form-control" id="question" placeholder="question ">

    <label class="form-check-label mt-3 mb-3" for="points">nombre de points</label>
    <input type="text" name="points" class="form-control" id="points" placeholder="nombre de points">
    
  </div>

  <div class="form-group">
    
    <input type="text" name="reponse1" class="form-control" id="reponse1" placeholder="reponse 1">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="good_answer1" value='true' id="defaultCheck1">
        <label class="form-check-label mt-3 mb-3" for="defaultCheck1">bonne réponse</label>
    </div>

  </div>

  <div class="form-group">
    
    <input type="text" name="reponse2" class="form-control" id="reponse2" placeholder="reponse 2">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="good_answer2" value='true' id="defaultCheck1">
        <label class="form-check-label mt-3 mb-3" for="defaultCheck1">bonne réponse</label>
    </div>
        
  </div>

  <div class="form-group">
    
    <input type="text" name="reponse3" class="form-control" id="reponse3"  placeholder="reponse 3">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="good_answer3" value='true' id="defaultCheck1">
        <label class="form-check-label mt-3 mb-3" for="defaultCheck1">bonne réponse</label>
    </div>
        
  </div>

  <div class="form-group">
    
    <input type="text" name="reponse4" class="form-control" id="reponse4"  placeholder="reponse 4">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="good_answer4" value='true' id="defaultCheck1">
        <label class="form-check-label mt-3 mb-3" for="defaultCheck1">bonne réponse</label>
    </div>
        
  </div>

  
  <div class="container d-flex justify-content-around">
        <button type="submit" class="btn btn-primary">ajouter une question</button>

        <a href="index.php" class="btn btn-primary">fin du quizz</a>
  </div>

</form>













<?php

require_once("footer.php");

?>