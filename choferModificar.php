<?php include("includes/session.php");
if(isset($_POST['modChofer'])){
	require("includes/modchofer.php");
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
			$row11 = mysqli_query($link, "SELECT * FROM chofer WHERE id='$idMod' or id='$idM'");
			$rows11 = @mysqli_fetch_assoc($row11);
		?>
		<div class="container">
			<h3>Ingresar chofer</h3>
			<input type="hidden" name="idSolic" value="<?php echo $rows11["id"]; ?>">
			<label><b>Cedula</b></br></label>
			<select name="cedula1" style="width:15%;">
				<option value="V-">V-</option>
				<option value="E-">E-</option>
			</select>
			<input style="width:84%;" type="text" value="<?php echo trim($rows11["cedula"],"VE-"); ?>" required name="cedula2" maxlength="8" pattern="[0-9]{6,8}">
			</br>
			</br>
			<label><b>Nombre completo</b></label>
			<input type="text" required name="nombre" value="<?php echo $rows11["nombreCompleto"]; ?>" maxlength="50" pattern="{1,50}">
			<label><b>Dirreción</b></label>
			<input type="text" required value="<?php echo $rows11["dirreccion"]; ?>" name="dirreccion" maxlength="100" pattern="{1,100}">
			<label><b>Telefono</b></label>
			<input type="text" required value="<?php echo $rows11["telf"]; ?>" name="telf" maxlength="12" pattern="[0-9]{7,12}">
			<input type="submit" value="ingresar" name="modChofer">
		</div>
	</form>
</article>
</section>
<footer>
<?php include("includes/footer.php"); ?>
</footer>
</body>
</html>