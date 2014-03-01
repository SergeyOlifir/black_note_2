<?= \Fuel\Core\Form::open(array('method' => 'post', 'enctype' => 'multipart/form-data')); ?>
<?= \Fuel\Core\Form::file('image'); ?>
<?= \Fuel\Core\Form::input(array('text', 'name' => 'event_id', 'hidden' => 'hidden', 'value' => 3)); ?>
<?= \Fuel\Core\Form::input(array('text', 'name' => 'comment')); ?>
<?= \Fuel\Core\Form::submit('submit', 'go'); ?>
<?= \Fuel\Core\Form::close(); ?>
<?= \Fuel\Core\Html::img('files/events/event_10/eadf639a4e7adf0da0149ba05bdbc50d.png') ?>