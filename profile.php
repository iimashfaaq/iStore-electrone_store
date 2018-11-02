<html>
<head>
<meta charset="utf-8">
<title>iStore - The Apple Store</title>
<link rel="icon" href="images/favicon.png" type="image/png" sizes="16x16">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="iLand Multipurpose Landing Page Template">
<meta name="keywords" content="iLand HTML Template, iLand Landing Page, Landing Page Template">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
<link href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,500,600,700" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/animate.css">
<!-- Resource style -->
<link rel="stylesheet" href="css/owl.carousel.css">
<link rel="stylesheet" href="css/owl.theme.css">
<link rel="stylesheet" href="css/ionicons.min.css">
<!-- Resource style -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<div class="wrapper">
  <div class="container">
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          <a class="navbar-brand page-scroll" href="index_al.html"><img src="images/apple-logo.png" width="40" height="40" alt="iStore" /></a> </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a class="page-scroll" href="mac.html">Mac</a></li>
            <li><a class="page-scroll" href="iphone.html">iPhone</a></li>
            <li><a class="page-scroll" href="ipad.html">iPad</a></li>
            <li><a class="page-scroll" href="watch.html">Watch</a></li>
            <li><a class="page-scroll" href="#contact">Contact</a></li>
            <li><a class="page-scroll" href="register.html"><img src="images/profile_icon.png" height="20px" width="20px"></a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- /.navbar-collapse -->
  </div>
  <h2 style="margin-top: 100px;margin-left:50px;">Your Profile</h2>
  <hr>

<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Project";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
/*echo "Connection successful !";

echo "<b>Your Profile<b>";*/

$sql = "SELECT first_name, last_name, email_id, phone_number, city, customer_id FROM registration WHERE customer_id = (SELECT max(customer_id) from registration)";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)
{
    // output data of each row
    while($row = mysqli_fetch_assoc($result))
    {
        echo "<br>User ID : " . $row["customer_id"];
        echo "<br>Name : " . $row["first_name"] . " " . $row["last_name"];
        echo "<br>Email ID : " . $row["email_id"];
        echo "<br>Phone Number : " . $row["phone_number"];
        echo "<br>City : " . $row["city"];
    }
}
else {
    echo "0 results";
}

mysqli_close($conn);

?>
</div>
</body>
</html>
