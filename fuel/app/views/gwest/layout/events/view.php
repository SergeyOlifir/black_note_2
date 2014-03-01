<section id="view-foto-event" class="view-foto-event">
    <nav>
        <h3 class="caption">Image Events</h3>
        <div class="row">
            <? foreach ($event->images as $image): ?>
                <div class="col-md-3 col-xs-12 col-sm-3">
                    <div class="event pull-left">
                        <div class="event-inner">
                            <?= \Fuel\Core\Html::img('files/events/event_' . $event->id . '/' . $image['thumb_middle']); ?></li>
                            <div class="overlay"></div>
                            <div class="buttons-area clearfix">
                                <a href="<?= '/files/events/event_' . $event->id . '/' . $image['thumb_large']; ?>" rel="lightbox" class="zoom-button" >Zoom</a>
                                <a href="/host/events/delete/<?= $image->id; ?>" class="delete-button" title="Delete">Delete</a>
                            </div>
                        </div>
                        <div class="description-event-img">
                            <?= $image->comment ?>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </nav>
</section>
