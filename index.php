<?php 
include_once ('datasource/DBConnect.php');

function make_query($conn){
 $query = "SELECT * FROM `headlines` ORDER BY id ASC";
 $result = mysqli_query($conn, $query);
 return $result;
}

//------------------------------------------ SLIDE DOTS PROGRAM START ----------------------------------------
function make_slide_indicators($conn){
 $output = ''; 
 $count = 0;
 $result = make_query($conn);
 while($row = mysqli_fetch_array($result))
 {
  if($count == 0)
  {
   $output .= '
   <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'" class="active"></li>
   ';
  }
  else
  {
   $output .= '
   <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'"></li>
   ';
  }
  $count = $count + 1;
 }
 return $output;
}
//------------------------------------------ SLIDE IMAGE PROGRAM START ----------------------------------------

function make_slides($conn){
 $output = '';
 $count = 0;
 $result = make_query($conn);
 while($row = mysqli_fetch_array($result))
 {
  if($count == 0)
  {
   $output .= '<div class="item active">';
  }
  else
  {
   $output .= '<div class="item">';
  }
  $output .= '
   <img style="margin-left: auto; margin-right: auto; max-height: 750px; height: 100%; object-fit: fill; transition: ease-in-out 0.8s" src="data:image;base64,'.base64_encode($row['images']).'" alt="'.$row["title"].'" />
   <div class="carousel-caption" style="left: 0">
    <h3 style="margin-bottom: 1%">'.$row["title"].'</h3>
	<p style="margin-bottom: 5%">'.$row["para"].'</p>
   </div>
  </div>
  ';
  $count = $count + 1;
 }
 return $output;
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="images/Brgy. Bucana Seal.png">
<link rel="stylesheet" href="css/Home.css" >
<!------------------------------------------------------ Alien Code Start --------------------------------------------------------------->
<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<!------------------------------------------------------ Alien Code ENDS --------------------------------------------------------------->
<title>Barangay 76-A Bucana Portal</title>
</head>

<body onload="startTime(); myFunction()">
<?php $UserIP = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];?>
<script>
function myFunction() {
  		 				alert("This Portal Is still for development and subject for Approval by BLGU of Barangay 76-A Bucana <?php echo $UserIP; ?>");
}
</script>
	
	
<div class="headerbar">
	
	<div class="headerbar_text" id="TextSlide_Fixed">
		<h1 style="max-width: 350px; font: italic">The Official Portal of Barangay 76-A Bucana</h1>
		<img class="logo" src="images/Flag.jpg" alt="BRGY Logo">
		<h1 style="text-align: right; width: auto">&nbsp; | &nbsp; <?php echo date("l, M d, Y"); ?> <a id="Timer"></a>  &nbsp; |
		&nbsp;<a href="https://www.facebook.com/brgy76a/" style="text-decoration: none"><i class="fa fa-facebook-square" style="font-size: 20px"></i> &nbsp; Facebook</a> &nbsp; &nbsp; 
		<a href="mailto:losamigosdavaocity.gov@gmail.com" style="text-decoration: none"><i class="fas fa-envelope" style="font-size: 20px"></i>&nbsp; &nbsp;Gmail &nbsp;&nbsp;</a><a href="tel:0822990796" style="text-decoration: none"><i class="fas fa-phone"> </i>  &nbsp; Contact Us </a>
		</h1>
	</div>
	
	<div class="headerbar_text Appearingtext-title" style="height: inherit" id="TextSlide_Slide">
		<h1 style="margin-left: 1px; max-width: 100%; height: 40px; margin-top: -15px"><span>The Official Portal of Barangay 76-A Bucana</span>&nbsp; &nbsp;
		<img class="logo" src="images/Flag.jpg" alt="BRGY Logo">
		&nbsp; | &nbsp; <?php echo date("l, M d, Y"); ?> <a id="Timer"></a>  &nbsp; |
		&nbsp;<a href="https://www.facebook.com/brgy76a/" style="text-decoration: none"><i class="fa fa-facebook-square" style="font-size: 20px"></i> &nbsp; Facebook</a> &nbsp; &nbsp; 
		<a href="mailto:losamigosdavaocity.gov@gmail.com" style="text-decoration: none"><i class="fas fa-envelope" style="font-size: 20px"></i>&nbsp; &nbsp;Gmail &nbsp;&nbsp;</a><i class="fas fa-phone"> </i>  &nbsp; Contact Us 
		</h1>
	</div>
	
