<?php
/**
 * thomsikdev_rpg - report.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 20.02.2024
 * Time: 22:25
 * Email: informacje@thomsikdev.pl
 */

$get_All_Reports = $db_connect->query("SELECT * FROM report_action WHERE user_id = '$player_id' AND status = '1' ORDER BY date_create DESC LIMIT 50 ")

?>

<div class="post">
    <table class="table" style="color:#f0f0f0;">
        <thead>
            <tr>
                <td>Treść</td>
                <td>Data</td>
            </tr>
        </thead>
        <tbody>
        <?php

        foreach ($get_All_Reports as $get_All_Report){
            echo "<tr>";
            echo "<td>".$get_All_Report['report_text']."</td>";
            echo "<td>".$get_All_Report['date_create']."</td>";
            echo "</tr>";
        }


        ?>
        </tbody>
    </table>
</div>
