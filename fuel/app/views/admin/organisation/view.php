<? if(isset($organisation['status'])): ?>
       <? if($organisation['status'] == 0): ?>
            <div class="alert alert-danger">Организация не прошла модерацию</div>
       <? endif; ?>
       <? if($organisation['status'] == 1): ?>
            <div class="alert alert-warning">Организация требует модерации</div>
       <? endif; ?>
       <? if($organisation['status'] == 2): ?>
            <div class="alert alert-success">Организация одобрена</div>
       <? endif; ?>
       <? if(count($organisation->unmoderated_filials()) > 0): ?>
            <div class="alert alert-danger">
                <span>Есть не одобренные филиалы</span>
                <ul>
                    <? foreach($organisation->unmoderated_filials() as $filial): ?>
                        <li><?= Fuel\Core\Html::anchor('/admin/filial/view/' . $filial->id, $filial->title) ?></li>
                    <? endforeach;?>
                </ul>
            </div>
       <? endif; ?>
<? endif; ?>

<div class="well">
    <?= \Fuel\Core\Form::open(); ?>
        <fieldset>

            <div class="form-group">
                <label for="InputLogin">На кого адресовано сообщение</label>
                <select name="organisation_type" class="form-control" val="<?= isset($organisation['organisation_type']) ? $organisation['organisation_type'] : ''; ?>" param="" action="<?= \Fuel\Core\Uri::create('/location/organisationtypes/'); ?>" ></select>
                <p class="help-block">Выбирите из списка</p>
            </div>

            <div class="form-group">
                <label for="InputLogin">Сфера деятельности</label>
                <select name="sfera_type" class="form-control" param="" val="<?= isset($organisation['sfera_type']) ? $organisation['sfera_type'] : ''; ?>" action="<?= \Fuel\Core\Uri::create('/location/organisationsferes/'); ?>"></select>
                <p class="help-block">Выбирите из списка</p>
            </div>

            <div class="form-group">
                <label>Месторасположение</label>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control location" name="country_id" val="<?= isset($organisation['country_id']) ? $organisation['country_id'] : ''; ?>" param="" action="<?= \Fuel\Core\Uri::create('/location/country/'); ?>"></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control location" name="region_id" val="<?= isset($organisation['region_id']) ? $organisation['region_id'] : ''; ?>" param="" action="<?= \Fuel\Core\Uri::create('/location/region/'); ?>" ></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control location" name="sity_id" val="<?= isset($organisation['sity_id']) ? $organisation['sity_id'] : ''; ?>" param="" action="<?= \Fuel\Core\Uri::create('/location/sity/'); ?>" ></select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Название организации</label>
                <input name="title" class="form-control" type="text" value="<?= isset($organisation['title']) ? $organisation['title'] : ''; ?>" placeholder="Адресс организации"/> 
            </div>

            <div class="form-group">
                <label>Адресс организации</label>
                <input name="adress" class="form-control" type="text" value="<?= isset($organisation['adress']) ? $organisation['adress'] : ''; ?>" placeholder="Адресс организации"/> 
            </div>

            <div class="form-group">
                <label>Контактная информация</label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="phone" id="phone" class="form-control" type="text" value="<?= isset($organisation['phone']) ? $organisation['phone'] : ''; ?>" placeholder="Контактный телефон"/>
                            <p class="help-block">Телефон организации</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="ovner" id="fio" class="form-control" type="text" value="<?= isset($organisation['ovner']) ? $organisation['ovner'] : ''; ?>" placeholder="Ф.И.О."/>
                            <p class="help-block">Ф.И.О руководителя</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Логотип</label>
                <div>
                    <a href="#" data-target="#myModal" data-toggle="modal" class="thumbnail">
                        <? if(isset($organisation->logo)): ?>
                            <img class="user-avatar" src="<?= $organisation['logo']; ?>">
                        <? else: ?>
                            <img class="user-avatar" src="/files/avatars/no_foto.jpg">
                        <? endif; ?>
                    </a>
                </div>
            </div>
            <div class="btn-group pull-right">
                <?= \Fuel\Core\Form::submit('submit', 'Принять', array('class' => 'btn btn-default')); ?>
                <?= Fuel\Core\Html::anchor('/admin/organisation/delete/' . $organisation->id, 'Не принять', array('class' => 'btn btn-danger')); ?>
                <?= Fuel\Core\Html::anchor('/admin/filial/index/' . $organisation->id, 'Список филиалов', array('class' => 'btn btn-default')); ?>
            </div>
        </fieldset>    
    <?= \Fuel\Core\Form::close(); ?>
</div>
<?= render('admin/organisation/uploadlogo', array('organisation' => $organisation)); ?>