<?php
if (isset($_POST['name'], $_POST['email'], $_POST['number'], $_POST['selection'], $_POST['message'])) {
	print_r($_POST);
	$ema = "eddieruano@gmail.com";
	$pnm = $_POST['name'];
	$pnmEmail = $_POST['email'];
	$pnmNumber = $_POST['number'];
	$pnmYear = $_POST['selection'];
	$pnmTalent = $_POST['message'];
	$pnmInfo = "Email: ".$pnmEmail. "\nNumber: " .$pnmNumber. "\nYear: ".$pnmYear. "\nTalent: " .$pnmTalent."\n";
	mail($ema, $pnm, $pnmInfo);
	
}
?>	
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Theta Chi Fraternity Zeta Phi Chapter</title>
<!--------------------------------------->
<link rel="stylesheet" type="text/css" href="css/SharedStyle.css" />
<link rel="stylesheet" type="text/css" href="css/MainStyle.css" />
<link rel="stylesheet" type="text/css" href="css/formStyle.css" />
<link rel="stylesheet" type="text/css" href="css/rushStyle.css" />
<link rel="stylesheet" type="text/css" href="css/footerStyle.css" />
<!-- The JavaScript -->
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/NavigationBar.js"></script>

<style>
.HeaderBackdrop{
	background-image:url(TryBan2.jpg);
	
}
</style>

</head>
<body>

<div class="containment">
<!--Testing container-->
  <div class="Header" align="center">
	  <div class="HeaderBackdrop" align="center">
        <div class="HeaderContent">
       <img class="topLogo" src="Images/logo.png" width="228" height="124" alt="LOGO" />
       <img class="topLogoLeft" src="Images/NewTopLeftLogo.gif" alt="LOGO" />
      </div>
  	</div>
</div>
<!---#AE1A26-->


  		<div class="navBar" align="center"> 
       
			<ul id="sdt_menu" class="sdt_menu">
				<li>
					<a href="index.html">
						<img src="Images/theta_chi.jpg" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Home</span>
							<span class="sdt_descr">...</span>
						</span>
					</a>
				</li>
                <li>
					<a href="rush.html">
						<img src="Images/Crest.jpg" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Join</span>
							<span class="sdt_descr">Express Intrest</span>
						</span>
					</a>
				</li>
                 
                <li>
					<a href="#">
						<img src="Images/Booth.jpg" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Brotherhood</span>
							<span class="sdt_descr">Values</span>
						</span>
					</a>
                    <div class="sdt_box">
                    		<a href="#">Our Creed</a>
							<a href="#">Events</a>
							<a href="#">Brothers</a>
                            
							
					</div>
				</li>
				<li>
					<a href="philantrophy.html">
						<img src="Images/tips.jpg" alt="Tri Tip"/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Philantrophy</span>
							<span class="sdt_descr">Events</span>
						</span>
					</a>
					<div class="sdt_box">
                    		<a href="philantrophy.html">Events</a>
							<a href="#">Partnerships</a>
							<a href="#">Calendar</a>
							
					</div>
				</li>
				<li>
					<a href="#">
						<img src="Images/OX_flag.jpg" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">About Us</span>
							<span class="sdt_descr">Who We Are</span>
						</span>
					</a>
                    <div class="sdt_box">
                            <a href="Parents.html">Parents</a>
                    		<a href="contact.html">Contact Info</a>
							<a href="#">Chapter History</a>
							<a href="NationalHistory.html">National History</a>
                            
							
					</div>
				</li>
				<li>
					<a href="gallery.html">
						<img src="Images/chiO.jpg" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Gallery</span>
							<span class="sdt_descr">Take a Quick Look</span>
						</span>
					</a>
				</li>
				<li>
					<a href="#">
						<img src="Images/group.jpg" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Login</span>
							<span class="sdt_descr">Active Brother Login</span>
						</span>
					</a>
				</li>
		  </ul>
  </div> 
  
  <div id="mainSign">
  <!--<form action="ajax/contact.php" method="post" class="ajax">
    <div><input type="text" name="name" placeholder="Your Name"></div>
    
    <div><input type="text" name="email" placeholder="Your email"></div>
    
    <div><textarea name="message" placeholder="Your Message"></textarea></div>
    
   <div><input type="submit" value="Send"></div>
    
    </form>-->
    
    
  
    <form action="ajax/contact.php" method="post" class="dark-matter" id="ajax">
    <h1>Potential New Member Form
        <span>Please fill all the texts in the fields.</span>
    </h1>
    <label for="name">
        <span>Your Name :</span>
        <input id="name" type="text" name="name" placeholder="Your Full Name" />
    </label>
    
    <label for="email">
        <span>Your Email :</span>
        <input id="email" type="email" name="email" placeholder="Valid Email Address" />
    </label>
    
    <label for="number">
        <span>Your Number :</span>
        <input id="number" type="tel" name="number" placeholder="Valid Number" />
    </label>
    
    <label>
        <span>Grade :</span><select name="selection">
        <option value="freshman">1st Year</option>
        <option value="sophomore">2nd Year</option>
        <option value="junior">3rd Year</option>
        <option value="senior">4th Year</option>
        <option value="superSenior">4+ Year</option>
        </select>
    </label>
    
    <label>
        <span>What is something unique about you?</span>
        <textarea id="message" name="message" placeholder="Click me bro.. you won't"></textarea>
    </label> 
         
     <label>
        <span>&nbsp;</span> 
        <input type="submit" class="button" value="Send" /> 
    </label>    
