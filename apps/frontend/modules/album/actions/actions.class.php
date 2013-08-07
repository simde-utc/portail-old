<?php

/**
 * album actions.
 *
 * @package    simde
 * @subpackage album
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class albumActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->albums = Doctrine_Core::getTable('album')->findAll();
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($album = Doctrine::getTable('album')->find(array($request->getParameter('id'))), sprintf('Album does not exist (%s).', $request->getParameter('id')));
        $this->form = new AlbumForm($album);
    }

    public function executeSubmit(sfWebRequest $request) {
        $tainted_values = $request->getParameter('album');
        $album = Doctrine::getTable('album')->find($tainted_values['id']);

        $this->form = new AlbumForm($album);
        $taintedFiles = $request->getFiles('album');


        if ($request->isMethod('post')) {
            $this->form->bind($tainted_values, $taintedFiles);

            $this->form->save();
            $this->redirect('albums_list');

        }

        $this->setTemplate('edit');
    }

    public function executeAdd(sfWebRequest $request) {

        $this->forward404unless($request->isXmlHttpRequest());
        $number = intval($request->getParameter("num"));

        $this->form = new AlbumForm();

        $this->form->addNewFields($number);

        return $this->renderPartial('addNew', array('form' => $this->form, 'number' => $number));

    }

    public function executeShow(sfWebRequest $request) {
        $this->album = Doctrine_Core::getTable('album')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->album);
    }

    public function executeNew(sfWebRequest $request) {
        $album = new Album();
        $this->form = new AlbumForm($album);

        $this->form->addNewFields(0);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($album = Doctrine_Core::getTable('album')->find(array($request->getParameter('id'))), sprintf('Object album does not exist (%s).', $request->getParameter('id')));
        //$this->forward404Unless($this->getUser()->getGuardUser()->hasAccess($article->getAsso()->getLogin(),0x04));

        $images = $album->getImages();

        foreach ($images as $image) {
            $image->delete();
        }

        $album->delete();

        $this->redirect('album/index');
    }
    /*
      public function executeCreate(sfWebRequest $request)
      {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new albumForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
      }



      public function executeUpdate(sfWebRequest $request)
      {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($album = Doctrine_Core::getTable('album')->find(array($request->getParameter('id'))), sprintf('Object album does not exist (%s).', $request->getParameter('id')));
        $this->form = new albumForm($album);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
      }

      public function executeDelete(sfWebRequest $request)
      {
        $request->checkCSRFProtection();

        $this->forward404Unless($album = Doctrine_Core::getTable('album')->find(array($request->getParameter('id'))), sprintf('Object album does not exist (%s).', $request->getParameter('id')));
        $album->delete();

        $this->redirect('album/index');
      }

      protected function processForm(sfWebRequest $request, sfForm $form)
      {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
          $album = $form->save();

          $this->redirect('album/edit?id='.$album->getId());
        }
      }
     *
     * */

    /*
  protected function getImages(){
        
    $this->images = AlbumTable::getInstance()->getImages($this->getRoute()->getObject()->getId())->execute();

    return $this->images;
  }
*/
}
