<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics</h1>

<?php
foreach($topics as $topic ){ ?>
    <p><a href="index.php?ctrl=forum&action=listTopicByCategory&id><?= $topic->getId() ?>"><?=$topic->getTitle()?></a> par <?= $topic->getUser() ?></p>
<?php } ?>



<!-- Formulaire pour rajouter un nouveau topic à la base de données -->
 

 <form action="index.php?ctrl=forum&action=addTopicByCategory&id=<?=$category->getId()?>" method="POST">
    <div class="uk-margin">
            <label class="uk-form-label" for="title">Titre :</label>
                <div class="uk-form-controls">
                    <input class="uk-input" type="text" id="title" name="title" required>
                </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="content">Résumé :</label>
            <div class="uk-form-controls">
                <textarea class="uk-textarea" id="content" name="content" rows="5" required></textarea>
            </div>
    </div>
    <div class="uk-margin">
        <button class="uk-button uk-button-primary" name="submit" type="submit">Ajouter un nouveau topic</button>
    </div>
</form>    

  

