import Echo from "laravel-echo"

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

window.Echo.private(`UserUpdate`)

    .listen('UserUpdateEvent', (data) => {
        if( $("#user-" + data.id).length )
        {
            var newUser = createUserObject(data);
            $("#user-" + data.id).replaceWith( newUser );
        }
    });

window.Echo.private(`UserStore`)
    .listen('UserStoreEvent', (data) => {
        if( ! $("#user-" + data.id).length )
        {
            var newUser = createUserObject(data);
            $('#users').prepend(newUser);
        }
    });

window.Echo.private(`UserDestroy`)
    .listen('UserDestroyEvent', (data) => {
        if($("#user-" + data.id).length )
        {
            $("#user-" + data.id).fadeOut(500);
        }
    });