<?php
include '../auth.php';
include __DIR__ . '/../assets/db.php';
?>

<!DOCTYPE html>
<html>

<head>

    <title>COE Standings</title>

    <link rel="stylesheet" href="../includes/layout.css">

    <style>

        .page-title{
            color:#ff9900;
            margin-bottom:30px;
            font-size:38px;
        }

        .table-container{
            overflow-x:auto;
        }

        table{
            width:100%;
            border-collapse:collapse;
            background:#171717;
            border-radius:15px;
            overflow:hidden;
        }

        table th{
            background:#ff9900;
            color:black;
            padding:18px;
            font-size:15px;
        }

        table td{
            padding:18px;
            text-align:center;
            border-bottom:1px solid #2b2b2b;
            font-size:15px;
        }

        table tr:hover{
            background:#1f1f1f;
        }

        .rank{
            font-weight:bold;
            color:#ff9900;
        }

        .top-player{
            background:rgba(255,153,0,0.08);
        }

        .points{
            color:#4dff88;
            font-weight:bold;
        }

    </style>

</head>

<body>

<?php include __DIR__ . '/../includes/sidebar.php'; ?>

<div class="main-content">

    <?php include __DIR__ . '/../includes/topbar.php'; ?>

    <div class="content">

        <h1 class="page-title">
            📊 League Standings
        </h1>


        <div class="table-container">

            <table>

                <tr>

                    <th>Rank</th>
                    <th>Player</th>
                    <th>Played</th>
                    <th>Wins</th>
                    <th>Draws</th>
                    <th>Losses</th>
                    <th>GF</th>
                    <th>GA</th>
                    <th>GD</th>
                    <th>Points</th>

                </tr>

                <?php

                $standings = mysqli_query($conn,

                "SELECT standings.*,
                        players.player_name

                FROM standings

                JOIN players
                ON standings.player_id = players.id

                ORDER BY
                points DESC,
                goal_difference DESC,
                goals_for DESC"

                );



                $rank = 1;

                while($row = mysqli_fetch_assoc($standings)){

                ?>

                <tr class="<?php echo ($rank <= 4) ? 'top-player' : ''; ?>">

                    <td class="rank">

                        #<?php echo $rank; ?>

                    </td>

                    <td>

                        <?php echo $row['player_name']; ?>

                    </td>

                    <td>

                        <?php echo $row['played']; ?>

                    </td>

                    <td>

                        <?php echo $row['wins']; ?>

                    </td>

                    <td>

                        <?php echo $row['draws']; ?>

                    </td>

                    <td>

                        <?php echo $row['losses']; ?>

                    </td>

                    <td>

                        <?php echo $row['goals_for']; ?>

                    </td>

                    <td>

                        <?php echo $row['goals_against']; ?>

                    </td>

                    <td>

                        <?php echo $row['goal_difference']; ?>

                    </td>

                    <td class="points">

                        <?php echo $row['points']; ?>

                    </td>

                </tr>

                <?php

                $rank++;

                }

                ?>

            </table>

        </div>

    </div>

</div>

</body>
</html>