</div>
<section class="nav_box" id="navBox">
<nav>
	<div class="logo">
		<a href="index.php">
			<img id="Lblack" class="logo" src="images/BucanaLogoB1.png" alt="BRGY Logo" style="width: 150px">
			<img id="Lwhite" class="logo" src="images/BucanaLogoW1.png" alt="BRGY Logo" style="width: 150px; display: none; padding: 10px 0">
		</a>
	</div>
    <input id="menu-toggle" type="checkbox" name="MenuBtn" />
    <label class="menu-button-BoX" for="menu-toggle">
    <div class="menu-button" id="menu-button-black"></div>
	<div class="menu-button-white" id="menu-button-white" style="display: none"></div>
    </label>
    <ul class="menu" id="menu">
      <li onClick="uncheck()"><i class="fa fa-users" id="icon_label2"></i> <a onClick="document.getElementById('modal-official').style.display='block'" style="cursor: pointer">Barangay Officials</a> </li>
      <li><i class="far fa-newspaper" id="icon_label"></i>
				<a href="datasource/News_And_Events.php">News and Events</a>
			</li>
			<li onClick="uncheck()"><i class="fas fa-map-marked-alt" id="icon_label"></i>
				<a onclick="document.getElementById('modal-map').style.display='block'" style="cursor: pointer" > Barangay MAP</a>
			</li>
        	<li><i class="fas fa-cubes" id="icon_label"></i>
				<a href="#services">Services</a>
			</li>
        	<li><i class="fas fa-phone" id="icon_label"></i>
				<a href="#" >Contact</a>
			</li>
			<li><i class="fas fa-scroll" id="icon_label"></i>
				<a href="#about" >About</a>
			</li>
			<li class="divider"></li>
			<li onClick="uncheck()"><i class="fa fa-sign-out-alt" id="icon_label"></i>
				<a href="datasource/LogInServer.php" >Log In</a>
			</li>
    </ul>
	<ul class="menu" id="menuWhite" style="display: none">
      		<li onClick="uncheck()"><i class="fa fa-users" id="icon_label"></i>
				<a onclick="document.getElementById('modal-official').style.display='block'" style="cursor: pointer">Barangay Officials</a>
			</li>
			<li><i class="far fa-newspaper" id="icon_label"></i>
				<a href="datasource/News_And_Events.php">News and Events</a>
			</li>
			<li onClick="uncheck()"><i class="fas fa-map-marked-alt" id="icon_label"></i>
				<a onclick="document.getElementById('modal-map').style.display='block'" style="cursor: pointer" > Barangay MAP</a>
			</li>
        	<li><i class="fas fa-cubes" id="icon_label"></i>
				<a href="#services">Services</a>
			</li>
        	<li><i class="fas fa-phone" id="icon_label"></i>
				<a href="#" >Contact</a>
			</li>
			<li><i class="fas fa-scroll" id="icon_label"></i>
				<a href="#about" >About</a>
			</li>
			<li class="divider"></li>
			<li onClick="uncheck()"><i class="fa fa-sign-out-alt" id="icon_label"></i>
				<a href="datasource/LogInServer.php" >Log In</a>
			</li>
    </ul>
</nav>
</section>

<!------------------------------------------------------------------- MAP ------------------------------------------------------------------------------>
<div id="modal-map" class="modalMap" >
<form class="map-content animate" action="" style="border-radius: 10px" method="post" enctype="multipart/form-data">	
<div class="container_map">
<div class="map-field">
	
	<div class="map-exit" style="font-size: 30px;cursor: pointer" onclick="document.getElementById('modal-map').style.display='none'">&times;</div>
	<h1 style="float: left">Barangay 76-A Bucana MAP</h1>		
	<div class="mapouter">
		<div class="gmap_canvas">
			<iframe width="1048" height="692" id="gmap_canvas" src="https://maps.google.com/maps?q=Barangay%20Bucana&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
		</div>
	</div>
				
</div>
</div>
</form>
</div>
<!------------------------------------------------------------------MAP END ------------------------------------------------------------------------->

<!-----------------------------------------------------------Barangay Officials---------------------------------------------------------------------->
<div id="modal-official" class="modalofficial" >
<form class="official-content animate" action="" style="border-radius: 10px" method="post" enctype="multipart/form-data">	
<div class="container_official">
<div class="official-field">

<div class="official-exit" style="font-size: 30px;cursor: pointer;margin-bottom: 10px" onclick="document.getElementById('modal-official').style.display='none'">&times;</div>



<!------------------------------------ Header Barangay Offical -------------------------------->
<div class="footer" style="display: flex;overflow: auto">
	
<div class="left_logo">
	<img src="images/DILG.png" alt="logo">
</div>
	
