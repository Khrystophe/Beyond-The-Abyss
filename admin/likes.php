<?php
session_start();
if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
  if ($_SESSION['users']['type'] == 'admin') {

    require('./assets/require/head.php');
    require('./assets/require/co_bdd.php');
    require('./assets/require/functions.php');

    $likes = getLikes();

?>


    <h1>Likes</h1>

    <table class="table sortable">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Id_comments</th>
          <th scope="col">id_contents</th>
          <th scope="col">id_users</th>
        </tr>
      </thead>

      <tbody>

        <?php

        foreach ($likes as $like) {

        ?>

          <tr>
            <td scope="col"><?= $like['id'] ?></td>
            <td scope="col"><?= $like['id_comments'] ?></td>
            <td scope="col"><?= $like['id_contents'] ?></td>
            <td scope="col"><?= $like['id_users'] ?></td>
            <td scope="col"><a href="./assets/actions/delete_likes_action.php?id=<?= $like['id'] ?>">Delete</a></td>
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