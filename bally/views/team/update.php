<form method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label>Team name</label>
        <input type="text" name="tname" class="form-control" value="<?php echo $team['tname'] ?>">
    </div>

    <div class="form-group">
        <label>Country</label>
        <input type="text" name="country" class="form-control" value="<?php echo $team['country'] ?>">
    </div>

    <div class="form-group">
        <label>Stadium</label>
        <input type="text" name="stadium" class="form-control" value="<?php echo $team['stadium'] ?>">
    </div>

    <div class="form-group">
        <label>Abreviation</label>
        <input type="text" name="abrev" class="form-control" value="<?php echo $team['abrev'] ?>">
    </div>



    <button type="submit" class="btn btn-sm btn-success">Submit</button>
</form>