
<div class="col-sm-6" >


    <form  action="/tasks/update/?id=<?=$_GET['id']?>" method="post">
        <input type="hidden" name="status" value="0">
        <input type="hidden" name="status" value="<?=$task->id?>">
        <div class="form-group ">
            <label class="control-label" >username</label>
            <input type="text" class="form-control" name="username" value="<?=$task->username?>" ">

        </div>
        <div class="form-group ">
            <label class="control-label" >@email</label>
            <input type="text" class="form-control" name="email" value="<?=$task->email?>">
        </div>
        <div class="form-group ">
            <label class="control-label" >описание</label>
            <textarea type="text" class="form-control"  name="description" ><?=$task->description?></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>

    </form>
</div>
