<?php include("includes/session.php");
if(isset($_POST['chofer'])){
	require("includes/chofer.php");
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
	<button onclick="document.getElementById('id1').style.display='block'">Ingresar nuevo chofer</button>
	<div id="id1" class="modal">
		<form class="modal-content animate" method="POST" action="">
			<div class="closecontainer">
				<span onclick="document.getElementById('id1').style.display='none'" class="close" title="Cerrar">&times;</span>
			</div>
			<div class="container">
				<h3>Ingresar chofer</h3>
				<label><b>Cedula</b></br></label>
				<select name="cedula1" style="width:15%;">
					<option value="V-">V-</option>
					<option value="E-">E-</option>
				</select>
				<input style="width:84%;" type="text" required name="cedula2" maxlength="8" pattern="[0-9]{6,8}">
				</br>
				</br>
				<label><b>Nombre completo</b></label>
				<input type="text" required name="nombre" maxlength="50" pattern="{1,50}">
				<label><b>Dirreción</b></label>
				<input type="text" required name="dirreccion" maxlength="100" pattern="{1,100}">
				<label><b>Telefono</b></label>
				<input type="text" required name="telf" maxlength="12" pattern="[0-9]{7,12}">
				<input type="submit" value="ingresar" name="chofer">
			</div>
		</form>
	</div>
	<div style="overflow-x:auto;">
		<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar chofer...">
		<table id="myTable">
			<tr>
				<th style="text-align:center;font-size:18px;" colspan="6">Lista de choferes</th>
			</tr>
			<tr>
				<th>Cedula</th>
				<th>Nombre completo</th>
				<th>Dirreción</th>
				<th>Teléfono</th>
				<th>Estado</th>
				<th></th>
			</tr>
			<?php 
			$show = $n * 20;
			$row = mysqli_query($link, "SELECT * FROM chofer WHERE estado <> 'Eliminado' ORDER BY estado DESC");
			while($rows = @mysqli_fetch_assoc($row)){
			?>
			<tr>
				<td><?php echo $rows["cedula"]; ?></td>
				<td><?php echo $rows["nombreCompleto"]; ?></td>
				<td><?php echo $rows["dirreccion"]; ?></td>
				<td><?php echo $rows["telf"]; ?></td>
				<td><?php echo $rows["estado"]; ?></td>
				<form method="POST" action="includes/lockChofer.php">
					<td><input type="hidden" name="idChofer" value="<?php echo $rows["id"]; ?>">
					<?php if($rows["estado"]=="Habilitado"){ ?>
					<a href="detalleschofer.php?p=2&id=<?php echo $rows["cedula"]; ?>">
						<img title="Ver" src="images/lupa.png">
					</a>
					</br>
					<?php
					}
						if($rows["estado"]=="Habilitado" AND $level['estado']=='admin'){
							echo '<input type="image" src="images/padlock.png" title="Des/habilitar" alt="Submit" name="eliminarChofer">';
						}elseif($level['estado']=='admin'){
							echo '<input type="image" src="images/unlock.png" title="Des/habilitar" alt="Submit" name="eliminarChofer">';
						}
					?>
				</form>
				<?php if($rows["estado"]=="Deshabilitado" AND $level['estado']=='admin'){ ?>
				<form style="border:none;" method="post" action="eliminar.php?p=2">
					<input type="hidden" name="idEliminar" value="<?php echo $rows["id"]; ?>">
					<input type="hidden" name="idpage" value="2">
					<input type="image" src="images/close.png" title="Eliminar" alt="Submit" name="finish">
				</form>
				<?php }elseif($level['estado']=='admin'){ ?>
				<form style="border:none;" method="post" action="choferModificar.php?p=2">
					<input type="hidden" name="idMod" value="<?php echo $rows["id"]; ?>">
					<input type="image" src="images/pencil.png" title="Eliminar" alt="Submit" name="finish">
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