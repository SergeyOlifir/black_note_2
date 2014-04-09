<div class="modal organisation-modal fade" id="organisationModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Добавить организацию</h4>
            </div>
            <div class="modal-body">
                <form class="addOrganisationForm">
                    <fieldset>
                        
                        <div class="form-group">
                            <label for="InputLogin">На кого адресовано сообщение</label>
                            <select name="organisation_type" class="form-control" param="" action="<?= \Fuel\Core\Uri::create('/location/organisationtypes/'); ?>" ></select>
                            <p class="help-block">Выбирите из списка</p>
                        </div>
                        
                        <div class="form-group">
                            <label for="InputLogin">Сфера деятельности</label>
                            <select name="sfera_type" class="form-control" param="" action="<?= \Fuel\Core\Uri::create('/location/organisationsferes/'); ?>"></select>
                            <p class="help-block">Выберете из списка видов деятельности…</p>
                        </div>

                        <div class="form-group">
                            <label>Месторасположение</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control location" name="country_id" param="" action="<?= \Fuel\Core\Uri::create('/location/country/'); ?>"></select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control location" name="region_id" param="" action="<?= \Fuel\Core\Uri::create('/location/region/'); ?>" ></select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control location" name="sity_id" param="" action="<?= \Fuel\Core\Uri::create('/location/sity/'); ?>" ></select>
                                    </div>
                                </div>
                            </div>
                            <p class="help-block">Место расположение объекта жалобы или благодарности…</p>
                        </div>

                        <div class="form-group">
                            <label>Название организации</label>
                            <input name="title" class="form-control" type="text" value="" placeholder="Адресс организации"/>
                            <p class="help-block">Название может включать символы кириллицы или латиницы, не больше 150 символов…</p>
                        </div>

                        <div class="form-group">
                            <label>Адресс организации</label>
                            <input name="adress" class="form-control" type="text" value="" placeholder="Название улицы, номер здания, артикль здания, номер офиса…"/>
                            <p class="help-block">Пример: ул. Философская 15 а, офис 15</p>
                        </div>

                        <div class="form-group">
                            <label>Контактная информация</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="phone" id="phone" class="form-control" type="text" value="" placeholder="Телефон организации"/>
                                        <p class="help-block">Пример: 80567777777</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="ovner" id="fio" class="form-control" type="text" value="" placeholder="Ф.И.О."/>
                                        <p class="help-block">Ф.И.О. руководителя полностью…</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <label>Логотип</label>
                            <div>
                                <a href="#" class="thumbnail">
                                    <img src="/img/foto/no_foto.jpg">
                                </a>
                            </div>
                            <input class="logo-file" type="file" />
                        </div>-->

                    </fieldset>    
                </form>
            </div>
            <div class="modal-footer">
                <div class="btn-group">
                    <a id="addOrganisation" class="btn btn-primary save-button">Сохранить</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                </div>
            </div>
        </div>
    </div>
</div>