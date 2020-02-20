<div class="container">

    <a class="btn btn-primary btn-lg mb-3 mt-3" href="/tasks/create">добавить задачу</a>

    <div class="btn-group m-3">
        <h5>сортировать по</h5>
        <div class="dropdown ml-3" >
            <button class="btn btn-secondary btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Имени
            </button>
            <?
            $page = $_GET['page'] ? '&page='.$_GET['page'] : '';
            ?>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="/tasks/index/?sort=name-up<?=$page?>">от А до Я</a>
                <a class="dropdown-item" href="/tasks/index/?sort=name-down<?=$page?>">от Я до А</a>
            </div>
        </div>
        <div class="dropdown ml-3" >
            <button class="btn btn-secondary btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Email
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="/tasks/index/?sort=email-up"<?=$page?>>от A до Z</a>
                <a class="dropdown-item" href="/tasks/index/?sort=email-down<?=$page?>">от Z до A</a>
            </div>
        </div>
        <div class="dropdown ml-3" >
            <button class="btn btn-secondary btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Статусу
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="/tasks/index/?sort=status-edited<?=$page?>">отредактировано</a>
                <a class="dropdown-item" href="/tasks/index/?sort=status-not-edited<?=$page?>">не отредактировано</a>
            </div>
        </div>
    </div>



    <? foreach ($tasks as $task): ?>

        <div class="card mb-3">
            <div class="card-body">
                <h4 class="card-title">Автор : <?= $task['username'] ?></h4>
                <h5 class="card-title">Email : <?= $task['email'] ?></h5>
                <p class="card-text"><?= $task['description'] ?></p>
                <?
                if ($task['status']== 1){
                echo '<p class="card-text"><small class="text-muted">выполнено</small></p>';
                }elseif ($task['status']== 2){
                    echo '<p class="card-text"><small class="text-muted">выполнено</small></p>';
                    echo '<p class="card-text"><small class="text-muted">отредактировано администратором</small></p>';
                }
                else{
                    echo '<p class="card-text"><small class="text-muted">ождает редактования</small></p>' ;
                }

                if ($isAdmin){
                    echo '<a href="/tasks/update/?id='.$task['id'].'">Редактировать</a>';

                }
                ?>

            </div>
        </div>
    <? endforeach; ?>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?
            $sort = $_GET['sort'] ? '&sort='.$_GET['sort'] : '';
            for ($i = 1; $i <= $pageCount; $i++) {
                echo "<li class=\"page-item\"><a class=\"page-link\" href=\"/tasks/index/?page=$i$sort\">$i</a></li>";
            }
            ?>
        </ul>
    </nav>

</div>

