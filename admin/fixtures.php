<?php
include '../auth.php';
include __DIR__ . '/../assets/db.php';
?>

<!DOCTYPE html>
<html>

<head>

    <title>COE Fixtures</title>

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
        }

        table td{
            padding:18px;
            text-align:center;
            border-bottom:1px solid #2b2b2b;
        }

        table tr:hover{
            background:#1f1f1f;
        }

        .generate-btn{
            display:inline-block;
            background:#ff9900;
            color:black;
            padding:14px 22px;
            border-radius:10px;
            text-decoration:none;
            font-weight:bold;
            margin-bottom:25px;
        }

        .generate-btn:hover{
            background:#ffb733;
        }

        .status-completed{
            color:#4dff88;
            font-weight:bold;
        }

        .status-pending{
            color:#ffcc00;
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
            📅 Fixtures
        </h1>


        <!-- GENERATE BUTTON -->

        <a href="generate-fixtures.php"
           class="generate-btn">

           ⚡ Generate Fixtures

        </a>


        <!-- FIXTURES TABLE -->

        <div class="table-container">

            <table>

                <tr>

                    <th>ID</th>
                    <th>Round</th>
                    <th>Home</th>
                    <th>Away</th>
                    <th>Status</th>

                </tr>

                <?php

                $fixtures = mysqli_query($conn,

                "SELECT fixtures.*,

                p1.player_name AS home_player,
                p2.player_name AS away_player

                FROM fixtures

                JOIN players p1
                ON fixtures.home_player_id = p1.id

                JOIN players p2
                ON fixtures.away_player_id = p2.id

                ORDER BY round_no ASC"

                );


                while($row = mysqli_fetch_assoc($fixtures)){

                ?>

                <tr>

                    <td>

                        <?php echo $row['id']; ?>

                    </td>

                    <td>

                        Round <?php echo $row['round_no']; ?>

                    </td>

                    <td>

                        <?php echo $row['home_player']; ?>

                    </td>

                    <td>

                        <?php echo $row['away_player']; ?>

                    </td>

                    <td>

                        <?php

                        if($row['match_status'] == 'completed'){

                            echo "<span class='status-completed'>
                                  Completed
                                  </span>";

                        }else{

                            echo "<span class='status-pending'>
                                  Pending
                                  </span>";

                        }

                        ?>

                    </td>

                </tr>

                <?php } ?>

            </table>

        </div>

    </div>

</div>

</body>
</html>