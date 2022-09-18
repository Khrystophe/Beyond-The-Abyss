<?php
session_start();
if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
  if ($_SESSION['users']['type'] == 'admin') {

    require('./assets/require/head.php');
    require('./assets/require/co_bdd.php');
    require('./assets/require/functions.php');

    $reportings = getReporting($bdd);

?>


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

        foreach ($reportings as $reporting) {

          $reporting_id = htmlspecialchars($reporting['id']);
          $reporting_message = nl2br(htmlspecialchars($reporting['message']));
          $reporting_date = htmlspecialchars($reporting['date']);
          $reporting_id_users = htmlspecialchars($reporting['id_users']);
          $reporting_id_contents = htmlspecialchars($reporting['id_contents']);

          $user = getUserInformations($bdd, $reporting_id_users);

          $user_name = htmlspecialchars($user['name']);
          $user_lastname = htmlspecialchars($user['lastname']);
          $user_email = htmlspecialchars($user['email']);

          $getAllContents = getContentInformations($bdd, $reporting_id_contents);

          $content_title = htmlspecialchars($getAllContents['title']);
          $content_composer = htmlspecialchars($getAllContents['composer']);


        ?>

          <tr>
            <td scope="col" style="word-break: break-all;"><?= $reporting_id ?></td>
            <td scope="col" style="word-break: break-all;"><?= $reporting_date ?></td>
            <td scope="col" style="word-break: break-all;"><?= $reporting_id_users ?></td>
            <td scope="col" style="word-break: break-all;"><?= $reporting_id_contents ?></td>

            <td scope="col" style="word-break: break-all;">

              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#user_editModal<?= $reporting_id ?>">
                See
              </button>

              <div class="modal fade" id="user_editModal<?= $reporting_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">

                      <h5 class="modal-title" id="exampleModalLabel">Reporting</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                      <form method="post" action="./assets/actions/reply_action.php?id=<?= $reporting_id ?>" enctype="multipart/form-data">

                        <div class="mb-3">
                          <label for="admin_reporting_id_user<?= $reporting_id ?>" class="form-label">Reporting User id</label>
                          <input type="hidden" class="form-control" id="admin_reporting_id_user<?= $reporting_id ?>" name="id" value="<?= $reporting_id_users ?>">

                          <div style="width:10%; border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;"><?= $reporting_id_users ?></div>
                        </div>

                        <div class="mb-3">
                          <label for="admin_reporting_name<?= $reporting_id ?> class=" form-label">Name/Lastname</label>
                          <input type="hidden" class="form-control" id="admin_reporting_name<?= $reporting_id ?>" name="name" value="<?= $user_name ?>">

                          <label for="admin_reporting_lastname<?= $reporting_id ?> class=" form-label"></label>
                          <input type="hidden" class="form-control" id="admin_reporting_lastname<?= $reporting_id ?>" name="lastname" value="<?= $user_lastname ?>">

                          <div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;word-break: break-all;"><?= $user_name ?> <?= $user_lastname ?></div>
                        </div>

                        <div class="mb-3">
                          <div class="form-label">Email</div>
                          <div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;word-break: break-all;"><?= $user_email ?></div>
                        </div>

                        <div class="mb-3">
                          <div class="form-label">Reported Content id</div>
                          <div style="width:10%; border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;"><?= $reporting_id_contents ?></div>
                        </div>

                        <div class="mb-3">
                          <div class="form-label">Title/Composer</div>
                          <div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;word-break: break-all;"><?= $content_title ?> <?= $content_composer ?></div>
                        </div>


                        <div class="mb-3">
                          <div class="form-label">Reporting Date</div>
                          <div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;word-break: break-all;"><?= $reporting_date ?></div>
                        </div>

                        <div class="mb-3">
                          <div class="form-label">Reporting Message</div>
                          <div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: flex-start;word-break: break-all;"><?= $reporting_message ?></div>
                        </div>

                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>

            <td scope="col" style="word-break: break-all;"><a href="./assets/actions/delete_reporting_messages.php?id=<?= $reporting_id ?>"><button class="btn btn-danger">Delete</button></a></td>

          </tr>
        <?php } ?>
      </tbody>
    </table>


<?php

    require('./assets/require/foot.php');
  } else {

    header('location: /Diplome/index.php');
  }
}

?>