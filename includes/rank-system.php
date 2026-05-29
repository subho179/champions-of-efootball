<?php

function getRank($points){

    if($points >= 16){

        return [

            "name" => "Elite",

            "icon" => "👑",

            "class" => "elite-rank"

        ];

    }

    elseif($points >= 11){

        return [

            "name" => "Gold",

            "icon" => "🥇",

            "class" => "gold-rank"

        ];

    }

    elseif($points >= 6){

        return [

            "name" => "Silver",

            "icon" => "🥈",

            "class" => "silver-rank"

        ];

    }

    else{

        return [

            "name" => "Bronze",

            "icon" => "🥉",

            "class" => "bronze-rank"

        ];

    }

}

?>