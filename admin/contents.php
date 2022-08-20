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
    Ajouter un produit
</button>
<br><br>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un produit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="./assets/produits/addproduct.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Nom du produit</label>
                        <input type="text" class="form-control" id="productName" name="nom">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Prix</label>
                        <input type="text" class="form-control" id="price" name="prix">
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="contenu"></textarea>
                            <label for="floatingTextarea2">Description</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control" type="file" id="formFile" name="image">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="id_categorie">
                            <option selected>Catégorie</option>
                            <?php foreach ($categorie as $cat) { ?>
                                <option value="<?= htmlspecialchars($cat['id']) ?>">
                                    <?= htmlspecialchars($cat['name']) ?></option>
                            <?php } ?>
                        </select>
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
                <td scope="col"><?= $content['description'] ?></td>
                <td scope="col"><?= $content['price'] ?></td>
                <td scope="col"><?= $content['likes'] ?></td>
                <td scope="col"><?= $content['id_users'] ?></td>
                <td scope="col"><a href="./assets/actions/delete_content_action.php?id=<?= $content['id'] ?>">Supprimer</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<?php

require('./assets/require/foot.php'); ?>