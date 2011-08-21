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
</head>

<body>
    <?php $this->load->view('header'); ?>
    <div id="container">
        <div id="left">
<?php echo $menu; ?>
</div>
        <div id="right">
        <?php if ($error > " ")    
         echo "<div class=\"ui-state-error\">".$error."</div>"; ?>
            <h2>Upload New Raid</h2>
        <?php echo form_open_multipart('raiddump/do_upload'); ?>
        <table style="background:none; width:30%;" >
            <tr>
                <th>Group </th>
                <th>File</th> 
                <th>&nbsp;</th>
            </tr>
            <tr>
                <td>
                    <select name="idGroups">
                        <option value="0">&mdash;Select One&mdash;</option>
                        <?php foreach($Groups as $Group ) :?>
                        <option value="<?php echo $Group->idgroups; ?>"><?php echo $Group->name;?></option>
                        <?php endforeach;?>
                    </select>
                </td>
                <td>
                    <input type="file" name="userfile" size="20" class="ui-widget-content"/>
                </td>
                <td>
                    <input id="submit" type="submit" value="Upload" />
                </td>
                    
            </tr> 
        </table>


        

    </form>
        </div>
        <div id="spacer"></div>
<div id="footer">
    <p><br />Page rendered in {elapsed_time} seconds</p>
<?php $this->load->view('footer'); ?>
</div>
</body>
</html>