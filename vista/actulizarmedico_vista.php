<?php include 'plantillas/header.php'; ?>
<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

//CARGAR ESPECIALIDADES EN EL SELECT
$especialidad = $conexion -> prepare("SELECT * FROM especialidades");

$especialidad ->execute();
$especialidad = $especialidad ->fetchAll();
if(!$especialidad)
	$mensaje .= 'NO hay especialidades, por favor registre!';
?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>MEDICOS</h2>
					</div>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
						<h2>EDITAR MEDICO</h2>
						<label>Identificación:</label>
						<input type="hidden" name="id" value="<?php echo $medico['idMedico'];?>" />
						<input type="numeric" name="identificacion" placeholder="Identificación" value="<?php echo $medico['medidentificacion'];?>" requerid>
						<label>Nombres:</label>
						<input type="text" name="nombres" placeholder="Nombres:" value="<?php echo $medico['mednombres'];?>">
						<label>Apellidos:</label>
						<input type="text" name="apellidos" placeholder="Apellidos:"   value="<?php echo $medico['medapellidos'];?>">
						<label>Correo:</label>
						<input type="email" name="correo" placeholder="Correo:" value="<?php echo $medico['medcorreo'];?>">
						<label>Telefono:</label>
						<input type="numeric" name="telefono" placeholder="Telefono:" value="<?php echo $medico['medtelefono'];?>">
						<label>Especialidad:</label>
						
						<select name="especialidad">  
                        <?php foreach ($especialidad as $Sql): ?>
						<?php echo "<option value='". $Sql['espNombre']. "'>". $Sql['espNombre']. "</option>"; ?>
						<?php endforeach; ?> 
						</select>

						<input type="submit" name="enviar" value="Actualizar">
						
					</form>
						<?php  if(!empty($errores)): ?>
							<ul>
							  <?php echo $errores; ?>
							</ul>
						<?php  endif; ?>
                    <a class="btn-regresar" href="medicos.php">Regresar</a>
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>