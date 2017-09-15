<?php
if (isset($_POST['name'], $_POST['email'], $_POST['number'], $_POST['selection'], $_POST['message'])) {
	//print_r($_POST);
	$webmaster_email = "eddieruano@gmail.com";
    $tester_email = "webmaster@cpthetachi.com";
    $recruitment_email = "recruitment@cpthetachi.com";
    
    
    
	$pnm = $_POST['name'];
    $pnm = ucwords(strtolower($pnm));
	$pnmEmail = $_POST['email'];
	$pnmNumber = $_POST['number'];
	$pnmYear = $_POST['selection'];
	$pnmBrotherhood = $_POST['message'];
	$pnmInfo = "PNM Email: ".$pnmEmail. "\nPNM Number: " .$pnmNumber. "\nPNM Year: ".$pnmYear. "\nPNM's Brotherhood Meaning: " .$pnmBrotherhood."\n";
    //var_dump($pnmEmail);
    if(strlen($pnm) != null && strlen($pnmEmail != null))
    {
        mail($webmaster_email, $pnm, $pnmInfo);
        mail($tester_email, $pnm, $pnmInfo);
        mail($recruitment_email, $pnm, $pnmInfo);
        
        
        //reply to the sender using this generic message
    
        $server_response_name = "Theta Chi Zeta Phi";
        $server_response = "Hey ".$pnm.",\n\nThanks for showing your interest in our fraternity. Your information has been placed on our interest list and our recruitment chair will contact you as soon as possible.\n\nRegards,\nEddie Ruano\nWebmaster, Theta Chi Fraternity\nwebmaster@cpthetachi.com\n\nThis is an automatic response bro, please do not reply to this email. ";
        mail($pnmEmail, $server_response_name, $server_response);
    }
    else
    {
        die();
    }
	
    
    
    
    
    
	
}
?>

    <html>

    </html>
