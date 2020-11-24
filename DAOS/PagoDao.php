<?php
require_once 'Conexion.php'; /*importa Conexion.php*/
require_once '../modelos/ModeloPago.php'; /*importa el modelo */
class ProductoDao
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
                "SELECT IDUsuario IDUsuario, IDCarrito IDCarrito,Metodo Metodo,
                Monto Monto, Cantidad Cantidad 
                FROM Pago ;");
            
                
			$sentenciaSQL->execute();/*Se ejecuta la sentencia sql, retorna un cursor con todos los elementos*/
            
            /*Se recorre el cursor para obtener los datos de la forma de arreglo de objetos*/
			foreach($sentenciaSQL->fetchAll(PDO::FETCH_OBJ) as $fila)
			{
				$obj = new ModeloPago();
                $obj->IDUsuario = $fila->IDUsuario;
	            $obj->IDCarrito= $fila->IDCarrito;
	            $obj->Metodo = $fila->Metodo;
	            $obj->Monto = $fila->Monto;
	            $obj->Cantidad = $fila->Cantidad;
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
	public function obtenerUno($idusuario,$idcarrito)
	{
		try
		{ 
            $this->conectar();
            
			$sentenciaSQL = $this->conexion->prepare("SELECT IDUsuario IDUsuario, IDCarrito IDCarrito,Metodo Metodo,
                                            Monto Monto, Cantidad Cantidad   
											FROM Pago  
											WHERE IDUsuario=? and IDCarrito = ?"); /*Se arma la sentencia sql para seleccionar todos los registros de la base de datos*/
			$sentenciaSQL->execute([$idusuario,$idcarrito]);/*Se ejecuta la sentencia sql, retorna un cursor el producto a buscar*/
            
            /*Obtiene los datos con la forma de un objeto*/
			$fila=$sentenciaSQL->fetch(PDO::FETCH_OBJ);
			
                $obj = new ModeloPago();
                $obj->IDUsuario = $fila->IDUsuario;
                $obj->IDCarrito= $fila->IDCarrito;
                $obj->Metodo = $fila->Metodo;
                $obj->Monto = $fila->Monto;
                $obj->Cantidad = $fila->Cantidad;
                
			
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
	public function eliminar($idusuario,$idcarrito)
	{
		try 
		{
			$this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare("DELETE FROM Pago WHERE IDUsuario = ? and IDCarrito = ?");			          
            
			$sentenciaSQL->execute(array($idusuario,$idcarrito));
            return true;
		} catch (Exception $e) 
		{
            return false;
		}finally{
            Conexion::cerrarConexion();
        }
        
	}

	//Función para editar al registro de acuerdo al objeto recibido como parámetro
	public function editar(Producto $obj)
	{
		try 
		{
			$sql = "UPDATE Pago SET 
                    IDUsuario = ?,
                    IDCarrito = ?,
                    Metodo = ?,
					Monto = ?,
					Cantidad = ?,
                    Fecha = ? 
				    WHERE IDUsuario = ? and IDCarrito = ?";
			$this->conectar();
			
            $sentenciaSQL = $this->conexion->prepare($sql);			          
			$sentenciaSQL->execute(
				array($obj->IDUsuario,
	                $obj->IDCarrito,
	                $obj->Metodo,
	                $obj->Monto,
                    $obj->Cantidad,
                    $obj->Fecha));
            return true;
		} catch (Exception $e){
			echo $e->getMessage();
			return false;
		}finally{
            Conexion::cerrarConexion();
        }
	}

	//Agrega un nuevo registro de acuerdo al objeto recibido como parámetro
	public function agregar(Producto $obj)
	{
        $clave=0;
		try 
		{

            $sql = "INSERT INTO Pago (IDUsuario, IDCarrito, Metodo, Monto, Cantidad, Fecha)
			 values(?, ?, ?, ?, ?, ?)";
            
            $this->conectar();
            $this->conexion->prepare($sql)
                 ->execute(
                array($obj->IDUsuario,
                    $obj->IDCarrito,
                    $obj->Metodo,
                    $obj->Monto,
                    $obj->Cantidad,
                    $obj->Fecha));
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