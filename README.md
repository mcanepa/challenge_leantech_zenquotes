<p align="center">
	<img src="https://assets-global.website-files.com/636a549426aa8438b3b45fa8/63a20e5d67b32963e1f483b0_Tech_Color.svg" alt="" height="75">
</p>


## ¡Lean Tech ZenQuotes challenge!

This challenge will probe why you should hire me =)

Below are the instructions to install and run the project...

## Before we begin...

Make sure you have already installed git, composer and php >= 8.2 (with sqlite support)

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

## Step 4: Create database and table

Run

```
php artisan migrate:fresh --seed
```

Now edit `.env` file and change

```
CACHE_DRIVER=file
```

to

```
CACHE_DRIVER=database
```

## Step 5: Run the project

Execute

```
php artisan serve
```

Go to the browser at

```
http://127.0.0.1:8000
```

And that's it!!

You can register as a new user and then go to `http://127.0.0.1:8000/api-test` to see the project

## Tests

You could test the app by running

```
php artisan test --testSuite=Unit
```
