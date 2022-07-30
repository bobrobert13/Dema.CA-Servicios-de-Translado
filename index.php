<?php
if(isset($_POST['ingresar'])){
	require("includes/login.php");
} 
?>
<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php");?>
<style>
body {
	background-color: #6495ED;
	text-align: center;
}
h1{
	color: white;
	font-size: 40px;
}
article {
	background-color: white;
	text-align: center;
	margin: auto;
	width: 600px;
	padding: 16px;
	border-radius: 12px;
}
input[type=text] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
input[type=text]:hover, input[type=text]:focus {
	background-color: #f2f2f2;
}
input[type=password]:hover, input[type=password]:focus {
	background-color: #f2f2f2;
}
input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
input[type=submit] {
	width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
	color: white;
	background-color: #6495ED;
}
input[type=submit]:hover {
	color: #6495ED;
	background-color: #f2f2f2;
}
</style>
</head>
<body>
<header></header>
<section>
<h1>DEMACA</h1>
<article>
<form method="POST" action="">
<label>Usuario</br></label>
<input type="text" name="usuario" required>
<label></br>Contraseña</br></label>
<input type="password" name="contrasena" required>
</br>
<input type="submit" name="ingresar" value="Ingresar">
</form>
</article>
</section>
<footer>
</footer>
</body>
</html>