<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('UserStore', function ($user) {
    return (int) $user->id !== null;
});

Broadcast::channel('UserUpdate', function ($user) {
    return (int) $user->id !== null;
});

Broadcast::channel('UserDestroy', function ($user) {
    return (int) $user->id !== null;
});