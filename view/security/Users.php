<?php $users = $result['data']['users'];?>

    <h2>Utilisateur :</h2>
<?php

    foreach($users as $user){

?>
        <p>Username :<b> <?= $user->getUsername()?></b></p>
        <p>Email : <?= $user->getemail()?></p>
        <p>Date : <i><?= $user->getDateRegister()?></i></p>
       

        <button><a href="index.php?ctrl=forum&action=listTopicsAndPostsByUser&id=<?= $user->getId()?>">Les topics et les posts</a></button>
<?php
        
    }