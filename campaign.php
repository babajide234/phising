<?php include('./includes/header.php') ?>
<?php
  require 'vendor/autoload.php';

    if(isset($_POST['submit'])){
        var_dump($_POST);
    }


  use \Mailjet\Resources;
  $mj = new \Mailjet\Client('d8e79f3a70d085d0447e42b81eb6d4c6','bd11b19cbda6ccd3c4447a183addefb8',true,['version' => 'v3.1']);
  $body = [
    'Messages' => [
      [
        'From' => [
          'Email' => "babajide234@gmail.com",
          'Name' => "Babajide"
        ],
        'To' => [
          [
            'Email' => "babajide234@gmail.com",
            'Name' => "Babajide"
          ]
        ],
        'Subject' => "Greetings from Mailjet.",
        'TextPart' => "My first Mailjet email",
        'HTMLPart' => "<h3>Dear passenger 1, welcome to <a href='https://www.mailjet.com/'>Mailjet</a>!</h3><br />May the delivery force be with you!",
        'CustomID' => "AppGettingStartedTest"
      ]
    ]
  ];
 
?>
<div class="container-fluid">
  <div class="row">
    <?php include('./includes/sidebar.php') ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">New campaign</h1>
            <div class=" ">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCampaign">New Campaign</button>
            </div>
        </div>
        <div class="">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                    <div class="modal fade" id="addCampaign" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="<?=$_SERVER['PHP_SELF']?>" method="post">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Contact</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Name</label>
                                                <input type="name" name="name" class="form-control" placeholder="John doe">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" placeholder="name@example.com">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="addcontact" class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- <div class="border border-2 rounded p-4">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">From</label>
                                    <input type="email" class="form-control" placeholder="name@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">To</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Body</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5">

                                    </textarea>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Send Mail</button>
                                </div>
                            </form>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </main>
  </div>
</div>
<?php include('./includes/footer.php') ?>
