git clone https://github.com/Sajag-Shrestha/RoomHaven.git on C:\xampp\htdocs\{current.file} or C:\wamp\www\{current.file}

Be sure to open Xampp or Wamp server beforehand

Before Running the file run following commands in the file directory: i.e. C:\xampp\htdocs\{current.file} or C:\wamp\www\{current.file}

> composer install

> cp .env.example .env

> php artisan key:generate

> php artisan migrate:refresh --seed

> php artisan serve

Done...

Now there are some data values in seeder:

User Login Credentials
-------------------------
Admin: Email = admin@gmail.com | Password = admin123
Manager: Email = manager@gmail.com | Password = manager123
Guest: Email = guest@gmail.com || Password = guest123




