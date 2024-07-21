<?php 
$users = $result['data']['users'];

?>

    <h2>Utilisateur :</h2>
<?php

    foreach($users as $user){

?>
        <p>Utilisateurs : <?= $user->getNickName()?> inscrit le <?= $user->getDateRegistration()?></p>
        
        
        

        
<?php }