<?php include('./includes/header.php') ?>
<?php
    require 'vendor/autoload.php';
    use \Mail\MailClass;
    use \Mail\DotEnv;

    (new DotEnv(__DIR__ . '/.env'))->load();
    $ml = new MailClass();
    
    $templates = $ml->getTemplates();

    if(isset($_POST['addtemplate'])){
        $data = [
            'author'=>$_POST['author'],
            'name'=>$_POST['name'],
            'description'=>$_POST['description'],
        ];
        // var_dump($data);
        $result = $ml->createTemplate($data);
        
    }


?>
<div class="container-fluid">
  <div class="row">
    <?php include('./includes/sidebar.php') ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Manage Mail Templates</h1>
            <div class=" ">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCampaign">New Template</button>
            </div>
        </div>
        <div class="">
            <div class="container">
                <div class="row">
                    <?php                                     
                                    var_dump($templates->getData());
                                    // var_dump($result);
                                    
                    ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Author</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($templates->getData() as $template): ?>
                                    <tr>
                                        <td><?php echo $template['Name'] ?></td>
                                        <td><?php echo $template['Author'] ?></td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addContent">Add Content</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                
                            </tbody>
                        </table>
                        <textarea name="" id="output" class="form-control" cols="30" rows="10"></textarea>
                        <div class="modal fade" id="addCampaign" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="<?=$_SERVER['PHP_SELF']?>" method="post">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Template</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Author</label>
                                                <input type="name" name="author" class="form-control" placeholder="John doe">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Name</label>
                                                <input type="name" name="name" class="form-control" placeholder="John doe">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Description</label>
                                                <textarea class="form-control" name="description" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="addtemplate" class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal fade" id="addContent" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <!-- <form action="<?=$_SERVER['PHP_SELF']?>" method="post"> -->

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Template</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Select Template</label>
                                                <select class="form-control" name="template">
                                                    <option value="">Select Template</option>
                                                    <?php foreach($templates->getData() as $template): ?>
                                                        <option value="<?php echo $template['ID'] ?>"><?php echo $template['Name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Name</label>
                                                <!-- <textarea name="" id="editorjs" cols="30" rows="10"></textarea> -->
                                                <div id="editorjs"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button id="saveButton" class="btn btn-primary">save</button>
                                            <button type="submit" id="saveButton" name="addtemplate" class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                <!-- </form> -->
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
