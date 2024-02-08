<?php
/**
 * thomsikdev_rpg - random.php
 * User: Patryk "Thomsik Dev" Tomasik
 * Date: 02.11.2023
 * Time: 18:13
 * Email: informacje@thomsikdev.pl
 * @throws Exception
 */

function drawNumber($min, $max): int
{
    return random_int($min,$max);
}