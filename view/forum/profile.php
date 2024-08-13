<?php
    $topics = $result['data']['topics'];
    $posts = $result['data']['posts'];
?>

<div class="uk-container uk-margin-large-top">
    <h2 class="uk-heading-line uk-text-center"><span>Bienvenu sur votre profil, <?= App\Session::getUser()->getNickName() ?></span></h2>

    <div class="uk-section uk-section-muted uk-padding">
        <h3 class="uk-heading-bullet">Vos topics</h3>
        <?php if(empty($topics)): ?>
            <p class="uk-text-warning">Vous n'avez pas de topic.</p>
        <?php else: ?>
            <ul class="uk-list uk-list-divider">
                <?php foreach($topics as $topic): ?>
                    <li class="uk-text-large">
                        <a href="index.php?ctrl=forum&action=detailTopic&id=<?= $topic->getId() ?>" class="uk-link-reset">
                            <?= $topic->getTitle() ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <div class="uk-section uk-section-default uk-padding">
        <h3 class="uk-heading-bullet">Vos posts</h3>
        <?php if(empty($posts)): ?>
            <p class="uk-text-warning">Vous n'avez pas de post.</p>
        <?php else: ?>
            <ul class="uk-list uk-list-divider">
                <?php foreach($posts as $post): ?>
                    <li class="uk-text-large">
                        <?= $post->getContent() ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
