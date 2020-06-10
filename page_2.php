<?php

	include "simple_html_dom.php";
	
	$ch = curl_init();

	curl_setopt($ch,CURLOPT_URL,'https://stackoverflow.com/questions?sort=votes&pagesize=50');
	curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch,CURLOPT_MAXREDIRS,5 );
	curl_setopt($ch, CURLOPT_HEADER, 0);

	$result = curl_exec($ch);
	curl_close($ch);
	$html = new simple_html_dom();
	$html->load($result);

	$ques= array();
	$summary=array();
	$votes=array();
	$ans=array();
	$views=array();

	// foreach($html->find('a[class="post-tag"]') as $link)
	// 	array_push($a,$link->plaintext);

	foreach($html->find('a[class="question-hyperlink"]') as $link)
		array_push($ques,$link->plaintext);

	foreach($html->find('div[class="excerpt"]') as $link)
		array_push($summary,$link->plaintext);

	foreach($html->find('span[class="vote-count-post high-scored-post"]') as $link)
		array_push($votes,$link->plaintext);

	foreach($html->find('div[class="status answered-accepted"]') as $link)
		array_push($ans,$link->plaintext);

	foreach($html->find('div[class="views supernova"]') as $link)
		array_push($views,$link->plaintext);

	// for($i=0;$i<=20;$i++)
	// 	echo $a[$i] . '</br>';
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
</head>
<body>
<h5 style='margin-top:15px'><a href='index.php'>Scrap Top Asked Topics</a></h5>
<div class="container">
  <table class='table table-dark table-bordered table-hover' style="width:100%;margin-top:30px">
  <thead class="thead-light">
  <tr>
    <th>Question</th>
    <th>Summary</th>
    <th>Votes</th>
    <th>Answers</th>
    <th>Views</th>
  </tr>
</thead>
<tbody>
  <?php for($i=0;$i<=5;$i++){ ?>
  	<tr>
    <td><?php echo $ques[$i]; ?></td>
    <td><?php echo $summary[$i]; ?></td>
    <td><?php echo $votes[$i]; ?></td>
    <td><?php echo $ans[$i]; ?></td>
    <td><?php echo $views[$i]; ?></td>
    </tr>
 <?php } ?>
</tbody>
</table>
</body>
</html>
