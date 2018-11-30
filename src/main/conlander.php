 <?php
   session_start();
   if (!$_SESSION['loggedin']) {
	header("LOCATION:home.php");
	return;
   }

   date_default_timezone_set('America/Detroit');
   
        include 'addEvent.php';
var_dump($_POST); 
	if (isset ($_POST['username'])) {
	    $uname = htmlentities($_POST['username']);
	}
        if (isset($_GET['submitDate'])) {
            $date = htmlentities($_GET['date']);
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
                $event->AddEvent($uname, $name,$desc,$date,$start,$end);
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

    for ($day = 1; $day <= $day_count; $day++, $str++) {
        $date = $ym.'-'.$day;

        if ($today == $date) {
            $week .= '<td class="today"><form method="get" action="#modal">';
            $week .= '<input type="hidden" name="date" value="'.$date.'">
                          <input class="dateEvents" type="submit" name="submitDate" value="'.$day.'"></form>';

        }
        else {
            $week .= '<td><form method="get" action="#modal">';
            $week .= '<input type="hidden" name="date" value="'.$date.'">
                          <input class="dateEvents" type="submit" name="submitDate" value="'.$day.'"></form>';
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
    <title>PHP Calendar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="ano     nymous">
    <link href="https://fonts.googleapis.com/css?family=Barlow" rel="stylesheet">            
    <style>
        .container {
            font-family: 'Amatic SC', cursive;
            margin-top: 80px;
        }
        th {
            height: 30px;
            text-align: center;
            font-weight: 700;
        }
        td {
            height: 100px;
            width: 150px;
        }
        .today {
            background: #fffd8e;
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
        }
        .dateEvents:hover {
            cursor:pointer;
            font-weight: bold;
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
            height:400px;
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
            background:green;
            color:white;
            margin-top:10px;
            border-radius:5px;
        }
        .btnSubmit:hover{
            background:#b80000;
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
            text-decoration:none;
            top:0px;
            right:0px;
	    margin: 3px 3px 0px 0px;
            border-radius: 5px;
            transition: background 500ms; 
        }
        .close:hover{
            background:#444;
            cursor:pointer;
        }
	.modal_container p {
	    margin: 5px 0px 0px 0px;
	    font-family: "Arial";
	    font-size: 12pt;
	}
    </style>
</head>

<body>
    <div class="container">
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
    <div class="modal_container" id="modal">
        <div class="modal">
            <a href="#" class="close">X</a>
            <span class="modal_heading">
                CREATE EVENT
            </span>
	    <hr>
            <form method="post" action="#">
                <p>Name:</p>
		<input type="text" placeholder="Name your Event" name="name">
                <p>Description:</p>
		<input type="text" placeholder="Enter a Description" name="description">
                <p>Start Time:</p>
		<input type="time" name="startTime">
                <p>End Time:</p>
		<input type="time" name="endTime">
		</br>
                <input type = "submit" class="btnSubmit" name = "submit" value = "Submit">
            </form>
        </div>
    </div>

</body>
</html>