<div class="headerword">
  <h1>REPUBLIC OF THE PHILIPPINES</h1>
  <h2>City of Davao</h2>
  <h3>Barangay 76-A Bucana</h3>
  <h2>Barangay Council</h2>
</div>

<div class="right_logo">
	<img src="images/Brgy. Bucana Seal.png" alt="logo">
</div>

</div>
<div class="title"></div>
<!----------------------------- Header Barangay Official Modal --------------------------->
	
<div class="row">
<div class="leftcolumn">
<div class="card" style="background-color: transparen">

<div class="profile_card">
<?php 
$select = "SELECT * FROM `barangay_officials`WHERE `brgy_position` = 'Captain'";
$result = mysqli_query($conn, $select);
while ($cap = mysqli_fetch_array($result)){ 
?> 
	
  <?php echo '<img src="data:image;base64,'.base64_encode($cap['images']).'" style="width:100%">'; ?>
  <h1><?php echo $cap['first_name']; ?> <?php echo $cap['middle_name']; ?> <?php echo $cap['last_name']; ?></h1>
  <p class="profile_title">Barangay Captain / Punong Barangay</p>
  <p>Barangay 76-A Bucana</p>
  <div style="margin: 24px 0;">
    <a href="tel:<?php echo $cap['contact_no']; ?>"><i class="fa fa-mobile-phone"></i></a> 
    <a href="mailto:<?php echo $cap['email_add']; ?>"><i class="fa fa-envelope" style="color: deepskyblue"></i></a>  
    <a href="<?php echo $cap['fb_account']; ?>"><i class="fa fa-facebook-f" style="color: blue"></i></a> 
  </div>
<?php
}
?>	
	
</div>
		
</div>
	  
<div class="card">

	
</div>
</div><!--- LEFT COLUMN END -------->
	
<div class="rightcolumn">
<div class="card">
 
<div class="profile_card2">
<?php 
$select = "SELECT * FROM `barangay_officials`WHERE `brgy_position` = 'Kagawad 1'";
$result = mysqli_query($conn, $select);
while ($kag1 = mysqli_fetch_array($result)){ 
?> 
	
  <?php echo '<img src="data:image;base64,'.base64_encode($kag1['images']).'" style="width:100%">' ?> 
  <h1><?php echo $kag1['first_name']; ?> <?php echo $kag1['middle_name']; ?> <?php echo $kag1['last_name']; ?></h1>
  <p class="profile_title2">KAGAWAD 1</p>
   <div style="margin: 24px 0;">
    <a href="tel:<?php echo $kag1['contact_no']; ?>"><i class="fa fa-mobile-phone"></i></a> 
    <a href="mailto:<?php echo $kag1['email_add']; ?>"><i class="fa fa-envelope" style="color: deepskyblue"></i></a>  
    <a href="<?php echo $kag1['fb_account']; ?>"><i class="fa fa-facebook-f" style="color: blue"></i></a> 
  </div>

<?php
}
?>	
</div>

<div class="profile_card2">
<?php 
$select = "SELECT * FROM `barangay_officials`WHERE `brgy_position` = 'Kagawad 2'";
$result = mysqli_query($conn, $select);
while ($kag2 = mysqli_fetch_array($result)){ 
?> 
	
  <?php echo '<img src="data:image;base64,'.base64_encode($kag2['images']).'" style="width:100%">' ?> 
  <h1><?php echo $kag2['first_name']; ?> <?php echo $kag2['middle_name']; ?> <?php echo $kag2['last_name']; ?></h1>
  <p class="profile_title2">KAGAWAD 2</p>
   <div style="margin: 24px 0;">
    <a href="tel:<?php echo $kag2['contact_no']; ?>"><i class="fa fa-mobile-phone"></i></a> 
    <a href="mailto:<?php echo $kag2['email_add']; ?>"><i class="fa fa-envelope" style="color: deepskyblue"></i></a>  
    <a href="<?php echo $kag2['fb_account']; ?>"><i class="fa fa-facebook-f" style="color: blue"></i></a> 
  </div>

<?php
}
?>	
</div>

<div class="profile_card2">

<?php 
$select = "SELECT * FROM `barangay_officials`WHERE `brgy_position` = 'Kagawad 3'";
$result = mysqli_query($conn, $select);
while ($kag3 = mysqli_fetch_array($result)){ 
?> 
	
  <?php echo '<img src="data:image;base64,'.base64_encode($kag3['images']).'" style="width:100%">' ?> 
  <h1><?php echo $kag3['first_name']; ?> <?php echo $kag3['middle_name']; ?> <?php echo $kag3['last_name']; ?></h1>
  <p class="profile_title2">KAGAWAD 3</p>
   <div style="margin: 24px 0;">
    <a href="tel:<?php echo $kag3['contact_no']; ?>"><i class="fa fa-mobile-phone"></i></a> 
    <a href="mailto:<?php echo $kag3['email_add']; ?>"><i class="fa fa-envelope" style="color: deepskyblue"></i></a>  
    <a href="<?php echo $kag3['fb_account']; ?>"><i class="fa fa-facebook-f" style="color: blue"></i></a> 
  </div>

<?php
}
?>	
</div>

