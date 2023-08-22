# About this project
Welcome to my Laravel project. This project aims to be a starting point to learn Laravel with the VILT-stack which will be described further down. I will try to stick to the default Breeze installation in terms of backend core functionality but as the application grows there could be a need for a more fine-granular permissions and roles for which the [Spatie permissions](https://spatie.be/docs/laravel-permission/v5/introduction) could be an ideal package to install that functionality.

## Stack used throughout this project
This project uses the [VILT Stack](https://viltstack.dev/) which consists of these four magnificent frameworks:
- **[Vue.js](https://vuejs.org/)**: Used for building a modular frontend with reusable components and encapsulated JavaScript to make the page more interactive.
- **[Inertia.js](https://inertiajs.com/)**: This framework couples the frontend frameworks (Vue and Tailwind CSS) together and creates routing which can **directly** interact with the backend without the requirement of an API. It is a direct replacement for Laravel Blades where each page routing results in a "hard" page transition - Inertia.js takes the backend routes and creates "softer" routing as you are used to in Vue.js (or comparable frameworks).
- **[Tailwind CSS](https://tailwindcss.com/)**: Tailwind CSS is used to create more uniform web pages (or routes) whilst making the process of styling the pages faster at the same time. No need to struggle about almost identical colors, spacing, etc. anymore as Tailwind CSS provides a certain abstraction level on top of vanilla CSS.
- **[Laravel](https://laravel.com/)**: This PHP [MVC](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller)-framework powers the complete backend and brings core functionalities such as Authentication, Routing, Database Seeding and an intuitive [ORM](https://en.wikipedia.org/wiki/Object%E2%80%93relational_mapping). Even though the backend is tightly coupled with the frontend (through Inertia.js) the backend will possibly be easily extendible in order to power an API for the same data as the current Vue.js framework will use the API resources, which currently simply aren't accessible from outside the application itself.

### Starter Kit
This application uses the _Breeze & Vue_ starter kit, to which the installation guide as well as the documentation can be found in the Laravel documentation. This starter kit ships with a clean and functioning VILT-stack implementation as well as a simple starting dashboard which can be easily customized and extended to the project needs.

# Application Info
This project was created using the [composer](https://getcomposer.org/) dependency manager for PHP. Therefore, a recent version of PHP is required in order to get the application up and running.

For the frontend, you need a recent version of [Node](https://nodejs.org/en) as well as the NPM package manager.

> [!WARNING]
> Even though Laravel supports Docker, those files are not installed in this project. As I am not able to run the docker environment, there is no way for me to test this and therefore those files are not included.

## First Steps
After having downloaded this application on your desired machine, make sure to follow this steps to get started with this application:

1. First navigate to the root folder of this project. This is, where you are going to run all commands.
3. Create a copy of the environment file `.env.example` and call it `.env`.
4. Change the credentials to the different services. For certain services there are different drivers to choose from (i.e. for the database there is mysql, pgsql, etc.).
5. Install the NPM packages and build the database as specified in the migrations:
```bash
npm i && php artisan migrate
```
6. Start the frontend via `npm run dev` and the backend using `php artisan serve`.
