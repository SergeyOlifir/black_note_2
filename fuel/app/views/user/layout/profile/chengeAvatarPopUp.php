<div class="modal avatar-modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Аватар</h4>
            </div>
            <div class="modal-body">
                <p>
                    <? if(\Auth\Auth::get('avatar')): ?>
                        <img class="user-avatar" src="<?= Auth\Auth::get('avatar'); ?>">
                    <? else: ?>
                        <img class="user-avatar" src="/files/avatars/no_foto.jpg">
                    <? endif; ?>
                </p>
            </div>
            <div class="modal-footer">
                <div class="btn-group">
                    <a type="button" class="btn btn-primary upload-button">Загрузить<input name="username" type="file" class="form-control"></a>
                    <button type="button" class="btn btn-primary">Изменить</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal avatar-modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Аватар</h4>
            </div>
            <div class="modal-body">
                <p><img id="editModalImage"  src="" class="user-avatar" /></p>
            </div>
            <div class="modal-footer">
                <div class="btn-group">
                    <button id="apply" type="button" class="btn btn-primary">Применить</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                </div>
            </div>
        </div>
    </div>
  </div>
