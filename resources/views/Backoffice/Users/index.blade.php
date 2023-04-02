@extends('layouts.default')
@section('content')
<div class="container">
	@if (session('success'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		{{ session('success') }}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	@elseif (session('error'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		{{ session('error') }}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	@endif
	<div class="row justify-content-center">
		<div class="d-grid gap-2 d-md-flex justify-content-md-end" style="margin: 2%;">
			<a class="btn" href="{{ route('user.add') }}" style="background-color: #222E3C; color: white; font-size: 18px;" type="submit">Add User</a>
		</div>
	</div>

	<div class="row justify-content-center border rounded">
			<div class="col" style="margin: 2%;">
		<table id="usersTable" class="table table-striped" style="width:100%">
			<thead>
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Email</th>
					<th>Created At</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users as $item) : ?>
					<tr>
						<th scope="row"><?php echo $item->id; ?></th>
						<td><?php echo $item->name; ?></td>
						<td><?php echo $item->email; ?></td>
						<td><?php echo $item->created_at; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
			</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
	$(this.hash).show().siblings().hide();
	$('#sidebarMenu').find('a').parent().removeClass('active');
	$("#usersMenu").parent().addClass('active');

	$(document).ready(function() {
		$('#usersTable').DataTable();
	});
</script>
@endsection