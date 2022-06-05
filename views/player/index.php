<body>
    <p>
    <h3 style="margin-left: 50px;">Players</h3>

    <?php
    if (isset($_SESSION['valid_user'])) {

        $user = $_SESSION['valid_user'];
        echo '<a href="/player/create" type="button" class="btn btn-sm btn-success"  style="margin-left: 50px;">Add player</a>';
    }

    ?>

    </p>

    <div style="margin-right:100px">
        <table class="table  table-responsive-md btn-table">
            <thead>
                <tr>
                    <th scope="col">Nr</th>
                    <th scope="col">Team</th>
                    <th scope="col">Name</th>
                    <th scope="col">Goals</th>
                    <th scope="col">Position</th>
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

                                    ?>>Delete</th>



                </tr>
            </thead>
            <tbody>
                <?php foreach ($players as $i => $player) { ?>
                    <tr>
                        <th scope="row"><?php echo $player['id'] ?></th>

                        <td style="font-weight: bold"><?php echo $teams[$i]['tname'] ?></td>
                        <td><?php echo $player['pname'] ?></td>
                        <td><?php echo $player['goals'] ?></td>
                        <td><?php echo $player['position'] ?></td>
                        <td>
                            <a href="/player/update?id=<?php echo $player['id'] ?>" <?php
                                                                                    if (isset($_SESSION['valid_user'])) {
                                                                                        echo '';
                                                                                    } else {
                                                                                        echo 'hidden';
                                                                                    }

                                                                                    ?> class="btn btn-sm  btn-primary btn-block" style="margin-right: -10px">

                                Edit
                            </a>
                        </td>


                        <td>
                            <form method="post" action="/player/delete">
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
                                <input type="hidden" name="id" value="<?php echo $player['id'] ?>" />

                            </form>
                        </td>


                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>