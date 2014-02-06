<div class="part">
  <h1>Charte d'accès étendu</h1>
  <h2>Charte d’accès étendu à la Maison des Etudiants</h2>
  
<p> L’accès à la Maison des Etudiants <u><font color="#AA0000">(MDE) EST LIBRE DE 7H30 À 23H00 DU LUNDI AU VENDREDI, HORS
PÉRIODE DE VACANCES, ET LES WEEK-ENDS ET JOURS FÉRIÉS. POUR LE BÂTIMENT A, LES HORAIRES SONT LES MÊMES QU’INDIQUÉES DANS LE RI DE L’UTC.</font></u></p>

<p>L’activation de votre badge sésame (carte d’étudiant) pour l’accès étendu vous garantira l’accès à la MDE
(semaine, week-end et vacances) suivant le groupe d’accès demandé (un seul groupe d'accès possible).</p>

L’étudiant détenteur d’un badge sésame lui donnant l’accès étendu à la MDE s’engage à :
<ul> 
<li>Ne pas prêter son badge sésame,</li>
<li>Signaler toute perte de son badge sésame auprès du BDE-UTC et de l’UTC dans les meilleurs
délais,</li>
<li>Pénétrer dans la MDE uniquement dans le cadre de l’activité associative,</li>
<li>Vérifier que tous les accès (portes et fenêtres) sont bien fermés à son départ,</li>
<li>Ne pas introduire dans le local de matériel dangereux ou illicite, ou des personnes susceptibles de
troubler l'activité de la MDE ou de porter préjudice à son matériel,</li>
<li>Respecter les biens et les moyens collectifs mis à disposition, ne pas les détériorer,</li>
<li>Rendre en état les salles du bâtiment A pour permettre aux cours de se dérouler sans problème,</li>
<li>Signaler, dans les meilleurs délais, au BDE-UTC (MDE, local E300 – 03 44 23 43 71), et à
l’administration (contacter le gardien de l’UTC) tout problème relatif aux locaux ou à la sécurité,</li>
</ul></p>

<p>D’autre part, l’étudiant présent dans la MDE en dehors des horaires d’ouverture libre doit veiller à sa
sécurité. En effet, le BDE-UTC n’assure pas de permanence durant ces périodes. Il doit avoir conscience du
privilège de pouvoir accéder à la MDE en dehors des accès libres face à d’autres étudiants à l’accès limité,
et doit par conséquent éviter tout incident qui pourrait entraîner la fermeture de la MDE.</p>

  <div class="well">
    <form method="post" action="<?php echo url_for('locaux_create') ?>">
      <?php echo $form->renderHiddenFields(false) ?>
      <p>Pour quels lieux désirez-vous l'accès étendu?</p>
      <table>
        <tr>
          <td><font size="1" color="red">La carte étudiante ne supporte pas le cumul des accès étendu, un seul type d'accès peut être choisi. Les requêtes abusives seront refusées.</td>
        </tr>
         
        <tr>
          <td><?php echo $form['porte_mde']->renderlabel('Porte de la MDE ') ?></td>
          <td><?php echo $form['porte_mde'] ?></td>
        </tr>
        <tr>
          <td><font size="1" color="grey">L'accès porte de la MDE est pour avoir accès à la MDE jusqu'à 22h pour les réunions.</font></td>
        </tr>
         
        <tr>
          <td><?php echo $form['bat_a']->renderlabel('Batiment A ') ?></td>
          <td><?php echo $form['bat_a'] ?></td>
        </tr>
        <tr>
          <td><font size="1" color="grey">Donne aussi l'accès "Porte de la MDE" - Pour des réunions le soir au batiment A.</font></td>
        </tr>
         
        <tr>
          <td><?php echo $form['mde_complete']->renderlabel('MDE complète ') ?></td>
          <td><?php echo $form['mde_complete'] ?></td>
        </tr>
        <tr>
          <td><font size="1" color="grey">L'accès MDE complète est réservé au Président du BDE et au responsable locaux du BDE sauf dérogation exceptionnelle.</font></td>
        </tr>
        
        <tr>
          <td><?php echo $form['locaux_pic']->renderlabel('Locaux du Pic ') ?></td>
          <td><?php echo $form['locaux_pic'] ?></td>
        </tr>
        
        <tr>
          <td><?php echo $form['bureau_polar']->renderlabel('Bureau du Polar ') ?></td>
          <td><?php echo $form['bureau_polar'] ?></td>
        </tr>
         
        <tr>
          <td><?php echo $form['perm_polar']->renderlabel('Permanence du Polar') ?></td>
          <td><?php echo $form['perm_polar'] ?></td>
        </tr>
         
        <tr>
          <td><?php echo $form['salles_musique']->renderlabel('Salles de musique ') ?></td>
          <td><?php echo $form['salles_musique'] ?></td>
        </tr>
      </table>
      <br />
      <p>Entrez le motif de la demande ci dessous:</p>
      <?php echo $form['motif'] ?>
      <br/>
      <input type="submit" class="btn btn-primary" value="Valider" />
    </form>
  </div>
</div>
