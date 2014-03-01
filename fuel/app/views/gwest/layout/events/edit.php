<? if(!isset($event)): ?>
    <?= Request::forge('host/profile/index')->execute(); ?>
<? endif; ?>

<? if(isset($event)): ?>
    <section id="edit-event" class="edit-event">
        <?= render('host/layout/events/partials/header', array('event' => $event)); ?>
        <div class="row">
            <div class="col-md-5">
                <div class="modal-body">
                    <h4 class="row-title">Basic</h4>
                    <form role="form" id="editevent-form" action="/host/events/edit/<?= $event->id ?>">
                      <span class="label label-danger none"></span>
                      <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputEmail1" name="eventname" placeholder="Event Name" value="<?= $event->title ?>">
                        <p class="help-block">Event name</p>
                      </div>
                      <div class="form-group">
                          <textarea class="form-control" placeholder="Description" name="description"><?= $event->description; ?></textarea>
                          <p class="help-block">Description</p>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputEmail1" name="place" placeholder="Place" value="<?= $event->place ?>" >
                        <p class="help-block">Place</p>
                      </div>
                          <?php 
                          function get_os($user_agent) {
                                  $os = array(
                                      'Windows' => 'Win',
                                      'Open BSD' => 'OpenBSD',
                                      'Sun OS' => 'SunOS',
                                      'Linux' => '(Linux)|(X11)',
                                      'Mac OS' => '(Mac_PowerPC)|(Macintosh)',
                                      'QNX' => 'QNX',
                                      'BeOS' => 'BeOS',
                                      'OS/2' => 'OS/2'
                                  );
                                  foreach ($os as $key => $value) {
                                      if (preg_match('#' . $value . '#i', $user_agent))
                                          return $key;
                                  }
                                  return 'Unknown';
                          }
                          if(get_os($_SERVER['HTTP_USER_AGENT']) =='Mac OS'){ 
                          ?>
                                <input type="datetime" value="<?=\Fuel\Core\Date::forge($event->start_date)->format('my'); ?>" class="form-control" name="date">
                          <?php } else{ ?>
                                <div id="date-picker" class="input-group input-append date form_datetime" data-date="<?= \Fuel\Core\Date::forge($event->start_date)->format('my'); ?>" data-date-format="mm-dd-yyyy hh:ii" >
                                    <input value="<?= \Fuel\Core\Date::forge($event->start_date)->format('my'); ?>" class="form-control" name="date">
                                    <span class="input-group-addon add-on"><i class="icon-th glyphicon glyphicon-calendar"></i></span>
                                </div>
                          <?php } ?>
                      <p class="help-block">Date</p>
                      
                      <div class="form-group labeled">
                        <label>Uploaded photos will be</label>
                      </div>
                      <label class="checkbox-inline">
                        <input type="radio" name="public" id="optionsRadios1" value="1" <?= ($event->public) ? 'checked' : '' ?>> Visible
                      </label>
                      <label class="checkbox-inline">
                        <input type="radio" name="public" id="optionsRadios1" value="0" <?= (!$event->public) ? 'checked' : '' ?>> Invisible
                      </label>
                    </form>
                </div>
            </div>
            <div class="col-md-7">
                <h4 class="row-title">Pakage/Guests</h4>
                <div class="well well-sm">Status: <span class="info"><?= $event->status; ?></span></div>
                <div class="well well-sm">Code: <span class="info"><?= $event->code; ?></span></div>
                <ul>
                    <li>Activate at: <span class="info"><?= \Fuel\Core\Date::forge($event->start_date)->format('my'); ?></span></li>
                </ul>
                <div class="well well-sm">Pakage</div>
                <ul>
                    <li>Guest assignet: </li>
                    <li>Picture uploaded: </li>
                </ul>
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-lg" id="editevent-button">Update</button>
            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
        </div>
    </section>
<? endif; ?>
