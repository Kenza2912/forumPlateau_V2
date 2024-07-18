


<!-- Formulaire pour se connecter  -->
<h1>Se connecter</h1>
<form action="index.php?ctrl=security&action=login" method="POST">

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>
    
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" required><br>

    <input type="submit" name="submit"values="Se connecter">
</form>