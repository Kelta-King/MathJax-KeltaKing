<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/latest.js?config=TeX-MML-AM_CHTML"></script>
</head>
<body>
When a \( \ne \) 0, there are two solutions to \(ax^2 + bx + c = 0\) and they are
$$x = {-b \pm \sqrt{b^2-4ac} \over 2a}.$$
<?php

$servername = "localhost";
$password_db = "";
$username = "root";
$database = "test";

$conn = new mysqli($servername, $username, $password_db, $database);

if($conn->connect_error){
	die("something went wrong:$conn->connect_error");
}

$query = "SELECT * FROM math_data";
$data = $conn->query($query);

while($result = $data->fetch_assoc()){

    echo $result['math'];
?>
<br><br><br>
<?php

}

$conn->close();

?>
</body>
</html>