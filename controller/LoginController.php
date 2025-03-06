<?php 
if ($peticionAjax==true) {
	require_once "../model/mainModel.php";
}else{
	require_once "./model/mainModel.php";
}

class LoginController extends mainModel
{
	
	public function signInController(){
 	$tipeuser=0;
  	    $email= mainModel::limpiar_cadena($_POST['email']);
		$password= mainModel::limpiar_cadena($_POST['password']);
		$rememberme="";
		if (isset($_POST['rememberme'])) {
		$rememberme=mainModel::limpiar_cadena($_POST['rememberme']);
		}
 
	$consulta =mainModel::execute_query("SELECT t1.idPersonal ,t1.names,t1.idCargo,t2.name as namecargo,t1.password FROM tpersonal as t1 INNER JOIN tcargo as t2 ON t1.idCargo = t2.idCargo WHERE t1.email='$email' and t1.idCargo != 12 ");
		if($consulta->rowCount()>=1){

			 	$tipeuser=1;

			$req = $consulta->fetch(PDO::FETCH_ASSOC);

			if (password_verify($password, $req['password'])) {
     $dato=$req['idPersonal'];
     $idPersonal=mainModel::encryption($dato);
      $fullname=$req["names"];
  	    $idCargo=mainModel::encryption($req['idCargo']);
  	    $cargo=$req['namecargo'];
        $primername=explode(" ",$fullname);
        $password=mainModel::encryption($password);
       session_start();
       $_SESSION['Encryuser']=$idPersonal;
       $_SESSION['Nameuser']=$primername[0];
       $_SESSION['Encrycargo']=$idCargo;
       $_SESSION['Namecargo']=$cargo;
       $_SESSION['Emailuser']=$email;
       $_SESSION['token_wce']=md5(uniqid(mt_rand(),true));
if ($rememberme=="chk_rec") {
   setcookie("Email_R_WCE",$email,strtotime( '+360 days' ),"/",false, false);
setcookie("pass_R_WCE",$password,strtotime( '+360 days' ),"/",false, false);
}
if ($rememberme=="") {
	if (isset($_COOKIE['Email_R_WCE'])) {
		 setcookie('Email_R_WCE', null, -1, '/');
 unset($_COOKIE["Email_R_WCE"]);
  setcookie('pass_R_WCE', null, -1, '/');
 unset($_COOKIE["pass_R_WCE"]);
	}
}
      header("location: ".SERVERURL."home");
  }else{
  	 header("location: ".SERVERURL."login?error");
  }
		} 
		if($consulta->rowCount()<1){	
		
		$rememberme="";
		if (isset($_POST['rememberme'])) {
		$rememberme=mainModel::limpiar_cadena($_POST['rememberme']);
		}
  $consulta2 =mainModel::execute_query("SELECT * FROM tprovider as t1 WHERE t1.idTypeProvider=5  AND t1.email='$email'AND  t1.password='$password'");
	
		if($consulta2->rowCount()>=1){
			$req = $consulta2->fetch(PDO::FETCH_ASSOC);
			
     $dato=$req['idProvider'];
     $idPersonal=mainModel::encryption($dato);
      $fullname=$req["name"];
  	    $idCargo=mainModel::encryption(12);
  	    $cargo="PTLP";
        $primername=explode(" ",$fullname);
        $password=mainModel::encryption($password);
       session_start();
       $_SESSION['Encryuser']=$idPersonal;
       $_SESSION['Nameuser']=$primername[0];
       $_SESSION['Encrycargo']=$idCargo;
       $_SESSION['Namecargo']=$cargo;
              $_SESSION['Emailuser']=$email;

       $_SESSION['token_wce']=md5(uniqid(mt_rand(),true));
if ($rememberme=="chk_rec") {
   setcookie("Email_R_WCE",$email,strtotime( '+360 days' ),"/",false, false);
setcookie("pass_R_WCE",$password,strtotime( '+360 days' ),"/",false, false);
}
if ($rememberme=="") {
	if (isset($_COOKIE['Email_R_WCE'])) {
		 setcookie('Email_R_WCE', null, -1, '/');
 unset($_COOKIE["Email_R_WCE"]);
  setcookie('pass_R_WCE', null, -1, '/');
 unset($_COOKIE["pass_R_WCE"]);
	}
}
      header("location: ".SERVERURL."home");
		}
			else{
      header("location: ".SERVERURL."login?error");
		}
	}
		
	}

public function sessionDistroy(){
	session_start();
	session_destroy();
	header("location: ".SERVERURL."login");
	//echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}	
}