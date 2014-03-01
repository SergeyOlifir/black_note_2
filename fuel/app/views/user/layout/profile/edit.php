<?= render('user/layout/profile/chengeAvatarPopUp'); ?>
<div class="well">
    <?= Form::open(array('method' => 'post', 'role' => 'form')); ?>
        <fieldset>
            <legend>
                Аватар
            </legend>
            <div class="form-group">
                <a data-target="#myModal" data-toggle="modal" href="#">
                    <? if(\Auth\Auth::get('avatar')): ?>
                    <img class="user-avatar" src="<?= Auth\Auth::get('avatar'); ?>">
                    <? else: ?>
                        <img class="user-avatar" src="/files/avatars/no_foto.jpg">
                    <? endif; ?>
                </a>
            </div>

        </fieldset>
    <?= \Fuel\Core\Form::close(); ?>
    <?= Form::open(array('method' => 'post', 'role' => 'form')); ?>
        <fieldset>
            <legend>Персональная информация</legend>
            <div class="form-group">
                <label for="InputLogin">Имя при регистрации</label>
                <?= Fuel\Core\Form::input('username', \Auth\Auth::get('username'), array('class' => 'form-control')); ?>
                <?= isset($errors['username']) ? "<span class=\"help-block\">{$errors['username']}</span>" : ''; ?>
            </div>
            <div class="form-group">
                <label>E-mail</label>
                <p class="form-control-static"><?= \Auth\Auth::get('email'); ?></p>
            </div>

            <div class="form-group">
                <label>Ваш пол</label>
                <div class="clearfix">
                    <label class="checkbox-inline">
                        <input name="usersex" <? if(\Auth\Auth::get('usersex') ===  'male'): ?> checked="true" <? endif;?> type="radio" id="inlineCheckbox1" value="male"> Мужской
                    </label>
                    <label class="checkbox-inline">
                        <input name="usersex" <? if(\Auth\Auth::get('usersex') ===  'female'): ?> checked="true" <? endif;?> type="radio" id="inlineCheckbox2" value="female"> Женский
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label>Дата рождения</label>
                <div class="row">
                    <div class=" date col-md-4 span2">
                        <?= Fuel\Core\Form::input('userage', \Auth\Auth::get('userage'), array('class' => 'form-control')); ?>
                        <?= isset($errors['userage']) ? "<span class=\"help-block\">{$errors['userage']}</span>" : ''; ?>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label>Месторасположение</label>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control location" val="<?= \Auth\Auth::get('country_id'); ?>" param="" action="<?= \Fuel\Core\Uri::create('/location/country/'); ?>" name="country_id"></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control location" val="<?= \Auth\Auth::get('region_id'); ?>" action="<?= \Fuel\Core\Uri::create('/location/region/'); ?>" name="region_id"></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control location" val="<?= \Auth\Auth::get('sity_id'); ?>" action="<?= \Fuel\Core\Uri::create('/location/sity/'); ?>" name="sity_id"></select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>О себе</label>
                <?= Fuel\Core\Form::textarea('abaut', \Auth\Auth::get('abaut'), array('class' => 'form-control', 'rows' => 6)); ?>
                <?= isset($errors['abaut']) ? "<span class=\"help-block\">{$errors['abaut']}</span>" : ''; ?>
            </div>

            <div class="form-group">
                <label>Интересы, вид деятельности</label>
                <?= Fuel\Core\Form::input('job', \Auth\Auth::get('job'), array('class' => 'form-control')); ?>
                <?= isset($errors['job']) ? "<span class=\"help-block\">{$errors['job']}</span>" : ''; ?>
            </div>
            <div class="form-group">
                <button class="btn btn-default btn-lg" type="submit">Сохранить</button>
            </div>
        </fieldset>
        
    <?= Fuel\Core\Form::close(); ?>
</div>
