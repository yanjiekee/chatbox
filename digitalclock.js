function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    if (h > 12) {
        var meridiem = "pm";
        h = h - 12;
    } else {
        var meridiem = "am";
    }
    document.getElementById('digitalclock').innerHTML = h + ":" + m + ":" + s + " " + meridiem;
    var t = setTimeout(startTime, 500);
}

function checkTime(i) {
    if (i < 10) {i = "0" + i};
    return i;
}
