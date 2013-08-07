<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of utils
 *
 * @author leny
 */
class GalleryneUtils {
    static $actions = array();
    static public function slugify($text) {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    static public function light_image($thumb_url, $image_url, $image_link_options = array(), $thumb_options = array()) {
        //make lightbox effect
        $thumb_tag = image_tag($thumb_url, $thumb_options);

        $image_link_options['class'] = isset($image_link_options['class']) ? $image_link_options['class'] . " lightbox" : 'lightbox';

        echo link_to($thumb_tag, $image_url, $image_link_options);
    }

    static public function light_image_activate() {
        if (!sfContext::hasInstance())
            return;

        //add resources
        $response = sfContext::getInstance()->getResponse();

        //check if jqueryreloaded plugin is activated
        if (sfConfig::has('sf_jquery_web_dir') && sfConfig::has('sf_jquery_core'))
            $response->addJavascript(sfConfig::get('sf_jquery_web_dir') . '/js/' . sfConfig::get('sf_jquery_core'));
        else
            throw new Exception("Theres is no JqueryReloaded plugin !");

        //JQuery Lightbox specific
        $response->addJavascript(sfConfig::get("app_sf_jquery_lightbox_js_dir") . 'jquery.lightbox-0.5.js');
        $response->addStylesheet(sfConfig::get("app_sf_jquery_lightbox_css_dir") . 'jquery.lightbox-0.5.css');

        $code = "$(function() {
        $('a.lightbox').lightBox({
          imageLoading: '" . sfConfig::get('app_sf_jquery_lightbox_imageLoading') . "',
          imageBtnClose: '" . sfConfig::get('app_sf_jquery_lightbox_imageBtnClose') . "',
          imageBtnPrev: '" . sfConfig::get('app_sf_jquery_lightbox_imageBtnPrev') . "',
          imageBtnNext: '" . sfConfig::get('app_sf_jquery_lightbox_imageBtnNext') . "',
          imageBlank: '" . sfConfig::get('app_sf_jquery_lightbox_imageBlank') . "',
          txtImage: '" . sfConfig::get('app_sf_jquery_lightbox_txtImage') . "',
          txtOf: '" . sfConfig::get('app_sf_jquery_lightbox_txtOf') . "' });
      });";

