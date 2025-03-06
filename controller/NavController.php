
<?php 

if ($peticionAjax) {
  require_once "../model/mainModel.php";
}else{
  require_once "./model/mainModel.php";
}

class NavController extends mainModel
{
 /*
 //usuario de gmail, email a donde deseamos conectarnos
    var $user="andrescalderon@americansoftperu.pe";
    //password de nuestro email
    var $password="caldecalde123";
    //inforrmación necesaria para conectarnos al INBOX de gmail,
    //incluye el servidor, el puerto 993 que es para imap, e indicamos que no valide con ssl
    var $mailbox="{mail.americansoftperu.pe:993/imap/ssl/novalidate-cert}INBOX";
 
    var $fecha="10-MAR-2021"; //desde que fecha sincronizara
 
 function getNumMensajes(){
   $inbox = imap_open($this->mailbox,$this->user,$this->password) or die('Cannot connect to Gmail: ' . imap_last_error());
  $numero_emails = imap_num_msg($inbox);
 echo $numero_emails;
 }

    //metodo que realiza todo el trabajo
    function obtenerAsuntosDelMails(){
 
        //realizamos la conexión por medio de nuestras credenciales
         $inbox = imap_open($this->mailbox,$this->user,$this->password) or die('Cannot connect to Gmail: ' . imap_last_error());
 
          //con la instrucción SINCE mas la fecha entre apostrofes ('')
          //indicamos que deseamos los mails desde una fecha en especifico
          //imap_search sirve para realizar un filtrado de los mails.
         $emails=imap_search($inbox,'SINCE "'.$this->fecha.'"');

         //comprbamos si existen mails con el la busqueda otorgada
         
            if($emails) {
                 //ahora recorremos los mails
                 foreach($emails as $email_number)
                {
                     //leemos las cabeceras de mail por mail enviando el inbox de nuestra conexión
                     //enviando el identificdor del mail
                    $overview=imap_fetch_overview($inbox,$email_number);
$html= '';
                    //ahora recorremos las cabeceras para obtener el asunto
                    $contador=1;
                    foreach($overview as $over){
                      
 
                        //comprobamos que exista el asunto (subject) en la cabecera
                        //y si es asi continuamos
                        if(isset($over->subject)){
 $cuerpo = imap_fetchbody($inbox,$email_number,1);
                            //aqui pasa algo curioso
                            //el asunto vendra con caracteres raros
                            //para ello anexo una función que lo limpia y lo muestra ya legible
                            //en lenguaje mortal ====== '.imap_qprint($cuerpo).' .
                            $asunto=$this->fix_text_subject($over->subject);
 
                            //y aqui simplemente hacemos un echo para mostrar el asunto
                            $html.= '<li>
                      <a href="#"   onclick="leerGmail(`'.utf8_decode($asunto).'`,`'.imap_qprint($cuerpo).'`)"  >
                        <figure class="image">
                          <img src="'.SERVERURL.'view/assets/images/!sample-user.jpg" alt="Andres" class="img-circle" />
                        </figure>
                        <span class="title">'.utf8_decode($asunto)."n".'</span>
                        <span class="message truncate">'.imap_qprint($cuerpo).'</span>
                      </a>
                    </li>';
                    echo $html;
                        }
                    }
 
                }
            }
 
    }
 
    //arregla texto de asunto
    function fix_text_subject($str)
    {
        $subject = '';
        $subject_array = imap_mime_header_decode($str);
 
        foreach ($subject_array AS $obj)
            $subject .= utf8_encode(rtrim($obj->text, "t"));
 
        return $subject;
    }

    */

