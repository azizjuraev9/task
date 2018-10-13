<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.10.2018
 * Time: 20:14
 */
$values = AdminApp::$view_params['giftVal']
?>
<div class="container">
    <h2 class="page-header">
        Update gift
    </h2>
    <form action="admin.php?action=updateGift&id=<?= $values['id']; ?>" method="post" enctype="multipart/form-data">
        <?php if (isset(App::$errors['updateGift'])): ?>
            <div class="alert alert-danger" role="alert">
                <?= implode('<br>', App::$errors['updateGift']); ?>
            </div>
        <?php endif; ?>

        <div class="hidden">
            <input type="text" name="token" value="<?= App::$token ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="gift[name]" class="form-control" placeholder="Name" value="<?= $values['name'] ?>">
        </div>
        <div class="row">
            <div class="col-md-4">
                <img src="/<?= $values['image'] ?>" width="350">
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="exampleInputEmail1">Image</label>
                    <input type="file" name="image" class="form-control" placeholder="Image">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Amount</label>
            <input type="text" name="gift[amount]" class="form-control" placeholder="Amount" value="<?= $values['amount'] ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Status</label>
            <select name="gift[status]" class="form-control" placeholder="Status">
                <option value="1" <?=  $values['status'] == 1?'selected':'' ?>>Active</option>
                <option value="2" <?=  $values['status'] == 2?'selected':'' ?>>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="action" value="updateGift">Update</button>
    </form>
</div>

