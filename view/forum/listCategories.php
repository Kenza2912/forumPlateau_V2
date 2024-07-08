<?php
    $categories = $result["data"]['categories']; 
?>

<h1>Liste des catégories</h1>

<?php
foreach($categories as $category ){ ?>
    <p><a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getNameCategory() ?></a></p>
<?php }
    ?>



<!-- Pour rajouter une nouvelle catégorie à la base de données -->
  
<form  action="index.php?ctrl=forum&action=addCategory" method="post">
<p>
    <label>
        Nom de la catégorie 
        <input type="text" name="name">
    </label>
</p>

<p>         
    <input id="submit" class="uk-button uk-button-secondary uk-width-1-1" type="submit" name="submit" >
</p>
</form>