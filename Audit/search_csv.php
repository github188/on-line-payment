<?php
    require_once 'check_login.php';
    $begdate = $_GET['begdate'];
    $enddate = $_GET['enddate'];
    const CSV_DIR = "csv";
    $begdate = $begdate.' 0:0:0';
    //echo $begdate.'<br>';
    $enddate = $enddate.' 0:0:0';
    //echo $enddate.'<br>';
    $begtime = strtotime($begdate);
    $endtime = strtotime($enddate);
    $i = 0;
    //echo '<table>';
    while ( $begtime < $endtime) {
        $date = date('Y-m-d', $begtime);
        $filename = CSV_DIR . "/" . $date . ".csv";
        if(file_exists($filename)) {
            $i++;
            echo "<tr>
                        <td>$i</td>
                        <td><a href='$filename'>$date</a></td>
                    </tr>";
        }
        $begtime += 24*60*60;
    }
    //echo '</table>';
?>