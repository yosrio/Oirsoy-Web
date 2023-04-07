@extends('backoffice.layouts.default')
@section('content')
<link href="{{ asset('main/css/config.css') }}" rel="stylesheet">
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
    <h1><span class="badge" style="background-color: #222E3C;">Configuration</span></h1>
    <div class="row justify-content-center" style="">
        <div class="col-2" style="margin: 2%;">
            <ul class="list-unstyled ps-0">
                <li class="mb-1">
                    <a class="btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#general-collapse" aria-expanded="true">
                        General
                    </a>
                    <div class="collapse show" id="general-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="#" class="link-dark rounded">Overview</a></li>
                            <li><a href="#" class="link-dark rounded">Updates</a></li>
                            <li><a href="#" class="link-dark rounded">Reports</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col" style="margin: 2%;">
            Column
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(this.hash).show().siblings().hide();
    $('#sidebarMenu').find('a').parent().removeClass('active');
    $("#configMenu").parent().addClass('active');
</script>
@endsection