<?php 

	require_once 'DbOperation.php';

	$response = array();

	if(isset($_GET['apicall'])){
		
		$db = new DbOperation();

		switch($_GET['apicall']){

			case 'comprarProducto':

				$result = $db->comprarProducto( $_REQUEST['id_producto_compra'] ,$_REQUEST['user'],$_REQUEST['fecha_compra'],$_REQUEST['fecha_entrega']);

				if($result) {
					
					$response['error'] = true; 

				} else {
					
					$response['error'] = false;
						
				}
				
			break; 

			case 'aumentarContadorCompras':

				$result = $db->aumentarContadorCompras($_REQUEST['user']);
				if($result) {
					
					$response['error'] = false; 
				} else {
					
					$response['error'] = true; 	
				}
				
			break;

			case 'comprobarTiempo':

				$result = $db->comprobarTiempo($_REQUEST['id_compra']);
				if($result) {
					
					$response['error'] = true;

				} else {
					
					$response['error'] = false; 

				}
				
			break;

			case 'devolverProducto':

				$result = $db->devolverProducto($_REQUEST['id_compra'],$_REQUEST['id_producto_compra']);
				if($result) {
					
					$response['error'] = true; 

				} else {

					$response['error'] = false; 
						
				}
				
			break;

			case 'buscarIdUsuario':

				$response['usuarios'] = $db->buscarIdUsuario($_REQUEST['user']);
				if($response) {
					
					$response['error'] = false; 
				} else {
					
					$response['error'] = true; 	
				}
				
			break;
			
			case 'buscarUsuarioTrabajador':

				$response['usuarios'] = $db->buscarUsuarioTrabajador($_REQUEST['nombre_usuario']);
				
				if($response) {
					
					$response['error'] = false; 
					
				} else {
					
					$response['error'] = true; 	
				}
				
			break;
			
			case 'mostrarComprasUsuario':
				
				$response['compras'] = $db-> mostrarComprasUsuario( $_REQUEST['user']);

				if($response) {
					
					$response['error'] = false; 				
				} else {
					
					$response['error'] = true; 	
				}
				
			break; 
			
			case 'mostrarCompras':
				
				$response['compras'] = $db-> mostrarCompras();

				if($response) {
					
					$response['error'] = false; 	
					
				} else {
					
					$response['error'] = true; 	
				}
				
			break; 

			case 'estaDevuelto':
				
				$response = $db-> estaDevuelto( $_REQUEST['id_producto_compra']);

				if($response) {

					$response['error'] = true;
						

				} else {
					
					$response['error'] = false;
					
					 	
				}
				
			break;

			case 'mostrarProveedores':
				
				$response['proveedores']  = $db-> mostrarProveedores();

				if($response) {

					$response['error'] = false;
						

				} else {
					
					
					$response['error'] = true;
					 	
				}
				
			break;

			case 'mostrarUsuarios':
						
				$response['usuarios']  = $db-> mostrarUsuarios();

				if($response) {

					$response['error'] = false;
								
				} else {
							
					$response['error'] = true;
								
				}
						
			break; 			

			case 'buscarIdProveedor':
				
				$response['proveedores']  = $db-> buscarIdProveedor($_REQUEST['nombre_proveedor']);

				if($response) {

					$response['error'] = false;
						

				} else {
					
					
					$response['error'] = true;
					 	
				}
				
			break; 				

			case 'reducirContadorCompras':

				$result = $db->reducirContadorCompras($_REQUEST['id_usuario_compra']);
				
				if($result) {
					
					$response['error'] = true; 	
				
				} else {
					$response['error'] = false;
					
				}
				
			break; 
			
			case 'quitarForeign':

		$result = $db->quitarForeign();

		if($result) {
		
		$response['error'] = false; 
		
		} else {
		
			$response['error'] = true; 
		
		}
	
break;

case 'agregarForeign':

	$result = $db->agregarForeign();

	if($result) {
		
		$response['error'] = false; 
		
	} else {
		
		$response['error'] = true; 
			
	}
	
break; 
			
			case 'borrarProducto':

				$result = $db->borrarProducto($_REQUEST['id_producto']);
				
				if($result) {	
					 
					$response['error'] = false;					 
				
				} else {
					
					$response['error'] = true;
					
				}
				
			break; 
			
			case 'reducirContadorProductos':

				$result = $db->reducirContadorProductos($_REQUEST['id_producto']);
				
				if($result) {
					
					$response['error'] = true; 
					
				} else {
					
					$response['error'] = false;
					
				}
				
			break; 
			
			case 'modificarProducto':

				$result = $db->modificarProducto($_REQUEST['id_producto'],$_REQUEST['marca'],$_REQUEST['modelo'],$_REQUEST['precio'],
				$_REQUEST['anio_creacion'],$_REQUEST['foto'],$_REQUEST['id_proveedor_producto'],$_REQUEST['talla'],
				$_REQUEST['cantidad'],$_REQUEST['imagen']);
				
				if($result) {
					
					$response['error'] = false;
					
				} else {
					
					$response['error'] = true; 
					
				}
				
			break; 

			case 'numeroCompras':

				$result = $db->numeroCompras($_REQUEST['user']);
				if($result) {
					
					$response['error'] = true; 

				} else {

					$response['error'] = false;
		 	
				}
				
			break;

			case 'retrasarEntrega':

				$result = $db->retrasarEntrega($_REQUEST['id_compra']);
				
				if($result) {
							
						$response['error'] = true; 
						
						

				} else {

						$response['error'] = false;
												
					
				}
							
				break; 			

			/**INSERTAR FOTO */
			case 'insertPhoto':
								
				$result = $db->insertPhoto(
					$_REQUEST['imagen'],
					$_REQUEST['nombreImagen']);
				
				if($result) {
					
					$response['error'] = false; 				
				} else {
				
					$response['error'] = true; 	
				}
				
			break; 

			/**MOSTRAR FOTOS*/
			case 'getPhotos':

				$response['error'] = false; 
				$response['fotos'] = $db->getPhotos();
			break;

			/**FILTRO MARCA PRODUCTOS*/
			case 'filtroMarcaProducto':

				$response['productos'] = $db->filtroMarcaProducto($_REQUEST['marca']);

				if($response) {
					
					$response['error'] = false; 				
				} else {
					
					$response['error'] = true; 	
				}
				
			break; 

			/**FILTRO TALLA PRODUCTOS*/
			case 'filtroTallaProducto':

				$response['productos'] = $db->filtroTallaProducto($_REQUEST['talla']);

				if($response) {
					
					$response['error'] = false; 				
				} else {
					
					$response['error'] = true; 	
				}
				
			break; 

			/**FILTRO ANIO PRODUCTOS*/
			case 'filtroAnioProducto':

				$response['productos'] = $db->filtroAnioProducto($_REQUEST['anio_creacion']);

				if($response) {
					
					$response['error'] = false; 				
				} else {
					
					$response['error'] = true; 	
				}
				
			break; 

			/**MOSTRAR PRODUCTOS*/
			case 'mostrarProductosDisponibles':

				$response['productos'] = $db->mostrarProductosDisponibles();

				if($response) {
					
					$response['error'] = false; 				
				} else {
					
					$response['error'] = true; 	
				}
				
			break; 

			/**CREAR USUARIO*/
			case 'crearUsuario':
							
				$result = $db->crearUsuario(
					$_REQUEST['dni'],
					$_REQUEST['nombre_usuario'],
					$_REQUEST['user'],
					$_REQUEST['pass']);
				
				if($result) {
					
					$response['error'] = true; 

				} else {
					
					$response['error'] = false;
					 	
				}
				
			break; 

			/**BUSCAR USUARIO */
			case 'buscarUsuario':
				
				$result = $db ->buscarUsuario($_REQUEST['user'],$_REQUEST['pass']);

				if($result ){

					$response['error'] = false;
				}else{

					$response['error'] = true;
				} 
									
			break;
			
			/**ES TRABAJADOR*/
			case 'esTrabajador':
				
				$result = $db ->esTrabajador($_REQUEST['user'],$_REQUEST['pass']);

				if($result){

					$response['error'] = false;
				}else{

					$response['error'] = true;
				} 
									
			break; 
			
			case 'crearProducto':
				
				$result = $db ->crearProducto($_REQUEST['id_producto'],$_REQUEST['marca'],$_REQUEST['modelo'],$_REQUEST['precio'],$_REQUEST['anio_creacion'],$_REQUEST['foto'],$_REQUEST['id_proveedor_producto'],$_REQUEST['talla'],$_REQUEST['cantidad'],$_REQUEST['imagen']);

				if($result){

					$response['error'] = true;
					
				}else{

					
					$response['error'] = false;
				} 
									
			break; 
			
			case 'cambiarPassword':
				
				$result = $db ->cambiarPassword($_REQUEST['pass'],$_REQUEST['user']);

				if($result){

					$response['error'] = false;
					
				}else{
					
					$response['error'] = true;
				} 
									
			break; 

			case 'cantidadProductos':
				
				
				$response['productos'] = $db ->cantidadProductos($_REQUEST['id_producto']);

				if($response) {
					
					$response['error'] = false;
					 				
				} else {
					
					$response['error'] = true; 	
				}
									
			break; 

			case 'hayStock':

				$result = $db->hayStock($_REQUEST['id_producto']);

				if($result) {
					
					
					$response['error'] = true;

				} else {

					$response['error'] = false; 
						
				}
				
			break;
			
			
		}

		echo json_encode($response);
	}
