<?php

/** This file is part of KCFinder project
  *
  *      @desc Upload calling script
  *   @package KCFinder
  *   @version 2.51
  *    @author Pavel Tzonkov <pavelc@users.sourceforge.net>
  * @copyright 2010, 2011 KCFinder Project
  *   @license http://www.opensource.org/licenses/gpl-2.0.php GPLv2
  *   @license http://www.opensource.org/licenses/lgpl-2.1.php LGPLv2
  *      @link http://kcfinder.sunhater.com
  */


if($_GET['resize-thumb'] == true){
     $json = new stdClass;
     require "core/autoload.php";
     $uploader = new uploader();
     if($thumb = $uploader->makeSmallSize('../../../' . $_POST['file'], true)){
          $json->success = $thumb;
     }else {
          $json->success = 'false';
     }
     echo json_encode($json);
}else if($_GET['resize-large'] == true) {
     $json = new stdClass;
     require "core/autoload.php";
     $uploader = new uploader();
     if($thumb = $uploader->makeLargeSize('../../../' . $_POST['file'], true)){
          $json->success = $thumb;
     }else {
          $json->success = 'false';
     }
     echo json_encode($json);
}else {
     require "core/autoload.php";
     $uploader = new uploader();
     $uploader->upload();
}
?>