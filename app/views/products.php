<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>AsArt Ceramika</title>
        <meta name="keywords" content="Ceramika, Ozdoby, Dom, Ogród, Morze" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet"  href="files/style/style.css">
        <link rel="stylesheet"  href="files/style/nav_style.css">
        <link rel="stylesheet"  href="files/style/footer_style.css">
        <link rel="stylesheet"  href="files/style/gallery_style.css">
        <link rel="icon" href="files/images/other/favicon.ico">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="files/js/products.js"></script>
        <script src="files/js/simple_overlay_gallery.js"></script>

        <script>
            $( document ).ready(function() {
                loadProducts();
            });
            window.onscroll = function(ev) {
                if ((window.innerHeight + document.documentElement.scrollTop) >= document.getElementById("page").offsetHeight-document.getElementById("copyright").offsetHeight) {
                    loadProducts();
                }
            };  
        </script>
    </head>
    <body>
        <div id="wrapper" class="row">
            <nav>
                <input type="checkbox" id="toggle"/>
                <div id="logo" class="row">
                    <a class="noSelect" href="/home">
                        <img src="files/images/logo/asart_logo.png" alt="logo">
                    </a>
                    <label id="hamburger" class="noSelect" for="toggle">&#9776</label>
                </div>
                
                <div id="menu" >
                    <a class="noSelect" href="/home">Główna</a> 
                    <a class="noSelect" href="/products">Produkty</a>
                    <a class="noSelect" href="/contact">Kontakt</a>
                </div>
            </nav>
            <div id="page" class="column">
                <main>
                    <input id="last_product_id" type="hidden" value="1000000000">
                </main>
                <footer class="column">
                    <div id="productloader">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; display: block; shape-rendering: auto;" width="44px" height="44px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                            <circle cx="50" cy="50" fill="none" stroke="#131313" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138" transform="rotate(62.3066 50 50)">
                                <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1.7241379310344827s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                            </circle>
                        </svg>
                    </div>
                    <div id="copyright">Wszystkie prawa zastrzeżone © AsArt 2019</div>
                </footer>
            </div>
        </div>
    </body>
</html>