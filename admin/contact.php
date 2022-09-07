<?php
session_start();
if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
    if ($_SESSION['users']['type'] == 'admin') {

        require('./assets/require/head.php');
        require('./assets/require/co_bdd.php');
        require('./assets/require/functions.php');

        $contacts = getContact();

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

                ?>

                    <tr>
                        <td scope="col"><?= $contact['id'] ?></td>
                        <td scope="col" style="word-break:break-all" ;><?= $contact['message'] ?></td>
                        <td scope="col" style="word-break: break-all;"><?= $contact['date'] ?></td>
                        <td scope="col"><?= $contact['id_users'] ?></td>

                        <td scope="col">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#user_editModal<?= $contact['id'] ?>">
                                Reply
                            </button>
                            <div class="modal fade" id="user_editModal<?= $contact['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Reply</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form method="post" action="./assets/actions/reply_action.php?id=<?= $contact['id'] ?>" enctype="multipart/form-data">

                                                <div class="mb-3">
                                                    <label for="admin_contact_id_user<?= $contact['id'] ?>" class="form-label">User id</label>
                                                    <input type="hidden" class="form-control" id="admin_contact_id_user<?= $contact['id'] ?>" name="id" value="<?= $contact['id_users'] ?>">
                                                    <div style="width:10%; border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;"><?= $contact['id_users'] ?></div>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="form-label">Date</div>
                                                    <div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;word-break: break-all;"><?= $contact['date'] ?></div>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="form-label">Message</div>
                                                    <div style=" border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: flex-start;word-break: break-all;"><?= nl2br($contact['message']) ?></div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="admin_contact_message<?= $contact['id'] ?>"></label>
                                                    <div class="form-floating">
                                                        <input type="hidden" class="form-control" id="admin_contact_message<?= $contact['id'] ?>" name="message" value="<?= $contact['message'] ?>">
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="admin_contact_notification<?= $contact['id'] ?>">Reply</label>
                                                    <div class="form-floating">
                                                        <textarea class="form-control" id="admin_contact_notification<?= $contact['id'] ?>" style="height: 100px" name="notification"></textarea>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td scope="col"><a href="./assets/actions/delete_contact_messages.php?id=<?= $contact['id'] ?>">Delete</a></td>

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