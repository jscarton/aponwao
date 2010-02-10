<?php
/*echo "Introduzca el directorio del proyecto:";
$in = fopen("php://stdin", "r");
$directorio = fgets($in, 255);
fclose($in);*/
echo "Introduzca el nombre del proyecto:";
$in = fopen("php://stdin", "r");
$proyecto = fgets($in, 255);
fclose($in);
//******crear estructura
$proyecto=trim($proyecto);

$this_path = getcwd();
chdir("../");
$root=getcwd();
echo "\n";
rec_copy($this_path."/templates/project",$root."/".$proyecto);
echo "\nProyecto creado Exitosamente!!!\n";



function rec_copy ($from_path, $to_path) { 
mkdir($to_path, 0755);
//echo "\nbusca:".$from_path."\n";
echo $to_path."\n"; 
$this_path = getcwd(); 
if (is_dir($from_path)) { 
chdir($from_path); 
$handle=opendir('.'); 
while (($file = readdir($handle))!==false) { 
if (($file != ".") && ($file != "..")) { 
if (is_dir($file)) { 
//echo "\nrecursiva manda origen :".$from_path."/".$file;
//echo "\nrecursiva manda destino :".$to_path."/".$file;
rec_copy ($from_path."/".$file, $to_path."/".$file); 
chdir($from_path); 
} 
if (is_file($file)){ 
if(copy($from_path."/".$file, $to_path."/".$file)==false)
  { echo "\ncopy malo de:".$from_path."/".$file;
    echo "\ncopy malo hasta:".$to_path."/".$file; exit;
  }  
} 
} 
} 
closedir($handle); 
}
else { echo "ruta mala:".$from_path; exit;} 
}  
?>