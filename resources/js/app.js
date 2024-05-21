import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

var userId = document.getElementById('user_id').value;

var channel = window.Echo.private(`App.Models.User.${userId}`);
channel.notification((data) => {
    alert(data.body);

    var notificationList = document.getElementById('notification_list');
    var notificationItem = document.createElement('li');
    notificationItem.textContent = data.body;
    notificationList.appendChild(notificationItem);

    var notificationCount = document.getElementById('notification_count');
    var count = parseInt(notificationCount.textContent);
    notificationCount.textContent = count + 1;
});
asfsaf

