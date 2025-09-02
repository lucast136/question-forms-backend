# Test de Autoestima de Coopersmith - API Backend

<p align="center">
<img src="https://img.shields.io/badge/Laravel-12.0-red.svg" alt="Versión Laravel">
<img src="https://img.shields.io/badge/PHP-8.2%2B-blue.svg" alt="Versión PHP">
<img src="https://img.shields.io/badge/Base%20de%20Datos-MySQL-orange.svg" alt="Base de Datos">
<img src="https://img.shields.io/badge/Licencia-MIT-green.svg" alt="Licencia">
</p>

## Descripción General

Esta aplicación Laravel proporciona la API backend para la plataforma de administración del **Test de Autoestima de Coopersmith**. Está diseñada para manejar evaluaciones psicológicas, gestión de clientes y análisis de resultados de pruebas para profesionales de la salud mental e investigadores.

El Inventario de Autoestima de Coopersmith es una herramienta de evaluación psicológica ampliamente utilizada que mide los niveles de autoestima en diferentes áreas de la vida de una persona.

## Características Principales

- **Sistema de Gestión de Formularios**: Creación y gestión dinámica de formularios para evaluaciones psicológicas
- **Gestión de Clientes**: Gestión completa de perfiles de clientes con datos demográficos
- **Administración de Pruebas**: Entorno seguro para realizar pruebas con seguimiento de respuestas
- **Formularios Multi-sección**: Soporte para evaluaciones psicológicas complejas con múltiples secciones
- **Tipos de Preguntas**: Varios formatos de preguntas incluyendo opción múltiple con puntuación
- **Autenticación de Usuarios**: Acceso seguro a la API usando Laravel Sanctum
- **API Profesional**: API RESTful construida con Laravel Orion para consultas y filtrado avanzados
- **Integridad de Datos**: Medidas exhaustivas de validación y protección de datos

## Stack Tecnológico

- **Framework**: Laravel 12.0
- **Versión PHP**: 8.2+
- **Capa API**: Laravel Orion (API REST avanzada con filtrado, búsqueda e inclusiones)
- **Autenticación**: Laravel Sanctum (Autenticación con Token API)
- **Base de Datos**: MySQL con Eloquent ORM
- **Assets Frontend**: Vite + TailwindCSS
- **Testing**: PHPUnit con pruebas Feature y Unit

## Esquema de Base de Datos

### Modelos Principales

- **Forms**: Estructura principal del formulario con metadatos
- **FormSections**: Agrupación lógica de preguntas relacionadas
- **Questions**: Preguntas individuales de evaluación
- **QuestionOptions**: Respuestas disponibles con valores de puntuación
- **Clients**: Perfiles de participantes y datos demográficos
- **Answers**: Respuestas de clientes y datos de puntuación
- **Users**: Administradores del sistema y profesionales

### Relaciones

- Los Forms tienen múltiples FormSections
- Los FormSections contienen múltiples Questions
- Las Questions tienen múltiples QuestionOptions
- Los Clients proporcionan múltiples Answers
- Las Answers referencian QuestionOptions

## Endpoints de la API

### Endpoints Públicos (Sin Autenticación Requerida)

```
GET    /api/category-forms           # Listar categorías de formularios
GET    /api/category-forms/{id}      # Obtener categoría específica
GET    /api/forms                    # Listar formularios disponibles
GET    /api/forms/{id}               # Obtener detalles del formulario
GET    /api/form-sections            # Listar secciones de formulario
GET    /api/questions                # Listar preguntas
GET    /api/question-options         # Listar opciones de preguntas
POST   /api/clients                  # Registrar nuevo cliente
POST   /api/answers                  # Enviar respuestas del test
```

### Endpoints Autenticados (Requieren Token API)

```
POST   /api/register                 # Registrar nuevo usuario
POST   /api/login                    # Autenticación de usuario
POST   /api/logout                   # Cerrar sesión

# Operaciones CRUD completas para todos los recursos cuando está autenticado
GET|POST|PUT|DELETE /api/{resource}  # Gestión completa de recursos
```

## Instalación y Configuración

### Requisitos Previos

- PHP 8.2 o superior
- Composer
- MySQL 5.7+ o 8.0+
- Node.js y NPM (para compilación de assets)

### Pasos de Instalación

1. **Clonar el repositorio**
   ```bash
   git clone <url-repositorio>
   cd coopersmith-backend
   ```

2. **Instalar dependencias**
   ```bash
   composer install
   npm install
   ```

3. **Configuración del entorno**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configurar base de datos**
   ```bash
   # Configurar tu base de datos en .env
   php artisan migrate
   php artisan db:seed
   ```

5. **Compilar assets**
   ```bash
   npm run build
   # o para desarrollo
   npm run dev
   ```

6. **Iniciar el servidor**
   ```bash
   php artisan serve
   ```

### Entorno de Desarrollo

Para desarrollo concurrente (servidor + frontend + cola):
```bash
composer run dev
```

Esto ejecuta:
- Servidor de desarrollo Laravel (`php artisan serve`)
- Worker de colas (`php artisan queue:listen`)
- Servidor de desarrollo Vite (`npm run dev`)

## Ejemplos de Uso de la API

### Registrar un Cliente
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

### Enviar Respuestas del Test
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

### Filtrado Avanzado con Orion
```bash
# Filtrar formularios por categoría
GET /api/forms?filter[category_form_id]=1

# Buscar preguntas por contenido
GET /api/questions?search=autoestima

# Incluir datos relacionados
GET /api/forms?include=sections,sections.questions
```

## Testing

Ejecutar la suite de pruebas:
```bash
composer test
# o
php artisan test
```

Ejecutar tipos específicos de pruebas:
```bash
# Pruebas Feature
php artisan test --testsuite=Feature

# Pruebas Unit
php artisan test --testsuite=Unit
```

## Características de Seguridad

- **Autenticación con Token API**: Control de acceso seguro usando Laravel Sanctum
- **Validación de Requests**: Validación exhaustiva de entrada para todos los endpoints
- **Soporte CORS**: Configurado para integración con aplicación frontend
- **Límite de Velocidad**: Limitación de velocidad de API para prevenir abuso
- **Sanitización de Datos**: Sanitización de entrada y protección XSS

## Uso Profesional

Este sistema está diseñado para:
- **Psicólogos Clínicos**: Administración profesional de evaluaciones
- **Investigadores**: Recolección de datos para estudios psicológicos
- **Instituciones Educativas**: Consejería estudiantil y evaluación
- **Proveedores de Atención Médica**: Herramientas de screening de salud mental

## Licencia

Este proyecto está licenciado bajo la Licencia MIT - consulte el archivo [LICENSE](LICENSE) para más detalles.

## Soporte

Para soporte técnico o preguntas sobre la implementación del Test de Autoestima de Coopersmith, por favor contacte al equipo de desarrollo.
