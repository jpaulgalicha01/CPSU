<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Mukha</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/fontawesome-free-6.6.0-web/css/all.min.css" />
    <link rel="stylesheet" href="./assets/css/chat.css" />

    
    <!-- default styles -->
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/css/star-rating.min.css" media="all"
        rel="stylesheet" type="text/css" />

    <!-- with v4.1.0 Krajee SVG theme is used as default (and must be loaded as below) - include any of the other theme CSS files as mentioned below (and change the theme property of the plugin) -->
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.css"
        media="all" rel="stylesheet" type="text/css" />

    <!-- important mandatory libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/star-rating.min.js"
        type="text/javascript" defer></script>

    <!-- with v4.1.0 Krajee SVG theme is used as default (and must be loaded as below) - include any of the other theme JS files as mentioned below (and change the theme property of the plugin) -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.js"
        defer></script>

    <!-- optionally if you need translation for your language then include locale file as mentioned below (replace LANG.js with your own locale file) -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/locales/LANG.js" defer></script>

    <style>
        #loginWrapper {
        overflow-x: hidden;
          background-image: linear-gradient(
            to right,
            #D1D1E9,
            #c2f5de,
            #cbf7e4,
            #d4f8ea,
            #ddfaef
          );
        }
        header.sticky {
          background-color : transparent;
          width: 100%;
          z-index: 2;
          transition: background-color .3s ease-in-out

        }

        header.scrolled{
          position: fixed;
          background-color : white;
          animation: bounceDrop 0.7s ease-in-out;
        }
        .header-title {
            font-family: "Noto Sans TC", sans-serif;
            font-optical-sizing: auto;
            font-weight: 900;
            font-style: normal;
            color: #2B2C34;
        }

        .img-prof {
          height: 300px;
          overflow:hidden;
          z-index: -99999;
        }

        .hover-box {
          box-shadow: inset 0 0 0 0 gray;
          background-color: white;
          position: relative;
          overflow: hidden;
          transition: color .5s ease-in-out, box-shadow .5s ease-in-out;
          z-index: 1;
        }

        .hover-text {
          display: none;
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          color: white;
          font-size: 18px;
          text-align: center;
          opacity: 0;
          transition: color .5s ease-in-out, box-shadow .5s ease-in-out;
        }
        .hover-box:hover {
            box-shadow: inset 100vw 0 0 0 gray;
        }
        .hover-box:hover .hover-text {
          display: block;
          opacity: 1; 
        }

            /* Keyframes for the bounce drop effect */
        @keyframes bounceDrop {
          0% {
            top: -100px; /* Start off-screen */
          }
          60% {
            top: 0px; /* Bounce slightly below its final position */
          }
          80% {
            top: -1px; /* Bounce slightly above its final position */
          }
          100% {
            top: 0; /* Settle into the final position */
          }
        }
    </style>

    <!-- Sweet Alet -->
    <script src="./assets/js/sweetAlert.js"></script>
    <script src="./assets/js/ajax.js"></script>

  <body class="bg-body-tertiary">

<main>