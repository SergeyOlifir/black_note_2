<? if(isset($post)): ?>
    <div class="well">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?= $post->title; ?>
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
                    Организация: <?= Fuel\Core\Html::anchor('/admin/organisation/view/' . $post->organisation->id, $post->organisation->title); ?>
                </div>
                <div class="well well-sm pull-left">
                    Пользователь: <?= Fuel\Core\Html::anchor('/gwest/user/view/' . $post->user->id, $post->user->username); ?>
                </div>
                <div class="btn-group pull-right">
                    <? if($post->status < 3) : ?>
                        <?= Fuel\Core\Html::anchor('/admin/post/upruve/' . $post->id, 'Принять', array('class' => 'btn btn-default')); ?>
                    <? endif; ?>
                    <?= Fuel\Core\Html::anchor('/admin/post/unupruve/' . $post->id, 'Не принять', array('class' => 'btn btn-danger')); ?>
                </div>
            </div>
        </div>
    </div>
<? endif; ?>