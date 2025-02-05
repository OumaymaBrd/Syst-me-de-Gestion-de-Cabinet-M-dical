<?php

namespace App\Core;

class View
{
    public function render($template, $data = [])
    {
        // Extraire les données pour les rendre disponibles dans la vue
        extract($data);

        // Démarrer la mise en tampon
        ob_start();

        // Inclure le template
        include __DIR__ . '/../app/Views/' . $template . '.php';

        // Récupérer le contenu
        $content = ob_get_clean();

        // Inclure le layout
        include __DIR__ . '/../app/Views/templates/layout.php';
    }
}