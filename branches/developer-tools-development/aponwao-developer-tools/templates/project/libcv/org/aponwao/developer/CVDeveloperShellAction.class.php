<?php
/*
APONWAO FRAMEWORK
Copyright (C) 2009 Coral Vision Systems

Developers:
Juan Scarton <jscarton@aponwaophp.org>
Rafael Vivas <rvivas@aponwaophp.org>
Saul Bautista <sbautista@aponwaophp.org>

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/
/**
 * Esta acción regula el funcionamiento de la consola para desarrolladores de Aponwao
 * @author Juan Scarton
 * @version 03/07/2009
 * @package ORG::APONWAO::developer
 */
class CVDeveloperShellAction extends CVActionHandler
{	
	/**
	 * constructor por defecto modifique segun sea necesario
	 * @return CVActionHandler
	 */
	public function __construct()
	{
		parent::__construct();			
	}
	/**
	 * Este metodo es el punto de inicio de la acción.
	 */
	public function doIt()
	{						
		$this->show(); 				
	}	
	public function interpreter()
	{
		
		if ($this->request->isDefined("input"))
		{
			$args=explode(" ",$this->request->get("input"));
			$option=$args[0];
			switch ($option)
			{
				case 'echo': $this->_echo($args);
							 break;
				case 'propel':$this->propel($args);
							 break;
				case 'help' :
				case 'ayuda':	
				default :	$this->ayuda($args);
							break;
			}
		}	
			 
	}	 
	private function ayuda($args)
	{
		echo "[Aponwao Developer's Shell <aponwaophp.org>]\n
			  \t[ayuda]\n
			  \tmuestra esta información\n\n
			  \t[echo]\n
			  \techo algun_texto_para_imprimir\n
			  \tsirve para probar la conexión con el servidor web. imprime el texto que se envie como parametro de la llamada\n\n
			  \t[propel]\n
			  \tpropel -t target alias
			  \t\ttarget: es el target de propel a generar (consulte la documentación de propel para mayor información acerca de los targets disponibles)\n
			  \t\talias:es el nombre del alias de base de datos definido en el archivo data.xml\n
			  \tdefinida una conexión a una base de datos en el archivo data.xml este comando permite interactuar con la interfaz de comandos de propel (en general el comando propel-gen)\n\n";	
	}	
	private function _echo($args)
	{
		foreach($args as $key=>$arg)
			if ($key!==0)
				echo $arg," ";
	}
	private function propel($args)
	{
		$alias=false;
		$target=false;
		$sudoUser=false;
		$sudoPassword=false;
		$active="alias";
		//procesa los parametros de conexion
		foreach($args as $key=>$arg)
			switch($arg)
			{
				case "-t":	$active="t";
							break;
				case "-u":	$active="u";
							break;
				case "-p":	$active="p";
							break;
				default:	if ($active=="t")
								$target=$arg;
							if ($active=="u")
								$sudoUser=$arg;
							if ($active=="p")
								$sudoPassword=$arg;
							if ($active=="a")
								$alias=$arg;
							$active="a";
							break;
			}			
		if (!$alias || !$target)
			echo "\nerror: debe especificar un alias y un target para poder realizar la operación ";
		else
		{
			switch($target) {
					case "generate" : 	//obtiene una referencia al datamanager para obtener los parametros de conexion
										$dm=getDataManager();
										$db=$dm->getConnectionParams($alias);
										//crea el archivo de proyecto en la raiz
										$buildfiletext=$this->propel_build_file($db);
										file_put_contents("cache/build.properties",$buildfiletext);
										//crea el archivo de configuración de runtime
										$conffiletext=$this->propel_runtime_file($db);
										file_put_contents("cache/runtime-conf.xml",$conffiletext);
										//ejecuto el comando de propel para generar el schema.xml
										$output=shell_exec("sudo propel-gen ".APP_ROOT."/cache creole");
										echo $output;
										$output=shell_exec("sudo propel-gen ".APP_ROOT."/cache ");
										echo $output;
										break;
					case "cleanup":		unlink("cache/runtime-conf.xml");
										unlink("cache/build.properties");
										break;
			}
			
		}
	}
	
	private function propel_build_file($db)
	{
		$alias=(string)$db->getName();
		$type=(string)$db->typedb;
		$dbhost=(string)$db->host;
		$dbname=(string)$db->dbname;
		$user=(string)$db->user;
		$password=(string)$db->password;
		$rootdir=APP_ROOT;
		$txt="#asignar un nombre de proyecto, en general es el mismo valor que la propiedad codename
\r\npropel.project =$alias
\r\n#tipo de base de datos: mysql, pgsql, oracle, sqlite
\r\npropel.database = $type
\r\n#url para conectarse a la BD, ejemplo mysql://usuario:password@localhost/dbname
\r\npropel.database.creole.url =$type://$user:$password@$dbhost/$dbname
\r\n#esta opción es solo para bases de datos en mysql los valores posibles son innodb y myisam
\r\npropel.mysql.tableType=innodb
\r\n#este es el nombre del paquete al cual van a pertenecer las clases generadas
\r\npropel.targetPackage =$alias
\r\n
\r\n# directorios
\r\n#este es el directorio raiz del proyecto en mi caso /var/www/dev/aponwao-sourceforge
\r\npropel.output.dir =$rootdir
\r\n#no modificar nada a partir de aqui lineas
\r\npropel.php.dir = \${propel.output.dir}/classes/data
\r\npropel.phpconf.dir = \${propel.output.dir}/setup
\r\npropel.sql.dir = \${propel.output.dir}/resources/others
\r\n
\r\n# no modificar estas lineas
\r\npropel.addGenericAccessors = true
\r\npropel.addGenericMutators = true";
		return $txt;
	}
	private function propel_runtime_file($db)
	{
		$alias=(string)$db->getName();
		$type=(string)$db->typedb;
		$dbhost=(string)$db->host;
		$dbname=(string)$db->dbname;
		$user=(string)$db->user;
		$password=(string)$db->password;
		$rootdir=APP_ROOT;
		$txt="<?xml version=\"1.0\" encoding=\"UTF-8\"?>
\n<!-- This new XML configuration format is the default format for properties
\nfiles.  You can also used the old INI-based .properties format, but
\nsupport for this will be removed in next major Propel version. -->
\n<config>
\n<!--
\n#
\n#  P R O P E L  P R O P E R T I E S
\n#
\n# Note that you can configure multiple datasources; for example if your
\n# project uses several databases.
\n-->
\n <propel>
\n	<datasources default=\"$alias\">
\n		<datasource id=\"$alias\">
\n			<!-- the Propel adapter (usually same as phptype of connection DSN) -->
\n			<adapter>$type</adapter>
\n			<!-- Connection DSN.  See PEAR DSN format for other supported parameters. -->
\n			<connection>
\n				<dsn>$type:host=$dbhost;dbname=$dbname</dsn>
\n				<user>$user</user>
\n				<password>$password</password>
\n			</connection>
\n		</datasource>
\n	</datasources>
\n </propel>	
\n</config>";
		return $txt;
	}
}
?>