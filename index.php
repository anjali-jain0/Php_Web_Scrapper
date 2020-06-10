<?php

	include "simple_html_dom.php";
	
	$ch = curl_init();

	curl_setopt($ch,CURLOPT_URL,'https://stackoverflow.com/tags');
	curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch,CURLOPT_MAXREDIRS,5 );
	curl_setopt($ch, CURLOPT_HEADER, 0);

	$result = curl_exec($ch);
	curl_close($ch);
	$html = new simple_html_dom();
	$html->load($result);

	$tags= array();
	$lang=array();

	foreach($html->find('a[class="post-tag"]') as $link)
		array_push($lang,$link->plaintext);

	foreach($html->find('div[class="mt-auto grid jc-space-between fs-caption fc-black-300"]') as $link)
		array_push($tags,$link->plaintext);

	$number=5;
	if($_SERVER['REQUEST_METHOD']=="POST"  && isset($_POST['chngno5'])){
		global $number; 
		$number=5;
	}
	if($_SERVER['REQUEST_METHOD']=="POST"  && isset($_POST['chngno15'])){
		global $number; 
		$number=15;
	}
	if($_SERVER['REQUEST_METHOD']=="POST"  && isset($_POST['chngno10'])){
		global $number; 
		$number=10;
	}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
.btn1{
	position:absolute;
	top:10px;
	right:10px;
	font-size:17px;
	font-weight:bold;
}
.btn3{
	position:absolute;
	top:10px;
	right:190px;
	font-size:17px;
	font-weight:bold;
}
.btn2{
	position:absolute;
	top:10px;
	right:100px;
	font-size:17px;
	font-weight:bold;
}
.card-style{
	position:absolute;
	top:90px;
	left:150px;
	right:40px;
	height:250px;
	width:1000px;
}

</style>
</head>
<body>
<h5 style='margin-top:15px'><a href='./page_2.php'>Scrap Top Asked Queries</a></h5>
<form action='index.php' method='POST'>
	<input type="submit" class='btn btn-default btn1' name='chngno5' value='Show 5' class='btn btn-success' />
</form>
<form action='index.php' method='POST'>
	<input type="submit" name='chngno10' class='btn btn-default btn2' value='Show 10' class='btn btn-warning' />
</form>
<form action='index.php' method='POST'>
	<input type="submit" class='btn btn-default btn3' name='chngno15' value='Show 15' class='btn btn-success' />
</form>
<br>

<div class='card-style''>
<div class="card-columns">
  <?php for($i=0;$i<$number;$i++){ ?>
  <div class="card">
  	<div class="card-body text-center">
  	<p class="card-text">
	  	<div>
	    <p><?php echo $lang[$i]; ?></p>
	    <p><?php echo $tags[$i]; ?></p>
	    </div>
  	</p>
    </div>
  </div>
  <?php } ?>	
</div>
</div>

</body>
</html>
