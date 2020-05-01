<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>AsArt Ceramika</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
        <meta name="keywords" content="Ceramika, Ozdoby, Dom, Ogród, Morze" />
        <link rel="stylesheet"  href="files/style/style.css">
        <link rel="stylesheet"  href="files/style/login_style.css">
        <link rel="stylesheet"  href="files/style/nav_style.css">
        <link rel="stylesheet"  href="files/style/footer_style.css">
        <link rel="icon" href="files/images/other/favicon.ico">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="files/js/adminlogin.js"></script>
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
                        <div id="form" >
                            <input id="username" type="text" name="username" onkeyup="emptyUsernameError()" placeholder="Login">
                            <input id="password" type="password" name="password" onkeyup="emptyPasswordError()" placeholder="Hasło">
                            <button id="button" onclick="login()" type="submit" >Zaloguj</button>
                            <p id="errorUser" >Nieprawidłowe dane!</p>
                        </div>
                    </main>
                <footer class="column">
                    <div id="copyright">Wszystkie prawa zastrzeżone © AsArt 2019</div>
                </footer>
            </div>
        </div>
    </body>
</html>