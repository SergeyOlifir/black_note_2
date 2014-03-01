<div class="well">
    <div class="form-horizontal">
        <fieldset>
        
            <legend>
                <?= $organisation->title; ?> &nbsp; Рейтинг <a class="vote_up" href="#">up</a>120<a class="vote_down" href="#">down</a>
            </legend>
            <div class="">
                <a href="#">
                    <? if(isset($organisation->logo)): ?>
                        <img class="user-avatar" src="<?= $organisation->logo; ?>">
                    <? else: ?>
                        <img class="user-avatar" src="/files/avatars/no_foto.jpg">
                    <? endif; ?>
                </a>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Откуда:</label>
                <div class="col-sm-10">
                    <p class="form-control-static"><?= Model_Country::find($organisation->country_id)->title;  ?> &nbsp <?= Model_Region::find($organisation->region_id)->title;  ?> обл. &nbsp; г. <?= Model_Sity::find($organisation->sity_id)->title; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Адресс:</label>
                <div class="col-sm-10">
                    <p class="form-control-static"><?= $organisation->adress; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Тип Организации:</label>
                <div class="col-sm-10">
                    <p class="form-control-static"><?= Model_Organisation::$organisation_types[$organisation->organisation_type]['title'] ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Вид деятельности:</label>
                <div class="col-sm-10">
                    <p class="form-control-static"><?= Model_Organisation::$organisation_sferes_types[$organisation->organisation_type][$organisation->sfera_type]['title']; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">ФИО Начальника:</label>
                <div class="col-sm-10">
                    <p class="form-control-static"><?= $organisation->ovner; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Телефон:</label>
                <div class="col-sm-10">
                    <p class="form-control-static"><?= $organisation->phone; ?></p>
                </div>
            </div>
        
        </fieldset>
    </div>
</div>

