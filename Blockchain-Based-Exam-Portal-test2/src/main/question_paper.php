<?php
    $servername="localhost";
    $username="root";
    $password="";
    $mydb="exam_portal";
    $conn=new mysqli($servername, $username, $password, $mydb);
    $id=$_POST["id"];
    $pid=$_POST["pid"];
    $time=$_POST["time"];
    $sql="SELECT * FROM paper_details WHERE paper_id='$pid';";
    $result=mysqli_query($conn, $sql);
    if($result->num_rows==1) {
        while($row=$result->fetch_assoc()) {
            $tid=$row["teacher_id"];
            $name=$row["name"];
            $start=date($row["start"]);
            $end=date($row["end"]);
        }
    }
    $duration=strtotime("1970-01-01 ".$time." UTC");
    $date=date("Y-m-d H:i:s");
    $sql="SELECT * FROM student_details WHERE name='$id';";
    $result=mysqli_query($conn, $sql);
    if($result->num_rows==1) {
        while($row=$result->fetch_assoc()) {
            $sname=$row["name"];
            $phone=$row["phone"];
            $email=$row["email"];
            $siid=$row["id"];
        }
    }
    /*if($start>$date) {
        echo '<script>alert("You do not have exam right now.");
        window.location.href="login.html";</script>';
    }
    elseif($date>(date("Y-m-d H:i:s", date_timestamp_get(date_create($end))-$duration+60)) && $end>$date) {
        echo '<script>alert("Can not join exam.\nYou are late.");
        window.location.href="login.html";</script>';
    }
    elseif($end<$date) {
        echo '<script>alert("The exam is over.");
        window.location.href="login.html";</script>';
    }
    else {*/
?>
<!DOCTYPE html>
<html>
    <title>Exam-Portal</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link type="text/css" rel="stylesheet" href="exam.css">
    <script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js@1.0.0-beta.36/dist/web3.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="functions.js"></script>
    <style> 
    body {
        background: linear-gradient(#141e30, #243b55);
        font-family: "Segoe UI",Arial,sans-serif;
    }
    #header {
    background-color: #0F2653;
    width: 100%;
    position: fixed;
    overflow: hidden;
    height: 8%;
    left: 0%;
    top: 0%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.445), 0 6px 20px 0 rgba(0, 0, 0, 0.445);
}
#exam_name {
    color: #FFFFFF;
    padding-left: 1%;
    font-size: 20px;
    text-align: left;
    position: relative;
    top: -5%;
}
#timer {
    color: #FFFFFF;
    padding-left: 1%;
    font-size: 20px;
    text-align: right;
    position: relative;
    top: -60%;
    /* top: 10px; */
    right: 1%;
}
#time {
    width: 2.3%;
    position: absolute;
    top: 10%;
    left: 88.5%;
}
#gen_inst {
    position: absolute;
    top: 15%;
    width: 40%;
    height: 35%;
    /* border: 2px solid #0F2653; */
    background: rgba(0,0,0,.5);
    /* border-radius: 25px; */
    /* margin-left: -5%; */
    right: 50%;
    color: #0F2653;
    box-sizing: border-box;
    box-shadow: 0 15px 25px rgba(0,0,0,.6);
    border-radius: 10px;
}
#info {
    position: absolute;
    top: 15%;
    width: 40%;
    height: 35%;
    color: #0F2653;
    right: 7%;
    margin-left: 41.5%;
    background: rgba(0,0,0,.5);
    color: #0F2653;
    box-sizing: border-box;
    box-shadow: 0 15px 25px rgba(0,0,0,.6);
    border-radius: 10px;
}
#switch {
    position: absolute;
    top: 60%;
    left: 7%;
    padding: 10px;
    margin-left: 10px;
    width: 86.5%;
    display: flex;
    align-items: stretch;
    justify-content: space-between;
    background: rgba(0,0,0,.5);
    box-sizing: border-box;
    box-shadow: 0 15px 25px rgba(0,0,0,.6);
    border-radius: 10px;
}
#question {
    position: relative;
    width: 111.4%;
    /* border: 2px solid #0F2653; */
    background: rgba(0,0,0,.5);
    color: #fff;
    /* border-radius: 25px; */
    margin-left: -6.3%;
    margin-top: 80%;
    margin-bottom: 5%;
    box-sizing: border-box;
    box-shadow: 0 15px 25px rgba(0,0,0,.6);
    border-radius: 10px;
}
#title {
    color: #fff;
    font-family: "Segoe UI",Arial,sans-serif;
    text-align: center;
    font-size: 30px;
    position: relative;
    margin-top: 10px;
    /* font-weight: bold; */
}
#content {
    color: #fff;
    /* font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; */
    text-align: justify;
    font-size: 20px;
    position: relative;
    left: 10px;
    margin-top: -15px;
}
#q_no {
    /* font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; */
    font-size: 15px;
    text-align: center;
    display: block;
    /* flex: 0 1 auto; */
    /* list-style-type: none; */
    width: 100px;
    height: 45px;
    /* background: #03e9f4; */
    /* box-sizing: border-box; */
    /* box-shadow: 0 15px 25px rgba(0,0,0,.6); */
    /* box-sizing: border-box; */
    box-shadow: 0 15px 25px rgba(0,0,0,.6);
    border-radius: 5px;
}
#q_no:hover {
    transition: all .3s ease;
    /* transform: scale(1.1); */
    background-color: #00CCFF;
    color: #FFFFFF;
    cursor: pointer;
}
#question_content {
    /* font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; */
    text-align: justify;
    font-size: 30px;
    position: relative;
    left: 20px;
    margin-top: -15px;
    margin-bottom: 20px;
}
input.radio {
    width: 40px;
    height: 20px;
    border-radius: 0;
}
#submit {
    font-family: "Segoe UI",Arial,sans-serif;
    /* font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; */
    font-size: 18px;
    text-align: center;
    width: 100px;
    height: 50px;
    position: relative;
    left: 45.5%;
    margin-bottom: 2%;
    /* border-color: #0F2653; */
    background-color: #03E9F4;
    /* box-sizing: border-box; */
    box-shadow: 0 15px 25px rgba(0,0,0,.6);
    border-radius: 5px;
}
#submit:hover {
    /* transform: scale(1.1); */
    transition: all .3s ease;
    background-color: #8280E0;
    color: #FFFFFF;
    border-color: #000000;
    cursor: pointer;
}
a {
    position: relative;
    display: inline-block;
    left: 65%;
    top: -200px;
    padding: 10px 20px;
    color: #03e9f4;
    font-size: 16px;
    text-decoration: none;
    text-transform: uppercase;
    overflow: hidden;
    transition: .5s;
    margin-top: 40px;
    letter-spacing: 4px;
}
a:hover {
    background: #03e9f4;
    color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 5px #03e9f4,
                0 0 25px #03e9f4,
                0 0 50px #03e9f4,
                0 0 100px #03e9f4;
  }
  a span {
    position: absolute;
    display: block;
  }
  
  a span:nth-child(1) {
    top: 0;
    left: -100%;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, #03e9f4);
    animation: btn-anim1 1s linear infinite;
  }
  
  @keyframes btn-anim1 {
    0% {
      left: -100%;
    }
    50%,100% {
      left: 100%;
    }
  }
  
