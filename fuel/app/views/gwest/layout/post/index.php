<?= Form::open(array('method' => 'post', 'role' => 'form', 'class' => 'add-post')); ?>
    <fieldset>
        <div class="form-group">
            <label>Месторасположение</label>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="form-control location" val="<?= isset($input['country_id']) ? $input['country_id'] : ''; ?>"  name="country_id" param="" action="<?= \Fuel\Core\Uri::create('/location/country/'); ?>" ></select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="form-control location" val="<?= isset($input['region_id']) ? $input['region_id'] : ''; ?>" name="region_id" param="" action="<?= \Fuel\Core\Uri::create('/location/region/'); ?>" ></select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="form-control location" val="<?= isset($input['sity_id']) ? $input['sity_id'] : ''; ?>" name="sity_id" param="" action="<?= \Fuel\Core\Uri::create('/location/sity/'); ?>"></select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <input type="text" name="query" value="<?= isset($input['query']) ? $input['query'] : ''; ?>" class="form-control" placeholder="Введите ключевые слова в поиск..."/>
                        <p class="help-block">Пример: Название товара или услуги плохого качества…</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <button class="btn btn-default btn-block" type="submit">Поиск</button>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
<?= Fuel\Core\Form::close(); ?>
<ul class="nav nav-tabs nav-justified">
    <li><a href="/gwest/posts/index/1">Продавцы</a></li>
    <li><a href="/gwest/posts/index/2">Исполнители</a></li>
    <li><a href="/gwest/posts/index/3">Работодатели</a></li>
    <li><a href="/gwest/posts/index/4">Работники</a></li>
    <li><a href="/gwest/posts/index/5">Партнеры</a></li>
    <li><a href="/gwest/posts/index/6">Заказчики</a></li>
    <li><a href="/gwest/posts/index/7">Покупатели</a></li>
    <li><a href="/gwest/posts/">Bce</a></li>
</ul>
<div class="well">
    <? if(count($posts) > 0): ?>
        <? foreach($posts as $post): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <?= $post->title; ?>
                    </h3>
                </div>
                <div class="panel-body">
                    <?= substr($post->body, 0, 1000); ?>
                </div>
                <div class="panel-footer clearfix">
                    <div class="well well-sm pull-left">
                        Создан: <?= Date::forge($post->created_at)->set_timezone('Europe/Kiev')->format("%m/%d/%Y %H:%M"); ?>
                    </div>
                    <div class="well well-sm pull-left">
                        Организация: <?= Fuel\Core\Html::anchor('/gwest/organisation/view/' . $post->organisation->id, $post->organisation->title); ?>
                    </div>
                    <div class="well well-sm pull-left">
                        Пользователь: <?= Fuel\Core\Html::anchor('/gwest/user/view/' . $post->user->id, $post->user->username); ?>
                    </div>
                    <div class="btn-group pull-right">
                        <?= Fuel\Core\Html::anchor('/gwest/posts/view/' . $post->id, 'Подробнее', array('class' => 'btn btn-default')); ?>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
        
        <?= (Fuel\Core\Pagination::instance('draftspafination')) ? Pagination::instance('draftspafination')->render() : ''; ?>
    <? else: ?>
        <h3>Статей пока нету( Но их можно добавить</h3>
    <? endif;?>
</div>