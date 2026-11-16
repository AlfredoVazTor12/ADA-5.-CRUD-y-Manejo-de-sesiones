# 🛒 Carrito de Compras con Manejo de Sesiones en PHP y MySQL

Aplicación web desarrollada del lado del servidor utilizando **PHP** y **MySQL**, enfocada en la construcción de un carrito de compras persistente mediante sesiones (`$_SESSION`). El sistema permite conservar el nombre del usuario y gestionar los productos seleccionados durante toda la navegación.

---

## Funcionalidades Implementadas

* **Identificación de Usuario por Sesión (`$_SESSION['usuario']`):** Al iniciar sesión, el nombre del usuario se almacena en el servidor y se muestra de forma continua en la barra de navegación.
* **Añadir Productos:** Permite agregar artículos desde un catálogo dinámico conectado a MySQL, respetando el inventario disponible (`stock`).
* **Modificar Productos:** Permite actualizar la cantidad de cada producto directamente dentro del carrito, recalculando automáticamente los subtotales y el total general.
* **Eliminar Productos:** Permite retirar artículos de forma individual o vaciar todo el carrito de compras.
* **Listar Productos:** Despliega en tiempo real todos los productos almacenados en `$_SESSION['carrito']`.

---

## Tecnologías Utilizadas

* **Backend:** PHP 8.x (PDO para conexión segura a base de datos y manejo nativo de `session_start()`).
* **Base de Datos:** MySQL / MariaDB.
* **Frontend:** HTML5, CSS3 (Grid y Flexbox) y JavaScript (validaciones del lado del cliente).
* **Servidor Local:** Apache (XAMPP / WAMP / Laragon).

---

## Estructura del Proyecto

```text
carrito_php/
├── base_datos.sql         # Script SQL para crear la base de datos, tablas y registros iniciales
├── conexion.php           # Archivo de conexión PDO a MySQL
├── index.php              # Interfaz principal: catálogo de productos y vista del carrito
├── login.php              # Controlador para iniciar la sesión del usuario
├── logout.php             # Controlador para cerrar y destruir la sesión
├── carrito_acciones.php   # Lógica del servidor para añadir, modificar, eliminar y vaciar productos
├── estilos.css            # Hoja de estilos de la aplicación
├── script.js              # Validaciones y notificaciones dinámicas en el cliente
└── README.md              # Documentación y guía de uso
```

---

## Guía de Instalación y Uso Detallada

### Paso 1: Requisitos Previos
Asegúrate de tener instalado un paquete de servidor local que incluya **Apache**, **PHP** y **MySQL**, como [XAMPP](https://www.apachefriends.org/).

### Paso 2: Ubicar el Proyecto en el Servidor Local
1. Clona este repositorio o copia la carpeta del proyecto dentro del directorio raíz de tu servidor web:
   * **Windows (XAMPP):** `C:\xampp\htdocs\carrito_php`
   * **Mac (XAMPP):** `/Applications/XAMPP/xamppfiles/htdocs/carrito_php`
   * **Linux (LAMPP):** `/opt/lampp/htdocs/carrito_php`
2. Si usas Git, ejecuta en tu terminal:
   ```bash
   cd C:\xampp\htdocs\
   git clone https://github.com/TU_USUARIO/carrito-compras-php.git carrito_php
   ```

### Paso 3: Encender Servicios y Crear la Base de Datos
1. Abre el **Panel de Control de XAMPP** e inicia los módulos **Apache** y **MySQL** (ambos deben aparecer en verde).
2. Abre tu navegador e ingresa a **phpMyAdmin**:
   ```text
   http://localhost/phpmyadmin
   ```
3. Haz clic en la pestaña **SQL** (o **Importar**), copia el contenido del archivo `base_datos.sql` y ejecútalo.
4. Verifica que se haya creado la base de datos `tienda_sesiones` con las tablas `productos` y `usuarios`.

### Paso 4: Verificar Credenciales de Conexión
Abre el archivo `conexion.php` y comprueba que los datos coincidan con tu configuración local de MySQL (en XAMPP por defecto el usuario es `root` y la contraseña está vacía):

```php
$host = 'localhost';
$db   = 'tienda_sesiones';
$user = 'root';
$pass = '';
```

### Paso 5: Guía de Uso en el Navegador
1. Entra desde tu navegador a la URL del proyecto:
   ```text
   http://localhost/carrito_php/
   ```
2. **Iniciar Sesión:**
   * En la pantalla inicial, escribe tu nombre en el campo de texto y haz clic en **Iniciar Sesión**.
   * Observarás tu nombre en la barra superior derecha (`Bienvenido, [Tu Nombre]`), confirmando que la sesión está activa.
3. **Añadir Productos al Carrito:**
   * Explora el **Catálogo de Productos**.
   * Elige la cantidad deseada en el selector numérico de cualquier producto y haz clic en **Añadir al carrito**.
4. **Listar y Modificar Productos:**
   * Desplázate hacia la sección inferior (**Carrito de Compras**), donde se listan los artículos agregados con su precio unitario, cantidad, subtotal y total a pagar.
   * Para modificar una cantidad, cambia el valor numérico en la fila del producto y presiona **Actualizar**.
5. **Comprobar Persistencia de Sesión:**
   * Recarga la página (`F5`) o abre una nueva pestaña con la misma dirección; comprobarás que tanto tu nombre de usuario como los productos del carrito permanecen guardados gracias a `$_SESSION`.
6. **Eliminar Productos y Cerrar Sesión:**
   * Haz clic en **Eliminar** junto a un producto para retirarlo individualmente, o en **Vaciar Carrito** para eliminar todos.
   * Al finalizar, presiona **Cerrar Sesión** en la barra superior para destruir la sesión en el servidor (`session_destroy()`).

---

## Estructura de la Base de Datos

### Tabla `productos`
| Columna | Tipo de Dato | Descripción |
| :--- | :--- | :--- |
| `id` | `INT (PK, AUTO_INCREMENT)` | Identificador único del producto |
| `nombre` | `VARCHAR(100)` | Nombre del producto |
| `descripcion` | `VARCHAR(255)` | Descripción breve |
| `precio` | `DECIMAL(10, 2)` | Precio unitario |
| `stock` | `INT` | Cantidad disponible en inventario |

### Tabla `usuarios`
| Columna | Tipo de Dato | Descripción |
| :--- | :--- | :--- |
| `id` | `INT (PK, AUTO_INCREMENT)` | Identificador único del usuario |
| `nombre` | `VARCHAR(100)` | Nombre completo del usuario |
| `correo` | `VARCHAR(100)` | Correo electrónico único |
