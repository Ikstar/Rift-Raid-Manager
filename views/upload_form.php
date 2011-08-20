<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('upload/do_upload');?>
    <table>
        <tr>
            <th>File</th>
            <th>Dump Type</th>
            <th>Group </th>s
            </tr>
<select name="UploadType">
    <option value="0">&mdash;Select One&mdash;<option>
    <option value="1">Guild Dump</option>
    <option value="2">Raid Dump</option>
</select>
<select name="Group">
    <option value="??">&mdash;Select One&mdash;</option>
</select>
<input type="file" name="userfile" size="20" />
</table>


<input type="submit" value="upload" />

</form>

</body>
</html>