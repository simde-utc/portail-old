<?php
 
/**
 * sfValidatorFileImage
 *
 * Original validator for symfony 1.0 : http://snippets.symfony-project.org/snippet/259
 *
 * @package    symfony
 * @subpackage validator
 * @author     Yoann Brieux <yoann |dot¤ brieux #at] gmail ~dot} com>
 * @version    0.1
 */
class sfValidatorFileImage extends sfValidatorFile
{
  /**
   * @param array $options   An array of options
   * @param array $messages  An array of error messages
   *
   * @see sfValidatorFile
   */
  protected function configure($options = array(), $messages = array())
  {
    parent::configure($options, $messages);
 
    $this->addMessage('invalid_image', '%value% n\'est pas un fichier image.');
    $this->addMessage('max_height', '"%value%" a une hauteur trop grande (%max_height% pixels max).');
    $this->addMessage('min_height', '"%value%" a une hauteur trop petite (%min_height% pixels min).');
    $this->addMessage('max_width', '"%value%" a une largeur trop grande (%max_width% pixels max).');
    $this->addMessage('min_width', '"%value%" a une largeur trop petite (%min_width% pixels min).');
 
    $this->addOption('max_height');
    $this->addOption('min_height');
    $this->addOption('max_width');
    $this->addOption('min_width');    
    $this->addOption('is_only_image',false);    
  }
 
  /**
   * @see sfValidatorFile
   */
  protected function doClean($value)
  {
    $clean = parent::doClean($value);
 
    $size = @getimagesize($clean->getTempName());
 
    if (!$size && !$this->getOption('is_only_image')) 
    {
        return $clean;
    }
 
    if (!$size){    
      throw new sfValidatorError($this, 'invalid_image', array('value' => $value['name']));
    }
 
    list($width, $height) = $size;
 
    if($this->getOption('max_height') < $height){
        throw new sfValidatorError($this, 'max_height', array('value' => $value['name'], 'max_height' => $this->getOption('max_height')));
    }
 
    if($this->getOption('min_height') > $height){
        throw new sfValidatorError($this, 'min_height', array('value' => $value['name'], 'min_height' => $this->getOption('min_height')));
    }
 
    if($this->getOption('max_width') < $width){
        throw new sfValidatorError($this, 'max_width', array('value' => $value['name'], 'max_width' => $this->getOption('max_width')));
    }
 
    if($this->getOption('min_width') > $width){
        throw new sfValidatorError($this, 'min_width', array('value' => $value['name'], 'min_width' => $this->getOption('min_width')));
    }
 
    return $clean;
  }
}
