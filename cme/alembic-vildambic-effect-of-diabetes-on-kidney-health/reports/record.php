<style>table, th, td { border: 1px solid;}</style>
<?php
include('../inc/db-config.php');

$part = explode('/',$_SERVER['REQUEST_URI']);

if( !isset( $_GET['action'] ) ){
    $where_action = " AND ACTION IN ('Register' , 'Login')";
    $action = "ALL";
}else{
    $where_action = " AND ACTION ='".$_GET['action']."' ";
    $action = $_GET['action'];
}
/**
 * 
 * rename $ref_tbl_name variable to the  newly created  registration table name
 *  
 */
$ref_tbl_name = $table_name; //'registration_zydus_14thDec';

$sql1 = "SELECT * FROM wp_vc_login_record";
$sql1 .= " WHERE PAGE = '".$part[1]."' ";
//$sql1 .= " WHERE PAGE = 'Vonolution-UnveilingthefutureofAcidSuppression' ";
//$sql1 .= " WHERE PAGE IN ('Vonolution-UnveilingthefutureofAcidSuppression', 'Vololution-UnveilingthefutureofAcidSuppression') ";
//$sql1 .= " AND PAGE = 'Vololution-UnveilingthefutureofAcidSuppression' ";
$sql1 .= $where_action;
$sql1 .= " AND website = 'cmeworld.org' order BY id desc";
// echo $sql1;exit;
//AND email NOT LIKE '%@docmode.com%' 
$query = $reader_analytics_connection->query($sql1);
$data = $query->fetch_all(MYSQLI_ASSOC);
// echo "<pre>"; print_r($data); echo "</pre>";exit;

// array ( 
// [0] => Array
//         (
//             [id] => 206769
//             [email] => ganesh21@docmode.com
//             [website] => cmeworld.org
//             [page] => macleods-cvlive-ESCupdates2023
//             [action] => Login
//             [created_date] => 2023-09-02 11:06:32
//         )
// )

$sql2 = "SELECT * FROM ".$ref_tbl_name;

$query2 = $reader_connection->query($sql2);
$other_data = $query2->fetch_all(MYSQLI_ASSOC);
 // echo "<pre>"; print_r($other_data); echo "</pre>";exit;

$i=0;

foreach ( $data as $data_item ){
    foreach( $other_data as $other_data_item ){
        if( $data_item['email'] == $other_data_item['email']){
            
            $result [$i]= array(
                'action' => $data_item['action'],
                'action_date' => $data_item['created_date'],
                'logout_time' => $data_item['logout_time'],
                'email' => $data_item['email'],
                'mobile' => $other_data_item['mobile'],
                'name' => $other_data_item['name'],
                'city' => $other_data_item['city'],
                'state' => $other_data_item['state'],
                'pin_code' => $other_data_item['pin_code'],
                'employee_sap_code' => $other_data_item['employee_sap_code'],
                'hq' => $other_data_item['hq'],
                'level' => $other_data_item['level'],
                'zone' => $other_data_item['zone'],
                'region' => $other_data_item['region'],
                'registration_date' => $other_data_item['created_date']
             ); 
            $i++;break;

        }
    }

}

// echo "<pre>";print_r($other_data);exit;


$html = '<table class="table table-bordered">
            <tr style="color:white;background-color:#37474f;">
                <td> Index </td>
                <td> Action </td>
                <td> Action date </td>
                <td> Logout Time </td>
                <td> Name </td>
                <td> Email </td>
                <td> Mobile </td>
                <td> State </td>
                <td> City </td>
                <td> Pin Code </td>
                <td> Employee SAP Code </td>
                <td> HQ </td>
                <td> Level </td>
                <td> Zone </td>
                <td> Region </td>
                <td> Registration date </td>
            
            </tr>
    ';
   
    $i=1;
    foreach ($result as $key => $value) {
        // code... 
        //echo "<pre>";print_r($value);
        if($value["action"] == 'Login' || $value["action"] == 'login'):
            $html .= 
                '<tr>
                    <td>'. $i.'</td>
                    <td>'. $value["action"] . '</td>
                    <td>'. $value["action_date"] . '</td>'; 

            if(!empty($value["logout_time"])):
                $html .='<td>'. $value["logout_time"] . '</td>';
            else:
                $date = $value["action_date"];
                //$newDate1 = date('d-m-Y H:i:s', strtotime($date. ' + 15 minutes'));
                //$newDate = date('d-m-Y H:i:s', strtotime($newDate1. ' + 3 hours'));
                $newDate1 = date('d-m-Y H:i:s', strtotime($date. ' + 5 minutes'));
                $newDate = date('d-m-Y H:i:s', strtotime($newDate1. ' + 5 minutes'));
                $html .='<td>'. $newDate .'</td>';
            endif;                
            
            $html .='<td>'. $value["name"] . '</td>
                    
                    <td>'. $value["email"] . '</td>
                    <td>'. $value["mobile"] . '</td>
                    
                    <td>'. $value["state"] . '</td>
                    <td>'. $value["city"] . '</td>
                    <td>'. $value["pin_code"] . '</td>
                    <td>'. $value["employee_sap_code"] . '</td>
                    <td>'. $value["hq"] . '</td>
                    <td>'. $value["level"] . '</td>
                    <td>'. $value["zone"] . '</td>
                    <td>'. $value["region"] . '</td>
                    <td>'. $value["registration_date"] . '</td>
                </tr>';
            else:
                $html .= 
                    '<tr>
                        <td>'. $i.'</td>
                        <td>'. $value["action"] . '</td>
                        <td>'. $value["action_date"] . '</td>
                        <td>00 00 00</td>
                        <td>'. $value["name"] . '</td>            
                        <td>'. $value["email"] . '</td>
                        <td>'. $value["mobile"] . '</td>
                        
                        <td>'. $value["state"] . '</td>
                        <td>'. $value["city"] . '</td>
                        <td>'. $value["pin_code"] . '</td>
                        <td>'. $value["employee_sap_code"] . '</td>
                        <td>'. $value["hq"] . '</td>
                        <td>'. $value["level"] . '</td>
                        <td>'. $value["zone"] . '</td>
                        <td>'. $value["region"] . '</td>
                        <td>'. $value["registration_date"] . '</td>
                    </tr>';
            endif;
            $i++;
    }




    $html .= '</table>';

    
    $fileName = 'Report - '.$ref_tbl_name.'-'.$action.'.xls';
    header( "Content-type: application/vnd.ms-excel" ); 
    header( "Content-Disposition: attachment; filename=$fileName" );

    echo $html;

    exit();

