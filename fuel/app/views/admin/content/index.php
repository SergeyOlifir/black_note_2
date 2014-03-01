<div class="btn-group">
    <?= Fuel\Core\Html::anchor('/admin/content/create', 'Добавить', array('class' => 'btn btn-default')); ?>
</div>
<div class="well">
    <? if(count($posts) > 0): ?>
        <? foreach($posts as $post): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= $post->title; ?></h3>
                </div>
                <div class="panel-body">
                    <?= $post->body; ?>
                </div>
                <div class="panel-footer clearfix">
                    <div class="well well-sm pull-left">
                        Создан: <?= Date::forge($post->created_at)->set_timezone('Europe/Kiev')->format("%m/%d/%Y %H:%M"); ?>
                    </div>
                    <div class="btn-group pull-right">
                        <?= Fuel\Core\Html::anchor('/admin/content/edit/' . $post->id, 'Редактировать', array('class' => 'btn btn-default')); ?>
                        <?= Fuel\Core\Html::anchor('/admin/content/delete/' . $post->id, 'Удалить', array('class' => 'btn btn-danger')); ?>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    <? else: ?>
        <h3>Статей пока нету( Но их можно добавить</h3>
    <? endif;?>
</div>