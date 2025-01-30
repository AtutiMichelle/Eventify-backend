
---

# **Eventify Backend** 🎟️🚀  
Laravel backend for the Eventify app, handling event registration, user authentication, and verification codes via a RESTful API.  

## **Features** ✨  
✅ User authentication (registration & login)  
✅ Event registration with verification codes  
✅ API endpoints for managing events and users  
✅ CSRF protection for secure requests  

## **Setup Instructions** ⚙️  

### **1. Clone the Repository**  
```bash
git clone https://github.com/your-username/eventify-backend.git
cd eventify-backend
```

### **2. Install Dependencies**  
Ensure you have **PHP**, **Composer**, and **Laravel** installed. Then run:  
```bash
composer install
```

### **3. Set Up Environment Variables**  
Copy the `.env.example` file and update your database credentials:  
```bash
cp .env.example .env
```
Then, update these lines in `.env`:  
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eventify_db
DB_USERNAME=root
DB_PASSWORD=
```

### **4. Generate Application Key**  
```bash
php artisan key:generate
```

### **5. Run Database Migrations**  
```bash
php artisan migrate
```

### **6. Start the Development Server**  
```bash
php artisan serve
```
Your API will now be available at:  
📍 `http://127.0.0.1:8000/api`  

---

## **API Endpoints** 🌐  

### **User Authentication** 🔑  
| Method | Endpoint           | Description               |
|--------|-------------------|---------------------------|
| POST   | `/api/register`   | Register a new user       |
| POST   | `/api/login`      | Log in and get a token    |

### **Event Registration** 🎫  
| Method | Endpoint              | Description                         |
|--------|-----------------------|-------------------------------------|
| POST   | `/api/events/register` | Register for an event              |
| GET    | `/api/events`          | Get a list of available events     |
| GET    | `/api/user/events`     | Get registered events for a user   |

---

## **CSRF Protection** 🔒  
Laravel enforces **CSRF protection** for all requests. Ensure you include a CSRF token in your API requests.  

For **Axios** or **Fetch API**, send a GET request to `/sanctum/csrf-cookie` before making authenticated requests.  

```javascript
fetch('http://127.0.0.1:8000/sanctum/csrf-cookie', {
  credentials: 'include'
});
```

---

## **Contributors** 💡  
- **Michelle Atuti** 🎓  

---