    public function listNotifyController(){


    $html='';
    $htmlextra='';
         $htmlextra2='';
               $count=0; 
               $type2=false;
               $dataN=array();
  
                     $subdataN=array();
                                          $subdataN3=array();
                                          $subdataN4=array();

                      $idPersonal=0;
                      $idcargo=0;

   if (isset($_SESSION['Encryuser'])) {
   $idPersonal=mainModel::decryption($_SESSION['Encryuser']); 
   $idcargo=mainModel::decryption($_SESSION['Encrycargo']);

 }
   if (!isset($_SESSION['Encryuser'])) {
       return $html;

 } 


   
 $count2=0;
 $count3=0; $count4=0; $count5=0; $sql='';
 if ($idcargo!=12) {
 $sql="SELECT * FROM tnotify where idPersonal =$idPersonal and status=1 ORDER BY idnotify DESC  "; }
 if ($idcargo==12) {
 $sql="SELECT * FROM tnotify where idProvider  =$idPersonal and status=1 ORDER BY idnotify DESC  "; }
  $consultaN =mainModel::execute_query($sql); 
 $data = $consultaN->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $index=>$row) {
    $icon=''; 
    $cuerpo="";
    $link='';
    if ($row['typemessage']==1 ) {
          $idnotify=mainModel::encryption($row['idnotify']);
       $subdataN[]=$idnotify;
    $count++;
    }
//modifi
if ($row['typemessage']==2) {
                            $idnotify=mainModel::encryption($row['idnotify']);
                     $subdataN2=array();
       $subdataN2[]=$idnotify;
              $icon='fa  fa-inbox  bg-success';
    $cuerpo='<span class="title"> Solicitud de Servicio Terminada </span> ';
   $htmlextra.="<li id='LnType'".$count2."'>
                      <a href='javascript:void(0);' onclick='verNotify(".json_encode($subdataN2).")'  class='clearfix'>
                        <div class='image'>
                          <i class='".$icon."'></i>
                        </div>
                         ".$cuerpo."
                      </a>
                    </li>";
         $count2++;
    }

//modifi
if ($row['typemessage']==4) {
     $idnotify=mainModel::encryption($row['idnotify']);
       $subdataN3[]=$idnotify;
         $count3++;
    }

if ($row['typemessage']==5) {
     $idnotify=mainModel::encryption($row['idnotify']);
       $subdataN4[]=$idnotify;
         $count4++;
    }
     }
   
     if ($count>=1) {
     $htmlextra2.=' ';
             $txtCount="";
     if ($count>=2) {
              $txtCount="".$count;
             }
              $icon='fa  fa-inbox  bg-success';
    $cuerpo='<span class="title">'.$txtCount.' Solicitud de Servicio</span> ';
   $htmlextra.="<li id='Ln'".$count."'>
                      <a href='javascript:void(0);' onclick='verNotify(".json_encode($subdataN).")'  class='clearfix'>
                        <div class='image'>
                          <i class='".$icon."'></i>
                        </div>
                         ".$cuerpo."
                      </a>

                    </li>";
     }
  if ($count3>=1) {
   $htmlextra2.=' ';
             $txtCount2="";
     if ($count3>=2) {
              $txtCount2="".$count3;
             }
              $icon='fa  fa-inbox  bg-success';
    $cuerpo='<span class="title">'.$txtCount2.'  Manifiesto de Carga </span> ';
   $htmlextra.="<li id='LnType'".$count3."'>
                      <a href='javascript:void(0);' onclick='verNotify(".json_encode($subdataN3).")'  class='clearfix'>
                        <div class='image'>
                          <i class='".$icon."'></i>
                        </div>
                         ".$cuerpo."
                      </a>

                    </li>";
}

  if ($count4>=1) {
   $htmlextra2.=' ';
             $txtCount3="";
     if ($count4>=2) {
              $txtCount3="".$count4;
             }
              $icon='fa  fa-inbox  bg-success';
    $cuerpo='<span class="title">'.$txtCount3.' Recojo  de Remesa</span> ';
   $htmlextra.="<li id='LnType'".$count4."'>
                      <a href='javascript:void(0);' onclick='verNotify(".json_encode($subdataN4).")'  class='clearfix'>
                        <div class='image'>
                          <i class='".$icon."'></i>
                        </div>
                         ".$cuerpo."
                      </a>
                    </li>";
}


$array5= array(); $count5=0; $txtCount5='';
 if ($idcargo!=12) {
 $sqlextraremesa="SELECT * FROM tnotify where idPersonal =$idPersonal and typemessage=6  and status=1 ORDER BY idnotify DESC  "; }

 if ($idcargo==12) {
 $sqlextraremesa="SELECT * FROM tnotify where idProvider  =$idPersonal and typemessage=6   and status=1 ORDER BY idnotify DESC  "; }
 
