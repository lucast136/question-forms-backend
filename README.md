# Coopersmith Self-Esteem Test - Backend API

<p align="center">
<img src="https://img.shields.io/badge/Laravel-12.0-red.svg" alt="Laravel Version">
<img src="https://img.shields.io/badge/PHP-8.2%2B-blue.svg" alt="PHP Version">
<img src="https://img.shields.io/badge/Database-MySQL-orange.svg" alt="Database">
<img src="https://img.shields.io/badge/License-MIT-green.svg" alt="License">
</p>

## Overview

This Laravel application provides the backend API for the **Coopersmith Self-Esteem Test** administration platform. It's designed to handle psychological assessments, client management, and test result analysis for mental health professionals and researchers.

The Coopersmith Self-Esteem Inventory is a widely used psychological assessment tool that measures self-esteem levels across different areas of a person's life.

## Key Features

- **Form Management System**: Dynamic form creation and management for psychological assessments
- **Client Management**: Complete client profile management with demographic data
- **Test Administration**: Secure test taking environment with answer tracking
- **Multi-Section Forms**: Support for complex psychological assessments with multiple sections
- **Question Types**: Various question formats including multiple choice with scoring
- **User Authentication**: Secure API access using Laravel Sanctum
- **Professional API**: RESTful API built with Laravel Orion for advanced querying and filtering
- **Data Integrity**: Comprehensive validation and data protection measures

## Technical Stack

- **Framework**: Laravel 12.0
- **PHP Version**: 8.2+
- **API Layer**: Laravel Orion (Advanced REST API with filtering, searching, and includes)
- **Authentication**: Laravel Sanctum (API Token Authentication)
- **Database**: MySQL with Eloquent ORM
- **Frontend Assets**: Vite + TailwindCSS
- **Testing**: PHPUnit with Feature and Unit tests

## Database Schema

### Core Models

- **Forms**: Main form structure with metadata
- **FormSections**: Logical grouping of related questions
- **Questions**: Individual assessment questions
- **QuestionOptions**: Available responses with scoring values
- **Clients**: Test participant profiles and demographics
- **Answers**: Client responses and scoring data
- **Users**: System administrators and professionals

### Relationships

- Forms have multiple FormSections
- FormSections contain multiple Questions
- Questions have multiple QuestionOptions
- Clients provide multiple Answers
- Answers reference QuestionOptions

## API Endpoints

### Public Endpoints (No Authentication Required)

```
GET    /api/category-forms           # List form categories
GET    /api/category-forms/{id}      # Get specific form category
GET    /api/forms                    # List available forms
GET    /api/forms/{id}               # Get form details
GET    /api/form-sections            # List form sections
GET    /api/questions                # List questions
GET    /api/question-options         # List question options
POST   /api/clients                  # Register new client
POST   /api/answers                  # Submit test answers
```

### Authenticated Endpoints (Require API Token)

```
POST   /api/register                 # Register new user
POST   /api/login                    # User authentication
POST   /api/logout                   # User logout

# Complete CRUD operations for all resources when authenticated
GET|POST|PUT|DELETE /api/{resource}  # Full resource management
```

## Installation & Setup

### Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL 5.7+ or 8.0+
- Node.js & NPM (for asset compilation)

### Installation Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd coopersmith-backend
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   # Configure your database in .env
   php artisan migrate
   php artisan db:seed
   ```

5. **Asset compilation**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

6. **Start the server**
   ```bash
   php artisan serve
   ```

### Development Environment

For concurrent development (server + frontend + queue):
```bash
composer run dev
```

This runs:
- Laravel development server (`php artisan serve`)
- Queue worker (`php artisan queue:listen`)
- Vite development server (`npm run dev`)

## API Usage Examples

### Registering a Client
```bash
curl -X POST http://localhost:8000/api/clients \
  -H "Content-Type: application/json" \
  -d '{
    "apellidos": "García",
    "nombres": "Ana María",
    "email": "ana.garcia@email.com",
    "genero": "femenino",
    "edad": 25,
    "provincia": "Buenos Aires"
  }'
```

### Submitting Test Answers
```bash
curl -X POST http://localhost:8000/api/answers \
  -H "Content-Type: application/json" \
  -d '{
    "question_option_id": 1,
    "client_id": 1,
    "automatic_scoring": 4,
    "manual_scoring": null
  }'
```

### Advanced Filtering with Orion
```bash
# Filter forms by category
GET /api/forms?filter[category_form_id]=1

# Search questions by content
GET /api/questions?search=autoestima

# Include related data
GET /api/forms?include=sections,sections.questions
```

## Testing

Run the test suite:
```bash
composer test
# or
php artisan test
```

Run specific test types:
```bash
# Feature tests
php artisan test --testsuite=Feature

# Unit tests
php artisan test --testsuite=Unit
```

## Security Features

- **API Token Authentication**: Secure access control using Laravel Sanctum
- **Request Validation**: Comprehensive input validation for all endpoints
- **CORS Support**: Configured for frontend application integration
- **Rate Limiting**: API rate limiting to prevent abuse
- **Data Sanitization**: Input sanitization and XSS protection

## Professional Use

This system is designed for:
- **Clinical Psychologists**: Professional assessment administration
- **Researchers**: Data collection for psychological studies
- **Educational Institutions**: Student counseling and assessment
- **Healthcare Providers**: Mental health screening tools

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support

For technical support or questions about the Coopersmith Self-Esteem Test implementation, please contact the development team.
