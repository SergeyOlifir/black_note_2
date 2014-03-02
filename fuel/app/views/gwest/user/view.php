<div class="well">
    <div class="form-horizontal">
        <fieldset>
        
            <legend>
                <?= $user->username; ?>
            </legend>
            <div class="">
                <a href="#">
                    <? if(isset($user->avatar)): ?>
                        <img class="user-avatar" src="<?= $user->avatar; ?>">
                    <? else: ?>
                        <img class="user-avatar" src="/files/avatars/no_foto.jpg">
                    <? endif; ?>
                </a>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Дата рождения:</label>
                <div class="col-sm-10">
                    <p class="form-control-static"><?= $user->userage; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Откуда:</label>
                <div class="col-sm-10">
                    <p class="form-control-static"><?= Model_Country::find($user->country_id)->title;  ?> &nbsp <?= Model_Region::find($user->region_id)->title;  ?> обл. &nbsp; г. <?= Model_Sity::find($user->sity_id)->title; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">О себе:</label>
                <div class="col-sm-10">
                    <p class="form-control-static"><?= $user->abaut; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Интересы, вид деятельности:</label>
                <div class="col-sm-10">
                    <p class="form-control-static"><?= $user->job; ?></p>
                </div>
            </div>
        
        </fieldset>
    </div>
</div>

