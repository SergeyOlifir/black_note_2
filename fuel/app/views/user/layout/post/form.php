<?= render('user/organisation/form'); ?>
<?= render('user/filial/form'); ?>

<script>
    $(document).ready(function() {
        tinymce.init({
            selector: "textarea",
        });
    });
</script>

<div class="well">
    <?= Form::open(array('method' => 'post', 'role' => 'form', 'class' => 'add-post')); ?>
        <fieldset>
            <h2>Жалобы, благодарности и т.д.</h2>
            <div class="form-group">
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
                <p class="help-block">Выбирите из списка</p>
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
            </div>

            <div class="form-group">
                <label>Название организации</label>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <select class="form-control" val="<?= isset($post['organisation_id']) ? $post['organisation_id'] : ''; ?>" name="organisation_id"></select>
                            <p class="help-block">Выбирите из списка</p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <a class="btn btn-info btn-lg" data-toggle="modal" data-target="#organisationModal">Добавить организацию</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
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
            <div class="form-group">
                <label>Адресс организации</label>
                <p class="form-control-static">{{adress}}</p> 
            </div>

            <div class="form-group">
                <label>Контактная информация</label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <p class="form-control-static">{{phone}}</p>
                            <p class="help-block">Телефон организации</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <p class="form-control-static">{{fio}}</p>
                            <p class="help-block">Ф.И.О руководителя</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label>Заголовок</label>
                <input name="title" id="title" class="form-control" type="text" value="<?= isset($post['title']) ? $post['title'] : ''; ?>" placeholder="Заголовок"/>
            </div>

            <div class="form-group">
                <label>Текст</label>
                <textarea name="body" id="message"><?= isset($post['body']) ? $post['body'] : ''; ?></textarea> 
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary " value="Сохранить" />
            </div>
        </fieldset>    
    <?= \Fuel\Core\Form::close(); ?>
</div>
