## 📚 Table of Contents

- [📌 About the Project](#-about-the-project)
- [💻 Technologies](#-technologies)
- [🔗 Links](#-links)
- [⚙️ How to run this project](#️-how-to-run-this-project)
- [📄 API Documentation](#-api-documentation)
  - [Category Endpoints](#category-endpoints)
  - [Product Endpoints](#product-endpoints)
- [🤖 Dialogflow Webhook Integration](#-dialogflow-webhook-integration)

## 📌 About the Project 

This is an API project developed with the Laravel framework. It allows you to create, update, and retrieve categories and products. The project is also integrated with a Dialogflow agent and currently supports only category-related operations.

## 💻 Technologies  

* Laravel Framework 12.10.1
* Composer 2.8.8
* PHP 8.2.12
* MySQL Workbench for data manager
* Postman for API testing
* Railway for deployment
* Dialogflow for chatbot integration

## 🔗 Links 

* [Documentation answer questions](https://docs.google.com/document/d/1EOfMovQTCWMI_qHpgUHj0dYQIwLZaf-VaLvMeNfnNSM/edit?usp=sharing)

* Link API public: https://laravel-api-test-production-079b.up.railway.app/

* [Document Dialogflow Webhook Interaction Evicence](https://docs.google.com/document/d/11aW-IOkFiDrXsjdfDkXb0n13UCjxuqGYLt1HulQmznM/edit?usp=sharing)

* [Dialogflow Json Files](https://drive.google.com/drive/folders/1IHQHurSzc__PVoSEjKWFbmPZn65NS4zv?usp=sharing)

## ⚙️ How to run this project 

1. Make sure you have PHP 8.2.12 and Composer 2.8.8 installed. 
2. Make sure you have a database manager (e.g., MySQL Workbench) installed and configured.
3. Clone the repository.
4. Config the `.env` file with your database credentials.
5. Run `composer install`
6. Run `php artisan key:generate`
7. Run `php artisan migrate`
8. Run `php artisan serve`

## 📄 API Documentation

### Category Endpoints

### 🟠 `GET /api/categories`

Retrieve a list of all available categories.

✅ **Response Example**

```javascript
    {
        "success": true,
        "message": "Categories retrieved successfully",
        "data": [
            {
                "id": 1,
                "name": "Category A",
                "description": "This is a category A"
            },
        ]
    }
```

### 🟠 `GET /api/categories/{id}`

Retrieves all details of a specific category by its ID.

📍 **Parameters**

* `id` (integer) - Category ID to retrieve.

✅ **Response Example**

```javascript
    {
    "success": true,
        "message": "Category found",
        "data": {
            "id": 1,
            "name": "Category A",
            "description": "This is a category A",
            "available_products": 14,
            "products": [
                {
                    "id": 1,
                    "name": "Product A",
                    "description": "This is a product A",
                    "quantity": 4,
                    "category_id": 1
                },
                {
                    "id": 4,
                    "name": "Product B",
                    "description": "This is a product B",
                    "quantity": 10,
                    "category_id": 1
                }
            ]
        }
    }
```

### 🟠 `GET /api/categories/{id}/available_products`

Retrieves the number of available products of a specific category by its ID.

📍 **Parameters**

* `id` (integer) - Category ID to retrieve.

✅ **Response Example**

```javascript
    {
        "success": true,
        "message": "Available products category",
        "data": 14
    }
```

### 🟠 `POST /api/categories`

Create a new category.

📥 **Body Parameters:**

| **Parameter** | **Type** | **Description**                              |
|---------------|----------|----------------------------------------------|
| `name`        | `string` | Name of the category                         |
| `description` | `string` | Description about the category               |


✅ **Response Example**

```javascript
    {
        "success": true,
        "message": "Created successfully",
        "data": {
            "name": "Category A",
            "description": "This is a category A",
            "id": 3
        }
    }
```

### 🟠 `PUT /api/categories/{id}`

Updates an existing category.

📍 **Parameters**

* `id` (integer) - Category ID to retrieve

📥 **Body Parameters:**

| **Parameter** | **Type** | **Description**                              |
|---------------|----------|----------------------------------------------|
| `name`        | `string` | Name of the category                         |
| `description` | `string` | Description about the category               |

✅ **Response Example**

```javascript
    {
        "success": true,
        "message": "Update successfully",
        "data": {
            "id": 3,
            "name": "Product A",
            "description": "This is a product A Update"
        }
    }
```


### Product Endpoints

### 🟠 `GET /api/products`

Retrieve a list of all available products.

✅ **Response Example**

```javascript
    {
        "success": true,
        "message": "Products retrieved successfully",
        "data": [
            {
                "id": 1,
                "name": "Product A",
                "description": "This is a product A",
                "quantity": 4,
                "category_id": 1
            },
            {
                "id": 2,
                "name": "Product B",
                "description": "This is a product B",
                "quantity": 3,
                "category_id": 2
            }
        ]
    }
```

### 🟠 `GET /api/products/{id}`

Retrieves details of a specific product by its ID.

📍 **Parameters**

* `id` (integer) - Product ID to retrieve

✅ **Response Example**

```javascript
   {
        "success": true,
        "message": "Product found",
        "data": {
            "id": 2,
            "name": "Product A",
            "description": "This is a product A",
            "quantity": 3,
            "category_id": 2
        }
    }
```

### 🟠 `POST /api/products/`

Creates a new product.

📥 **Body Parameters:**

| **Parameter** | **Type** | **Description**                             |
|---------------|----------|---------------------------------------------|
| `name`        | `string` | Name of the product                         |
| `description` | `string` | Description about the product               |
| `quantity`    | `integer`| Quantity of the product                     |
| `category_id` | `integer`| ID Category of product                      |


✅ **Response Example**

```javascript
   {
        "success": true,
        "message": "Created successfully",
        "data": {
            "name": "Product test",
            "description": "This is a Product test",
            "quantity": 10,
            "category_id": 1,
            "id": 4
        }
    }
```

### 🟠 `PUT /api/products/{id}`

Updates an existing product.

📥 **Body Parameters:**

| **Parameter** | **Type** | **Description**                             |
|---------------|----------|---------------------------------------------|
| `name`        | `string` | Name of the product                         |
| `description` | `string` | Description about the product               |
| `quantity`    | `integer`| Quantity of the product                     |
| `category_id` | `integer`| ID Category of product                      |

✅ **Response Example**

```javascript
   {
        "success": true,
        "message": "Update successfully",
        "data": {
            "id": 4,
            "name": "Product test",
            "description": "This is a Product test update",
            "quantity": 10,
            "category_id": 1
        }
    }
```

## 🤖 Dialogflow Webhook Integration

### Endpoint for Dialogflow Webhook

### 🟠 `POST /api/dialogflow`

This endpoint receives webhook requests from the Dialogflow agent and routes them to the appropriate logic based on the detected intent.

The webhook uses the `intent.displayName` to determine the requested action and process the corresponding parameters.

Webhook fulfillment is configured to point to:

**POST** `https://laravel-api-test-production-079b.up.railway.app/api/dialogflow`

**Supported Intents**

| **Intent Name**      | **Description**                                                             |
|----------------------|-----------------------------------------------------------------------------|
| `Available Products` | Retrieves the number of available products of a specific category by its ID |
| `Categories`         | Retrieves all categories                                                    |
| `Create Category`    | Creates a new category                                                      |
| `Show Category`      | Retrieves all details of a specific category by its ID                      |

### Evidence Interaction

The following link content a documents with images about the interaction and json intents files:

* [Document Evicence](https://docs.google.com/document/d/11aW-IOkFiDrXsjdfDkXb0n13UCjxuqGYLt1HulQmznM/edit?usp=sharing)

* [Json Files](https://drive.google.com/drive/folders/1IHQHurSzc__PVoSEjKWFbmPZn65NS4zv?usp=sharing)
