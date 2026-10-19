
<?php
// controllers/SiteController.php
require_once 'models/ContactoModel.php';

class SiteController {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function manejarPeticion() {
        $url = isset($_GET['url'])
            ? rtrim($_GET['url'], '/')
            : 'inicio';

        $mensaje_db = '';

        if (
            $url === 'contacto' &&
            $_SERVER['REQUEST_METHOD'] === 'POST'
        ) {
            $nombre = trim($_POST['nombre'] ?? '');
            $correo = trim($_POST['correo'] ?? '');
            $comentario = trim($_POST['comentario'] ?? '');

            if ($nombre === '' || $correo === '' || $comentario === '') {
                $mensaje_db = '<div class="alerta error">Completa todos los campos.</div>';
            } elseif (mb_strlen($nombre) > 100) {
                $mensaje_db = '<div class="alerta error">El nombre no puede superar 100 caracteres.</div>';
            } elseif (mb_strlen($correo) > 150 || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $mensaje_db = '<div class="alerta error">Escribe un correo electrónico válido.</div>';
            } else {
                $modelo = new ContactoModel($this->conexion);

                if ($modelo->guardarContacto($nombre, $correo, $comentario)) {
                    $mensaje_db = '<div class="alerta exito">¡Tu mensaje se guardó correctamente!</div>';
                } else {
                    $mensaje_db = '<div class="alerta error">No fue posible guardar el mensaje. Revisa la tabla contactos.</div>';
                }
            }
        }

        require_once 'views/header.php';

        switch ($url) {
            case 'inicio':
                require_once 'views/inicio.php';
                break;
            case 'servicios':
                require_once 'views/servicios.php';
                break;
            case 'contacto':
                require_once 'views/contacto.php';
                break;
            default:
                require_once 'views/404.php';
                break;
        }

        require_once 'views/footer.php';
    }
}
