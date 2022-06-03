<form method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label>home_id</label>
        <input type="text" name="home_id" class="form-control" value="<?php echo $game['home_id'] ?>">
    </div>

    <div class="form-group">
        <label>away_id</label>
        <input type="text" name="away_id" class="form-control" value="<?php echo $game['away_id'] ?>">
    </div>

    <div class="form-group">
        <label>game_day</label>
        <input type="text" name="game_day" class="form-control" value="<?php echo $game['game_day'] ?>">
    </div>

    <div class="form-group">
        <label>home_score</label>
        <input type="text" name="home_score" class="form-control" value="<?php echo $game['home_score'] ?>">
    </div>

    <div class="form-group">
        <label>away_score</label>
        <input type="text" name="away_score" class="form-control" value="<?php echo $game['away_score'] ?>">
    </div>



    <button type="submit" class="btn btn-sm btn-success">Submit</button>
</form>