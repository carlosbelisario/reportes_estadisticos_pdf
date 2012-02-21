<?php
require_once 'MyWrapperGraph.php';
$graph = new MyWrapperGraph();
$graph->setSize(array('width' => 350, 'height' => 250));
$graph->setJpgraph();
//test line
//array whit the value of the line
$data = array(1,2,3,2,5,1);
$graph->setData($data);
//$graph->createLineGraph();
//
//test pie
//array assoc whit the label=>array(value, color pie)
$data1 = array('aprobados'=>array(1,'red'),'reprobados'=>array(1,'blue'));
$graph->setData($data1);
//$graph->createPieGrap();
//
//test bar
//array assoc whit the label => value to show in the graph
$data2 = array( 'cuatro' => 4, 'cinco' =>56, 'seis' =>7, 'siete' =>8, 'ocho' =>1);
$graph->setData($data2);
$graph->setStyle(array('color' => '#1188ff', 'gradient' => 'white'));
//$graph->createBarGraph();