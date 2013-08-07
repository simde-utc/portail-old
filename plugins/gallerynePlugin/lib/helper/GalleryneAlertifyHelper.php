<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlertifyHelper
 * This Helper is charged to display messages to the user
 * Just call it like this in your templates :
    <?php use_helper('Alertify') ?>
    <?php echo displayGalleryneNotifications('notice') ?>
 * @author lbernard
 */
function displayGalleryneNotifications($name){
    $sf_user = sfContext::getInstance()->getUser();
    $message = '';
    if($sf_user->hasFlash($name)){
        $message .= '<div class="'.$name.' alertify">';
        if(is_array($sf_user->getFlash($name))){
            $message .= '<ul>';
            foreach ($sf_user->getFlash($name) as $key => $notice) {
                $message .= '<li>'.$notice.'</li>';
            }
            $message .= '</ul>';
        }else{
            $message .= $sf_user->getFlash($name);
        }
        $message .= '</div>';
    }
    return $message;
}
?>