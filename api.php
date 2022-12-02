<?php

$discord_token = "";
$discord_api = "https://discord.com/api/v10/users/";

$id = $_GET["id"];
$output = $_GET["output"];


if (empty($id) || empty($output)) {
    die("please enter id & output");
}

$link = $discord_api . $id;


switch (strtolower($output)) {
    case 'json':
        die(lookup($link, $discord_token));
        break;
    case "text":
        $resp = lookup($link, $discord_token);
        $decoded = json_decode($resp);
        echo "id: " . $decoded->id . "<br>";
        echo "username: " . $decoded->username . "<br>";
        echo "avatar: " . $decoded->avatar . "<br>";
        echo "avatar_decoration: " . $decoded->avatar_decoration . "<br>";
        echo "discriminator: " . $decoded->discriminator . "<br>";
        echo "public_flags: " . $decoded->public_flags . "<br>";
        echo "banner: " . $decoded->banner . "<br>";
        echo "banner_color: " . $decoded->banner_color . "<br>";
        echo "accent_color: " . $decoded->accent_color . "<br>";
        break;
    default:

        die("invalid output format");
        break;
}


function lookup($link, $token)
{
    $c = curl_init($link);
    $headers = [
        "authorization: Bot " . $token,
        "Content-Type: application/json",
        "User-Agent: @h4_remiixx/lookup"
    ];

    curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($c);
    curl_close($c);
    return $response;
}