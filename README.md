# Attendi
Sistema de gestión de asistencias.

## Tecnologías
- PHP 8.1.
- Bootstrap 5.

## Instalación
1. Clonar el repositorio haciendo click en "<>Code" o "<>Codigo" y después en "Download ZIP" o "Descargar ZIP".
2. Una vez descargado el archivo .ZIP, descomprimirlo y dentro ubicar la carpeta del proyecto con el nombre "Attendi".
3. Mover la carpeta del proyecto a:
    - En el caso de **Laragon**: debe ir en la carpeta "**www**", que por defecto se encuentra ubicada en Disco Local (*:) > laragon > "www".
    - En el caso de **XAMPP**: debe ir en la carpeta "**htdocs**", que por defecto se encuentra ubicada en Disco Local (*:) > xampp > htdocs.
4. Abrir el entorno de desarrollo (Laragon o XAMPP), iniciar Apache y MySQL, en el caso de Laragon haciendo click en "Start All" o "Iniciar Todo".
5. Cargar el script de la base de datos incluido en Attendi/Documentacion/Script/Pre-cargado o Vacio. Para ello:
    - En **Laragon**: abrir el gestor de base de datos haciendo click en "Database" o en Menú > MySQL > HeidiSQL.
    - En **HeidiSQL**: abrir una sesión, en Archivo > Ejecutar archivo SQL, seleccionar el script **.sql** (Pre-cargado o Vacío), abrirlo (confirmar cualquier cartel de aviso) y recargar la interfaz.
6. Abrir un navegador web y dirigirse a la siguiente direccion URL: **localhost/Attendi/Inicio/index.php**
7. Listo!
