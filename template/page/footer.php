<?php
/**
 * thomsikdev_rpg - footer.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 16.09.2023
 * Time: 03:13
 * Email: informacje@thomsikdev.pl
 */
?>

<!-- Notify block -->

    <?php
    if(!empty($errormsg)){
        echo '
                <br />
                <div class="alert alert-danger" role="alert">
                      '.$errormsg.'
                </div>
            ';
    }
    ?>

</div>
<!-- Rankings -->
<div class="col-lg-3">
    <div class="card">
        <div class="card-body">
                <a href="/index.php?page=login" class="btn btn-web btn-dark">Zaloguj się</a>
                <a href="/index.php?page=register" class="btn btn-web btn-dark">Zarejestru się</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Najlepsi gracze
        </div>
        <div class="card-body">
            <ul>
                <li>1. aaaa</li>
                <li>1. aaaa</li>
                <li>1. aaaa</li>
                <li>1. aaaa</li>
                <li>1. aaaa</li>
                <li>1. aaaa</li>
                <li>1. aaaa</li>
                <li>1. aaaa</li>
                <li>1. aaaa</li>
                <li>1. aaaa</li>
            </ul>
        </div>
    </div>
    <div class="card margin-space_5">
        <div class="card-header">
            Najlepsze gildie
        </div>
        <div class="card-body">
            <ul>
                <li>1. aaaa</li>
                <li>1. aaaa</li>
                <li>1. aaaa</li>
                <li>1. aaaa</li>
                <li>1. aaaa</li>
                <li>1. aaaa</li>
                <li>1. aaaa</li>
                <li>1. aaaa</li>
                <li>1. aaaa</li>
                <li>1. aaaa</li>
            </ul>
        </div>
    </div>
</div>
</div>
</div>

<div class="margin-space_2"></div>

<!--Footer-->
<content class="container mt-auto ">
    <div class="row">
        <div class="col-4">


        </div>
        <div class="col-4">
            <ul class="list-group">
                <a href="#"><li class="list-group-item list-group-item-dark">O grze</li></a>
                <a href=""><li class="list-group-item list-group-item-dark">Lista wydarzeń</li></a>
                <a href="index.php?page=changelog"><li class="list-group-item list-group-item-dark">Ostanie aktualizacje</li></a>
            </ul>
        </div>
        <div class="col-4">
            <ul class="list-group">
                <a href=""><li class="list-group-item list-group-item-dark">Regulamin</li></a>
                <a href=""><li class="list-group-item list-group-item-dark">Zasady prywatności</li></a>
                <a href="index.php?page=image_creators"><li class="list-group-item list-group-item-dark">Baza obrazów</li></a>
                <a href=""><li class="list-group-item list-group-item-dark">Twórcy</li></a>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            Create by ThomsikDev &copy; 2022 - <?php echo date('Y');?>
        </div>
    </div>
</content>


</body>
</html>
