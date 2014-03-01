<div class="modal fade" id="createevent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
            <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>Create New Event</h4>
            <form role="form" id="createevent-form" action="/host/events/create">
              <span class="label label-danger none"></span>
              <div class="form-group">
                <input type="text" class="form-control" id="exampleInputEmail1" name="eventname" placeholder="Event Name">
              </div>
              <div class="form-group">
                  <textarea class="form-control" placeholder="Description" name="description"></textarea>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="exampleInputEmail1" name="place" placeholder="Place">
              </div>
              
              <div id="date-picker" class="input-group input-append date form_datetime" data-date="<?= \Fuel\Core\Date::forge(time())->format('my'); ?>" data-date-format="mm-dd-yyyy hh:mm" >
                  <input  type="text" value="" class="form-control" name="date">
                  <span class="input-group-addon add-on"><i class="icon-th glyphicon glyphicon-calendar"></i></span>
              </div>
              
              <div class="form-group labeled">
                <label>Uploaded photos will be</label>
              </div>
              <label class="checkbox-inline">
                <input type="radio" name="public" id="optionsRadios1" value="1" checked> Visible
              </label>
              <label class="checkbox-inline">
                <input type="radio" name="public" id="optionsRadios1" value="0" > Invisible
              </label>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-lg" id="createevent-button">Create</button>
          <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
