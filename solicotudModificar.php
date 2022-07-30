<?php include("includes/session.php");
if(isset($_POST['solicitudModificar'])){
	require("includes/solicitudModificar.php");
}
if(!isset($_GET["n"]) or $_GET["n"]<0 or !is_numeric($_GET["n"])){
	$n = 0;
}else{
	$n = $_GET["n"];
}
@$idMod = $_POST['idMod'];
@$idM = $_POST['idSolic'];
?>
<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php");?>
<link rel="stylesheet" type="text/css" href="css/table.css">
<link rel="stylesheet" type="text/css" href="css/modal.css">
<link rel="stylesheet" type="text/css" href="template/template.css">
</head>
<body>
<header>
<?php include("includes/header.php");?>
</header>
<section>
<article>
<form style="border:none;" method="POST" action="">
	<div class="container">
		<?php 
		$row11 = mysqli_query($link, "SELECT * FROM solicitud WHERE id='$idMod' OR id='$idM'");
		$rows11 = @mysqli_fetch_assoc($row11);
		?>
		<input type="hidden" name="idSolic" value="<?php echo $rows11["id"]; ?>">
		<h3>Editar viaje</h3>
		<label><b>Nombre de pasajero</b></label>
		<input type="text" name="nombrePasajeroM" value="<?php echo $rows11['nombrePasajero']; ?>" required maxlength="50" pattern="[a-zA-Z]{1,50}">
		</br>
		<label style="padding-right: 4px;"><b>Chofer</b></label>
		<select name="choferM">
			<?php 
			$row1 = mysqli_query($link, "SELECT * FROM chofer WHERE estado='Habilitado'");
			while($rows1 = @mysqli_fetch_assoc($row1)){
			?>
				<option value="<?php echo $rows1["cedula"]; ?>"><?php echo $rows1["nombreCompleto"]; ?></option>
			<?php } ?>
		</select>
		<label><b>Fecha</b></label>
		<input type="date" name="fechaChoferM" required>
		</br>
		<label><b>Vehículo</b></label>
		<select name="veiculoM">
			<?php 
			$row2 = mysqli_query($link, "SELECT * FROM veiculo WHERE estado='Habilitado'");
			while($rows2 = @mysqli_fetch_assoc($row2)){
			?>
				<option value="<?php echo $rows2["matricula"]; ?>"><?php echo $rows2["matricula"]; ?></option>
			<?php } ?>
		</select>
		<label style="padding-right: 4px;"><b>Hora</b></label>
		<input style="width: 30%;" type="time" name="horaVeiculoM" required>
		</br>
		<label><b>Detalles de viajes</b></label>
		<input type="text" value="<?php echo $rows11['detalles']; ?>" name="detallesM" required maxlength="50" pattern="[a-zA-Z]{1,100}">
		<input type="submit" value="Ingresar" name="solicitudModificar">
	</div>
</form>
</article>
</section>
<footer>
<?php include("includes/footer.php"); ?>
</footer>
</body>
</html>    