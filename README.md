1. Clone the Repository
Open Git Bash (or terminal).

Navigate to the directory where you want to store the project.

Run the following command:

git clone https://github.com/SD-Wire/product-management.git
Navigate into the project directory:


cd product-management

2. Install Dependencies
Ensure you have Composer installed. If not, follow the installation guide.

Install Laravel dependencies:


3. Set Up Environment Variables
Copy the .env.example file:


cp .env.example .env
Open the .env file and configure the database and other settings (example for MySQL):


DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=product_api
DB_USERNAME=root
DB_PASSWORD=
4. Generate Application Key
Generate the app key for security:


php artisan key:generate
5. Set Up the Database
Run migrations to create database tables:


php artisan migrate
(Optional) Seed some data:


php artisan db:seed
6. Run the Development Server
Start the Laravel development server:


php artisan serve
By default, the API will be available at http://127.0.0.1:8000.

7. Test the API
Use Postman or curl to test your API endpoints.

Method	Endpoint	        Description
GET  	/api/products	    List all products
POST	/api/products	    Create new product
GET	    /api/products/{id}	Show product details
PUT 	/api/products/{id}	Update product (owner only)
DELETE	/api/products/{id}	Delete product (owner only)
GET	    /api/products/search?name=phone	  Search products by name
