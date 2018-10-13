<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.10.2018
 * Time: 11:32
 */
$gifts = App::$view_params['gifts'];
if (!isset($_GET['winning'])) {
    $_GET['winning'] = [
        'username' => null,
        'gift_name' => null,
        'status' => null,
        'money' => null,
    ];
}
?>
<div class="container">
    <h2 class="page-header">
        Winnings
    </h2>

    <form action="admin.php" method="get">
        <div class="hidden">
            <input type="text" name="action" value="winnings">
        </div>
        <div class="col-md-11">
            <div class="col-md-3">
                <div class="form-group">

                    <input type="text" class="form-control" name="winning[username]" placeholder="Username"
                           value="<?= $_GET['winning']['username'] ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" class="form-control" name="winning[gift_name]" placeholder="Gift Name"
                           value="<?= $_GET['winning']['gift_name'] ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <select name="winning[status]" class="form-control" placeholder="Status">
                        <option value="">-- Status --</option>
                        <option value="1" <?= $_GET['winning']['status'] == 1 ? 'selected' : '' ?>>Sending</option>
                        <option value="2" <?= $_GET['winning']['status'] == 2 ? 'selected' : '' ?>>Sent</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" class="form-control" name="winning[money]" placeholder="Money"
                           value="<?= $_GET['winning']['money'] ?>">
                </div>
            </div>
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-warning">Search</button>
        </div>

    </form>

    <table class="table">
        <?php
        while ($item = $gifts->fetch_assoc()):
            $title = $item['money'] ? $item['money'] . ' <span class="glyphicon glyphicon-euro"></span>' : $item['name'];
            ?>
            <tr>
                <td><img src="/<?= $item['money'] ? 'assets/imgs/money.png' : $item['image'] ?>" width="100"></td>
                <td>
                    <h3><?= $title ?> <?= $item['status'] == 1 ? '<span class="label label-info">Sending</span>' : '<span class="label label-success">Sent</span>' ?> </h3>
                    <p>
                        <?= $item['time'] ?>
                        <b><span class="glyphicon glyphicon-user"></span> <?= $item['username'] ?></b>
                    </p>
                </td>
                <td>
                    <?php if ($item['gift_id'] != 0 && $item['status'] != 2): ?>
                        <a href="admin.php?action=send&id=<?= $item['id'] ?>&token=<?= AdminApp::$token ?>"
                           class="btn btn-success">Send</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

</div>

