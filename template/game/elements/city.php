<?php
/**
 * thomsikdev_rpg - city.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 09.02.2024
 * Time: 00:41
 * Email: informacje@thomsikdev.pl
 */
?>

<div class="post">
    <div class="row">
        <div class="col-8">
            <img class="img-fluid" src="/assets/gfx/cities/<?php echo $get_City['city_image']; ?> ">
        </div>
        <div class="col-4">
            <h2><?php echo $get_City['city_name']?> &nbsp; <small style="font-style: italic;font-size: 16px;font-weight: lighter;"><?php echo $get_City['type_of_city']?></small></h2>
            <hr>
            Budynki
            <hr>
            <?php
            foreach($city_array as $city_array_key => $city_array_value){
                echo '<a href="index.php?game='.$city_array_key.'"><button class="btn-dark btn btn-sm"> Odwiedź '.$city_array_value.'</button></a><br><br>';
            }
            ?>

        </div>
    </div>
</div>
