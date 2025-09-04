# Makaan Pk - Pakistan Real Estate Portal

![Pins.pk Screenshot] <!-- Add actual screenshot later -->

A comprehensive Laravel-based real estate platform connecting buyers, sellers, and renters across Pakistan.

## Key Features

### Property Management

-   🏠 Multi-type property listings (Homes, Plots, Commercial)
-   📸 High-quality image galleries with zoom functionality
-   🗺️ Integrated Google Maps for property locations
-   🔍 Advanced search filters (Price, Location, Beds/Baths, Area)
-   📈 Price trend visualization for neighborhoods

### User System

-   👤 Role-based accounts (Buyers, Sellers, Agents)
-   🔐 Secure authentication with email verification
-   💼 Agent profile pages with portfolio display
-   ❤️ Favorite property saving system

### Transactions & Communication

-   💬 Built-in messaging system
-   📅 Appointment scheduling for viewings
-   ⚖️ Property comparison tool
-   📱 SMS/Email notifications for important updates

### Business Features

-   🏢 Agency management dashboard
-   📊 Analytics for property performance
-   💰 Commission calculation system
-   📑 Digital contract templates

## Technology Stack

### Backend

-   **Framework**: Laravel 12+
-   **Database**: MySQL
-   **Search**: Laravel Scout with Algolia/Meilisearch
-   **Payments**: Stripe/JazzCash integration
-   **API**: RESTful endpoints for mobile apps

### Frontend

-   **CSS**: BootStrap 5
-   **JavaScript**: Liverwire
-   **Maps**: Google Maps API
-   **Media**: Image optimization with Intervention Image

## Installation

1. Clone repository:
   bash
   git clone https://github.com/anjumsohail/RealEstate.git
   composer install
   npm install
   cp .env.example .env
   php artisan key:generate
   php artisan migrate --seed

### Required environment variables:

GOOGLE_MAPS_API_KEY=your_key_here
SMS_API_KEY=your_sms_provider_key
MAIL_DRIVER=smtp
STRIPE_KEY=your_stripe_key
