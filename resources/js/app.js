import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

var channel = Echo.private(`App.Models.User.${user_id}`);
channel.notification(function(data) {
  toastr.error(data.body);

});
