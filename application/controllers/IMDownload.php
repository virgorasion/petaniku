<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IMDownload extends CI_Controller {


    public function index()
    {
        $url=urldecode($this->input->get("f",true));
        $re = '/^assets\/im\/group_/m';
        $re2 = '/\.{1,3}\//m';

        if(preg_match($re,$url)) {
            if(preg_match($re2,$url)){
                die("Invalid Request");
            }
            $file_get = urldecode($this->input->get("fn", true));
            if (file_exists($url)) {
                $fileSize = filesize($url);
                $tmp = explode(".", $url);
                switch ($tmp[count($tmp) - 1]) {
                    case "php":
                        die("Invalid Request");
                        break;
                    case "js":
                        die("Invalid Request");
                        break;
                    case "htaccess":
                        die("Invalid Request");
                        break;
                    case "html":
                        die("Invalid Request");
                        break;
                    case "pdf":
                        $ctype = "application/pdf";
                        break;
                    case "exe":
                        $ctype = "application/octet-stream";
                        break;
                    case "zip":
                        $ctype = "application/zip";
                        break;
                    case "doc":
                        $ctype = "application/msword";
                        break;
                    case "xls":
                        $ctype = "application/vnd.ms-excel";
                        break;
                    case "ppt":
                        $ctype = "application/vnd.ms-powerpoint";
                        break;
                    case "gif":
                        $ctype = "image/gif";
                        break;
                    case "png":
                        $ctype = "image/png";
                        break;
                    case "jpeg":
                        $ctype = "image/jpg";
                        break;
                    case "jpg":
                        $ctype = "image/jpg";
                        break;
                    case "mp3":
                        $ctype = "audio/mp3";
                        break;
                    case "wav":
                        $ctype = "audio/x-wav";
                        break;
                    case "wma":
                        $ctype = "audio/x-wav";
                        break;
                    case "mpeg":
                        $ctype = "video/mpeg";
                        break;
                    case "mpg":
                        $ctype = "video/mpeg";
                        break;
                    case "mpe":
                        $ctype = "video/mpeg";
                        break;
                    case "mov":
                        $ctype = "video/quicktime";
                        break;
                    case "avi":
                        $ctype = "video/x-msvideo";
                        break;
                    case "src":
                        $ctype = "plain/text";
                        break;
                    default:
                        $ctype = "application/force-download";
                }

                header("Pragma: public"); // required
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: private", false); // required for certain browsers
                header("Content-Type: $ctype");
                header("Content-Disposition: attachment; filename=\"" . $file_get . "\";");
                header("Content-Transfer-Encoding: binary");
                header("Content-Length: " . $fileSize);
                //ob_clean();
                flush();
                readfile($url);
                exit;
            }
        }else{
            die("Invalid Request");
        }
    }

}