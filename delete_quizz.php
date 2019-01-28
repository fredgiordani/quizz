<?php

    require_once("header.php");

?>

<?php

    $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
    // On récupère tous les résultats en tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

    $prepare = $objectPdo->prepare('SELECT id FROM questions
     WHERE id_questionnaire = :id_questionnaire' );
    
    $prepare->bindvalue(':id_questionnaire', $_GET['id_questionnaire'], PDO::PARAM_INT);

    $prepare->execute();

    $id_questions = $prepare->fetchAll();

    

    foreach ($id_questions as $id_question) {

        
        
        $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
        // On récupère tous les résultats en tableau associatif
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);
    
        $prepare = $objectPdo->prepare('DELETE  FROM reponses
         WHERE id_question = :id_question ' );

        $prepare->bindvalue(":id_question", $id_question['id'], PDO::PARAM_INT);

        $prepare->execute();
    }


    foreach ($id_questions as $id_question) {

        $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
        // On récupère tous les résultats en tableau associatif
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

        $prepare = $objectPdo->prepare('DELETE  FROM questions
         WHERE id = :id_question' );

        $prepare->bindvalue(":id_question", $id_question['id'], PDO::PARAM_INT);

        $prepare->execute();
    }

    $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
    // On récupère tous les résultats en tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

    $prepare = $objectPdo->prepare('DELETE  FROM questionnaire
     WHERE id = :id_questionnaire' );

    $prepare->bindvalue(":id_questionnaire", $_GET["id_questionnaire"], PDO::PARAM_INT);

    $prepare->execute();


?>

<?php

    require_once("footer.php");

?>