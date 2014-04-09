<?= render('user/organisation/form'); ?>
<?= render('user/filial/form'); ?>

<script>
    $(document).ready(function() {
        tinymce.init({
            selector: "textarea",
            plugins: "image"
        });
    });
</script>

<div class="well">
    <?= Form::open(array('method' => 'post', 'role' => 'form', 'class' => 'add-post')); ?>
        <fieldset>
            <h2>Жалобы, благодарности и т.д.</h2>
            <div class="form-group <?= isset($errors['type']) ? 'has-error' : ''; ?>">
                <label for="InputLogin">Тип сообщения</label>
                <?= Fuel\Core\Form::select('type', isset($post['type']) ? $post['type'] : 0, Model_Post::$post_types , array('class' => 'form-control')); ?>
                <p class="help-block">Выбирите тип сообщения из списка</p>
            </div>
            <div class="form-group">
                <label for="InputLogin">На кого адресовано сообщение</label>
                <select name="postResipientType" class="form-control" val="<?= isset($post['organisation']) ? $post['organisation']->organisation_type : ''; ?>" param="" action="<?= \Fuel\Core\Uri::create('/location/organisationtypes/'); ?>" ></select>
                <p class="help-block">Выбирите из списка</p>
            </div>
            <div class="form-group">
                <label for="InputLogin">Сфера деятельности</label>
                <select name="sferaType" class="form-control" param="" val="<?= isset($post['organisation']) ? $post['organisation']->sfera_type : ''; ?>" action="<?= \Fuel\Core\Uri::create('/location/organisationsferes/'); ?>" ></select>
                <p class="help-block">Выберете из списка видов деятельности…</p>
            </div>

            <div class="form-group">
                <label>Месторасположение</label>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control location" val="<?= isset($post['organisation']) ? $post['organisation']->country_id : ''; ?>"  name="country_id" param="" action="<?= \Fuel\Core\Uri::create('/location/country/'); ?>" ></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control location" val="<?= isset($post['organisation']) ? $post['organisation']->region_id : ''; ?>" name="region_id" param="" action="<?= \Fuel\Core\Uri::create('/location/region/'); ?>" ></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control location" val="<?= isset($post['organisation']) ? $post['organisation']->sity_id : ''; ?>" name="sity_id" param="" action="<?= \Fuel\Core\Uri::create('/location/sity/'); ?>"></select>
                        </div>
                    </div>
                </div>
                <p class="help-block">Место расположение объекта жалобы или благодарности…</p>
            </div>

            <div class="form-group <?= isset($errors['organisation_id']) ? 'has-error' : ''; ?>">
                <label>Название организации</label>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <select class="form-control" val="<?= isset($post['organisation_id']) ? $post['organisation_id'] : ''; ?>" name="organisation_id"></select>
                            <p class="help-block">Выберите из списка или добавьте новое предприятие, организацию, филиал…</p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <a class="btn btn-info btn-lg" data-toggle="modal" data-target="#organisationModal">Добавить организацию</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group filial-wrapper">
                <label>Филиал</label>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <select class="form-control" val="<?= isset($post['filial_id']) ? $post['filial_id'] : ''; ?>" name="filial_id" id="filia"></select>
                            <p class="help-block">Выбирите из списка</p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <a class="btn btn-info btn-lg" data-toggle="modal" data-target="#filialModal">Добавить филиал</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group <?= isset($errors['title']) ? 'has-error' : ''; ?>">
                <label>Заголовок жалобы или благодарности</label>
                <input name="title" id="title" class="form-control" type="text" value="<?= isset($post['title']) ? $post['title'] : ''; ?>" placeholder="Заголовок"/>
                <p class="help-block">Пример: Название товара или услуги плохого качества…</p>
            </div>

            <div class="form-group <?= isset($errors['body']) ? 'has-error' : ''; ?>">
                <label>Текст жалобы или благодарности</label>
                <textarea name="body" id="message"><?= isset($post['body']) ? $post['body'] : ''; ?></textarea>
                <p class="help-block">Текст жалобы или благодарности не должен нарушать правил пользования ресурсом, подробнее о <a href="/gwest/abaut">правилах пользования…</a> </br> Документы и видеофайлы могут быть добавлены в жалобы/благодарность в виде ссылки на сервер хранения данных (Например: youtube, ex.ua…)</p>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary " value="Сохранить" />
            </div>
        </fieldset>    
    <?= \Fuel\Core\Form::close(); ?>
</div>
