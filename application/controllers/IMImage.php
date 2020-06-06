<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IMImage extends CI_Controller {


    public function index()
    {
        $re2 = '/\.{1,3}\//m';
        $image =urldecode($this->input->get("u",true));

        if(preg_match($re2,$image)){
            die("Invalid Request");
        }
        /* if($image!=null || strlen($image)!=0)
         $strFileExt = explode('.' , $image);

         if($strFileExt[count($strFileExt) - 1] == 'jpg' or $strFileExt[count($strFileExt) - 1]== 'jpeg'){
             header('Content-Type: image/jpeg');
         }elseif($strFileExt[count($strFileExt) - 1] == 'png'){
             header('Content-Type: image/png');
         }elseif($strFileExt[count($strFileExt) - 1] == 'gif'){
             header('Content-Type: image/gif');
         }elseif($strFileExt[count($strFileExt) - 1] == 'ico'){
             header('Content-Type: image/x-icon');
         }else{
             die("error");
         }

         /*if(file_exists($path)){
             $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));
             $imageData =@file_get_contents($path);
         }else{
             $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));
             $imageData =@file_get_contents($image);
             file_put_contents($path,$imageData);
         }*/

      /*  if($imageData==null){
            die("error");
        }*/
        /*$cache_ends = 60*60*24*365;
        header("Pragma: public");
        header("Cache-Control: maxage=". $cache_ends);
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $cache_ends).' GMT');*/
        //echo $imageData;*/
       // $image = preg_replace("/^http:/i", "https:", $image);
        header("Location: $image");
        exit;
    }

}