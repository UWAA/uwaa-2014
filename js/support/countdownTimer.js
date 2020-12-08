(function ($) {

    function countdownTimer() {
        var endTime = new Date(window.endTime);
        var currentTime = new Date();
        var difference = endTime - currentTime;
        var remaining = "Go Dawgs!";

        if (difference > 0) {
            var parts = {
                days: Math.floor(difference / (1000 * 60 * 60 * 24)),
                hours: Math.floor((difference / (1000 * 60 * 60)) % 24),
                minutes: Math.floor((difference / 1000 / 60) % 60),
                // seconds: Math.floor((difference / 1000) % 60),
            };
            remaining = Object.keys(parts).map(function (part) {
                return parts[part] + " " + part;
            }).join(" : ");
        }

        document.getElementById("countdown").innerHTML = remaining;
    }

    countdownTimer();
    setInterval(countdownTimer, 60000);

}(jQuery)); 