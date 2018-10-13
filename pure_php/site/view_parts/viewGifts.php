<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.10.2018
 * Time: 10:34
 */
$gifts = App::$view_params['gifts'];

?>
<div class="container">
    <h2 class="page-header">
        Winnings
    </h2>

    <table class="table">
        <?php
        while($item = $gifts->fetch_assoc()):
            $title = $item['money']?$item['money'].' <span class="glyphicon glyphicon-euro"></span>' : $item['name'];
            ?>
            <tr>
                <td><img src="<?= $item['money']?'assets/imgs/money.png':$item['image'] ?>" width="100"></td>
                <td>
                    <h3><?= $title ?> <?= $item['status'] == 1 ? '<span class="label label-info">Sending</span>' : '<span class="label label-success">Sent</span>' ?> </h3>
                    <p><?= $item['time'] ?> </p>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>


</div>