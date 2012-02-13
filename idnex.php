<?php 
phpinfo();
/*namespace reportes_graficos_pdf;    
function __autoload_class($class)
{
    require_once $class;
}
$classToLoad = array(        
        'fpdf/' => 'fpdf'
    );
foreach($classToLoad as $paht => $class) {
    __autoload_class($paht.$class);
}
spl_autoload_extensions('.php');
spl_autoload_register('__autoload_class');
//$autoloadRegister = spl_autoload_extensions('.php');
//var_dump($autoloadRegister);
/*require 'fpdf/fpdf.php';
require 'Pdf.php';


$autoloadRegister = spl_autoload_register(
        array(            
            __NAMESPACE__ . '\FPDF',
            __NAMESPACE__ . '\pdf',
        ));
/*echo "<pre>";
var_dump($autoloadRegister);
echo "</pre>";*/

?>