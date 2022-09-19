<?php
session_start();
require('./assets/require/check_data.php');

if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
  if ($_SESSION['users']['type'] == 'admin') {

    require('./assets/require/co_bdd.php');
    require('./assets/require/functions.php');
    require('./assets/require/head.php');

    $getReportings = getReporting($bdd); ?>


    <h1>reportings</h1>

    <table class="table sortable">
      <thead>
        <tr>
          <th scope="col" style="word-break: break-all;">id</th>
          <th scope="col" style="word-break: break-all;">Date</th>
          <th scope="col" style="word-break: break-all;">id_users</th>
          <th scope="col" style="word-break: break-all;">id_contents</th>
        </tr>
      </thead>

      <tbody>

        <?php

        foreach ($getReportings as $getReporting) {

          require('./assets/require/variables.php');

          $getUserInformations = getUserInformations($bdd, $getReporting_id_users);

          $getContentInformations = getContentInformations($bdd, $getReporting_id_contents);

          require('./assets/require/variables.php'); ?>

          <tr>
            <td scope="col" style="word-break: break-all;"><?= $getReporting_id ?></td>
            <td scope="col" style="word-break: break-all;"><?= $getReporting_date ?></td>
            <td scope="col" style="word-break: break-all;"><?= $getReporting_id_users ?></td>
            <td scope="col" style="word-break: break-all;"><?= $getReporting_id_contents ?></td>

            <td scope="col" style="word-break: break-all;">

              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#user_editModal<?= $getReporting_id ?>">
                See
              </button>

              <div class="modal fade" id="user_editModal<?= $getReporting_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">

                      <h5 class="modal-title" id="exampleModalLabel">Reporting</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                      <form method="post" action="./assets/actions/reply_action.php?id=<?= $getReporting_id ?>" enctype="multipart/form-data">

                        <div class="mb-3">
                          <label for="admin_reporting_id_user<?= $getReporting_id ?>" class="form-label">Reporting User id</label>
                          <input type="hidden" class="form-control" id="admin_reporting_id_user<?= $getReporting_id ?>" name="id" value="<?= $getReporting_id_users ?>">

                          <div style="width:10%; border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;"><?= $getReporting_id_users ?></div>
                        </div>

                        <div class="mb-3">
                          <label for="admin_reporting_name<?= $getReporting_id ?> class=" form-label">Name/Lastname</label>
                          <input type="hidden" class="form-control" id="admin_reporting_name<?= $getReporting_id ?>" name="name" value="<?= $getUserInformations_name ?>">

                          <label for="admin_reporting_lastname<?= $getReporting_id ?> class=" form-label"></label>
                          <input type="hidden" class="form-control" id="admin_reporting_lastname<?= $getReporting_id ?>" name="lastname" value="<?= $getUserInformations_lastname ?>">

                          <div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;word-break: normal;"><?= $getUserInformations_name ?> <?= $getUserInformations_lastname ?></div>
                        </div>

                        <div class="mb-3">
                          <div class="form-label">Email</div>
                          <div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;word-break: normal;"><?= $getUserInformations_email ?></div>
                        </div>

                        <div class="mb-3">
                          <div class="form-label">Reported Content id</div>
                          <div style="width:10%; border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;"><?= $getReporting_id_contents ?></div>
                        </div>

                        <div class="mb-3">
                          <div class="form-label">Title/Composer</div>
                          <div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;word-break: normal;"><?= $getContentInformations_title ?> <?= $getContentInformations_composer ?></div>
                        </div>


                        <div class="mb-3">
                          <div class="form-label">Reporting Date</div>
                          <div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;word-break: normal;"><?= $getReporting_date ?></div>
                        </div>

                        <div class="mb-3">
                          <div class="form-label">Reporting Message</div>
                          <div style="white-space:pre-line; border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: flex-start;word-break: normal;"><?= $getReporting_message ?></div>
                        </div>

                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>

            <td scope="col" style="word-break: break-all;"><a href="./assets/actions/delete_reporting_messages.php?id=<?= $getReporting_id ?>"><button class="btn btn-danger">Delete</button></a></td>

          </tr>
        <?php } ?>
      </tbody>
    </table>


<?php

    require('./assets/require/foot.php');
  } else {

    $bdd = null;
    header('location: /Diplome/index.php?error=040140');
    die();
  }
}

?>