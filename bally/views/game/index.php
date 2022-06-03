

<body>
<p>
<h3  style="margin-left: 50px;">Games</h3>
<a href="/game/create" type="button" class="btn btn-sm btn-success"  style="margin-left: 50px;">Add Game</a>
<?php
if (isset($_SESSION['valid_user'])) {

    $user = $_SESSION['valid_user'];
    if($user['role_permission']==0){
        echo '<a href="/game/create" type="button" class="btn btn-sm btn-success"  style="margin-left: 50px;">Adauga Meci</a>';
    }
    #echo  $old_user['username'];

}

?>

</p>

<div style="margin-right:100px">
    <table class="table  table-responsive-md btn-table"  >
        <thead>
        <tr>
            <th scope="col">Nr</th>
            <th scope="col">Home</th>
            <th scope="col">Away</th>
            <th scope="col">Score</th>
            <th scope="col">Date</th>
            <th scope="col">Edit</th>
            <th scope="col"> Delete game</th>



        </tr>
        </thead>
        <tbody>
        <?php foreach ($games as $i => $game) { ?>
            <tr>
                <th scope="row"><?php echo $i + 1 ?></th>

                <td style="font-weight: bold"><?php echo $teams1[$i]['tname'] ?></td>
                <td style="font-weight: bold"><?php echo $teams2[$i]['tname'] ?></td>
                <td><?php echo $game['home_score'] ?> <span> - </span> <?php echo $game['away_score'] ?></td>
                <td><?php echo $game['game_day'] ?></td>
                <td>
                    <a href="/game/update?id=<?php echo $game['id'] ?>" class="btn btn-sm  btn-primary btn-block" style="margin-right: -10px">Edit</a>
                </td>

                <td>
                <form method="post" action="/game/delete" >
                    <?php
                    if (isset($_SESSION['valid_user'])) {
                        $user = $_SESSION['valid_user'];
                            echo '<button type="submit" class="btn btn-sm btn-danger btn-block">Delete</button>';
                    }
                    else
                    {
                        echo 'Requires Admin';
                    }
                    ?>
                    <input  type="hidden" name="id" value="<?php echo $game['id'] ?>"/>

                </form>
            </td>


            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>

