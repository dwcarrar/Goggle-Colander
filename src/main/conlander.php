 <?php
   date_default_timezone_set('America/Detroit');
    
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
            $week .= '<td class="today">'.$day;
        }
        else {
            $week .= '<td>'.$day; 
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
</body>
</html>
