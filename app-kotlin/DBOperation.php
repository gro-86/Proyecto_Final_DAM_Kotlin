<?php
class DbOperation{
    
    private $con;
    
    function __construct(){

        require_once dirname(__FILE__) . '/DbConnect.php';
        $db = new DbConnect();
        $this->con = $db->connect();
	}

	//MOSTRAR IMÁGENES
	function getPhotos () {

		$stmt = $this->con->prepare("SELECT foto FROM imagenes");
	
		$stmt->execute();	
		$stmt->bind_result($foto);

		$fotos = array(); 

		while($stmt->fetch()){
					
			array_push($fotos, $foto); 
		}
		
		return $fotos;
	}

	//LOGIN - BUSCAR USUARIO [LOGIN]	
	function buscarUsuario($user,$pass){

		$stmt = $this->con->prepare("SELECT user,pass FROM usuario WHERE user = ? and pass = ?");

		try {
			
		$stmt ->bind_param("ss",$user,$pass);	
		$stmt->execute();	
		$stmt->bind_result($usuario, $password);
		$boo=false;

		while($stmt->fetch()){

			return true;
			
		}
		
			
		} catch (Exception $e) {
			echo $e;
			return $e;
		}
	 
		return $boo;
		
	}
	
	//LOGIN - BUSCAR USUARIO TRABAJADOR [LOGIN]	
	function buscarUsuarioTrabajador($nombre_usuario){
		
		$stmt = $this->con->prepare("SELECT user FROM usuario WHERE nombre_usuario LIKE ?");
		$stmt ->bind_param("s",$nombre_usuario);
		$stmt->execute();	
		$stmt->bind_result($user);
		$usuarios = array(); 

		while($stmt->fetch()){

			$usuario  = array();
			$usuario['user'] = $user;
			
			array_push($usuarios,$usuario); 
		}
		 
		return $usuarios;

	}
	
	//ES TRABAJADOR [LOGIN]
	function esTrabajador($user,$pass){

		$stmt = $this->con->prepare("SELECT trabajador FROM usuario where user = ? and pass = ?");
		$boo = false;
		$stmt ->bind_param("ss",$user,$pass);	
		$stmt->execute();	
		$stmt->bind_result($trabajador);
		 
		while($stmt->fetch()){
			
			if($trabajador==1){
				
				return true;
			}

		}

		return $boo;
	}

	//CREAR USUARIO [SIGNUP] 
	function crearUsuario($dni,$nombre_usuario,$user,$pass){
		
		$stmt = $this->con->prepare('INSERT INTO usuario (dni,nombre_usuario,user,pass) VALUES (?,?,?,?)');
		
		try {
			
			$stmt->bind_param("ssss",$dni,$nombre_usuario,$user,$pass);
			
			if($stmt->execute()){
		
				echo "llego";
				return false;
				

			}else {

				echo "no llego";
				return true; 
				
			}

		} catch (Exception $e) {

			return $e;
		}

	}

	//---------------------------------------------TRABAJADOR------------------------------------------------------

