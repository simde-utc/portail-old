<?php

/**
 * Custom lib to format text
 *
 * @author simde
 */
class Text
{

  /**
   * Replace all non letter and number by "-" character.
   *
   * @param string $text
   * @return string
   */
  static public function slugify($text)
  {
// replace non letter or digits by -
    $text = preg_replace('~[^\\pL\d]+~u','-',$text);

// trim
    $text = trim($text,'-');

// transliterate
    if(function_exists('iconv'))
    {
      $text = iconv('utf-8','us-ascii//TRANSLIT',$text);
    }

// lowercase
    $text = strtolower($text);

// remove unwanted characters
    $text = preg_replace('~[^-\w]+~','',$text);

    return $text;
  }

}
