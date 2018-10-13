<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.10.2018
 * Time: 14:56
 */
?>

<div class="container">
    <h2 class="page-header">
        Available Gifts
    </h2>

    <p>
        <a href="" class="btn btn-warning" data-toggle="modal" data-target="#add-modal">Add new</a>
    </p>

    <table class="table">
        <div class="hidden">
            <input type="text" name="token" value="<?= App::$token ?>">
        </div>
        <?php foreach (AdminApp::$view_params['gitems'] as $item): ?>
            <tr>
                <td><img src="/<?= $item['image'] ?>" width="100"></td>
                <td>
                    <h3><?= $item['name'] ?> <?= $item['status'] == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>' ?> </h3>
                    <p>
                        <a href="admin.php?action=updateGift&id=<?= $item['id']; ?>">Update</a> |
                        <a href="admin.php?action=deleteGift&id=<?= $item['id']; ?>&token=<?= AdminApp::$token; ?>">Delete</a>
                    </p>
                </td>
                <td>
                    <h1>X<?= $item['amount']; ?></h1>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>


</div>


<div class="modal fade" data-aopen="<?= isset(AdminApp::$errors['addGift']) ? 'true' : 'false' ?>" id="add-modal"
     tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add new</h4>
            </div>
            <div class="modal-body">

                <form action="admin.php?action=gifts" method="post" enctype="multipart/form-data">
                    <?php if (isset(App::$errors['addGift'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= implode('<br>', App::$errors['addGift']); ?>
                        </div>
                    <?php endif; ?>

                    <div class="hidden">
                        <input type="text" name="token" value="<?= App::$token ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="gift[name]" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <input type="file" name="image" class="form-control" placeholder="Image">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Amount</label>
                        <input type="text" name="gift[amount]" class="form-control" placeholder="Amount">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Status</label>
                        <select name="gift[status]" class="form-control" placeholder="Status">
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="action" value="addGift">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>