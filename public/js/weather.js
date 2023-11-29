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

document.addEventListener("DOMContentLoaded", function () {
    var provincesAndCities = {
        "Aceh": [
            "Aceh-Barat",
            "Aceh-Barat-Daya",
            "Aceh-Besar",
            "Aceh-Jaya",
            "Aceh-Selatan",
            "Aceh-Singkil",
            "Aceh-Tamiang",
            "Aceh-Tengah",
            "Aceh-Tenggara",
            "Aceh-Timur",
            "Aceh-Utara",
            "Banda-Aceh",
            "Bener-Meriah",
            "Bireun",
            "Gayo-Lues",
            "Langsa",
            "Lhokseumawe",
            "Nagan-Raya",
            "Pidie",
            "Pidie-Jaya",
            "Sabang",
            "Simeulue",
            "Subulussalam",
        ],

        "Bangka-Belitung": [
            "Jebus",
            "Koba",
            "Manggar",
            "Mentok",
            "Pangkal-Pinang",
            "Selat-Nasik",
            "Sungai-Liat",
            "Sungai-Selan",
            "Tanjung-Pandan",
            "Toboali",
            "Pelabuhan-Belinyu",
        ],

        "Banten": [
            "Anyer",
            "Bayah",
            "Binuangen",
            "Bojonegara",
            "Carita",
            "Ciruas",
            "Gunung-kencana",
            "Kab.-Lebak",
            "Kota-Cilegon",
            "Kota-Tangerang",
            "Labuan",
            "Malingping",
            "Pandeglang",
            "Pelabuhan Merak",
            "Rangkasbitung",
            "Serang",
            "Serpong",
            "Tigaraksa",
        ],

        "DKI-Jakarta": [
            "Jakarta-Barat",
            "Jakarta-Pusat",
            "Jakarta-Selatan",
            "Jakarta-Timur",
            "Jakarta-Utara",
            "Kepulauan-Seribu",
        ],

        "Jawa-Barat": [
            "Bandung",
            "Banjar",
            "Bekasi",
            "Ciamis",
            "Cianjur",
            "Cibinong",
            "Cikarang",
            "Cimahi",
            "Cipanas",
            "Cirebon",
            "Cisarua",
            "Depok",
            "Gadog",
            "Garut",
            "Indramayu",
            "Karawang",
            "Kota-Bogor",
            "Kuningan",
            "Lembang",
            "Majalengka",
            "Parigi",
            "Pelabuhan-Ratu",
            "Purwakarta",
            "Singaparna",
            "Soreang",
            "Subang",
            "Kab.Sukabumi",
            "Sumber",
            "Sumedang",
            "Tasikmalaya",
        ],

        "Jawa-Timur" : [
            "Bangkalan",
            "Banyuwangi",
            "Batu",
            "Bojonegoro",
            "Bondowoso",
            "Gresik",
            "Jember",
            "Jombang",
            "Kabupaten-Blitar",
            "Kabupaten-Kediri",
            "Kabupaten-Madiun",
            "Kabupaten-Malang",
            "Kabupaten-Mojokerto",
            "Kabupaten-Pasuruan",
            "Kabupaten-Probolinggo",
            "Kota-Blitar",
            "Kota-Kediri",
            "Kota-Madiun",
            "Kota-Malang",
            "Kota-Mojokerto",
            "Kota-Pasuruan",
            "Kota-Probolinggo",
            "Lamongan",
            "Lumajang",
            "Magetan",
            "Nganjuk",
            "Ngawi",
            "Pacitan",
            "Pamekasan",
            "Ponorogo",
            "Sampang",
            "Sidoarjo",
            "Situbondo",
            "Sumenep",
            "Surabaya",
            "Trenggalek",
            "Tuban",
            "Tulungagung",
        ],
    };

    // Function to populate the dropdown based on selected province
    // Function to populate the dropdown based on selected province
    function populateCities() {
        var selectedProvince = document.getElementById("province").value;
        var citiesDropdown = document.getElementById("city");

        // Clear previous options
        citiesDropdown.innerHTML = "";

        if (selectedProvince && provincesAndCities[selectedProvince]) {
            // Populate with cities based on the selected province
            provincesAndCities[selectedProvince].forEach(function (city) {
                var option = document.createElement("option");
                option.value = city;
                option.text = city;
                citiesDropdown.add(option);
            });
        }
    }

    // Populate the province dropdown
    var provinceDropdown = document.getElementById("province");
    for (var province in provincesAndCities) {
        var option = document.createElement("option");
        option.value = province;
        option.text = province;
        provinceDropdown.add(option);
    }

    // Add event listener to province dropdown to populate cities
    provinceDropdown.addEventListener("change", populateCities);

    populateCities();
});
