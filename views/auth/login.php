<!DOCTYPE html>
<html lang="en">
<html><head>
<link rel="stylesheet" type="text/css" href="<?php echo "/css/main.css"; ?> ">
<link rel="stylesheet" type="text/css" href="/css/humanity/jquery-ui-1.8.15.custom.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui-1.8.15.custom.min.js"></script>
 <script type="text/javascript">
      
		
        $(document).ready(function(){
           
       		$('input:submit').button();
	});
    
    </script>
</head>
<body>
    <?php $this->load->view('header'); ?>
    <div id="container">
        <div id="left">
<?php echo $menu; ?>
</div>
        <div id="right">
<div class='mainInfo'>

    <h2>Login</h2>
    <div class="pageTitleBorder"></div>
	<p>Please login with your email address and password below.</p>
	
	<div id="infoMessage"><?php echo $message;?></div>
	
    <?php echo form_open("auth/login");?>
    	
      <p>
      	<label for="username">Username:</label>
      	<?php echo form_input($username);?>
      </p>
      
      <p>
      	<label for="password">Password:</label>
      	<?php echo form_input($password);?>
      </p>
      
      <p>
	      <label for="remember">Remember Me:</label>
	      <?php echo form_checkbox('remember', '1', FALSE);?>
	  </p>
      
      
      <p><?php echo form_submit('submit', 'Login');?></p>

      
    <?php echo form_close();?>

</div>
    </div>
    <div id="spacer"></div>
    <div id="footer">
    <p><br />Page rendered in {elapsed_time} seconds</p>
<?php $this->load->view('footer'); ?>
    </div>
</body>
</html>