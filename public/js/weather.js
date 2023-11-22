function updateTime() {
    var now = new Date();
    var daysOfWeek = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
    ];

    var day = daysOfWeek[now.getDay()];
    var date = now.getDate();
    var month = now.getMonth() + 1; // Months are zero-based
    var year = now.getFullYear();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();

    // Formatting to ensure two digits
    date = date < 10 ? "0" + date : date;
    month = month < 10 ? "0" + month : month;
    hours = hours < 10 ? "0" + hours : hours;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    var dateString = date + "/" + month + "/" + year;
    var timeString = hours + ":" + minutes + ":" + seconds;

    // Update the content of the 'time' element
    document.getElementById("time").innerHTML = "Time: " + timeString;
    document.getElementById("date").innerHTML = day + ", " + dateString;
}

// Call updateTime every second (1000 milliseconds)
setInterval(updateTime, 1000);