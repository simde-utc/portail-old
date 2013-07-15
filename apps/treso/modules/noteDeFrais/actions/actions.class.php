<?php

/**
 * noteDeFrais actions.
 *
 * @package    simde
 * @subpackage noteDeFrais
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class noteDeFraisActions extends tresoActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();
    $this->checkAuthorisation($this->asso);
    $this->note_de_frais = NoteDeFraisTable::getInstance()->getAllForAsso($this->asso)->execute();
    $this->transactions = TransactionTable::getInstance()->getRemboursablesForAsso($this->asso)->execute();
    $this->getResponse()->setSlot('current_asso', $this->asso);
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->note_de_frais = $this->getRoute()->getObject();
    $this->asso = $this->note_de_frais->getAsso();
    $this->checkAuthorisation($this->asso);
    $this->getResponse()->setSlot('current_asso', $this->asso);
  }

  public function executeJustificatif(sfWebRequest $request)
  {
    $note_de_frais = $this->getRoute()->getObject();
    $user = $this->getUser();
    $asso = $note_de_frais->getAsso();
    $this->checkAuthorisation($asso);

    $html = $this->getPartial('noteDeFrais/pdf', compact(array('note_de_frais', 'asso', 'user')));
    $nom = $note_de_frais->getPrimaryKey() . '-' . date('Y-m-d-H-i-s') . '-' . Doctrine_Inflector::urlize($note_de_frais->getNom());

    $doc = new Document();
    $doc->setNom('Attestation à signer');
    $doc->setAsso($asso);
    $doc->setUser($this->getUser()->getGuardUser());
    $doc->transaction_id = $note_de_frais->transaction_id;
    $doc->setTypeFromSlug('note_de_frais');
    $path = $doc->generatePDF('Note de frais', $nom, $html);
    $doc->save();

    header('Content-type: application/pdf');
    readfile($path);
    return sfView::NONE;
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();
    $this->checkAuthorisation($this->asso);
    $this->ndf = new NoteDeFrais();
    $this->ndf->setAsso($this->asso);
    $this->form = new NoteDeFraisForm($this->ndf);
    $this->getResponse()->setSlot('current_asso', $this->asso);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $this->form = new NoteDeFraisForm();
    $request_params = $request->getParameter($this->form->getName());
    $this->asso = AssoTable::getInstance()->find($request_params['asso_id']);
    $this->checkAuthorisation($this->asso);

    $this->ndf = new NoteDeFrais();
    $this->ndf->setAsso($this->asso);
    $this->form = new NoteDeFraisForm($this->ndf);

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
    $this->getResponse()->setSlot('current_asso', $this->asso);
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $parameters = $request->getParameter($form->getName());
    $form->bind($parameters, $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $this->getContext()->getConfiguration()->loadHelpers('Number');
      // On crée la transaction correspondante
      $transaction = new Transaction();
      $transaction->asso_id = $parameters['asso_id'];
      $transaction->compte_id = $parameters['compte_id'];
      $transaction->libelle = 'Remboursement ' . $parameters['nom'];
      $transaction->commentaire = "Remboursement des achats suivants :\n"; // Voir ci-dessous
      $transaction->montant = 0; // On fera le total plus tard !
      $transaction->date_transaction = date('Y-m-d');
      $transaction->moyen_id = $parameters['moyen_id'];
      $transaction->moyen_commentaire = $parameters['moyen_commentaire'];
      $transaction->save();
      $form->setValue('transaction_id', $transaction->getPrimaryKey());

      $note_de_frais = $form->save();

      foreach ($parameters['transactions'] as $transaction_id) {
        $transaction2 = $note_de_frais->addAchatFromId($transaction_id);
        $transaction->commentaire .=  $this->format_transaction($transaction2)."\n";
      }

      $transaction->save();

      $this->redirect('ndf', $note_de_frais->getAsso());
    }
  }

  private function format_transaction($transaction) {
    return $transaction->libelle . ' le ' . $transaction->date_transaction . ' - ' . format_currency(abs($transaction->montant), '€', 'fr_FR');
  }
}
