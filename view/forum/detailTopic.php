<?php
  
    $posts = $result["data"]['posts'];
    $topic = $result["data"]['topic']; 
    // var_dump($posts);
    // var_dump($topic);
?>

<h1>Liste post par topic</h1>



<p>title : <?= $topic->getTitle() ?>



</p>




<p>Post :
<?php if(!empty($posts)):?>
    <?php foreach($posts as $post): ?>
        <?= $post->getContent() ?>
        <?php endforeach; ?>
    <?php else: ?>
        Aucun post disponible.
    <?php endif; ?>
</p>




    
