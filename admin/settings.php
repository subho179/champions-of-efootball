<?php
include '../auth.php';
include __DIR__ . '/../assets/db.php';


// UPDATE SETTINGS

if(isset($_POST['save_settings'])){

    $league_type = $_POST['league_type'];

    $min_players = $_POST['min_players'];

    $max_players = $_POST['max_players'];

    $playoff_spots = $_POST['playoff_spots'];


    mysqli_query($conn,

    "UPDATE tournament_settings SET

    league_type='$league_type',
    min_players='$min_players',
    max_players='$max_players',
    playoff_spots='$playoff_spots'

    WHERE id=1"

    );



    header("Location: settings.php");

}



// GET SETTINGS

$settings = mysqli_fetch_assoc(

mysqli_query($conn,

"SELECT * FROM tournament_settings WHERE id=1")

);

?>

<!DOCTYPE html>
<html>

<head>

    <title>COE Settings</title>

    <link rel="stylesheet" href="../includes/layout.css">

    <style>

        .page-title{
            color:#ff9900;
            margin-bottom:35px;
            font-size:38px;
        }

        .settings-box{
            background:#171717;
            padding:30px;
            border-radius:18px;
            max-width:600px;
            box-shadow:0 0 20px rgba(255,153,0,0.08);
        }

        .settings-box h2{
            color:#ff9900;
            margin-bottom:25px;
        }

        .form-group{
            margin-bottom:20px;
        }

        label{
            display:block;
            margin-bottom:10px;
            font-weight:bold;
            color:#ddd;
        }

        input,
        select{
            width:100%;
            padding:15px;
            background:#222;
            border:1px solid #333;
            border-radius:10px;
            color:white;
            font-size:15px;
        }

        input:focus,
        select:focus{
            outline:none;
            border-color:#ff9900;
        }

        .save-btn{
            background:#ff9900;
            color:black;
            border:none;
            padding:15px 22px;
            border-radius:10px;
            font-weight:bold;
            cursor:pointer;
            transition:0.3s;
        }

        .save-btn:hover{
            background:#ffb733;
        }

        .info-box{
            background:#1f1f1f;
            border-left:4px solid #ff9900;
            padding:18px;
            border-radius:10px;
            margin-top:25px;
            color:#bbb;
            line-height:1.6;
        }

    </style>

</head>

<body>

<?php include __DIR__ . '/../includes/sidebar.php'; ?>

<div class="main-content">

    <?php include __DIR__ . '/../includes/topbar.php'; ?>

    <div class="content">

        <h1 class="page-title">
            ⚙️ Tournament Settings
        </h1>


        <div class="settings-box">

            <h2>
                League Configuration
            </h2>

            <form method="POST">

                <!-- LEAGUE TYPE -->

                <div class="form-group">

                    <label>
                        League Type
                    </label>

                    <select name="league_type">

                        <option value="single"

                        <?php

                        if($settings['league_type'] == 'single'){
                            echo "selected";
                        }

                        ?>

                        >

                        Single Round Robin

                        </option>


                        <option value="double"

                        <?php

                        if($settings['league_type'] == 'double'){
                            echo "selected";
                        }

                        ?>

                        >

                        Double Round Robin

                        </option>

                    </select>

                </div>


                <!-- MIN PLAYERS -->

                <div class="form-group">

                    <label>
                        Minimum Players
                    </label>

                    <input type="number"
                           name="min_players"
                           value="<?php echo $settings['min_players']; ?>"
                           required>

                </div>


                <!-- MAX PLAYERS -->

                <div class="form-group">

                    <label>
                        Maximum Players
                    </label>

                    <input type="number"
                           name="max_players"
                           value="<?php echo $settings['max_players']; ?>"
                           required>

                </div>


                <!-- PLAYOFF SPOTS -->

                <div class="form-group">

                    <label>
                        Playoff Spots
                    </label>

                    <input type="number"
                           name="playoff_spots"
                           value="<?php echo $settings['playoff_spots']; ?>"
                           required>

                </div>


                <!-- SAVE BUTTON -->

                <button type="submit"
                        name="save_settings"
                        class="save-btn">

                    Save Settings

                </button>

            </form>


            <!-- INFO -->

            <div class="info-box">

                ⚠️ Tournament settings affect fixture generation,
                playoff qualification, and league structure.

                <br><br>

                Recommended:
                <br>
                • 8 Teams → Top 4 playoffs
                <br>
                • 10 Teams → Top 4 playoffs
                <br>
                • 12 Teams → Top 6 playoffs

            </div>

        </div>

    </div>

</div>

</body>
</html>