<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package edsBootstrap
 */

    $dbcolum_name_by_username;
    //$form_username = get_query_var( 'form_username' );
    $form_username      = urldecode ( get_query_var( 'form_username' ) );
    $url_user_role = get_query_var( 'form_user_role' );

    // wordpress user
    $user = wp_get_current_user();
    $loggedin_username = $user->user_login;
    $result = get_entries_by_user( $loggedin_username, $url_user_role );


    $userdata = fetch_userdata( $form_username );
    // echo "<pre>"; print_r($userdata);echo "</pre>";
    $loggedin_username = $userdata['username'];
    $result = get_entries_by_user( $loggedin_username, $url_user_role );

    $data = array();
    //echo "<pre>"; print_r( $result );echo "</pre>";
?>

<style>
    .class_29062022{display: block;}
    table{font-size: 13px;}
    .pageTitle{
        width: 100%;
        display: inline-block;
        padding: 20px;
    }
    .table-wrap{
        display: block;
        width: 100%;
        padding: 20px 0;
    }
    a.class_62722 {
        display: inline-block;
        color: white;
        font-size: 13px;
        background-color: #95c12b;
        padding: 7px 30px;
        margin: 20px 0;
        border-radius: 5px;
        font-weight: normal;
    }
    a.class_62722857{
        display: inline-block;
        color: white;
        font-size: 13px;
        background-color: #009ca5;
        padding: 7px 30px;
        border-radius: 5px;
        font-weight: normal;
    }
    .actionButtons{
        text-align: right;
    }
    #table_id th {
        background-color: #009ca5;
        color: #fff;
    }
    #table_id td{
        text-align: center;vertical-align: middle;
    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

<div class="row" style="background-color: #e5e5e5;">
    <div class="container">
        <div class="pageTitle">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3>Patient Experience Entries</h3>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="container">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 actionButtons">
        <a href= '<?php echo home_url()."/get/$url_user_role/$form_username/form";?>' class='class_62722'> Submit New Patient Form</a>
        <!-- <a href= '<?php echo home_url()."/survey";?>' class='class_62722'> New Questionnaire</a> -->
        <!-- <a href= '<?php echo home_url()."/account-details";?>' class='class_62722'> Submit Account Details</a> -->
    </div>
    </div>
</div>

<div class="row">
<div class="container">
    <div class="table-wrap">
        
        <table id= "table_id" class="table table-bordered table-responsive">

            <thead>
                <tr>
                    <th scope="col">Doctor Name </th>
                    <!-- <th scope="col">Patient ID</th> -->
                    <th scope="col">Patient Display Name</th>
                    <th scope="col">Created Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($result as  $key => $value) { ?>
                     <?php //if ($value->doc_name != 'Saurabh Raut' && $value->doc_name != "Hemant B") { ?>
                    <tr>
                        <?php 
                        // $data = json_decode($value->form_data);
                        // echo "<pre>"; print_r( $data );echo "</pre>"; 
                        ?>

                        <td><?php echo $value->doc_name;?></td>
                        <!-- <td><?php echo $value->pt_id; ?></td> -->
                        <td><?php echo $value->pt_displayname; ?></td>
                        <td><?php echo $value->created_date; ?></td>
                        <td>                            
                            <?php $data = json_decode($value->form_data); ?>
                            <?php //echo "<pre>";print_r( $data); echo "</pre>";?>
                            <a class="class_62722857" data-toggle="modal" data-target="#modal<?php echo $value->id;?>">View</a>
                            
                            <!-- Modal -->
                            <div id="modal<?php echo $value->id;?>" class="modal fade bd-example-modal-lg" role="dialog">
                              <div class="modal-dialog modal-lg">
                                <!-- Modal content-->
                                <div class="modal-content" style="display: inline-block;">
                                  <div class="modal-body">
                                    <table id = "modal_info" class="table table-bordered table-responsive ">
                                        <thead>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>            
                                        </thead>
                                        <tbody>
                                            
                                                <?php 
                                                foreach ($data as $key => $value) { ?>
                                                    <?php if($key !== 'pef_form_id' && $key !== 'pef_page_slug' ) { ?>
                                                    <tr>
                                                        <th><?php echo srb_replace_strings($key); ?></th>
                                                        <td><?php print_r( $value ); ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                                
                                            
                                        </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
      

                        </td>
                    </tr>
                    <?php //} ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</div>



