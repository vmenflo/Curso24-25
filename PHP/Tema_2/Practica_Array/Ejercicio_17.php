<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 17 de Arrays</title>
</head>
<body>
    <?php
        $familia=["Los Simpson"=>[
                                "Padre"=>"Homer",
                                "Madre"=>"Marge",
                                "Hijos"=>
                                    ["Hijo1"=>"Bart",
                                    "Hijo2"=>"Lisa",
                                    "Hijo3"=>"Maggie"
                                    ]
                                ],
                "Los Griffing"=>[
                                "Padre"=>"Peter",
                                "Madre"=>"Lois",
                                "Hijos"=>
                                ["Hijo1"=>"Chris",
                                "Hijo2"=>"Meg",
                                "Hijo3"=>"Stewie"
                                ]
                                ]
                ];
        print_r($familia);
        echo "<p>Mostrar las Familias</p>";
        echo "<ul>";
                    //Imprime el nombre de las familias
            foreach ($familia as $familia_miembros => $miembros) {
                echo "<li>$familia_miembros<ul>";
                    //Imprime el nombre de los padres
                foreach ($miembros as $padres => $nombre_padres) {
                    // Verificamo si es un array para hacer otro for each
                    if (is_array($nombre_padres)) {
                        echo "<li>$padres:<ul>";
                        // Imprimir los hijos
                        foreach ($nombre_padres as $hijo => $nombre_hijo) {
                            echo "<li>$hijo: $nombre_hijo</li>";
                        }
                        echo "</ul></li>";
                    } else {
                        // Sino los muestra
                        echo "<li>$padres: $nombre_padres</li>";
                    }
                }

                echo "</ul></li>";
            }

        echo "</ul>";
    ?>
</body>
</html>