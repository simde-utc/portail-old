<?php use_helper('Number', 'Date');

function format_montant($montant) {
  return format_currency(abs($montant), '€', 'fr_FR');
}

// On a un tableau pour stocker les dépense et un autre pour stocker les recettes
$depenses = array();
$recettes = array();

$total_depenses = 0;
$total_recettes = 0;

foreach($categories as $categorie) {
    $montant_recettes = 0;
    $montant_depenses = 0;
    $cat_recettes = array();
    $cat_depenses = array();
    foreach ($categorie->getPostesForBudget($budget) as $poste) {
        $ligne = '<td>'.$poste->getNom().'</td><td>'.$poste->getNombre().'</td><td>'.format_montant($poste->getPrixUnitaire())."</td>\n";
        if ($poste->getPrixUnitaire() > 0) {
            $cat_recettes[] = $ligne;
            $montant_recettes += $poste->getTotal();
        } else if ($poste->getPrixUnitaire() < 0) {
            $cat_depenses[] = $ligne;
            $montant_depenses += $poste->getTotal();
        }
    }

    // On ajoute une lige de total
    if ($montant_depenses != 0) {
        $depenses[] = '<td colspan="2"><b>'.$categorie->getNom().'</b></td><td><b>'.format_montant($montant_depenses)."</b></td>\n";
        $depenses = array_merge($depenses, $cat_depenses);
        $depenses[] = "<td colspan=\"3\">&nbsp;</td>\n";
    }
    if ($montant_recettes != 0) {
        $recettes[] = '<td colspan="2"><b>'.$categorie->getNom().'</b></td><td><b>'.format_montant($montant_recettes)."</b></td>\n";
        $recettes = array_merge($recettes, $cat_recettes);
        $recettes[] = "<td colspan=\"3\">&nbsp;</td>\n";
    }
    $total_depenses += $montant_depenses;
    $total_recettes += $montant_recettes;
}
?>

<style>
table {
    border: 1px solid #000000;
    width: 100%;
    font-size: 45px;
}
th {
    border: 1px solid #000000;
    width: 50%;
    padding: 2px;
    font-size: 60px;
}
tr {
    border-width: 0px;
}
td {
    border-top: 1px solid #000000;
    border-left: 1px solid #000000;
    border-right: 1px solid #000000;
    padding: 3px;
}
.coucou {
    border: none;
}
</style>

<h1>Budget <?php echo $asso->getName() ?> : <?php echo $budget->getNom() ?></h1>
<p>Export réalisé le <?php echo date('d/m/Y'); ?></p>

<table>
    <thead>
        <tr>
            <th colspan="3">Dépenses</th>
            <th colspan="3">Recettes</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // On n'imprime pas la dernière ligne car elle correspondra forcément à 
        for ($i = 0; $i < max(count($depenses), count($recettes)); $i++) {
                echo '<tr>';
                if (isset($depenses[$i])) {
                    echo $depenses[$i];
                } else {
                    echo '<td class="coucou" colspan="3"></td>';
                }
                if (isset($recettes[$i])) {
                    echo $recettes[$i];
                } else {
                    echo '<td class="coucou" colspan="3"></td>';
                }
                echo "</tr>\n";
            } ?>
        <tr>
            <td colspan="2"><b>Total</b></td><td><b><?php echo format_montant($total_depenses); ?></b></td>
            <td colspan="2"><b>Total</b></td><td><b><?php echo format_montant($total_recettes); ?></b></td>
        </tr>
    </tbody>
</table>