<?php

class slideshowComponents extends sfComponents {

    /*** PARAMS
     * Gallery $gallery : is the gallery object to be displayed
     * string $template : is the  template (engine in fact) to render the slideshow (skitter, gallerific)
     * string $animation : is the animation  to use between each slide (fade, bloc etc go to the skitter page to have more information)
     * $template"skitter", $animation = "fade", $interval=3000, $hasLabel="true", $hasNumber="true", $isNavigable="true",  $hasThumbs="false", $hideTools="true"
     * $isFullscreen = "false"
     */
    public function executeWidget()
    {
        $slideshowOptions = array(
            "template" => $this->template,
             "animation" =>$this->animation,
             "interval" => $this->interval,
             "hasNumber" => $this->hasLabel,
             "hasLabel" => $this->hasNumber,
             "isNavigable" => $this->isNavigable,
             "hasThumbs" => $this->hasThumbs,
             "hideTools" => $this->hideTools,
             "isFullscreen" => $this->isFullscreen);
        $this->slideshowOptions = $slideshowOptions;
        $this->gallery = $this->gallery;
    }

}
