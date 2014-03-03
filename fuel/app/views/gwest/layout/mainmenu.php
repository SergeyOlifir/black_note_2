<div class="collapse navbar-collapse">
    <div class="container">
        <ul class="nav navbar-nav pull-left">
            <ul class="nav navbar-nav pull-left">
                <li><a href="/">Главная</a></li>
                <li><a href="/gwest/content/article">Статьи</a></li>
                <li><a href="/gwest/organisation/index">Рейтинги</a></li>
                <li><a href="/posts">Жалобы/Благодарности</a></li>
                <li><a href="/gwest/content/zakon">Законодательство</a></li>
                <li><a href="/">О проекте</a></li>
            </ul>
        </ul>
        <ul class="nav navbar-nav pull-right">
            <li>
                <div class="dropdown accaunt-panel">
                    <? if(! \Auth\Auth::check()): ?>
                        <a href="#" class="dropdown-toggle" data-target="#login" data-toggle="modal">
                            Вход / Регистрация
                        </a>
                    <? else: ?>
                        <a href="#" class="dropdown-toggle" href="#" data-toggle="dropdown">
                           <?= \Auth\Auth::get('username');?>
                        </a>
                        <div aria-labelledby="dLabel" role="menu" class="dropdown-menu">
                            <div class="clearfix accaunts-controls-wrap">
                                <div class="pull-left accaunt-foto">
                                    <? if(\Auth\Auth::get('avatar')): ?>
                                        <img src="<?= Auth\Auth::get('avatar'); ?>">
                                    <? else: ?>
                                        <img src="/files/avatars/no_foto.jpg">
                                    <? endif; ?>
                                </div>
                                <div class="pull-right accaunt-controls">
                                    <ul>
                                        <li><a href="/user/messages">Сообщения</a></li>
                                        <li><a href="/user/post/create">Добавить пост</a></li>
                                        <li><a href="/user/post/published">Опубликованные посты</a></li>
                                        <li><a href="/user/post/draft">Черновики</a></li>
                                        <li><a href="/user/profile/edit">Настройки</a></li>
                                        <li><a href="/auth/logout">Выход</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <? endif;?>
                </div>
            </li>
        </ul>
    </div>
</div>

