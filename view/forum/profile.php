<?php
    $topics = $result['data']['topics'];
    $posts = $result['data']['posts'];
    
?>
    <h2> Bienvenu sur votre profile <?=  App\Session::getUser()->getNickName() ?></h2>
  

    <h2>Vos topics :</h2>

    <?php

    if(!isset($topics)){
        
        ?>
            <p>vous n'avez pas de topic</p>

        <?php

    } else {

        foreach($topics as $topic){
        ?>

           <p><?= $topic->getTitle() ?></p>

        <?php

        }
    }
    ?>
    <h3>Vos posts :</h3>

    <?php

        if(!isset($posts)){
    ?>
            <p>Vous n'avez pas de post</p>

    <?php
    } else {

        foreach($posts as $post){
    ?>
           <p><?= $post->getContent() ?></p>
    <?php
        }
    }
    ?>