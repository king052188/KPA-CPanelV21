<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>FBI - Account Transaction History</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/1.5.6/numeral.min.js"></script>
    <link rel="stylesheet" href="css/style.kpa.css">
    <!--[if !IE]><!-->
    <style>
        /*
        Max width before this PARTICULAR table gets nasty
        This query will take effect for any screen smaller than 760px
        and also iPads specifically.
        */
        @media
        only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px)  {

            /* Force table to not be like tables anymore */
            table, thead, tbody, th, td, tr {
                display: block;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr { border: 1px solid #ccc; }

            td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
                text-align: right;
            }

            td:before {
                /* Now like a table header */
                position: absolute;
                /* Top/left values mimic padding */
                top: 6px;
                left: 6px;
                width: 30%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: right;
                font-weight: 600;
            }

            /*
            Label the data
            */
            td:nth-of-type(1):before { content: "#"; }
            td:nth-of-type(2):before { content: "URL"; }
            td:nth-of-type(3):before { content: "Hash"; }
            td:nth-of-type(4):before { content: "Username"; }
            td:nth-of-type(5):before { content: "Name"; }
            td:nth-of-type(6):before { content: "Email"; }
            td:nth-of-type(7):before { content: "Mobile"; }
            td:nth-of-type(8):before { content: "Created"; }
            td:nth-of-type(9):before { content: "Downline"; }

            /*tr:last-child td:nth-of-type(1):before { content: ""; }*/
            /*tr:last-child td:nth-of-type(2):before { content: "Debit"; }*/
            /*tr:last-child td:nth-of-type(3):before { content: "Credit"; }*/
            /*tr:last-child td:nth-of-type(4):before { content: ""; }*/
            /*tr:last-child td:nth-of-type(5):before { content: ""; }*/
            /*tr:last-child td:nth-of-type(6):before { content: ""; }*/
            /*tr:last-child td:nth-of-type(7):before { content: ""; }*/
        }

        /* Smartphones (portrait and landscape) ----------- */
        @media only screen
        and (min-device-width : 320px)
        and (max-device-width : 480px) {
            body {
                padding: 0;
                margin: 0;
                width: 100%; }
        }

        /* iPads (portrait and landscape) ----------- */
        @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
            body {
                width: 1015px;
            }
        }
    </style>
    <!--<![endif]-->

    <script type="text/javascript" src="js/jquery_3.kpa.js"></script>
</head>
<body>
<div id="page-wrap">
    <h1>All Accounts</h1>
    <p>
        Enter your name:
        <input type="text" name="txtName" id="txtName" placeholder="Enter your name here..." />&nbsp;
        <button id="btnSearch"> Go </button>
    </p>
    <table id="transaction_table">
        <thead>
        <tr>
            <th>#</th>
            <th style="width: 100px;">URL</th>
            <th style="width: 110px;">Hash</th>
            <th style="width: 130px;">Username</th>
            <th>Name</th>
            <th style="width: 180px;">Email</th>
            <th style="width: 150px;">Mobile</th>
            <th style="width: 200px;">Created</th>
            <th style="width: 100px;">Downline</th>
        </tr>
        </thead>
        <tbody> </tbody>
    </table>
</div>
</body>
</html>