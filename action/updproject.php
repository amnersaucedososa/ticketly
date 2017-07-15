<?php

	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_description'])){
			$errors[] = "Descripción vacío";
		} else if (empty($_POST['mod_name'])){
			$errors[] = "Nombre Vacio";
		} else if (
			!empty($_POST['mod_name']) &&
			!empty($_POST['mod_description'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$name = $_POST["mod_name"];
		$description = $_POST["mod_description"];
		
		$id=$_POST['mod_id'];

		$sql="update project set name=\"$name\",description=\"$description\" where id=$id";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "EL proyecto ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>