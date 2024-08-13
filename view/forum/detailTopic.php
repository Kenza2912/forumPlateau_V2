<?php
    $posts = $result["data"]['posts'];
    $topic = $result["data"]['topic']; 
?>

<div class="uk-container uk-margin-large-top">
    <div class="uk-card uk-card-default uk-card-body uk-margin-large-top">
        <h3 class="uk-card-title">Sujet: <?= $topic->getTitle() ?></h3>
    </div>

    <ul class="uk-comment-list uk-margin-large-top">
        <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $post): ?>
                <li>
                    <article class="uk-comment uk-visible-toggle">
                        <header class="uk-comment-header uk-position-relative">
                            <div class="uk-grid-medium uk-flex-middle" uk-grid>
                              
                                <div class="uk-width-expand">
                                    <h4 class="uk-comment-title uk-margin-remove">
                                        <?= $post->getUser()->getNickName() ?>
                                    </h4>
                                    <p class="uk-comment-meta uk-margin-remove-top">Posté le <?= $post->getCreationDate() ?></p>
                                </div>
                            </div>
                            <?php if (App\SESSION::getUser() == $post->getUser()): ?>
                                <div class="uk-position-top-right uk-position-small uk-hidden-hover">
                                    <a href="index.php?ctrl=forum&action=updatePostForm&id=<?= $post->getId() ?>" class="uk-icon-button" uk-icon="pencil"></a>
                                    <a href="index.php?ctrl=forum&action=deletePost&id=<?= $post->getId() ?>" class="uk-icon-button uk-text-danger" uk-icon="trash"></a>
                                </div>
                            <?php endif; ?>
                        </header>
                        <div class="uk-comment-body">
                            <p><?= $post->getContent() ?></p>
                        </div>
                    </article>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Aucun post disponible.</li>
        <?php endif; ?>
    </ul>

    <!-- Formulaire pour rajouter un nouveau post -->
    <form class="uk-form-stacked uk-margin-large-top" action="index.php?ctrl=forum&action=addPostByTopic&id=<?= $topic->getId() ?>" method="POST">
        <div class="uk-margin">
            <label class="uk-form-label" for="content">Ajouter un commentaire :</label>
            <div class="uk-form-controls">
                <textarea class="uk-textarea" id="content" name="content" rows="5" placeholder="Votre commentaire..." required></textarea>
            </div>
        </div>
        <div class="uk-margin">
            <button class="uk-button uk-button-primary uk-width-1-1" name="submit" type="submit">Ajouter un nouveau post</button>
        </div>
    </form> 
</div>
