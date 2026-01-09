# 🍛 Desi Delights - Food Delivery System

A complete Laravel-based food delivery application with admin panel, user dashboard, and dynamic ordering system.

## 🚀 Features

### Frontend
- **Dynamic Homepage** with popular dishes from database
- **Menu Page** with category-wise food items
- **Guest Cart System** using localStorage
- **Professional Checkout** with customer details collection
- **Auto Account Creation** with email notifications
- **Responsive Design** with Tailwind CSS

### User Dashboard
- **Order Tracking** with real-time status updates
- **Order History** with detailed view
- **Profile Management** with password change
- **Role-based Access** (user role)

### Admin Panel
- **Dynamic Dashboard** with real-time statistics
- **Order Management** with status updates
- **Menu Management** (CRUD operations)
- **Category Management** (CRUD operations)
- **User Management** with role assignment
- **Settings Management**
- **Role-based Access** (admin role)

### Key Functionality
- **Role-based Authentication** (Admin/User)
- **Event-Driven Email System** with automated notifications
- **Order Notifications** to admin (easystep25@gmail.com)
- **Status Update Emails** to customers
- **Welcome Emails** with login credentials for new users
- **Image Upload** for menu items
- **SweetAlert Integration** for better UX
- **DataTables** for data management
- **AJAX Operations** for seamless updates

## 📧 Event-Driven Email System

### Email Notifications
- **Order Placed** → Admin receives notification at `easystep25@gmail.com`
- **New User Registration** → Customer receives welcome email with login credentials
- **Order Status Update** → Customer receives status change notifications

### Events & Listeners
```php
// Events
OrderPlaced::class → SendOrderNotification::class
UserRegistered::class → SendWelcomeEmailToUser::class
OrderStatusUpdated::class → SendCustomerStatusUpdate::class
```

### Email Templates
- `order-notification.blade.php` - Admin order notifications
- `welcome.blade.php` - New user welcome emails
- `order-status-update.blade.php` - Customer status updates

## 🛠️ Installation

1. **Clone Repository**
   ```bash
   git clone <repository-url>
   cd food
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration**
   Update `.env` file:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=food
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Email Configuration**
   Update `.env` file:
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=your-email@gmail.com
   MAIL_PASSWORD=your-app-password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS="your-email@gmail.com"
   MAIL_FROM_NAME="Desi Delights"
   ```

6. **Run Migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed Database**
   ```bash
   php artisan db:seed --class=RoleSeeder
   php artisan db:seed --class=UserSeeder
   php artisan db:seed --class=CategorySeeder
   php artisan db:seed --class=OrderSeeder
   ```

8. **Create Storage Link**
   ```bash
   php artisan storage:link
   ```

9. **Start Development Server**
   ```bash
   php artisan serve
   ```

## 🔐 Default Credentials

### Admin Access
- **Email:** admin@gmail.com
- **Password:** 12345678
- **URL:** http://127.0.0.1:8000/admin/dashboard

### Test User
- **Email:** user@gmail.com
- **Password:** 12345678
- **URL:** http://127.0.0.1:8000/my/dashboard

## 📱 Application URLs

### Frontend
- **Homepage:** http://127.0.0.1:8000/
- **Menu:** http://127.0.0.1:8000/menu
- **Cart:** http://127.0.0.1:8000/cart

### User Dashboard
- **Dashboard:** http://127.0.0.1:8000/my/dashboard
- **Orders:** http://127.0.0.1:8000/my/orders
- **Profile:** http://127.0.0.1:8000/my/profile

### Admin Panel
- **Dashboard:** http://127.0.0.1:8000/admin/dashboard
- **Orders:** http://127.0.0.1:8000/admin/orders
- **Menu:** http://127.0.0.1:8000/admin/menu
- **Categories:** http://127.0.0.1:8000/admin/categories
- **Users:** http://127.0.0.1:8000/admin/users
- **Settings:** http://127.0.0.1:8000/admin/settings

## 🎯 How It Works

### For Guests
1. Browse menu and add items to cart
2. Proceed to checkout
3. Enter customer details
4. Account created automatically
5. Login credentials sent via email
6. Order placed successfully

### For Registered Users
1. Login with credentials
2. Browse menu and add to cart
3. Streamlined checkout (pre-filled details)
4. Track orders in dashboard
5. Manage profile and view history

### For Admins
1. Login to admin panel
2. Manage orders, menu, categories
3. Update order status in real-time
4. Manage users and settings
5. View analytics and reports

## 🛡️ Security Features

- **Role-based Access Control** using Spatie Laravel Permission
- **CSRF Protection** on all forms
- **Input Validation** and sanitization
- **Password Hashing** using Laravel's Hash facade
- **Email Verification** for new accounts
- **Secure File Uploads** with validation

## 📦 Tech Stack

- **Backend:** Laravel 11
- **Frontend:** Blade Templates, Tailwind CSS
- **Database:** MySQL
- **Authentication:** Laravel Auth + Spatie Permission
- **Email System:** Event-Driven with Laravel Mail + SMTP
- **Events:** OrderPlaced, UserRegistered, OrderStatusUpdated
- **JavaScript:** Vanilla JS, SweetAlert2, DataTables
- **File Storage:** Local Storage

## 🤝 Contributing

1. Fork the repository
2. Create feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Open Pull Request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 📞 Support

For support, email orders@desidelights.com or create an issue in the repository.

---

**Desi Delights** - Authentic Indian Food Delivery 🍛
