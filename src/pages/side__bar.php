<style>
    *,
     :before,
     :after {
        box-sizing: border-box;
    }
    
    .unstyled {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .unstyled a {
        text-decoration: none;
    }
    
    .header {
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        width: 14%;
        background: linear-gradient(180deg, #49a09d, #5f2c82);
        height: 100%;
        box-shadow: 10px 0px 20px rgb(0 0 0 / 30%);
    }
    
    .logo {
        text-align: center;
        padding: 0;
        margin: 0;
        height: 18%;
    }
    
    .logo a {
        display: block;
        padding: 3% 0;
        color: #DFDBD9;
        text-decoration: none;
        transition: .15s linear color;
        height: 100%;
    }
    
    .logo a:hover {
        color: #fff;
    }
    
    .logo a:hover span {
        color: #DF4500;
    }
    
    .logo span {
        font-weight: 700;
        transition: .15s linear color;
    }
    
    #logo {
        height: 100%;
    }
    
    .main-nav {
        height: 100%;
    }
    
    .main-nav ul {
        border-top: solid 0.1vh #ffffff1a;
        height: 100%;
    }
    
    .main-nav li {
        border-bottom: solid 0.1vh #ffffff1a;
        height: 9%;
        font-size: 1.8vh;
    }
    
    .main-nav a {
        padding: 1.1em 0;
        color: #DFDBD9;
        font: 400 1.125em "Source Sans Pro", Helvetica, Arial, sans-serif;
        text-align: center;
    }
    
    .main-nav a:hover {
        color: #fff;
    }
    
    .list-hover-slide li {
        position: relative;
        overflow: hidden;
    }
    
    .list-hover-slide a {
        display: block;
        position: relative;
        z-index: 1;
        transition: .35s ease color;
    }
    
    .list-hover-slide a:before {
        content: '';
        display: block;
        z-index: -1;
        position: absolute;
        left: -100%;
        top: 0;
        width: 100%;
        height: 100%;
        border-right: solid 0.5vh #55608f;
        background: rgba(0, 0, 0, 0.4);
        transition: .35s ease left;
    }
    
    .list-hover-slide a.is-current:before,
    .list-hover-slide a:hover:before {
        left: 0;
    }
    
    .info__side_bar {
        color: #fff;
        font: 400 1.8vh "Source Sans Pro", Helvetica, Arial, sans-serif;
        padding: 0 0 0 5%;
        height: 12%;
        width: 100%;
    }
    
    li.logout {
        top: 55%;
    }
    
    body {
        background-image: url(../image/Hospital.jpg);
        background-size: cover;
    }
    
    .nav-wrap {
        height: 70%;
    }
    
    table.info__side_bar td {
        padding: 0;
    }
</style>
<script src="https://kit.fontawesome.com/04084ebb5c.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<header class="header" role="banner">
    <div class="logo">
        <a href="#">
            <img src="../image/logo.png" alt="logo" id="logo" style="border: 0;border-radius: 50%;">
        </a>
    </div>
    <table class="info__side_bar">
        <tr>
            <td><i class="fas fa-at"></i></td>
            <td>hospital@hospital.ma</td>
        </tr>
        <tr>
            <td><i class="fas fa-phone-alt"></i></td>
            <td>0555678943</td>
        </tr>
        <tr>
            <td><i class="fas fa-map-marker-alt"></i></td>
            <td>168 St. UpTown New York</td>
        </tr>
    </table>
    <div class="nav-wrap">
        <nav class="main-nav" role="navigation">
            <ul class="unstyled list-hover-slide">
                <li><a href="index.php">Patient</a></li>
                <li><a href="Etat.php">Etat de patient</a></li>
                <li><a href="facture.php">Facture</a></li>
                <li><a href="rendez_vous.php">Rendez vous</a></li>
                <?php 
                    if ($_SESSION['Admin'] == 1) {
                        echo '<li><a href="docteur.php">Docteur</a></li>';
                        echo '<li><a href="utilisateur.php">Utilisateur</a></li>';
                    }
                ?>
                
                <li class="logout" <?php if ($_SESSION['Admin'] == 1){ echo 'style="top:37%;"';}?> ><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
</header>