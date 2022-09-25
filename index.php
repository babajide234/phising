<!-- importing the header -->
<?php include('./includes/header.php') ?>
<?php

//   $response = $mj->post(Resources::$Email, ['body' => $body]);
//   $response->success() && var_dump($response->getData());
//   var_dump($response);
    require_once './vendor/autoload.php';

    use \Mail\MailClass;
    use \Mail\DotEnv;

    (new DotEnv(__DIR__ . '/.env'))->load();

    $ml = new MailClass();
    $stats = $ml->getStastitics();
    $message = $ml->getMessages()->getData();
    $filterBy = 'opened';
                                                                                        
    $new = array_filter($message, function ($var) use ($filterBy){
        return ($var['Status'] == $filterBy);
    });
    $click = $ml->getClickStastitics()->getData();



?>
<div class="container-fluid">
  <div class="row">
    <?php include('./includes/sidebar.php') ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
        </div>
        <div class="">
            <div class="container">
                <div class="row">
                    <?php
                        // var_dump($stats->getData());
                    ?>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="fw-light fs-4 ">Open Rate</h3>
                        <div class="border border-primary border-2 rounded d-flex flex-column justify-content-center align-items-center" style=" height: 300px">
                            <h1 class="text-primary" style=" font-size: 40px">
                                <?php
                                    $openrate = (count($new)/count($message) )* 100;
                                    echo number_format($openrate,2).'%';
                                ?>
                            </h1>
                        </div>
                    </div>
                    <div class="col-md-4">
                    <h3 class="fw-light fs-4 ">Compromise Rate</h3>
                        <div class="border border-danger border-2 rounded d-flex flex-column justify-content-center align-items-center" style=" height: 300px">
                            <h1 class="text-danger" style=" font-size: 40px">
                                <?php
                                    $filterBy = 'clicked'; // or Finance etc.
                                                                                                
                                    $new = array_filter($message, function ($var) use ($filterBy){
                                        return ($var['Status'] == $filterBy);
                                    });
                                    $compromise = ( count($new )/ count($message))* 100;
                                    echo number_format($compromise,2).'%';
                                ?>
                            </h1>
                        </div>
                    </div>
                    <div class="col-md-4">
                    <h3 class="fw-light fs-4 ">Uncompromise Rate</h3>
                        <div class="border border-success border-2 rounded d-flex flex-column justify-content-center align-items-center" style=" height: 300px">
                            <h1 class="text-success" style=" font-size: 40px">
                                <?php
                                    $uncompromise = 100 -($openrate + $compromise);
                                    echo number_format($uncompromise ,2).'%';
                                ?>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
  </div>
</div>
<?php include('./includes/footer.php') ?>
