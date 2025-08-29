<?php
include('../inc/db-config.php');

$sql1 = "SELECT * FROM wp_vc_nbc_qna WHERE PAGE= '".$_GET['page']."'";

$query = $analytics_connection->query($sql1);
$data = $query->fetch_all(MYSQLI_ASSOC);



$html = '<table class="table table-bordered">
        <tr style="color:white;background-color:#37474f;">
            <td>ID</td>
            <td>Full name</td>
            <td>Email</td>
            <td>Location</td>
            <td>Question</td>
            <td>Website</td>
            <td>Page</td>
            <td>Created Date</td>
        </tr>
    ';
   
    $i=1;
    foreach ($data as $key => $value) {
        // code... 
        //echo "<pre>";print_r($value);exit();
        $html .= 
            '<tr>
            <td>'. $i.'</td>
            <td>'. $value->fullname.'</td>
            <td>'. $value->email .'</td>
            <td>'. $value->location .'</td>
            <td>'. $value->question .'</td>
            <td>'. $value->website .'</td>
            <td>'. $value->page .'</td>
            <td>'. $value->created_date .'</td>
            </tr>';
            $i++;
    }




    $html .= '</table>';

    
    $fileName = 'Report - Qna.xls';
    header( "Content-type: application/vnd.ms-excel" ); 
    header( "Content-Disposition: attachment; filename=$fileName" );

    echo $html;
    
    exit();

