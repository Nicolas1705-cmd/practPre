<?php
require_once "core/config.php";
require_once "controller/viewController.php";

$estructura = new viewController();
$estructura->get_estructura_controller();

