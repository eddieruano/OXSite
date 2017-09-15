<?php
if (isset($_POST['name'], $_POST['email'], $_POST['number'], $_POST['selection'], $_POST['message'])) {
	//print_r($_POST);
	$ema = "eddieruano@gmail.com";
	$pnm = $_POST['name'];
	$pnmEmail = $_POST['email'];
	$pnmNumber = $_POST['number'];
	$pnmYear = $_POST['selection'];
	$pnmTalent = $_POST['message'];
	$pnmInfo = "Email: ".$pnmEmail. "\nNumber: " .$pnmNumber. "\nYear: ".$pnmYear. "\nTalent: " .$pnmTalent."\n";
	mail($ema, $pnm, $pnmInfo);
	
}


echo "Yoooooooooooooo";
?>