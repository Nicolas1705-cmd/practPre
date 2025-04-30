<style>
  .bdprincipal {
 width: 100%;
    padding: 0 7%;
    display: table;
    margin: 0;
    max-width: none;
    background-color: #373B44;
    height: 100vh;
 }
 .content-body{
  padding: 20px !important;
 }
 .grafico-contenedor {
    width: 100%;
    height: auto;
    margin-left: 20px;
  }
  #miGrafico {
    width: 150%;
    height: 150%;
  }
</style>
<?php
  if ($peticionAjax) {
    require_once "../controller/HomeController.php";
  } else {
    require_once "./controller/HomeController.php";
  }
  $inst= new HomeController();
  $datosGrafico = $inst->obtenerDatosGraficoHome(); // Llamamos a la nueva función
?>

<header class="page-header">
  <h2>Dashboard</h2>

  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="<?php echo SERVERURL ?>">
          <i class="fa fa-home"></i>
        </a>
      </li>
      <li><span>Home</span></li>
    </ol>

    <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

</header>
<div class="content-body">
  <div style="margin-left: 0; margin-right:100px;">
    <canvas id="miGrafico"></canvas>
  </div>

  <script>
    const labels = <?php echo json_encode($datosGrafico['labels']); ?>;
    const data = {
      labels: labels,
      datasets: [{
        label: 'Registros por Fecha',
        data: <?php echo json_encode($datosGrafico['datasets']); ?>,
        backgroundColor: 'rgba(255, 99, 122, 1)',
        borderColor: 'rgba(255, 99, 122, 1)',
        borderWidth: 1
      }]
    };

    const config = {
      type: 'bar',
      data: data,
      options: {
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Cantidad de Registros'
            }
          },
          x: {
            title: {
              display: true,
              text: 'Fecha de Registro'
            }
          }
        }
      },
    };

    const miGrafico = new Chart(
      document.getElementById('miGrafico'),
      config
    );
  </script>
</div>