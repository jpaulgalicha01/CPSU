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
          position: sticky;
          top: 0;
          background-color: white;
          z-index: 2;
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
    </style>

    <!-- Sweet Alet -->
    <script src="./assets/js/sweetAlert.js"></script>
    <script src="./assets/js/ajax.js"></script>

  <body>

<main>