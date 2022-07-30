<?php include("includes/session.php");
if(isset($_POST['solicitud'])){
	require("includes/solicitud.php");
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
	<div id="id1" class="modal">
		<form class="modal-content animate" method="POST" action="">
			<div class="closecontainer"> 
				<span onclick="document.getElementById('id1').style.display='none'" class="close" title="Cerrar">&times;</span>
			</div>
			<div class="container">
				<h3>Solicitud de traslado</h3>
				<label><b>Nombre de pasajero</b></label>
				<input type="text" name="nombrePasajero" required maxlength="50" pattern="[a-zA-Z ]{1,50}">
				</br>
				<label style="padding-right: 4px;"><b>Chofer</b></label>
				<select name="chofer">
					<?php 
					$row1 = mysqli_query($link, "SELECT * FROM chofer WHERE estado='Habilitado'");
					while($rows1 = @mysqli_fetch_assoc($row1)){
					?>
						<option value="<?php echo $rows1["cedula"]; ?>"><?php echo $rows1["nombreCompleto"]; ?></option>
					<?php } ?>
				</select>
				<label><b>Fecha</b></label>
				<input type="date" name="fechaChofer" required>
				</br>
				<label><b>Vehículo</b></label>
				<select name="veiculo">
					<?php 
					$row2 = mysqli_query($link, "SELECT * FROM veiculo WHERE estado='Habilitado'");
					while($rows2 = @mysqli_fetch_assoc($row2)){
					?>
						<option value="<?php echo $rows2["matricula"]; ?>"><?php echo $rows2["matricula"]; ?></option>
					<?php } ?>
				</select>
				<label style="padding-right: 4px;"><b>Hora</b></label>
				<input style="width: 30%;" type="time" name="horaVeiculo" required>
				</br>
				<label><b>Detalles de viajes</b></label>
				<input type="text" name="detalles" required maxlength="50" pattern="[a-zA-Z ]{1,100}">
				<input type="submit" value="Ingresar" name="solicitud">
			</div>
		</form>
	</div>
	<?php
	$row4 = mysqli_query($link, "SELECT * FROM chofer WHERE estado='Habilitado'");
	$row5 = mysqli_query($link, "SELECT * FROM veiculo WHERE estado='Habilitado'");
	$rows4 = @mysqli_fetch_assoc($row4);
	$rows5 = @mysqli_fetch_assoc($row5);
	if($rows4 <> 0 and $rows5 <> 0){
		echo "<button onclick=", '"document.getElementById(', "'id1').style.display=", "'block'", '">Ingresar nueva solicitud</button>';
	}
	?>
	<div style="overflow-x:auto;">
		<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar por fecha...">
		<table id="myTable">
			<tr>
				<th style="text-align:center;font-size:18px;" colspan="7">Lista de viajes</th>
			</tr>
			<tr>
				<th>Pasajero</th>
				<th>Chofer</th>
				<th>Vehículo</th>
				<th>Precio</th>
				<th>Fecha de transacción</th>
				<th>Estado</th>
				<th></th>
			</tr>
			<?php 
			$show = $n * 10;
			$row3 = mysqli_query($link, "SELECT * FROM solicitud WHERE estado <> 'Eliminado' ORDER BY estado");
			while($rows3 = @mysqli_fetch_assoc($row3)){
			?>
			<tr>
				<td><?php echo $rows3["nombrePasajero"]; ?></td>
				<td>
				<?php 
				$choferVa = $rows3["chofer"];
				$rowChofer = mysqli_query($link, "SELECT nombreCompleto FROM chofer WHERE cedula='$choferVa'");
				$rowsChofer = @mysqli_fetch_assoc($rowChofer);
				echo $rowsChofer['nombreCompleto'];
				?>
				</td>
				<td><?php echo $rows3["veiculo"]; ?></td>
				<td>
				<?php 
				$idTraslado = $rows3["id"];
				if($query6 = mysqli_query($link, "SELECT precio FROM precios WHERE idTraslado='$idTraslado'")){
					$precioTotal = 0;
					while($rows6 = @mysqli_fetch_assoc($query6)){
						$precioTotal += $rows6["precio"];
					}
				}else{
					$precioTotal = 0;
				}
				echo $precioTotal;
				?>
				</td>
				<td><?php $f=strtotime($rows3["fechaTransito"]); echo date("d-m-Y", $f); ?></td>
				<td><?php echo $rows3["estado"]; ?></td>
				<td style="text-align:center;">
					<?php if($rows3["estado"]=="Activo"){ ?>
					<a href="solicitudtraslado.php?id=<?php echo "$idTraslado" ; ?>">
						<img title="Ver" src="images/lupa.png">
					</a>
					</br>
					<?php if($level['estado']=='admin'){ ?>
					<form style="border:none;" method="post" action="solicotudModificar.php">
						<input type="hidden" name="idMod" value="<?php echo $rows3["id"]; ?>">
						<input type="hidden" name="idpage" value="1">
						<input type="image" src="images/pencil.png" title="modificar" alt="Submit" name="solicitudModificar">
					</form>
					<?php } ?>
					<?php } ?>
					<form style="border:none;" method="post" action="includes/lockViaje.php">
					<input type="hidden" name="idSolicitud" value="<?php echo $rows3["id"]; ?>">
					<?php
						if($rows3["estado"]=="Activo" AND $level['estado']=='admin'){
							echo '<input type="image" src="images/task-complete.png" title="Finalizar" alt="Submit" name="finish">';
						}elseif($level['estado']=='admin'){
							echo '<input type="image" src="images/return.png" title="Restaurar" alt="Submit" name="finish">';
						}
					?>
					</form>
					<form style="border:none;" method="post" action="eliminar.php">
					<?php if($rows3["estado"]=="Finalizado" AND $level['estado']=='admin'){ ?>
						<input type="hidden" name="idEliminar" value="<?php echo $rows3["id"]; ?>">
						<input type="hidden" name="idpage" value="1">
						<input type="image" src="images/close.png" title="Eliminar" alt="Submit" name="finish">
					<?php } ?>
					</form>
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
var modal1 = document.getElementById('id2');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
	if (event.target == modal1) {
        modal1.style.display = "none";
    }
}
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
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