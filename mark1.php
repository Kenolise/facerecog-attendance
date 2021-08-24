<html>
<?php 
include 'db.php';
session_start();  
if(!$_SESSION['uname'])  
{  
	header("Location: login1.php");//redirect to login page to secure the welcome page without login access.  
} 
if(!isset($_SESSION['timeout']))
{
	$_SESSION['timeout'] = time();
}
else if (time() - $_SESSION['timeout'] > 30000000000000000000)
{
	session_destroy();
	die("Session Expired!!! Please login again to continue");
	header("Location: login1.php");
}
$uid=$_SESSION['uname'];
$q2="Select * from teachers where teachid='$uid'";
$rows1=$db->query($q2);
if ($_POST){
	$namereg=$_POST['reg'];
	$rr=shell_exec("python AttendanceSystem.py $namereg");
}
$q1="Select * from markme;";
$rows=$db->query($q1);
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
	.uw {
		font-family: 'Corbel', sans-serif;
		padding-top: 40px;
	}   
</style>
</head>

<body>
	<div class="container">
		<h2 class="text-center uw">e-SIWES FACE ATTENDANCE</h2>
		<div class="row">

			<a href="http://localhost/esiwesreg/" class="btn btn-info pull-right">Register</a>
			<table class="table table-hover uw">
				<?php while($rowq=$rows1->fetch_assoc()):?>
					<tr>
						<th>Student Name</th>
						<td><?php echo $rowq['teachername'] ?></td>
					</tr>
					<tr>
						<th>Program</th>
						<td><?php echo $rowq['section'] ?></td>
					</tr>
				<?php endwhile; ?>
			</table>
			<form action="mark1.php" method="post">
				<table class="table table-hover uw">
					<tr>
						<td colspan="2"><input type="text" placeholder="Enter Matric Number (IN CAPITAL LETTERS!)" name="reg" class="form-control">
						</td>

					</tr>
					<tr>

						<td><input type="Submit" value="Mark" name="camera" class="btn btn-success"></td>
						<td><input type="button" name="camera" value="Cancel" class="btn btn-danger"></td>
					</tr>
					<h6>IN CAPITAL LETTERS!</h6>
				</table>
			</form>

			<hr>
			<h2 class="text-center uw">STUDENT DETAILS</h2>
			<table class="table table-stripped uw">
				<tr>
					<th>Sno</th>
					<th>Matric no.</th>
					<th>Location</th>
					<th>Timestamp</th>
				</tr>
				<?php 
				$no = 1;
				while($row=$rows->fetch_assoc()):?>
					<tr>
						<th>
							<?php echo $no++; ?>
						</th>
						<td>
							<?php echo $row['reg']?>
						</td>
						<td class="demo"></td>
						<td>
							<?php echo $row['attime']?>
						</td>
					</tr>
				<?php endwhile; ?>
			</table>
		</div>
	</div>


	<script type="text/javascript"> 
		var x = document.getElementsByClassName("demo");

		function getLocation() {
			if (navigator.geolocation) {
				var bdcApi = "https://api.bigdatacloud.net/data/reverse-geocode-client"
				navigator.geolocation.getCurrentPosition((position) => {
					bdcApi = bdcApi
					+ "?latitude=" + position.coords.latit
					+ "&longitude=" + position.coords.longitude
					+ "&localityLanguage=en";
					getApi(bdcApi);

				}, (err) => { getApi(bdcApi); }, {enableHighAccuracy: true, timeout: 5000, maximumAge: 0});
			} else {
				console.log("Geolocation is not supported by this browser.");
			}
		}

		function getApi(bdcApi) {
			fetch(bdcApi)
				.then(res => res.json())
				.then(result => {
					for(var i = 0; i < x.length; i++) {
						x[i].innerHTML = ` ${result.locality} , ${result.principalSubdivision} . ${result.countryName}  `
					}
				});
		}
		getLocation();
	</script>
</body>
</html>