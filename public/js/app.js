import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


var channel = Window.Echo.private(`App.Models.User.${userId}`);
channel.notification((data) => {
    alert(data.body);
});


