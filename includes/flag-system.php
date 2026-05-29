<?php

function getFlag($country){

    $country = strtolower(trim($country));

    $flags = [

        "france" => "france.svg",
        "brazil" => "brazil.svg",
        "argentina" => "argentina.svg",
        "germany" => "germany.svg",
        "england" => "england.svg",
        "portugal" => "portugal.svg",
        "spain" => "spain.svg",
        "italy" => "italy.svg",
        "netherlands" => "netherlands.svg",
        "poland" => "poland.svg"

    ];



    $flag =
    $flags[$country]
    ?? "default.svg";



    return "

    <img

    src='assets/flags/".$flag."'

    class='country-flag'

    >

    ";

}

?>