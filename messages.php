<?php include('./includes/header.php') ?>
<?php
    require_once './vendor/autoload.php';
    use \Mail\MailClass;
    use \Mail\DotEnv;

    (new DotEnv(__DIR__ . '/.env'))->load();
    // use \Dotenv\Dotenv;
    $ml = new MailClass();
    $message = $ml->getMessages()->getData();
    $contacts = $ml->getcontacts()->getData();
    if(isset($_POST['sendmail'])){
        $body= [
            'Email' => $_POST['recipient'],
            'Name' => '',
            'Subject' => $_POST['subject'],
            'TextPart' => $_POST['body_text'],
        ];
        $res = $ml->sendMail($body);
        
        // var_dump($_POST['sendmail']);
    }
?>
<div class="container-fluid">
  <div class="row">
    <?php include('./includes/sidebar.php') ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Messages</h1>
            <div class=" ">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Send Mail</button>
            </div>
        </div>
        <div class="">
            <div class="container">
                <div class="row">
                    <?php
                            // if(isset($res)){

                            //     if($res->success()){
                            //         echo `
                            //         <div class="alert alert-success" role="alert">
                            //         <strong>Success!</strong> Mail Sent Successfully.
                            //         </div>
                            //         `;
                            //     }
                            // }
                            // var_dump($message)
                    ?>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="border border-2 rounded p-4">
                            <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ArrivedAt</th>
                                    <th>Contact</th>
                                    <!-- <th>Subject</th> -->
                                    <th>Status</th>
                                    <!-- <th>Action</th> -->
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
                                    <!-- <td><?php echo $value['Subject'] ?></td> -->
                                    <td><span class="badge text-bg-success"><?php echo $value['Status'] ?></span></td>
                                    <!-- <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                                    </td> -->
                                </tr>
                                <?php } ?>
                            </tbody>
                            </table>
                        </div>
                        
                        <div class="modal fade bd-example-modal-lg" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="<?=$_SERVER['PHP_SELF']?>" method="post">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Send Message</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1" class="form-label">Recipient Name</label>
                                                        <select name="recipient" id="" class="form-control" >
                                                            <option value="none" selected disabled hidden>Select an Email</option>
                                                            <?php
                                                                foreach($contacts as $list){
                                                                    echo "<option value='".$list['Email']."'>".$list['Email']."</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Subject</label>
                                                <input type="text" name="subject" class="form-control" placeholder="John doe">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Body</label>
                                                <textarea  name="body_text" id="example" class="form-control" placeholder="Body of email">
                                                </textarea>
                                                <!-- <div id="editorjs"></div> -->
                                                <!-- <div id="example"></div> -->
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="sendmail" class="btn btn-primary">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
  </div>
</div>

<?php include('./includes/footer.php') ?>
