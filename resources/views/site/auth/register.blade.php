<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <label for="">email</label>
        <input type="email" name="email"><br>
        <label for="">name</label>
        <input type="text" name="name"><br>
        <label for="">phone</label>
        <input type="text" name="phone"><br>
        <label for="">address</label>
        <input type="text" name="address"><br>
        <label for="">password</label>
        <input type="password" name="password"><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>