<?php
	$im = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/nik/image_crop/example.png');
	//$size = min(imagesx($im), imagesy($im));
	$size = 60;
	$xy = 12;
	// 이미지 crop
	$im2 = imagecrop($im, ['x' => $xy, 'y' => $xy, 'width' => $size, 'height' => $size]);

	if ($im2 !== FALSE) {
		// crop한 이미지 생성 및 저장
		imagepng($im2, $_SERVER['DOCUMENT_ROOT'].'/nik/image_crop/example_crop.png');
		imagedestroy($im2);
	}
	// 기존 이미지 캐시 제거
	imagedestroy($im);

	// 기존 이미지 삭제
	//unlink($_SERVER['DOCUMENT_ROOT'].'/nik/image_crop/index.php');
?>
