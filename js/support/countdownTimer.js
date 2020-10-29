(function ($) {

function countdownTimer() {
    endTime = window.endTime;
    const difference = +new Date(endTime) - +new Date();
    let remaining = "Go Dawgs!";

    if (difference > 0) {
        const parts = {
            days: Math.floor(difference / (1000 * 60 * 60 * 24)),
            hours: Math.floor((difference / (1000 * 60 * 60)) % 24),
            minutes: Math.floor((difference / 1000 / 60) % 60),
            // seconds: Math.floor((difference / 1000) % 60),
        };
        remaining = Object.keys(parts).map(part => {
            return `${parts[part]} ${part}`;
        }).join(" : ");
    }

    document.getElementById("countdown").innerHTML = remaining;
}

countdownTimer();
setInterval(countdownTimer, 60000);

}(jQuery)); 