
let expedition_end_couter = 0;

function reloadPage(){
    window.location.reload();
}

function replacePage(){
    location.replace(location.href);
}

function timerExpedition() {

    let time_in_second_to_end = document.getElementById("timerExpedition").ariaValueNow;
    let time_to_minutes;
    let time_to_seconds;

    if (time_in_second_to_end > 0) {
        time_in_second_to_end = time_in_second_to_end - 1;
        document.getElementById("timerExpedition").ariaValueNow = time_in_second_to_end;
        time_to_minutes = Math.floor((time_in_second_to_end) / 60)
        time_to_seconds = time_in_second_to_end - time_to_minutes * 60
        document.getElementById("timerExpedition").innerHTML = "Czas do końca wyprawy : " + time_to_minutes + " minut oraz " + time_to_seconds + " sekund.";
    } else {
        expedition_end_couter++;
        time_in_second_to_end = 0;
        document.getElementById("timerExpedition").innerHTML = "Wyprawa została ukończona";
        if (expedition_end_couter > 5) {
            reloadPage();
        }
    }

}

