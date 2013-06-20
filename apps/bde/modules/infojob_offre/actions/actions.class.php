<?php

require_once dirname(__FILE__).'/../lib/infojob_offreGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/infojob_offreGeneratorHelper.class.php';

/**
 * infojob_offre actions.
 *
 * @package    simde
 * @subpackage infojob_offre
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class infojob_offreActions extends autoInfojob_offreActions
{
  public function executeBatchArchiver(sfWebRequest $request) {
    $ids = $request->getParameter('ids');
    $q = Doctrine_Query::create()
      ->from('InfoJobOffre a')
      ->whereIn('a.id', $ids);
    foreach ($q->execute() as $offre) {
      $offre->archive();
    }
    $this->getUser()->setFlash('notice', 'Les offres ont bien étés archivées.');
    $this->redirect('info_job_offre');
  }

  public function executeListArchiver(sfWebRequest $request)
  {
    $offre = $this->getRoute()->getObject();
    $offre->archive();
    $this->getUser()->setFlash('notice', 'L\'offre a bien été archivé.');
    $this->redirect('info_job_offre');
  }
}
