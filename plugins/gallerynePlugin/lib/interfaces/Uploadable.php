<?php
/**
 *
 * @author lbernard
 */
interface Uploadable {
    public function getFullPath($withFile=false, $size=null);
    public function getTempPath($withFile=false, $size=null);
    public function getPath($withFile=false, $size=null);
    public function getLimitMax();
    public function getAllowedExtensions();
    public function callback();
}

?>
