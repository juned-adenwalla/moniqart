<?php

require("../includes/_config.php");
require('../includes/_functions.php');


if (isset($_POST['edit'])) {

    $shippingid = $_POST['shippingid'];





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




                <div class="row" style="margin-top: 20px;">

                    <div class="col-lg-6" style="margin-bottom: 20px;">
                        <label for="countryId" class="form-label">Select Country</label>
                        <select style="height: 46px;" name="countryId"
                            onchange="getStates(this.options[this.selectedIndex].value),'update'"
                            class="form-control form-control-lg" id="countryId" required>

                            <option selected disabled value="">Select</option>

                            <?php

                            $sql = "SELECT * FROM `tblcountry` where `_status`='true' ";

                            $query = mysqli_query($conn, $sql);

                            if ($query) {

                                foreach ($query as $data) {

                                    $countryId = _getSingleShippingMarkup($shippingid, '_country');

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

                    <div class="col-lg-6" style="margin-bottom: 20px;">
                        <label for="stateId" class="form-label">Select State</label>
                        <select style="height: 46px;" name="stateId" class="form-control form-control-lg" id="stateIdUpdate"
                            required>

                            <?php

                            $stateId = _getSingleShippingMarkup($shippingid, '_state');
                            $stateName = _getSingleStateMarkup($stateId, '_statename');

                            ?>
                            <option value="<?php echo $stateId ?>" selected>
                                <?php echo $stateName ?>
                            </option>
                            <?php
                            ?>

                        </select>
                        <div class="invalid-feedback">Please select proper country</div>
                    </div>


                </div>

                <div class="row" style="margin-top: 20px;">

                    <div class="col-lg-6" style="margin-bottom: 20px;">
                        <label for="feeType" class="form-label">Fee Type</label>
                        <select style="height: 46px;" name="feeType" class="form-control form-control-lg" id="feeType"
                            required>

                            <?php

                            $feeType = _getSingleShippingMarkup($shippingid, '_feetype');

                            if ($feeType == "percentage") {
                                ?>
                                <option selected value="percentage">Percentage (%) </option>
                                <option value="fixed">Fixed</option>
                                <?php
                            } else {
                                ?>
                                <option value="percentage">Percentage (%) </option>
                                <option selected value="fixed">Fixed</option>
                                <?php
                            }

                            ?>



                        </select>
                        <div class="invalid-feedback">Please select proper country</div>
                    </div>


                    <div class="col-lg-6">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" name="price"
                            value="<?php echo _getSingleShippingMarkup($shippingid, '_price') ?>" placeholder="Price">
                    </div>

                </div>

                <div class="row">
                    <div class="col" style="margin-top:20px;">
                        <div class="custom-control custom-switch">

                            <?php

                            $status = _getSingleShippingMarkup($shippingid, '_status');
                            if ($status == true) {
                                ?>

                                <input type="checkbox" class="custom-control-input" name="isactive" value="true" id="isactive" checked>
                                <label class="custom-control-label" for="isactive">Is
                                    Active</label>
                                <?php
                            } else {
                                ?>
                                <input type="checkbox" class="custom-control-input" name="isactive" value="true" id="isactive">
                                <label class="custom-control-label" for="isactive">Is
                                    <?php
                            }
                            ?>

                        </div>
                    </div>

                    <div class="col" style="display:none;">
                        <input type="text" class="form-control" name="shippingId" value="<?php echo $shippingid ?>">
                    </div>

                </div>



            </div>
            <div class="modal-footer" style="padding: 0px;margin-top: 20px;padding-top:10px">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="updateShipping" class="btn btn-primary"><i
                        class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save changes</button>
            </div>
        </div>
    </form>

<?php




}





?>