a span:nth-child(2) {
    top: -100%;
    right: 0;
    width: 2px;
    height: 100%;
    background: linear-gradient(180deg, transparent, #03e9f4);
    animation: btn-anim2 1s linear infinite;
    animation-delay: .25s
  }
  
  @keyframes btn-anim2 {
    0% {
      top: -100%;
    }
    50%,100% {
      top: 100%;
    }
  }
  
a span:nth-child(3) {
    bottom: 0;
    right: -100%;
    width: 100%;
    height: 2px;
    background: linear-gradient(270deg, transparent, #03e9f4);
    animation: btn-anim3 1s linear infinite;
    animation-delay: .5s
  }
  
  @keyframes btn-anim3 {
    0% {
      right: -100%;
    }
    50%,100% {
      right: 100%;
    }
  }
  
a span:nth-child(4) {
    bottom: -100%;
    left: 0;
    width: 2px;
    height: 100%;
    background: linear-gradient(360deg, transparent, #03e9f4);
    animation: btn-anim4 1s linear infinite;
    animation-delay: .75s
  }
  
  @keyframes btn-anim4 {
    0% {
      bottom: -100%;
    }
    50%,100% {
      bottom: 100%;
    }
  }
  
input[type=radio]:hover {
    cursor: pointer;
}
#label:hover {
    cursor: pointer;
}
</style>

    <body class="w3-content">
        <div id="header" class="w3-top">
            <p id="exam_name"><b><?php echo $name; ?></b></p>
            <p id="timer"><?php echo $time; ?></p>
            <img src="images/timer.png" id="time">
        </div>
        <div id="gen_inst">
            <p id="title">General Instructions</p>
            <div id="content">
                <p><b>1.</b> Visited & unanswered question appear red.</p>
                <p><b>2.</b> Answered questions will appear green.</p>
                <p><b>3.</b> Click 'Submit' button to save the answer.</p>
                <p><b>4.</b> To finish exam go to last question.</p>
                <p><b>5.</b> The exam will submit itself when time ends.</p>
            </div>
        </div>
        <div id="info">
            <p id="title">Student Details</p>
            <div id="content">
                <p><b>Student Name:</b> <?php echo strtoupper($sname); ?></p>
                <p><b>Registration No.:</b> <?php echo strtoupper($siid); ?></p>
                <p><b>Phone No.:</b> <?php echo "+91-".$phone; ?></p>
                <p><b>Email:</b> <?php echo $email; ?></p>
            </div>
        </div>
        <div id="switch">
            <button id="q_no" name="0" onclick="change('0')"><b>Q.1</b></button>
            <button id="q_no" name="1" onclick="change('1')"><b>Q.2</b></button>
            <button id="q_no" name="2" onclick="change('2')"><b>Q.3</b></button>
            <button id="q_no" name="3" onclick="change('3')"><b>Q.4</b></button>
            <button id="q_no" name="4" onclick="change('4')"><b>Q.5</b></button>
            <button id="q_no" name="5" onclick="change('5')"><b>Q.6</b></button>
            <button id="q_no" name="6" onclick="change('6')"><b>Q.7</b></button>
            <button id="q_no" name="7" onclick="change('7')"><b>Q.8</b></button>
            <button id="q_no" name="8" onclick="change('8')"><b>Q.9</b></button>
            <button id="q_no" name="9" onclick="change('9')"><b>Q.10</b></button>
        </div>
        <div id="question">
        </div>
        
    </body>
    <script>
        var pid = "<?php echo $pid; ?>";
        var id = "<?php echo $id; ?>";
        change(count);
        counter();
    </script>
</html>
<?php
    /*}*/
    mysqli_close($conn);
?>