<div class="profile_card2">
<?php 
$select = "SELECT * FROM `barangay_officials`WHERE `brgy_position` = 'Kagawad 4'";
$result = mysqli_query($conn, $select);
while ($kag4 = mysqli_fetch_array($result)){ 
?> 
	
  <?php echo '<img src="data:image;base64,'.base64_encode($kag4['images']).'" style="width:100%">' ?> 
  <h1><?php echo $kag4['first_name']; ?> <?php echo $kag4['middle_name']; ?> <?php echo $kag4['last_name']; ?></h1>
  <p class="profile_title2">KAGAWAD 4</p>
   <div style="margin: 24px 0;">
    <a href="tel:<?php echo $kag4['contact_no']; ?>"><i class="fa fa-mobile-phone"></i></a> 
    <a href="mailto:<?php echo $kag4['email_add']; ?>"><i class="fa fa-envelope" style="color: deepskyblue"></i></a>  
    <a href="<?php echo $kag4['fb_account']; ?>"><i class="fa fa-facebook-f" style="color: blue"></i></a> 
  </div>

<?php
}
?>	
</div>

<div class="profile_card2">
<?php 
$select = "SELECT * FROM `barangay_officials`WHERE `brgy_position` = 'Kagawad 5'";
$result = mysqli_query($conn, $select);
while ($kag5 = mysqli_fetch_array($result)){ 
?> 
	
  <?php echo '<img src="data:image;base64,'.base64_encode($kag5['images']).'" style="width:100%">' ?> 
  <h1><?php echo $kag5['first_name']; ?> <?php echo $kag5['middle_name']; ?> <?php echo $kag5['last_name']; ?></h1>
  <p class="profile_title2">KAGAWAD 5</p>
   <div style="margin: 24px 0;">
    <a href="tel:<?php echo $kag5['contact_no']; ?>"><i class="fa fa-mobile-phone"></i></a> 
    <a href="mailto:<?php echo $kag5['email_add']; ?>"><i class="fa fa-envelope" style="color: deepskyblue"></i></a>  
    <a href="<?php echo $kag5['fb_account']; ?>"><i class="fa fa-facebook-f" style="color: blue"></i></a> 
  </div>

<?php
}
?>	
</div>

<div class="profile_card2">
<?php 
$select = "SELECT * FROM `barangay_officials`WHERE `brgy_position` = 'Kagawad 6'";
$result = mysqli_query($conn, $select);
while ($kag6 = mysqli_fetch_array($result)){ 
?> 
	
  <?php echo '<img src="data:image;base64,'.base64_encode($kag6['images']).'" style="width:100%">' ?> 
  <h1><?php echo $kag6['first_name']; ?> <?php echo $kag6['middle_name']; ?> <?php echo $kag6['last_name']; ?></h1>
  <p class="profile_title2">KAGAWAD 6</p>
   <div style="margin: 24px 0;">
    <a href="tel:<?php echo $kag6['contact_no']; ?>"><i class="fa fa-mobile-phone"></i></a> 
    <a href="mailto:<?php echo $kag6['email_add']; ?>"><i class="fa fa-envelope" style="color: deepskyblue"></i></a>  
    <a href="<?php echo $kag6['fb_account']; ?>"><i class="fa fa-facebook-f" style="color: blue"></i></a> 
  </div>

<?php
}
?>	
</div>

<div class="profile_card2">
<?php 
$select = "SELECT * FROM `barangay_officials`WHERE `brgy_position` = 'Kagawad 7'";
$result = mysqli_query($conn, $select);
while ($kag7 = mysqli_fetch_array($result)){ 
?> 
	
  <?php echo '<img src="data:image;base64,'.base64_encode($kag7['images']).'" style="width:100%">' ?> 
  <h1><?php echo $kag7['first_name']; ?> <?php echo $kag7['middle_name']; ?> <?php echo $kag7['last_name']; ?></h1>
  <p class="profile_title2">KAGAWAD 7</p>
   <div style="margin: 24px 0;">
    <a href="tel:<?php echo $kag7['contact_no']; ?>"><i class="fa fa-mobile-phone"></i></a> 
    <a href="mailto:<?php echo $kag7['email_add']; ?>"><i class="fa fa-envelope" style="color: deepskyblue"></i></a>  
    <a href="<?php echo $kag7['fb_account']; ?>"><i class="fa fa-facebook-f" style="color: blue"></i></a> 
  </div>

<?php
}
?>	
</div>

