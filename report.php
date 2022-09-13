<?php include('./includes/header.php') ?>
<?php
    require_once './vendor/autoload.php';
    use \Mail\MailClass;
    use \Mail\DotEnv;

    (new DotEnv(__DIR__ . '/.env'))->load();
    // use \Dotenv\Dotenv;
    $ml = new MailClass();
    // $result = array();
    $message = $ml->getMessages()->getData();
    $click = $ml->getClickStastitics()->getData();
    $click2 = $ml->getClickStastitics();
    // function test_odd($var){
    //     return $var['ID'] == 
    // };
    
?>
<div class="container-fluid">
  <div class="row">
    <?php include('./includes/sidebar.php') ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Report</h1>
            <div class=" ">
            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add Contact</button> -->
            </div>
        </div>
        <div class="">
            <div class="row">
                <?php
                    // var_dump($click2);
                    // var_dump($message);
                ?>
            </div>
                <div class="row">
                    <div class="col-md-4">
                        <table class="table">
                            <thead>
                                <th>Stats</th>
                                <th>Value</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        No Of Sent Emails:
                                    </td>
                                    <td>
                                        <?php
                                            echo count($message);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>No Of Open Email</td>
                                    <td>
                                        <?php

                                            $filterBy = 'opened'; // or Finance etc.
                                                                                        
                                            $new = array_filter($message, function ($var) use ($filterBy){
                                                return ($var['Status'] == $filterBy);
                                            });

                                            echo count($new);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>No Linked Clicked</td>
                                    <td>
                                        <?php
                                            $filterBy = 'clicked'; // or Finance etc.
                                                                                                
                                            $new = array_filter($message, function ($var) use ($filterBy){
                                                return ($var['Status'] == $filterBy);
                                            });
                                            echo count($new);
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <?php
                            
                            // $stats = $ml->getCampaignStats()->getData();
                            // var_dump($stats);
                    ?>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-responsive table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ArrivedAt</th>
                                    <th>Contact</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Link Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($message as $key => $value){ ?>
                                <tr>
                                    <td><?php echo $value['ArrivedAt'] ?></td>
                                    <td>
                                        <?php 
                                            $contact = $ml->getContact($value['ContactID'])->getData();
                                            
                                            $filterBy = $value['ContactID']; // or Finance etc.
                                            
                                            $new = array_filter($contact, function ($var) use ($filterBy){
                                                return ($var['ID'] == $filterBy);
                                            });
                                            // print_r(reset($new)['Email']);
                                            echo reset($new)['Email'];
                                        ?>
                                    </td>
                                    <td><?php echo $value['Subject'] ?></td>
                                    <td>
                                        <span class="badge text-bg-success">
                                            <?php 
                                                if($value['Status'] == 'clicked'){
                                                    echo 'opened';
                                                }else{
                                                    echo $value['Status'];
                                                    
                                                }
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php
                                            $filterBy = 'clicked'; // or Finance etc.
                                                                                            
                                            $new = array_filter($message, function ($var) use ($filterBy){
                                                return ($var['Status'] == $filterBy);
                                            });

                                            // echo count($new);
                                            // var_dump($new);
                                            foreach($new as $link){
                                                if($value['ID'] == $link['ID']){
                                                    echo '<span class="badge text-bg-success">';
                                                    echo 'Clicked';
                                                    echo '</span>';
                                                }else{
                                                    echo '<span class="badge text-bg-danger">';
                                                    echo 'No Link Sent';
                                                    echo '</span>';
                                                    
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td>
                                    <?php
                                            $filterBy = 'opened'; // or Finance etc.
                                                                                                
                                            $new = array_filter($message, function ($var) use ($filterBy){
                                                return ($var['Status'] == $filterBy);
                                            });

                                            // echo count($new);
                                            foreach($click as $link){
                                                if($value['ID'] == $link['ID']){
                                                    echo $link['Url'];
                                                }else{
                                                    echo 'None';
                                                }
                                            }
                                        ?>
                                    </td>
                                    <!-- <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                                    </td> -->
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
  </div>
</div>

<?php include('./includes/footer.php') ?>
