<section id="profile">
    <h2 class="caption"><?= __('profile.index.caption'); ?></h2>
    <div class="row">
        <div class="col-md-3">
            <h3>Name</h3>
            <span><?= Auth::get('username'); ?></span>
        </div>
        <div class="col-md-3">
            <h3>Password</h3>
            <span>*******</span>
        </div>
        <div class="col-md-3">
            <h3>Zip Code</h3>
            <span><?= Auth::get('zip'); ?></span>
        </div>
        <div class="col-md-3">
            <a href="/host/profile/edit" class="btn btn-default btn-rounded btn-edit">Edit</a>
        </div>
    </div>

    
</section>
