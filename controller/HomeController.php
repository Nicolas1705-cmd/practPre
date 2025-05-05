<?php 

if ($peticionAjax) {
	require_once "../model/mainModel.php";
}else{
	require_once "./model/mainModel.php";
}

class HomeController extends mainModel
{

  public function obtenerDatosGraficoHome($periodo = 'day') {
    $conexion = mainModel::conect();
    $datos = [];
    $labels = [];
    $datasets = [];
    $sql = "";
    $formatoFechaSQL = "";

    switch ($periodo) {
        case 'week':
            $sql = "SELECT DATE_FORMAT(MIN(dateRegister), '%d-%m-%Y') AS inicio_semana, DATE_FORMAT(MAX(dateRegister), '%d-%m-%Y') AS fin_semana, YEARWEEK(dateRegister, 1) AS periodo, COUNT(*) AS cantidad FROM tsolicitud GROUP BY periodo ORDER BY periodo";
            break;
        case 'month':
            $sql = "SELECT DATE_FORMAT(MIN(dateRegister), '%d de %M de %Y') AS inicio_mes, DATE_FORMAT(MAX(dateRegister), '%d de %M de %Y') AS fin_mes, DATE_FORMAT(dateRegister, '%Y-%m') AS periodo, COUNT(*) AS cantidad FROM tsolicitud GROUP BY periodo ORDER BY periodo";
            break;
        default: // 'day'
            $sql = "SELECT DATE_FORMAT(dateRegister, '%d-%m-%Y') AS fecha_registro, DATE_FORMAT(dateRegister, '%W, %d de %M de %Y') AS periodo_formateado, COUNT(*) AS cantidad FROM tsolicitud GROUP BY fecha_registro ORDER BY dateRegister";
            break;
    }

    $resultado = $conexion->query($sql);

    if ($resultado) {
        $registros = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($registros as $registro) {
            if ($periodo === 'week') {
                $labels[] = 'Semana del ' . $registro['inicio_semana'] . ' al ' . $registro['fin_semana'];
                $datasets[] = $registro['cantidad'];
            } else if ($periodo === 'month') {
                $labels[] = 'Mes del ' . $registro['inicio_mes'] . ' al ' . $registro['fin_mes'];
                $datasets[] = $registro['cantidad'];
            } else { // 'day'
                $labels[] = $registro['periodo_formateado'];
                $datasets[] = $registro['cantidad'];
            }
        }

        $datos = [
            'labels' => $labels,
            'datasets' => $datasets
        ];

        $resultado = null; 
    } else {
     
        error_log("Error al ejecutar la consulta: " . $conexion->error);
        $datos = [
            'labels' => [],
            'datasets' => []
        ];
    }

    $conexion = null; 
    return $datos;
}

    
   public function lccontrolcargoview(){
  $idCargo=mainModel::decryption($_SESSION['Encrycargo']);
$request=mainModel::conect()->query("SELECT * from tmodulo ");
    $request = $request->fetchAll(PDO::FETCH_ASSOC);
    $cargojs=[];

    foreach ($request as $index=>$row) {
$request2=mainModel::conect()->query("SELECT t1.*,t2.name as nameOperacion from trol_operacion as t1 INNER JOIN toperacion as t2 on t1.idOperacion = t2.idOperacion where t2.idModulo=".$row["idModulo"]."  AND t2.name='ver' AND t1.idCargo =".$idCargo);
    $request2 = $request2->fetchAll(PDO::FETCH_ASSOC);
      $request3=mainModel::conect()->query("SELECT * from toperacion where idModulo =".$row["idModulo"]."  and name='ver' ");
    $request3 = $request3->fetchAll(PDO::FETCH_ASSOC);
foreach ($request3 as $index3=>$row3) {
  $check=0;
 foreach ($request2 as $index2=>$row2) {
       if($row2["idOperacion"]==$row3["idOperacion"]){
$check=1;

       }
     }

  $idmodulo=$row["name"];
$cargojs[]=["modulo"=>$idmodulo,"view"=>$check];
}

}
return json_encode($cargojs);

}
	
