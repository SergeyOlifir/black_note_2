<? if(isset($post)): ?>
    <div class="well">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?= $post->title; ?>
                    <? if($post->status === '2'): ?><span class="label label-info">Ожидает модерации</span><? endif; ?>
                    <? if($post->status === '0'): ?><span class="label label-danger">Пост отклонен модератором</span><? endif; ?>
                </h3>
            </div>
            <div class="panel-body">
                <?= $post->body; ?>
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
                    <?= Fuel\Core\Html::anchor('/user/post/edit/' . $post->id, 'Редактировать', array('class' => 'btn btn-default')); ?>
                    <? if($post->status < 2) : ?>
                        <?= Fuel\Core\Html::anchor('/user/post/publish/' . $post->id, 'Отправить на модерацию', array('class' => 'btn btn-default')); ?>
                    <? endif; ?>
                    <?= Fuel\Core\Html::anchor('/user/post/delete/' . $post->id, 'Удалить', array('class' => 'btn btn-danger')); ?>
                </div>
            </div>
        </div>
    </div>
<? endif; ?>