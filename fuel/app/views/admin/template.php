<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <?= Asset::css('bootstrap.min.css'); ?>
    <?= Asset::css('style.css'); ?>
    <?= Asset::css('admin.css'); ?>
    
    <? if(isset($stylesheets)) : ?>
        <?= \Fuel\Core\Asset::css($stylesheets); ?>
    <? endif; ?>
    
    <?= Asset::js('jquery-2.0.3.min.js'); ?>
    <?= Asset::js('jquery.placeholder.js'); ?>
    <?= Asset::js('bootstrap.min.js'); ?>
    <?= Asset::js('application.js'); ?>
    <?= Asset::js('modernizr.custom.js'); ?>
    
    <? if(isset($scripts)) : ?>
        <?= \Fuel\Core\Asset::js($scripts); ?>
    <? endif; ?>
</head>
<body>
    <header>
        <div class="container">
            <h1 class="logo pull-left">Black Note</h1>
        </div>
        <nav  class="navbar navbar-default" role="navigation">
            <?= render('admin/layout/mainmenu'); ?>
        </nav>
    </header>
    <div class="container">
        <? if($messagess = e((array) Session::get_flash('notice'))): ?>
            <? foreach ($messagess as $messages) : ?>
                <?= render('_messages', array('messages' => $messages), false); ?>
            <? endforeach; ?>
        <? endif; ?>
        <div id="main" class="row-fluid">
            <?= isset($content) ? $content : '' ?>
        </div>
    </div>
</body>
</html>

