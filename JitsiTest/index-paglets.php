<?php
	//$WEB_ROOT = getenv("DOCUMENT_ROOT");
	//$APP_PATH = 'example_code/simple-get/';
	if(isset($_GET['pagelet'])){
	$pagelet = $_GET['pagelet'];
	}
	# index.php
	if (!isset($pagelet))  {
	   $pagelet = "index";
	   }

	// Include the page header.
	include("includes/Header.inc.php");	
	

	// Begin page content
	include ("pagelets/$pagelet.inc.php");

	// End page content
	include ("includes/Footer.inc.php");  //  Include the footer
?>