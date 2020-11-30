<?php
require_once 'Conexion.php'; /*importa Conexion.php*/
require_once 'modelos/ModeloUsuario.php'; /*importa el modelo */
class UsuarioDao
{
    
	private $conexion; /*Crea una variable conexion*/
        
    private function conectar(){
        try{
			$this->conexion = Conexion::abrirConexion(); /*inicializa la variable conexion, llamando el metodo abrirConexion(); de la clase Conexion por medio de una instancia*/
		}
		catch(Exception $e)
		{
			die($e->getMessage()); /*Si la conexion no se establece se cortara el flujo enviando un mensaje con el error*/
		}
    }
    
    
   /*Metodo que obtiene todos los productos de la base de datos, retorna una lista de objetos */
	public function obtenerTodos()
	{
		try
		{
            $this->conectar();
            
			$lista = array(); /*Se declara una variable de tipo  arreglo que almacenará los registros obtenidos de la BD*/

			$sentenciaSQL = $this->conexion->prepare(
                "SELECT ID Clave, Usuario Usuario, Nombre Nombre,
                Password Password, Direccion Direccion, EsEmpleado EsEmpleado 
                FROM Usuario ORDER BY ID;");
            
                
			$sentenciaSQL->execute();/*Se ejecuta la sentencia sql, retorna un cursor con todos los elementos*/
            
            /*Se recorre el cursor para obtener los datos de la forma de arreglo de objetos*/
			foreach($sentenciaSQL->fetchAll(PDO::FETCH_OBJ) as $fila)
			{
				$obj = new ModeloUsuario();
                $obj->ID = $fila->Clave;
	            $obj->Usuario = $fila->Usuario;
	            $obj->Nombre = $fila->Nombre;
	            $obj->Password = $fila->Password;
				$obj->Direccion = $fila->Direccion;
				$obj->EsEmpleado= $fila->EsEmpleado;
				$lista[] = $obj;
			}
            
			return $lista;
		}
		catch(Exception $e){
			echo $e->getMessage();
			return null;
		}finally{
            Conexion::cerrarConexion();
        }
    }
    
    public function obtenerCarrito($id)
	{
		try
		{
            $this->conectar();
            
			$lista = array(); /*Se declara una variable de tipo  arreglo que almacenará los registros obtenidos de la BD*/

			$sentenciaSQL = $this->conexion->prepare(
                "SELECT ID Clave, IDUsuario IDUsuario, IDLibro IDLibro,Libro Libro, Precio Precio 
                FROM Carrito WHERE IDUsuario = ? ;");
            
                
			$sentenciaSQL->execute([$id]);/*Se ejecuta la sentencia sql, retorna un cursor con todos los elementos*/
            
            /*Se recorre el cursor para obtener los datos de la forma de arreglo de objetos*/
			foreach($sentenciaSQL->fetchAll(PDO::FETCH_OBJ) as $fila)
			{
				$obj = new ModeloCarrito();
                $obj->ID = $fila->Clave;
	            $obj->IDUsuario = $fila->IDUsuario;
	            $obj->IDLibro = $fila->IDLibro;
	            $obj->Libro = $fila->Libro;
				$obj->Precio = $fila->Precio;
				$lista[] = $obj;
			}
            
			return $lista;
		}
		catch(Exception $e){
			echo $e->getMessage();
			return null;
		}finally{
            Conexion::cerrarConexion();
        }
    }
    
    public function obtenerDeseados($id)
	{
		try
		{
            $this->conectar();
            
			$lista = array(); /*Se declara una variable de tipo  arreglo que almacenará los registros obtenidos de la BD*/

			$sentenciaSQL = $this->conexion->prepare(
                "SELECT ID Clave, IDUsuario IDUsuario, IDLibro IDLibro,Libro Libro
                FROM Deseados WHERE IDUsurio = ? ;");
            
                
			$sentenciaSQL->execute([$id]);/*Se ejecuta la sentencia sql, retorna un cursor con todos los elementos*/
            
            /*Se recorre el cursor para obtener los datos de la forma de arreglo de objetos*/
			foreach($sentenciaSQL->fetchAll(PDO::FETCH_OBJ) as $fila)
			{
				$obj = new ModeloDeseado();
                $obj->ID = $fila->Clave;
	            $obj->IDUsuario = $fila->IDUsuario;
	            $obj->IDLibro = $fila->IDLibro;
	            $obj->Libro = $fila->Libro;
				$lista[] = $obj;
			}
            
			return $lista;
		}
		catch(Exception $e){
			echo $e->getMessage();
			return null;
		}finally{
            Conexion::cerrarConexion();
        }
	}
    
    /*Metodo que obtiene un registro de la base de datos, retorna un objeto */
	public function obtenerUno($id)
	{
		try
		{ 
            $this->conectar();
            
			$sentenciaSQL = $this->conexion->prepare("SELECT ID Clave, Usuario Usuario, Nombre Nombre,
                                                Password Password, Direccion Direccion , EsEmpleado EsEmpleado 
											FROM Usuario 
											WHERE ID=?"); /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
			$sentenciaSQL->execute([$id]);/*Se ejecuta la sentencia sql, retorna un cursor el producto a buscar*/
            
            /*Obtiene los datos con la forma de un objeto*/
			$fila=$sentenciaSQL->fetch(PDO::FETCH_OBJ);
			
                $obj = new ModeloUsuario();
                $obj->ID = $fila->Clave;
	            $obj->Usuario = $fila->Usuario;
	            $obj->Nombre = $fila->Nombre;
	            $obj->Password = $fila->Password;
				$obj->Direccion = $fila->Direccion;
				$obj->EsEmpleado= $fila->EsEmpleado;
                
			
			return $obj;
		}
		catch(Exception $e){
            //echo $e->getMessage();
            return null;
		}finally{
            Conexion::cerrarConexion();
        }
	}
    
    //Elimina el registro con el id indicado como parámetro
	public function eliminar($id)
	{
		try 
		{
			$this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare("DELETE FROM Usuario WHERE ID = ?");			          
            
			$sentenciaSQL->execute(array($id));
            return true;
		} catch (Exception $e) 
		{
            return false;
		}finally{
            Conexion::cerrarConexion();
        }
        
	}

	//Función para editar al registro de acuerdo al objeto recibido como parámetro
	public function editar(ModeloUsuario $obj)
	{
		try 
		{
			$sql = "UPDATE Usuario SET 
                    ID = ?,
                    Usuario = ?,
                    Nombre = ?,
					Password = ?,
					Direccion = ?
				    WHERE ID = ?";
			$this->conectar();
			
            $sentenciaSQL = $this->conexion->prepare($sql);			          
			$sentenciaSQL->execute(
				array($obj->ID,
	                $obj->Usuario,
	                $obj->Nombre,
	                $obj->Password,
					$obj->Direccion,
					$obj->EsEmpleado));
            return true;
		} catch (Exception $e){
			echo $e->getMessage();
			return false;
		}finally{
            Conexion::cerrarConexion();
        }
	}

	//Agrega un nuevo registro de acuerdo al objeto recibido como parámetro
	public function agregar(ModeloUsuario $obj)
	{
        $clave=0;
		try 
		{

            $sql = "INSERT INTO Usuario ( Usuario, Nombre, Password, Direccion, EsEmpleado)
			 values( ?, ?, ?, ?, ?)";
            
            $this->conectar();
            $this->conexion->prepare($sql)
                 ->execute(
                array(
                    $obj->Usuario,
                    $obj->Nombre,
                    $obj->Password,
					$obj->Direccion,
					$obj->EsEmpleado));
            $clave=$this->conexion->lastInsertId();
            return $clave;
		} catch (Exception $e){
			//echo $e->getMessage();
			return $clave;
		}finally{
            
            /*
            En caso de que se necesite manejar transacciones, no deberá desconectarse mientras la transacción deba persistir
            */
            Conexion::cerrarConexion();
        }
	}
}