</form>
  
  
  
  </div>
 
  <script src="js/main.js"></script>
 
</div><!--Containment-->
<div class="footer">
        	<div class="quote">
            	<img src="Images/smallLOGO.gif" width="39" height="50" style="float:left"> 
            	<img src="Images/smallLOGO.gif" width="39" height="50" style="float:right">
            	"...I was never part of the majority."</br> - Steven Speilberg<br /> Theta Chi (Zeta Epsilon) Alumnus 
            </div>
        
	   </div>
 <hr style="
    border: 0;
    height: 1px;
    background-image: -webkit-linear-gradient(left, rgba(0,0,0,0), rgba(255,255,255,0.75), rgba(0,0,0,0)); 
    background-image:    -moz-linear-gradient(left, rgba(0,0,0,0), rgba(255,255,255,0.75), rgba(0,0,0,0)); 
    background-image:     -ms-linear-gradient(left, rgba(0,0,0,0), rgba(255,255,255,0.75), rgba(0,0,0,0)); 
    background-image:      -o-linear-gradient(left, rgba(0,0,0,0), rgba(255,255,255,0.75), rgba(0,0,0,0)); 
    color:#FFF;
">

        
<div id="footer">
      	<div id="rightfoot">
        	<a href="index.html">Home</a> |
            <a href="chapterhistory.html">About</a> |
            <a href="philantrophy.html">Philantropy</a> |
            <a href="gallery.html">Gallery</a> |
            <a href="contact.html">Contact</a> |
            <a href="http://www.cpthetachi.com/wiki">Wiki</a> |
            <a href="rush.html">Rush</a> |
            <a href="https://michael.asmallorange.com:2083/login">Administration</a>
            
            
            
        </div>
      <div id="enfenete">Powerered By:<a href="http://www.instagram.com/omgeddie805"><img src="enfenete.png" id="Eddie"/></a></div>
      
      <div id="social">
      	<p style="color:#FFF; text-align:center; padding: 0px; margin: 0;">Follow Us!</p>
        <hr style="color:#FFF;">
        <a href="https://www.facebook.com/thetachizetaphi"><img src="Images/icon_fb1.png" onMouseOver="this.src='Images/icon_fb.png';" onMouseOut="this.src='Images/icon_fb1.png';" style="float: left;"/></a>
        <a href="http://www.youtube.com/channel/UCHBJDsmSh72tTbL7Na-qCGA"><img src="Images/icon_yt1.png" onMouseOver="this.src='Images/icon_yt.png';" onMouseOut="this.src='Images/icon_yt1.png';"/></a>
        <a href="https://twitter.com/thetachislo"><img src="Images/icon_tw1.png" onMouseOver="this.src='Images/icon_tw.png';" onMouseOut="this.src='Images/icon_tw1.png';" style="float: right;"/></a>
      </div>
      
      <div id="theta">
      <img src="Images/customLogo.png">
      </div>
      
      </div>
<p style="margin: 10px; color:#FFF; font-size:12px; font-family: 'OpenSansRegular', Helvetica, Arial, sans-serif;"> Copyright 2014. Theta Chi | Enfenete</p>
  
  
</body>
  
  
  
 </html>
