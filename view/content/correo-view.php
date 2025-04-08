<?php
require_once "./controller/CorreoController.php";
$inst = new CorreoController();
$titulo = "correo";
$ajaxGlobal = "correoAjax";
$typeElemento = "data-type='lista'";
?>

<input type="hidden" id="ajax" value="<?php echo $ajaxGlobal; ?>" >
<input type="hidden" id="url" value="<?php echo SERVERURL; ?>" >


<header class="page-header">
    <h2>Correo</h2>
    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="<?php echo SERVERURL ?>home">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Inicio</span></li>
            <li><span>Correo</span></li>
        </ol>
        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
</header>

<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
            <a href="#" class="fa fa-times"></a>
        </div>
        <div style="display: inline-block;">
            <h2 class="panel-title">LISTADO</h2>
        </div>
        <div class="ml-xs" style="display: inline;">
            <div class="switch switch-sm switch-primary">
                <input id="myonoffswitch" type="checkbox" name="switch" data-plugin-ios-switch checked="checked" onchange="listarDatable()" />
            </div>
        </div>
    </header>
    <div class="panel-body pr-none">
        <div class="tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#popular" onclick="listarDatable()" data-toggle="tab"><i class="fa fa-star"></i> Lista</a>
                </li>
                <li>
                    <a href="#recent" onclick="resetForm()" data-toggle="tab">Nuevo Registro</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="popular" class="tab-pane active">
                    <table class="table table-bordered table-striped mb-none" id="datatable-default">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre del Destinatario</th>
                                <th>Correo del Destinatario</th>
                                <th>Asunto del Correo</th>
                                <th>Descripción</th>
                                <th>imagen</th>
                                <th>Fecha de registro</th>
                                <th class="hidden-phone">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            </tbody>
                    </table>
                </div>
                <div id="recent" class="tab-pane">
                    <div class="col-md-12">
                        <h3>Registro y Envío de Correo Publicitario</h3>
                      <form class="formAjax" action="<?php echo SERVERURL; ?>ajax/correoAjax.php" method="POST" data-form="save" data-ajax="correoAjax" data-urlhttp="<?php echo SERVERURL; ?>" <?php echo $multipart ?>  autocomplete="off" >

                 <?php echo $inst->paintForm("save"); ?>
                             <div class="RespuestaAjax"></div>

               </form>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          <script>
    function resetFormPublicitario() {
        document.querySelector('#recent input[name="name"]').value = '';
        document.querySelector('#recent input[name="email"]').value = '';
        document.querySelector('#recent textarea[name="addressee"]').value = '';
        document.querySelector('#recent input[name="description"]').value = '';
        document.querySelector('#recent input[name="image"]').value = '';
        $(".cajaenviar_publicitario").html('');
        $(".loadGuardadoPublicitario").html('');
        $(".panfenviar_publicitario").removeClass('panel-footer-guarda');
    }
</script>