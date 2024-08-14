<?php
    $categories = $result["data"]['categories'];
?>

<h2 class="uk-heading-line uk-text-center"><span>Liste des catégories</span></h2>

<div class="uk-child-width-1-3@m uk-grid-small uk-grid-match uk-margin-large-top" uk-grid>
    <?php foreach($categories as $category): ?>
        <div>
            <div class="uk-card uk-card-hover uk-box-shadow-medium uk-transition-toggle category-card" 
                 style="background-image: url('./public/image/<?= $category->getAffiche() ?>');">
                <div class="uk-overlay uk-overlay-primary uk-position-cover uk-flex uk-flex-center uk-flex-middle">
                    <h3 class="uk-card-title uk-text-center uk-light"><?= $category->getNameCategory() ?></h3>
                </div>
                <div class="uk-card-body uk-text-center">
                    <a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>" class="uk-button uk-button-text">Voir les sujets</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>




<!-- Formulaire pour ajouter une nouvelle catégorie -->

<h2 class="uk-heading-line uk-text-center"><span>Ajouter une catégorie</span></h2>
<div class="uk-flex uk-flex-center uk-flex-middle">
<form action="index.php?ctrl=forum&action=addCategory" method="post" enctype="multipart/form-data" class="uk-form-stacked uk-margin-large-top ">
    <div class="uk-margin">
        <label class="uk-form-label" for="nameCategory">Nom de la catégorie</label>
        <div class="uk-form-controls">
            <input class="uk-input uk-form-width-medium" type="text" id="nameCategory" name="nameCategory" placeholder="Nom de la catégorie" required>
        </div>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="affiche">Image de la catégorie</label>
        <div class="uk-form-controls">
            <div uk-form-custom="target: true">
                <input type="file" id="affiche" name="affiche" required>
                <input class="uk-input uk-form-width-medium" type="text" placeholder="Choisir un fichier" disabled>
            </div>
        </div>
    </div>

    <div class="uk-margin">
        <button id="submit" class="uk-button uk-button-secondary uk-width-1-1" type="submit" name="submit">Ajouter la catégorie</button>
    </div>
</form>
</div>