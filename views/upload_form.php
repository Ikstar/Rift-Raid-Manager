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
</head>
<body>
        <?php $this->load->view('header'); ?>
    <div id="container">
        <div id="left">
<?php echo $menu; ?>
</div>
        <div id="right">
        <?php if ($error):?>
        <div class="ui-state-error">
<?php echo $error;?>
        </div>
        <?php endif;?>
    <h2>Upload Guild Roster Dump</h2>
<?php echo form_open_multipart('upload/do_upload');?>


<input type="file" name="userfile" size="20" class="ui-widget-content"/>
<input id="submit" type="submit" value="Upload" />

</form>
        </div>
                <div id="spacer"></div>
<div id="footer">
    <p><br />Page rendered in {elapsed_time} seconds</p>
<?php $this->load->view('footer'); ?>
</body>
</html>