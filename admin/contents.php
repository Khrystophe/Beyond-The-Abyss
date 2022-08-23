<?php

require('./assets/require/head.php');
require('./assets/require/co_bdd.php');
require('./assets/actions/function.php');

$getAllContents = getAllContents();
?>



<h1>Contents</h1>

<br>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add Contents
</button>
<br><br>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form method="post" action="../../Diplome/assets/actions/add_content_action.php?type=admin" enctype=" multipart/form-data">

                    <div class="mb-3">
                        <label for="admin_title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="admin_title" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="admin_composer" class="form-label">Composer</label>
                        <input type="text" class="form-control" id="admin_composer" name="composer" required>
                    </div>

                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Description" id="admin_description" style="height: 100px" name="description" onkeyup="javascript:MaxLengthDescription(this, 150);" required></textarea>
                            <label for="admin_description">Description</label>

                            <script>
                                function MaxLengthDescription(description, maxlength) {
                                    if (description.value.length > maxlength) {
                                        description.value = description.value.substring(0, maxlength);
                                        alert('Maximum ' + maxlength + 'characters!');
                                    }
                                }
                            </script>

                        </div>
                    </div>

                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="category" required>
                            <option value="">--Category--</option>
                            <option value="Tutorial">Tutorial</option>
                            <option value="Performance">Performances</option>
                            <option value="Sheet Music">Sheet Music</option>n>
                        </select>
                    </div>

                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="level" required>
                            <option value="">--Level--</option>
                            <option value="easy">Easy</option>
                            <option value="medium">Medium</option>
                            <option value="hard">Hard</option>
                            <option value="very-hard">Very Hard</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="admin_content" class="form-label"></label>
                        <input class="form-control" type="file" id="admin_content" name="content" required>
                    </div>

                    <div class="mb-3">
                        <label for="admin_free_content" class="form-label">Free Content</label>
                        <input type="checkbox" id="admin_free_content" name="free_content">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>


        </div>
    </div>
</div>


<table class="table">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Title</th>
            <th scope="col">Composer</th>
            <th scope="col">Content</th>
            <th scope="col">Category</th>
            <th scope="col">Level</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Likes</th>
            <th scope="col">id_users</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($getAllContents as $content) { ?>
            <tr>
                <th scope="col"><?= $content['id'] ?></th>
                <td scope="col"><?= $content['title'] ?></td>
                <td scope="col"><?= $content['composer'] ?></td>
                <td scope="col"><?= $content['content'] ?></td>
                <td scope="col"><?= $content['category'] ?></td>
                <td scope="col"><?= $content['level'] ?></td>
                <td scope="col" style="word-break:break-all"><?= $content['description'] ?></td>
                <td scope="col"><?= $content['price'] ?></td>
                <td scope="col"><?= $content['likes'] ?></td>
                <td scope="col"><?= $content['id_users'] ?></td>
                <td scope="col"><a href="../../Diplome/assets/actions/delete_action.php?id=<?= $content['id'] ?>&type=admin">Delete</a></td>
                <td>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#editModal<?= $content['id'] ?>">
                        Edit
                    </button>
                    <div class="modal fade" id="editModal<?= $content['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form method="post" action="../../Diplome/assets/actions/edit_content_action.php?type=admin" enctype=" multipart/form-data">

                                        <div class="mb-3">
                                            <label for="admin_edit_id" class="form-label"></label>
                                            <input type="text" class="form-control" id="admin_edit_id" name="id" value="<?= $content['id'] ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="admin_edit_title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="admin_edit_title" name="title" value="<?= $content['title'] ?>" placeholder="<?= $content['title'] ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="admin_edit_composer" class="form-label">Composer</label>
                                            <input type="text" class="form-control" id="admin_edit_composer" name="composer" value="<?= $content['composer'] ?>" placeholder="<?= $content['composer'] ?>">
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Description" id="admin_edit_description" style="height: 100px" name="description" onkeyup="javascript:MaxLengthDescription(this, 150);" value="<?= $content['description'] ?>"><?= $content['description'] ?></textarea>
                                                <label for="admin_edit_description">Description</label>

                                                <script>
                                                    function MaxLengthDescription(description, maxlength) {
                                                        if (description.value.length > maxlength) {
                                                            description.value = description.value.substring(0, maxlength);
                                                            alert('Maximum ' + maxlength + 'characters!');
                                                        }
                                                    }
                                                </script>

                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <select class="form-select" aria-label="Default select example" name="category">
                                                <option value="<?= $content['category'] ?>"><?= $content['category'] ?></option>
                                                <option value="Tutorial">Tutorial</option>
                                                <option value="Performance">Performances</option>
                                                <option value="Sheet Music">Sheet Music</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <select class="form-select" aria-label="Default select example" name="level">
                                                <option value="<?= $content['level'] ?>"><?= $content['level'] ?></option>
                                                <option value="easy">Easy</option>
                                                <option value="medium">Medium</option>
                                                <option value="hard">Hard</option>
                                                <option value="very-hard">Very Hard</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="admin_edit_content" class="form-label"></label>
                                            <input class="form-control" type="file" id="admin_edit_content" name="content">
                                        </div>

                                        <div class="mb-3">
                                            <label for="admin_edit_free_content" class="form-label">Free Content</label>
                                            <input type="checkbox" id="admin_edit_free_content" name="free_content">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<?php

require('./assets/require/foot.php'); ?>