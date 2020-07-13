$(function () {

    $('.addMenu').on('click', function () {

        $('#menuTitle').html('Add Menu');
        $('.modal-footer button[type=submit]').html('Add Menu');
        $('.modal-footer button[type=submit]').attr('name', 'add');
        $('form input').val('');
    });

    $('.editMenu').on('click', function () {
        $('#menuTitle').html('Edit Menu');
        $('.modal-footer button[type=submit]').attr('name', 'edit');
        $('.modal-footer button[type=submit]').html('Save Changes');
        const id = $(this).data('id');

        $.ajax({
            url: 'http://localhost/ci-3lat/Menu/getMenu',
            method: 'POST',
            data: { id: id },
            dataType: 'JSON',
            success: function (data) {
                $('#id').val(data.id);
                $('#menu').val(data.menu);
            }
        });
    });

    $('.addSubMenu').on('click', function () {
        $('.modal-footer button[type=submit]').html('Add Sub Menu');
        $('.modal-footer button[type=submit]').attr('name', 'add');
        $('#menuTitle').html('Add Sub Menu');
        $('.form-group input').val('');
    });

    $('.editSubMenu').on('click', function () {
        $('#menuTitle').html('Edit Sub Menu');
        $('.modal-footer button[type=submit]').attr('name', 'edit');
        $('.modal-footer button[type=submit]').html('Save Changes');
        const id = $(this).data('id');

        $.ajax({
            url: 'http://localhost/ci-3lat/Menu/getSubMenu',
            method: 'POST',
            data: { id: id },
            dataType: 'JSON',
            success: function (data) {
                $('#id').val(data.id);
                $('#menu').val(data.menu_id);
                $('#title').val(data.title);
                $('#url').val(data.url);
                $('#icon').val(data.icon);
                $('#isactive').val(data.is_active);
            }
        });
    });


    //Create and Edit Role
    $('.addRole').on('click', function () {
        $('.modal-footer button[type=submit]').html('Add Role');
        $('.modal-footer button[type=submit]').attr('name', 'add');
        $('#menuTitle').html('Add Role');
        $('.form-group input').val('');
    });

    $('.editRole').on('click', function () {
        $('#menuTitle').html('Edit Role');
        $('.modal-footer button[type=submit]').attr('name', 'edit');
        $('.modal-footer button[type=submit]').html('Save Changes');
        const id = $(this).data('id');

        $.ajax({
            url: 'http://localhost/ci-3lat/Admin/getRole',
            method: 'POST',
            data: { id: id },
            dataType: 'JSON',
            success: function (data) {
                $('#id').val(data.id);
                $('#role').val(data.role);
            }
        });
    });

});
