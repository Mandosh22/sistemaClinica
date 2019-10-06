<?php
$mensaje='';
try{
	$conexion = new PDO('mysql:host=localhost;dbname=centromedico','root','');
}catch(PDOException $e){
	echo "Error: ". $e->getMessage();
}

$consulta = $conexion -> prepare("
select c.idcita,c.citfecha,c.cithora,p.pacNombre,m.mednombres,con.conNombre,c.citestado from citas c
inner join pacientes p 
on c.citPaciente=p.idPaciente
INNER join medicos m
on c.citMedico=m.idMedico
inner join consultorios con
on c.citConsultorio=con.idConsultorio limit 5");

$consulta ->execute();
$consulta = $consulta ->fetchAll();
if(!$consulta){
	$mensaje .= 'NO HAY CITAS PARA MOSTRAR';
}
?>
<?php include 'plantillas/header.php'; ?>
	<section class="main">
		<div class="wrapp">
			<?php include 'plantillas/nav.php'; ?>
				<article>
					<div class="mensaje">
						<h2>CITAS</h2>
					</div>
					<a class="agregar" href="agregarcitas.php">Agregar Citas</a>
					<table class="tabla">
						  <tr>
							<th>#</th>
							<th>Fecha</th>
							<th>Hora</th>
							<th>Paciente</th>
							<th>Medico</th>
							<th>Consultorio</th>
							<th>Estado</th>
							<th colspan="2">Opciones</th>
						  </tr>
						<?php foreach ($consulta as $Sql): ?>
						<tr>
						<?php echo "<td class='mayusculas'>". $Sql['idcita']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['citfecha']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['cithora']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['pacNombre']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['mednombres']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['conNombre']. "</td>"; ?>
						<?php echo "<td class='mayusculas'>". $Sql['citestado']. "</td>"; ?>
                        <?php echo "<td class='centrar'>"."<a href='actualizarcitas.php?idcita=".$Sql['idcita']."' class='editar'>Editar</a>". "</td>"; ?>
						<?php echo "<td class='centrar'>"."<a href='eliminar_citas.php?idcita=".$Sql['idcita']."' class='eliminar'>Eliminar</a>". "</td>"; ?>
						</tr>
						<?php endforeach; ?>
						</table>
						<?php  if(!empty($mensaje)): ?>
							<ul>
							  <?php echo $mensaje; ?>
							</ul>
						<?php  endif; ?>	 
				</article>
	</section>
<?php include 'plantillas/footer.php'; ?>
</body>
</html>