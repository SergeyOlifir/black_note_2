<div class="well">
    <div class="form-horizontal">
        <fieldset>
        
            <legend>
                <?= $organisation->title; ?> &nbsp; Рейтинг 
                    <? if(Controller_Gwest::AuthCheck() and Model_Vote::query()->where('user_id', Controller_Gwest::GetLogedInUser()->id)->where('organisation_id', $organisation->id)->count() < 1) : ?>
                        <a class="vote_up" href="/gwest/organisation/voteup/<?= $organisation->id; ?>">+</a> 
                    <? endif; ?>
                    <?= $organisation->raiting; ?>
                    <? if(Controller_Gwest::AuthCheck() and Model_Vote::query()->where('user_id', Controller_Gwest::GetLogedInUser()->id)->where('organisation_id', $organisation->id)->count() < 1) : ?>
                        <a class="vote_down" href="/gwest/organisation/votedown/<?= $organisation->id; ?>">-</a>
                    <? endif; ?>
            </legend>
            <div class="clearfix">
                <div class="col-lg-5">
                    <a href="#">
                        <? if(isset($organisation->logo)): ?>
                            <img class="user-avatar" src="<?= $organisation->logo; ?>">
                        <? else: ?>
                            <img class="user-avatar" src="/files/avatars/no_foto.jpg">
                        <? endif; ?>
                    </a>
                </div>
                <div class="col-lg-7">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Откуда:</label>
                        <div class="col-sm-9">
                            <p class="form-control-static"><?= Model_Country::find($organisation->country_id)->title;  ?> &nbsp <?= Model_Region::find($organisation->region_id)->title;  ?> обл. &nbsp; г. <?= Model_Sity::find($organisation->sity_id)->title; ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Адресс:</label>
                        <div class="col-sm-9">
                            <p class="form-control-static"><?= $organisation->adress; ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Тип Организации:</label>
                        <div class="col-sm-9">
                            <p class="form-control-static"><?= Model_Organisation::$organisation_types[$organisation->organisation_type]['title'] ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Вид деятельности:</label>
                        <div class="col-sm-9">
                            <p class="form-control-static"><?= Model_Organisation::$organisation_sferes_types[$organisation->organisation_type][$organisation->sfera_type]['title']; ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">ФИО Начальника:</label>
                        <div class="col-sm-9">
                            <p class="form-control-static"><?= $organisation->ovner; ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Телефон:</label>
                        <div class="col-sm-9">
                            <p class="form-control-static"><?= $organisation->phone; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        
        </fieldset>
        <? if(count($organisation->filials) > 0): ?>
            <fieldset>
                <legend>Филиалы</legend>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                        <? foreach($organisation->filials as $filial): ?>
                            <? if($filial->status == 2): ?>
                                <tr>
                                    <td>
                                        <?= $filial->title; ?>
                                    </td>
                                    <td>
                                        <?= Model_Country::find($filial->country_id)->title;  ?> &nbsp <?= Model_Region::find($filial->region_id)->title;  ?> обл. &nbsp; г. <?= Model_Sity::find($filial->sity_id)->title; ?>
                                    </td>
                                    <td>
                                        <?= $filial->adress; ?>
                                    </td>
                                    <td>
                                        тел. <?= $filial->phone; ?>
                                    </td>
                                    <td>
                                         <?= $filial->ovner; ?>
                                    </td>
                                </tr>
                            <? endif; ?>
                        <? endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </fieldset>
        <? endif; ?>
        
        <? if(count($organisation->posts) > 0): ?>
            <fieldset>
                <legend>Посты</legend>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                        <? foreach($organisation->posts as $post): ?>
                            <? if($post->status == 3): ?>
                                <tr>
                                    <td>
                                        <?= Fuel\Core\Html::anchor('/gwest/posts/view/' . $post->id, $post->title); ?>
                                    </td>
                                    <td>
                                        <?= Fuel\Core\Html::anchor('/gwest/user/view/' . $post->user->id, $post->user->username); ?>
                                    </td>
                                </tr>
                            <? endif; ?>
                        <? endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </fieldset>
        <? endif; ?>
    </div>
</div>