<div class="profile_card2">
<?php 
$select = "SELECT * FROM `barangay_officials`WHERE `brgy_position` = 'SK Chairperson'";
$result = mysqli_query($conn, $select);
while ($skc = mysqli_fetch_array($result)){ 
?> 
	
  <?php echo '<img src="data:image;base64,'.base64_encode($skc['images']).'" style="width:100%">' ?> 
  <h1><?php echo $skc['first_name']; ?> <?php echo $skc['middle_name']; ?> <?php echo $skc['last_name']; ?></h1>
  <p class="profile_title2">SK Chairman</p>
   <div style="margin: 24px 0;">
    <a href="tel:<?php echo $skc['contact_no']; ?>"><i class="fa fa-mobile-phone"></i></a> 
    <a href="mailto:<?php echo $skc['email_add']; ?>"><i class="fa fa-envelope" style="color: deepskyblue"></i></a>  
    <a href="<?php echo $skc['fb_account']; ?>"><i class="fa fa-facebook-f" style="color: blue"></i></a> 
  </div>

<?php
}
?>	
</div>
		
</div>
	  
	  
<div class="card">
	
<div class="flex-container space-between">
<?php 
$select = "SELECT * FROM `barangay_officials`WHERE `brgy_position` = 'Barangay Secretary'";
$result = mysqli_query($conn, $select);
while ($bsec = mysqli_fetch_array($result)){ 
?> 
  <div class="col cardflex">
    <div class="img-placeholder">
      <?php echo '<img src="data:image;base64,'.base64_encode($bsec['images']).'" style="width:100%">' ?> 
    </div>
    <div class="label_staff">
      <h1 style="font-size: 25px"><?php echo $bsec['first_name']; ?> <?php echo $bsec['middle_name']; ?> <?php echo $bsec['last_name']; ?></h1>
      <p><i></i>Barangay Secretary</p>
	  <br>
      <p><i></i><a href="mailto:<?php echo $bsec['email_add']; ?>" style="font-size: 15px"><?php echo $bsec['email_add']; ?></a></p>
      <p><i></i><a href="tel:<?php echo $bsec['contact_no']; ?>" style="font-size: 15px"><?php echo $bsec['contact_no']; ?></a> </p>
	  <p><i></i><a href="<?php echo $bsec['fb_account']; ?>" style="font-size: 15px"><?php echo $bsec['fb_account']; ?></a></p>
    </div>
  </div>
<?php
}
?>	
</div>
	
<div class="flex-container space-between">
  <?php 
$select = "SELECT * FROM `barangay_officials`WHERE `brgy_position` = 'Barangay Treasurer'";
$result = mysqli_query($conn, $select);
while ($btres = mysqli_fetch_array($result)){ 
?> 
  <div class="col cardflex">
    <div class="img-placeholder">
      <?php echo '<img src="data:image;base64,'.base64_encode($btres['images']).'" style="width:100%">' ?> 
    </div>
    <div class="label_staff">
      <h1 style="font-size: 25px"><?php echo $btres['first_name']; ?> <?php echo $btres['middle_name']; ?> <?php echo $btres['last_name']; ?></h1>
      <p><i></i>Barangay Treasurer</p>
	  <br>
      <p><i></i><a href="mailto:<?php echo $btres['email_add']; ?>" style="font-size: 15px"><?php echo $btres['email_add']; ?></a></p>
      <p><i></i><a href="tel:<?php echo $btres['contact_no']; ?>" style="font-size: 15px"><?php echo $btres['contact_no']; ?></a> </p>
	  <p><i></i><a href="<?php echo $btres['fb_account']; ?>" style="font-size: 15px"><?php echo $btres['fb_account']; ?></a></p>
    </div>
  </div>
<?php
}
?>	
</div>
	
</div>

</div>
	
</div><!---------------- ROW END -------------------->

</div>
</div>
</form>
</div><!------------------------------------------- BRGY. OFFICIALS END PROGRAM ------------------------------------------->

<div class="body-content">
<div class="SlideContainer">
	<div class="slideshow">
		<br/>
   		<br/>
 		<div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">
    	<ol class="carousel-indicators" style="width: auto; margin-left: auto; margin-right: auto;padding: 0 8px 0 8px;">
    	<?php echo make_slide_indicators($conn); ?>
    	</ol>

    	<div class="carousel-inner">
     	<?php echo make_slides($conn); ?>
    	</div>
			
 

   		</div>
	</div>
