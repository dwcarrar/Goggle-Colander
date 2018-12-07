 <?php
   session_start();
    if (!$_SESSION['loggedin']) {
 	header("LOCATION:home.php");
 	return;
    }
   date_default_timezone_set('America/Detroit');
   
        include 'addEvent.php'; 
	if (isset ($_SESSION['username'])) {
	    $uname = htmlentities($_SESSION['username']);
	}

        if (isset($_GET['submitDate'])) {
            $date = htmlentities($_GET['date']);
        }
	if (isset($_POST['dispEvent'])) {
	    $eventId = htmlentities($_POST['eventId']);
            $eventName = htmlentities($_POST['eventName']);
            $eventDesc = htmlentities($_POST['eventDesc']);
            $eventStart = htmlentities($_POST['eventStart']);
            $eventEnd = htmlentities($_POST['eventEnd']);
            $eventDate = htmlentities($_POST['eventDate']);
	}
        if (isset($_POST['changeEvent'])) {
            $eventId = htmlentities($_POST['eventId']);
            $eventName = htmlentities($_POST['eventName']);
            $eventDesc = htmlentities($_POST['eventDesc']);
            $eventStart = htmlentities($_POST['eventStart']);
            $eventEnd = htmlentities($_POST['eventEnd']);
                $eventEnd .= ":00";
	    $eventDate = htmlentities($_POST['eventDate']);

	    $event = new Event();
	    $event->updateEvent($eventId,$eventName,$eventDesc,$eventStart,$eventEnd,$eventDate);
	    
            header("LOCATION:conlander.php");
        }
	if (isset($_POST['deleteEvent'])) {
	    $eventId = htmlentities($_POST['eventId']);
	    $event = new Event();
	    $event->deleteEvent($eventId);
	    
            header("LOCATION:conlander.php");
	}
        if (isset($_POST['submit']) && isset($_POST['name'])) {
                $name = htmlentities($_POST['name']);
                $desc = htmlentities($_POST['description']);
                $start = htmlentities($_POST['startTime']).":00";
                if ($_POST['endTime'] != "") {
		    $end = htmlentities($_POST['endTime']).":00";
		} else {
		    $end = null;
		}
                $event = new Event();
                $created = $event->AddEvent($uname, $name,$desc,$date,$start,$end);
		
                header("LOCATION:conlander.php");

        }

 
    if (isset($_GET['ym'])){
        $ym = $_GET['ym'];
    } else {
        $ym = date('Y-m');
    }

    $timestamp = strtotime($ym,"-01");
    if ($timestamp == false) {
        $timestamp = time();
    }

    $today = date('Y-m-d', time());
    
    $html_title = date('Y / m', $timestamp);

    $prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
    $next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));

    $day_count = date('t', $timestamp);
    
    $str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));

    $weeks = array();
    $week = '';

    $week .= str_repeat('<td></td>', $str);

    if (substr($today,-2,-2) == 0) {
	$today = substr($today,0,-2).substr($today,-1);
    }

    for ($day = 1; $day <= $day_count; $day++, $str++) {
        $date = $ym.'-'.$day;


        if ($today == $date) {
            $week .= '<td class="today">';

        }
        else {
            $week .= '<td>';
        }

	$week .= '<form style="height:18px;" method="get" action="#modalCreate">';
        $week .= '<input type="hidden" name="date" value="'.$date.'">
                      <input class="dateEvents" type="submit" name="submitDate" value="'.$day.'"></form>';
	$event = new Event();
	$dayEvents = $event->getDayEvents($uname,$date);
	
	if ($dayEvents) {
	    while ($row = mysql_fetch_array($dayEvents)) {
	        $week .= '<div class="inBoxEvent"><form action="#modalEdit" method="post">
				<input type="hidden" name="eventId" value="'.$row[0].'">
                                <input type="hidden" name="eventName" value="'.$row[1].'">
                                <input type="hidden" name="eventDesc" value="'.$row[2].'">
                                <input type="hidden" name="eventStart" value="'.$row[3].'">
                                <input type="hidden" name="eventEnd" value="'.$row[4].'">
				<input type="hidden" name="eventDate" value="'.$row[5].'">
				<input class="eventName" type="submit" name="dispEvent" value="'.$row[1].':">
				<p>&nbsp&nbsp&nbsp&nbsp'.$event->convertTime($row[3])."-".$event->convertTime($row[4]).'</p></form></div>';
	    }
	}
        $week .= '</td>'; 

        if ($str % 7 == 6 || $day == $day_count) {
            
            if ($day == $day_count) {
                $week .= str_repeat('<td></td>',6 - ($str % 7));
            }

            $weeks[] = '<tr>'.$week.'</tr>';

            $week = '';
        }
    }    
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-font-family: 'Amatic SC', cursive;8">
    <title>Goggle Colandar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="ano     nymous">
    <link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">            
    <style>
	body {
	    background-color: powderblue;
	}
        .container {
            font-family: 'Amatic SC', cursive;
            margin-top: 80px;
        }
        th {
	    background: rgb(220,220,220);
            height: 30px;
	    width: 140px;
            text-align: center;
            font-weight: 500;
        }
        td {
	    background: rgb(240,240,245);
            height: 125px;
            width: 140px;
        }
        .today {
            background: rgb(225,255,230);
        }
        th:nth-of-type(7),td:nth-of-type(7){
            color: red;
        }
        th:nth-of-type(1),td:nth-of-type(1){
            color: red;
        }
        .dateEvents {
            position:relative;
            top: -10px;
            left: -10px;
            width: 35px;
            height: 35px;
            text-align:center;
            border:none;
            background: rgba(255,255,255,0);
            opacity= .5;
	    margin-bottom:0px;
        }
        .dateEvents:hover {
            cursor:pointer;
            font-weight: bold;
        }
	.eventName {
            position:relative;
            top: -8px;
	    left: -10px;
            height: 35px;
            text-align:center;
            border:none;
            background: rgba(255,255,255,0);
            opacity= .5;
            margin-bottom:0px;
	}
	.eventName:hover {
            cursor:pointer;
            font-weight: bold;
        }
        .inBoxEvent {
	    margin-top:0px;
	    font-size:8pt;
	    height:30px;
	}
	.inBoxEvent p {
	    position: relative;
	    top: -20px;
	    margin-top: 0px;
	}
        .modal_container {
            width:100%;
            height:100%;
            position:fixed;
            top:0px;
            background:rgba(0,130,180,.8);
            opacity:0;
            pointer-events: none;
            transition: all 500ms ease;
        }
        .modal_container:target{
            opacity:1;
            pointer-events: auto;
        }
       
        .modal{
            display: block;
            width:350px;
            height: 500px;
            margin:auto;
            position: absolute;
            top:0px; bottom:0px;
            right:0px; left:0px;
            background: powderblue;
            border:2px solid #222;
            padding:20px;
            box-shadow: 0px 0px 30px 5px black;
        }

        .btnSubmit{
            background: rgb(70,185,170);
            margin-top:10px;
            border-radius:5px;
            transition: background 100ms;
        }
        .btnSubmit:hover{
            background: rgb(65,245,220);
        }
	.deleteBtn {
	    position: relative;
	    cursor: pointer;
	    top: 10px;
	    float: right;
	    border-radius: 5px;
	    background: red;
	    color: white;
            transition: background 100ms;
	}
	.deleteBtn:hover {
	    background:white;
	    color:red;
	}
        .modal_heading{
            text-align:center;
            font-family: "Arial Black";
            font-size:20pt;
        }
        .close{
            color:white;
            position: absolute;
            border: 2px solid #333;
            padding:7px 9px 11px 9px;
            font-family: big john;
            background:red;
            opacity:1;
            text-decoration: none;
            top:0px;
            right:0px;
	    margin: 3px 3px 0px 0px;
            border-radius: 5px;
            transition: background 100ms; 
        }
        .close:hover{
            background: rgb(155,25,25);
	    color: white;
            cursor:pointer;
        }
	.modal_container p {
	    margin: 5px 0px 0px 0px;
	    font-family: "Arial";
	    font-size: 12pt;
	}
	.logoutBtn {
	    border-style: outset;
	    float: right;
	    background: rgb(198,198,198);
	    text-decoration: none;
	    color: black;
	    border-radius: 7px;
	    padding: 3px;
	}
	.logoutBtn: hover {
	    font-weight: bold;
	    text-decoration: none;
	    color: black;
	    background: rgb(150,150,150);
	}
    </style>
