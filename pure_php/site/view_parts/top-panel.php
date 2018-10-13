<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.10.2018
 * Time: 18:10
 */
?>


    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Roulette</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php if (App::$user->username): ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/">Main</a></li>
                        <li><a href="/?action=viewGifts">Winnings</a></li>
                        <li><a><span class="glyphicon glyphicon-piggy-bank"></span> Units: <span id="units"><?= (int)App::$user->units ?></span></a></li>
                        <li>
                            <a href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?= App::$user->username ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/?action=logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php else: ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#register-modal">Register</a></li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>
<?php if (!(bool)App::$user->username): ?>
    <div class="modal fade" data-aopen="<?= isset(App::$errors['login']) ? 'true' : '' ?>" id="login-modal"
         tabindex="-1"
         role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Login</h4>
                </div>
                <div class="modal-body">

                    <?php if (isset(App::$errors['login'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= implode('<br>', App::$errors['login']); ?>
                        </div>
                    <?php endif; ?>

                    <form action="/" method="post">
                        <div class="hidden">
                            <input type="text" name="token" value="<?= App::$token ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary" name="action" value="login">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" data-aopen="<?= isset(App::$errors['register']) ? 'true' : 'false' ?>" id="register-modal"
         tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Register</h4>
                </div>
                <div class="modal-body">

                    <form action="/" method="post">
                        <?php if (isset(App::$errors['register'])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= implode('<br>', App::$errors['register']); ?>
                            </div>
                        <?php endif; ?>

                        <div class="hidden">
                            <input type="text" name="token" value="<?= App::$token ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Repeat password</label>
                            <input type="password" name="password2" class="form-control" placeholder="Repeat password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Last Name</label>
                            <input type="text" name="lastname" class="form-control" placeholder="Last Name">
                        </div>
                        <button type="submit" class="btn btn-primary" name="action" value="register">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>