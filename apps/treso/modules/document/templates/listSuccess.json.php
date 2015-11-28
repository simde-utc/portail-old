<?php

$docs = array();
foreach ($documents as $document) {
  if (!is_null($document->getTransactionId())) {
      $transaction = array(
        'id' => $document->getTransactionId(),
        'libelle' => $document->Transaction->getLibelle(),
        'url' => url_for('transaction_show', $document->Transaction),
        );
  } else {
      $transaction = NULL;
  }

  $docs[] = array(
      'id' => $document->getPrimaryKey(),
      'nom' => $document->getNom(),
      'date_ajout' => $document->getDateTimeObject('created_at')->getTimestamp(), // simplifie les comparaisons
      'type' => $document->DocumentType->getNom(),
      'url' => url_for('document_show', $document),
      'transaction' => $transaction,
      );
}

echo json_encode($docs);