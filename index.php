<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title>Inicio - Usuarios</title>
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>PHP CRUD Usuarios</h3>
            </div>
            <div class="row">
                <p>
                    <a href="create.php" class="btn btn-success">Crear Usuario</a>
                </p>
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Correo Electrónico</th>
                          <th>Teléfono</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM usuarios ORDER BY id DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['nombre'] . '</td>';
                                echo '<td>'. $row['email'] . '</td>';
                                echo '<td>'. $row['telefono'] . '</td>';
                                echo '<td><a class="btn btn-primary" href="read.php?id='.$row['id'].'">Ver</a>';
								echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Actualizar</a>';
								echo '<a class="btn btn-warning" href="delete.php?id='.$row['id'].'">Eliminar</a>';
								echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
                      </tbody>
                </table>
        </div>
    </div>
  </body>
</html>