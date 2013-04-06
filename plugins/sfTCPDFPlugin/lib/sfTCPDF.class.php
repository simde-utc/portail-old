<?php

/**
 * sfTCPDF class.
 *
 * @package    sfTCPDFPlugin
 * @author     Vernet Loïc aka COil <qrf_coil]at[yahoo[dot]fr>
 * @link       http://www.symfony-project.org/plugins/sfTCPDFPlugin
 * @link       http://www.tcpdf.org
 * @link       http://sourceforge.net/projects/tcpdf/
 */

class sfTCPDF extends TCPDF
{
  /**
   * When set this method is called as a header function.
   * The variable must be a valid argument to call_user_func
   *
   * @var mixed
   */
  public $headerCallback = null;

  /**
   * When set this method is called as a header function.
   * The variable must be a valid argument to call_user_func
   *
   * @var mixed
   */
  public $footerCallback = null;

  /**
   * Holds the data set via php magic methods
   */
  protected $userData = array();

  /**
   * Instantiate TCPDF lib.
   *
   * @param string $orientation
   * @param string $unit
   * @param string $format
   * @param boolean $unicode
   * @param string $encoding
   */
  public function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = "UTF-8")
  {
    parent::__construct($orientation, $unit, $format, $unicode, $encoding);
  }

  /**
   * This method is used to render the page header.
   * It is automatically called by AddPage() and could be overwritten using a Callback.
   *
   * @access public
   * @see $headerCallback
   */
  public function Header()
  {
    if ($this->print_header)
    {
      if (is_null($this->headerCallback))
      {
        parent::Header();
      }
      else
      {
        call_user_func($this->headerCallback, $this);
      }
    }
  }

  /**
   * This method is used to render the page footer.
   * It is automatically called by AddPage() and could be overwritten using a Callback.
   *
   * @access public
   * @see $footerCallback
   */
  public function Footer()
  {
    if ($this->print_footer)
    {
      if (is_null($this->footerCallback))
      {
        parent::Footer();
      }
      else
      {
        call_user_func($this->footerCallback, $this);
      }
    }
  }

  /**
   * Magic setter.
   *
   * @param String $name
   * @param mixed $value
   */
  public function __set($name, $value)
  {
    $this->userData[$name] = $value;
  }

  /**
   * Magic getter.
   *
   * @param String $name Name of data key to return
   * @return mixed
   */
  public function __get($name)
  {
    if (array_key_exists($name, $this->userData))
    {
      return $this->userData[$name];
    }

    $trace = debug_backtrace();    
    trigger_error(
      'Undefined property call via __get(): '. $name. ' in ' . $trace[0]['file']. ' on line ' . $trace[0]['line'],
      E_USER_NOTICE
    );
    
    return null;
  }

  /**
   * Test existence of user data.
   *
   * @param String $name
   * @return Boolean
   */
  public function __isset($name)
  {
    return isset($this->userData[$name]);
  }

  /**
   * Unset user data.
   *
   * @param String $name
   */
  public function __unset($name)
  {
    unset($this->userData[$name]);
  }
}