<div class="delete-confirm">
  <div class="delete-confirm-icon"><i class="fas fa-trash"></i></div>
  <p class="delete-confirm-text">{{ trans('admin.Are you sure about this procedure') }}</p>
</div>
<div class="modal-footer justify-content-between">
  <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.Cancel') }}</button>
  <a class="btn btn-danger" href="{{$url}}"><i class="fas fa-trash"></i> {{ trans('admin.Delete') }}</a>
</div>
