<?php
session_start();
if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
    if ($_SESSION['users']['type'] == 'admin') {

        require('./assets/require/head.php');
        require('./assets/require/co_bdd.php');
        require('./assets/require/functions.php');

        $getAllContents = getAllContents();

?>


        <h1>Contents</h1>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Contents
        </button>
        <br><br>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add content</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="../../Diplome/assets/actions/add_content_action.php?type=admin" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="admin_title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="admin_title" name="title" required>
                            </div>

                            <div class="mb-3">
                                <label for="admin_composer" class="form-label">Composer</label>
                                <input type="text" class="form-control" id="admin_composer" name="composer" required>
                            </div>

                            <div class="mb-3">
                                <label for="admin_description">Description</label>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Description" id="admin_description" style="height: 100px" name="description" onkeyup="javascript:MaxLengthDescription(this, 150);" required></textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="admin_category">Level</label>
                                <select class="form-select" aria-label="Default select example" id="admin_category" name="category" required>
                                    <option value="">--Category--</option>
                                    <option value="tutorial">Tutorial</option>
                                    <option value="performance">Performances</option>
                                    <option value="sheet_music">Sheet Music</option>n>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="admin_level">Level</label>
                                <select class="form-select" aria-label="Default select example" id="admin_level" name="level" required>
                                    <option value="">--Level--</option>
                                    <option value="easy">Easy</option>
                                    <option value="medium">Medium</option>
                                    <option value="hard">Hard</option>
                                    <option value="very-hard">Very Hard</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="admin_content_add" class="form-label"></label>
                                <input class="form-control" type="file" id="admin_content_add" name="content" onchange="javascript: return validContent('_add')" required>
                            </div>

                            <div class="mb-3">
                                <label for="admin_price" class="form-label">Price : from 1 to 50 or free (type 'Free')</label>
                                <input type="text" id="admin_price" pattern="^([1-9]|[1-4][0-9]|50|Free)$" name="price" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>


        <table class="table sortable">
            <thead>
                <tr>
                    <th scope="row">id</th>
                    <th scope="row">Title</th>
                    <th scope="row">Composer</th>
                    <th scope="row">Content</th>
                    <th scope="row">Category</th>
                    <th scope="row">Level</th>
                    <th scope="row">Description</th>
                    <th scope="row">Price</th>
                    <th scope="row">Likes</th>
                    <th scope="row">id_users</th>
                </tr>
            </thead>

            <tbody>

                <?php

                foreach ($getAllContents as $content) {

                ?>


                    <tr>
                        <td scope="col"><?= $content['id'] ?></td>
                        <td scope="col" style="word-break: break-all;"><?= $content['title'] ?></td>
                        <td scope="col" style="word-break: break-all;"><?= $content['composer'] ?></td>
                        <td scope="col"><?= $content['content'] ?></td>
                        <td scope="col"><?= $content['category'] ?></td>
                        <td scope="col"><?= $content['level'] ?></td>
                        <td scope="col" style="word-break: break-all;"><?= $content['description'] ?></td>
                        <td scope="col"><?= $content['price'] ?></td>
                        <td scope="col"><?= $content['likes'] ?></td>
                        <td scope="col"><?= $content['id_users'] ?></td>

                        <td>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#content_editModal<?= $content['id'] ?>">
                                Edit
                            </button>
                            <div class="modal fade" id="content_editModal<?= $content['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form method="post" action="../../Diplome/assets/actions/edit_content_action.php?type=admin" enctype="multipart/form-data">

                                                <div class="mb-3">
                                                    <label for="admin_edit_id<?= $content['id'] ?>" class="form-label">Content id</label>
                                                    <input type="hidden" class="form-control" id="admin_edit_id<?= $content['id'] ?>" name="id" value="<?= $content['id'] ?>">
                                                    <div style="width:15%; border-color: #c4c4e9; border-style:solid; border-width: 1px; border-radius: 6px; display: flex; justify-content: center;"><?= $content['id'] ?></div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="admin_edit_id_users<?= $content['id'] ?>" class="form-label">Id users</label>
                                                    <input type="text" class="form-control" id="admin_edit_id_users<?= $content['id'] ?>" name="id_users" value="<?= $content['id_users'] ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="admin_edit_title<?= $content['id'] ?>" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="admin_edit_title<?= $content['id'] ?>" name="title" value="<?= $content['title'] ?>" placeholder="<?= $content['title'] ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="admin_edit_composer<?= $content['id'] ?>" class="form-label">Composer</label>
                                                    <input type="text" class="form-control" id="admin_edit_composer<?= $content['id'] ?>" name="composer" value="<?= $content['composer'] ?>" placeholder="<?= $content['composer'] ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="admin_edit_description<?= $content['id'] ?>">Description</label>
                                                    <div class="form-floating">
                                                        <textarea class="form-control" id="admin_edit_description<?= $content['id'] ?>" style="height: 100px" name="description" onkeyup="javascript:MaxLengthDescription(this, 150);" value="<?= $content['description'] ?>"><?= $content['description'] ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="admin_edit_category<?= $content['id'] ?>">Category</label>
                                                    <select class="form-select" id="admin_edit_category<?= $content['id'] ?>" aria-label="Default select example" name="category">
                                                        <option value="<?= $content['category'] ?>"><?= $content['category'] ?></option>
                                                        <option value="tutorial">Tutorial</option>
                                                        <option value="performance">Performances</option>
                                                        <option value="sheet_music">Sheet Music</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="admin_edit_level<?= $content['id'] ?>">Level</label>
                                                    <select class="form-select" id="admin_edit_level<?= $content['id'] ?>" aria-label="Default select example" name="level">
                                                        <option value="<?= $content['level'] ?>"><?= $content['level'] ?></option>
                                                        <option value="easy">Easy</option>
                                                        <option value="medium">Medium</option>
                                                        <option value="hard">Hard</option>
                                                        <option value="very-hard">Very Hard</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="admin_content<?= $content['id'] ?>" class="form-label">Content</label>
                                                    <input class="form-control" type="file" id="admin_content<?= $content['id'] ?>" name="content" onchange="javascript: return validContent(<?= $content['id'] ?>)">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="admin_edit_price<?= $content['id'] ?>" class="form-label">Price : from 1 to 50 or free (type 'Free')</label>
                                                    <input type="text" id="admin_edit_price<?= $content['id'] ?>" pattern="^([1-9]|[1-4][0-9]|50|Free)$" name="price" value="<?= $content['price'] ?>" placeholder="<?= $content['price'] ?>">
                                                </div>

                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td scope="col"><a href="../../Diplome/assets/actions/delete_content_action.php?id=<?= $content['id'] ?>&type=admin">Delete</a></td>
                    </tr>

                <?php

                }

                ?>

            </tbody>
        </table>


<?php

        require('./assets/require/foot.php');
    } else {

        header('location: /Diplome/index.php');
    }
}

?>