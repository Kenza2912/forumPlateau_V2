<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics'];
?>

<div class="category-background">
   

    <img src="./public/image/<?= $category->getAffiche() ?>" alt="Image de la catégorie" class="background-image">

    <h2 class="uk-heading-line uk-text-center"><span>Liste des sujets dans <?= $category->getNameCategory() ?></span></h2>

    <div class="uk-margin-large-top">
        <ul class="uk-list uk-list-striped">
            <?php foreach($topics as $topic): ?>
                <li>
                    <div class="uk-card uk-card-default uk-card-body uk-card-hover">
                        <h3 class="uk-card-title">
                            <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>" class="uk-link-heading">
                                <?= $topic->getTitle() ?>
                            </a>
                        </h3>
                        <p class="uk-text-meta">
                            Par <?= $topic->getUser() ?> 
                            <?php if(App\SESSION::getUser() == $topic->getUser()): ?>
                                | <a href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>" class="uk-text-danger">Supprimer</a>
                            <?php endif; ?>
                        </p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Formulaire pour rajouter un nouveau topic -->
    <h2 class="uk-heading-line uk-text-center uk-margin-large-top"><span>Ajouter un sujet</span></h2>

    <form action="index.php?ctrl=forum&action=addTopicByCategory&id=<?= $category->getId() ?>" method="POST" class="uk-form-stacked uk-margin-large-top uk-width-1-2@m uk-align-center">
        <div class="uk-margin">
            <label class="uk-form-label" for="title">Titre :</label>
            <div class="uk-form-controls">
                <input class="uk-input" type="text" id="title" name="title" placeholder="Titre du sujet" required>
            </div>
        </div>
        <div class="uk-margin">
            <label class="uk-form-label" for="content">Résumé :</label>
            <div class="uk-form-controls">
                <textarea class="uk-textarea" id="content" name="content" rows="5" placeholder="Résumé du sujet" required></textarea>
            </div>
        </div>
        <div class="uk-margin">
            <button class="uk-button uk-button-primary uk-width-1-1" name="submit" type="submit">Ajouter un nouveau topic</button>
        </div>
    </form>
</div>
