<?php

require("../includes/_config.php");
require('../includes/_functions.php');


if (isset($_POST['edit'])) {

    $stateid = $_POST['stateid'];





    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-content" style="padding: 10px;">
            <div class="modal-header" style="padding: 0px;margin-bottom: 20px;padding-bottom:10px">
                <h4 class="modal-title fs-5" id="exampleModalLabel">Update Markup </h4>
                <button type="button" class="btn-close" style="border: none;;background-color:white" data-bs-dismiss="modal"
                    aria-label="Close"><svg style="width: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
                        <!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                        <path
                            d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z" />
                    </svg></button>
            </div>
            <div class="modal-body" style="padding: 0px;">

                <div class="row" style="display: none;">
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="stateId" value="<?php echo $stateid ?>">
                    </div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-lg-6">
                        <label for="stateName" class="form-label">State Name</label>
                        <input type="text" class="form-control" name="stateName"
                            value="<?php echo _getSingleStateMarkup($stateid, '_statename') ?>" placeholder="State Name">
                    </div>
                    <div class="col-lg-6">
                        <label for="stateCode" class="form-label">State Code</label>
                        <input type="text" class="form-control" name="stateCode"
                            value="<?php echo _getSingleStateMarkup($stateid, '_statecode') ?>" placeholder="State Code">
                    </div>

                </div>


                <div class="row" style="margin-top: 20px;">

                    <div class="col-lg-6" style="margin-bottom: 20px;">
                        <label for="countryId" class="form-label">Select Country</label>
                        <select style="height: 46px;" name="countryId" class="form-control form-control-lg" id="countryId"
                            required>
                            <option selected disabled value="">Select</option>

                            <?php

                            $sql = "SELECT * FROM `tblcountry` where `_status`='true' ";

                            $query = mysqli_query($conn, $sql);

                            if ($query) {

                                foreach ($query as $data) {

                                    $countryId = _getSingleStateMarkup($stateid, '_countryid');

                                    $currentCountryId = $data['_id'];
                                    $currentCountryName = $data['_countryname'];

                                    if ($countryId == $currentCountryId) {
                                        ?>
                                        <option value="<?php echo $currentCountryId ?>" selected>
                                            <?php echo $currentCountryName ?>
                                        </option>
                                        <?php

                                    } else {

                                        ?>
                                        <option value="<?php echo $currentCountryId ?>">
                                            <?php echo $currentCountryName ?>
                                        </option>
                                        <?php
                                    }
                                }

                            }


                            ?>

                        </select>
                        <div class="invalid-feedback">Please select proper country</div>
                    </div>


                    <div class="col" style="margin-top:40px;">
                        <div class="custom-control custom-switch">

                            <?php

                            $status = _getSingleStateMarkup($stateid, '_status');
                            if ($status == true) {
                                ?>

                                <input type="checkbox" class="custom-control-input" name="isactive" value="true" id="isactive" checked>
                                <label class="custom-control-label" style="margin-left: 20px;" for="isactive">Is
                                    Active</label>
                                <?php
                            } else {
                                ?>
                                <input type="checkbox" class="custom-control-input" name="isactive" value="true" id="isactive">
                                <label class="custom-control-label" style="margin-left: 20px;" for="isactive">Is
                                    <?php
                            }
                            ?>

                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer" style="padding: 0px;margin-top: 20px;padding-top:10px">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="updateState" class="btn btn-primary"><i
                        class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save changes</button>
            </div>
        </div>
    </form>

<?php




}





?>