</div><!----------------------------------------------------- SlideContainer Ends ------------------------------------------------------------->

<!---------------------------------------------------------------- Services --------------------------------------------------------------------->
<div class="services" id="services">
	
<div class="services_title">Our Services</div>

<div class="card_content">
	
<div class="card-container">
<div class="flip-card">
  <div class="flip-card-inner">
    <div class="flip-card-front">
      <img src="images/BID.png" alt="Avatar">
	  <p>Barangay ID</p>
    </div>
	
    <div class="flip-card-back">
	  <a href="Community_Profile.php">
      <h1 class="back-card-h1">Barangay ID</h1>
      <p>Application for Barangay Identification Card </p>
	  </a>
    </div>
  </div>
</div>
</div>	
	
<div class="card-container">
<div class="flip-card">
  <div class="flip-card-inner">
    <div class="flip-card-front">
      <img src="images/Brgy Clearance.png" alt="Avatar">
	  <p>Barangay Clearance</p>
    </div>
	
    <div class="flip-card-back">
      <h1 class="back-card-h1">Barangay Clearance</h1>
		<br>
      <p>A document that contains a person’s name, address, thumb mark, and signature. It also contains the date it was issued and for what specific purpose. It bears the signature of the Barangay Captain and is sealed with the Barangay’s Official Seal.</p>
    </div>
  </div>
</div>
</div>	

<div class="card-container">
<div class="flip-card">
  <div class="flip-card-inner">
    <div class="flip-card-front">
      <img src="images/Residence.png" alt="Avatar">
	  <p>Barangay Residency</p>
    </div>
	
    <div class="flip-card-back">
      <h1 class="back-card-h1">Barangay Certificate of Residency</h1>
		<br>
      <p>Is a local government-issued document of the individual’s place of residence. It is issued by the Barangay Secretary and signed by the Barangay Captain. It is stamped and sealed with the official Barangay Seal. It is to certify a person with a good moral character and a law-abiding citizen of a certain barangay.  In other words, the certificate confirms that the person stated has a good standing as a resident of the barangay.</p>
    </div>
  </div>
</div>
</div>	

<div class="card-container">
<div class="flip-card">
  <div class="flip-card-inner">
    <div class="flip-card-front">
      <img src="images/Cedula.png" alt="Avatar">
	  <p>Cedula</p>
    </div>
	
    <div class="flip-card-back">
      <h1 class="back-card-h1">Cedula</h1>
		<br>
      <p>A legal identity document issued by cities / municipalities and or barangay to all persons that have reached the age of majority and upon payment of a community tax</p>
    </div>
  </div>
</div>
</div>	
	
<div class="card-container">
<div class="flip-card">
  <div class="flip-card-inner">
    <div class="flip-card-front">
      <img src="images/idengent.png" alt="Avatar">
	  <p>Indigency</p>
    </div>
	
    <div class="flip-card-back">
      <h1 class="back-card-h1">Indigency</h1>
		<br>
      <p> Indigents (Individuals/Families) who are bonafide residents of Barangay 76-A Bucana may
request for the issuance of a Certificate of Indigency from the City Government through
the City Social Welfare & Development Office who may wish to avail services from
government organizations and non-government organizations.</p>
    </div>
  </div>
</div>
</div>	

</div> <!------------------------------- Services ENDS ------------------------------------->	
</div>
	
<div class="loginpanel" style=" text-align: center">
<?php 
$select = "SELECT * FROM `barangay_officials`WHERE `brgy_position` = 'Captain'";
$result = mysqli_query($conn, $select);
while ($cap = mysqli_fetch_array($result)){ 
?>
	<div class="welcomebannerbox">
		<h1>WELCOME TO BARANGAY 76-A BUCANA</h1>
		<h3 style="color: whitesmoke">Talomo, Davao City, Davao Del sur. 8000</h3>
		<p style="color: whitesmoke"><?php echo $cap['first_name']; ?> <?php echo $cap['middle_name']; ?> <?php echo $cap['last_name']; ?></p>
	</div>
<?php
}
?>
	<div class="welcome-btn">
	<a href="datasource/LogInServer.php"><span></span>Join Us</a>
	</div>
</div>
	
<div class="news" id="news"><!------------------------------------------ NEWS PROGRAM STARTS ------------------------------------------->
<h1 class="news_letterhead">Latest News & Events</h1>

<div class="row">
<div class="leftcolumn">
<div class="card">
     
<form action="Profiles.php" style="border-radius: 20px" method="post" enctype="multipart/form-data">
<div class="user-details">
<div class="table_responsive">
				
