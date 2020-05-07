<div class="container">
	<?php
	$accion="listado";
	if(isset($_REQUEST['accion']))
		$accion=$_REQUEST['accion'];
	switch ($accion):
		case 'listado';
			?>
			<h1 class="m-2 p-2"><font color="white"><font face="impact,arial,verdana">REGISTRO</font></font></h1>
			<table class="table">
			<thead bgcolor="#263238">
				<th><font color="white">ID</font></th>
				<th><font color="white">NOMBRE</font></th>
				<th><font color="white">DESCRIPCION</font></th>
				<th><font color="white">PRECIO</font></th>
				<th><font color="white">STOCK</font></th>
				<th><font color="white">FECHA Y HORA</font></th>
			</thead>
			<tbody>
				<?php
				$u=$user->buscar("registro","1");
				foreach ($u as $r):
					?>
					<tr>
					<td bgcolor="white"><?php echo $r['id'];?></td>
					<td bgcolor="white"><?php echo $r['nombre'];?></td>
					<td bgcolor="white"><?php echo $r['descripcion'];?></td>
					<td bgcolor="white">S/. <?php echo $r['precio'];?></td>
					<td bgcolor="white"><?php echo $r['stock'];?> und</td>
					<td bgcolor="white"><?php echo $r['fechahora'];?></td>
					</tr>
					<?php 
				endforeach;
				?>					
			</tbody>
			</table>
			<div align="center">
			<?php
			$registro = "SELECT * FROM registro";
			?>
			<form method="post" class="form" action="../../QR/paginas/reporte.php">
				<input type="submit" name="generar_reporte" class="btn btn-success btn-block" value="EXPORTAR EN EXCEL">
			</form>
			<?php	
		break;
	endswitch;
	?>
</div>
	