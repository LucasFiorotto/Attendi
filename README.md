# Attendi
Sistema de gestión de asistencias.

## Tecnologías
- PHP 8.1.
- Bootstrap 5.

## Instalación
1. Clonar el repositorio haciendo click en "<>Code" o "<>Codigo" y después en "Download ZIP" o "Descargar ZIP".
2. Una vez descargado el archivo .ZIP, descomprimirlo y dentro ubicar la carpeta del proyecto con el nombre "Attendi".
3. Mover la carpeta del proyecto a:
    - En el caso de **Laragon**: debe ir en la carpeta "www", que por defecto se encuentra ubicada en Disco Local (*:) > laragon > "www".
    - En el caso de **XAMPP**: debe ir en la carpeta "htdocs", que por defecto se encuentra ubicada en Disco Local (*:) > xampp > htdocs.
    - En el caso de utilizar otro servidor web, ubicar su carpeta raiz para los archivos.
4. Iniciar Apache y MySQL, en el caso de Laragon haciendo click en "Start All" o "Iniciar Todo".
5. Cargar el script de la base de datos incluido en Attendi/Documentacion, sea cualquiera de las opciones (con o sin datos). Para ello:
    - En **Laragon**: abrir un gestor haciendo click en "Database" o en Menú > MySQL > HeidiSQL o PHPmyAdmin.
    - En **XAMPP**: abrir PHPmyAdmin haciendo click en botón "Admin" de MySQL.
    - En **HeidiSQL**: abrir una sesión, en Archivo > Ejecutar archivo SQL, seleccionar el script deseado, abrirlo y recargar la interfaz.
    - En **PHPmyAdmin**: abrir una base de datos ya creada y hacer click en "Importar", seleccionar el script deseado y abrirlo.
6. Abrir un navegador web y dirigirse a la siguiente direccion URL: **localhost/Attendi/Inicio/index.php**
7. Listo!
