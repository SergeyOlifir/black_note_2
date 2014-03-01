<? if(isset($post)): ?>
    <? if($post['status'] == 0): ?>
         <div class="alert alert-danger">Пост не прошел модерацию</div>
    <? endif; ?>
    <? if($post['status'] == 2): ?>
         <div class="alert alert-warning">Пост требует модерации</div>
    <? endif; ?>
    <? if($post['status'] == 3): ?>
         <div class="alert alert-success">Пост одобрен</div>
    <? endif; ?>
    <? if($post->organisation->status == 0): ?>
        <div class="alert alert-danger">Организауия <?= Fuel\Core\Html::anchor('/admin/organisation/view/' . $post->organisation->id, $post->organisation->title); ?> не одобрена</div>
    <? endif; ?>
    <? if($post->organisation->status == 1): ?>
        <div class="alert alert-danger">Организауия <?= Fuel\Core\Html::anchor('/admin/organisation/view/' . $post->organisation->id, $post->organisation->title); ?> требует модерации</div>
    <? endif; ?>
    <? if(count($post->organisation->unmoderated_filials()) > 0): ?>
         <div class="alert alert-danger">
             <span>Есть не одобренные филиалы</span>
             <ul>
                 <? foreach($post->organisation->unmoderated_filials() as $filial): ?>
                     <li><?= Fuel\Core\Html::anchor('/admin/filial/view/' . $filial->id, $filial->title) ?></li>
                 <? endforeach;?>
             </ul>
         </div>
    <? endif; ?>
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