<?php include("includes/session.php");

@$ide = $_POST['idEliminar'];
@$idp = $_POST['idpage'];

@$idEliminar = $_POST['ide'];
@$idpage = $_POST['idp'];

if(isset($_POST['confirmar'])){
	if($idpage==1){
		if(mysqli_query($link, "UPDATE solicitud SET estado='Eliminado' WHERE id='$idEliminar'")){
				header("location: mainpage.php");
		}
	}elseif($idpage==2){
		if(mysqli_query($link, "UPDATE chofer SET estado='Eliminado' WHERE id='$idEliminar'")){
				header("location: chofer.php");
		}
	}elseif($idpage==3){
		if(mysqli_query($link, "UPDATE veiculo SET estado='Eliminado' WHERE id='$idEliminar'")){
				header("location: veiculo.php");
		}
	}
}
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
<div style="text-align:center;">
<form style="border:none;" method="POST" action="">
<h3>Esta seguro que desea eliminar<h3> 
<input type="hidden" name="ide" value="<?php echo $ide; ?>">
<input type="hidden" name="idp" value="<?php echo $idp; ?>">
<input style="width:100px;" type="submit" name="confirmar" value="Aceptar">
</form>
</div>
</article>
</section>
<footer>
<?php include("includes/footer.php"); ?>
</footer>
</body>
</html>