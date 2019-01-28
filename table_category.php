<?php

    require_once('header.php');

?>

<?php

    $objectPdo = new PDO("mysql:host=localhost;dbname=quizz","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
    // On récupère tous les résultats en tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

    $prepare = $objectPdo->prepare('SELECT * FROM categorie' );
    
    $prepare->execute();

    $categories = $prepare->fetchAll();

    var_dump($categories);
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

    

    foreach ($categories as $categorie) {  ?>
    <tr>
      <th scope="row">1</th>
      <td><?= $categorie['categorie'] ?></td>
      <td><a href="add_categorie.php">ajouter</a></td>
      <td><a href="delete_categorie.php?id_categorie=<?= $categorie['id'] ?>">supprimer</a></td>

    </tr>
      <?php    
    }
?>
  </tbody>
</table>

 




<?php

    require_once('footer.php');

?>