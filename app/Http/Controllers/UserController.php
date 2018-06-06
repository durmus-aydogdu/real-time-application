<?php

namespace App\Http\Controllers;

use App\Role;
use App\RoleUser;
use App\Events\UserStoreEvent;
use App\Events\UserUpdateEvent;
use App\Events\UserDestroyEvent;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends \DurmusAydogdu\Resource\ResourceController
{
    protected $model = "User";

    protected $indexView = 'users';

    protected $perPage = 50;

    protected $items = "users";

    protected $item = "user";

    protected $with = ['roles'];

    protected $storeRequest = \App\Http\Requests\UserStoreRequest::class;

    protected $updateRequest = \App\Http\Requests\UserUpdateRequest::class;

    public function setMetaData()
    {
        $meta = [
            'roles' => Role::get(),
        ];

        return $meta;
    }

    public function beforeSave($object, $action)
    {
        $object->password = bcrypt(\request('password'));

        return $object;
    }

    public function afterSave($object, $action)
    {
        if (\request()->filled('role_update')) {
            // Deleting exist roles
            RoleUser::where('user_id',  $object->id)->delete();

            // Updating roles
            foreach (\request('role_update') as $role) {
                RoleUser::create(['user_id' => $object->id, 'role_id' => $role]);
            }
        }

        // Broadcasting data according action
        if ($action === 'store') {
            broadcast(new UserStoreEvent($object));
        }
        else {
            broadcast(new UserUpdateEvent($object));
        }

        return $object;
    }

    public function afterDestroy($object)
    {
        // Broadcasting data
        broadcast(new UserDestroyEvent($object->id));

        return $object;
    }
}
