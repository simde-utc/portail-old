<?php use_helper('Number', 'Date'); ?>

<h1>Attestation de Note de Frais</h1>
<p>Le <?php echo date('d/m/Y') ?></p>

<p><?php echo $note_de_frais->getNom() ?> déclare avoir reçu 
    <?php switch($note_de_frais->getTransaction()->getTransactionMoyen()->getNom()) {
        case 'Chèque':
        ?>
            le chèque suivant :
            <ul>
                <li>Banque : <?php echo $note_de_frais->getTransaction()->getCompteBanquaire()->getBanque() ?></li>
                <li>Numéro : <?php echo $note_de_frais->getTransaction()->getMoyenCommentaire() ?></li>
                <li>Montant : <?php echo format_currency(abs($note_de_frais->getTransaction()->getMontant()) ,'€', 'fr_FR') ?></li>
            </ul>
            <?php
        break;
        case 'Virement':
        ?>
            le virement suivant :
            <ul>
                <li>Date : <?php echo format_date($note_de_frais->getTransaction()->getDateTransaction(), 'd', 'fr') ?></li>
                <li>Montant : <?php echo format_currency(abs($note_de_frais->getTransaction()->getMontant()) ,'€', 'fr_FR') ?></li>
            </ul>
            <?php
           break;
    } ?>
<br/><br/>
Corespondant à la note de frais n° <?php echo $note_de_frais->getPrimaryKey(); ?> du <?php echo format_date($note_de_frais->getTransaction()->getDateTransaction(), 'D', 'fr') ?>.
</p>
<p>
Détails : <br/><br/>
<?php echo nl2br($note_de_frais->getTransaction()->getCommentaire()); ?>
<br/>
</p>

<style>
table {
    width: 100%;
}
td {
    width: 50%;
    text-align: center;
}
</style>

<table>
    <tr>
        <td>Pour <?php echo $note_de_frais->getAsso()->getName() ?><br/>
            <?php echo $user->getGuardUser()->getName() ?></td>
        <td>Le bénéficiaire<br/>
            <?php echo $note_de_frais->getNom() ?></td>
    </tr>
</table>