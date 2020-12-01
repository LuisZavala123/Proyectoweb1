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
                "SELECT ID Clave, IDUsuario IDUsuario, IDCarrito IDCarrito,
                Monto Monto, Total Total, Fecha Fecha 
                FROM Pago ;");
            
                
			$sentenciaSQL->execute();/*Se ejecuta la sentencia sql, retorna un cursor con todos los elementos*/
            
            /*Se recorre el cursor para obtener los datos de la forma de arreglo de objetos*/
			foreach($sentenciaSQL->fetchAll(PDO::FETCH_OBJ) as $fila)
			{
				$obj = new ModeloPago();
				$obj->ID = $fila->IDClave;
                $obj->IDUsuario = $fila->IDUsuario;
	            $obj->Monto = $fila->Monto;
				$obj->Total = $fila->Total;
				$obj->Fecha = $fila->Fecha;
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
	public function obtenerPorUSuario($idusuario)
	{
		try
		{
            $this->conectar();
            
			$lista = array(); /*Se declara una variable de tipo  arreglo que almacenará los registros obtenidos de la BD*/

			$sentenciaSQL = $this->conexion->prepare(
                "SELECT ID Clave, IDUsuario IDUsuario, IDCarrito IDCarrito,
                Monto Monto, Total Total, Fecha Fecha 
                FROM Pago where IDUsuario = ?;");
            
                
			$sentenciaSQL->execute($idusuario);/*Se ejecuta la sentencia sql, retorna un cursor con todos los elementos*/
            
            /*Se recorre el cursor para obtener los datos de la forma de arreglo de objetos*/
			foreach($sentenciaSQL->fetchAll(PDO::FETCH_OBJ) as $fila)
			{
				$obj = new ModeloPago();
				$obj->ID = $fila->IDClave;
                $obj->IDUsuario = $fila->IDUsuario;
	            $obj->Monto = $fila->Monto;
				$obj->Total = $fila->Total;
				$obj->Fecha = $fila->Fecha;
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
    
    //Elimina el registro con el id indicado como parámetro
	public function eliminar($id)
	{
		try 
		{
			$this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare("DELETE FROM Pago WHERE ID = ?");			          
            
			$sentenciaSQL->execute(array($id));
            return true;
		} catch (Exception $e) 
		{
            return false;
		}finally{
            Conexion::cerrarConexion();
        }
        
	}

	public function eliminarPorusuario($id)
	{
		try 
		{
			$this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare("DELETE FROM Pago WHERE IDUsuario = ? ");			          
            
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
	public function editar(ModeloPago $obj)
	{
		try 
		{
			$sql = "UPDATE Pago SET
                    IDUsuario = ?,
					Total = ?,
					Monto= ?,
                    Fecha = ? 
				    WHERE ID = ?";
			$this->conectar();
			
            $sentenciaSQL = $this->conexion->prepare($sql);			          
			$sentenciaSQL->execute(
				array($obj->IDUsuario,
	                $obj->Total,
	                $obj->Monto,
                    $obj->Fecha,
                    $obj->ID));
            return true;
		} catch (Exception $e){
			echo $e->getMessage();
			return false;
		}finally{
            Conexion::cerrarConexion();
        }
	}

	//Agrega un nuevo registro de acuerdo al objeto recibido como parámetro
	public function agregar(ModeloPago $obj)
	{
        $clave=0;
		try 
		{

            $sql = "INSERT INTO Pago (ID,IDUsuario, Monto, Total, Fecha)
			 values(?, ?, ?, ?, ?)";
            
            $this->conectar();
            $this->conexion->prepare($sql)
                 ->execute(
                array($obj->ID,
                    $obj->IDUsuario,
                    $obj->Monto,
                    $obj->Total,
                    $obj->Fecha));
            $clave=1;
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