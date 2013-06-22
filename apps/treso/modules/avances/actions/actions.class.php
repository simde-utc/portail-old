<?php

/**
 * avances actions.
 *
 * @package    simde
 * @subpackage avances
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class avancesActions extends tresoActions
{
  protected function checkAuthorisation($asso) {
    $this->redirectUnless($asso-> isPole(), 'avances_interdit', $asso);
    return parent::checkAuthorisation($asso);
  }

  public function executeIndex(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();
    $this->checkAuthorisation($this->asso);
    $this->avances_treso = AvanceTresoTable::getInstance()->getAllForEmetteur($this->asso)->execute();

    $this->getResponse()->setSlot('current_asso', $this->asso);
  }

  public function executeInterdit(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();
    $this->getResponse()->setSlot('current_asso', $this->asso);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();
    $this->checkAuthorisation($this->asso);

    $avance = new AvanceTreso();
    $avance->Emetteur = $this->asso;
    $this->form = new AvanceTresoForm($avance);

    $this->getResponse()->setSlot('current_asso', $this->asso);
  }

  public function executeNewWithAsso(sfWebRequest $request)
  {
    $table = AssoTable::getInstance();

    $this->redirectUnless($this->asso = $table->retrieveAsso(
        $table->getOneByLogin($request->getUrlParameter('login1', ''))),
      'avances');
    $this->redirectUnless($this->asso1 = $table->retrieveAsso(
        $table->getOneByLogin($request->getUrlParameter('login2', ''))),
      'avances_new', $this->asso);
    $this->checkAuthorisation($this->asso);

    $avance = new AvanceTreso();
    $avance->Emetteur = $this->asso;
    $avance->Asso = $this->asso1;
    $this->form = new AvanceTresoForm($avance);

    $this->getResponse()->setSlot('current_asso', $this->asso);
    $this->setTemplate('new');
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $avance = new AvanceTreso();
    $this->form = new AvanceTresoForm($avance);
    
    $request_params = $request->getParameter($this->form->getName());
    $table = AssoTable::getInstance();
    $this->asso = $table->find($request_params['emetteur_id']);
    $this->asso1 = $table->retrieveAsso($table->getOneByLogin($request_params['asso_id']));
    $this->checkAuthorisation($this->asso);

    $avance->Emetteur = $this->asso;
    $avance->Asso = $this->asso1;
    $this->form->configure(); // on reconfigure pour prendre on compte l'Asso

    $this->processForm($request, $this->form, $this->asso, $this->asso1);

    $this->getResponse()->setSlot('current_asso', $this->asso);
    $this->setTemplate('new');
  }

  protected function processForm(sfWebRequest $request, sfForm $form, $emetteur, $asso)
  {
    $parameters = $request->getParameter($form->getName());
    $form->bind($parameters, $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $montant = abs($parameters['montant']);
      var_dump(Doctrine);
      $t = new Transaction(); // Transaction côté asso
      $t_e = new Transaction(); // Transaction côté pôle
      // Asso
      $t->Asso = $asso;
      $t_e->Asso = $emetteur;
      // Compte
      $t->compte_id = $parameters['asso_compte_id'];
      $t_e->compte_id = $parameters['emetteur_compte_id'];
      // Libellé
      $t_e->libelle = sprintf('Avance de Trésorie %s', $asso->getName());
      $t->libelle = sprintf('Avance de Trésorie %s', $emetteur->getName());
      $t_e->montant = -($t->montant = $montant);
      $t_e->commentaire = $t->commentaire = $parameters['commentaire'];
      $t->moyen_id = $t_e->moyen_id = $parameters['moyen_id'];
      $t->moyen_commentaire = $t_e->moyen_commentaire = $parameters['moyen_commentaire'];
      $t->date_transaction = $t_e->date_transaction = date('Y-m-d');
      $t->save();
      $t_e->save();

      $form->setValue('transaction_emetteur_id', $t_e);
      $form->setValue('transaction_id', $t);
      $form->setValue('asso_id', $asso->getPrimaryKey());
      $avance_treso = $form->save();

      $this->redirect('avances', $emetteur);
    }
  }
}
