<div class="part">
  <h1>Informations importantes</h1>
  <p>Cette page permet la signature de la charte informatique liée au compte de l'association <b>par son président</b>.</p>
  <p><b>Après validation par le BDE ou l'ancien président</b> de l'association, vous serez officiellement enregistré comme président de l'association :</p>
  <ul>
    <li>sur le portail, vous disposerez des droits avec votre compte personnel (login via le CAS)</li>
    <li>sur les serveurs du SiMDE, vous serez autorisé à utiliser le compte de l'association.<br />Pour toute information sur les comptes associations (notamment demander un nouveau mot de passe), rendez-vous sur le <a href="/simde" title="SiMDE">wiki du SiMDE</a></li>
  </ul>
  <h1>Charte d'utilisation des ressources informatiques</h1>
  <p>
    Vous avez demandé à utiliser un compte au nom
    de  l'association <?php echo $asso->getName() ?>.  Son
    utilisation est soumise aux conditions qui suivent.
  </p>
  <p>Le compte est ouvert au nom de l'association, pour les
      besoins de l'association. L'usage à des fins personnels
      des moyens mis à dispositions via ce compte est donc
      strictement proscrit.</p>
  <p>L'utilisation  de  ce  compte  et  des  moyens  mis  à
      dispositions  via  ce  compte,  est  soumise  aux  mêmes
      règles et conditions que celles imposées par la <a href="http://wwwcyg.utc.fr/wiki/charte_informatique/charte.pdf">Charte du
      bon usage des moyens et ressources informatiques</a> de
      l'UTC</p>
  <p>Le compte et les moyens mis à dispositions via ce compte
      sont  sous  l'unique  responsabilité  du  signataire  de  la
      présente charte. En cas de non respect de la charte, c'est
      lui qui en supportera les conséquences.</p>
  <p>Cette  demande  d'utilisation  est  à  renouveler  tous  les
      semestres (acceptation de la présente charte).</p>
    <p>
      Le  SiMDE,  diligenté  ou  non  par  le  BDE  ou  la
      Direction des Systèmes d'Information de l'UTC, se
      réserve le droit de prendre, en cas de nécessité,
      les dispositions appropriées vis à vis du compte de
      l'association, et/ou de l'étudiant responsable.
    </p>
    <div class="well">
      <form method="post" action="<?php echo url_for('asso_charte_post') ?>">
        <p>
          En saisissant mon login <em><?php echo $sf_user->getUsername() ?></em> ci-dessous et en cliquant sur <i>Valider</i>, je déclare :</p>
          <ul>
            <li>prendre la responsabilité du compte de l'association <em><?php echo $asso->getName() ?></em> (login <em><?php echo $asso->getLogin() ?></em>)</li>
            <li>avoir pris connaissance de la charte ci-dessus et l'approuver</li>
          </ul>
        </p>
        <input type="text" name="check" /><br />
        <input type="hidden" name="asso_id" value="<?php echo $asso->getId() ?>" />
        <input type="submit" class="btn btn-primary" value="Valider" />
      </form>
    </div>
</div>