	 public function pintarhomeController(){
$ns=0; $nsp=0; $nc=0; $np=0;
		$cnn = mainModel::conect();
      $idPersonal=mainModel::decryption($_SESSION['Encryuser']); 
   $cargo=mainModel::decryption($_SESSION['Encrycargo']);

 if ($cargo!=11&&$cargo!=12&&$cargo!=9&&$cargo!=10&&$cargo!=5&&$cargo!=13) {
	$sql="SELECT COUNT(*) as ns FROM tsolicitudservice where status=1";
}
 if ($cargo==13) {
    //or t1.idFaseTypeService=6 

$sql ="SELECT COUNT(*) as ns FROM tsolicitudservice where idPersonal=$idPersonal  and status=1  ";

    }
       if ($cargo==5) {
$sql ="SELECT COUNT(*) as ns FROM tsolicitudservice  WHERE  jdo=$idPersonal and   status=1;";
    }
     if ($cargo==10) {
$sql ="SELECT COUNT(*) as ns FROM tsolicitudservice as t1   INNER JOIN detailloperadorservice as t4 on t1.idSolicitudService = t4.idSolicitudService  WHERE  t4.nameoperator=$idPersonal and t1.status=1";
    }
      if ($cargo==11) {
$sql ="SELECT COUNT(*) as ns  FROM tsolicitudservice as t1  WHERE 
  t1.cda=$idPersonal  and t1.status=1 ";
    }

          if ($cargo==12) {
$sql ="SELECT COUNT(*) as ns  FROM tsolicitudservice as t1  WHERE  t1.ptlp=$idPersonal  and t1.status=1 ";
    }
        if ($cargo==9) {
$sql ="SELECT COUNT(*) as ns FROM tsolicitudservice as t1   WHERE t1.namedriver =$idPersonal  and t1.status=1 ";
    }

		$datasolicitud = $cnn->query($sql);
		$infosolicitud = $datasolicitud->fetch(PDO::FETCH_ASSOC);

		$dataclientes= $cnn->query("SELECT COUNT(*) as nclientes FROM tclient  where status=1 ");
		$clientes = $dataclientes->fetch(PDO::FETCH_ASSOC);

		$dataprovider = $cnn->query("SELECT COUNT(*) as nprovider FROM tprovider where status=1 ");
		$provider = $dataprovider->fetch(PDO::FETCH_ASSOC);
	
  	$template="";
		$template.="  <div class='col-md-6 col-lg-6 col-xl-4'>
                <section class='panel panel-featured-let panel-featured-primary'>
                  <div class='panel-body'>
                    <div class='widget-summary'>
                      <div class='widget-summary-col widget-summary-col-icon'>
                        <div class='summary-icon bg-primary'>
                          <i class='fa fa-paper-plane'></i>
                        </div>
                      </div>
                      <div class='widget-summary-col'>
                        <div class='summary'>
                          <h4 class='title'>Solicitudes Servicio</h4>
                          <div class='info'>
                            <strong class='amount'>".$infosolicitud['ns']."</strong><br>
                          </div>
                        </div>
                        <div class='summary-footer'>
                          <a class='text-muted text-uppercase'>(Revisar)</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>
          
             ";
          if ($cargo!=12) {

$template.="    <div class='col-md-6 col-lg-6 col-xl-4'>
                <section class='panel panel-featured-top panel-featured-primary'>
                  <div class='panel-body'>
                    <div class='widget-summary'>
                      <div class='widget-summary-col widget-summary-col-icon'>
                        <div class='summary-icon bg-primary'>
                          <i class='fa fa-users'></i>
                        </div>
                      </div>
                      <div class='widget-summary-col'>
                        <div class='summary'>
                          <h4 class='title'>Clientes</h4>
                          <div class='info'>
                            <strong class='amount'>".$clientes['nclientes']."</strong><br>
                          </div>
                        </div>
                        <div class='summary-footer'>
                          <a class='text-muted text-uppercase'>(Revisar)</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>
              <div class='col-md-6 col-lg-6 col-xl-4'>
                <section class='panel panel-featured-right panel-featured-primary'>
                  <div class='panel-body'>
                    <div class='widget-summary'>
                      <div class='widget-summary-col widget-summary-col-icon'>
                        <div class='summary-icon bg-primary'>
                          <i class='fa fa-cubes'></i>
                        </div>
                      </div>
                      <div class='widget-summary-col'>
                        <div class='summary'>
                          <h4 class='title'>Proveedores</h4>
                          <div class='info'>
                            <strong class='amount'>".$provider['nprovider']."</strong>
                            <br>
                          </div>
                        </div>
                        <div class='summary-footer'>
                          <a class='text-muted text-uppercase'>(Revisar)</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>";  } 
		return $template;
}

  public function getChartHome(){

  
    $cnn = mainModel::conect();
    $result = array();
    $sql=''; 
          $idPersonal=mainModel::decryption($_SESSION['Encryuser']); 
   $cargo=mainModel::decryption($_SESSION['Encrycargo']);

 if ($cargo!=11&&$cargo!=12&&$cargo!=9&&$cargo!=10&&$cargo!=5&&$cargo!=13) {
    $sql="select (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 1 and status=1 ) as Enero,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 2  and status=1  ) as Febrero,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 3  and status=1  ) as Marzo,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 4  and status=1  ) as Abril,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 5  and status=1  ) as Mayo,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 6  and status=1  ) as Junio,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 7  and status=1  ) as Julio,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 8  and status=1  ) as Agosto,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 9  and status=1  ) as Septiembre,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 10  and status=1  ) as Octubre,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 11  and status=1  ) as Noviembre,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 12  and status=1 ) as Diciembre";}

 if ($cargo==13) {
    
$sql =" 
select (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 1 and status=1 and idPersonal=$idPersonal  ) as Enero,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 2  and status=1 and idPersonal=$idPersonal  ) as Febrero,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 3  and status=1  and idPersonal=$idPersonal ) as Marzo,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 4  and status=1  and idPersonal=$idPersonal ) as Abril,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 5  and status=1 and idPersonal=$idPersonal  ) as Mayo,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 6  and status=1  and idPersonal=$idPersonal ) as Junio,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 7  and status=1 and idPersonal=$idPersonal  ) as Julio,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 8  and status=1  and idPersonal=$idPersonal  ) as Agosto,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 9  and status=1 and idPersonal=$idPersonal  ) as Septiembre,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 10  and status=1  and idPersonal=$idPersonal ) as Octubre,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 11  and status=1 and idPersonal=$idPersonal  ) as Noviembre,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 12  and status=1 and idPersonal=$idPersonal  ) as Diciembre";

    }

