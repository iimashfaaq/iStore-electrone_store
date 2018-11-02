<html>
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


$cvv = $_POST['cvv'];

$sql2 = "SELECT cvv FROM bank_details WHERE customer_id = (SELECT max(customer_id) from registration)";
$result = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result) > 0)
{
    // output data of each row
    while($row = mysqli_fetch_assoc($result))
    {
        $con_cvv = $row["cvv"];
    }
}

if($con_cvv == $cvv)
{
    echo "The payment was successful !<br><br>";

    $sql1 = "SELECT product_name, price, total_price FROM purchase WHERE purchase_id in (SELECT purchase_id FROM connect
        WHERE customer_id = (SELECT max(customer_id) FROM registration))";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0)
    {
        // output data of each row
        while($row = mysqli_fetch_assoc($result1))
        {
            echo "Item Name   : " . $row["product_name"] . "<br>";
            echo "Price       : $" . $row["price"] . "<br>";
            echo "Total Price : $" . $row["total_price"] . "<br>";
            echo "<br>";
        }
    }

    $sql3 = "SELECT total_amount FROM bill where customer_id = (select max(customer_id) from registration)";
    $result2 = mysqli_query($conn, $sql3);
    if (mysqli_num_rows($result2) > 0)
    {
        // output data of each row
        while($row = mysqli_fetch_assoc($result2))
        {
            echo "TOTAL BILL AMOUNT   : $" . $row["total_amount"] . "<br>";

        }
    }

    $sql4 = "SELECT first_name,last_name FROM registration where customer_id = (select max(customer_id) from registration)";
    $result3 = mysqli_query($conn, $sql4);
    if (mysqli_num_rows($result3) > 0)
    {
        // output data of each row
        while($row = mysqli_fetch_assoc($result3))
        {
            echo "AMOUNT PAID BY   : " . $row["first_name"] . " ". $row["last_name"];
        }
    }
}
else
{
    echo "The payment was not successful !";
}
header( "refresh:7;url=http://localhost:8888/iStore-electrone_store/index.html" );
?>
</html>
