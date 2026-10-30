# Standee QR (simple Laravel)

Dynamic QR codes: QR holds a short link (`/s1`), destination is changed from the admin panel.
Single mode = direct redirect, Multi mode = landing page with buttons. Scan and click counts included.
No Node / npm / Tailwind needed.

## Setup
1. `composer install`
2. Copy `.env.example` to `.env`, set DB_* and APP_URL
3. `php artisan key:generate`
4. `php artisan migrate`
5. `php artisan db:seed --class=StandeeSeeder`   (creates s1..s50)
6. `php artisan make:admin you@example.com YourStrongPassword "Your Name"`
7. `php artisan serve`  then open `/login`

Registration is disabled. Use `make:admin` to create or reset the admin.
QR codes use APP_URL, so set the final domain before downloading print QRs.

## Users
- `php artisan make:admin email password "Name"` makes an admin (sees everything).
- Admin creates normal users from the Users page and assigns standees (Owner column or range form).
- A normal user only sees their own standees: edit page/links, view scans, download QR.
