<?php

class myUser extends sfGuardSecurityUser
{

  /**
   * Try to login with the CAS server
   */
  public function login()
  {
    sfCAS::initPhpCAS();
    phpCAS::forceAuthentication();
    $username = phpCAS::getUser();

    $data = sfGuardUserTable::getInstance()->findOneBy('username', $username);
    if($data && $data->getIsActive())
      $this->signin($data, true);
    die('Unauthorized.');
  }

  /**
   * Logout the user form the current symfony application and from the
   *  CAS server
   * @param  boolean $onlyLocal   Set it to true, to logout from the application, but stay login in the CAS
   */
  public function logout($onlyLocal = false)
  {
    $this->setAuthenticated(false);
    $this->username = null;
    if(!$onlyLocal)
    {
      sfCAS::initPhpCAS();
      phpCAS::logout();
    }
  }

}
