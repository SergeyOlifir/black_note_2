 <? if(! \Auth\Auth::check()): ?>
        <?= render('gwest/layout/home/not_login_user'); ?>
    <?  else : ?>
        <?= render('gwest/layout/home/login_user', array('posts' => $posts, 'zakon' => $zakon), FALSE); ?>
    <? endif; ?>