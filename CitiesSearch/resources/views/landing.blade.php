<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Cities Search</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/47a76e5697.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script>
        $(document).ready(function() {
            $("#search").click(function(){
                var benua = new Array();
                var cari = $("#cari").val();
                var rank = $("#rank").val();
                $('input[name="filter"]:checked').each(function() {
			        benua.push(this.value);
		        });
                if (benua.length == 0) {
                    benua.push("all");
                }
                console.log(benua)
                $.ajax({
                    url:'/search?q='+cari+'&filter='+benua+'&rank='+rank,
                    dataType : "json",
                    success: function(data){
                        $('#content').html(data);
                    },
                    error: function(data){
                        alert("Please insert your command");
                    }
                });
            });
        });
    </script>

</head>
<body style="background-color: #222020;">

    <header>
        <nav class="navbar navbar-expand-lg navbar-light shadow-sm rounded" style="background-color: #222020;">
            <div class="container-fluid">
                <span class="navbar-brand text-white" style="font-family: Poppins;">220411100061<b> Ronggo Widjoyo</b></span>
                <a href="https://github.com/dr5hn/countries-states-cities-database?tab=readme-ov-file" target="_blank" class="navbar-brand text-white font-weight-bold" style="font-family: Poppins;">🌏 Cities Around The World 🌍</a>
                <span class="navbar-brand text-white" style="font-family: Poppins;">Temu Kembali informasi A </span>
            </div>
        </nav>
    </header>

    <main role="main" style="height:200px; background-image: linear-gradient( rgb(0 0 0) 18.8%, #222020 100.2% );">
        <div class="container pt-5 w-50">
            <!-- Another variation with a button -->
            <form action="#" method="GET" onsubmit="return false" class="input-group">
                <select class="form-control" name="rank" id="rank" hidden>
                    <option value="100"></option>
                </select>
                <input type="text" class="form-control rounded-left" placeholder="Search Cities Across The World✨" name="q" id="cari">
                <div class="input-group-append">
                    <button class="btn btn-secondary" id="search" type="submit" value=""><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
        </div>
        <div class="container pt-4">
            <div>
                <label for="filter" id="filter" class="text-white mr-3">Filter Benua: (all by default)</label>
            </div>    
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="Australia and New Zealand" id="region-australia-new-zealand" name="filter">
                <label class="form-check-label text-white" for="region-australia-new-zealand">
                    Australia dan Selandia Baru
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="Caribbean" id="region-caribbean" name="filter">
                <label class="form-check-label text-white" for="region-caribbean">
                    Karibia
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="Central America" id="region-central-america" name="filter">
                <label class="form-check-label text-white" for="region-central-america">
                    Amerika Tengah
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="Central Asia" id="region-central-asia" name="filter">
                <label class="form-check-label text-white" for="region-central-asia">
                    Asia Tengah
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="Eastern Africa" id="region-eastern-africa" name="filter">
                <label class="form-check-label text-white" for="region-eastern-africa">
                    Afrika Timur
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="Eastern Asia" id="region-eastern-asia" name="filter">
                <label class="form-check-label text-white" for="region-eastern-asia">
                    Asia Timur
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="Eastern Europe" id="region-eastern-europe" name="filter">
                <label class="form-check-label text-white" for="region-eastern-europe">
                    Eropa Timur
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="Melanesia" id="region-melanesia" name="filter">
                <label class="form-check-label text-white" for="region-melanesia">
                    Melanesia
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="Micronesia" id="region-micronesia" name="filter">
                <label class="form-check-label text-white" for="region-micronesia">
                    Mikronesia
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="Middle Africa" id="region-middle-africa" name="filter">
                <label class="form-check-label text-white" for="region-middle-africa">
                    Afrika Tengah
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="Northern Africa" id="region-northern-africa" name="filter">
                <label class="form-check-label text-white" for="region-northern-africa">
                    Afrika Utara
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="Northern America" id="region-northern-america" name="filter">
                <label class="form-check-label text-white" for="region-northern-america">
                    Amerika Utara
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="Northern Europe" id="region-northern-europe" name="filter">
                <label class="form-check-label text-white" for="region-northern-europe">
                    Eropa Utara
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="Polynesia" id="region-polynesia" name="filter">
                <label class="form-check-label text-white" for="region-polynesia">
                    Polinesia
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="South America" id="region-south-america" name="filter">
                <label class="form-check-label text-white" for="region-south-america">
                    Amerika Selatan
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="South-Eastern Asia" id="region-south-eastern-asia" name="filter">
                <label class="form-check-label text-white" for="region-south-eastern-asia">
                    Asia Tenggara
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="Southern Africa" id="region-southern-africa" name="filter">
                <label class="form-check-label text-white" for="region-southern-africa">
                    Afrika Selatan
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="Southern Asia" id="region-southern-asia" name="filter">
                <label class="form-check-label text-white" for="region-southern-asia">
                    Asia Selatan
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="Southern Europe" id="region-southern-europe" name="filter">
                <label class="form-check-label text-white" for="region-southern-europe">
                    Eropa Selatan
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="Western Africa" id="region-western-africa" name="filter">
                <label class="form-check-label text-white" for="region-western-africa">
                    Afrika Barat
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="Western Asia" id="region-western-asia" name="filter">
                <label class="form-check-label text-white" for="region-western-asia">
                    Asia Barat
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="Western Europe" id="region-western-europe" name="filter">
                <label class="form-check-label text-white" for="region-western-europe">
                    Eropa Barat
                </label>
            </div>
        </div>
            </form>
    </main>

    <div class="row m-4 align-items-center justify-content-center" id="content">
     
    </div>

</body>
</html>