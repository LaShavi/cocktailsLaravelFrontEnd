# 🍹 Aplicación de Cócteles Laravel - Prueba Técnica

Una aplicación moderna de Laravel 12 que consume la API pública de TheCocktailDB para explorar y guardar recetas de cócteles. Construida con autenticación, persistencia de datos y una interfaz de usuario intuitiva utilizando Blade templates, jQuery, DataTables y Tailwind CSS.

## 🎯 Descripción General del Proyecto

Esta prueba técnica demuestra capacidades de desarrollo web full-stack con:
- **Autenticación de Usuarios**: Login seguro, registro y restablecimiento de contraseña mediante Laravel Breeze
- **Integración de API**: Consumo en tiempo real de la API REST de TheCocktailDB
- **Persistencia de Datos**: Almacenamiento en MySQL de cócteles guardados por el usuario
- **Interfaz Interactiva**: Búsqueda y operaciones save/delete con AJAX sin recargar la página
- **UX Profesional**: DataTables para ordenamiento/filtrado, SweetAlert2 para confirmaciones
- **Diseño Responsivo**: Diseño amigable con dispositivos móviles con Tailwind CSS

---

## 🚀 Inicio Rápido

### Requisitos Previos
- **PHP**: 8.3+ (incluido con Laragon)
- **MySQL**: 8.0+ (incluido con Laragon)
- **Node.js**: 18+ (para compilación de assets)
- **Composer**: 2.0+ (para dependencias de PHP)

### Instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/LaShavi/cocktailsLaravelFrontEnd.git
   cd cocktailsLaravelFrontEnd
   ```

2. **Instalar dependencias de PHP**
   ```bash
   composer install
   ```

3. **Instalar dependencias de JavaScript**
   ```bash
   npm install
   ```

4. **Crear configuración de entorno**
   ```bash
   cp .env.example .env
   ```

5. **Generar clave de aplicación**
   ```bash
   php artisan key:generate
   ```

6. **Actualizar credenciales de base de datos en `.env`**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=cocktails_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. **Ejecutar migraciones de base de datos**
   ```bash
   php artisan migrate
   ```

8. **Compilar assets del frontend**
   ```bash
   npm run build
   # O para desarrollo con hot reload:
   npm run dev
   ```

9. **Iniciar la aplicación**
   ```bash
   php artisan serve
   # Visita: http://localhost:8000
   ```

---

## 📋 Características

### 🔐 Sistema de Autenticación
- Registro de usuarios con validación de email
- Login seguro con funcionalidad "Recuérdame"
- Restablecimiento de contraseña por enlace de correo
- Gestión de perfil y eliminación de cuenta
- **Tecnología**: Laravel Breeze, Laravel Guard, hash bcrypt

### 🍸 Exploración de Cócteles
- **Funcionalidad de Búsqueda**: Encuentra cócteles por nombre desde TheCocktailDB
- **Descubrimiento Aleatorio**: Carga 12 cócteles aleatorios en la carga inicial de la página
- **Vista Detallada**: Cada cóctel muestra nombre, categoría, tipo de copa, imagen e instrucciones
- **Guardar en Favoritos**: Guardado con un clic mediante AJAX (sin recarga de página)
- **Ruta**: `/cocktails` (protegida por middleware auth)

### 💾 Gestión de Favoritos
- **Visualización en DataTable**: Tabla interactiva con ordenamiento, filtrado y paginación
- **Persistencia de Base de Datos**: Cócteles guardados específicos del usuario almacenados en MySQL
- **Operación de Eliminación**: Elimina cócteles con confirmación de SweetAlert2
- **Tabla Responsiva**: Diseño optimizado para móviles con desplazamiento horizontal en pantallas pequeñas
- **Ruta**: `/favorites` (protegida por middleware auth)

### 🔒 Autorización y Seguridad
- **Seguridad a Nivel de Fila**: Los usuarios solo pueden eliminar sus propios cócteles guardados mediante `CocktailPolicy`
- **Protección CSRF**: Todos los formularios incluyen verificación de token CSRF
- **Middleware de Autenticación**: Las rutas protegidas requieren login
- **Relaciones de Base de Datos**: Las restricciones de clave externa aseguran integridad de datos

---
