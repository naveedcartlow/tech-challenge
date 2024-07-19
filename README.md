// Setup instructions

1- Clone repository 

2- Run composer update command to download dependencies

3- Create database with name api

4- Set database credentials into .env file. I'm using username: root and Password: root

5- After setting database into env file. Run following command:

	php bin/console make:migration
	
This command will run all required database schema and setup for next process.

6- User follow endpoint for API

	http://127.0.0.1:8000/user/create
	
7- Body for API will be

	{"firstname":"Naveed","lastname":"Iqbal","email":"naveed.official1@gmail.com"}
	
	