<?php
require('fpdf.php');

$list=array("A1x1", "A2x1", "A1x2", "A3x1", "A1x3", "A4x1", "A1x4", "A5x1", "A1x6", "A6x1", "A1x7", "A7x1", "A1x8", "A8x1", "A1x9", "A9x1", "B2x2", "B2x2", "B2x3", "B3x2", "C2x4", "C4x2", "C2x5", "C5x2", "D2x6", "D6x2", "D2x7", "D7x2", "E2x8", "E8x2", "E2x9", "E9x2", "F3x3", "F3x3", "F3x4", "F4x3", "G3x5", "G5x3", "G3x9", "G9x3", "H3x6", "H6x3", "H4x9", "H9x4", "I3x7", "I7x3", "I5x9", "I9x5", "J3x8", "J8x3", "J6x9", "J9x6", "K0x1", "K1x0", "K0x2", "K2x0", "K0x3", "K3x0", "K0x4", "K4x0", "K0x5", "K5x0", "K0x6", "K6x0", "K0x7", "K8x0", "K0x8", "K9x0", "L7x9", "L9x7", "L7x9", "L9x7", "M4x4", "M4x4", "M4x5", "M5x4", "N8x9", "N9x8", "N8x9", "N9x8", "O4x6", "O6x4", "O4x7", "O7x4", "P5x5", "P5x5", "P4x8", "P8x4", "Q5x6", "Q6x5", "Q5x7", "Q7x5", "R6x6", "R6x6", "R5x8", "R8x5", "S6x7", "S7x6", "S6x7", "S7x6", "T7x7", "T7x7", "T6x8", "T8x6", "U7x8", "U8x7", "U7x8", "U8x7", "V8x8", "V8x8", "V9x9", "V9x9");
function writesimple($pdf,$xpos,$ypos,$a,$b){
	$x=0.4+$xpos*7.6;
	$y=1.5+$ypos*1;
	$pdf->Text($x,$y,"$a");
	$pdf->Text($x-0.10,$y+0.2,"x $b");
}

function writeone($pdf,$line,$pos,$level){
	global $list;
	$x=1.5+$pos*0.9;
	$y=1.5+$line*1;
	$total=count($list);
	while(true){
		$rcount=0;
		while(true){
			$r=rand(1,$total);
			$rlevel=$list[$r-1][0];
			if (($rlevel=='A' || $rlevel=='K') && $rcount<3){
				$rcount++;
				continue;
			}
			break;
		}
		if ($list[$r-1][0]<=$level[0]){
			$a=$list[$r-1][1];
			$b=$list[$r-1][3];
			break;
		}
	}
	$pdf->Text($x,$y,"$a");
	$pdf->Text($x-0.12,$y+0.2,"x $b");
}


$level="A";
if (isset($_GET['level'])){
	$level=$_GET['level'];
}
$pdf = new FPDF('P','in','Letter');
$pdf->AddPage();
$pdf->SetFont('Arial','',18);
$pdf->Text(3.2,0.5,"Rocket Math Level $level");
$pdf->SetFont('Arial','',10);
$today = date("m/d/Y");
$pdf->Text(3.8,0.75,"$today");
$pdf->SetFont('Arial','',12);
$pdf->SetLineWidth(0.01);
$y=1.8;
for ($i=0;$i<9;$i++){
	$pdf->Line(1.3,$y+$i*1,7.1,$y+$i*1);
}

$pdf->SetFontSize(10);
$total=count($list);
$count=0;
while($count<18){
	for ($i=0;$i<$total;$i++){
		if ($list[$i][0]!=$level[0])
			continue;
		$xpos=(int)($count/9);
		$ypos=$count%9;
		$a=$list[$i][1];
		$b=$list[$i][3];
		writesimple($pdf,$xpos,$ypos,$a,$b);
		$count++;
	}
}

$pdf->Rect(0.9,0.9,6.7,9.7);
$pdf->SetFontSize(12);
srand((double) microtime() * 1000000); 
for ($line=0;$line<9;$line++){
	for ($pos=0;$pos<7;$pos++){
		writeone($pdf,$line,$pos,$level);
	}
}
$pdf->Output();
