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
          <th scope="col">id</th>
          <th scope="col">Notification</th>
          <th scope="col">Date</th>
          <th scope="col">id_users</th>
        </tr>
      </thead>

      <tbody>

        <?php

        foreach ($notifications as $notification) {

          $notification_id = htmlspecialchars($notification['id']);
          $notification_text = nl2br(htmlspecialchars($notification['notification']));
          $notification_date = htmlspecialchars($notification['date']);
          $notification_id_users = htmlspecialchars($notification['id_users']);

        ?>

          <tr>
            <td scope="col"><?= $notification_id ?></td>
            <td scope="col" style="word-break: break-all;"><?= $notification_text ?></td>
            <td scope="col" style="word-break: break-all;"><?= $notification_date ?></td>
            <td scope="col"><?= $notification_id_users ?></td>
            <td scope="col"><a href="./assets/actions/delete_notifications_action.php?id=<?= $notification_id ?>">Delete</a></td>
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