<?php 
$select = "SELECT * FROM `administrators` WHERE `id_No` LIKE '$ID' ";
$result = mysqli_query($conn, $select);
while ($row = mysqli_fetch_array($result)){ 
?>

<div class="container-PERSONAL">
	<div  class="image-case" style="margin-bottom: 10px">
		<label for="photoImg">
	<img  class="center-image" <?php echo '<img src="data:image;base64,'.base64_encode($row['admin_img']).'">'; ?>
		 </label>
	</div>
	<input type="file" id="photoImg" name="photoImg" hidden>

		<div class="content_regMODAL">
			<div class="user-details_regMODAL">
				
				<div class="input-box_regMODAL" onClick="document.getElementById('modal-wrapper-NAME').style.display='block'">
					<span class="details_regMODAL">First Name</span>
					<input type="text" name="fname" value="<?php echo $row['first_name']; ?>"  readonly>
          		</div>
				<div class="input-box_regMODAL">
					<span class="details_regMODAL">Middle Name</span>
					<input type="text" name="mname"  value="<?php echo $row['middle_name']; ?>" readonly>
          		</div>
				<div class="input-box_regMODAL">
					<span class="details_regMODAL">Last Name</span>
					<input type="text" name="lname" value="<?php echo $row['last_name']; ?>" readonly>
          		</div>
				<div class="input-box_regMODAL">
					<span class="details_regMODAL">ID Number</span>
					<input type="text" name="AdminID" value="<?php echo $ID ?>" readonly>
          		</div>
				
			</div>
		</div>
</div>
		
<?php
}
?>
						       
</div>   
</div>
</form>	
		
    </div>
	  
<div class="card">
<form action="Profiles.php" style="border-radius: 20px" method="post" enctype="multipart/form-data">
<div class="user-details">
<div class="table_responsive">
				
<?php 
$select = "SELECT * FROM `administrators` WHERE `id_No` LIKE '$ID' ";
$result = mysqli_query($conn, $select);
while ($row = mysqli_fetch_array($result)){ 
?>

<div class="container-PERSONAL" >
<div class="title" style="margin-bottom:20px">Contact Details</div>
		<div class="content_regMODAL">
			<div class="user-details_regMODAL">
				<div class="input-box_regMODAL">
					<span class="details_regMODAL">Contact Number</span>
					<input type="text" name="phone" value="<?php echo $row['contact_no']; ?>" readonly>
          		</div>
				<div class="input-box_regMODAL">
					<span class="details_regMODAL">Email</span>
					<input type="text" name="email" value="<?php echo $row['email']; ?>" readonly>
          		</div>
			</div>
		</div>
	
</div>			


<?php
}
?>
						       
</div>   
</div>
</form>	
		
</div>
</div><!--- LEFT COLUMN END -------->
	
<div class="rightcolumn">
<div class="card">
  
<div class="user-details">
<div class="table_responsive">
				
<div class="container-PERSONAL">
<div class="content_regMODAL" style="margin-left: auto; margin-right: auto;text-align: center;align-items: ">
<div class="user-details_regMODAL">
<div class="title" style="margin-bottom:30px; text-align: left">TASK MANAGEMENT</div>

<div class="flip-card">
  <div class="flip-card-inner">
    <div class="flip-card-front">
      <img src="../images/CommunityIcon.png" alt="Avatar">
	  <p>Community Profiles</p>
    </div>
	
    <div class="flip-card-back">
      <h1>Community Profile</h1>
		<br>
      <p class="description">Record List of Community Profile</p>
		<a href="Community_Profile.php" style="text-decoration: none"><button class="service_button" >View</button></a>
    </div>
  </div>
</div>

<div class="flip-card">
  <div class="flip-card-inner">
    <div class="flip-card-front">
      <img src="../images/LogIcon.png" alt="Avatar">
	  <p>Log Records</p>
    </div>
    <div class="flip-card-back">
      <h1>Log Records</h1>
      <br>
      <p class="description">Log Records Keeps the loging and out records of all users</p>
    </div>
  </div>
</div>

<div class="flip-card">
  <div class="flip-card-inner">
    <div class="flip-card-front">
      <img src="../images/settings.png" alt="Avatar">
	  <p>Settings</p>
    </div>
	
    <div class="flip-card-back">
      <h1>Settings</h1>
      <br>
      <p class="description">We love that guy</p>
    </div>
  </div>
</div>
			
