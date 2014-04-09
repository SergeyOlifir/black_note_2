<div class="modal fade" id="registr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 class="modal-title">Регистрация</h4>
        </div>
        <div class="modal-body">
           <form role="form" id="registr-form" action="/auth/register">
              <span class="label label-danger none"></span>
              <div class="form-group">
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Name" required="required" name="username">
              </div>
              <div class="form-group">
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" required="required" name="emale">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required="required" name="password">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password" required="required" name="confpass">
              </div>
            </form>
        </div> 
        <div class="modal-footer">
            <div class="btn-group">
                <button type="button" class="btn btn-link" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary btn-rounded" id="registr-button">Отправить</button>
            </div>
        </div>
      </div>
    </div>
  </div>
