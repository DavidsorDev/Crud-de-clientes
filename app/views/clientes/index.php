<?php
// Aquí llega la variable $productos desde el controlador
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Clientes</title>
</head>
<body>

<h1>Listado de clientes</h1>

<p><a href="index.php?action=create">Crear cliente</a></p>

<?php if (count($cliente) === 0): ?>
  <p>No hay clientes.</p>
<?php else: ?>
  <table border="1" cellpadding="6">
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Apellidos</th>
      <th>Telefono</th>
      <th>Acciones</th>
    </tr>

    <?php foreach ($cliente as $c): ?>
      <tr>
        <td><?php echo (int)$c['id']; ?></td>
        <td><?php echo $c['nombre']; ?></td>
        <td><?php echo $c['apellidos']; ?></td>
        <td><?php echo $c['telefono'] ?? 'Sin telefono' ?></td>
        <td>
          <a href="index.php?action=edit&id=<?php echo (int)$c['id']; ?>">Editar</a>

          <form method="post" action="index.php?action=delete" style="display:inline">
            <input type="hidden" name="id" value="<?php echo (int)$c['id']; ?>">
            <button type="submit">Borrar</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>

  </table>
<?php endif; ?>

</body>
</html>