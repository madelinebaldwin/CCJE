FUNDTRACK LARAVEL STARTER FILES
For the CCJE SBO classroom collection and event expense reporting system.

IMPORTANT:
This is a starter bundle of files to copy into an existing Laravel project.
It is not a complete Laravel installation and does not include vendor/, node_modules/,
or the Laravel framework itself.

1. Create a Laravel project if you do not already have one:
   composer create-project laravel/laravel FundTrack
   cd FundTrack

2. Copy the folders/files from this bundle into the matching locations in your Laravel project.
   If a file already exists, merge its contents carefully rather than blindly overwriting it.

3. Configure your MySQL database in .env, for example:
   DB_DATABASE=fundtrack
   DB_USERNAME=root
   DB_PASSWORD=

4. Run:
   php artisan migrate
   php artisan serve

5. Open the local URL shown by Laravel.

Included:
- Events
- Classrooms
- Event classroom collection targets
- Expenses
- Dashboard summary
- Basic event and expense forms
- Starter database migrations and models

Notes:
- This starter does not yet include login/authentication, PDF/Excel export, receipt upload,
  student-by-student payments, or full audit logs.
- Add authentication before using real financial records.
- Sample balances are calculated from saved records; they are not manually stored totals.
