<div class="modal organisation-modal fade" id="filialModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Добавить филиал организации</h4>
            </div>
            <div class="modal-body">
                <form class="addFilialForm">
                    <fieldset>
                        <div class="form-group">
                            <label>Месторасположение</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control location nosync" name="country_id" id="country" param="" action="<?= \Fuel\Core\Uri::create('/location/country/'); ?>" ></select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control location nosync" name="region_id" id="region" param="" action="<?= \Fuel\Core\Uri::create('/location/region/'); ?>"></select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control location nosync" name="sity_id" param="" action="<?= \Fuel\Core\Uri::create('/location/sity/'); ?>" ></select>
                                    </div>
                                </div>
                            </div>
                            <p class="help-block">Место расположение объекта жалобы или благодарности…</p>
                        </div>

                        <div class="form-group">
                            <label>Название филиала</label>
                            <input name="title" id="title" class="form-control" type="text" value="" placeholder="Название филиала"/>
                            <p class="help-block">Название может включать символы кириллицы или латиницы, не больше 150 символов…</p>
                        </div>

                        <div class="form-group">
                            <label>Адресс филиала</label>
                            <input name="adress" id="adress" class="form-control" type="text" value="" placeholder="Название улицы, номер здания, артикль здания, номер офиса…"/>
                            <p class="help-block">Пример: ул. Философская 15 а, офис 15</p>
                        </div>

                        <div class="form-group">
                            <label>Контактная информация</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="phone" id="phone" class="form-control" type="text" value="" placeholder="Телефон филиала организации"/>
                                        <p class="help-block">Пример: 380567777777</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="ovner" id="fio" class="form-control" type="text" value="" placeholder="Ф.И.О."/>
                                        <p class="help-block">Ф.И.О. руководителя филиала полностью…</p>
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
                    <a type="button" id="addFilial" class="btn btn-primary save-button">Сохранить</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                </div>
            </div>
        </div>
    </div>
</div>
