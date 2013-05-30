<?php
/**
  * a function that allows link_to between apps
  * @param  $app    string      the app we want to go to
  * @param  $route  string      the route in the app. Must be valid
  * @param  $args   array       the arguments required by the route. Optional
  * @author Cf. http://ivanramirez.fr/2011/08/09/faire-un-lien-dune-application-a-une-autre/
  *
  */
function cross_app_link_to($app, $route, $args=null)
{
  /* get the host to build the absolute paths
     needed because this menu lets switch between sf apps
  */
  $host = sfContext::getInstance()->getRequest()->getHost() ;
  /* get the current environment. Needed to switch between the apps preserving
     the environment
  */
  $env = sfConfig::get('sf_environment');
  /* get the routing file
  */
  $appRoutingFile =  sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.$app.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'routing.yml' ;
  /* get the route in the routing file */
  /* first, substract the @ from the route name */
  $route = substr($route, 1, strlen($route)) ;
  if (file_exists($appRoutingFile))
  {
    $yml = sfYaml::load($appRoutingFile) ;
    $routeUrl = $yml[$route]['url'] ;
    if ($args)
    {
      foreach ($args as $k => $v)
      {
        $routeUrl = str_replace(':'.$k, $v, $routeUrl) ;
      }
    }
    if (strrpos($routeUrl, '*') == strlen($routeUrl)-1)
    {
      $routeUrl = substr($routeUrl, 0, strlen($routeUrl)-2) ;
    }
  }
  if ($env == 'dev')
  {
  	  $path = 'http://' . $host . '/' . $app . '_dev.php' . $routeUrl ;
  }
  else
  {
  	$path = 'http://' . $host . $routeUrl ;
  }
  return $path ;
}