  $consultaNremesa=mainModel::execute_query($sqlextraremesa); 
 $dataremesa = $consultaNremesa->fetchAll(PDO::FETCH_ASSOC);

foreach ($dataremesa as $key => $value) {
     $idnotify=mainModel::encryption($row['idnotify']);
       $array5[]=$idnotify;
    $count5++;
}

  if ($count5>=1) {
   $htmlextra2.=' ';
             $txtCount5="";
     if ($count5>=2) {
              $txtCount5="".$count5;
             }
              $icon='fa  fa-inbox  bg-success';
    $cuerpo='<span class="title">'.$txtCount5.' Recojo  de Remesa</span> ';
   $htmlextra.="<li id='LnType'".$count5."'>
                      <a href='javascript:void(0);' onclick='verNotify(".json_encode($array5).")'  class='clearfix'>
                        <div class='image'>
                          <i class='".$icon."'></i>
                        </div>
                         ".$cuerpo."
                      </a>
                    </li>";
}


$array6= array(); $count6=0; $txtCount6='';
 if ($idcargo!=12) {
 $sqlextraremesareprog="SELECT * FROM tnotify where idPersonal =$idPersonal and typemessage=7  and status=1 ORDER BY idnotify DESC  "; }



 if ($idcargo==12) {
 $sqlextraremesareprog="SELECT * FROM tnotify where idProvider  =$idPersonal and typemessage=7   and status=1 ORDER BY idnotify DESC  "; }

  $consultaNremesareporg=mainModel::execute_query($sqlextraremesareprog); 
 $dataremesareprog = $consultaNremesareporg->fetchAll(PDO::FETCH_ASSOC);
foreach ($dataremesareprog as $key => $value) {
 $idnotify=mainModel::encryption($value['idnotify']);
       $array6[]=$idnotify;
    $count6++;
}
  if ($count6>=1) {
   $htmlextra2.=' ';
             $txtCount6="";
  if ($count6>=2) {
              $txtCount6="".$count6;
             }
              $icon='fa  fa-inbox  bg-success';
    $cuerpo='<span class="title">'.$txtCount6.' Recojo  de Remesa Progamados</span> ';
   $htmlextra.="<li id='LnType'".$count6."'>
                      <a href='javascript:void(0);' onclick='verNotify(".json_encode($array6).")'  class='clearfix'>
                        <div class='image'>
                          <i class='".$icon."'></i>
                        </div>
                         ".$cuerpo."
                      </a>
                    </li>";
}


$tc=($count+$count2+$count3+$count4+$count5+$count6);

        $html='  <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                <i class="fa fa-bell"></i>
                <span class="badge BNOT">'.$tc.'</span>
              </a>
      
              <div class="dropdown-menu notification-menu">
                <div class="notification-title">
                  <span class="pull-right label label-default LNOT">'.$tc.'</span>
                  Alertas
                </div>
      
                <div class="content">
                  <ul>'.$htmlextra.'</ul>
          <hr />
                <div class="text-right rNotify">
            
             </div>
                </div>
              </div> ';
     return $html;
  }

        public function activaDeleteNotifyController($idElemento ,$status){
          $html='';
foreach ($idElemento as $valor) {
$id=mainModel::decryption($valor);
      $status=mainModel::limpiar_cadena($status);
      if(mainModel::activateDeleteSimple("tnotify",$id,$status,"idnotify")){
 $consultaN =mainModel::execute_query("SELECT * FROM tnotify where idnotify =$id  ");
 $data = $consultaN->fetch(PDO::FETCH_ASSOC);
    if ($data['typemessage']==1 || $data['typemessage']==2) {
      $html='<script> window.location.href="'.SERVERURL.'solicitud/"</script>';
    }
  if ($data['typemessage']==4) {
      $html='<script> window.location.href="'.SERVERURL.'manifiesto/"</script>';
    }
      if ($data['typemessage']==5) {
      $html='<script> window.location.href="'.SERVERURL.'remesa?nivel=1"</script>';
    }
     if ($data['typemessage']==7) {
      $html='<script> window.location.href="'.SERVERURL.'remesa?nivel=2"</script>';
    }



      }

}
$inst=self::deletenotify();

   return $html;
    }

public function deletenotify(){
$query = mainModel::conect()->prepare("DELETE FROM tnotify WHERE  status = 0 ");
    $query->execute();
    return $query;
  }


}