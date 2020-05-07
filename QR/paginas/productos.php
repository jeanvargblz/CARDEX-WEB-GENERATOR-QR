<div class="container">
	<?php
	/* listado; insertar; editar; eliminar */
	$accion="listado";
	if(isset($_REQUEST['accion']))
		$accion=$_REQUEST['accion'];
	switch($accion):
		case "listado";
			?>
			<h1 class="m-2 p-2"><font color="white"><font face="impact,arial,verdana">PRODUCTO</font></font></h1>
			<div align="center">
			<a href="?pagina=productos&accion=insertar" class="btn btn-dark btn-block"><font face="courier new,arial,Comic Sans MS">CREAR</font></a>
			</div>
			<table class="table">
			<thead bgcolor="#263238"><th><font color="white">ID</font></th><th><font color="white">NOMBRE</font></th><th><font color="white">QR</font></th><th><font color="white">ACCIONES</font></th></thead>
			<tbody>
			<?php 
			$u=$user->buscar("productos","1");
			foreach($u as $r):
				?>
				<tr>
					<td bgcolor="white"><?php echo $r['id'];?></td>
					<td bgcolor="white"><?php echo $r['nombre'];?></td>
					<td bgcolor="white"><img src="img/qr/<?php echo $r['qr'];?>"></td>
					<td bgcolor="white">
						<a href="?pagina=productos&accion=editar&id=<?php echo $r['id'] ?>" class="btn btn-danger">EDITAR</a>
						<a href="?pagina=productos&accion=eliminar&id=<?php echo $r['id'] ?>&foto=<?php echo $r['foto'] ?>" onclick="return confirm('¿Estas seguro de eliminarlo?')" class="btn btn-danger">ELIMINAR</a>
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
				$precio 		= $_POST['precio'];
				$stock 			= $_POST['stock'];
				$estado 		= $_POST['estado'];
				$foto 			= $_FILES['foto']['name'];
				if(move_uploaded_file($_FILES['foto']['tmp_name'],'img/'.$foto))
					echo "foto subida";  
				else
					echo "error al subir"; 

				$qr 			= "foto.jpg";

				$data 			= "'".$nombre."','".$descripcion."','".$foto."','".$qr."',".$precio.",".$stock.",".$estado;

				$u = $user->insertar("productos",$data);
				if ($u):
					require "class/phpqrcode/qrlib.php";
					$id = $user->lastInsertId();
					QRcode::png($id, "img/qr/qr_".$id.".png",'L',10,5);
					$user->actualizar("productos","qr='qr_".$id.".png'", "id=".$id);

					echo "inserto OK.";
				else:
					echo "No se pudo insertar";
				endif;
				
			else:
				?></font></font></font></b></h1>
				<br><br>
				<center>
				<div style="background-color:#babdbe" class="col-sm-6 col-sm-5 p-3 shadow "> 
					<form action="" enctype="multipart/form-data" method="post">
						<div class="form-group ">
							<div align="left">
							<label for="nombre"><font color="#263238"><b>NOMBRE:</b></font></label></div>
							<input type="text" class="form-control" required name="nombre">
						</div>
						<div class="form-group">
							<div align="left">
							<label for="descripcion"><font color="#263238"><b>DESCRIPCION:</b></font></label></div>
							<textarea class="form-control" required name="descripcion"></textarea>
						</div>
						<div class="form-group">
							<div align="left">
							<label for="foto"><font color="#263238"><b>FOTO:</b></font></label></div>
							<input type="file" class="form-control" required name="foto">
						</div>
						<div class="form-group">
							<div align="left">
							<label for="precio"><font color="#263238"><b>PRECIO:</b></font></label></div>
							<input type="text" class="form-control" required name="precio">
						</div>
						<div class="form-group">
							<div align="left">
							<label for="stock"><font color="#263238"><b>STOCK:</b></font></label></div>
							<input type="text" class="form-control" required name="stock">
						</div>
						<div class="form-group">
							<div align="left">
							<label for="estado"><font color="#263238"><b>ESTADO:</b></font></label></div>
							<input type="text" class="form-control" required name="estado">
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
				$precio 		= $_POST['precio'];
				$stock 			= $_POST['stock'];
				$estado 		= $_POST['estado'];

				
				$foto 			= $_FILES['foto']['name'];
				if(move_uploaded_file($_FILES['foto']['tmp_name'],'img/'.$foto))
					//unlink

					echo "foto subida";
				else
					echo "error al subir";
				
				$qr 			= "foto.jpg";
				
				$data = "nombre='".$nombre."',descripcion='".$descripcion."',foto='".$foto."',precio=".$precio.",stock=".$stock.",estado=".$estado;


				$u = $user->actualizar("productos",$data, "id=".$_REQUEST['id']);
				if ($u):
					require "class/phpqrcode/qrlib.php";
					$id = $_REQUEST['id'];
					QRcode::png($id, "img/qr/qr_".$id.".png",'L',10,5);
					$user->actualizar("productos","qr='qr_".$id.".png'", "id=".$id);
					echo "Edicion OK.";
				else:
					echo "No se pudo edicion";
				endif;
				
			else:
				$u= $user->buscar("productos","id=".$_REQUEST['id']);
				foreach ($u as $r):
				?>
				<center>
				<div style="background-color:#babdbe" class="col-sm-6 col-sm-7 p-3 shadow "> 
					<form action="" enctype="multipart/form-data" method="post">
						<div class="form-group">
							<div align="left">
							<label for="nombre"><font color="#263238"><b>NOMBRE:</b></font></label></div>
							<input type="text" class="form-control" required name="nombre" value="<?php echo $r['nombre'] ?>">
						</div>
						<div class="form-group">
							<div align="left">
							<label for="descripcion"><font color="#263238"><b>DESCRIPCION:</b></font></label></div>
							<textarea class="form-control" required name="descripcion"><?php echo $r['descripcion']?></textarea>
						</div>
						<div class="form-group">
							<div align="left">
							<label for="foto"><font color="#263238"><b>FOTO:</b></font></label></div>
							<img src="img/<?php echo $r['foto'] ?>" width="100" height="100">
							<div align="right">
							<input type="file" class="form-control" name="foto"></div>
						</div>
						<div class="form-group">
							<div align="left">
							<label for="precio"><font color="#263238"><b>PRECIO:</b></font></label></div>
							<input type="text" class="form-control" required name="precio" value="<?php echo $r['precio'] ?>">
						</div>
						<div class="form-group">
							<div align="left">
							<label for="stock"><font color="#263238"><b>STOCK:</b></font></label></div>
							<input type="text" class="form-control" required name="stock" value="<?php echo $r['stock'] ?>">
						</div>
						<div class="form-group">
							<div align="left">
							<label for="estado"><font color="#263238"><b>ESTADO:</b></font></label></div>
							<input type="text" class="form-control" required name="estado" value="<?php echo $r['estado'] ?>">
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
				$u = $user->borrar("productos","id=".$_REQUEST['id']);
				if($u):
					if(unlink("img/".$_REQUEST['foto']))
						echo "foto eliminada";
					else
						echo "foto no eliminada";
					echo "Registro eliminado OK....";
				else:
					echo "Registro error al eliminar";
				endif;
			endif;
		break;
	endswitch;
	?>
</div>
