<div class="modal organisation-modal fade" id="messagemodal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Причина отказа</h4>
            </div>
            <div class="modal-body">
                <?= Form::open(array('action' => "/admin/post/unupruve/" . $post->id)); ?>
                    <fieldset>
                        <div class="form-group">
                            <label>Текст уведомления</label>
                            <textarea name="text" required="required" class="form-control" placeholder="Текст уведомления"></textarea> 
                        </div>
                        <div class="form-group">
                            <input type="submit"  class="btn btn-primary" value="Отправить" />
                        </div>
                    </fieldset>    
                <?= Form::close(); ?>
            </div>
            
        </div>
    </div>
</div>
