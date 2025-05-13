<style>
  .dashboard-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
  }

  .dashboard-info-box {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 5px;
    border: 1px solid #ddd;
  }

  .dashboard-info-box h3 {
    margin-top: 0;
    color: #333;
  }

  .dashboard-info-box p {
    font-size: 1.1em;
    color: #555;
  }

  .dashboard-info-box strong {
    font-weight: bold;
    color: #007bff;
  }

  .alert-anomalo {
    background-color: #ffe0b2;
    border: 1px solid #ffb300;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 10px;
    color: #ff6f00;
  }

  .alert-anomalo h4 {
    margin-top: 0;
    margin-bottom: 5px;
  }
</style>
<?php
if ($peticionAjax) {
  require_once "../controller/HomeController.php";
} else {
  require_once "./controller/HomeController.php";
}
$inst = new HomeController();
$datosGraficoDiario = $inst->obtenerDatosGraficoHome('day');
$datosGraficoSemanal = $inst->obtenerDatosGraficoHome('week');
$datosGraficoMensual = $inst->obtenerDatosGraficoHome('month');

// Obtener los nuevos datos para los indicadores de combustible
$totalMensualCombustible = $inst->obtenerTotalMensualCombustible();
$vehiculoMasEficiente = $inst->obtenerVehiculoMasEficiente();
$alertasRendimientoAnomalo = $inst->obtenerAlertasRendimientoAnomalo();
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

  <div class="dashboard-container">
    <div class="dashboard-info-box">
      <h3>Total Gastado en Combustible (Mensual)</h3>
      <p><strong>S/ <?php echo number_format($totalMensualCombustible, 2); ?></strong></p>
    </div>

    <div class="dashboard-info-box">
      <h3>Vehículo Más Eficiente</h3>
      <?php if ($vehiculoMasEficiente): ?>
        <p><strong>Vehículo:</strong> <?php echo $vehiculoMasEficiente['nombre_vehiculo']; ?></p>
        <p><strong>Rendimiento Promedio:</strong> <?php echo number_format($vehiculoMasEficiente['rendimiento_promedio'], 2); ?> km/litro</p>
      <?php else: ?>
        <p>No hay datos suficientes para calcular.</p>
      <?php endif; ?>
    </div>

    <div class="dashboard-info-box">
      <h3>Alertas de Rendimiento Anómalo</h3>
      <?php if (!empty($alertasRendimientoAnomalo)): ?>
        <?php foreach ($alertasRendimientoAnomalo as $alerta): ?>
          <div class="alert-anomalo">
            <h4>¡Rendimiento Bajo!</h4>
            <p><strong>Vehículo:</strong> <?php echo $alerta['nombre_vehiculo']; ?></p>
            <p><strong>Rendimiento:</strong> <?php echo number_format($alerta['rendimiento'], 2); ?> km/litro</p>
            <p><strong>Fecha:</strong> <?php echo $alerta['dateRegister']; ?></p>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No se encontraron alertas de rendimiento anómalo.</p>
      <?php endif; ?>
    </div>
  </div>

  <div>
    <label for="periodo">Seleccionar período para el gráfico:</label>
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