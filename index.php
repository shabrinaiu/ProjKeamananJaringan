<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server test</title>
</head>
<body>
    <form action="validate.php" method="post">
        <h1>Login App</h1>
        <input type="text" placeholder="Username" name="username"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <input type="text" name="c" placeholder="OTP"><br>
        <?php
        require_once('PHPOTP/code/rfc6238.php');
        print sprintf('<img src="%s"/>',TokenAuth6238::getBarCodeUrl('admin','admin','GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ','ServerTest'));
        ?>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>