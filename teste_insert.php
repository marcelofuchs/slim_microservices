<?php

$t = $time = time();
$requisicoes = 0;
$falhas = 0;

while ($time > $t - 60) {

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_PORT => "8081",
        CURLOPT_URL => "http://localhost:8081/v1/book?time={$t}",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\n\t\"name\" :\"Marcelo $t\",\n\t\"author\":\"author $t\",\n\t\"description\":\"$t - sdfsdfsdf sdf sdfdsfdsfsdfsdf sf\"\n}",
        CURLOPT_HTTPHEADER => array(
            "Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjoiQGZpZGVsaXNzYXVybyIsInR3aXR0ZXIiOiJodHRwczpcL1wvdHdpdHRlci5jb21cL2ZpZGVsaXNzYXVybyIsImdpdGh1YiI6Imh0dHBzOlwvXC9naXRodWIuY29tXC9tc2ZpZGVsaXMifQ.5TSgJhrZnIDDnq9eXObFkDMGv8gw1yarErwAz9aZrwo",
            "Cache-Control: no-cache",
            "Content-Type: application/json",
            "Postman-Token: 06de2cdd-fd53-4151-a5cb-47207ca33519"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        $falhas++;
        echo "\n cURL Error #:" . $err . "\n";
    } else {
        $requisicoes++;
        //echo ".";
        //var_dump($response);
    }
    
    $t = time();
}
echo "\n Total de requisições: " . ($requisicoes + $falhas) . " -  " . (($requisicoes + $falhas) / 60) . "/segundo \n";
echo "Sucesso: $requisicoes -  " . ($requisicoes ? (($requisicoes) / 60) : 0) . "/segundo \n";
echo "Falhas: $falhas -  " . ($falhas ? (($falhas) / 60) : 0) . "/segundo \n";


