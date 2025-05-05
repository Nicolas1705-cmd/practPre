<style>
  /* ... tus estilos ... */
</style>
<?php
  if ($peticionAjax) {
    require_once "../controller/HomeController.php";
  } else {
    require_once "./controller/HomeController.php";
  }
  $inst= new HomeController();
  $datosGraficoDiario = $inst->obtenerDatosGraficoHome('day');
  $datosGraficoSemanal = $inst->obtenerDatosGraficoHome('week');
  $datosGraficoMensual = $inst->obtenerDatosGraficoHome('month');
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
  <div>
    <label for="periodo">Seleccionar período:</label>
    <select id="periodo">
      <option value="day" selected>Diario</option>
      <option value="week">Semanal</option>
      <option value="month">Mensual</option>
    </select>
  </div>
  <div style="margin-left: 0; margin-right:100px;">
    <canvas id="miGrafico"></canvas>
  </div>

  <script>
    const datosDiarios = <?php echo json_encode($datosGraficoDiario); ?>;
    const datosSemanales = <?php echo json_encode($datosGraficoSemanal); ?>;
    const datosMensuales = <?php echo json_encode($datosGraficoMensual); ?>;

    const chartCanvas = document.getElementById('miGrafico').getContext('2d');
    let miGrafico;

    function actualizarGrafico(datos) {
      if (miGrafico) {
        miGrafico.destroy();
      }

      const data = {
        labels: datos.labels,
        datasets: [{
          label: 'Registros por Período',
          data: datos.datasets,
          backgroundColor: 'rgba(255, 99, 132, 0.7)',
          borderColor: 'rgba(255, 99, 132, 1)',
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
                text: 'Período'
              }
            }
          }
        },
      };

      miGrafico = new Chart(chartCanvas, config);
    }

    document.getElementById('periodo').addEventListener('change', function() {
      const periodoSeleccionado = this.value;
      let nuevosDatos;

      if (periodoSeleccionado === 'day') {
        nuevosDatos = datosDiarios;
      } else if (periodoSeleccionado === 'week') {
        nuevosDatos = datosSemanales;
      } else if (periodoSeleccionado === 'month') {
        nuevosDatos = datosMensuales;
      }

      actualizarGrafico(nuevosDatos);
    });

    actualizarGrafico(datosDiarios);
  </script>
</div>