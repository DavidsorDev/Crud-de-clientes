<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Crear cliente</title>
</head>
<body>

<h1>Crear cliente</h1>

<?php if ($error !== ''): ?>
  <p style="color:red"><?php echo $error; ?></p>
<?php endif; ?>

<form method="post" action="index.php?action=store">
  <p>
    Nombre:<br>
    <input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>">
  </p>
  <p>
    Correo:<br>
    <input type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
  </p>
  <p>
    Telefono:<br>
    <input type="tel" step="1" name="telefono" pattern="[0-9]{9}" value="<?php echo isset($_POST['telefono']) ? $_POST['telefono'] : ''; ?>">
  </p>

  <button type="submit">Guardar</button>
</form>

<p><a href="index.php?action=index">Volver</a></p>

</body>
</html>