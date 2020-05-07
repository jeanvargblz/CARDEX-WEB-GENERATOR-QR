<div class="container">
	<?php
	/* listado; insertar; editar; eliminar */
	$accion="listado";
	if(isset($_REQUEST['accion']))
		$accion=$_REQUEST['accion'];
	switch($accion):
		case "listado";
			?>
			<h1 class="m-2 p-2"><font color="white">PROMOCIONES</font></h1><div align="center">
				<a href="?pagina=promociones&accion=insertar" class="btn btn-dark btn-block">CREAR</a>				
			</div>
			<table class="table">
			<thead bgcolor="#263238"><th><font color="white">ID</font></th><th><font color="white">NOMBRE</font></th><th><font color="white">IMAGEN</font></th><th><font color="white">ACCIONES</font></th></thead>
			<tbody>
			<?php 
			$u=$user->buscar("promociones","1");
			foreach($u as $r):
				?>
				<tr>
					<td bgcolor="white"><?php echo $r['id'];?></td>
					<td bgcolor="white"><?php echo $r['nombre'];?></td>
					<td bgcolor="white"><img src="img/promociones/<?php echo $r['foto'];?>"></td>
					<td bgcolor="white">
						<a href="?pagina=promociones&accion=editar&id=<?php echo $r['id'] ?>" class="btn btn-danger">EDITAR</a>
						<a href="?pagina=promociones&accion=eliminar&id=<?php echo $r['id'] ?>" onclick="return confirm('¿Estas seguro de eliminarlo?')" class="btn btn-danger">ELIMINAR</a>
					</td>
				</tr>				
				<?php
			endforeach;
			 ?>	
			</tbody>
			
			</table>
			<?php
		break;
		case "insertar";
			if(isset($_POST['btn'])):

				$nombre 		= $_POST['nombre'];
				$descripcion 	= $_POST['descripcion'];
				$productos_id	= $_POST['productos_id'];
				$foto 			= $_FILES['foto']['name'];

				if(move_uploaded_file($_FILES['foto']['tmp_name'],'img/promociones/'.$foto))
					echo "foto subida";
				else
					echo "error al subir";

				$data 			= "'".$nombre."','".$descripcion."',".$productos_id.",'".$foto."'";

				$u = $user->insertar("promociones",$data);
				if ($u):
					echo "inserto OK.";
				else:
					echo "No se pudo insertar";
				endif;
				
			else:
				?>
				<center>
				<div style="background-color:#babdbe" class="col-sm-8 p-3 shadow"> 
					<form action="" enctype="multipart/form-data" method="post">
						<div class="form-group">
							<div align="left">
							<label for="nombre">NOMBRE:</label></div>
							<input type="text" class="form-control" required name="nombre">
						</div>
						<div class="form-group">
							<div align="left">
							<label for="descripcion">DESCRIPCION:</label></div>
							<textarea class="form-control" required name="descripcion"></textarea>
						</div>
						<div class="form-group">
							<div align="left">
							<label for="foto"><font color="#263238">FOTO:</font></label></div>
							<input type="file" class="form-control" required name="foto">
						</div>
						<div class="form-group">
							<div align="left">
							<label for="productos_id">PRODUCTO:</label></div>
							<?php $p=$user->buscar("productos","1") ?>
							<div align="left"><select name="productos_id">
								<?php foreach($p as $pr): ?>
								<option value="<?php echo $pr['id']?>"><?php echo $pr['nombre']?></option>
								<?php endforeach; ?>
							</select></div>
						</div>
						<input type="submit" name="btn" value="GUARDAR">
					</form>
				</div>
				</center>
				<?php
			endif;
		break;
		case "editar";
			if(isset($_POST['btn'])):

				$nombre 		= $_POST['nombre'];
				$descripcion 	= $_POST['descripcion'];
				$productos_id	= $_POST['productos_id'];

				$data 			= "nombre='".$nombre."',descripcion='".$descripcion."',productos_id=".$productos_id;

				$u = $user->actualizar("promociones",$data, "id=".$_REQUEST['id']);
				if ($u):
					echo "Edicion OK.";
				else:
					echo "No se pudo edicion";
				endif;
				
			else:
				$u= $user->buscar("promociones","id=".$_REQUEST['id']);
				foreach ($u as $r):
				?>
				<center>
				<div style="background-color:#babdbe" class="col-sm-5 p-3 shadow"> 
					<form action="" enctype="multipart/form-data" method="post">
						<div class="form-group">
							<label for="nombre">NOMBRE:</label>
							<input type="text" class="form-control" required name="nombre" value="<?php echo $r['nombre'] ?>">
						</div>
						<div class="form-group">
							<label for="descripcion">DESCRIPCION:</label>
							<textarea class="form-control" required name="descripcion"><?php echo $r['descripcion']?></textarea>
						</div>
						<div class="form-group">
							<label for="foto">FOTO:</label>
							<img src="img/<?php echo $r['foto'] ?>">
							<input type="file" class="form-control" name="foto">
						</div>
						<div class="form-group">
							<label for="productos_id">PRODUCTO:</label>
							<?php $p=$user->buscar("productos","1") ?>
							<select name="productos_id">
								<option value="<?php echo $r['productos_id']?>"><?php echo $r['productos_id']?></option>
								<?php foreach($p as $pr): ?>
								<option value="<?php echo $pr['id']?>"><?php echo $pr['nombre']?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<input type="submit" name="btn" value="ACTUALIZAR">
						<input type="hidden" name="id" value="<?php echo $_REQUEST['id']?>">
					</form>
				</div>
				</center>
				<?php
				endforeach;
			endif;
		break;
		case "eliminar";
			if(isset($_REQUEST['id'])):
				$u = $user->borrar("promociones","id=".$_REQUEST['id']);
				if($u):
					echo "Registro eliminado OK....";
				else:
					echo "Registro error al eliminar";
				endif;
			endif;
		break;
	endswitch;
	?>
</div>
