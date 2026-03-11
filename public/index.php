<?php
require_once __DIR__ . '/../app/ClienteController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$controller = new ClienteController();

// Si el método no existe, error sencillo
if (!method_exists($controller, $action)) {
  echo "Acción no encontrada";
  exit;
}

// Llamamos a la acción
$controller->$action();