<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>

<!-- CSS en línea para asegurar que el fondo cubra toda la pantalla -->
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .site-index {
        background-image: url('https://static.vecteezy.com/system/resources/previews/006/204/627/large_2x/perfume-and-makeup-cosmetics-on-wooden-background-free-photo.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .jumbotron h1 {
    color: #7B4E12;
    font-style: italic;
    font-family: 'Georgia', serif;
    letter-spacing: -0.05em;
    text-shadow: 
        0 0 10px rgba(123,78,18,0.5),
        0 0 15px rgba(123, 78, 18, 0.5);
    }
    .jumbotron h2 {
    color: #B97527;
    text-shadow: 
        0 0 8px rgba(185,117,39,0.5);
        0 0 12px rgba(185, 117, 39, 0.43);
    }
    .jumbotron p {
    color: #3C2F1B;
     text-shadow: 
        0 0 4px rgba(60, 47, 27, 0.5),
        0 0 8px rgba(255, 255, 255, 0.84);
    }
</style>

<div class="site-index">
    <div class="jumbotron bg-transparent">
        <h2>Bienvenidos a</h2>
        <h1 class="display-4"><b>UniBelleza_Aditha</b></h1>
        <p class="lead">
            "UniBelleza_Aditha es tu espacio de belleza integral, donde encuentras 
            productos de cuidado facial, maquillaje y fragancias que realzan tu esencia única."
        </p>
    </div>
</div>

