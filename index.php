<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table tr td{
            border:1px solid red;
            padding: 10px;
        }
    </style>
</head>
<body>
<?php


function loadRegistrations($filename)
{
    $jsondata = file_get_contents($filename);
    $arr_data = json_decode($jsondata, true);
    return $arr_data;
}
?>

<h1>Registration Form</h1>
<form method="post" action="index.php">
    <fieldset style="width: 500px;height: 200px">
        <legend>Details</legend>
        <label>Name:</label>
        <input style="margin-left: 9px" type="text" name="name"><br>
        <label>Email:</label>
        <input type="text" name="email"><br>
        <label>Phone:</label>
        <input type="number" name="phone"><br>
        <button type="submit">Register</button>
    </fieldset>
</form>
<?php
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $name=$_REQUEST['name'];
    $email=$_REQUEST['email'];
    $phone=$_REQUEST['phone'];
    $data=[
        "name"=>$name,
        "email"=>$email,
        "phone"=>$phone
    ];
    $getData=file_get_contents('data.json');
    $register=json_decode($getData,true);
    $register[]=$data;
    file_put_contents('data.json',json_encode($register,true));

}
?>
<?php
$registrations = loadRegistrations('data.json');
?>
<table>
    <?php foreach ($registrations as $value): ?>
        <tr>
            <td><?= $value['name'];?></td>
            <td><?=$value['email'];?></td>
            <td><?=$value['phone'];?></td>
        </tr>
    <?php
    endforeach;
    ?>
</table>
</body>
</html>