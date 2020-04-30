<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>AsArt Ceramika</title>
        <meta name="keywords" content="Ceramika, Ozdoby, Dom, Ogród, Morze" />
        <link rel="stylesheet"  href="files/style/style.css">
        <link rel="stylesheet"  href="files/style/admin_style.css">
        <link rel="stylesheet"  href="files/style/nav_style.css">
        <link rel="stylesheet"  href="files/style/footer_style.css">
        <link rel="stylesheet"  href="files/style/gallery_style.css">
        <link rel="icon" href="files/images/other/favicon.ico">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="files/js/admin.js"></script>
        <script src="files/js/simple_overlay_gallery.js"></script>
        <script>
            $( document ).ready(function() {
                loadProductsEdit();
            });
            window.onscroll = function(ev) {
                if ((window.innerHeight + document.documentElement.scrollTop) >= document.getElementById("page").offsetHeight-document.getElementById("copyright").offsetHeight) {
                    loadProductsEdit();
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
                        <div class="product_add">
                            <div  onclick="logoutUser()" class="logout  noSelect"><p>Wyloguj</p></div>
                            <div  onclick="viewDeleted()" class="deleted  noSelect"><p>Usunięte</p></div>
                            <div  onclick="addNewProduct()" class="add noSelect"><p>+</p></div> 
                        </div>
                        <input id="last_product_id" type="hidden" value="1000000000">
                       
                    </main>
                <footer class="column">
                    <div id="copyright">Wszystkie prawa zastrzeżone © AsArt 2019</div>
                </footer>
            </div>
        </div>
    </body>
</html>