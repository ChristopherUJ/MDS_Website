<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <?php
        echo Asset::css(array('bootstrap.min.css', 'bootstrap-responsive.min.css', 'style.css'));
        if (isset($css_includes))
            echo Asset::css($css_includes);
        echo Asset::js(array('jquery-1.7.2.min.js'));
        ?>
    </head>
    <body>
        <div class="navbar navbar-static-top">
            <div class="navbar-inner">
                <div class="container">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#" class="brand"><?php echo \Fuel\Core\Asset::img('logo_small.png'); ?> <span>Maritime Information System</span></a>
                    <div class="nav-collapse collapse">
                        <?php if ($current_user): ?>
                            <ul class="nav">
                                <li class="<?php echo Uri::segment(2) == '' ? 'active' : '' ?>">
                                    <?php echo Html::anchor('site', 'Start Session') ?>
                                </li>
                                <li class="<?php echo strpos(Uri::segment(2), 'vesselsinarea') === 0 ? 'active' : '' ?>">
                                    <?php echo Html::anchor('site/vesselsinarea', 'Vessel Stats') ?>
                                </li>
                                <li class="<?php echo strpos(Uri::segment(2), 'search') === 0 ? 'active' : '' ?>">
                                    <?php echo Html::anchor('site/search', 'Search') ?>
                                </li>
                                <?php if (Auth::member(100)) : ?>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            System
                                            <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <?php echo Html::anchor('admin/datasets', 'Datasets') ?>
                                            </li>
                                            <li>
                                                <?php echo Html::anchor('admin/users', 'Users') ?>
                                            </li>
                                            <li>
                                                <?php echo Html::anchor('admin/selectgroups', 'Select Groups') ?>
                                            </li>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            <ul class="nav pull-right">
                                <li class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo ucfirst($current_user->username); ?> <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><?php echo Html::anchor('site/logout', 'Logout') ?></li>
                                    </ul>
                                </li>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="span12">
                    <?php if (Session::get_flash('success')): ?>
                        <div class="alert alert-block">
                            <button class="close" data-dismiss="alert">×</button>
                            <strong>Success!</strong>
                            <p><?php echo implode('</p><p>', (array) Session::get_flash('success')); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (Session::get_flash('error')): ?>
                        <div class="alert alert-error">
                            <strong>Error!</strong>
                            <button class="close" data-dismiss="alert">×</button>
                            <p><?php echo implode('</p><p>', (array) Session::get_flash('error')); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <?php echo $content; ?>
            </div>
            <hr/>
            <footer>
                <p class="pull-right">All Rights Reserved. Marine Data Solutions</p>
            </footer>
        </div>
        <?php
        echo Asset::js(array('jquery-1.7.2.min.js', 'bootstrap.min.js'));
        if (isset($js_includes))
            echo Asset::js($js_includes);
        ?>
    </body>
</html>