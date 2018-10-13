<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.10.2018
 * Time: 10:12
 */
?>
<div class="container">
    <div id="carousel">
        <div id="pointer">
            <div></div>
        </div>
        <figure id="spinner">
            <?php foreach (Gifts::getAvailableGifts() as $item): ?>
                <div id="item-<?= $item['id'] ?>">
                    <div>
                        <img src="<?= $item['image'] ?>" class="img-responsive">
                    </div>
                    <h3><?= $item['name'] ?></h3>
                </div>
            <?php endforeach; ?>
        </figure>
    </div>
    <center>
        <div id="rotate" class="btn btn-warning">Rotate (<?= App::$params->get('rotate_cost') ?> units)</div>
    </center>
</div>



<div class="modal fade" id="result-modal"
     tabindex="-1"
     role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Rotation result</h4>
            </div>
            <div class="modal-body">

                <div id="result-content">

                </div>

            </div>
        </div>
    </div>
</div>
