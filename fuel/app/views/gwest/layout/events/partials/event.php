<div class="col-md-4 col-xs-12 col-sm-4">
    <a href="<?= Uri::create("host/events/edit/{$events->id}"); ?>" class="pull-left event-link">
        <div class="event">
            <div class="event-inner <? if ($class) echo $class ?>">
                <?
                if (!empty($events->images)) {
                    foreach ($events->images as $images):
                        $image[] = $images->thumb_middle;
                    endforeach;
                    $image = array_reverse($image);
                }
                if (!empty($image)) {
                    if ($class == 'horizontal') {
                        if (count($image) >= 3) {
                            ?>
                            <div class='first-img pull-left'><?= \Fuel\Core\Html::img('files/events/event_' . $events->id . '/' . $image[0]) ?></div>    
                            <div class='second-img pull-left'><?= \Fuel\Core\Html::img('files/events/event_' . $events->id . '/' . $image[1]) ?></div>
                            <div class='third-img pull-left'><?= \Fuel\Core\Html::img('files/events/event_' . $events->id . '/' . $image[2]) ?></div>
                        <? } elseif (count($image) != 0) { ?>
                            <div class='image-full'><?= \Fuel\Core\Html::img('files/events/event_' . $events->id . '/' . $image[0]) ?></div>
                            <?
                        }
                    } elseif ($class == 'vertical') {
                        if (count($image) >= 3) {
                            ?>
                            <div class='first-img'><?= \Fuel\Core\Html::img('files/events/event_' . $events->id . '/' . $image[0]) ?></div>    
                            <div class='second-img pull-left'><?= \Fuel\Core\Html::img('files/events/event_' . $events->id . '/' . $image[1]) ?></div>
                            <div class='third-img pull-left'><?= \Fuel\Core\Html::img('files/events/event_' . $events->id . '/' . $image[2]) ?></div>
                        <? } elseif (count($image) != 0) { ?>
                            <div class='image-full'><?= \Fuel\Core\Html::img('files/events/event_' . $events->id . '/' . $image[0]) ?></div>
                            <?
                        }
                    }
                } else {
                    ?>   
                    <h4>
                        NO Photos
                    </h4>
                <? } ?>
            </div>
            <h3><?= $events->title; ?></h3>
            <span><?= \Fuel\Core\Date::forge((int) $events->start_date)->format('us_named_time'); ?></span>
        </div>
    </a>
</div>