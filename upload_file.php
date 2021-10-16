<html>
    <head>
        <title> Upload File</title>
        <meta http-equiv="Content-Type" content="=text/html; charset=iso-8859-1">
    </head>
    <body>
        <?php
            require "php-clamav-scan/Clamav.php";
            $clamav = new Clamav(array('clamd_sock' => '/var/run/clamav/clamd.ctl', 'clamd_ip' => '0.0.0.0'));
            if(isset($_POST['upload'])){
                $fileName = $_FILES['userfile']['name'];
                $tmpName = $_FILES['userfile'] ['tmp_name'];
                $fileSize = $_FILES['userfile']['size'];
                $fileType = $_FILES['userfile']['type'];

                $filePath = "/var/www/html/files/";
                $result = move_uploaded_file($tmpName, $filePath.$fileName);
                if (!$result) 
                    die("Error uploading file $tmpName to $fileName");
                // get_magic_quotes_gpc() deprecated at php 7.4 and removed at php 8.0
                if(!get_magic_quotes_gpc()){
                    $fileName = addslashes($fileName);
                    $filePath = addslashes($filePath);
                }
                if(!$clamav->scan($filePath.$fileName)){
                    unlink($filePath.$fileName);
                    die("File bervirus");
                }
                echo "<br>File $fileName uploaded<br>";
            }
        ?>
        <form action="" method="post" enctype="multipart/form-data" name="uploadform">
            <table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
                <tr>
                    <td width="246">
                        <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                        <input name="userfile" type="file" class="box" id="userfile">
                    </td>
                    <td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>