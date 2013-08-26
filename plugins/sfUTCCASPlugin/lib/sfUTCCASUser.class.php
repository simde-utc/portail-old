<?php

class sfUTCCASUser extends sfGuardSecurityUser
{
    /**
     * Try to login with the CAS server
     */
    public function login() {
        sfCAS::initPhpCAS();
        phpCAS::forceAuthentication();
        $username = phpCAS::getUser();

        $data = sfGuardUserTable::getInstance()->findOneBy('username', $username);
        if (!$data || ($data->getPassword() == NULL && !$data->getIsActive()))
            $data = $this->registerUser($username, $data);

        if ($data)
            $this->signin($data, false);
        else
            die('Unauthorized.');
    }

    private function registerUser($username, $data = NULL) {
        try {
            $gingerKey = sfConfig::get('app_portail_ginger_key');

            if ($gingerKey != "abc") {
                $ginger = new \Ginger\Client\GingerClient(sfConfig::get('app_portail_ginger_key'));
                $cotisants = $ginger->getUser($username);
            } else {
                $cotisants = new stdClass();
                $cotisants->mail = $username . "@etu.utc.fr";
                $cotisants->prenom = "Le";
                $cotisants->nom = "Testeur";
                $cotisants->type = "etu";
            }

            if (!$data)
                $data = new sfGuardUser();

            $data->setUsername($username);
            $data->setEmailAddress($cotisants->mail);
            $data->setFirstName($cotisants->prenom);
            $data->setLastName($cotisants->nom);
            $data->setIsActive(true);
            $data->save();

            $profile = new Profile();
            $profile->setUser($data);
            $profile->setDomain($cotisants->type);
            $profile->save();

            return $data;
        } catch (\Ginger\Client\ApiException $ex) {
            $this->setFlash('error', "Il n'a pas été possible de vous identifier. Merci de contacter simde@assos.utc.fr en précisant votre login et le code d'erreur " . $ex->getCode() . ".");
        }

        return false;
    }

    /**
     * Logout the user form the current symfony application and from the
     *  CAS server
     * @param  boolean $onlyLocal   Set it to true, to logout from the application, but stay login in the CAS
     */
    public function logout($url = null, $onlyLocal = false) {
        parent::signOut();
        $this->username = null;
        if (!$onlyLocal) {
            sfCAS::initPhpCAS();
            if(!empty($url))
                phpCAS::logoutWithUrl($url);
            else
                phpCas::logout ();
        }
    }

}