if ($cargo==5) {
$sql ="select (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 1 and status=1 and  jdo=$idPersonal ) as Enero,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 2  and status=1 and jdo=$idPersonal  ) as Febrero,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 3  and status=1  and jdo=$idPersonal ) as Marzo,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 4  and status=1  and jdo=$idPersonal ) as Abril,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 5  and status=1 and jdo=$idPersonal  ) as Mayo,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 6  and status=1  and jdo=$idPersonal ) as Junio,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 7  and status=1 and jdo=$idPersonal  ) as Julio,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 8  and status=1  and jdo=$idPersonal  ) as Agosto,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 9  and status=1 and jdo=$idPersonal  ) as Septiembre,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 10  and status=1  and jdo=$idPersonal ) as Octubre,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 11  and status=1 and jdo=$idPersonal  ) as Noviembre,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 12  and status=1 and jdo=$idPersonal  ) as Diciembre ";
    }
 if ($cargo==10) {
$sql ="select (select COUNT(*) from tsolicitudservice  as t1   INNER JOIN detailloperadorservice as t4 on t1.idSolicitudService = t4.idSolicitudService   where YEAR(t1.dateRegister)=YEAR(CURDATE())  AND MONTH(t1.dateRegister) = 1 and t1.status=1 and t4.nameoperator=$idPersonal) as Enero,
    (select COUNT(*) from tsolicitudservice  as t1   INNER JOIN detailloperadorservice as t4 on t1.idSolicitudService = t4.idSolicitudService  where YEAR(t1.dateRegister)=YEAR(CURDATE())  AND MONTH(t1.dateRegister) = 2  and t1.status=1 and t4.nameoperator=$idPersonal  ) as Febrero,
    (select COUNT(*) from tsolicitudservice  as t1   INNER JOIN detailloperadorservice as t4 on t1.idSolicitudService = t4.idSolicitudService    where YEAR(t1.dateRegister)=YEAR(CURDATE())  AND MONTH(t1.dateRegister) = 3  and t1.status=1  and t4.nameoperator=$idPersonal ) as Marzo,
    (select COUNT(*) from tsolicitudservice  as t1   INNER JOIN detailloperadorservice as t4 on t1.idSolicitudService = t4.idSolicitudService  where YEAR(t1.dateRegister)=YEAR(CURDATE())  AND MONTH(t1.dateRegister) = 4  and t1.status=1  and t4.nameoperator=$idPersonal ) as Abril,
    (select COUNT(*) from tsolicitudservice  as t1   INNER JOIN detailloperadorservice as t4 on t1.idSolicitudService = t4.idSolicitudService  where YEAR(t1.dateRegister)=YEAR(CURDATE())  AND MONTH(t1.dateRegister) = 5  and t1.status=1 and t4.nameoperator=$idPersonal) as Mayo,
    (select COUNT(*) from tsolicitudservice  as t1   INNER JOIN detailloperadorservice as t4 on t1.idSolicitudService = t4.idSolicitudService   where YEAR(t1.dateRegister)=YEAR(CURDATE())  AND MONTH(t1.dateRegister) = 6  and t1.status=1  and t4.nameoperator=$idPersonal ) as Junio,
    (select COUNT(*) from tsolicitudservice  as t1   INNER JOIN detailloperadorservice as t4 on t1.idSolicitudService = t4.idSolicitudService  where YEAR(t1.dateRegister)=YEAR(CURDATE())  AND MONTH(t1.dateRegister) = 7  and t1.status=1 and t4.nameoperator=$idPersonal  ) as Julio,
    (select COUNT(*) from tsolicitudservice  as t1   INNER JOIN detailloperadorservice as t4 on t1.idSolicitudService = t4.idSolicitudService  where YEAR(t1.dateRegister)=YEAR(CURDATE())  AND MONTH(t1.dateRegister) = 8  and t1.status=1  and t4.nameoperator=$idPersonal ) as Agosto,
    (select COUNT(*) from tsolicitudservice  as t1   INNER JOIN detailloperadorservice as t4 on t1.idSolicitudService = t4.idSolicitudService  where YEAR(t1.dateRegister)=YEAR(CURDATE())  AND MONTH(t1.dateRegister) = 9  and t1.status=1 and t4.nameoperator=$idPersonal  ) as Septiembre,
    (select COUNT(*) from tsolicitudservice  as t1   INNER JOIN detailloperadorservice as t4 on t1.idSolicitudService = t4.idSolicitudService  where YEAR(t1.dateRegister)=YEAR(CURDATE())  AND MONTH(t1.dateRegister) = 10  and t1.status=1 and t4.nameoperator=$idPersonal ) as Octubre,
    (select COUNT(*) from tsolicitudservice  as t1   INNER JOIN detailloperadorservice as t4 on t1.idSolicitudService = t4.idSolicitudService   where YEAR(t1.dateRegister)=YEAR(CURDATE())  AND MONTH(t1.dateRegister) = 11  and t1.status=1 and t4.nameoperator=$idPersonal  ) as Noviembre,
    (select COUNT(*) from tsolicitudservice  as t1   INNER JOIN detailloperadorservice as t4 on t1.idSolicitudService = t4.idSolicitudService  where YEAR(t1.dateRegister)=YEAR(CURDATE())  AND MONTH(t1.dateRegister) = 12  and t1.status=1 and t4.nameoperator=$idPersonal  ) as Diciembre";
    }

  if ($cargo==11) {
$sql ="select (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 1 and status=1 and  cda=$idPersonal ) as Enero,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 2  and status=1 and cda=$idPersonal  ) as Febrero,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 3  and status=1  and cda=$idPersonal ) as Marzo,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 4  and status=1  and cda=$idPersonal ) as Abril,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 5  and status=1 and cda=$idPersonal  ) as Mayo,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 6  and status=1  and cda=$idPersonal ) as Junio,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 7  and status=1 and cda=$idPersonal  ) as Julio,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 8  and status=1  and cda=$idPersonal  ) as Agosto,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 9  and status=1 and cda=$idPersonal  ) as Septiembre,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 10  and status=1  and cda=$idPersonal ) as Octubre,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 11  and status=1 and cda=$idPersonal  ) as Noviembre,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 12  and status=1 and cda=$idPersonal  ) as Diciembre";
    }

     if ($cargo==12) {
$sql ="select (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 1 and status=1 and  ptlp=$idPersonal ) as Enero,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 2  and status=1 and ptlp=$idPersonal  ) as Febrero,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 3  and status=1  and ptlp=$idPersonal ) as Marzo,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 4  and status=1  and ptlp=$idPersonal ) as Abril,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 5  and status=1 and ptlp=$idPersonal  ) as Mayo,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 6  and status=1  and ptlp=$idPersonal ) as Junio,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 7  and status=1 and ptlp=$idPersonal  ) as Julio,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 8  and status=1  and ptlp=$idPersonal  ) as Agosto,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 9  and status=1 and ptlp=$idPersonal  ) as Septiembre,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 10  and status=1  and ptlp=$idPersonal ) as Octubre,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 11  and status=1 and ptlp=$idPersonal  ) as Noviembre,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 12  and status=1 and ptlp=$idPersonal  ) as Diciembre";
    }
      
  if ($cargo==9) {
$sql ="select (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 1 and status=1 and  namedriver=$idPersonal ) as Enero,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 2  and status=1 and namedriver=$idPersonal  ) as Febrero,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 3  and status=1  and namedriver=$idPersonal ) as Marzo,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 4  and status=1  and namedriver=$idPersonal ) as Abril,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 5  and status=1 and namedriver=$idPersonal  ) as Mayo,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 6  and status=1  and namedriver=$idPersonal ) as Junio,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 7  and status=1 and namedriver=$idPersonal  ) as Julio,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 8  and status=1  and namedriver=$idPersonal  ) as Agosto,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 9  and status=1 and namedriver=$idPersonal  ) as Septiembre,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 10  and status=1  and namedriver=$idPersonal ) as Octubre,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 11  and status=1 and namedriver=$idPersonal  ) as Noviembre,
    (select COUNT(*) from tsolicitudservice where YEAR(dateRegister)=YEAR(CURDATE())  AND MONTH(dateRegister) = 12  and status=1 and namedriver=$idPersonal  ) as Diciembre";
    }
    $data = $cnn->query($sql);
    $data = $data->fetch(PDO::FETCH_ASSOC);

    return $data;


  }




	
}