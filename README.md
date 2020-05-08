
## About

This tool used to create interconnected laravel-based framework applications using Action based controller and shared system tables.
We used action based concept to make our application simple, maintainable, focus on one task and reusable actions/tasks and somehow adapt <a href="https://medium.com/@severinperez/writing-flexible-code-with-the-single-responsibility-principle-b71c4f3f883f"><strong>Single Responsibility Principle</strong></a>.
You are free to used standard laravel MVC concept as you wish. 

##Setup Guide

- Clone this project
- Create new database
- Copy .env.example to .env and configure according to your needs
- Import sql file from database folder of this project to populate initial data for system tables
- Run this commands to install required packages "composer install && php artisan passport:keys && npm install && npm run dev"

##Important

- Don't forget to change "APP_ID" in .env, open your applications table and copy the "id" value of your application
- Put 1 value on "ADMIN_APP" in .env file to specify this project as your main application or dashboard of apps
- Make sure your APP_URL value in .env matches the browser url you access the application

##Commands to Remember

#### Generate Module Scaffolding
- php artisan generate:module ModuleName

## Other commands
Refer to package laravel module package documentation <a href="https://nwidart.com/laravel-modules/v6/introduction">Laravel Modules</a>.

##Packages
###PHP
- <a href="https://github.com/lorisleiva/laravel-actions">Laravel Actions</a>
- <a href="https://docs.spatie.be/laravel-activitylog/v3/introduction/">Activity Log</a>
- <a href="http://www.laravel-auditing.com/docs/9.0/introduction">Autdit Log</a>
- <a href="https://github.com/yajra/laravel-datatables-docs">DataTables</a>
###JS/Frontend Packages
- <a href="https://getbootstrap.com/docs/4.4/getting-started/introduction/">Bootstrap</a>
- <a href="https://vuejs.org/v2/guide/">VueJS</a>
- <a href="https://sweetalert.js.org/guides/">SweetAlert</a>
- <a href="https://github.com/bantikyan/icheck-bootstrap#readme">icheck-bootstrap</a>

###Vue Components
- <a href="https://bootstrap-vue.js.org/docs">BootstrapVue</a>
- <a href="https://element.eleme.io/#/en-US/component/installation">ElementUI</a>

###JS HTTP Client
- <a href="https://github.com/axios/axios">Axios</a>


##Contribute
Please contribute/share any ideas to make our development as simple as possible without sacrificing quality of code.
