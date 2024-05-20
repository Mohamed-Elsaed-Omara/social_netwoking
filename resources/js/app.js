import './bootstrap';

import $ from 'jquery';
window.$ = $;
window.jQuery = $;

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


var channel = Echo.private(`App.Models.User.${userId}`);
channel.notification(function(data) {
    console.log(data);
    alert(data.data);
    alert(JSON.stringify(data));
});


