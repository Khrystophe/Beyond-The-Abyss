<?php
session_start();
if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
    if ($_SESSION['users']['type'] == 'admin') {

        require('./assets/require/head.php');
        require('./assets/require/co_bdd.php');
        require('./assets/require/functions.php');

        $contacts = getContact($bdd);

?>


        <h1>contact</h1>

        <table class="table sortable">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Messages</th>
                    <th scope="col">Date</th>
                    <th scope="col">id_users</th>
                </tr>
            </thead>

            <tbody>

                <?php

                foreach ($contacts as $contact) {

                    $contact_id = htmlspecialchars($contact['id']);
                    $contact_message = nl2br(htmlspecialchars($contact['message']));
                    $contact_date = htmlspecialchars($contact['date']);
                    $contact_id_users = htmlspecialchars($contact['id_users']);

                    $user = getUserInformations($bdd, $contact_id_users);

                    $user_name = $user['name'];
                    $user_lastname = $user['lastname'];
                    $user_email = $user['email'];


                ?>

                    <tr>
                        <td scope="col"><?= $contact_id ?></td>
                        <td scope="col" style="word-break:break-all" ;><?= $contact_message  ?></td>
                        <td scope="col" style="word-break: break-all;"><?= $contact_date ?></td>
                        <td scope="col"><?= $contact_id_users ?></td>

                        <td scope="col">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#user_editModal<?= $contact_id ?>">
                                Reply
                            </button>
                            <div class="modal fade" id="user_editModal<?= $contact_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Reply</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form method="post" action="./assets/actions/reply_action.php?id=<?= $contact_id ?>" enctype="multipart/form-data">

                                                <div class="mb-3">
                                                    <label for="admin_contact_id_user<?= $contact_id ?>" class="form-label">User id</label>
                                                    <input type="hidden" class="form-control" id="admin_contact_id_user<?= $contact_id ?>" name="id" value="<?= $contact_id_users ?>">

                                                    <div style="width:10%; border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;"><?= $contact_id_users ?></div>
                                                </div>


                                                <div class="mb-3">
                                                    <label for="admin_contact_name<?= $contact_id ?> class=" form-label">Name/Lastname</label>
                                                    <input type="hidden" class="form-control" id="admin_contact_name<?= $contact_id ?>" name="name" value="<?= $user_name ?>">

                                                    <label for="admin_contact_lastname<?= $contact_id ?> class=" form-label"></label>
                                                    <input type="hidden" class="form-control" id="admin_contact_lastname<?= $contact_id ?>" name="lastname" value="<?= $user_lastname ?>">

                                                    <div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;word-break: break-all;"><?= $user_name ?> <?= $user_lastname ?></div>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="form-label">Email</div>
                                                    <div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;word-break: break-all;"><?= $user_email ?></div>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="form-label">Date</div>
                                                    <div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;word-break: break-all;"><?= $contact_date ?></div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="admin_contact_message<?= $contact_id ?>" class="form-label">Message</label>
                                                    <input type="hidden" class="form-control" id="admin_contact_message<?= $contact_id ?>" name="message" value="<?= $contact_message  ?>">

                                                    <div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: flex-start;word-break: break-all;"><?= $contact_message ?></div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="admin_contact_notification<?= $contact_id ?>" class="form-label">Reply</label>
                                                    <div class="form-floating">
                                                        <textarea class="form-control" id="admin_contact_notification<?= $contact_id ?>" style="height: 100px" name="notification"></textarea>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td scope="col"><a href="./assets/actions/delete_contact_messages.php?id=<?= $contact_id ?>">Delete</a></td>

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