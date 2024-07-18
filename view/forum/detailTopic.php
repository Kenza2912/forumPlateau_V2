<?php
  
    $posts = $result["data"]['posts'];
    $topic = $result["data"]['topic']; 
    // var_dump($posts);
    // var_dump($topic);
?>

<h1>Liste post par topic</h1>


<p>title : <?= $topic->getTitle() ?></p>



<p>
<?php if(!empty($posts)):?>
    <?php foreach($posts as $post): ?>
        <!-- si l'auteur du post correpond au user en session  -->
        Post :<?= $post->getContent() ?> <br>
       <?php  if(App\SESSION::getUser()==$post->getUser()){?>

        <a href="index.php?ctrl=forum&action=updatePostForm&id=<?=$post->getId()?>">Modifier</a>
       <a href="index.php?ctrl=forum&action=deletePost&id=<?= $post->getId() ?>">Supprimer</a><br>
        
        <?php } endforeach; ?>
    <?php else: ?>
        Aucun post disponible.
    <?php endif; ?>
   
</p>



<!-- Formulaire pour rajouter un nouveau post à la base de données -->
  
<form  action="index.php?ctrl=forum&action=addPostByTopic&id=<?=$topic->getId()?>" method="POST">

    <div class="uk-margin">
        <label class="uk-form-label" for="content">Résumé :</label>
            <div class="uk-form-controls">
                <textarea class="uk-textarea" id="content" name="content" rows="5" required></textarea>
            </div>
    </div>
    <div class="uk-margin">
        <button class="uk-button uk-button-primary" name="submit" type="submit">Ajouter un nouveau post</button>
    </div>
</form> 





    
