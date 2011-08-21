<html>
<head>
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
           
       		$( "#name" ).autocomplete({
			source: "character/AutoComplete",
			minLength: 2,
			select: function( event, ui ) {
				log( ui.item ?
					"Selected: " + ui.item.value + " aka " + ui.item.id :
					"Nothing selected, input was " + this.value );
			}
		});
                $('input').button();
	});
        
    
    </script>
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
    <div id="spacer"></div>
<div id="footer">
<?php $this->load->view('footer'); ?>
</div>

</body>
</html>
