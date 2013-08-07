<?php
/**
 * @author Thomas Duhamel
 * @copyright SARL LEXIK
 * @version 1
 * @mail: contact@lexik.fr
 * @site:
 * date: 09/07/2009
 *
 *
 * description: ces fonctions doivent être appeler lors de l'affichage d'une image sur le site.
 * on génère des thumb à partir de l'image uploadée ou d'une image par défaut le cas échéant.
 * pour pouvoir l'utiliser il faut:
 *  - créer un répertoire dans uploads en se basant par exemple sur le nom du Model qui a l'image.
 *  - dans ce répertoire, créer deux sous répertoires source et thumb avec les droits d'accès
 *  - uploader les images dans le répertoire source.
 * lors de l'affiche un fichier du même nom que source préfixé par la taille demandée
 * est généré dans le répertoire thumb.
 *
 * @example:
 * schema.yml
 * User:
 *  columns:
 *    nom: { type: string(255) }
 *    avatar: { type: string(255) }
 *
 * les répertoires a créer
 * uploads/user/source/ -> là où on doit uploader le images
 * uploads/user/thumb/
 *
 * avoir l 'image par défaut disponible:
 * /images/default.jpg
 *
 * pour générer le thumb:
 * doThumb($user->getAvatar(), 'user', array('width'=>100,'height'=>'150'), 'center', 'default.jpg')
 * OU
 * pour afficher le thumb
 * showThumb($user->getAvatar(), 'user', array('width'=>100,'height'=>'150'), 'center', 'default.jpg')
 */


 /**
   * générer le thumb correspondant à une image.
   * cette fonction vérifie si le thumb existe déjà ou si la source est plus récente
   * si besoin, il est regénéré.
   * il faut faire passer en paramètres options[width] et options[height]
   * et l'image est automatiquement redimensionnée en thumb.
   * si width = height alors l'image sera tronquée et carrée
   *
   * @param <string> $image_name : le nom de l'image donc généralement le $object->getImage(), pas de répertoire
   * @param <string> $folder : le nom du répertoire dans uploads où est stockée l'image : uploads/object/source => $folder = object
   * @param <array> $options : les paramètres à passer à l'image: width et height
   * @param <string> $resize : l'opération sur le thumb: "scale" pour garder les proportions, "center" pour tronquer l'image
   * @param <string> $default : l'image par défaut si image_name n'existe pas
   * @return <image_path>
  */
  function doThumb($image_name, $folder, $options = array(), $resize = 'scale', $default = 'default.jpg')
  {

    //valeur par défaut si elles ne sont pas définies
    if(!isset($options['width']))
      $options['width'] = 50;
    if(!isset($options['height']))
      $options['height'] = 50;

    $source_dir = 'uploads/'.$folder.'/source/';
    $thumb_dir  = 'uploads/'.$folder.'/thumb/';


    //le fichier source
    $source = $source_dir.$image_name;
    $exist = sfConfig::get('sf_web_dir').'/'.$source;
    if(!is_file($exist))
    {
      $image_name = $default;
      $source = 'images/'.$image_name;// la valeur par défaut
    }

    $new_name = $options['width'].'x'.$options['height'].'_'.$image_name;
    $new_img = $thumb_dir.$new_name;
    // si le thumb n'existe pas ou s'il est plus ancien que le fichier source
    // alors on re-génère le thumb
    if(!is_file(sfConfig::get('sf_web_dir').'/'.$new_img) OR filemtime($source)>filemtime($new_img))
    {
      $img = new sfImage($source);

      $img->thumbnail($options['width'],$options['height'],$resize)
          ->saveAs($new_img);
    }

    return image_path('/'.$new_img);
  }


  /**
   * Cette fonction utilise la précédente afin d'afficher directement l'image avec les balises et les options.
   * @param <string> $image_name : le nom de l'image donc généralement le $object->getImage(), pas de répertoire
   * @param <string> $folder : le nom du répertoire dans uploads où est stockée l'image : uploads/object/source => $folder = object
   * @param <array> $options : les paramètres à passer à l'image: width, height, alt, title, class, id...
   * @param <string> $resize : l'opération sur le thumb: "scale" pour garder les proportions, "center" pour tronquer l'image
   * @param <string> $default : l'image par défaut si image_name n'existe pas
   * @return <image_path>
  */
  function showThumb($image_name, $folder, $options = array(), $resize = 'scale', $default = 'default.jpg')
  {
    if(empty($options['alt']))
     $options['alt'] = 'image '.$image_name;
    if(empty($options['title']))
     $options['title'] = 'image '.$image_name;

    $image_path = doThumb($image_name, $folder, $options, $resize, $default);
    $img = new sfImage(sfConfig::get('sf_web_dir').$image_path);

    //récupère les vraies dimensions de l'image du thumb et on écrase dans les options.
    $options['width'] = $img->getWidth();
    $options['height'] = $img->getHeight();

    return image_tag($image_path,$options);
  }