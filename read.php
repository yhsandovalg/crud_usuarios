<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM usuarios where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title>CRUD - Leer Usuarios</title>
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Leer Usuario</h3>
                    </div>
                    
					<form>
					  <div class="row mb-3">
						<label for="inputName" class="col-sm-2 col-form-label">Nombre</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" id="inputName" value="<?php echo $data['nombre'];?>" disabled>
						</div>
					  </div>
					  <div class="row mb-3">
						<label for="inputPhone" class="col-sm-2 col-form-label">Teléfono</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" id="inputPhone" value="<?php echo $data['telefono'];?>" disabled>
						</div>
					  </div>
					  <div class="row mb-3">
						<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-10">
						  <input type="email" class="form-control" id="inputEmail" value="<?php echo $data['email'];?>" disabled>
						</div>
					  </div>
					  <div class="row mb-3">
						<label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
						<div class="col-sm-10">
						  <input type="password" class="form-control" id="inputPassword" value="<?php echo $data['password'];?>" disabled>
						</div>
					  </div>
					  
					  
					  <a class="btn btn-primary" href="index.php">Volver</a>
					</form>

                    
                </div>
                 
    </div>
  </body>
</html>
