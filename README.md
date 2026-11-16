# Carrito de Compras con Manejo de Sesiones en PHP y MySQL

Aplicación web desarrollada del lado del servidor con **PHP** y **MySQL**, enfocada en la gestión de un carrito de compras persistente mediante variables de sesión (`$_SESSION`), permitiendo conservar la identidad del usuario y los productos seleccionados durante toda su navegación.

---

## Características y Funcionalidades

* **Manejo de Sesiones de Usuario (`$_SESSION['usuario']`):** Identificación del cliente al ingresar y visualización permanente de su nombre en la barra de navegación hasta que cierre sesión.
* **Añadir Productos:** Selección de artículos desde un catálogo dinámico conectado a MySQL, validando disponibilidad de stock.
* **Modificar Productos:** Actualización de cantidades directamente dentro del carrito con recálculo automático de subtotales y total general.
* **Eliminar Productos:** Opción para retirar artículos de manera individual o vaciar el carrito por completo.
* **Listar Productos:** Visualización detallada en tiempo real de los artículos almacenados en `$_SESSION['carrito']`.

---

## Tecnologías Utilizadas

* **Backend:** PHP 8.x (PDO para consultas preparadas y manejo nativo de `session_start()`).
* **Base de Datos:** MySQL / MariaDB.
* **Frontend:** HTML5, CSS3 (Grid y Flexbox) y JavaScript (validaciones del lado del cliente).
* **Entorno de Servidor Local:** Apache (XAMPP / Laragon / WAMP).

---

## Estructura del Proyecto

```text
carrito_php/
├── base_datos.sql         # Script SQL para crear la base de datos, tablas y datos de prueba
├── conexion.php           # Configuración de conexión PDO a MySQL
├── index.php              # Vista principal: catálogo de productos y listado del carrito
├── login.php              # Controlador de inicio de sesión del usuario
├── logout.php             # Controlador de destrucción de sesión
├── carrito_acciones.php   # Lógica CRUD del carrito (agregar, modificar, eliminar, vaciar)
├── estilos.css            # Hoja de estilos de la interfaz
├── script.js              # Validaciones y alertas dinámicas en el navegador
└── README.md              # Documentación del proyecto