</head>

<body>
    <div class="container">
	<a href="logout.php" class="logoutBtn" >Log Out</a>
        <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
        <br>
        <table class="table table-bordered">
            <tr>
                <th>Sunday</t>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
            </tr>
            <?php
              foreach($weeks as $week) {
                echo $week;
              }  
            ?>           
        </table>
    </div>
    <div class="modal_container" id="modalCreate">
        <div class="modal">
            <a href="#" class="close">X</a>
            <span class="modal_heading">
                CREATE EVENT
            </span>
	    <hr>
            <form method="post" action="#">
                <p>Name:</p>
		<input type="text" maxlength="20"  placeholder="Name your Event" name="name">
                <p>Description:</p>
		<textarea type="text" rows="2" cols="40" maxlength="100" placeholder="Enter a Description" name="description"></textarea>
                <p>Start Time:</p>
		<input type="time" name="startTime">
                <p>End Time:</p>
		<input type="time" name="endTime" value="null">
		</br>
                <input type = "submit" class="btnSubmit" name = "submit" value = "Submit">
            </form>
        </div>
    </div>

 <div class="modal_container" id="modalEdit">
        <div class="modal">
            <a href="#" class="close">X</a>
            <span class="modal_heading">
                EDIT EVENT
            </span>
            <hr>
            <form method="post" action="#">
                <input type="hidden" name="eventId" value="<?php echo $eventId;?>">
		<p>Name:</p>
                <input type="text" maxlength="20" name="eventName" value="<?php echo $eventName;?>"> 
                <p>Description:</p>
                <textarea type="text" rows="2" cols="40" maxlength="100" name="eventDesc"><?php echo $eventDesc;?></textarea>
                <p>Date:</p>
                <input type="date" name="eventDate" value="<?php echo $eventDate;?>">
		<p>Start Time:</p>
                <input type="time" name="eventStart" value="<?php echo $eventStart;?>">
                <p>End Time:</p>
                <input type="time" name="eventEnd" value="<?php echo $eventEnd;?>">
                </br>
                <input type = "submit" class="btnSubmit" name = "changeEvent" value = "Submit">
		<input class="deleteBtn" type="submit" name = "deleteEvent" value="Delete">
            </form>
        </div>
    </div>

</body>
</html>
