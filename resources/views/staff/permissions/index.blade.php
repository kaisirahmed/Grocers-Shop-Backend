@extends('admin.layouts.index')
@section('title', 'Permissions')
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

                <div class="m-t-40">
                    <table id="datatable" class="display dt-responsive nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Staff Name</th>
                                <th>Role</th>
                                <th>Permissions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Staff Name</th>
                                <th>Role</th>
                                <th>Permissions</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($staff as $staff)
                            <tr>
                                <td></td>
                                <td>{{ $staff->name }}</td>
                                <td>{{ ucfirst($staff->role) }}</td>
                                <td>{{ implode(', ', $staff->permissions()->get()->sortBy('names')->pluck('names')->toArray()) }}</td>
                                <td>
                                    <a href="{{ route('admin.staff.permissions.edit', $staff->id) }}">
                                        <button class="grocers-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="ti-pencil-alt text-warning"></i></button>
                                    </a>

                                    @if(Auth::user()->superAdmin())

                                    <button class="grocers-btn" type="submit" onclick="confirmDelete('{{ $staff->id }}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" disabled="disabled"><i class="ti-trash text-danger"></i></button>
                                
                                    <form id="delete{{ $staff->id }}" action="{{ route('admin.staff.permissions.staffDestroy', $staff->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                    </form>

                                    @endif
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
