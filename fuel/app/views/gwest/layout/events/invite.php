<?//= Request::forge('host/profile/index')->execute(); ?>

<? if(isset($event)): ?>
    <section id="invite-event" class="edit-event">
        <?= render('host/layout/events/partials/header', array('event' => $event)); ?>
        
        <div class="container invite">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Code</h3>
                </div>
                <div class="panel-body">
                    <h2><?= $event->code; ?></h2>
                </div>
            </div>
            
            <div class="alert invite"></div>
            
            <form class="form-horizontal" id="sedmail-form" role="form" method="post" action="/host/events/invite/<?= $event->id; ?>">
                <div class="form-group">
                  <label for="inputEmail1" class="col-lg-2 control-label">Recipients*</label>
                  <div class="col-lg-10">
                      <input type="text" class="form-control" id="inputEmail1" name="recipients" placeholder="Recipients" required="">
                      <p class="help-block">Please add emails guests devided by ;</p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword1" class="col-lg-2 control-label">Subject*</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="inputPassword1" name="subject" placeholder="Subject" required="" value="<?= __('events.invite.mail.subject', array('name' => $event->title, 'uri' => Uri::base())); ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword1" class="col-lg-2 control-label">Message*</label>
                  <div class="col-lg-10">
                      <? $activa = ($event->start_date > time() ? __('events.invite.mail.not_activate', array('date' => \Fuel\Core\Date::forge((int)$event->start_date)->format('us_named'))) : __('events.invite.mail.activate')); ?>
                      <textarea rows="10" type="text" class="form-control" name="message" id="inputPassword1" placeholder="Message"><?= __('events.invite.mail.body', array('name' => $event->title, 'applink' => 'http://google.com', 'code' => $event->code, 'hostname' => Auth::get('username'), 'description' => $event->description, 'location' => $event->place, 'startdate' => \Fuel\Core\Date::forge((int)$event->start_date)->format('us_named'), 'activate' => $activa)); ?></textarea>
                  </div>
                </div>
                
            </form>
                <div class="form-group clearfix">
                    <button id="sedmail-button" class="btn btn-primary btn-lg pull-right">Send</button>
                </div>
        </div>
    </section>
<? endif; ?>

