<?php $users = $result['data']['users'];?>

    <h2>Utilisateur :</h2>
<?php

    foreach($users as $user){

?>
        <p>Username :<b> <?= $user->getUsername()?></b></p>
        <p>Email : <?= $user->getemail()?></p>
       

        <button><a href="index.php?ctrl=user&action=listTopicsAndPostsByUser&id=<?= $user->getId()?>">See topics and posts</a></button>
<?php
        
    }