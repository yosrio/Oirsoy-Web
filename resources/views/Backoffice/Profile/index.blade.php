@extends('backoffice.layouts.default')
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
	<h1><span class="badge" style="background-color: #222E3C;">Edit Profile</span></h1>
	<div class="row justify-content-center border border-white rounded" style="background-color: white;">
		<div class="d-flex justify-content-center">
			<div class="col-6" style="margin: 2%;">
				<form method="POST" action="{{ route('updateProfile') }}">
					@csrf
					<div class="input-group mb-3">
						<span class="input-group-text" id="name">Name</span>
						<input type="text" class="form-control" id="name" name="name" aria-label="Username" value="<?php echo $user->name ?>">
					</div>
					@error('name')
					<div class="alert alert-danger">{{ $message }}</div>
					@enderror
					<div class="input-group mb-3">
						<span class="input-group-text" id="email">Email</span>
						<input type="email" class="form-control" id="email" name="email" aria-label="Email" value="<?php echo $user->email ?>">
					</div>
					@error('email')
					<div class="alert alert-danger">{{ $message }}</div>
					@enderror
					<div class="input-group mb-3">
						<span class="input-group-text" id="newPassword">New Password</span>
						<input class="form-control newPassword" id="newPassword" class="block mt-1 w-full" type="password" name="newPassword" required />
						<span class="input-group-text toggleNewPassword" id="">
							<i data-feather="eye" style="cursor: pointer"></i>
						</span>
					</div>
					@error('newPassword')
					<div class="alert alert-danger">{{ $message }}</div>
					@enderror
					<div class="input-group mb-3">
						<span class="input-group-text" id="confirmNewPassword">Confirmed New Password</span>
						<input class="form-control confirmNewPassword" id="confirmNewPassword" class="block mt-1 w-full" type="password" name="confirmNewPassword" required />
						<span class="input-group-text toggleConfirmNewPassword" id="">
							<i data-feather="eye" style="cursor: pointer"></i>
						</span>
					</div>
					@error('confirmNewPassword')
					<div class="alert alert-danger">{{ $message }}</div>
					@enderror
					<hr>
					<div class="input-group mb-3">
						<span class="input-group-text" id="currentPassword">Current Password</span>
						<input class="form-control currentPassword" id="currentPassword" class="block mt-1 w-full" type="password" name="currentPassword" required />
						<span class="input-group-text toggleCurrentPassword" id="">
							<i data-feather="eye" style="cursor: pointer"></i>
						</span>
					</div>
					@error('currentPassword')
					<div class="alert alert-danger">{{ $message }}</div>
					@enderror
					<pre>

					<div class="d-grid gap-2">
						<button class="btn btn-block btn-lg" style="background-color: #222E3C; color: white; font-size: 18px;" type="submit">Save Profile</button>
					</div>
					</pre>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection