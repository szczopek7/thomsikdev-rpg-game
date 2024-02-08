<?php
/**
 * thomsikdev_rpg - expedition_start.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 02.11.2023
 * Time: 13:53
 * Email: informacje@thomsikdev.pl
 */

?>

<div class="post">
    <p><h3 class="text-start"><?php echo $name_of_page;?> </h3></p>

    <div class="card">
        <form action="index.php?game=expedition" method="post">
            <input type="text" style="visibility: hidden;" value="1" id="expedition_type" name="expedition_type" readonly>
            <div class="row">
                <div class="col-6">
                    <img src="/assets/gfx/expedition_1.jpg" class="img-fluid rounded border-secondary" style="padding: 25px;" alt="wyprawa">
                </div>
                <div class="col-6">
                    <h3 style="color:white;">Ochrona szlaków kupieckich</h3>
                    <p style="color:white;">
                        Król powierza wam ważne zadanie - zapewnić ochronę kluczowym szlakom kupieckim królestwa. Handel jest kręgosłupem naszej gospodarki, a szlaki kupieckie są zagrożone przez rosnące bandy rabusiów i bestie, które grasują na drogach. Waszym zadaniem jest stworzyć i dowodzić oddziałem strażników, którzy będą patrolować te trasy, eliminując zagrożenia i utrzymując bezpieczeństwo dla kupców i karawan.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-6 offset-6">
                    <button class="btn btn-outline-danger" type="submit">Wyślij na wyprawe</button>
                </div>
            </div>
            <br>

        </form>
    </div>

</div>
