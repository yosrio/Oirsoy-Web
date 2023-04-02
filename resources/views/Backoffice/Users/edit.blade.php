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

    <h2>
        <a class="btn" href="{{ route('users') }}">
            <i data-feather="arrow-left" style="cursor: pointer;"></i>
        </a>
        <span class="badge" style="color: #222E3C;">
            <?php echo(isset($userSelected) ? 'Edit User' : 'Add User') ?>
        </span>
    </h2>
    <div class="row justify-content-center border border-white rounded" style="background-color: white;">
        <div class="d-flex justify-content-center">
            <div class="col-6" style="margin: 2%;">
                <form method="POST" action="{{ route('user.save') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="name">Name</span>
                        <input type="text" class="form-control" id="name" name="name" aria-label="Username" value="<?php echo (isset($userSelected) ? $userSelected->name : '') ?>">
                    </div>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="email">Email</span>
                        <input type="email" class="form-control" id="email" name="email" aria-label="Email" value="<?php echo (isset($userSelected) ? $userSelected->email : '') ?>">
                    </div>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="password">Password</span>
                        <input class="form-control password" id="password" class="block mt-1 w-full" type="password" name="password" <?php echo (isset($userSelected) ? '' : 'required') ?> />
                        <span class="input-group-text togglePassword" id="">
                            <i data-feather="eye" style="cursor: pointer"></i>
                        </span>
                    </div>
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <pre>
                    <input type="hidden" name="id" value="<?php echo (isset($userSelected) ? $userSelected->id : '') ?>" />
					<div class="d-grid gap-2">
						<button class="btn btn-block btn-lg" style="background-color: #222E3C; color: white; font-size: 18px;" type="submit">Save</button>
					</div>
					</pre>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(".togglePassword").click(function(e) {
        e.preventDefault();
        var type = $(this).parent().parent().find(".password").attr("type");
        if (type == "password") {
            $(this).removeClass("fa-eye-slash");
            $(this).addClass("fa-eye");
            $(this).parent().parent().find(".password").attr("type", "text");
        } else if (type == "text") {
            $(this).removeClass("fa-eye");
            $(this).addClass("fa-eye-slash");
            $(this).parent().parent().find(".password").attr("type", "password");
        }
    });

    $(this.hash).show().siblings().hide();
    $('#sidebarMenu').find('a').parent().removeClass('active');
    $("#usersMenu").parent().addClass('active');
</script>
@endsection