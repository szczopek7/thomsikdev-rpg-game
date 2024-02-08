<?php
/**
 * thomsikdev_rpg - expedition_on.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 02.11.2023
 * Time: 14:03
 * Email: informacje@thomsikdev.pl
 */
?>

<div class="post">
    <p><h3 class="text-start"><?php echo $name_of_page;?> </h3></p>

    <div class="card">
            <input type="text" style="visibility: hidden;" value="1" id="expedition_type" name="expedition_type" readonly>
            <div class="row">
                <div class="col-6">
                    <img src="/assets/gfx/expedition_1.jpg" class="img-fluid rounded border-secondary" style="padding: 25px;" alt="wyprawa">
                </div>
                <div class="col-6">
                    <h3 style="color:white;">Ochrona szlaków kupieckich</h3>
                    <p style="color:white;">
                        Wyruszyłeś na wyprawę: <br />
                        <i><?php echo $expedition_start_info;?></i> <br />
                        Powrócisz z wyprawy: <br />
                        <i><?php echo $expedition_end_info;?></i> <br />
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
            <br>
    </div>

</div>
