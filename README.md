---

# API RentCar (PHP + JWT)

API REST para la gestión de un sistema de renta de vehículos: **clientes, empresa, facturación, ingresos, gastos, reparaciones** y autenticación por **JWT**.

## 🚀 Stack

* **PHP** (>= 7.4 recomendado)
* **MySQL/MariaDB**
* **JWT** (librería incluida en `libs/php-jwt-master`)
* Servidor web: Apache/Nginx o PHP built-in server

## 📁 Estructura (resumen)

```
config/           # conexión BD y config general
login/            # autenticación y emisión de JWT
clientes/         # CRUD de clientes
empresa/          # datos de la empresa
factura/          # facturas
detallefactura/   # detalle de facturas
ingresos/         # registros de ingresos
gastos/           # registros de gastos
reparaciones/     # historial de reparaciones
dashboard/        # endpoints de dashboard/resúmenes
libs/php-jwt-master/  # librería JWT
```

## ⚙️ Requisitos

1. PHP 7.4+ con extensiones `mysqli` o `pdo_mysql`.
2. Servidor MySQL/MariaDB.
3. Configurar host virtual (o ejecutar con `php -S`).

## 🧩 Instalación

```bash
# Clonar
git clone https://github.com/<tu-usuario>/apirentcar.git
cd apirentcar
```

### 1) Configurar base de datos

* Crea una BD (por ejemplo `rentcar_db`).
* Importa el esquema SQL si está incluido en el repo (revisa `config/` o un archivo `.sql` en la raíz).
* Edita tu archivo de conexión (ej.: `config/database.php` o `config/db.php`) con tus credenciales:

```php
<?php
class Database {
  private $host = "localhost";
  private $db_name = "rentcar_db";
  private $username = "root";
  private $password = "";
  public $conn;

  public function getConnection() {
    $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
    if ($this->conn->connect_error) { die("DB Error: " . $this->conn->connect_error); }
    $this->conn->set_charset("utf8mb4");
    return $this->conn;
  }
}
```


### 2) Levantar el servidor

* **Apache/Nginx**: apunta el DocumentRoot al directorio del proyecto.
* **PHP built-in** (si tu enrutado lo permite):

  ```bash
  php -S localhost:8000
  ```

## 🔐 Autenticación (JWT)

1. **Login**: `POST /login` con credenciales válidas.
2. Recibirás un **token JWT**.
3. Incluye el token en cada petición:

   ```
   Authorization: Bearer <tu_token>
   ```


### Auth

* `POST /login` → retorna `{ token, user }`.

### Clientes

* `GET /clientes` → lista
* `GET /clientes/{id}` → detalle
* `POST /clientes` → crear
* `PUT /clientes/{id}` → actualizar
* `DELETE /clientes/{id}` → eliminar

### Empresa

* `GET /empresa` → datos de la empresa
* `PUT /empresa` → actualizar datos

### Facturación

* `GET /factura` → lista de facturas
* `GET /factura/{id}` → detalle
* `POST /factura` → crear factura
* `POST /detallefactura` → agregar líneas
* `GET /detallefactura/{idFactura}` → líneas de una factura

### Ingresos / Gastos

* `GET /ingresos`, `POST /ingresos`, `PUT /ingresos/{id}`, `DELETE /ingresos/{id}`
* `GET /gastos`, `POST /gastos`, `PUT /gastos/{id}`, `DELETE /gastos/{id}`

### Reparaciones

* `GET /reparaciones`
* `POST /reparaciones`
* `PUT /reparaciones/{id}`
* `DELETE /reparaciones/{id}`

### Dashboard (ejemplo)

* `GET /dashboard/resumen` → métricas (totales, últimos movimientos, etc.)

## 🧪 Ejemplos con cURL

**Login**

```bash
curl -X POST http://localhost:8000/login \
  -H "Content-Type: application/json" \
  -d '{"username":"admin","password":"secret"}'
```

**Crear cliente**

```bash
curl -X POST http://localhost:8000/clientes \
  -H "Authorization: Bearer <TOKEN>" \
  -H "Content-Type: application/json" \
  -d '{
    "nombre":"Juan Pérez",
    "telefono":"+1 809-000-0000",
    "documento":"001-0000000-0",
    "email":"juan@example.com"
  }'
```

**Listar facturas**

```bash
curl -X GET http://localhost:8000/factura \
  -H "Authorization: Bearer <TOKEN>"
```

## 🧱 Formato de respuesta (sugerido)

```json
{
  "success": true,
  "data": { },
  "message": "Operación exitosa",
  "error": null
}
```

## ✅ Buenas prácticas (sugerencias)

* Usar **sentencias preparadas** para SQL.
* Validar y sanear **input**.
* Configurar **CORS** si el frontend (Angular) consume desde otro dominio.
* Rotar **JWT secret** y definir tiempos de expiración razonables.
* Manejo consistente de **HTTP codes** (200/201/400/401/404/500).

## 🗂️ Colección de pruebas

Incluye una colección de **Postman/Insomnia** (si la tienes) para facilitar pruebas: `postman_collection.json`.

## 🧾 Licencia

Si no especificas una, considera **MIT** para facilitar forks y contribuciones.

## 👤 Autor

**Jeremy José de la Cruz (je7remy)** — IT & Cybersecurity
PRs y sugerencias son bienvenidos.

---
