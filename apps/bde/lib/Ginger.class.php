<?php
class Ginger extends KoalaClient {
  public function __construct(){
    $this->url = "http://localhost:8888/ginger/web/v1/";
  }
  
  public function apiCall($endpoint, $params = array(), $method = "GET") {
    // Ajout de la clé aux requêtes et appel du parent
    $params = array_merge($params, array("key" => sfConfig::get('app_portail_ginger_key')));
    return parent::apiCall($endpoint, $params, $method);
  }
  
  public function getLogin($login) {
    return $this->apiCall($login);
  }
  
  public function getCotisations($login) {
    return $this->apiCall("$login/cotisations");
  }
  
  public function addCotisation($login, $debut, $fin){
    $params = array(
      "debut" => $debut,
      "fin" => $fin
    );
    return $this->apiCall("$login/cotisations", $params, "POST");
  }
}
?>
