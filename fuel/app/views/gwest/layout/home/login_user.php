<h3 class="all_articles_from_weak">Все статьи за неделю</h3>
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
                    <?= $post->preview; ?>
                </div>
                <div class="panel-footer clearfix">
                    <div class="well well-sm pull-left">
                        Создан: <?= Date::forge($post->created_at)->set_timezone('Europe/Kiev')->format("%m/%d/%Y %H:%M"); ?>
                    </div>
                    <div class="btn-group pull-right">
                        <?= Fuel\Core\Html::anchor('/gwest/content/view/' . $post->id, 'Подробнее', array('class' => 'btn btn-default')); ?>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    <? endif;?>
</div>

<h3 class="all_zakon_from_weak">Все законодательства за неделю</h3>
<div class="well">
    <? if(count($zakon) > 0): ?>
        <? foreach($zakon as $post): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <?= $post->title; ?>
                    </h3>
                </div>
                <div class="panel-body">
                    <?= $post->preview; ?>
                </div>
                <div class="panel-footer clearfix">
                    <div class="well well-sm pull-left">
                        Создан: <?= Date::forge($post->created_at)->set_timezone('Europe/Kiev')->format("%m/%d/%Y %H:%M"); ?>
                    </div>
                    <div class="btn-group pull-right">
                        <?= Fuel\Core\Html::anchor('/gwest/content/view/' . $post->id, 'Подробнее', array('class' => 'btn btn-default')); ?>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    <? endif;?>
</div>