<?php
session_start();
if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
  if ($_SESSION['users']['type'] == 'admin') {

    require('./assets/require/head.php');
    require('./assets/require/co_bdd.php');
    require('./assets/require/functions.php');

    $notifications = getNotifications();

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

        ?>

          <tr>
            <td scope="col"><?= $notification['id'] ?></td>
            <td scope="col" style="word-break: break-all;"><?= nl2br($notification['notification']) ?></td>
            <td scope="col" style="word-break: break-all;"><?= $notification['date'] ?></td>
            <td scope="col"><?= $notification['id_users'] ?></td>
            <td scope="col"><a href="./assets/actions/delete_notifications_action.php?id=<?= $notification['id'] ?>">Delete</a></td>
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