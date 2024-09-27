<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 19 de Arrays</title>
</head>
<body>
    <?php
        echo "<h2> Ejercicio 19 </h2>";
        $amigos=["Madrid"=>
                        [
                            [
                            "nombre"=>"Pedro",
                            "edad"=>32,
                            "telefono"=>91999999
                            ],
                            [
                            "nombre"=>"Víctor",
                            "edad"=>30,
                            "telefono"=>91888988
                            ]
                        ],
                "Barcelona"=>
                        [
                            [
                            "nombre"=>"Susana",
                            "edad"=>32,
                            "telefono"=>919555999
                            ],
                            [
                            "nombre"=>"Aida",
                            "edad"=>35,
                            "telefono"=>91888988
                            ]
                        ],
                "Toledo"=>
                [
                    [
                    "nombre"=>"Paco",
                    "edad"=>32,
                    "telefono"=>919555999
                    ],
                    [
                    "nombre"=>"Simón",
                    "edad"=>40,
                    "telefono"=>91888988
                    ]
                ]
                    ];
        print_r($amigos);

        echo "<p> Lo mostramos en lista </p>";
        foreach ($amigos as $ciudad => $arr_personas) {
            echo "<p>Amigos en: ".$ciudad."</p>";
            echo "<ol>";
                foreach ($arr_personas as $persona => $datos) {
                    echo "<li>";
                    foreach ($datos as $key => $value) {
                        echo "<p>".$value."</p>";
                    }
                    echo "</li>";
                }
            echo "</ol>";
        }
    ?>
</body>
</html>