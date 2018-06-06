@extends('layouts.app')

@section('css')
    <style type="text/css">
        .panel-heading button {
            position: absolute;
            right: 20px;
            top: 5px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Users
                        <button id="create" class="btn btn-primary btn-sm pull-right">Create</button>
                    </div>

                    <div class="panel-body">
                        <table class="table table-hover">
                            <th class="col-md-4">Name</th>
                            <th class="col-md-4">Email</th>
                            <th class="col-md-4">Action</th>
                            <tbody id="users">
                            @foreach($users as $user)
                                <tr id="user-{{ $user->id }}">
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <button id="edit" value="{{ $user->id }}" class="btn btn-primary"> Edit </button>
                                        <button id="delete" value="{{ $user->id }}" class="btn btn-danger"> Delete </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div id="pagination"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="userCreateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title text-center">Create User</h4>
                    </div>
                    <div class="modal-body">
                        <form id="user-create-form" method="POST" action="{{ url('users') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="" required>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="user-create">Create</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="userEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title text-center">Edit User</h4>
                    </div>
                    <div class="modal-body">
                        <form id="user-edit-form" method="POST" action="{{ url('users') }}">
                            @csrf
                            <input id="user-id" name="id" type="hidden" value="">
                            <input name="_method" type="hidden" value="PUT">

                            <div class="form-group row">
                                <label for="name-update" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name-update" type="text" class="form-control" name="name" value="" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email-update" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email-update" type="email" class="form-control" name="email" value="" required>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-update" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password-update" type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm-update" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm-update" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user-roles-update" class="col-md-4 col-form-label text-md-right">User Roles</label>

                                <div class="col-md-6">
                                    <span id="user-roles-update"></span>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="user-update">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/UserEvents.js') }}"></script>

    <script type="text/javascript">

        $('#create').click(function(){
            $('#userCreateModal').modal('show');
        });

        $(document).on('click','#edit',function(){
            var user_id = $(this).val();

            $.get('users/' + user_id, function (data) {
                $('#name-update').val(data.user.name);
                $('#email-update').val(data.user.email);
                $('#user-id').val(data.user.id);
                var roles = '';
                $.each(data.meta.roles, function (key, value) {
                    var checked = '';
                    data.user.roles.map(function (role) {
                        if (role.id === value.id) {
                            checked = 'checked';
                        }

                        return role;
                    });

                    roles += ''+value.name+' <input type="checkbox" name="role_update[]" value="'+value.id+'" '+checked+'><br/>'
                });

                $('#user-roles-update').html(roles);
                $('#userEditModal').modal('show');
            })
        });

        $(document).on('click','#delete',function(){
            var user_id = $(this).val();

            $.post('users/' + user_id, {
                '_token': $('meta[name=csrf-token]').attr('content'),
                _method : 'DELETE'
            })
                .done(function() {
                    $("#user-" + user_id).fadeOut(500);
                })

                .fail(function(data) {
                    if (data.responseJSON.message) {
                        window.alert(data.responseJSON.message);
                    }
                    else {
                        window.alert(data.responseJSON);
                    }
                });
        });

        $("#user-create").click(function () {
            var formData = $('#user-create-form').serialize();

            $.post('users', formData)
                .done(function(data) {
                    var newUser = createUserObject(data);
                    $('#users').prepend(newUser);
                    $('#user-create-form').trigger("reset");
                    $('#userCreateModal').modal('hide');
                })

                .fail(function(data) {
                    if (data.responseJSON.message) {
                        window.alert(data.responseJSON.message);
                    }
                    else {
                        window.alert(data.responseJSON);
                    }
                });
        });

        $("#user-update").click(function (e) {
            var user_id  = $('#user-id').val();
            var formData = $('#user-edit-form').serialize();

            $.post( 'users/' +user_id, formData)
                .done(function(data) {
                    var newUser = createUserObject(data);
                    $("#user-" + data.id).replaceWith( newUser );
                    $('#userEditModal').modal('hide');
                })

                .fail(function(data) {
                    if (data.responseJSON.message) {
                        window.alert(data.responseJSON.message);
                    }
                    else {
                        window.alert(data.responseJSON);
                    }
                });
        });

        function createUserObject(data) {
            var user = '<tr id="user-' + data.id + '"><td>'+data.name+'</td><td>'+data.email+'</td>';
            user += '<td><button id="edit" value="'+data.id+'" class="btn btn-primary"> Edit </button>';
            user += ' <button id="delete" value="'+data.id+'" class="btn btn-danger"> Delete </button></td>';

            return user;
        }
    </script>
@endsection
