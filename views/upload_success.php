<!DOCTYPE html>
<html lang="en">
<html><head>
<link rel="stylesheet" type="text/css" href="<?php echo "/css/main.css"; ?> ">
<link rel="stylesheet" type="text/css" href="/css/humanity/jquery-ui-1.8.15.custom.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui-1.8.15.custom.min.js"></script>
 <script type="text/javascript">
      function log( message ) {
			$( "<div/>" ).text( message ).prependTo( "#log" );
			$( "#log" ).scrollTop( 0 );
		}
        $(document).ready(function(){
           
       		$('#submit').button();
	});
    
    </script>
 <title>Upload Success</title>
</head>
<body>

<h3>Your file was successfully uploaded!</h3>

<ul>
<?php foreach ($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul>
<div class="ui-state-highlight">Updated <?php echo $count ?> records</div>
<h2>Member Added/Updated</h2>
<?php foreach($xml as $XMLitem => $XMLsubItem) :?>
<?php if ($XMLitem == "Members")
    foreach($XMLsubItem as $Member => $Values) 
{  
    echo "<li>".$Values->Name ." &mdash; ". $Values->Calling." &mdash; ".$Values->Level."</li>";
}
?>
<?php endforeach; ?>
</body>
</html>