<div class="modal fade" id="forgotPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 class="modal-title">Востановление пароля</h4>
        </div>
        <div class="modal-body">
            <form role="form" id="forgot-password-form" action="/auth/forgotpassword">
              <span class="label none"></span>
              <div class="form-group">
                <input type="text" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter Your Email">
              </div>
            </form>
        </div>
        <div class="modal-footer">
            <div class="btn-group">
                <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-rounded" id="forgot-password-button">Send</button>
            </div>
        </div>
      </div>
    </div>
  </div>
