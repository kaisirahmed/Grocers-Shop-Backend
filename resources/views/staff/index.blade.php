@extends('admin.layouts.index')
@section('title', 'Staff')
@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
            <div class="card-body">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert"> 
                    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>{!! session('message') !!}</strong>
                    </div>
                @endif

                <a href="{{ route('staff.register') }}"><button type="button" class="btn btn-outline-info btn-sm waves-effect waves-light float-right">+ New Staff</button></a>

                <div class="m-t-40">
                    <table id="datatable" class="display dt-responsive nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
	                        	<th></th>
	                            <th>Name</th>
	                            <th>Email</th>
	                            <th>Role</th>
	                            <th>Join Date</th>
	                            <th>Separation Date</th>
	                            <th>Status</th>
	                            <th>Action</th>
	                        </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th></th>
	                            <th>Name</th>
	                            <th>Email</th>
	                            <th>Role</th>
	                            <th>Join Date</th>
	                            <th>Separation Date</th>
	                            <th>Status</th>
	                            <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($staff as $staff)
	                        <tr>
	                        	<td></td>
	                            <td>{{ $staff->name }}</td>
	                            <td>{{ $staff->email }}</td>
	                            <td>
	                            	<span class="badge badge-{{ $staff->role == 'superAdmin' ? 'orange' : 'blue-grey' }}">{{ $staff->role }}</span>
	                            </td>

	                            <td>
	                            	@if(is_null($staff->join_date))
	                            	Not yet
	                            	@else
	                            	{{ date('d F, Y',strtotime($staff->join_date)) }}<br>{{ date('H:i a', strtotime($staff->join_date)) }}
	                            	@endif
	                            </td>
								<td>
									@if(is_null($staff->join_date))
	                            	Not yet
	                            	@else
	                            	{{ date('d F, Y',strtotime($staff->separation_date)) }}<br>{{ date('H:i a', strtotime($staff->separation_date)) }}
	                            	@endif
	                            </td>

	                            <td>
	                            	<span class="badge badge-{{ $staff->status == 1 ? 'orange' : 'blue-grey' }}">{{ __('Active') }}</span>
	                            </td>

	                            <td>
	                            	<a href="{{ route('staff.edit', $staff->id) }}">
	                            		<button class="grocers-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="ti-pencil-alt text-warning"></i></button>
	                            	</a>
 
                                    <button class="grocers-btn" type="submit" onclick="confirmDelete('{{ $staff->id }}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="ti-trash text-danger"></i></button>
                                
	                            	<form id="delete{{ $staff->id }}" action="{{ route('staff.destroy', $staff->id) }}" method="POST" style="display: none;">
	                                	@csrf
	                                	{{ method_field('DELETE') }}
									</form>

	                            </td>
	                        </tr>
	                        @endforeach
	                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection
