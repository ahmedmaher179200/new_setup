<div class="card-body">
    <div class="row">
        <div class="col-lg-6">
            <x-form.input type="text" class="form-control" attribute="required"
                name="username" value="{{ isset($user) ? $user->username : old('username') }}"
                label="{{ trans('admin.Username') }}"/>
        </div>

        <div class="col-lg-6">
            <x-form.input type="text" class="form-control" attribute="required"
                name="name" value="{{ isset($user) ? $user->name : old('name') }}"
                label="{{ trans('admin.Name') }}" />
        </div>

        <div class="col-lg-6">
            <x-form.input type="password" class="form-control" attribute="{{ isset($user) ? '' : 'required' }}"
                name="password" value="{{ old('password') }}"
                label="{{ trans('admin.Password') }}"/>
        </div>

        <div class="col-lg-6">
            <x-form.select class="form-control select2" id=""
            :collection="$roles" select="{{ isset($user) ? $user->getRoleId() : old('role_id') }}" value="id"
            name="role_id" label="{{ trans('admin.Roles') }}"/>
        </div>
    </div>
</div>