        echo javascript_tag($code);
    }

    static public function gallery_path($gallery = '') {
        $uploadDir = sfConfig::get("app_gallerynePlugin_path_gallery");
        $webDir = sfConfig::get("sf_web_dir");
        $upload_gallery_path = substr($uploadDir, strlen($webDir), strlen($uploadDir) - strlen($webDir));
        $upload_gallery_path = str_replace('\\', '/', $upload_gallery_path);
        return $upload_gallery_path;
    }

    /* @PARAMS : $permissions = 'drwxr-xr-x';
     */

    public static function getChmodValue($permissions) {
        $mode = 0;

        if ($permissions[1] == 'r')
            $mode += 0400;
        if ($permissions[2] == 'w')
            $mode += 0200;
        if ($permissions[3] == 'x')
            $mode += 0100;
        else if ($permissions[3] == 's')
            $mode += 04100;
        else if ($permissions[3] == 'S')
            $mode += 04000;

        if ($permissions[4] == 'r')
            $mode += 040;
        if ($permissions[5] == 'w')
            $mode += 020;
        if ($permissions[6] == 'x')
            $mode += 010;
        else if ($permissions[6] == 's')
            $mode += 02010;
        else if ($permissions[6] == 'S')
            $mode += 02000;

        if ($permissions[7] == 'r')
            $mode += 04;
        if ($permissions[8] == 'w')
            $mode += 02;
        if ($permissions[9] == 'x')
            $mode += 01;
        else if ($permissions[9] == 't')
            $mode += 01001;
        else if ($permissions[9] == 'T')
            $mode += 01000;

        return $mode;
    }

    public static function getMaxSize() {
        foreach (sfConfig::get("app_gallerynePlugin_thumbnails_sizes") as $size) {
            
        }
        return $size;
    }

    public static function camelize($text) {
        $camelized = preg_replace(array('#/(.?)#e', '/(^|_|-)+(.)/e'), array("'::'.strtoupper('\\1')", "strtoupper('\\2')"), $text);
        if (!function_exists('lcfirst')) {
            function lcfirst($string) {
            return substr_replace($string, strtolower(substr($string, 0, 1)), 0, 1);
            }
        }
        return lcfirst($camelized);
        
    }

    public static function getIcon($file,$path=null) {
        $imageExt = array("jpg", "jpeg", "jpe", "gif", "bmp", "png", "svg");
        $videoExt = array("avi", "mkv", "m4v", "mp4", "mpeg", "ogm", "ogm","webm");
        $audioExt = array("mp3", "wav", "wma", "flac", "aac", "oga", "ogg");
        $pdfExt = array("pdf");
        $docExt = array("doc", "docx", "odt");

        preg_match('/[a-z0-9]+$/', strtolower($file), $match);
        if(count($match[0])){
            $filenameExt = $match[0];

            if (in_array($filenameExt, $imageExt)) {
                $src = $file;
            } elseif (in_array($filenameExt, $videoExt)) {
                $src = "/gallerynePlugin/images/files/video.png";
            } elseif (in_array($filenameExt, $audioExt)) {
                $src = "/gallerynePlugin/images/files/audio.png";
            } elseif (in_array($filenameExt, $pdfExt)) {
                $src = "/gallerynePlugin/images/files/pdf.png";
            } elseif (in_array($filenameExt, $docExt)) {
                $src = "/gallerynePlugin/images/files/document.png";
            } else {
                $src = "/gallerynePlugin/images/files/file.png";
            }
            // search for thumbnail with filename
            if(!is_null($path)){
                $pathArray = explode("/",$path.$file);
                $filename = $pathArray[count($pathArray)-1];
                unset($pathArray[count($pathArray)-1]);
                $dir = implode("/",$pathArray)."/";
                $handle = opendir($dir);
                while ($elem = readdir($handle)) {
                    if(!(is_dir($dir . '/' . $elem) && substr($elem, -2, 2) !== '..' && substr($elem, -1, 1) !== '.')){
                        if(preg_match("/^".preg_replace("/\.[a-z0-9]+$/","",$filename)."/",$elem) && preg_match("/\.jpg$/",$elem))
                            $posterFilename = $elem;
                    }
                }
                if(isset($posterFilename)){
                    $pathArray = explode("/",$file);
                    unset($pathArray[count($pathArray)-1]);
                    $src = implode("/",$pathArray)."/".$posterFilename;
                }
            }
            return $src;
        }
    }

    /** Recursive function
     * @param string $dir path of the dir to remove /home/user/workspace/mywebsite/uploads/mydir (ie.)
     */
    public static function removeFolder($dir) {
        $handle = opendir($dir);
        while ($elem = readdir($handle)) {
            if (is_dir($dir . '/' . $elem) && substr($elem, -2, 2) !== '..' && substr(
                            $elem, -1, 1) !== '.') {
                self::removeFolder($dir . '/' . $elem);
            } else {
                if (substr($elem, -2, 2) !== '..' && substr($elem, -1, 1) !== '.') {
                    unlink($dir . '/' . $elem);
                }
            }
        }

        $handle = opendir($dir);
        while ($elem = readdir($handle)) {
            if (is_dir($dir . '/' . $elem) && substr($elem, -2, 2) !== '..' && substr(
                            $elem, -1, 1) !== '.') {
                self::removeFolder($dir . '/' . $elem);
                rmdir($dir . '/' . $elem);
            }
        }
        rmdir($dir);
    }
    
    public static function getActions(){
        sfContext::getInstance()->getEventDispatcher()->notify(new sfEvent(null, 'avGalleryne.getActions', array()));
        return self::$actions;
    }
    public static function addAction(avGalleryneAction $action){
        self::$actions[$action->getTitle()] = $action;
    }

    public static function convert($filename, $path, array $extensions) {
        foreach($extensions as $extension){
            $fileNameArray = explode(".",$filename);
            unset($fileNameArray[count($fileNameArray)-1]);
            $newFilename = implode(".",$fileNameArray).".".$extension;
            if(is_file("/usr/bin/HandBrakeCLI")){
                exec('/bin/sh '.sfConfig::get('sf_plugins_dir').'/gallerynePlugin/lib/convertVideo.sh'.' start');
                $cmd = '/bin/sh '.sfConfig::get('sf_plugins_dir').'/gallerynePlugin/lib/convertVideo.sh'.' convert '.  $path.'/'.$filename.' '.$path.'/'.$newFilename.'  '.$path.'/'.$newFilename.'-handbrake.out';
                exec($cmd);
            }else{
//                use ffmpeg  ?
//                exec("ffmpeg -i ".  $path.$this->getUrl()." -f psp -r 29.97 -b 768k -ar 24000 -ab 64k -s 800x600 ".$path.$this->getPathByExtension($extension));
            }
        }
    }

    public static function getExtension($file) {
        preg_match('/[a-z0-9]+$/', strtolower($file), $match);
        $filenameExt = "";
        if(count($match[0]))
            $filenameExt = $match[0];
        return $filenameExt;
    }

}

?>
