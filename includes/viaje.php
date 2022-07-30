<?php

$idTraslado = $_POST["idTraslado"];
$salida = $_POST["salida"];
$horaSalida = $_POST["horaSalida"];
$Llegada = $_POST["Llegada"];
$horaLlegada = $_POST["horaLlegada"];
$precio = $_POST["precio"];

$sql1 = mysqli_query($link, "SELECT * FROM solicitud WHERE id='$id'");
if($row1 = mysqli_fetch_assoc($sql1)){
	$chofer = $row1['chofer'];
	$sql2 = mysqli_query($link, "SELECT * FROM solicitud WHERE chofer='$chofer'");
	while($row2 = @mysqli_fetch_assoc($sql2)){
		if(@$salir==1){
			break;
		}else{
			$idSolicitudes = $row2['id'];
			$sql3 = mysqli_query($link, "SELECT * FROM precios WHERE idTraslado='$idSolicitudes'");
			if($row3 = @mysqli_fetch_assoc($sql3)){
				while($row3){
					$d=strtotime($horaSalida);
					$a = date("h:i:sa", $d);
					$sql4 = mysqli_query($link, "SELECT * FROM precios WHERE '$a' BETWEEN horaSalida AND horaLlegada");
					$row4 = @mysqli_num_rows($sql4);
					if($row4>=1){
						$row5 = @mysqli_fetch_assoc($sql4);
						$horaSalidaM = $row5['horaSalida'];
						$horaLlegadaM = $row5['horaLlegada'];
						echo '<script>alert("Chofer no disponible de '.$horaSalidaM.' a '.$horaLlegadaM.' ");</script>';
						$salir = 1;
						break;
					}elseif($row4==0){
						if(mysqli_query($link,"INSERT INTO precios(idTraslado, salida, horaSalida, Llegada, horaLlegada, precio) VALUES('$idTraslado', '$salida', '$horaSalida', '$Llegada', '$horaLlegada', '$precio')")){
							echo '<script>alert("Viaje registrado con exito");</script>';
							$salir = 1;
							break;
						}else{
							echo '<script>alert("no");</script>';
							$salir = 1;
							break;
						}
					}
				}
			}else{
				if(mysqli_query($link,"INSERT INTO precios(idTraslado, salida, horaSalida, Llegada, horaLlegada, precio) VALUES('$idTraslado', '$salida', '$horaSalida', '$Llegada', '$horaLlegada', '$precio')")){
					echo '<script>alert("Viaje registrado con exito");</script>';
					$salir = 1;
					break;
				}
			}
		}
	}
}

?>