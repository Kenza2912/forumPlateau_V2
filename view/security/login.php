


<!-- Formulaire pour se connecter  -->
<h1>Se connecter</h1>

<form action="index.php?ctrl=security&action=login" method="POST" class="uk-form-stacked uk-margin-large-top">
    <div class="uk-margin">
        <label class="uk-form-label" for="email">Email</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="email" name="email" type="email" required>
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="password">Mot de passe</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="password" name="password" type="password" required>
        </div>
    </div>
    <div class="uk-margin">
        <button class="uk-button uk-button-primary" type="submit" name="submit">Se connecter</button>
    </div>
</form>


<!-- <a href="index.php?ctrl=security&action=login">Se connecter</a>
<a href="index.php?ctrl=security&action=register">S'inscrire</a> -->