	//MOSTRAR COMPRAS USUARIO [USUARIO/TRABAJADOR]
	function mostrarComprasUsuario ($user) {

		$stmt = $this->con->prepare("SELECT id_compra,id_producto_compra,fecha_compra,fecha_entrega,hora_compra FROM compra
		WHERE id_usuario_compra IN(select id_usuario from usuario where user=?)");
		$stmt ->bind_param("s",$user);
		$stmt->execute();	
		$stmt->bind_result($id_compra,$id_producto_compra,$fecha_compra,$fecha_entrega,$hora_compra);
		$compras = array(); 

		while($stmt->fetch()){

			$compra  = array();
			$compra['id_compra'] = $id_compra;
			$compra['id_producto_compra'] = $id_producto_compra; 
			$compra['fecha_compra'] = $fecha_compra; 
			$compra['fecha_entrega'] = $fecha_entrega; 
			$compra['hora_compra'] = $hora_compra; 
			
			array_push($compras, $compra); 
		}
		 
		return $compras;
	}
	
	//MOSTRAR COMPRAS [TRABAJADOR] 
	function mostrarCompras() {

		$stmt = $this->con->prepare("SELECT id_compra,id_producto_compra,fecha_compra,fecha_entrega,hora_compra FROM compra");
		$stmt->execute();	
		$stmt->bind_result($id_compra,$id_producto_compra,$fecha_compra,$fecha_entrega,$hora_compra);
		$compras = array(); 

		while($stmt->fetch()){

			$compra  = array();
			$compra['id_compra'] = $id_compra;
			$compra['id_producto_compra'] = $id_producto_compra; 
			$compra['fecha_compra'] = $fecha_compra; 
			$compra['fecha_entrega'] = $fecha_entrega; 
			$compra['hora_compra'] = $hora_compra; 
			
			array_push($compras, $compra); 
		}
		 
		return $compras;
	}

	//MOSTRAR PRODUCTOS DISPONIBLES [USUARIO/TRABAJADOR]
	function mostrarProductosDisponibles () {

		$stmt = $this->con->prepare("SELECT id_producto,marca,modelo,precio,anio_creacion,foto,id_proveedor_producto,talla,cantidad FROM producto");
		$stmt->execute();	
		$stmt->bind_result($id_producto,$marca,$modelo,$precio,$anio_creacion,$foto,$id_proveedor_producto,$talla,$cantidad);
		$productos = array(); 

		while($stmt->fetch()){
			$producto  = array();
			$producto['id_producto'] = $id_producto; 
			$producto['marca'] = $marca; 
			$producto['modelo'] = $modelo; 
			$producto['precio'] = $precio;
			$producto['anio_creacion'] = $anio_creacion;
			$producto['foto'] = $foto;
			$producto['id_proveedor_producto'] = $id_proveedor_producto;
			$producto['talla'] = $talla;
			$producto['cantidad'] = $cantidad;			
			
			array_push($productos, $producto); 
		}
		 
		return $productos;
	}

	//COMPROBAR TIEMPO [TRABAJADOR]
	function comprobarTiempo($id_compra){

		try{
			
			$stmt = $this->con->prepare("SELECT DATEDIFF(CURRENT_DATE,fecha_compra) as dias from compra where id_compra=?");	
			$stmt ->bind_param("i",$id_compra);
			$stmt->execute();	
			$stmt->bind_result($dias);
			$boo=true;
	
			while($stmt->fetch()){

				if($dias==0){


					$boo=false;

				}
					
			}
			
			if($boo == false){
	
			$stmt = $this->con->prepare("SELECT TIMEDIFF (CURRENT_TIME,hora_compra) as minutos from compra where id_compra=?");	
			$stmt ->bind_param("i",$id_compra);
			$stmt->execute();	
			$stmt->bind_result($minutos);
			$boo=true;
	
				while($stmt->fetch()){

					if($minutos<60){

						$boo=false;

					}
						
				}
			
			}
		
		} catch (Exception $e) {
		echo $e;
		return $e;
		}
		
	
		return $boo;
	}


	//FILTRO USER [TRABAJADOR]
	function filtroUserTrabajador($user){
				
		try{

			$stmt = $this->con->prepare("SELECT id_compra,id_producto_compra,id_usuario_compra,fecha_compra,fecha_entrega,hora_compra FROM compra WHERE id_usuario_compra IN (SELECT id_usuario FROM usuario WHERE user = ?)");	
			$stmt ->bind_param("s",$user);
			$stmt->execute();	
			$stmt->bind_result($id_compra,$id_producto_compra,$id_usuario_compra,$fecha_compra,$fecha_entrega,$hora_compra);
			$compras = array(); 

			while($stmt->fetch()){
				
				$compra  = array();
				$compra['id_compra'] = $id_compra; 
				$compra['id_producto_compra'] = $id_producto_compra; 
				$compra['id_usuario_compra'] = $id_usuario_compra; 
				$compra['fecha_compra'] = $fecha_compra; 
				$compra['fecha_entrega'] = $fecha_entrega; 
				$compra['hora_compra'] = $hora_compra; 
		
				array_push($compras,$compra); 
			}
	
		} catch (Exception $e) {
			
			return $e;
		}
		return $compras;
	}
	
	//ESTA DEVUELTO [TRABAJADOR]
	function estaDevuelto($id_producto_compra){

		try{

			$stmt = $this->con->prepare("SELECT devuelto from compra where id_producto_compra =? ");	
			$stmt ->bind_param("s",$id_producto_compra);
			$stmt->execute();	
			$stmt->bind_result($devuelto);

			while($stmt->fetch()){
			
				if($devuelto==0){

					return false;

				}else {
					
					return true;
				}
			
			}
	
		} catch (Exception $e) {
		echo $e;
		return $e;
	}
		return $productos;
	}

	//QUITAR FOREIGN [TRABAJADOR]
	function quitarForeign(){
		
		try {

			$stmt = $this->con->prepare("ALTER TABLE producto DROP FOREIGN KEY fk_proveedor");		
			$stmt->execute();	
		
			if($stmt->fetch()){
					
				return false;
			
			}
			
		} catch (Exception $e) {
			echo $e;
			return $e;
		}

		return true;
	}
	
	//AGREGAR FOREIGN [TRABAJADOR]
	function agregarForeign(){
		
		$stmt = $this->con->prepare("ALTER TABLE producto
		ADD FOREIGN KEY fk_proveedor (id_proveedor_producto) REFERENCES proveedor (id_proveedor)");	
		try {		
		$stmt->execute();	
		
			while($stmt->fetch()){
					
				return false;
					
			}
			
		} catch (Exception $e) {
			echo $e;
			return $e;
		}

		return true;
	}
	
	//BORRAR PRODUCTO [TRABAJADOR]
	function borrarProducto($id_producto){
			
		try {
			
			$stmt = $this->con->prepare("DELETE FROM producto where id_producto = ?");
			$stmt ->bind_param("s",$id_producto);		
			$stmt->execute();	
		
			if($stmt->fetch()){
					
				return false;
			}
			
		} catch (Exception $e) {
			
			return $e;
		}

		return true;
	}

	//MODIFICAR PRODUCTO [TRABAJADOR]
	function modificarProducto ($id_producto,$marca,$modelo,$precio,$anio_creacion,$foto,$id_proveedor_producto,$talla,$cantidad,$imagen){
			
		$dir = "images/";
		if (!file_exists($dir))
			mkdir($dir);
		$ruta_imagen = $dir.$foto.'.jpg';
		file_put_contents($ruta_imagen, base64_decode($imagen));
		
	

		$stmt = $this->con->prepare('UPDATE producto set marca=?,modelo=?,precio=?,anio_creacion=?,foto=?,id_proveedor_producto=?,talla=?,cantidad=? where id_producto = ?');
		
		try {
			
			$stmt->bind_param("ssdisisis",$marca,$modelo,$precio,$anio_creacion,$ruta_imagen,$id_proveedor_producto,$talla,$cantidad,$id_producto);
			
		if($stmt->execute()){
		
			return false;
			
		}else {
			
			return true;
			
		} 

		} catch (Exception $e) {

			echo $e;

			return $e;
		}
		
	}

	//CREAR PRODUCTO [TRABAJADOR]
	function crearProducto($id_producto,$marca,$modelo,$precio,$anio_creacion,$foto,$id_proveedor_producto,$talla,$cantidad,$imagen){
		
		$dir = "images/";
		if (!file_exists($dir))
			mkdir($dir);

		$ruta_imagen = $dir.$foto.'.jpg';
	
		file_put_contents($ruta_imagen, base64_decode($imagen));

		$stmt = $this->con->prepare("INSERT INTO producto(id_producto,marca,modelo,precio,anio_creacion,foto,id_proveedor_producto,talla,cantidad) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
		
		try {
			
			$stmt->bind_param("sssdisisi",$id_producto,$marca,$modelo,$precio,$anio_creacion,$ruta_imagen,$id_proveedor_producto,$talla,$cantidad);
			
			if($stmt->execute()){
				
				return false; 
				
			}else {
				
				return true;
				
			} 
					
			
		} catch (Exception $e) {
			
			return $e;
		}
		
	}
	
	//RETRASAR ENTREGA [TRABAJADOR]
	function retrasarEntrega ($id_compra) {
		
		try {
			
			$boo=true;
			$stmt = $this->con->prepare('Select DATEDIFF(CAST(fecha_entrega + INTERVAL 7 DAY AS DATE),fecha_compra) AS resultado FROM compra WHERE id_compra LIKE ? AND devuelto = 0');	
			$stmt->bind_param("i",$id_compra);
			$stmt->execute();
			$stmt->bind_result($resultado);
			
			while($stmt->fetch()){
				
				if($resultado<21){
				
					$boo=false;
				
				}
				
			}
			
			if(!$boo){
			
				$stmt = $this->con->prepare('UPDATE compra SET fecha_entrega = CAST(fecha_entrega + INTERVAL 7 DAY AS DATE) WHERE id_compra LIKE ? AND devuelto = 0');	
			
				$stmt->bind_param("i",$id_compra);
			
				if($stmt->execute()){
		
					return false;

				}else {
				
					return true;
				}
				
			} else {
				
				return true;
			}

		} catch (Exception $e) {

			echo $e;

			return $e;
		}
		
	}
	
	//--------------------------------------USUARIO---------------------------------------------------

	//FILTRO AÑO [USUARIO]
	function filtroAnioProducto($anio_creacion){

		try{

			$stmt = $this->con->prepare("SELECT id_producto,marca,modelo,talla,foto,precio,cantidad from producto  where anio_creacion =? ");	
			$stmt ->bind_param("i",$anio_creacion);
			$stmt->execute();	
			$stmt->bind_result($id_producto,$marca,$modelo,$talla,$foto,$precio,$cantidad);
			$productos = array(); 

			while($stmt->fetch()){
			$producto  = array();
			$producto['id_producto'] = $id_producto; 
			$producto['marca'] = $marca;
			$producto['modelo'] = $modelo;
			$producto['talla'] = $talla;
			$producto['precio'] = $precio; 
			$producto['foto'] = $foto;
			$producto['cantidad'] = $cantidad;     
		
				array_push($productos, $producto); 
			}
	
		} catch (Exception $e) {
		echo $e;
		return $e;
	}
		return $productos;
	}
	
	//CAMBIAR PASSWORD [USUARIO]
	function cambiarPassword($pass,$user){
			
		$stmt = $this->con->prepare("UPDATE usuario SET pass = ? WHERE user = ?");
	
		try {
			
			$stmt->bind_param("ss",$pass,$user);
			
		if($stmt->execute())
			return false; 
		return true; 
		} catch (Exception $e) {
			echo $e;
			return $e;
		}
		
	}	

	//CANTIDAD PRODUCTOS [USUARIO]	
	function cantidadProductos($id_producto){
		
		$stmt = $this->con->prepare("SELECT cantidad FROM producto WHERE id_producto LIKE ?");
		$stmt ->bind_param("s",$id_producto);
		$stmt->execute();	
		$stmt->bind_result($cantidad);
		$productos = array(); 

		while($stmt->fetch()){

			$producto  = array();
			$producto['cantidad'] = $cantidad;
			
			array_push($productos,$producto); 
		}
		 
		return $productos;

	}
	
	//MOSTRAR USUARIOS [USUARIO]	
	function mostrarUsuarios(){

		$stmt = $this->con->prepare("SELECT nombre_usuario FROM usuario where trabajador = 0");
		$stmt->execute();	
		$stmt->bind_result($nombre_usuario);
		$usuarios = array(); 

		while($stmt->fetch()){

			$usuario = array();
			$usuario['nombre_usuario'] = $nombre_usuario;
			
			array_push($usuarios, $usuario); 
		}
		 
		return $usuarios;
	}

	//BUSCAR ID USUARIO [USUARIO]
	function buscarIdUsuario($user){

		try{
	
			$stmt = $this->con->prepare("SELECT id_usuario from usuario  where user =? ");	
			$stmt ->bind_param("s",$user);
			$stmt->execute();	
			$stmt->bind_result($id_usuario);
			$usuarios = array(); 
	
			while($stmt->fetch()){

				$usuario  = array();
				$usuario['id_usuario'] = $id_usuario; 
				array_push($usuarios, $usuario); 
					
			}
		
		} catch (Exception $e) {
		echo $e;
		return $e;
		}
			return $usuarios;
	}

	//FILTRO TALLA [USUARIO]
	function filtroTallaProducto($talla){

		try{

			$stmt = $this->con->prepare("SELECT id_producto,marca,modelo,talla,foto,precio,cantidad from producto  where talla =? ");	
			$stmt ->bind_param("s",$talla);
			$stmt->execute();	
			$stmt->bind_result($id_producto,$marca,$modelo,$talla,$foto,$precio,$cantidad);
			$productos = array(); 

			while($stmt->fetch()){
			$producto  = array();
			$producto['id_producto'] = $id_producto; 
			$producto['marca'] = $marca;
			$producto['modelo'] = $modelo;
			$producto['talla'] = $talla;
			$producto['foto'] = $foto;
			$producto['precio'] = $precio; 
			$producto['cantidad'] = $cantidad;     
		
				array_push($productos, $producto); 
			}
	
		} catch (Exception $e) {
			echo $e;
			return $e;
		}
		return $productos;
	}

	//FILTRO MARCA [USUARIO]
	function filtroMarcaProducto($marca){

		try{

			$stmt = $this->con->prepare("SELECT id_producto,marca,modelo,talla,foto,precio,cantidad from producto  where marca =? ");	
			$stmt ->bind_param("s",$marca);
			$stmt->execute();	
			$stmt->bind_result($id_producto,$marca,$modelo,$talla,$foto,$precio,$cantidad);
			$productos = array(); 

			while($stmt->fetch()){
			$producto  = array();
			$producto['id_producto'] = $id_producto; 
			$producto['marca'] = $marca;
			$producto['modelo'] = $modelo;
			$producto['talla'] = $talla; 
			$producto['foto'] = $foto; 
			$producto['precio'] = $precio;
			$producto['cantidad'] = $cantidad; 	 			
		
				array_push($productos, $producto); 
			}
	
		} catch (Exception $e) {
		echo $e;
		return $e;
	}
		return $productos;
	}


	//DEVOLVER PRODUCTO [USUARIO] 
	function devolverProducto($id_compra,$id_producto_compra){

		$boo=true;
			try {
			$stmt = $this->con->prepare('UPDATE compra set devuelto = 1 where id_compra = ?');
			$stmt->bind_param("i",$id_compra);
			
			if($stmt->execute()){
		
				$boo=false;

			}

			if($boo==false){

				$stmt = $this->con->prepare('UPDATE producto set cantidad = cantidad+1 where id_producto = ?');
				$stmt->bind_param("s",$id_producto_compra);
			
				if($stmt->execute()){
		
					$boo=false;

				}else {
					$boo=true;
				}
			}

		} catch (Exception $e) {

			echo $e;

			return $e;
		}

		return $boo;
	}

	//REDUCIR CONTADOR COMPRAS [USUARIO]
	function reducirContadorCompras($id_usuario_compra){

		$stmt = $this->con->prepare('UPDATE usuario set productos_comprados = productos_comprados-1 where id_usuario = ? AND productos_comprados>=1');
		try {
			
			$stmt->bind_param("s",$id_usuario_compra);
			
			if($stmt->execute()){
		
				return false;

			}else {

				return true; 
			}

		} catch (Exception $e) {

			echo $e;

			return $e;
		}

	}

	//REDUCIR NUMERO PRODUCTO [USUARIO] 
	function reducirContadorProductos($id_producto){

		$stmt = $this->con->prepare('UPDATE producto set cantidad = cantidad-1 where id_producto = ? AND cantidad>0');
		
		try {
			
			$stmt->bind_param("s",$id_producto);
			
			if($stmt->execute()){
		
				return false;

			}else {

				return true; 
			}

		} catch (Exception $e) {

			return $e;
		}

	}

	//AUMENTAR CONTADOR COMPRAS [USUARIO]
	function aumentarContadorCompras($user){

		$stmt = $this->con->prepare('UPDATE usuario set productos_comprados = productos_comprados+1 where user = ?');
		try {
			
			$stmt->bind_param("s",$user);
			
			if($stmt->execute()){
		
				return true;

			}else {

				return false; 
			}

		} catch (Exception $e) {

			echo $e;

			return $e;
		}

	}

	//NUMERO DE COMPRAS [USUARIO]
	function numeroCompras($user){

		try {
			$stmt = $this->con->prepare('SELECT COUNT(*) AS numero FROM compra WHERE id_usuario_compra IN (SELECT id_usuario from usuario where user = ?)');
			$stmt->bind_param("s",$user);
			$stmt->execute();	
			$stmt->bind_result($numero);
			
			while($stmt->fetch()){
					
				if($numero<10){

					return false;

				} else {

					
					return true;

				}

			}

		} catch (Exception $e) {

			echo $e;

			return $e;
		}

	}

	//COMPRAR PRODUCTO [USUARIO]
	function comprarProducto($id_producto_compra,$user,$fecha_compra,$fecha_entrega){
		
		try{
			
			$boo=true;
			$id_obtenido="";
			
			$stmt = $this->con->prepare("SELECT cantidad from producto where id_producto like ?");
			$stmt ->bind_param("s",$id_producto_compra);
			$stmt->execute();	
			$stmt->bind_result($cantidad);

			while($stmt->fetch()){
			
				if($cantidad>0){
				
				$boo=false;
				
				}
		
			}
			
			if($boo==false){
				
				$stmt = $this->con->prepare("SELECT id_usuario from usuario where user like ?");
				$stmt ->bind_param("s",$user);
				$stmt->execute();	
				$stmt->bind_result($id_usuario);

				while($stmt->fetch()){
				
					
					$id_obtenido = $id_usuario; 
					
			
				}
				
				
				$stmt = $this->con->prepare('SELECT productos_comprados from usuario where user = ?');
				$stmt ->bind_param("s",$user);
				$stmt->execute();	
				$stmt->bind_result($productos_comprados);
				$boo=true;

				while($stmt->fetch()){
				
					if($productos_comprados<10){
					
					$boo=false;
					
					}
				}
				
				
				if($boo==false){

				//Insertar compra
				$stmt2 = $this->con->prepare('INSERT INTO compra(id_producto_compra,id_usuario_compra,fecha_compra,fecha_entrega,hora_compra) VALUES
				(?,?,?, CAST(? + INTERVAL 7 DAY AS DATE),CURRENT_TIME)');

					$stmt2 ->bind_param("siss",$id_producto_compra,$id_obtenido,$fecha_compra,$fecha_entrega);
					
					if($stmt2 ->execute()){

						
						return false; 

					}else {
						
						
						return true; 

					}	


				}else {	

					return true;
				}
				
				
			}else {	
			
				
				return $boo;
			
			}
			
		}catch (Exception $e) {
			echo $e;
			return $e;
		}

	}

	//MOSTRAR PROVEEDORES [USUARIO]
	function mostrarProveedores () {
		
		$stmt = $this->con->prepare("SELECT nif,nombre_proveedor from proveedor");
		try {
				
			$stmt->execute();	
			$stmt->bind_result($nif,$nombre_proveedor);
			$proveedores = array(); 

			while($stmt->fetch()){
				$proveedor = array();
				$proveedor['nif'] = $nif; 
				$proveedor['nombre_proveedor'] = $nombre_proveedor; 
				
				array_push($proveedores,$proveedor); 
				
			}
			
		} catch (Exception $e) {
			echo $e;
			return $e;
		}
	 
		return $proveedores;
	}
	
	//BUSCAR ID PROVEEDOR [USUARIO]
	function buscarIdProveedor ($nombre_proveedor) {

		try{

			$stmt = $this->con->prepare("SELECT id_proveedor from proveedor where nombre_proveedor = ?");
			$stmt ->bind_param("s",$nombre_proveedor);
			$stmt->execute();	
			$stmt->bind_result($id_proveedor); 
			$proveedores = array();

			while($stmt->fetch()){

				$proveedor = array();
				$proveedor['id_proveedor'] = $id_proveedor;
				array_push($proveedores, $proveedor); 
				
			}
			
		} catch (Exception $e) {
			echo $e;
			return $e;
		}
	 
		
		return $proveedores;
		 
	}
	
	//HAY STOCK [USUARIO]
	function hayStock($id_producto){

		$boo=true;
		try{

			$stmt = $this->con->prepare("SELECT cantidad from producto  where id_producto =? ");	
			$stmt ->bind_param("s",$id_producto);
			$stmt->execute();	
			$stmt->bind_result($cantidad);
			$productos = array(); 

			while($stmt->fetch()){
			
				if($cantidad>0){
					
					$boo=false;
					
					return $boo;

				}else {
					
					
					return $boo;
				}
			   
			}
	
		} catch (Exception $e) {
			echo $e;
			return $e;
		}
		return $productos;

	}

}