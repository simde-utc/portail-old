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
        if(!$data || ($data->getPassword() == NULL && !$data->getIsActive()))
            $data = $this->registerUser($username, $data);
        $this->signin($data, true);
    }

    private function registerUser($username, $data = NULL)
    {
        $cotisants = simplexml_load_file('http://assos.utc.fr/simde/api/cotisants.php?login=' . $username);
        if($cotisants->nom
                && $cotisants->prenom
                && $cotisants->ecole)
        {
            if(!$data)
                $data = new sfGuardUser();
            $data->setUsername($username);

            switch($cotisants->ecole)
            {
                case 'utc': $email = 'etu.utc.fr';
                    break;
                case 'escom': $email = 'escom.fr';
                    break;
                default: $email = '';
            }
            $data->setEmailAddress($username . '@' . $email);
            $data->setFirstName(ucfirst(strtolower($cotisants->prenom)));
            $data->setLastName(ucfirst(strtolower($cotisants->nom)));
            $data->setIsActive(true);
            $data->save();

            $profile = new Profile();
            $profile->setUser($data);
            $profile->setDomain($cotisants->ecole);
            $profile->save();
        }
        /**
         * @todo Gérer non etu
         */
        else
        {
            die("Vous n'êtes pas dans notre base étudiants.");
        }
        return $data;
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
