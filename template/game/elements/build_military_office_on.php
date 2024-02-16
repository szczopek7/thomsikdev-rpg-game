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
            <h4>Warta:</h4>
            <hr>
        </div>
        <div class="col-8 offset-2">
            <div class="row">
                <div class="col-8">
                    Wspomagasz straż miasta Kroky w zadaniach patrolowych na terenie Miasta.<br>
                    <p style="color:white;">
                        Wyruszyłeś na wyprawę: <br />
                        <i><?php echo $job_work_start_info;?></i> <br />
                        Powrócisz z wyprawy: <br />
                        <i><?php echo $job_work_end_info;?></i> <br />
                    </p>
                    <p>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                timerExpedition(<?php echo $difference_time_now_to_end;?>);
                                setInterval(function() {
                                    timerExpedition()
                                }, 1000);
                            });
                        </script>
                    <div class="timerExpedition" id="timerExpedition" aria-valuenow="<?php echo $difference_time_now_to_end;?>"></div>
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>