<?php include("includes/session.php");
if(!isset($_GET["n"]) or $_GET["n"]<0 or !is_numeric($_GET["n"])){
	$n = 0;
}else{
	$n = $_GET["n"];
}
if(isset($_POST['registrar'])){
	require("includes/registrar.php");
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
	<?php if($level['estado']=='admin'){ ?>
		<button onclick="document.getElementById('id1').style.display='block'">Registrar usuario</button>
	<?php } ?>
	<div id="id1" class="modal">
		<form class="modal-content animate" method="POST" action="">
			<div class="closecontainer">
				<span onclick="document.getElementById('id1').style.display='none'" class="close" title="Cerrar">&times;</span>
			</div>
			<div class="container">
				<h3>Registrar usuario</h3>
				<label><b>Nombre completo</b></label>
				<input type="text" name="nombreCompleto" required maxlength="50" pattern="[a-zA-Z]{1,50}">
				<label><b>Correo electronico</b></label>
				<input type="email" name="correo" required>
				<label><b>Nombre de usuario</b></label>
				<input type="text" name="nombreUsuario" pattern="[a-zA-Z0-9]{1,50}" required maxlength="50">
				<label><b>Contraseña</b></label>
				<input type="password" name="contrasena" required maxlength="50" pattern="[a-zA-Z0-9]{1,50}">
				<label><b>Repita contraseña</b></label>
				<input type="password" name="reContrasena" required maxlength="50" pattern="[a-zA-Z0-9]{1,50}">
				<input type="submit" name="registrar" value="Registrar">
			</div>
		</form>
	</div>
	<!--<button onclick="document.getElementById('id2').style.display='block'">Administrar base de datos</button>-->
	<div id="id2" class="modal">
		<form class="modal-content animate" action="">
			<div class="closecontainer">
				<span onclick="document.getElementById('id2').style.display='none'" class="close" title="Cerrar">&times;</span>
			</div>
			<div class="container">
				<h3>Administrar base de datos</h3>
			</div>
		</form>
	</div>
	<div style="overflow-x:auto;">
		<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar usuario...">
		<table id="myTable">
			<tr>
				<th style="text-align:center;font-size:18px;" colspan="5">Lista de usuarios</th>
			</tr>
			<tr>
				<th>Nombre completo</th>
				<th>Correo electronico</th>
				<th>Nombre de usuario</th>
				<th>Estado</th>
				<th></th>
			</tr>
			<?php 
			$show = $n * 20;
			$row = mysqli_query($link, "SELECT * FROM usuarios ORDER BY estado DESC LIMIT $show, 20");
			while($rows = @mysqli_fetch_assoc($row)){
			?>
			<tr>
				<td><?php echo $rows["nombreCompleto"]; ?></td>
				<td><?php echo $rows["correo"]; ?></td>
				<td><?php echo $rows["nombreUsuario"]; ?></td>
				<td><?php echo $rows["estado"]; ?></td>
				<form method="POST" action="includes/lockUsuario.php">
					<td><input type="hidden" name="idUsuario" value="<?php echo $rows["id"]; ?>">
					<?php
						if($rows["estado"]=="Habilitado" AND $level['estado']=='admin'){
							echo '<input type="image" src="images/padlock.png" alt="Submit" title="Des/habilitar" name="eliminarChofer"></td>';
						}elseif($level['estado']=='admin'){
							echo '<input type="image" src="images/unlock.png" alt="Submit" title="Des/habilitar" name="eliminarChofer"></td>';
						}
					?>
				</form>
			</tr>
			<?php } ?>
		</table>
		</br>
	</div>
</article>
</section>
<footer>
<?php include("includes/footer.php"); ?>
</footer>
</body>
<script>
var modal1 = document.getElementById('id1');
var modal2 = document.getElementById('id2');
window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
	if (event.target == modal2) {
		modal2.style.display = "none";
	}
}
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
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