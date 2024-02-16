<div class="post">
    <div class="row">
        <div class="col-3">
            <img class="img-fluid" src="/assets/gfx/npc/kroky/military_office/Thalia_Gulsvig.png">
        </div>
        <div class="col-9">
            <h3>Thalia Gulsvig <small style="font-style: italic;font-size: 16px;font-weight: lighter;">Kapitan straży miasta Kroky</small></h3>
            <hr>
            <p>
                Od lat służy miastu Kroky jako kapitan straży, dbając o bezpieczeństwo mieszkańców z pełnym oddaniem. Zawsze gotowy do działania, posiada bogate doświadczenie taktyczne i umiejętności bojowe, które sprawiają, że jest szanowany przez swoich podkomendnych oraz szukających pomocy mieszkańców miasta. Jego lojalność wobec miasta i jego mieszkańców jest niepodważalna, a jego obecność na posterunku stanowi gwarancję spokoju i bezpieczeństwa dla wszystkich.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-8 offset-2">
            <h4>Tablica misji:</h4>
            <hr>
        </div>
        <div class="col-8 offset-2">
            <p class="text-danger">Aktualnie nie ma żadnych misji.</p>
        </div>

    </div>
    <div class="row">
        <div class="col-8 offset-2">
            <h4>Warta:</h4>
            <hr>
        </div>
        <div class="col-8 offset-2">
            <div class="row">
                <div class="col-8">
                    Wspomóż straż miasta Kroky w zadaniach patrolowych na terenie Miasta. <br>
                    Czas trwania: 1 godzina; <br>
                    Za prace zarobisz od <?php echo $config_game['job_worth_1_money_base'];?> <br>
                    do <?php echo $money_to_get_job_worth_1 = $config_game['job_worth_1_money_base']*3;?> monet.
                </div>
                <div class="col-4">
                    <a href="/index.php?game=build_military_office&job_worth=1"> <button class="btn-dark btn">Wyślij postać na Wartę</button></a>
                </div>
            </div>
        </div>

    </div>
</div>