<div class="flip-card">
  <div class="flip-card-inner">
    <div class="flip-card-front">
      <img src="../images/AddUser.png" alt="Avatar">
	  <p>Authorized USERS</p>
    </div>
	
    <div class="flip-card-back">
		<a href="Authorized_UsersViewer.php" style="text-decoration: none">
			<h1>Authorized Users</h1>
      		<br>
      		<p class="description">Records of all  authorized users</p>
	 	</a>
    </div>
  </div>
</div>
			
<div class="flip-card">
  <div class="flip-card-inner">
    <div class="flip-card-front">
      <img src="../images/Access.png" alt="Avatar">
	  <p>Access Log</p>
    </div>
	
    <div class="flip-card-back">
      <h1>Access Log Record</h1>
      <br>
      <p class="description">This Record Log of all access in details</p>
    </div>
  </div>
</div>
			
			
		</div>
	</div>
</div>			

				
      
</div>   
</div>
	  
		
    </div>
	  
	  
    <div class="card">
      <h3>Recent</h3>
      <div class="fakeimg">Image</div><br>
      <div class="fakeimg">Image</div><br>
      <div class="fakeimg">Image</div>
    </div>
    <div class="card">
      <h3>Coming Soo..</h3>
      <p>Some text..</p>
    </div>
  </div>
	
</div><!---------------- ROW END -------------------->

<div class="footer">
  <h2>Coming soon...</h2>
</div>



</div><!------------------------------------------ NEWS PROGRAM ENDS ------------------------------------------->	

</div><!-------------------------------------------------------------------------- Body-Content -------------------------------------------------------->
	

	
<footer class="footer_images">
   <div class="footer_images_container">
	   <div class="container_footerimg"> 
       <a href="https://op-proper.gov.ph" ><img src="images/President.png" alt="img"></a>
       </div>
	   <div class="container_footerimg"> 
       <a href="http://www.davaocity.gov.ph" ><img src="images/Davao Seal.png" alt="img"></a>
       </div>
	   <div class="container_footerimg"> 
	   <a href="index.html" ><img src="images/Brgy. Bucana Seal.png" alt="img"></a>
       </div>
	   <div class="container_footerimg"> 
       <a href="http://www.philsys.gov.ph" ><img src="images/PSA.png" alt="img"></a> 
       </div>
	   <div class="container_footerimg"> 
       <a href="https://dilg.gov.ph" ><img src="images/DILG.png" alt="img"></a>
       </div>
	   <div class="container_footerimg"> 
	   <a href="http://www.deped.gov.ph"><img src="images/DepEd.png" alt="img" style="margin-top: 10%"></a> 
       </div>
	   <div class="container_footerimg" > 
       <a href="#"><img src="images/DvoLifePNG.png" alt="img" style="margin-top: 30%" > </a>
       </div>
   </div>
</footer>


<footer class="footer_contacts">
	<div class="footer_details_container">
			<div class="footer-details">
				<h1>VISIT US</h1>
				<br>
				<p><a href="https://goo.gl/maps/cd73J3QjDcTpkfxJ9">Barangay 76-A Bucana, Talomo, Davao City, Davao Del Sur. 8000 
				</a></p>
        	</div>
			<br>
			<div class="footer-details">
				<h1>CONTACTS</h1><br>
        		<p><i class="fas fa-phone"> </i>  &nbsp; Tel No.: (082) 299-0796 </p>
				<p><a href="mailto:losamigosdavaocity.gov@gmail.com"><i class="fas fa-envelope"></i>&nbsp; &nbsp;Gmail</a> </p>
				<p><a href="https://www.facebook.com/brgy76a/"><i class="fab fa-facebook-f"></i>&nbsp;  &nbsp; Facebook</a></p>
        	</div>
		<br>
			<div class="footer-details">
				<h1>GOVERNMENT LINKS </h1><br>
				<p><a href="https://op-proper.gov.ph" >Republic of the Philippines</a></p>
				<p><a href="https://dilg.gov.ph" >DILG</a></p>
				<p><a href="http://www.davaocity.gov.ph" >Davao LGU </a></p>
				<p><a href="http://www.deped.gov.ph" >DepEd </a></p>
				<p><a href="http://www.philsys.gov.ph" >PSA </a></p>
        	</div>
	</div>
</footer>

<footer id="footer" style="bottom: 0;position: relative">
    <p style="text-align: center;padding-top: 25px">Copyrights &#169; 2023 | Barangay 76-A Bucana | All Rights Reserved.</p>
</footer>
	
<!----------------------------------------------------JAVASCRIPT------------------------------------------------------------>
<script>
	   function uncheck() {
  document.getElementById("menu-toggle").checked = false;
}
</script>
<script src="js/Timer.js"></script>
<script src="js/navar_effect.js"></script>
</body>
</html>
