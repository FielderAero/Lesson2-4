<?php
header('content-type:image/png');
$im=imagecreatefrompng('sad.png');
$text="Your answer is wrong. You have failed";
imagettftext($im, 25,0, 200, 220, 0x707070 , 'ARIAL.TTF', $text);
/*imagettftext ( resource $image , float $size , float $angle , int $x , int $y , int $color , string $fontfile , string $text )*/
imagepng($im);
imagedestroy($im);
?>
