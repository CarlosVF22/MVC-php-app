# Sistema de Gestión de Técnicos

Una aplicación web diseñada para gestionar técnicos, sus detalles, sucursales asignadas y elementos. Desarrollada como parte de una prueba técnica que exige una serie de funcionalidades y validaciones específicas.

## Características

-   **Visualización de Técnicos:** Despliega una tabla con información esencial de cada técnico, incluyendo la sucursal asignada, los elementos que se le han atribuido y sus respectivas cantidades.
-   **CRUD de Técnicos:** Facilita la creación, edición y eliminación de técnicos a través de ventanas emergentes intuitivas.
-   **Validaciones:** Garantiza la integridad de los datos ingresados mediante validaciones que aseguran el cumplimiento de criterios específicos.
-   **Peticiones Asíncronas:** Todas las acciones de creación, edición y eliminación se gestionan de manera asíncrona mediante AJAX.
-   **Integración con Bases de Datos:** Se apoya en una base de datos MySQL para la gestión, almacenamiento y recuperación de datos relacionados con técnicos, sucursales y elementos.
-   **Servicio Adminer:** Incorpora un servicio Adminer accesible a través del puerto 8080, permitiendo una administración visual de la base de datos directamente desde el navegador.
-   **Docker Integrado:** Preparado para el desarrollo local gracias a la inclusión de un Dockerfile y docker-compose.
-   **Configuración del Servidor:** Proporciona un archivo de configuración específico para el servidor.
-   **Servicios Múltiples:** El sistema consta de tres servicios: servidor web, servidor de base de datos y servidor para Adminer.
-   **Arquitectura MVC:** Su estructuración de archivos y código sigue el patrón Modelo-Vista-Controlador (MVC).
-   **Punto de Entrada:** El acceso principal al sistema se realiza a través de `index.php`.

## Desarrollo en local

Para facilitar el desarrollo y la prueba en entornos locales, se ha configurado una serie de contenedores Docker. A continuación se describen los detalles y los pasos para poner en marcha el entorno.

### Dockerfile

El `Dockerfile` se basa en la imagen `php:8.1-apache` y tiene la siguiente configuración:

-   Utiliza la imagen base de PHP 8.1 con Apache.
-   Copia la aplicación al directorio `/var/www/html` del contenedor.
-   Configura los permisos del archivo `.htaccess`.
-   Copia una configuración personalizada de Apache.
-   Habilita el módulo de Apache para PHP y el módulo `rewrite`.
-   Instala las dependencias necesarias para Composer y luego instala Composer.
-   Expone el puerto `80` para el servidor web.
-   Define el comando para iniciar Apache.

### docker-compose.yml

El archivo `docker-compose.yml` define tres servicios:

-   **web:** Basado en el Dockerfile proporcionado, se encarga de ejecutar la aplicación PHP y está configurado para exponer y mapear el puerto 80.
-   **db:** Usa la imagen `mysql:8.0` y está configurado para iniciar una base de datos MySQL con determinadas credenciales y configuraciones.
-   **adminer:** Utiliza la imagen estándar de Adminer y se configura para exponer el puerto `8080`.

#### Instrucciones para iniciar el entorno:

1. Asegúrate de tener Docker y Docker Compose instalados en tu máquina.
2. Navega hasta el directorio raíz del proyecto en tu terminal.
3. Ejecuta el comando: `docker-compose up -d`.
4. Accede a `http://localhost` en tu navegador para ver la aplicación en funcionamiento.
5. Para administrar la base de datos a través de Adminer, accede a `http://localhost:8080`.

## Despliegue sin Docker (Local)

Si no tienes Docker en tu máquina y prefieres desplegar el proyecto directamente, aquí te presentamos los pasos para hacerlo.

### Requisitos:

-   PHP 8.1 o superior.
-   Servidor Apache con el módulo `mod_rewrite` habilitado.
-   MySQL 8.0 o superior.
-   Composer (para gestionar dependencias de PHP).

### Instrucciones:

1. **Clonar el Repositorio:**

    - Si aún no has clonado el repositorio, hazlo y navega hasta el directorio raíz del proyecto en tu terminal.
      https://github.com/CarlosVF22/gestion-franca-prueba-tecnica

2. **Configurar el Servidor Apache:**

    - Asegúrate de que tu servidor Apache esté configurado para leer el archivo `.htaccess`. Para ello, el módulo `mod_rewrite` debe estar habilitado.
    - Configura el DocumentRoot de tu servidor Apache para apuntar al directorio `app` del proyecto.

3. **Configurar la Base de Datos:**

    - Inicia tu servidor MySQL.
    - Crea una base de datos llamada `gestion-franca`.
    - Configura un usuario `admin` con contraseña `admin123` (o las credenciales que desees) y otórgale todos los privilegios sobre la base de datos `gestion-franca`.

4. **Instalar Dependencias con Composer:**

    - Navega hasta el directorio raíz del proyecto en tu terminal.
    - Ejecuta `composer install` para instalar las dependencias del proyecto.

5. **Configurar la Aplicación:**

    - Si hay algún archivo de configuración necesario (por ejemplo, para conexiones de base de datos), asegúrate de editarlo con las credenciales y configuraciones adecuadas.

6. **Acceder a la Aplicación:**
    - Inicia tu servidor Apache.
    - Abre un navegador y accede a la URL configurada para tu servidor local (por ejemplo, `http://localhost`).

Si todo se ha configurado correctamente, deberías poder ver y utilizar la aplicación desde tu navegador.

Al finalizar, puedes detener los servicios con el comando: `docker-compose down`.
