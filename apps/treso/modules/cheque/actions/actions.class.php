<?php

/**
 * cheque actions.
 *
 * @package    simde
 * @subpackage cheque
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class chequeActions extends tresoActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();
    $this->checkAuthorisation($this->asso);

    $this->cheques = TransactionTable::getInstance()->getChequesEmis($this->asso)->execute();
    $this->getResponse()->setSlot('current_asso', $this->asso);
  }
  
  public function executeEncaisser(sfWebRequest $request)
  {
    $transaction = $this->getRoute()->getObject();
    $asso = $transaction->getAsso();
    $this->checkAuthorisation($asso);
    
    $transaction->setDateRapprochement(date("Y-m-d"));
    $transaction->save();
    $this->redirect($this->generateUrl('cheque_list',$asso));
  }
}
