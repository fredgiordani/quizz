<?php

    require_once('header.php');

?>

<?php

    $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
    // On récupère tous les résultats en tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

    $prepare = $objectPdo->prepare('SELECT * FROM questionnaire' );
    
    $prepare->execute();

    $questionnaires = $prepare->fetchAll();

    var_dump($questionnaires);
?>




    
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">quizz</th>
    </tr>
  </thead>
  <tbody>
<?php

    

    foreach ($questionnaires as $questionnaire) {  ?>
    <tr>
      <th scope="row">1</th>
      <td><?= $questionnaire['nom'] ?></td>
      <td><a href="change_quizz_name.php?id_questionnaire=<?= $questionnaire['id'] ?>&amp;nom=<?= $questionnaire['nom'] ?>">modifier nom</a></td>
      <td><a href="change_quizz_questions.php?id_questionnaire=<?= $questionnaire['id'] ?>">modifier question(s)</a></td>
      <td><a href="change_quizz_answers.php?id_questionnaire=<?= $questionnaire['id'] ?>">modifier réponse(s)</a></td>
      <td><a href="delete_quizz.php?id_questionnaire=<?= $questionnaire['id'] ?>">supprimer</a></td>

    </tr>
      <?php    
    }
?>
  </tbody>
</table>

  




<?php

    require_once('footer.php');

?>