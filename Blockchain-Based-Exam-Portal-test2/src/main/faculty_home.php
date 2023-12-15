<?php
    $servername="localhost";
    $username="root";
    $password="";
    $mydb="exam_portal";
    $conn=new mysqli($servername, $username, $password, $mydb);
    $id=$_POST["ide"];
    
    $sql="SELECT * FROM faculty_details WHERE name='$id';";
    $result=mysqli_query($conn, $sql);
    if($result->num_rows==1) {
        while($row=$result->fetch_assoc()) {
            $ide=$row["id"];
            $name=$row["name"];
            $phone=$row["phone"];
            $email=$row["email"];
        }
    }

    
    
?>
<!DOCTYPE html>
<html>
    <title>Exam-Portal</title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<!-- <link type="text/css" rel="stylesheet" href="faculty_home.css"> -->
	<script src="functions.js"></script>
    <style>
        html {
    font-family: "Segoe UI",Arial,sans-serif;
    background: linear-gradient(#141e30, #243b55);
}

body {
    counter-reset: Count-Value;
    
    
}
#header {
    background-color: #0F2653;
    width: 100%;
    position: fixed;
    overflow: hidden;
    height: 55px;
    left: 0%;
    top: 0%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.445), 0 6px 20px 0 rgba(0, 0, 0, 0.445);
}
#head_title1 {
    color: #FFFFFF;
    padding-left: 1%;
    font-size: 35px;
    text-align: left;
    margin-top: 0.2%;
}
#head_title2 {
    color: #FFFFFF;
    padding-left: 1%;
    font-size: 20px;
    text-align: left;
    position: absolute;
    top: -1%;
    left: 19.5%;
}
#logout {
    color: #FFFFFF;
    font-size: 20px;
    font-weight: bold;
    text-align: right;
    margin-top: -1%;
    margin-right: 1%;
    position: absolute;
    top: 40%;
    right: 0.5%;
}
#logout:hover {
    cursor: pointer;
    transform: scale(1.2);
}
a:link {
    text-decoration: none;
}
a:visited {
    text-decoration: none;
}
a:hover {
    text-decoration: none;
}
a:active {
    text-decoration: none;
}
#welcome {
    font-size: 45px;
    text-align: center;
    margin-top: 7.5%;
    font-weight: bold;
    color: #fff;
}
#line {
    border: 1.5px solid #fff;
    margin-top: -3%;
    border-radius: 1.5px;
}
#details {
    margin-left: auto;
    margin-right: auto;
    margin-bottom: auto;
    margin-top: 2.8%;
    width: 50%;
    color: white;
    padding: 10px;
    background: rgba(0,0,0,.5);
    box-sizing: border-box;
    box-shadow: 0 15px 25px rgba(0,0,0,.6);
    border-radius: 10px;
}
#title {
    font-size: 33px;
    text-align: center;
    margin-top: -1%;
    font-weight: bold;
    color: #fff;
}
#data {
    color: #fff;
    margin-top: 5%;
    margin-left: 5%;
}
#exams {
    color: #0F2653;
    margin-bottom: 3%;
    text-align: center;
}
#table {
    border: 1px solid #FFFFFF;
    background: #0C121C;
    margin-bottom: 3%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.445), 0 6px 20px 0 rgba(0, 0, 0, 0.445);
    font-size: 14px;

}
td {
    background: #0C121C;
    color: #fff;
}
tr {
    background: #094154;
}
#btn {
    background-color: #696868;
    color: #FFF;
    text-align: center;
    font-weight: bold;
    font-size: 15px;
    padding: 6px;
    border: 1px solid #fff;
    /* border: 5px; */
    border-radius: 5px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.445), 0 6px 20px 0 rgba(0, 0, 0, 0.445);
}
#btn:hover {
    transition: all .3s ease;
    background-color: #3d3d3d;
    cursor: pointer;
}
.paper td:first-child:before {
    counter-increment: Count-Value;   
    content: counter(Count-Value);
}
#students {
    counter-reset: Count-Value;
}
.students td:first-child:before {
    counter-increment: Count-Value;   
    content: counter(Count-Value);
}
#questions {
    margin-bottom: 40px;
}
#question {
    color: #0F2653;
    border: 3px solid #0F2653;
    border-radius: 25px;
    margin-top: 3%;
    margin-bottom: 5%;
    box-shadow: 0 15px 15px 0 rgba(0, 0, 0, 0.445), 0 6px 20px 0 rgba(0, 0, 0, 0.445);
}
#question_content {
    text-align: justify;
    font-size: 17px;
    margin-left: 50px;
    margin-right: 50px;
    margin-bottom: 25px;
    margin-top: -10px;
}
.option {
    margin-bottom: 10px;
}

    </style>
	<body class="w3-content">
        <div id="header" class="w3-top">
            <p id="head_title1"><b>Exam-Portal</b></p>
            <p id="head_title2">Secure Examination System</p>
            <a href="login.html" id="logout">Logout</a>
        </div>
        <p id="welcome">Welcome</p>
        <div id="line"></div>
        <div id="details">
            <p id="title">Details</p>
            <div id="line" style="margin-top: -7%; margin-left: 7.5%; width: 85%;"></div>
            <div id="data">
                <p><b>ID:</b> <?php echo $ide; ?></p>
                <p><b>Name:</b> <?php echo strtoupper($name); ?></p>
                <p><b>Phone No.:</b> <?php echo "+91-".$phone; ?></p>
                <p><b>Email:</b> <?php echo $email; ?></p>
            </div>
        </div>
        <div id="line" style="margin-top: 3%;"></div>
        <p id="title" style="margin-top: 1%; margin-bottom: 1%;">Exam Details</p>
        <div id="exams">
            <?php
                $sql="SELECT * FROM paper_details WHERE teacher_id='$id' ORDER BY timestamp ASC;";
                if($result=mysqli_query($conn, $sql)) {
                    if($result->num_rows!=0) {
                        echo "<table id='table' class='w3-table w3-striped paper'>";
                        echo "<thead>";
                        echo "<tr style='background-color: #0F2653; color: #FFFFFF;'>";
                        echo "<th class='w3-center' style='padding: 12px;'>S.No.</th>";
                        echo "<th class='w3-center' style='padding: 12px;'>Name</th>";
                        echo "<th class='w3-center' style='padding: 12px;'>Access Code</th>";
                        echo "<th class='w3-center' style='padding: 12px;'>Start</th>";
                        echo "<th class='w3-center' style='padding: 12px;'>End</th>";  
                        echo "<th class='w3-center' style='padding: 12px;'>Duration</th>";
                        echo "<th class='w3-center' style='padding: 12px;'>Evaluate</th>";
                        echo "</tr></thead>";
                        echo "<tbody>";
                        while($row=mysqli_fetch_array($result)) {
                            echo "<tr class='w3-light-grey w3-border w3-border-white'>";
                            echo "<td class='w3-center'></td>";
                            echo "<td class='w3-center'> {$row[2]}</td>";
                            echo "<td class='w3-center'> ".hyphen($row[3])."</td>";
                            echo "<td class='w3-center'> ".date("d-m-Y g:iA", strtotime($row[4]))."</td>";
                            echo "<td class='w3-center'> ".date("d-m-Y g:iA", strtotime($row[5]))."</td>";
                            echo "<td class='w3-center'> ".date("G:i:s", strtotime($row[6]))."</td>"; ?>
                            <td class='w3-center'> <button id='btn' onclick='getStudents("<?php echo base64_encode($row[1]); ?>")'>Evaluate</button></td>
                        <?php 
                        }
                        echo "</tr></tbody></table>";
                    }
                    else {
                        echo "<table class='w3-table w3-striped'>";
                        echo "<thead>";
                        echo "<tr style='background-color: #0F2653; color: #FFFFFF;'>";
                        echo "<th class='w3-center' style='padding: 12px;'>***No Exam Created***</th>";
                        echo "</tr></thead></table><br>";
                    }
                }
            ?>
            <button id="btn" onclick="document.getElementById('create').style.display='block'" style="font-size: 20px; font-weight: bold; padding: 10px;">Create</button>
        </div>
        <div class="w3-container">
			<div id="create" class="w3-modal">
				<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
					<div class="w3-center"><br>
						<span onclick="document.getElementById('create').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
					</div>
					<form class="w3-container" action="create_exam.php" method="post">
						<div class="w3-section">
                            <input type="hidden" value="<?php echo $id; ?>" name="id">
                            <label style="color: #0F2653;"><b>Exam Name</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter exam name" name="name" required>
							<label style="color: #0F2653;"><b>Exam Date</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="date" name="date" required>
							<label style="color: #0F2653;"><b>Start Time</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="time" name="start" required>
							<label style="color: #0F2653;"><b>End Time</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="time" name="end" required>
                            <label style="color: #0F2653;"><b>Exam Duration </b></label>
                            <input class=" w3-input w3-border w3-margin-bottom" style="width: 60px; display: inline-block;" type="number" name="hour" min="0" required> <b>:</b> <input class="w3-input w3-border w3-margin-bottom" style="width: 60px; display: inline-block;" type="number" name="min" min="0" max="59" required>
							<button class="w3-button w3-block w3-section w3-padding" style="color: #FFFFFF; background-color: #0F2653;" type="submit"><b>Create Exam</b></button>
						</div>
					</form>
				</div>
			</div>
		</div>
        <div class="w3-container">
			<div id="evaluate" class="w3-modal">
                <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
					<div class="w3-center"><br>
						<span onclick="document.getElementById('evaluate').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                    </div>
                    <div class="w3-container">
                        <div id="students" class="w3-section">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    var modal1 = document.getElementById('create');
    var modal2 = document.getElementById('evaluate');
    window.onclick = function(event) {
        if (event.target == modal1) {
            modal1.style.display = "none";
        }
        if (event.target == modal2) {
            modal2.style.display = "none";
        }
    }
</script>
<?php
    function hyphen($str) {
        $main="";
        $j=0;
        for($i=0;$i<4;$i+=1) {
            $n=0;
            while($n!=4) {
                $main.=$str[$j];
                $j+=1;
                $n+=1;
            }
            if($i!=3) {
                $main.="-";
            }
        }
        return $main;
    }
    mysqli_close($conn);
?>
