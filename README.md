<p align="center">
	<img src="https://assets-global.website-files.com/636a549426aa8438b3b45fa8/63a20e5d67b32963e1f483b0_Tech_Color.svg" alt="" height="75">
</p>


## ¡Lean Tech ZenQuotes challenge!

This challenge will probe why you should hire me =)

Below are the instructions to install and run the project...

## Before we begin...

Make sure you have already installed git, composer, node >= 18.19 and php >= 8.2 (with sqlite support)

## Step 1: Clone the repository

Open a terminal console and run

```
git clone https://github.com/mcanepa/zenquotes
```

Then enter directory

```
cd zenquotes
```

## Step 2: Install project and dependencies

Once inside directory run:

```
composer install
```

## Step 3: Create env file

At root level, there is a file named `.env.example`. Duplicate that file as ```.env```

Now, generate an application key

```
php artisan key:generate
```

## Step 4: Create database and tables

Run

```
php artisan migrate
```

It will prompt you to create the database, answer YES

Now edit `.env` file and change

```
CACHE_DRIVER=file
```

to

```
CACHE_DRIVER=database
```

And we are ready to seed the database with some data!!

```
php artisan migrate:fresh --seed
```

## Step 5: Run the project

We are closer to see the app!! just a couple commands...

Run

```
npm install
```

and then

```
npm run build
```

And yes, we finally serve the project!!

```
php artisan serve
```

And go to the browser at

```
http://127.0.0.1:8000
```

And that's it!!

You can register as a new user and then go to `http://127.0.0.1:8000/today` to see an inspirational quote!!!

## Tests

You could test the app by running

```
php artisan test --testSuite=Unit
```

P.S.: More tests coming soon!
