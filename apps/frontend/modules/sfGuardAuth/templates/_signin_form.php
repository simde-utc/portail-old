<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post" id="form-login">

    <?php echo $form['username']->renderLabel() ?> :<br />
    <?php echo $form['username']->render() ?><br />

    <?php echo $form['password']->renderLabel() ?> :<br />
    <?php echo $form['password']->render() ?><br />

    <?php echo $form['remember']->render() ?> <?php echo $form['remember']->renderLabel() ?><br />


    <?php echo $form->renderHiddenFields() ?>

    <input type="submit" value="Connexion" class="more" />

    <?php $routes = $sf_context->getRouting()->getRoutes() ?>
    <?php if(isset($routes['sf_guard_forgot_password'])): ?>
        <a href="<?php echo url_for('@sf_guard_forgot_password') ?>">Mot de passe oublié</a>
    <?php endif; ?>

    <?php if(isset($routes['sf_guard_register'])): ?>
        &nbsp; <a href="<?php echo url_for('@sf_guard_register') ?>">S'enregistrer</a>
    <?php endif; ?>

    <br /><br />
    <a href="<?php echo url_for('cas') ?>">Utiliser le CAS</a>

</form>