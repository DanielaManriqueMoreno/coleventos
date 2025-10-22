## 🎟️ COL EVENTOS

**COL EVENTOS** es una aplicación web monolítica desarrollada en **Laravel 12** con **MySQL**, creada para la **competencia Senasoft 2025** en la categoría **Mujeres Digitales**, realizada en **Pereira, Risaralda**.  
El proyecto tiene como objetivo la **gestión integral de eventos y venta de boletería online** en las diferentes festividades de Colombia, facilitando la administración de **eventos, artistas, localidades y compras de boletas**, con un enfoque en **usabilidad, eficiencia y seguridad**.

---

### 💻 Tecnologías utilizadas

<p align="center">
  <img src="https://img.shields.io/badge/PHP-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white" height="25">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" height="25">
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" height="25">
  <img src="https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" height="25">
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" height="25">
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" height="25">
</p>

---

## 📋 Funcionalidades principales

- 🎉 **Gestión de eventos:**
  - Creación y administración de eventos con nombre, descripción, fechas, municipio y departamento.
  - Asociación de artistas y validación de horarios sin conflictos.

- 🎤 **Módulo de artistas:**
  - Registro de artistas con nombre, género musical y ciudad natal.

- 🪑 **Gestión de localidades y boletería:**
  - Creación de localidades y asignación de boletas por evento.
  - Control de cantidad disponible y valor por localidad.

- 💳 **Compras de boletas:**
  - Sistema de compra autenticado.
  - Límite de 10 boletas por transacción.
  - Validación de disponibilidad y registro de estado de transacción.

- 👤 **Usuarios y autenticación:**
  - Registro, inicio de sesión y actualización de perfil.
  - Roles: administrador y comprador.

- 📊 **Reportes e historial:**
  - Consulta de compras por usuario autenticado.
  - Detalle de evento, localidad, cantidad, valor total y estado.

- 🌐 **Interfaz y usabilidad:**
  - Plantilla responsiva con **Bootstrap**.
  - Navegación clara y validaciones dinámicas.

---

## 🗄️ Estructura de la base de datos

Basada en los requerimientos del **Reto Mujeres Digitales**, la base de datos `coleventos` contiene las siguientes entidades principales:

- **users** → Usuarios del sistema (administrador / comprador).  
- **evento** → Eventos con fecha, hora, municipio y descripción.  
- **artista** → Artistas asociados a eventos.  
- **localidad** → Localidades disponibles para boletería.  
- **boleteria** → Relación evento-localidad con control de inventario.  
- **compra** → Registro de transacciones de boletas.  
- **artista_evento** → Asociación muchos a muchos entre artistas y eventos.

---

## 🚀 Comenzando

### Requisitos previos

- PHP **8.2+**  
- Composer  
- MySQL **8.x**  
- Node.js y npm (para assets con Vite)  

---

### Instalación

```bash
# 1. Clona el repositorio
git clone https://github.com/DanielaManriqueMoreno/coleventos.git
cd coleventos

# 2. Instala dependencias
composer install
npm install && npm run build

# 3. Configura el entorno
cp .env.example .env
php artisan key:generate

# 4. Crea la base de datos
mysql -u root -p
CREATE DATABASE coleventos;

# 5. Importa el script SQL
mysql -u root -p coleventos < coleventos.sql

# 6. Ejecuta el servidor
php artisan serve

```

## 👥 Colaboradores — Grupo 22
<table>
  <tr>
    <td align="center">
      <a href="https://github.com/DanielaManriqueMoreno">
        <img src="https://github.com/DanielaManriqueMoreno.png" width="100px;" alt="H2kl0"/><br />
        <sub><b>Juan Fernando Velásquez Sarmiento</b></sub>
      </a>
    </td>
    <td align="center">
      <a href="https://github.com/Linavs18">
        <img src="https://github.com/Linavs18.png" width="100px;" alt="Linavs18"/><br />
        <sub><b>Lina Vanessa Salcedo Cuellar</b></sub>
      </a>
    </td>
  </tr>
</table>

---
## 🏆 Contexto del proyecto
Proyecto desarrollado para el Reto **“Mujeres Digitales”** de **Senasoft Colombia 2025**, organizado por el **Servicio Nacional de Aprendizaje (SENA) en Pereira, Risaralda**.

El desafío consiste en construir un sistema web para la gestión de boletería y publicidad de eventos en festividades colombianas, cumpliendo con requerimientos funcionales y no funcionales establecidos por el comité organizador.
