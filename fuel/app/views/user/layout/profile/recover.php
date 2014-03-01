<div class="container edit-profile">
    <h2 class="caption"><?= __('profile.index.caption'); ?></h2>
    <?= Form::open(array('method' => 'post', 'role' => 'form')); ?>
        <div class="form-group <?= isset($errors['newpassword']) ? 'has-error' : ''; ?>">
            <label for="exampleInputEmail1">New Password</label>
            <?= Fuel\Core\Form::input('password', '', array('class' => 'form-control', 'type' => 'password')); ?>
            <?= isset($errors['password']) ? "<span class=\"help-block\">{$errors['password']}</span>" : ''; ?>
        </div>
        <div class="form-group <?= isset($errors['password']) ? 'has-error' : ''; ?>">
            <label for="exampleInputEmail1">Confirm Password</label>
            <?= Fuel\Core\Form::input('confpass', '', array('class' => 'form-control', 'type' => 'password')); ?>
            <?= isset($errors['confpass']) ? "<span class=\"help-block\">{$errors['confpass']}</span>" : ''; ?>
        </div>
        <div class="clearfix">
            <a href="/host/events/edit" class="btn btn-default pull-right btn-lg">Cancel</a>
            <button type="submit" class="btn btn-primary pull-right btn-lg">Update</button>
        </div>
    <?= Fuel\Core\Form::close(); ?>
</div>
