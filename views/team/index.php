<body>
    <p>
    <h3 style="margin-left: 50px;">Teams</h3>


    <?php
    if (isset($_SESSION['valid_user'])) {

        $user = $_SESSION['valid_user'];
        echo ' <a href="/team/create" type="button" class="btn btn-sm btn-success"  style="margin-left: 50px;">Add team</a>';
    }

    ?>

    </p>
    <form action="" method="get" style="margin-left: 50px;">
        <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search" value="<?php echo $keyword ?>">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </form>
    <div style="margin-right:100px">
        <table class="table  table-responsive-md btn-table">
            <thead>
                <tr>
                    <th scope="col">Nr</th>
                    <th scope="col">Name</th>
                    <th scope="col">Country</th>
                    <th scope="col">Stadium</th>
                    <th scope="col">Abreviation</th>
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

                                    ?>> Delete Team</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($teams as $i => $team) { ?>
                    <tr>
                        <th scope="row"><?php echo $team["id"] ?></th>

                        <td><?php echo $team['tname'] ?></td>
                        <td><?php echo $team['country'] ?></td>
                        <td><?php echo $team['stadium'] ?></td>
                        <td><?php echo $team['abrev'] ?></td>

                        <td>
                            <a href="/team/update?id=<?php echo $team['id'] ?>" <?php
                                                                                if (isset($_SESSION['valid_user'])) {
                                                                                    echo '';
                                                                                } else {
                                                                                    echo 'hidden';
                                                                                }

                                                                                ?> class="btn btn-sm  btn-primary btn-block" style="margin-right: -10px">Edit</a>
                        </td>

                        <td>
                            <form method="post" action="/team/delete">
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
                                <input type="hidden" name="id" value="<?php echo $team['id'] ?>" />

                            </form>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>