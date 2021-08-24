<html>
<?php include 'db.php';
session_start();
if(isset($_POST['high']))
{
    $name=htmlspecialchars($_POST['uname']);
    $pass=htmlspecialchars($_POST['pass']);
$sql="select * from teachers where teachid='$name' and password='$pass';";
if($total = $db->query($sql))
{
$total1=mysqli_num_rows($total);
if($total1==1)
{
    header('location: mark1.php');
     $_SESSION['uname']=$name;
}
else
{
    echo  '<h2 class="text-danger text-center">No Record Found</h2><br>';
}
}
else
{
    echo  '<h2 class="text-danger text-center">Error Server Busy</h2><br>';
}
}
?>
<head>
    <title>
        Attendance: Mark
    </title>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <style>
        .container {
            padding-top: 20px;
        }

        .imageholder {
            padding-top: 10px;
        }

        .in {
            border-color: darkslategray;
            border-radius: 3px;
            color: black;
            font-size: 14px;
            font-family: "Corbel";
            padding-right: 25px;
        }

        .in1 {
            margin-top: 5px;
        }

        .in2 {
            background-color:dodgerblue;
            font-family: "Corbel";
            color: black;
        }

        .in2:hover {
            background-color:darkblue;
        }
        .uw
        {
           font-family:'Corbel',sans-serif;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center uw">e-SIWES FACE ATTENDANCE</h2>
        <div class="imageholder">
            <center><img src="image\user.png" width="150px"></center>
        </div>
        <form method="post">
            <br>
            <center> <input type="text" placeholder="Username" class="in" maxlength="14" name="uname" required></center>
            <center><input type="password" placeholder="Password" class="in in1" maxlength="12" name="pass" required></center>
            <center><input type="submit" name="high" value="Login" class="btn btn-primary in1 in2"></center>
        </form>
    </div>
</body>

</html>