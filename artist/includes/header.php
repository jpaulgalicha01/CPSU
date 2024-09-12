<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="../img/logo1.png" />
    <title>Mukha Web App - Artist (<?= $_SESSION['title'] ?>)</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../assets/css/chat.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/index.css">
    
    <script src="../assets/vendor/chart.js/apexChart.js"></script>

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
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">