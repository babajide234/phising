<?php include('./includes/header.php') ?>
<?php
    require_once './vendor/autoload.php';
    use \Mail\MailClass;
    use \Mail\DotEnv;

    (new DotEnv(__DIR__ . '/.env'))->load();
    // use \Dotenv\Dotenv;
    $ml = new MailClass();
    // $result = array();
    if (isset($_POST['addcontact'])) {
        // var_dump($_POST);
        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
        ];
        $result = $ml->addcontact( $data );

    }
    $contacts = $ml->getcontacts()->getData();
    
    if(isset($_POST['addlist'])){
        $data = [
            'name' => $_POST['contactlistname'],
        ];
        $result = $ml->addContactsList( $data );
    }
    $contactlists = $ml->getContactLists()->getData();

    if(isset($_POST['addlistcontact'])){
        $data = [
            'ContactID' => $_POST['contactid'],
            'ListID' => $_POST['listid'],
        ];

        $result = $ml->addContactToList( $data );
    }
?>
<div class="container-fluid">
  <div class="row">
    <?php include('./includes/sidebar.php') ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Contact Management</h1>
            <div class=" ">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add Contact</button>
            </div>
        </div>
        <div class="">
            <div class="container">
                <div class="row">
                    <?php
                            // if($result->success()){
                            //     echo `
                            //     <div class="alert alert-success" role="alert">
                            //     <strong>Success!</strong> Contact added successfully.
                            //     </div>
                            //     `;
                            // }
                            // var_dump($contacts);
                    ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="border border-2 rounded p-4">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($contacts as $contact): ?>
                                    <tr>
                                        <td><?php echo $contact['Name'] ?></td>
                                        <td><?php echo $contact['Email'] ?></td>
                                        <td>
                                            <a href="editcontact.php?id=<?php echo $contact['ID'] ?>" class="btn btn-primary">Edit</a>
                                            <a href="deletecontact.php?id=<?php echo $contact['ID'] ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
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
                    </div>
                    <div class="col-md-6">
                        <div class="border border-2 rounded p-4">
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addList">New List</button>
                                    <button  class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#addListContact" >Add Contact To List</a>
                                </div>
                            </div>    
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Contact Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($contactlists as $contactlist): ?>
                                            <tr>
                                                <td><?php echo $contactlist['Name'] ?></td>
                                                <td>
                                                    <?php echo $contactlist['Address'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $contactlist['SubscriberCount'] ?>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>            
                        </div>
                        <div class="modal fade" id="addListContact" tabindex="-1" aria-labelledby="addListContact" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="<?=$_SERVER['PHP_SELF']?>" method="post">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Contact List</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Contacts List</label>
                                                <select name="listid" id="" class="form-control">
                                                    <option value="">Select Contact</option>
                                                    <?php
                                                        foreach($contactlists as $list){
                                                            echo "<option value='".$list['ID']."'>".$list['Name']."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Contacts</label>
                                                <select name="contactid" id="" class="form-control">
                                                    <option value="">Select Contact</option>
                                                    <?php
                                                        foreach($contacts as $contact){
                                                            echo "<option value='".$contact['ID']."'>".$contact['Name']."</option>";
                                                        }
                                                    ?>
                                                </select>
                                                <!-- <input type="name" name="name" class="form-control" placeholder="Company List"> -->
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="addlistcontact" class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal fade" id="addList" tabindex="-1" aria-labelledby="addList" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="<?=$_SERVER['PHP_SELF']?>" method="post">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Contact List</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Name</label>
                                                <input type="name" name="contactlistname" class="form-control" placeholder="Company List">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="addlist" class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
  </div>
</div>

<?php include('./includes/footer.php') ?>
