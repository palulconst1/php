<body>
    <p>
    <h3 style="margin-left: 50px;">Games</h3>

    <?php
    if (isset($_SESSION['valid_user'])) {

        $user = $_SESSION['valid_user'];
        echo '<a href="/game/create" type="button" class="btn btn-sm btn-success"  style="margin-left: 50px;">Add Game</a>';
    }

    ?>

    </p>

    <div style="margin-right:100px">
        <table class="table  table-responsive-md btn-table">
            <thead>
                <tr>
                    <th scope="col">Nr</th>
                    <th scope="col">Home</th>
                    <th scope="col">Away</th>
                    <th scope="col">Score</th>
                    <th scope="col">Date</th>
                    <th scope="col" <?php
                                    if (isset($_SESSION['valid_user'])) {
                                        echo '';
                                    } else {
                                        echo 'hidden';
                                    }

                                    ?>>Edit</th>
                    <th scope="col" <?php
                                    if (isset($_SESSION['valid_user'])) {
                                        $user = $_SESSION['valid_user'];
                                        if ($user['role'] == 2) {
                                            echo '';
                                        } else {
                                            echo 'hidden';
                                        }
                                    } else {
                                        echo 'hidden';
                                    }

                                    ?>> Delete game</th>



                </tr>
            </thead>
            <tbody>
                <?php foreach ($games as $i => $game) { ?>
                    <tr>
                        <th scope="row"><?php echo $game['id'] ?></th>

                        <td style="font-weight: bold"><?php echo $teams1[$i]['tname'] ?></td>
                        <td style="font-weight: bold"><?php echo $teams2[$i]['tname'] ?></td>
                        <td><?php echo $game['home_score'] ?> <span> - </span> <?php echo $game['away_score'] ?></td>
                        <td><?php echo $game['game_day'] ?></td>
                        <td>
                            <a href="/game/update?id=<?php echo $game['id'] ?>" <?php
                                                                                if (isset($_SESSION['valid_user'])) {
                                                                                    echo '';
                                                                                } else {
                                                                                    echo 'hidden';
                                                                                }

                                                                                ?> class="btn btn-sm  btn-primary btn-block" style="margin-right: -10px">Edit</a>
                        </td>

                        <td>
                            <form method="post" action="/game/delete">

                                <button type="submit" <?php
                                                        if (isset($_SESSION['valid_user'])) {
                                                            $user = $_SESSION['valid_user'];
                                                            if ($user['role'] == 2) {
                                                                echo '';
                                                            } else {
                                                                echo 'hidden';
                                                            }
                                                        } else {
                                                            echo 'hidden';
                                                        }

                                                        ?> class="btn btn-sm btn-danger btn-block">Delete</button>

                                <input type="hidden" name="id" value="<?php echo $game['id'] ?>" />

                            </form>
                        </td>


                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>