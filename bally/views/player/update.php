<form method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label>Player name</label>
        <input type="text" name="pname" class="form-control" value="<?php echo $player['pname'] ?>">
    </div>

    <div class="form-group">
        <label>Team</label>
        <input type="text" name="team_id" class="form-control" value="<?php echo $player['team_id'] ?>">
    </div>

    <div class="form-group">
        <label>Goals</label>
        <input type="text" name="goals" class="form-control" value="<?php echo $player['goals'] ?>">
    </div>

    <div class="form-group">
        <label>Position</label>
        <input type="text" name="position" class="form-control" value="<?php echo $player['position'] ?>">
    </div>



    <button type="submit" class="btn btn-sm btn-success">Submit</button>
</form>