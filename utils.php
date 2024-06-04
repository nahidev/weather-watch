<?php
function determinarMensajeCalidadAire($calidadAire) {
    $mensajes = [
        1 => 'Buena calidad del aire.',
        2 => 'Calidad del aire regular.',
        3 => 'Calidad del aire moderada.',
        4 => 'Calidad del aire deficiente.',
        5 => 'Calidad del aire muy deficiente.'
    ];

    return isset($mensajes[$calidadAire]) ? $mensajes[$calidadAire] : 'No se pudo determinar la calidad del aire.';
}

function determinarRecomendacionesTemperatura($temperatura, $descripcion) {
    $recomendaciones_temperatura = [
        10 => 'Hace frío. Recomiendo abrigarse bien.',
        15 => 'El clima es fresco, considera llevar una chaqueta.',
        20 => 'La temperatura es fresca. Un suéter ligero puede ser suficiente.',
        25 => 'El clima es agradable. Disfruta del día al aire libre.',
        PHP_INT_MAX => 'Hace calor. Mantente hidratado y busca lugares frescos.'
    ];

    $recomendaciones = '';
    foreach ($recomendaciones_temperatura as $limite => $recomendacion) {
        if ($temperatura < $limite) {
            $recomendaciones = $recomendacion;
            break;
        }
    }

    // Agregar recomendaciones basadas en la descripción del clima
    if (strpos(strtolower($descripcion), 'cielo claro') !== false) {
        $recomendaciones .= ' No olvides aplicar protector solar.';
    } 
    if (strpos(strtolower($descripcion), 'lluvia') !== false) {
        $recomendaciones .= ' Se pronostica lluvia, asegúrate de llevar un paraguas.';
    }
    if (strpos(strtolower($descripcion), 'tormenta') !== false) {
        $recomendaciones .= ' Se pronostica tormenta, asegúrate de llevar un paraguas.';
    }
    return $recomendaciones;
}

function verificarNull($valor, $unidad = '') {
    return $valor !== null ? $valor . $unidad : "No disponible";
}

?>