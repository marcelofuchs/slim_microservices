<?php

$time = time();
$requisicoes = 0;
$falhas = 0;

while ($time > time() - 60) {

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_PORT => "8081",
        CURLOPT_URL => "http://localhost:8081/v1/book?time=". time(),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjoiQGZpZGVsaXNzYXVybyIsInR3aXR0ZXIiOiJodHRwczpcL1wvdHdpdHRlci5jb21cL2ZpZGVsaXNzYXVybyIsImdpdGh1YiI6Imh0dHBzOlwvXC9naXRodWIuY29tXC9tc2ZpZGVsaXMifQ.5TSgJhrZnIDDnq9eXObFkDMGv8gw1yarErwAz9aZrwo",
            "Cache-Control: no-cache",
            "Postman-Token: 6c104fba-6192-4ff3-af8c-7087bdc7255f"
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
       // echo ".";
       //echo count(json_decode($response, true)) . " registros. \n";
    }
    //exit;
}
echo "\n Total de requisições: " . ($requisicoes + $falhas) . " -  " . (($requisicoes + $falhas) / 60) . "/segundo \n";
echo "Sucesso: $requisicoes -  " . ($requisicoes ? (($requisicoes) / 60) : 0) . "/segundo \n";
echo "Falhas: $falhas -  " . ($falhas ? (($falhas) / 60) : 0) . "/segundo \n";


