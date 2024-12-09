<?php
// Cargar películas desde el archivo JSON
function cargarPeliculas($archivo) {
    $json = file_get_contents($archivo);
    return json_decode($json, true);
}

function peliculasLista($peliculas) {
    return array_map(function($movie) {
        return [
            'title' => $movie['title'],
            'year' => $movie['year'],
            'duration' => $movie['duration'],
        ];
    }, $peliculas);
}

// Contar información de los actores
function contarActores($peliculas) {
    $resultados = [];
    foreach ($peliculas as $movie) {
        $titulo = $movie['title'];
        $cantidadActores = isset($movie['actors']) ? count($movie['actors']) : 0;
        $resultados[] = "Título: $titulo, Número de Actores: $cantidadActores";
    }
    return $resultados;
}

// Filtrar películas por sinopsis
function filtrarPeliculasPorSinopsis($peliculas, $palabra1, $palabra2) {
    return array_filter($peliculas, function($movie) use ($palabra1, $palabra2) {
        $sinopsis = strtolower($movie['storyline']);
        return strpos($sinopsis, strtolower($palabra1)) !== false && strpos($sinopsis, strtolower($palabra2)) !== false;
    });
}

// Mostrar películas por actor
function mostrarPeliculasPorActor($peliculas, $nombreActor) {
    return array_filter($peliculas, function($movie) use ($nombreActor) {
        return isset($movie['actors']) && in_array($nombreActor, $movie['actors']);
    });
}

// Calcular media de puntuaciones
function calcularMediaPuntuaciones($ratings) {
    if (empty($ratings)) return 0;
    return array_sum($ratings) / count($ratings);
}

// Mostrar las tres mejores películas
function mostrarTopPeliculas($peliculas, $fechaInicio, $fechaFin) {
    $peliculasFiltradas = array_filter($peliculas, function($movie) use ($fechaInicio, $fechaFin) {
        return $movie['releaseDate'] >= $fechaInicio && $movie['releaseDate'] <= $fechaFin;
    });

    $peliculasConMedia = array_map(function($movie) {
        return [
            'title' => $movie['title'],
            'posterurl' => $movie['posterurl'],
            'mediaRating' => calcularMediaPuntuaciones($movie['ratings']),
        ];
    }, $peliculasFiltradas);

    usort($peliculasConMedia, function($a, $b) {
        return $b['mediaRating'] <=> $a['mediaRating'];
    });

    return array_slice($peliculasConMedia, 0, 3);
}

// Manejo de solicitudes
$peliculas = cargarPeliculas("movies.json");
$actoresResultados = contarActores($peliculas);

// Ejemplo de uso de las funciones
$sinopsisFiltradas = filtrarPeliculasPorSinopsis($peliculas, 'sadistic', 'Criminal'); // Cambia las palabras como desees
$peliculasPorActor = mostrarPeliculasPorActor($peliculas, 'Tim Robbins'); // Cambia el nombre del actor
$topPeliculas = mostrarTopPeliculas($peliculas, '1990-01-01', '2000-12-31'); // Cambia las fechas como desees

$moviesArray = peliculasLista($peliculas);

// Mostrar resultados de películas
echo "<h2>Lista de Películas:</h2>";
foreach ($moviesArray as $movie) {
    echo "<p>Título: {$movie['title']}, Año: {$movie['year']}, Duración: {$movie['duration']}</p>";
}

// Mostrar resultados (puedes usar HTML para presentarlo)
echo "<h2>Resultados de Actores:</h2>";
foreach ($actoresResultados as $resultado) {
    echo "<p>$resultado</p>";
}
 
echo "<h2>Películas Filtradas por Sinopsis:</h2>";
foreach ($sinopsisFiltradas as $movie) {
    echo "<p>{$movie['title']}</p>";
}

echo "<h2>Películas de Tim Robbins:</h2>";
foreach ($peliculasPorActor as $movie) {
    echo "<p>{$movie['title']}</p>";
}

echo "<h2>Top 3 Películas:</h2>";
foreach ($topPeliculas as $movie) {
    echo "<p><strong>{$movie['title']}</strong><br><img src=\"{$movie['posterurl']}\" alt=\"{$movie['title']} poster\" style=\"width:100px;\"></p>";
}
?>
