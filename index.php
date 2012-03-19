<?php 
function __autoload_class($class)
{    
    require_once $class;
}
$classToLoad = array(                
        'graph/' => 'MyWrapperGraph.php',
        '' => 'Pdf.php'
    );
foreach($classToLoad as $paht => $class) {
    __autoload_class($paht.$class);
}

//pruebas a las clases 
$pdf = new Pdf();//creamos el documento pdf
$pdf->AddPage();//agregamos la pagina

$pdf->SetFont("Arial","B",16);//establecemos propiedades del texto tipo de letra, negrita, tamaño

//$pdf->Cell(40,10,'hola mundo',1);

$pdf->Cell(0,5,"GRAFICO REALIZADO CON FPDF Y JGRAPH",0,0,'C');
$pdf->graphPdf(array('aprobados'=>array(1,'red'),'reprobados'=>array(1,'blue')), array(20,40,100,50), array('width' => 350, 'height' => 250) );

$pdf->Output(); 


?>
