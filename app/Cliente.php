<?php
require_once __DIR__ . '/Database.php';

class Cliente
{
  public static function all(): array
  {
    // query() se usa cuando NO hay parámetros
    $sql = "SELECT id, nombre, email, telefono FROM cliente ORDER BY id DESC";
    $stmt = Database::pdo()->query($sql);
    return $stmt->fetchAll();
  }

  public static function find(int $id): ?array
  {
    // prepare() se usa cuando hay parámetros (para insertar el id)
    $sql = "SELECT id, nombre, email, telefono FROM cliente WHERE id = :id";
    $stmt = Database::pdo()->prepare($sql);

    // execute() envía el valor del parámetro :id
    $stmt->execute([':id' => $id]);

    $row = $stmt->fetch();
    return $row ? $row : null;
  }

  public static function create(string $nombre, string $email, int $telefono): void
  {
    // Validación mínima para principiantes
    $nombre = trim($nombre);
    if ($nombre === '') {
      throw new Exception("El nombre es obligatorio.");
    } else if (strlen($nombre) < 2 || strlen($nombre) > 20){
      throw new Exception("El nombre tiene que tener entre 3 y 20 caracteres.");
    }

    $email = trim($_POST['email']);
    $pattern = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/";
    if ($email === '') {
      throw new Exception("El correo es obligatorio.");
    } else if (!preg_match($pattern, $email))  {
      throw new Exception("El email no es valido");
    }

    $sql = "INSERT INTO cliente (nombre, email, telefono) VALUES (:nombre, :email, :telefono)";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([
      ':nombre' => $nombre,
      ':email' => $email,
      ':telefono' => $telefono
    ]);
  }

  public static function update(int $id, string $nombre, string $email, int $telefono): void
  {
    if ($id <= 0) {
      throw new Exception("ID inválido.");
    }

    $nombre = trim($nombre);
    if ($nombre === '') {
      throw new Exception("El nombre es obligatorio.");
    }
    if ($email === '') {
      throw new Exception("El correo es obligatorio.");
    }

    if (!ctype_digit($telefono)){
      throw new Exception("El telefono tiene que ser con numeros.");
    }

    $sql = "UPDATE cliente SET nombre = :nombre, email = :email, telefono = :telefono WHERE id = :id";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([
      ':id' => $id,
      ':nombre' => $nombre,
      ':email' => $email,
      ':telefono' => $telefono
    ]);
  }

  public static function delete(int $id): void
  {
    if ($id <= 0) {
      throw new Exception("ID inválido.");
    }

    $sql = "DELETE FROM cliente WHERE id = :id";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([':id' => $id]);
  }
}