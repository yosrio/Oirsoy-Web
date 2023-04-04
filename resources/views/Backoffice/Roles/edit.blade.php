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
        <a class="btn" href="{{ route('roles') }}">
            <i data-feather="arrow-left" style="cursor: pointer;"></i>
        </a>
        <span class="badge" style="color: #222E3C;">
            <?php echo ('Add Roles') ?>
        </span>
    </h2>
    <div class="row justify-content-center border border-white rounded" style="background-color: white;">
        <div class="d-flex justify-content-center">
            <div class="col-6" style="margin: 2%;">
                <form method="POST" action="{{ route('roles.save') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="name">Name</span>
                        <input type="text" class="form-control" id="name" name="name" aria-label="Username" value="<?php echo (isset($roleSelected) ? $roleSelected->name : '') ?>">
                    </div>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div>
                        <span class="" id="role">Roles</span>
                        <div class="input-group mb-3 border rounded" style="background-color: #BACDDB;">
                            <ul class="control unstyled menu_list" style="list-style-type: none; margin: 2%;">
                                <li id="menu_list-0">
                                    <input value="" class="form-check-input" type="checkbox" name="menu_list[]" id="in-menu_list-0">
                                    <label class="select">All</label>
                                    <ul class="children" style="list-style-type: none;">
                                        <?php foreach ($sidebar as $menu) : ?>
                                            <li id="menu_list-{{ $menu->id }}">
                                                <input value="" class="form-check-input" type="checkbox" name="menu_list[]" id="in-menu_list-{{ $menu->id }}">
                                                <label class="select">{{ $menu->header }}</label>
                                                <ul class="children" style="list-style-type: none;">
                                                    <?php $i = 1;
                                                    $menuItems = json_decode($menu->item, 1); ?>
                                                    <?php foreach ($menuItems['items'] as $menuItem) : ?>
                                                        <li id="menu_list-{{ $i }}">
                                                            <input value="{{ strtolower($menu->header).'_'.$menuItem['menu_id'] }}" class="form-check-input" type="checkbox" name="menu_list[]" id="in-menu_list-{{ $i }}">
                                                            <label class="select">{{ $menuItem['menu_title'] }}</label>
                                                        </li>
                                                        <?php $i++; ?>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <pre>
                    <input type="hidden" name="id" value="<?php echo (isset($roleSelected) ? $roleSelected->id : '') ?>" />
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

    // handling active menu
    $(this.hash).show().siblings().hide();
    $('#sidebarMenu').find('a').parent().removeClass('active');
    $("#rolesMenu").parent().addClass('active');
    // end of handling active menu

    // nested checkbox
    $(document).ready(function() {
        $("ul.menu_list input[type=checkbox]").on("change", function() {
            var checkboxValue = $(this).prop("checked");
            //call the recursive function for the first time
            decideParentsValue($(this));
            //Compulsorily apply check value Down in DOM
            $(this).closest("li").find(".children input[type=checkbox]").prop("checked", checkboxValue);
        });

        //the recursive function 
        function decideParentsValue(me) {
            var shouldTraverseUp = false;
            var checkedCount = 0;
            var myValue = me.prop("checked");

            //inspect my siblings to decide parents value
            $.each($(me).closest(".children").children('li'), function() {
                var checkbox = $(this).children("input[type=checkbox]");
                if ($(checkbox).prop("checked")) {
                    checkedCount = checkedCount + 1;
                }
            });

            //if I am checked and my siblings are also checked do nothing
            //OR
            //if I am unchecked and my any sibling is checked do nothing
            if ((myValue == true && checkedCount == 1) || (myValue == false && checkedCount == 0)) {
                shouldTraverseUp = true;
            }
            if (shouldTraverseUp == true) {
                var inputCheckBox = $(me).closest(".children").siblings("input[type=checkbox]");
                inputCheckBox.prop("checked", me.prop("checked"));
                decideParentsValue(inputCheckBox);
            }

        }
    });
    // end of nested checkbox
</script>
@endsection