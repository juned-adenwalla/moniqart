<?php

require("../includes/_config.php");
require('../includes/_functions.php');


if (isset($_POST['edit'])) {

    $menuid = $_POST['menuid'];





?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="modal-content" style="padding: 10px;">
        <div class="modal-header" style="padding: 0px;margin-bottom: 20px;padding-bottom:10px">
            <h4 class="modal-title fs-5" id="exampleModalLabel">Edit Menu Settings</h4>
            <button type="button" class="btn-close" style="border: none;background-color:white" data-bs-dismiss="modal"
                aria-label="Close"><svg style="width: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
                    <!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                    <path
                        d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z" />
                </svg></button>
        </div>

        <div class="modal-body" style="padding: 0px;">


                <div class="row">

                    <div class="col-lg-6">
                        <label for="name" class="form-label">Menu Name</label>
                        <input type="text" id="name" name="name"
                            value="<?php echo _getSingleMenuSettings($menuid, '_name') ?>" class="form-control"
                            required>
                    </div>

                    <div class="col-lg-6">
                        <label for="url" class="form-label">Menu Url</label>
                        <input type="text" id="url" name="url"
                            value="<?php echo _getSingleMenuSettings($menuid, '_url') ?>" class="form-control" required>
                    </div>


                </div>

                <div class="row" style="margin-top:20px;">

                    <div class="col-lg-6">
                        <label for="menu" class="form-label">Menu Icon</label>
                        <input type="text" id="menu" name="menu"
                            value="<?php echo _getSingleMenuSettings($menuid, '_menu') ?>" class="form-control"
                            required>
                    </div>

                    <div class="col-lg-6">
                        <label for="indexing" class="form-label">Menu Indexing</label>
                        <input type="text" id="indexing" name="indexing"
                            value="<?php echo _getSingleMenuSettings($menuid, '_indexing') ?>" class="form-control"
                            required>
                    </div>


                </div>

                <div class="row" style="margin-top:20px;">

                    <div class="col-lg-12">
                        <div class="custom-control custom-switch">
                            

                                <?php

                                $status = _getSingleMenuSettings($menuid, '_status');
                                if($status==true){
                                    ?>
                                    <input type="checkbox" class="custom-control-input" name="isactive" id="isactive" checked>
                                    <label class="custom-control-label" style="margin-left: 20px;" for="isactive">Is
                                Active</label>
                                    <?php
                                }
                                else{
                                    ?>
                                    <input type="checkbox" class="custom-control-input" name="isactive" id="isactive" >
                                    <label class="custom-control-label" style="margin-left: 20px;" for="isactive">Is
                                Active</label>
                                    <?php
                                }
                                ?>

                        </div>
                    </div>


                </div>

                <div class="col-lg-12" style="margin-top: 20px; display: none; ">
                    <label for="answer" class="form-label" style="display: block;">Menu Id</label>
                    <input type="text" class="form-control" name="menuid" value="<?php echo $menuid ?>">

                </div>


        </div>
        <div class="modal-footer" style="padding: 0px;margin-top: 20px;padding-top:10px">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="editMenuSetting" class="btn btn-primary"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save changes</button>
        </div>
    </div>
</form>

<?php




}





?>