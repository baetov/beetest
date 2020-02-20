<h1>добавление задачи</h1>


<div class="col-sm-6" >


        <form  action="/tasks/create" method="post">

            <div class="form-group ">
                <label class="control-label" >Ваше имя</label>
                <input type="text" class="form-control" name="username" placeholder="Имя" ">

            </div>
            <div class="form-group ">
                <label class="control-label" >Адрес электронной почты</label>
                <input type="email" class="form-control" name="email" placeholder="@email">
            </div>
            <div class="form-group ">
                <label class="control-label" >Описание</label>
                <textarea type="text" class="form-control" name="description"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">добавить задачу</button>
            </div>

        </form>
</div>

