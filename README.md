## Laravel 8.4 CTE Business Partner Database

Simple project for storing business partners, internship opportunities and student assignments.

---

### How to use

- Clone the repository with __git clone__
- Copy __.env.example__ file to __.env__ and edit database credentials there
- Then you'll need to need to set up your App registration and add the configuration to your .env file for Socialite authentication
- Run __composer install__
- Run __php artisan key:generate__
- Run __php artisan migrate__
- If you are using MySQL, modify this file, database/migrations/addInitialDBrecords.sql , with your first user and semester
- Then Run __mysql -u username -p < database/migrations/addInitialDBrecords.sql__
- That's it - load the homepage

---

### License

MIT License

---
