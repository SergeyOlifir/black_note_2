<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 class="modal-title">Вход</h4>
        </div>
        <div class="modal-body">

            <form role="form" id="login-form" action="/auth/login">
              <p class="alert alert-danger"></p>
              <div class="form-group">
                <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="Enter Name or Email">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
              </div>
              
              <div class="clearfix">
                <div class="forgot-password pull-left">
                    <a href="#forgotPassword" data-toggle="modal">Забыли пароль?</a>
                </div>
              </div>
            </form>
        </div>
        <div class="modal-footer ">
            <div class="btn-group">
                <button type="button" class="btn btn-link" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary btn-rounded" id="login-button">Вход</button>
                <button type="button" class="btn btn-primary btn-rounded" data-target="#registr" data-toggle="modal">Регистрация</button>
            </div>
        </div>
      </div>
    </div>
  </div>
