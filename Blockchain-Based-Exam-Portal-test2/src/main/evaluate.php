<?php
    $pid=base64_decode($_GET["pid"]);
    $type=$_GET["type"];
    $ctime=date("Y-m-d H:i:s");
    $servername="localhost";
    $username="root";
    $password="";
    $mydb="exam_portal";
    $conn=new mysqli($servername, $username, $password, $mydb);
    $sql="SELECT * FROM paper_details WHERE paper_id='$pid';";
    $result=mysqli_query($conn, $sql);
    if($result->num_rows==1) {
        while($row=$result->fetch_assoc()) {
            $tid=$row["teacher_id"];
            $ename=$row["name"];
        }
    }
    if($type=='initiate') {
        $sql="SELECT end FROM paper_details WHERE paper_id='$pid';";
        $result=mysqli_query($conn, $sql);
        if($result->num_rows==1) {
            while($row=$result->fetch_assoc()) {
                if(date($row["end"])>$ctime) {
                    echo "<br><table class='w3-table w3-striped'>";
                    echo "<thead>";
                    echo "<tr style='background-color: #0F2653; color: #FFFFFF;'>";
                    echo "<th class='w3-center' style='padding: 12px;'>***Exam Not Yet Finished***</th>";
                    echo "</tr></thead></table><br>";
                }
                else {
                    $sql1="SELECT * FROM answer_details WHERE paper_id='$pid' ORDER BY submit_time ASC;";
                    if($result1=mysqli_query($conn, $sql1)) {
                        if($result1->num_rows!=0) {
                            echo "<p id='title'>Students</p>";
                            echo "<table id='table' class='w3-table w3-striped students'>";
                            echo "<thead>";
                            echo "<tr style='background-color: #0F2653; color: #FFFFFF;'>";
                            echo "<th class='w3-center' style='padding: 12px;'>S.No.</th>";
                            echo "<th class='w3-center' style='padding: 12px;'>Reg. No.</th>";
                            echo "<th class='w3-center' style='padding: 12px;'>Name</th>";
                            echo "<th class='w3-center' style='padding: 12px;'>Submit Time</th>";
                            echo "<th class='w3-center' style='padding: 12px;'>View</th>";
                            echo "</tr></thead>";
                            echo "<tbody>";
                            while($row1=mysqli_fetch_array($result1)) {
                                echo "<tr class='w3-light-grey w3-border w3-border-white'>";
                                echo "<td class='w3-center'> </td>";
                                echo "<td class='w3-center'> {$row1[0]}</td>";
                                $sql2="SELECT name FROM student_details WHERE id='$row1[0]';";
                                if($result2=mysqli_query($conn, $sql2)) {
                                    while($row2=mysqli_fetch_array($result2)) {
                                        echo "<td class='w3-center'> ".strtoupper($row2[0])."</td>";
                                    }
                                }
                                echo "<td class='w3-center'> ".date("d-m-Y g:iA", strtotime($row1[2]))."</td>";
                                echo "<td class='w3-center'>
                                <form action='evaluate.php' method='get'>
                                    <input type='hidden' value='".base64_encode($row1[0])."' name='sid'>
                                    <input type='hidden' value='".base64_encode($pid)."' name='pid'>
                                    <input type='hidden' value='".sha1('final')."' name='type'>";
                                echo " <button id='btn' type='submit'>View</button></form></td>";
                            }
                            echo "</tr></tbody></table>";
                        }
                        else {
                            echo "<br><table class='w3-table w3-striped'>";
                            echo "<thead>";
                            echo "<tr style='background-color: #0F2653; color: #FFFFFF;'>";
                            echo "<th class='w3-center' style='padding: 12px;'>***No One Has Submitted Yet***</th>";
                            echo "</tr></thead></table><br>";
                        }
                    }
                }
            }
        }
    }
    elseif($type==sha1('final')) {
        $sid=$_GET["sid"];
?>
<!DOCTYPE html>
<html>
    <title>Exam-Portal</title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link type="text/css" rel="stylesheet" href="faculty_home.css">
    <script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js@1.0.0-beta.36/dist/web3.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
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
    /* border: 3px solid #0F2653; */
    /* border-radius: 25px; */
    margin-top: 3%;
    margin-bottom: 5%;
    background: #0C121C;
    box-sizing: border-box;
    box-shadow: 0 15px 25px rgba(0,0,0,.6);
    border-radius: 10px;
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
            <button id="logout" style="background-color: darkred;" onclick="history.go(-1);">Exit</a>
        </div>
        <p id="welcome" style="font-size: 35px;"><?php echo $ename; ?></p>
        <div id="line"></div>
        <br><p id="title" style="font-size: 25px; font-weight: normal;"><b>Registration No.:</b> <?php echo base64_decode($sid); ?></p>
        <div id="question">
        </div>
    </body>
</html>
<script>
    var sid = '<?php echo $sid; ?>';
    var pid = '<?php echo base64_encode($pid); ?>';
    answer();
    review(0);
    // style();
</script>
<?php
    }
    mysqli_close($conn);
?>
