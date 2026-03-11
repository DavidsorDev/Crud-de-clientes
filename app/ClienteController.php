<?php
require_once __DIR__ . '/Cliente.php';

class ClienteController{
  
  public function index(): void
  {
    // Pedimos los datos al modelo
    $cliente = Cliente::all();

    // Cargamos la vista, que usará $productos
    require __DIR__ . '/views/clientes/index.php';
  }

  public function create(): void
  {
    // Solo muestra el formulario de crear
    $error = '';
    require __DIR__ . '/views/clientes/create.php';
  }

  public function store(): void
  {
    // Recoge datos del formulario y guarda en BD
    try {
      $nombre = isset($_POST['nombre']) ? (string)$_POST['nombre'] : '';
      $apellidos = isset($_POST['apellidos']) ? (string)$_POST['apellidos'] : '';
      $telefono = isset($_POST['telefono']) ? (int)$_POST['telefono'] : 0;

      Cliente::create($nombre, $apellidos, $telefono);

      // Redirigimos al listado
      header("Location: index.php?action=index");
      exit;
    } catch (Exception $e) {
      // Si hay error, volvemos a mostrar el formulario con mensaje
      $error = $e->getMessage();
      require __DIR__ . '/views/clientes/create.php';
    }
  }

  public function edit(): void
  {
    // Muestra el formulario de editar con datos existentes
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    $cliente = Cliente::find($id);
    if ($cliente === null) {
      echo "Producto no encontrado";
      return;
    }

    $error = '';
    require __DIR__ . '/views/clientes/edit.php';
  }

  public function update(): void
  {
    // Recoge datos del formulario de editar y actualiza
    try {
      $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
      $nombre = isset($_POST['nombre']) ? (string)$_POST['nombre'] : '';
      $apellidos = isset($_POST['apellidos']) ? (string)$_POST['apellidos'] : '';
      $telefono = isset($_POST['telefono']) ? (int)$_POST['telefono'] : 0;

      Cliente::update($id, $nombre, $apellidos, $telefono);

      header("Location: index.php?action=index");
      exit;
    } catch (Exception $e) {
      // Si falla, volvemos a cargar la vista edit con el error
      $error = $e->getMessage();

      $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
      $cliente = Cliente::find($id);
      if ($cliente === null) {
        echo "Cliente no encontrado";
        return;
      }

      require __DIR__ . '/views/clientes/edit.php';
    }
  }

  public function delete(): void
  {
    // Borrado sencillo por POST
    try {
      $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
      Cliente::delete($id);

      header("Location: index.php?action=index");
      exit;
    } catch (Exception $e) {
      echo "No se pudo borrar: " . $e->getMessage();
    }
  }
}