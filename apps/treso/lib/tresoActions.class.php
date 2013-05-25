<?php
class tresoActions extends sfActions
{
  protected function checkAuthorisation($asso) {
    if(!$asso)
      return false;

    $b = $this->getUser()->isAuthenticated() && $this->getUser()->getGuardUser()->hasAccess($asso->getLogin(), 0x100);
    $this->redirectUnless($b, 'homepage');
    return $b;
  }
}
?>