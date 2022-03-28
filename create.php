<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        $nombreError = null;
        $emailError = null;
        $telefonoError = null;
		$passwordError = null;
         
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
		$password = $_POST['password'];
         
        $valid = true;
        if (empty($nombre)) {
            $nombreError = 'Introduzca un Nombre';
            $valid = false;
        }
		
		if (empty($password)) {
            $passwordError = 'Introduzca una Contraseña';
            $valid = false;
        } else {
			$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
		}
         
        if (empty($email)) {
            $emailError = 'Introduzca un Correo Electrónico';
            $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Introduzca un Correo Electrónico valido';
            $valid = false;
        }
         
        if (empty($telefono)) {
            $telefonoError = 'Introduzca un Número de Teléfono';
            $valid = false;
        }
         
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO usuarios (email, password, nombre, telefono) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($email, $hashedPassword, $nombre, $telefono));
            Database::disconnect();
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title>CRUD - Crear Usuarios</title>
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Crear Usuario</h3>
                    </div>
             
                   
					
					<form action="create.php" method="post">
					  <div class="row mb-3">
						<label for="inputName" class="col-sm-2 col-form-label">Nombre</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control <?php echo !empty($nombreError)?'is-invalid':'';?>" name="nombre" value="<?php echo !empty($nombre)?$nombre:'';?>">
						  <?php if (!empty($nombreError)): ?>
						  <div class="invalid-feedback">
							<?php echo $nombreError;?>
						  </div>
						  <?php endif;?>
						</div>
					  </div>
					  <div class="row mb-3">
						<label for="telefono" class="col-sm-2 col-form-label">Teléfono</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control <?php echo !empty($telefonoError)?'is-invalid':'';?>" name="telefono" value="<?php echo !empty($telefono)?$telefono:'';?>">
						  <?php if (!empty($telefonoError)): ?>
						  <div class="invalid-feedback">
							<?php echo $telefonoError;?>
						  </div>
						  <?php endif;?>
						</div>
					  </div>
					  <div class="row mb-3">
						<label for="email" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-10">
						  <input type="email" class="form-control <?php echo !empty($emailError)?'is-invalid':'';?>" name="email" value="<?php echo !empty($email)?$email:'';?>">
						  <?php if (!empty($emailError)): ?>
						  <div class="invalid-feedback">
							<?php echo $emailError;?>
						  </div>
						  <?php endif;?>
						</div>
					  </div>
					  <div class="row mb-3">
						<label for="password" class="col-sm-2 col-form-label">Password</label>
						<div class="col-sm-10">
						  <input type="password" class="form-control <?php echo !empty($passwordError)?'is-invalid':'';?>" name="password" value="<?php echo !empty($password)?$password:'';?>">
						  <?php if (!empty($passwordError)): ?>
						  <div class="invalid-feedback">
							<?php echo $passwordError;?>
						  </div>
						  <?php endif;?>
						</div>
					  </div>
					  
					  <button type="submit" class="btn btn-success">Crear Usuario</button>
					  <a class="btn btn-primary" href="index.php">Volver</a>
					</form>
					
					
                </div>
                 
    </div>
  </body>
</html>
