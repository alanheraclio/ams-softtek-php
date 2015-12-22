<html>
<head>
	<title></title>
</head>
<body>
	<form method="get">
		<label>Nombre: <input type="text" name="nombre"/></label></hr><br><br>
		<label>Apellido: <input type="text" name="apellido"/></label></hr><br><br>
		<label>Fecha de nacimiento: <input type="date" name="fecha"/></label></hr><br><br>
		<label>Lugar de nacimiento: <input type="text" name="lugar"/></label></hr><br><br>
        si
        <input type="radio" name="star_wars" value="true">
        no
        <input type="radio" name="star_wars" value="false">
        <br><br>
		<label>lenguaje favorito:</label>
		<select name="lang[]" multiple>
			<option>PHP</option>
			<option>Java</option>
			<option>C</option>
			<option>Python</option>
		</select>
		<br><br>
		<input type="submit" value="Guardar"/>
	</form>
</body>
</html>

<?php
include_once("db.php");
class Persona{
	var $nombre;
	var $apellido;
	var $fecha;
	var $lugar;
	var $star_wars;
	var $lang;
	var $errors;

	function Persona(){
		$this->errors = array();
	}

	public function set_nombre($nombre){
		if(strlen($nombre)!=0){
			$this->nombre = $nombre;
			return true;
		}
		$this->errors[] = "El campo nombre es obligatorio";
		return false;
	}
		public function set_apellido($apellido){
		if(strlen($apellido)!=0){
			$this->apellido = $apellido;
			return true;
		}
		$this->errors[] = "El campo apellido es obligatorio";
		return false;
	}
		public function set_fecha($fecha){
		if(strlen($fecha)!=0){
			$this->fecha = $fecha;
			return true;
		}
		$this->errors[] = "El campo fecha de nacimiento es obligatorio";
		return false;
	}
		public function set_lugar($lugar){
		if(strlen($lugar)!=0){
			$this->lugar = $lugar;
			return true;
		}
		$this->errors[] = "El campo lugar de nacimiento es obligatorio";
		return false;
	}
		public function set_star_wars($star_wars){
		if(strlen($star_wars)!=0){
			if ($star_wars) {
				$star_wars = 1;
			}
			else{
				$star_wars = 0;
			}
			$this->star_wars = $star_wars;
			return true;
		}
		$this->errors[] = "El campo pelicula es obligatorio";
		return false;
	}

	function to_sql(){
		return "insert into persona (nombre,apellidos,fecha_nacimiento,lugar_nacimiento,peli) 
				VALUES ('$this->nombre','$this->apellido',$this->fecha,'$this->lugar',$this->star_wars)";
	}

	function has_errors(){
		return count($this->errors) > 0 ? true:false;
	}
	function get_errors(){
		if($this->has_errors()){
			return false;
		}
		return $this->errors;
	}
}

$p = new Persona();
$p->set_nombre($_GET["nombre"]);
$p->set_apellido($_GET["apellido"]);
$p->set_fecha($_GET["fecha"]);
$p->set_lugar($_GET["lugar"]);
$p->set_star_wars($_GET["star_wars"]);
echo "<br>".$p->to_sql();
// exit;
if($p->has_errors()){
	?><pre><?php var_dump($p->get_errors());?></pre><?php
}else{
	// echo "entró"; exit();
	$q = mysqli_query($connect, $p->to_sql());
	echo "<br>"."el query es: "+var_dump($p->to_sql());
}

?>
<?php

/*

$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}*/
?>