<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Project";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connection successful !";

    $name = $_GET['name'];
    $quantity = $_GET['quantity'];

    $price = "SELECT product_price from product where product_name = '$name'";
    $result = mysqli_query($conn, $price);
    if (mysqli_num_rows($result) > 0)
    {
        // output data of each row
        while($row = mysqli_fetch_assoc($result))
        {
            $res_price = $row["product_price"];
        }
    }

    $total = $quantity * $res_price;

    $sql = "INSERT INTO purchase (product_name,quantity,price,total_price)
    values ('$name',$quantity,$res_price,$total)";

    if (mysqli_query($conn, $sql)) {
    //echo "New record (Purchase) created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

    $sql2 = "SELECT customer_id from registration where customer_id = (select max(customer_id) from registration)";
    $result1 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($result1) > 0)
    {
        // output data of each row
        while($row = mysqli_fetch_assoc($result1))
        {
            $res1 = $row["customer_id"];
        }
    }

    $sql3 = "SELECT purchase_id from purchase where purchase_id = (select max(purchase_id) from purchase)";
    $result2 = mysqli_query($conn, $sql3);
    if (mysqli_num_rows($result2) > 0)
    {
        // output data of each row
        while($row = mysqli_fetch_assoc($result2))
        {
            $res2 = $row["purchase_id"];
        }
    }

    $sql4 = "INSERT INTO connect (customer_id,purchase_id) VALUES
    ('$res1','$res2')";

    if (mysqli_query($conn, $sql4)) {
    //echo "New record (Connect) created successfully";
    } else {
        echo "Error: " . $sql4 . "<br>" . mysqli_error($conn);
    }

    $sql5 = "SELECT total_amount from bill where customer_id = '$res1'";
    $result5 = mysqli_query($conn, $sql5);
    if (mysqli_num_rows($result5) > 0)
    {
        // output data of each row
        while($row = mysqli_fetch_assoc($result5))
        {
            $final_ans = $row["total_amount"];
        }
    }

    $new_total = $final_ans + $total;

    $sql6 = "UPDATE bill SET total_amount = $new_total where customer_id = '$res1'";

    if (mysqli_query($conn, $sql6)) {
    //echo "Record(Bill) updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

    mysqli_close($conn);
?>
<html>
<head>
    <title>iStore - Bill</title>
    <meta charset="utf-8">
    <title>iStore - Sign Up</title>
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

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        background-color: white;
    }

    * {
        box-sizing: border-box;
    }

    /* Add padding to containers */
    .container {
        padding: 16px;
        background-color: white;
    }

    /* Full-width input fields */
    input[type=text], input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    input[type=text]:focus, input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Overwrite default styles of hr */
    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }

    /* Set a style for the submit button */
    .registerbtn {
        background-color: #4CAF50;
        color: white;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }

    .registerbtn:hover {
        opacity: 1;
    }

    /* Add a blue text color to links */
    a {
        color: dodgerblue;
    }

    /* Set a grey background color and center the text of the "sign in" section */
    .signin {
        background-color: #f1f1f1;
        text-align: center;
    }
    </style>

</head>
<body>
    <a href="http://localhost:8888/iStore-electrone_store/index_al.html"><button class="btn btn-primary btn-action btn-fill" value="go_back">To continue shopping</button></a>
    <a href="http://localhost:8888/iStore-electrone_store/pay_now.php"><button class="btn btn-primary btn-action btn-fill" value="pay_now">Pay Now</button></a>

</body>
</html>
