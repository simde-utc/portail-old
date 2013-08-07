<?php
/**
 * This file is part of the sfFilebasePlugin package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package   de.optimusprime.sfFilebasePlugin.adminArea
 * @author    Johannes Heinen <johannes.heinen@gmail.com>
 * @license   MIT license
 * @copyright 2007-2009 Johannes Heinen <johannes.heinen@gmail.com>
 */
abstract class PluginsfFilebaseFile extends BasesfFilebaseFile
{
  public function preDelete($event)
  {
    $f = sfFilebasePlugin::getInstance();
    try
    {
      $f->getFilebaseFile($this->getHash())->delete();
    }
    catch(Exception $e)
    {
      sfContext::getInstance()->getLogger()->log($e, sfLogger::ERR);
    }
  }

  public function getFile(sfFilebasePlugin $filebase = null)
  {
    $filebase === null && $filebase = sfFilebasePlugin::getInstance();
    return $filebase[$this->getHash()];
  }

  public function postDelete($event)
  {
    sfContext::getInstance()->getEventDispatcher()->notify(new sfEvent(
        $this, 'sfFilebasePlugin.filebase.file_deleted'
    ));
  }

  public function postInsert($event)
  {
    sfContext::getInstance()->getEventDispatcher()->notify(new sfEvent(
        $this, 'sfFilebasePlugin.filebase.file_inserted'
    ));
  }

  public function postUpdate($event)
  {
    sfContext::getInstance()->getEventDispatcher()->notify(new sfEvent(
        $this, 'sfFilebasePlugin.filebase.file_updated'
    ));
  }
}