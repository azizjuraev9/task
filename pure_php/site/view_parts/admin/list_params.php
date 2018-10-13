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
        Params
    </h2>

    <form action="admin.php" method="post">
        <table class="table">
            <div class="hidden">
                <input type="text" name="token" value="<?= App::$token ?>">
            </div>
            <?php foreach (AdminApp::$view_params['pitems'] as $item): ?>
            <tr>
                <td><label class="control-label"><?= $item['desc'] ?></label></td>
                <td>
                    <div class="form-group">
                        <input name="params[<?= $item['key'] ?>]" class="form-control" value="<?= $item['value'] ?>">
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <button type="submit" class="btn btn-warning" name="action" value="saveParams">Save</button>
    </form>

</div>
