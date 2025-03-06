<?php 
 $url=$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
 $url=$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
      $route=explode("/",$url);
 if($route[0]=="http://localhost/appWce2"){
 $link="http://localhost/appWce2/"; 
}else{
$link="http://localhost/appWce2/";
}
  define('SERVERURL',$link);
const COMPANY = "WCE";

const SERVERURL2 = "localhost/appWce2/";
