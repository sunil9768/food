# 🍛 Desi Delights - Multi-Vendor Food Delivery System

A complete Laravel-based multi-vendor food delivery application with admin panel, vendor dashboard, user dashboard, and dynamic ordering system.

## 🚀 Features

### Frontend
- **Dynamic Homepage** with popular dishes from all vendors
- **Restaurant Listing** with vendor cards and banner images
- **Individual Restaurant Menus** with category-wise food items and first category selected by default
- **Guest Cart System** using localStorage
- **Professional Checkout** with customer details collection
- **Auto Account Creation** with email notifications
- **Responsive Design** with Bootstrap and Tailwind CSS

### User Dashboard
- **Order Tracking** with real-time status updates
- **Order History** with detailed view
- **Profile Management** with password change
- **Role-based Access** (user role)

### Vendor Dashboard
- **Restaurant Profile** with banner image upload
- **Menu Management** (CRUD operations) for vendor's items only
- **Order Management** with status updates for vendor's orders
- **Dashboard Statistics** showing vendor-specific metrics
- **Role-based Access** (vendor role)

### Admin Panel
- **Dynamic Dashboard** with real-time statistics
- **Order Management** with status updates for all orders
- **Menu Management** (CRUD operations) for all items
- **Category Management** (CRUD operations)
- **User Management** with role assignment (Admin/User/Vendor)
- **Vendor Management** with restaurant details
- **Settings Management**
- **Role-based Access** (admin role)

### Key Functionality
- **Multi-Vendor System** - Multiple restaurants can register and manage their menus
- **Role-based Authentication** (Admin/User/Vendor)
- **Event-Driven Email System** with automated notifications
- **Order Notifications** to admin (easystep25@gmail.com)
- **Status Update Emails** to customers
- **Welcome Emails** with login credentials for new users
- **Image Upload** for menu items and restaurant banners
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

6. **Run Migrations & Seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Create Storage Link**
   ```bash
   php artisan storage:link
   ```

8. **Start Development Server**
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

### Test Vendor
- **Email:** vendor@gmail.com
- **Password:** 12345678
- **URL:** http://127.0.0.1:8000/vendor/dashboard

## 📱 Application URLs

### Frontend
- **Homepage:** http://127.0.0.1:8000/
- **Restaurants:** http://127.0.0.1:8000/menu
- **Individual Restaurant:** http://127.0.0.1:8000/vendor/{id}/menu
- **Cart:** http://127.0.0.1:8000/cart

### User Dashboard
- **Dashboard:** http://127.0.0.1:8000/my/dashboard
- **Orders:** http://127.0.0.1:8000/my/orders
- **Profile:** http://127.0.0.1:8000/my/profile

### Vendor Dashboard
- **Dashboard:** http://127.0.0.1:8000/vendor/dashboard
- **Menu Management:** http://127.0.0.1:8000/vendor/menu
- **Orders:** http://127.0.0.1:8000/vendor/orders
- **Profile:** http://127.0.0.1:8000/vendor/profile

### Admin Panel
- **Dashboard:** http://127.0.0.1:8000/admin/dashboard
- **Orders:** http://127.0.0.1:8000/admin/orders
- **Menu:** http://127.0.0.1:8000/admin/menu
- **Categories:** http://127.0.0.1:8000/admin/categories
- **Users:** http://127.0.0.1:8000/admin/users
- **Settings:** http://127.0.0.1:8000/admin/settings

## 🎯 How It Works

### For Guests
1. Browse restaurants and their menus
2. Add items to cart from different vendors
3. Proceed to checkout
4. Enter customer details
5. Account created automatically
6. Login credentials sent via email
7. Order placed successfully

### For Registered Users
1. Login with credentials
2. Browse restaurants and menus
3. Add items to cart
4. Streamlined checkout (pre-filled details)
5. Track orders in dashboard
6. Manage profile and view history

### For Vendors
1. Register as vendor with restaurant details
2. Upload restaurant banner image
3. Add menu items with images and categories
4. Manage orders containing their items
5. Update order status (pending → confirmed → preparing → ready → delivered)
6. View vendor-specific analytics

### For Admins
1. Login to admin panel
2. Manage all orders, menus, categories
3. Manage users and vendors
4. Update order status in real-time
5. Manage system settings
6. View comprehensive analytics and reports

## 🏪 Multi-Vendor System

### Vendor Registration
- Vendors register with restaurant name and banner image
- Each vendor manages their own menu items
- Vendor-specific order management
- Restaurant branding with custom banners

### Restaurant Display
- Homepage shows popular items from all vendors
- Restaurant listing page with vendor cards
- Individual restaurant pages with category-filtered menus (first category selected by default)
- Category-wise item organization with improved navigation

### Order Management
- Orders can contain items from multiple vendors
- Each vendor sees only their items in orders
- Vendors can update status for their items
- Admin has full order management access

## 🛡️ Security Features

- **Role-based Access Control** using Spatie Laravel Permission
- **CSRF Protection** on all forms
- **Input Validation** and sanitization
- **Password Hashing** using Laravel's Hash facade
- **Email Verification** for new accounts
- **Secure File Uploads** with validation
- **Vendor Isolation** - vendors can only access their own data

## 📦 Tech Stack

- **Backend:** Laravel 11
- **Frontend:** Blade Templates, Bootstrap 5, Tailwind CSS
- **Database:** MySQL
- **Authentication:** Laravel Auth + Spatie Permission
- **Email System:** Event-Driven with Laravel Mail + SMTP
- **Events:** OrderPlaced, UserRegistered, OrderStatusUpdated
- **JavaScript:** Vanilla JS, SweetAlert2, DataTables
- **File Storage:** Local Storage with symlink
- **Deployment:** GitHub Actions + Hostinger

## 📂 Food Categories

- Soup
- Starters
- Rice and Biryani
- Noodles
- Indian Breads
- Accompaniment
- Desserts
- Main Course
- Sizzlers
- Indian Curry Veg
- Momos
- Salads
- Tandoor and Grill Veg
- Roll Sandwich and Wraps
- Burgers
- Pasta

## 🚀 Deployment

The application includes GitHub Actions workflow for automatic deployment to Hostinger:

```yaml
# Automatic deployment on push to master branch
# Includes: rsync, migrations, seeders, cache clearing
```

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

**Desi Delights** - Multi-Vendor Food Delivery Platform 🍛
