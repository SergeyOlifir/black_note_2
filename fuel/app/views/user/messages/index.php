<div class="well">
    <? if(isset($messages)): ?>
        <? foreach($messages as $message): ?>
            <div class="panel panel-<?= $message->type; ?>">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse_<?= $message->id; ?>">
                            <?= $message->title; ?>
                        </a>
                  </h4>
                </div>
                <div id="collapse_<?= $message->id; ?>" class="panel-collapse collapse">
                  <div class="panel-body">
                      <?= $message->message; ?>
                  </div>
                </div>
            </div>
        <? endforeach; ?>
    <? endif;?>
</div>

