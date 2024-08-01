<?php
require 'function.php';

session_start();

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poetsen+One&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poetsen+One&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <title>Sehat aja</title>
    <style>
    /* CSS */
    * {
        padding: 0;
        margin: 0;
    }

    body {
        margin: 0px;
        padding: 0px;
        font-family: 'Open Sans', sans-serif;
        width: 100%;
    }

    .wrapper {
        width: 75%;
        margin: auto;
        position: relative;
    }

    .logo2 a {
    font-family: "Montserrat", sans-serif;
    font-size: 30px;
    font-weight: 700;
    float: left;
    color:#002D73;
    text-decoration:none;
    margin-left: -30px;
}
.logo img {
  width: 50px;
  float: left;
  margin-left: -100px;
  margin-top: 15px
}

    .menu {
        float: right;
    }

    nav {
        width: 100%;
        margin: auto;
        display: flex;
        line-height: 80px;
        position: sticky;
        position: -webkit-sticky;
        top: 0;
        background: #AED6F1;
        z-index: 1000;
    }

    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    nav ul li {
        float: left;
    }

    nav ul li a {
        color: #211C6A;
        font-weight: bold;
        text-align: center;
        padding: 0px 16px 0px 16px;
        text-decoration: none;
    }

    nav ul li a:hover {
        text-decoration: underline;
    }

    section {
        margin: auto;
        display: flex;
        margin-bottom: 50px;
    }

    .text-box {
        margin-top: 50px;
        margin-bottom: 50px;
    }

    .text-box .deskripsi {
        font-size: 25px;
        font-weight: bold;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #352F44;
        margin-top: 60px;
    }

    .text-box h2 {
        color: black;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        text-align: center;
    }

    .text-box h1 {
        font-family: 'Times New Roman', Times, serif;
        color: black;
        margin-top: 58px;
    }

    a.tbl-biru {
        background: #092635;
        border-radius: 20px;
        margin-top: 20px;
        padding: 15px 20px 15px 20px;
        color: #ffffff;
        cursor: pointer;
        font-weight: bold;
        margin-right: 10px;
    }

    a.tbl-biru:hover {
        background: #6AD4DD;
        text-decoration: none;
        transition: ease-in;
        -webkit-transition: .3s linear;
        -moz-transition: .3s linear;
        -ms-transition: .3s linear;
        -o-transition: .3s linear;
        transition: .3s linear;
    }

    a.tbl-birubiru {
        width: 100px;
        height: 90px;
        text-decoration: none;
        background: #0174BE;
        border-radius: 10px;
        margin-top: 20px;
        padding: 15px 20px 15px 20px;
        color: #ffffff;
        cursor: pointer;
        font-weight: bold;
    }

    a.tbl-birubiru:hover {
        background: #AEDEFC;
        transition: ease-in;
        text-decoration: none;
    }

    p {
        margin: 10px 0px 10px 0px;
        padding: 10px 0px 10px 0px;
        color: black;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .tengah {
        text-align: center;
        width: 100%;
    }

    .tutor-list {
        width: 100%;
        position: relative;
        display: flex;
        flex-direction: row;
    }

    .kartu-tutor {
        width: 20%;
        margin: 0 auto;
    }

    .kartu-tutor img {
        width: 80%;
        border-radius: 50%;
        border: 1px solid #ddd;
        padding: 5px;
    }

    .text-box h2 {
        text-align: center;
    }

    .list {
        position: relative;
        z-index: 1;
        margin-top: 30px;
    }

    .list ul li {
        display: inline-block;
        margin-left: 30px;
        margin-top: 15px;
    }

    .grid {
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
        width: 200px;
        height: 150px;
        background: #fff;
        border-radius: 3px;
        margin-right: 20px;
        margin-bottom: 20px;
        margin-left: 190px;
        box-shadow: 0 0px 10px rgba(71, 71, 71, .2);
        transition: .3s linear;
    }

    .grid h5 {
        margin: 13px 0;
        margin-top: 20px;
        margin-right: 10px;
        text-decoration: none;
        margin-bottom: 20px;
        font-size: 12px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: black;
    }

    .grid:last-child {
        margin-right: 30px;
    }

    .grid:hover {
        color: #fff;
        background: #5356FF;
        box-shadow: 0 5px 10px rgba(71, 71, 71, .4);
    }

    .grid img {
        width: 30%;
        padding: auto;
        margin-right: 20px;
    }

    .grid a {
        margin-left: 60px;
        margin-right: 50px;
        position: relative;
    }

    .content {
        text-align: center;
    }

    .content p {
        text-align: center;
        margin-bottom: 20px;
    }

    .content h5 {
        text-align: center;
        font-size: 15px;
        margin-top: 10px;
    }

    .gambar {
        margin-bottom: 20px;
    }

    .grid p {
        font-size: 5px;
        margin-left: 135px;
    }

    .grid:hover {
        color: #fff;
        background: #5356FF;
        box-shadow: 0 5px 10px rgba(71, 71, 71, .4);
    }

    .grid a {
        margin-bottom: 30px;
    }

    .welcome {
        display: block;
        position: relative;
    }

    .teks {
        margin-top: 60px;
    }

    .teks h2 {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin-top: 30px;
        text-align: center;
    }

    .teks p {
        font-weight: normal;
        margin-top: 20px;
        font-size: 17px;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serifs;
        text-align: center;
    }

    .layanan {
        display: block;
        z-index: 1;
        margin-top: 80px;
        position: relative;
        margin-left: 250px;
    }

    .layanan ul li {
        display: inline-block;
        margin-left: 30px;
        margin-top: 15px;
    }

    .service {
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
        width: 200px;
        height: 190px;
        background: #fff;
        border-radius: 3px;
        margin-right: 20px;
        margin-bottom: 20px;
        margin-top: 100px;
        box-shadow: 0 0px 10px rgba(71, 71, 71, .2);
        transition: .3s linear;
    }

    .service h5>a {
        margin: 13px 0;
        text-decoration: none;
        margin-bottom: 20px;
        font-size: 12px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: black;
    }

    .service:last-child {
        margin-right: 30px;
    }

    .service:hover {
        color: #fff;
        background: #5356FF;
        box-shadow: 0 5px 10px rgba(71, 71, 71, .4);
    }

    .service img {
        width: 85%;
        padding: auto;
        margin-right: 30px;
    }

    .service a {
        margin-left: 60px;
        margin-right: 50px;
        position: relative;
    }

    .home {
        display: flex;
        position: relative;
    }

    .content {
        overflow: auto;
    }

    .content h1 {
        margin-top: 90px;
        font-size: 45px;
        font-family: "Montserrat", sans-serif;
        font-weight: 1000;
        font-style: normal;
        color: #005EB2;
        text-align: justify;
        margin-left: 18px;
    }

    .content h5 {
        margin-left: 40px;
        margin-top: 40px;
        font-size: 30px;
        font-family: "Montserrat", sans-serif;
        font-weight: 800;
        margin-left: 20px;
        font-style: normal;
        color: #5DBEFF;
        text-align: left;
    }

    .content p {
        text-align: justify;
        font-size: 19px;
        font-family: "Montserrat", sans-serif;
        font-weight: 500;
        font-style: normal;
        margin-top: 40px;
        margin-left: -1px;
        margin-left: 30px;
        color: #8DC9FF;
    }

    .gambar {
        float: right;
        margin-right: 5px;
        width: 50%;
    }

    .u {
        margin-top: 90px;
    }

    .tes h2 {
        text-align: center;
        margin-top: 100px;
    }

    .tes p {
        text-align: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .halo {
        font-weight: bold;
        float: right;
        margin-left: 20px;
        font-family: "Montserrat", sans-serif;
    }

        .footer-container {
            display: flex;
            justify-content: space-between;
            background-color: #fff;
            color: #ffffff;
            padding: 40px 20px;
            flex-wrap: wrap;
            box-shadow: 0 0px 10px rgba(71, 71, 71, .2);
        }

        .footer-section {
            flex: 1;
            margin: 0 20px;
        }

        .footer-section h2 {
            margin-bottom: 20px;
            border-bottom: 2px solid #ffffff;
            padding-bottom: 10px;
            font-family: "Montserrat", sans-serif;
            font-weight: 700;
            color: #1C315E;
        }

        .footer-section a {
            font-family: "Montserrat", sans-serif;
            font-weight: 600;
            text-decoration: none;
            color: #1C315E;
        }
        .footer-section p{
            font-family: "Montserrat", sans-serif;
            font-weight: 600;
            text-decoration: none;
            color: #1C315E;
        }

        .footer-section a:hover {
            color: #ddd;
        }

        .socials {
            margin-top: 20px;
        }

        .socials a {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            margin-right: 10px;
            text-align: center;
            border-radius: 50%;
            background-color: #ffffff;
            
        }

        .socials img {
            width: 24px;
            height: 24px;
            margin: 8px;
        }

        .socials a:hover img {
            filter: invert(1);
        }

        .footer-bottom {
            background-color: #ffff;
            color: #211C6A;
            text-align: center;
            padding: 20px;
            border-top: 1px solid #ffffff;
            font-family: "Montserrat", sans-serif;
            font-weight: 700;
            box-shadow: 0 0px 10px rgba(71, 71, 71, .2);
        }

    </style>
</head>
<body>
    <nav>
        <div class="wrapper">
        <div class="logo">
            <img src="logo.png">
            </div>
            <div class="logo2">
            <a href=''>Sehat aja</a>
      </div>
                <div class="menu">
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#courses">Courses</a></li>
                        <li><a href="#example">Example</a></li>
                        <li><a href="buy.php">Order</a></li>
                        
                       <?php
                        echo '<div class="halo">' . "Halo,". $_SESSION['username'] .'</div>';
                        ?>
                        <li><a href="logout.php" class="tbl-biru">Logut</a></li>
                        
                        
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

<div class="home">
<div class="content">
    <img src="home.jpg" alt="Gambar" class="gambar">
    <h1>Welcome in Sehat Aja!</h1>
    <h5>Temukan berbagai kebutuhan obat anda cuma di sehat aja</h5>
    <p class="teks">Kenapa harus sehat aja? Karena kami menyediakan layanan pembelian obat secara mudah, aman, nyaman, dan murah, Jaminan barang original
        100% Segera order dengan klik tombol dibawah ini 
    </p>
    <div class='u'>
    <a href="buy.php" class="tbl-birubiru">YUK ORDER SEKARANG!</a> 
    </div>
</div>
</div>
			
<section id="courses" class="courses">
<div class="layanan">
    <div class="tes">
    <h2>Layanan tambahan untuk anda</h2>
   <p>Beberapa tes yang bisa anda coba</p>
   </div>
    <ul>
        <li>
							<div class="service">
                                <a href="https://campus.quipper.com/aptitude_test">
                                <img src="study.png" alt="" srcset="">
                                </a>
								<h5><a href="https://campus.quipper.com/aptitude_test">Tes minat dan bakat</a></h5>

							</div>
                            </li>

                            <li>
							<div class="service">
                                <a href="https://akupintar.id/tes-kepribadian">
                                <img src="belajar.png" alt="" srcset="">
                                </a>
								<h5><a href="https://akupintar.id/tes-kepribadian">Tes kepribadian</a></h5>

							</div>

                            </li>

                            <li>
							<div class="service">
                               <a href="https://www.16personalities.com/id/tes-kepribadian">
                                <img src="study.png"></a> 
								<h5><a href="https://www.16personalities.com/id/tes-kepribadian">Tes MBTI</a></h5>

							</div>
                            </li>
                            <li>
							<div class="service">
                               <a href="https://akupintar.id/tes-kemampuan"><img src="belajar.png"></a> 
								<h5><a href="https://akupintar.id/tes-kemampuan">Tes Kecerdasan Majemuk</a></h5>

							</div>
                            </li>
                            
                            <br>

                            <li>
							<div class="service">
                               <a href="https://akupintar.id/tes-gaya-belajar"><img src="study.png"></a> 
								<h5><a href="https://akupintar.id/tes-gaya-belajar">Tes gaya belajar</a></h5>

							</div>
                            </li>
                            <li>
							<div class="service">
                               <a href="https://www.halodoc.com/depression-test/score"><img src="belajar.png"></a> 
								<h5><a href="https://www.halodoc.com/depression-test/score">Tes Depresi</a></h5>

							</div>
                            </li>
                            <li>
							<div class="service">
                               <a href="https://www.riddle.com/view/250671"><img src="study.png"></a> 
								<h5><a href="https://www.riddle.com/view/250671">Tes Kecerdasan Emosi</a></h5>

							</div>
                            </li>
                            <li>
							<div class="service">
                               <a href="https://www.halodoc.com/anxiety-test/"><img src="belajar.png"></a> 
								<h5><a href="https://www.halodoc.com/anxiety-test/">Tes anxiety</a></h5>

							</div>
                            </li>
                            </ul>
                           
                      
</div>
</section>


<section id="example">
            <div class="tengah">
                <div class="text-box">
                    <p class="deskripsi">Contoh kegiatan untuk menjaga kesehatan</p>
                    <p>Beberapa contoh kegiatan yang bisa anda lakukan</p>
                </div>

                <div class="tutor-list">
                      <div class="kartu-tutor">
                        <img src="https://img.freepik.com/free-photo/flat-lay-batch-cooking-composition_23-2148765597.jpg?w=1060&t=st=1693324640~exp=1693325240~hmac=041f04aba07ce6847681d0f4a0dae5debd517761d72388e62abc465efec91911"/>
                        <p>Makan yang cukup dan bergizi</p>
                      </div>

                      <div class="kartu-tutor">
                        <img src="https://img.freepik.com/free-vector/sleep-analysis-concept-illustration_114360-6818.jpg?size=626&ext=jpg&uid=R125519887&ga=GA1.1.300703531.1693283522&semt=sph"/>
                      <p> Istirahat cukup </p>
                    </div>


                      <div class="kartu-tutor">
                        <img src="https://img.freepik.com/free-photo/sports-tools_53876-138077.jpg?size=626&ext=jpg&uid=R125519887&ga=GA1.1.300703531.1693283522&semt=sph"/>
                    <p>Olahraga</p>
                    </div>


                      <div class="kartu-tutor">
                        <img src="https://img.freepik.com/free-vector/person-keeping-social-distance-avoiding-contact-woman-separating-from-crowd-meditating-transparent-bubble_74855-11009.jpg?size=626&ext=jpg&uid=R125519887&ga=GA1.1.300703531.1693283522&semt=sph"/>
                      <p>Bermeditasi untuk menenangkan pikiran</p>
                    </div>

                    <div class="kartu-tutor">
                        <img src="https://img.freepik.com/free-vector/public-approval-concept-illustration_52683-32169.jpg?size=626&ext=jpg&uid=R125519887&ga=GA1.1.300703531.1693283522&semt=ais"/>
                      <p>Bersikap positif</p>
                    </div>
            </div>
        </section>

<br>
<br>
<br>
<div class="welcome">
        <div class="teks">
    <h2>Kenapa harus sehat aja </h2>
    <p> 3 Alasan Kenapa  Harus Pilih Sehat Aja! </p>
        <section id="partner" class="partner">
        <div class="list">
					<ul>
						<li>

							<div class="grid">
                                <img src="positive-feedback.png" alt="" srcset="">
                                </a>
								<h5>Mudah digunakan</h5>
							</div>
						</li>
						<li>

							<div class="grid">
                                <img src="rating-assessment.png" alt="" srcset="">
                                </a>
								<h5>Rating Terbaik</h5>

							</div>
						</li>
						<li>

							<div class="grid">
                               <img src="pay.png">
								<h5>Harga Terbaik</h5>

							</div>
						</li>

                        </ul>
</section>
                      
</div>
</div>


<footer class="bg">

<div class="footer-container">
            <div class="footer-section about">
                <h2>Tentang Kami</h2>
                <p>Kami adalah perusahaan yang berfokus pada menyediakan solusi terbaik untuk menyediakan obat obatan untuk anda, dengan kualitas terbaik namun dengan harga terjangkau</p>
                <div class="socials">
                    <a href="https://www.instagram.com/argaakbr/"><img src="instagram.png"></a>
                    <a href="https://github.com/arga1212"><img src="github.png"></a>
                </div>
            </div>
            <div class="footer-section links">
                <h2>Tautan</h2>
                <ul>
                    <li><a href="#home">Beranda</a></li>
                    <li><a href="biodata.php">Tentang Kami</a></li>
                    <li><a href="#courses">Layanan</a></li>
                    <li><a href="#example">Example</a></li>
                </ul>
            </div>
            <div class="footer-section contact">
                <h2>Kontak Kami</h2>
                <p><i class="fas fa-envelope"></i> arga.fikri1202@gmail.com</p>
                <p><i class="fas fa-phone"></i> +6281182131</p>
                <p><i class="fas fa-map-marker-alt"></i> SMK Telkom Sidoarjo</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Contoh Website. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>