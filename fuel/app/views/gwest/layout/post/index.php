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
        <?= Pagination::instance('draftspafination')->render(); ?>
    <? else: ?>
        <h3>Статей пока нету( Но их можно добавить</h3>
    <? endif;?>
</div>