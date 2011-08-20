<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo "/css/main.css"; ?> ">
</head>
<body>

<?php $this->load->view('header'); ?>
    <div id ="container">
<div id="left">
<?php echo $menu ?>
</div>
        <div id="right">
<?php echo form_open('main/characteradd'); ?>
<?php echo $name; ?>: 
<?php echo form_input('name'); ?>
</br>
<?php echo $class; ?>: 
<?php echo form_dropdown('class',$classes); ?>
</br>
<?php echo form_submit('charadd','Add Character');  ?>
<?php echo form_close(); ?>
        </div>
    </div>
<div id="footer">
<?php $this->load->view('footer'); ?>
</div>

</body>
</html>
