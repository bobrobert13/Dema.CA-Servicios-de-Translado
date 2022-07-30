<?php include("includes/session.php");
if(isset($_POST['veiculo'])){
	require("includes/veiculo.php");
}
if(!isset($_GET["n"]) or $_GET["n"]<0 or !is_numeric($_GET["n"])){
	$n = 0;
}else{
	$n = $_GET["n"];
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
	<button onclick="document.getElementById('id1').style.display='block'">Ingresar nuevo vehículo</button>
	<div id="id1" class="modal">
		<form class="modal-content animate" method="POST" action="">
			<div class="closecontainer">
				<span onclick="document.getElementById('id1').style.display='none'" class="close" title="Cerrar">&times;</span>
			</div>
			<div class="container">
				<h3>Ingresar vehículo</h3>
				<label><b>Matricula</b></label>
				<input type="text" name="matricula" maxlength="12" required pattern="{8,12}">
				<label><b>Capacidad</b></label>
				<input type="text" name="capacidad" maxlength="2" required pattern="{1,2}">
				<label><b>Tipo de vehículo</b></label>
				<input type="text" name="tipo" maxlength="50" required pattern="{1,50}">
				<input type="submit" value="Ingresar" name="veiculo">
			</div>
		</form>
	</div>
	<div style="overflow-x:auto;">
		<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar vehículo...">
		<table id="myTable">
			<tr>
				<th style="text-align:center;font-size:18px;" colspan="5">Lista de vehículos</th>
			</tr>
			<tr>
				<th>Matricula</th>
				<th>Capacidad</th>
				<th>Tipo de vehículo</th>
				<th>Estado</th>
				<th></th>
			</tr>
			<?php 
			$show = $n * 20;
			$row = mysqli_query($link, "SELECT * FROM veiculo WHERE estado <> 'Eliminado' ORDER BY estado DESC LIMIT $show, 20");
			while($rows = @mysqli_fetch_assoc($row)){
			?>
			<tr>
				<td><?php echo $rows["matricula"]; ?></td>
				<td><?php echo $rows["capacidad"]; ?></td>
				<td><?php echo $rows["tipo"]; ?></td>
				<td><?php echo $rows["estado"]; ?></td>
				<form method="POST" action="includes/lockVeiculo.php">
					<td><input type="hidden" name="idVeiculo" value="<?php echo $rows["id"]; ?>">
					<?php
						if($rows["estado"]=="Habilitado" AND $level['estado']=='admin'){
							echo '<input type="image" src="images/padlock.png" alt="Submit" title="Des/habilitar" name="eliminarVeiculo">';
						}elseif($level['estado']=='admin'){
							echo '<input type="image" src="images/unlock.png" alt="Submit" title="Des/habilitar" name="eliminarVeiculo">';
						}
					?>
				</form>
				<?php if($rows["estado"]=="Deshabilitado" AND $level['estado']=='admin'){ ?>
				<form style="border:none;" method="post" action="eliminar.php?p=3">
					<input type="hidden" name="idEliminar" value="<?php echo $rows["id"]; ?>">
					<input type="hidden" name="idpage" value="3">
					<input type="image" src="images/close.png" title="Eliminar" alt="Submit" name="finish">
				</form>
				<?php }elseif($level['estado']=='admin'){ ?>
				<form style="border:none;" method="post" action="veiculoModificar.php?p=3">
					<input type="hidden" name="idMod" value="<?php echo $rows["id"]; ?>">
					<input type="image" src="images/pencil.png" title="Modificar" alt="Submit" name="finish">
				</form>
				<?php } ?>
				</td>
			</tr>
			<?php } ?>
		</table>
		<br>
</article>
</section>
<footer>
<?php include("includes/footer.php"); ?>
</footer>
</body>
<script>
var modal = document.getElementById('id1');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
</script>
</html>