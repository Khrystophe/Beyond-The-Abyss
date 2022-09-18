<?php
session_start();
if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
  if ($_SESSION['users']['type'] == 'admin') {

    require('./assets/require/head.php');
    require('./assets/require/co_bdd.php');
    require('./assets/require/functions.php');

    $notifications = getNotifications($bdd);

?>


    <h1>Notifications</h1>

    <table class="table sortable">
      <thead>
        <tr>
          <th scope="col" style="word-break: break-all;">id</th>
          <th scope="col" style="word-break: break-all;">Date</th>
          <th scope="col" style="word-break: break-all;">id_users</th>
        </tr>
      </thead>

      <tbody>

        <?php foreach ($notifications as $notification) {

          $notification_id = htmlspecialchars($notification['id']);
          $notification_message = nl2br(htmlspecialchars($notification['notification']));
          $notification_date = htmlspecialchars($notification['date']);
          $notification_id_users = htmlspecialchars($notification['id_users']);

          $user = getUserInformations($bdd, $notification_id_users);

          $user_name = htmlspecialchars($user['name']);
          $user_lastname = htmlspecialchars($user['lastname']);
          $user_email = htmlspecialchars($user['email']);


        ?>

          <tr>
            <td scope="col" style="word-break: break-all;"><?= $notification_id ?></td>
            <td scope="col" style="word-break: break-all;"><?= $notification_date ?></td>
            <td scope="col" style="word-break: break-all;"><?= $notification_id_users ?></td>

            <td scope="col" style="word-break: break-all;">

              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#user_editModal<?= $notification_id ?>">
                See
              </button>

              <div class="modal fade" id="user_editModal<?= $notification_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">

                      <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                      <form method="post" action="./assets/actions/reply_action.php?id=<?= $notification_id ?>" enctype="multipart/form-data">

                        <div class="mb-3">
                          <label for="admin_notification_id_user<?= $notification_id ?>" class="form-label">Notification User id</label>
                          <input type="hidden" class="form-control" id="admin_notification_id_user<?= $notification_id ?>" name="id" value="<?= $notification_id_users ?>">

                          <div style="width:10%; border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;"><?= $notification_id_users ?></div>
                        </div>

                        <div class="mb-3">
                          <label for="admin_notification_name<?= $notification_id ?> class=" form-label">Name/Lastname</label>
                          <input type="hidden" class="form-control" id="admin_notification_name<?= $notification_id ?>" name="name" value="<?= $user_name ?>">

                          <label for="admin_notification_lastname<?= $notification_id ?> class=" form-label"></label>
                          <input type="hidden" class="form-control" id="admin_notification_lastname<?= $notification_id ?>" name="lastname" value="<?= $user_lastname ?>">

                          <div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;word-break: break-all;"><?= $user_name ?> <?= $user_lastname ?></div>
                        </div>

                        <div class="mb-3">
                          <div class="form-label">notification Date</div>
                          <div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;word-break: break-all;"><?= $notification_date ?></div>
                        </div>

                        <div class="mb-3">
                          <div class="form-label">Notification Message</div>
                          <div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: flex-start;word-break: break-all;"><?= $notification_message ?></div>
                        </div>

                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>

            <td scope="col" style="word-break: break-all;"><a href="./assets/actions/delete_notifications_action.php?id=<?= $notification_id ?>"><button class="btn btn-danger">Delete</button></a></td>
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