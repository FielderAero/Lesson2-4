<?php
session_start();
header('content-type:image/png');
$im=imagecreatefrompng('sertif.png');
$text=$_POST[sertif];
$text1=$_POST[name1];
$text2=$text.$text1;
imagettftext($im, 35,0, 220, 220, 0x707070 , 'ARIAL.TTF', $text2);
/*imagettftext ( resource $image , float $size , float $angle , int $x , int $y , int $color , string $fontfile , string $text )*/
imagepng($im);
imagedestroy($im);
?>