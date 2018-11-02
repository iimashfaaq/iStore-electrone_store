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
echo "Connection successful !";

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mobno = $_POST['phone'];
$email = $_POST['email_id'];
$address = $_POST['addr'];
$psw = $_POST['psword'];

//echo $fname;

$sql = "INSERT INTO registration (first_name, last_name, email_id, pass_word, phone_number, city)
VALUES ('$fname', '$lname', '$email', '$psw', '$mobno', '$address')";

if(mysqli_query($conn, $sql)) {
    //echo "Insertion into Registration completed !!";
} else {
    echo "Error: " . $sql . mysqli_error($conn);
}

$sql2 = "SELECT customer_id FROM registration WHERE email_id='$email' limit 1";
$result = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result) > 0)
{
    // output data of each row
    while($row = mysqli_fetch_assoc($result))
    {
        $help = $row["customer_id"];
    }
}

$c_type = $_POST['c_type'];
$acc = $_POST['acc_no'];
$cvv = $_POST['cvv'];
$vdate = $_POST['v_date'];

$sql3 = "INSERT INTO bank_details (customer_id,card_type,account_num,cvv,valid_date)
VALUES ('$help','$c_type','$acc','$cvv','$vdate')";

if(mysqli_query($conn, $sql3)) {
    //echo "Insertion into Bank Details completed !!";
} else {
    echo "Error: " . $sql3 . mysqli_error($conn);
}

$arr1 = "SELECT customer_id from registration where customer_id = (select max(customer_id) from registration)";
$brr1 = mysqli_query($conn, $arr1);
if (mysqli_num_rows($brr1) > 0)
{
    // output data of each row
    while($row = mysqli_fetch_assoc($brr1))
    {
        $answer = $row["customer_id"];
    }
}

$arr2 = "INSERT INTO bill (customer_id,total_amount) VALUES
('$answer',0.00)";
if(mysqli_query($conn, $arr2)) {
    //echo "Insertion into Bill completed !!";
} else {
    echo "Error: " . $arr2 . mysqli_error($conn);
}

mysqli_close($conn);

header('location: http://localhost:8888/iStore-electrone_store/index_al.html');
?>
</html>
