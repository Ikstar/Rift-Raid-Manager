<html>
<head>
<title>Upload Form</title>
</head>
<body>

<h3>Your file was successfully uploaded!</h3>

<ul>
<?php foreach ($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul>
<?php foreach($xml as $XMLitem => $XMLsubItem) :?>
<li>Item </li>
<?php if ($XMLitem == "Members")
    foreach($XMLsubItem as $Member => $Values) 
{   echo "<br/>"; 
    echo $Values->Name ." &mdash; ". $Values->Calling." &mdash; ".$Values->Level;
}
?>
  

<br/><br/>

<?php endforeach; ?>

<p><?php echo anchor('upload', 'Upload Another File!'); ?></p>

</body>
</html>