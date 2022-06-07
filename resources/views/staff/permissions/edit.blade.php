@extends('admin.layouts.index')
@section('title','Permissions')
@section('content')
<div class="row">
	<div class="col-6">
		<div class="card">
        	<div class="card-body">
        		{!! Form::open([ 'method'=>'post', 'route' => ['admin.staff.permissions.update', $staff->id], 'class' => 'custom-validation']) !!}
        		 	<div class="form-group">
                        <label for="staffId">Staff</label>
                        <select class="form-control valid" name="staff_id" aria-required="true" aria-describedby="staff" aria-invalid="false">
                            <option value="{{ $staff->id }}" selected="selected">{{ $staff->name }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control valid" id="role" name="role" aria-required="true" aria-describedby="role" aria-invalid="false">
                            <option disabled="disabled" selected="selected">Please select</option>
                            <option value="account" {{ $staff->role == 'account' ? 'selected' : '' }}>Account</option>
                            <option value="manager" {{ $staff->role == 'manager' ? 'selected' : '' }}>Manager</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Permissions</label>
                        @foreach($permissions as $permission)
                        <div class="form-check">
                          <input type="checkbox" name="names[]" value="{{ $permission->id }}" @if($staff->permissions->pluck('id')->contains($permission->id)) checked @endif }}>
                          <label>{{ $permission->names }}</label>
                        </div>  
                        @endforeach
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-info">
                            {{ __('Submit') }}
                        </button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
				{{ Form::close() }}
        	</div>
        </div>
    </div>
</div>
@endsection
