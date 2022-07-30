<?php include("includes/session.php");
if(isset($_POST['modVeiculo'])){
	require("includes/modveiculo.php");
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
		<?php 
			$row11 = mysqli_query($link, "SELECT * FROM veiculo WHERE id='$idMod' OR id='$idM'");
			$rows11 = @mysqli_fetch_assoc($row11);
		?>
		<div class="container">
			<h3>Ingresar Vehículo</h3>
			<input type="hidden" name="idSolic" value="<?php echo $rows11["id"]; ?>">
			<label><b>Matricula</b></label>
			<input type="text" name="matricula" value="<?php echo $rows11["matricula"]; ?>" maxlength="12" required pattern="{8,12}">
			<label><b>Capacidad</b></label>
			<input type="text" name="capacidad" value="<?php echo $rows11["capacidad"]; ?>" maxlength="2" required pattern="{1,2}">
			<label><b>Tipo de vehículo</b></label>
			<input type="text" name="tipo" maxlength="50" value="<?php echo $rows11["tipo"]; ?>" required pattern="{1,50}">
			<input type="submit" value="Ingresar" name="modVeiculo">
		</div>
	</form>
</article>
</section>
<footer>
<?php include("includes/footer.php"); ?>
</footer>
</body>
</html>