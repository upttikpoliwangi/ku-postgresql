@extends('adminlte::page')
@section('title', 'List User')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
				<h1>Users</h1>
				<div class="lead">
					Manage your users here.
					<a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">Add new user</a>
				</div>
				
				<div class="mt-2">
					@include('layouts.partials.messages')
				</div>

				<table class="table table-striped">
					<thead>
					<tr>
						<th scope="col" width="1%">#</th>
						<th scope="col" width="15%">Name</th>
						<th scope="col">Email</th>
						<th scope="col" width="10%">Username</th>
						<th scope="col" width="10%">Roles</th>
						<th scope="col" width="1%" colspan="3"></th>    
					</tr>
					</thead>
					<tbody>
						@foreach($users as $user)
							<tr>
								<th scope="row">{{ $user->id }}</th>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->username }}</td>
								<td>
									@foreach($user->roles as $role)
										<span class="badge bg-primary">{{ $role->name }}</span>
									@endforeach
								</td>
								<td>
									<a href="{{ route('users.show', $user->id) }}" class="btn btn-warning btn-sm">Show</a><br><br>
									@role('admin')<a href="{{ route('users.tukaruser', $user->id) }}" class="btn btn-info btn-sm">Tukar User</a>@endrole
								</td>
								<td>
									<a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a><br><br>
									@role('admin')
										<a href="{{ route('users.personaltoken', $user->id) }}" class="btn btn-info btn-sm">Personal Token</a>
									@endrole
								</td>
								<td>
									{!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
									{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
									{!! Form::close() !!}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>

				<div class="d-flex">
					{!! $users->links('pagination::bootstrap-4') !!}
				</div>

			</div>
        </div>
    </div>
</div>
@stop