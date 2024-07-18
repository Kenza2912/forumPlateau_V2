<?php

$post = $result['data']['post'];
$title = "Edit Post | DiveIn Design - Your Web Design Forum";

?>



  

        <h2>Modifier un post</h2>

        <form action="index.php?ctrl=forum&action=updatePost&id=<?=$post->getId()?>" method="POST">

            <textarea  rows="10" name="content"  placeholder="Content"><?=$post->getContent()?></textarea>
            
            <button type="submit" class="btn">Update</button>

        </form>

    </div>
    
</section>