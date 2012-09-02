<div class="part">
  <h1>SERVICE INFORMATIQUE
    DE LA MAISON DES ÉTUDIANTS</h1>
  <h2>Charte d'utilisation des ressources informatiques</h2>
  <p>
    Vous avez demandé à utiliser un compte au nom
    de  l'association <?php echo $asso->getName() ?>.  Son
    utilisation est soumise aux conditions suivantes :
  </p>
  <ul>
    <li>le compte est ouvert au nom de l'association, pour les
      besoins de l'association. L'usage à des fins personnels
      des moyens mis à dispositions via ce compte est donc
      strictement proscrit.</li>
    <li>l'utilisation  de  ce  compte  et  des  moyens  mis  à
      dispositions  via  ce  compte,  est  soumise  aux  mêmes
      règles et conditions que celles imposées par la Charte du
      bon usage des moyens et ressources informatiques de
      l'UTC disponible à cette adresse :
      <a href="http://wwwcyg.utc.fr/wiki/charte_informatique/charte.pdf">http://wwwcyg.utc.fr/wiki/charte_informatique/charte.pdf</a>
    </li>
    <li>le compte et les moyens mis à dispositions via ce compte
      est  sous  l'unique  responsabilité  du  signataire  de  la
      présente charte. En cas de non respect de la charte, c'est
      lui qui en supportera les conséquences.</li>
    <li>cette  demande  d'utilisation  est  à  renouveler  tous  les
      semestres (signature de la présente charte).</li>
    <p>
      Le  SiMDE,  diligenté  ou  non  par  le  BDE  ou  la
      Direction des Systèmes d'Information de l'UTC, se
      réserve le droit de prendre, en cas de nécessité,
      les dispositions appropriées vis à vis du compte de
      l'association, et/ou de l'étudiant responsable.
    </p>
    <div class="well">
      <form method="post" action="<?php echo url_for('asso_charte_post') ?>">
        <label for="check">Je soussigné, <em><?php echo $sf_user->getName() ?></em>
          déclare  prendre  la  responsabilité  du  compte  de
          l'association <em><?php echo $asso->getName() ?></em> (login: <em><?php echo $asso->getLogin() ?></em>) J'assure avoir pris connaissance de
          la presente charte et de l'approuver.<br />
          <br />
          En retappant votre login <em><?php echo $sf_user->getUsername() ?></em> dans la case ci-contre, vous acceptez les conditions ci-dessous
          et devenez responsable des ressources informatiques mises à disposition par le BDE et le SiMDE pour l'association <em><?php echo $asso->getLogin() ?></em>.</label>
        <input type="text" name="check" />
        <input type="hidden" name="asso_id" value="<?php echo $asso->getId() ?>" />
        <input type="submit" class="btn btn-primary" value="Je signe" />
      </form>
    </div>
</div>