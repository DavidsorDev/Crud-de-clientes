<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar cliente</title>
</head>
<body>

<h1>Editar cliente</h1>

<?php if ($error !== ''): ?>
  <p style="color:red"><?php echo $error; ?></p>
<?php endif; ?>

<form method="post" action="index.php?action=update">
  <input type="hidden" name="id" value="<?php echo (int)$cliente['id']; ?>">

  <p>
    Nombre:<br>
    <input type="text" name="nombre" value="<?php
      // Si venimos de un error, mantenemos lo que el alumno escribió (POST).
      // Si no, mostramos lo que hay en BD ($cliente).
      echo isset($_POST['nombre']) ? $_POST['nombre'] : $cliente['nombre'];
    ?>">
  </p>

  <p>
    Apellidos:<br>
    <input type="text" name="apellidos" value="<?php
      echo isset($_POST['apellidos']) ? $_POST['apellidos'] : $cliente['apellidos'];
    ?>">
  </p>

  <p>
    Telefono:<br>
    <input type="tel" name="telefono" value="<?php
      echo isset($_POST['telefono']) ? $_POST['telefono'] : $cliente['telefono'];
    ?>">
  </p>

  <button type="submit">Actualizar</button>
</form>

<p><a href="index.php?action=index">Volver</a></p>

</body>
</html>