












<!-- Formulaire pour s'inscrire  -->

<h1>S'inscrire</h1>
<form action="index.php?ctrl=security&action=register" method="POST">
    <label for="nickName">Pseudo</label>
    <input type="text" name="nickName" id="nickName" required><br>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required><br>

    <label for="pass1">Mot de passe</label>
    <input type="password" name="pass1" id="pass1" required><br>

    <label for="pass2">Confirmation du mot de passe</label>
    <input type="password" name="pass2" id="pass2"required><br>

    <input type="submit" name="submit" value="S'enregister">

</form>




