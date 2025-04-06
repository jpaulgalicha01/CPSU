<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <title>Mukha Web App - Artist (<?= $_SESSION['title'] ?>)</title>
  <link rel="icon" type="image/png" href="../img/logo1.png" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/fontawesome-free-6.6.0-web/css/all.min.css" />

  <link rel="stylesheet" href="./css/calendar.css">
  <link rel="stylesheet" href="./css/custom-css.css">
  <script src="../assets/vendor/chart.js/apexChart.js"></script>
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/fontawesome-free-6.6.0-web/css/all.min.css" />
  <link rel="stylesheet" href="../assets/css/chat.css" />
  <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>

  <style>
    .responsive-rounded-image {
      width: 40px;
      /* Set your desired width */
      height: 40px;
      /* Set your desired height */
      border-radius: 50%;
      /* Makes the image circular */
      object-fit: cover;
      position: relative;
    }
  </style>
  <!-- Sweet Alet -->
  <script src="../assets/js/sweetAlert.js"></script>
  <script src="../assets/js/ajax.js"></script>
  <script>
    // converting formate date in to MM-DD-YYYY
    function convertDate(datestring) {
      const date = new Date(datestring);
      const formattedDate = new Intl.DateTimeFormat('en-US', {
        month: 'long',
        day: '2-digit',
        year: 'numeric'
      }).format(date);

      return formattedDate;
    }
    const convertTime = (time) => {
      let hour = (time.split(':'))[0]
      let min = (time.split(':'))[1]
      let part = hour > 12 ? 'pm' : 'am';

      min = (min + '').length == 1 ? `0${min}` : min;
      hour = hour > 12 ? hour - 12 : hour;
      hour = (hour + '').length == 1 ? `0${hour}` : hour;

      return (`${hour}:${min} ${part}`)
    }
  </script>

  <style>
    .custom-width-25 {
      width: 25%;
    }

    @media (max-width: 768px) {
      .custom-width-25 {
        width: 100%;
      }
    }
  </style>

<body class="bg-body-tertiary">

  <main>