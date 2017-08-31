
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Traffic Logger - kpa.ph</title>
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Semi+Condensed:300,400,500,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="http://cpanel.scrapcatapp.com/css/sweetalert.css">
    <style>
        body {
            /* font-family: 'Comfortaa', cursive; */
            font-family: 'Encode Sans Semi Condensed', sans-serif;
            line-height: 1.25;
            background-color:#fafafa;
            padding: 20px;
        }

        p { margin: 0; padding: 0; }
        #_traffic, #_uni_traffic { font-weight: 600; letter-spacing: .1em; }

        table {
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        table tr {
            background: #f8f8f8;
            border: 1px solid #ddd;
            padding: .35em;
        }

        table tr:hover {
            background: #ffffff;
        }

        table th, table td {
            padding: .625em;
            text-align: center;
        }

        table th {
            font-size: .85em;
            letter-spacing: .05em;
            text-transform: capitalize;
            font-weight: 700;
        }

        input { width: 90px; }
        input, button { padding: 3px; }

        @media screen and (max-width: 600px) {

            body {
                padding: 0;
            }

            table { border: 0; }

            table thead { display: none; }

            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .625em;
            }

            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: .8em;
                text-align: right;
                letter-spacing: .1em;
            }

            table td:before {
                content: attr(data-label);
                float: left;
                font-weight: 700;
                text-transform: capitalize;
            }

            table td:last-child { border-bottom: 0; }
        }
    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/numeral.js/1.4.5/numeral.min.js"></script>
    <script src="http://cpanel.scrapcatapp.com/js/sweetalert.min.js"></script>

    <!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
</head>
<body>

<h2 style="text-align: center;">www.{{ $site["name"] }}</h2>

<h3 style="text-align: center; margin-top: -10px;">Visitors Traffic Table</h3>

<div style="width: 100%;">
<div style="right: 0; position: absolute; margin: -110px 30px 0 0;">
    <p style="margin-top: 20px; text-align: right;"><span id="_traffic">0</span> Total Traffic</p>
    <p style="margin-top: 5px; text-align: right;"><span id="_uni_traffic">0</span> Total Unique IP Address</p>
    <p style="margin-top: 10px;">
        Set Date:
        <input type="text" id="datepicker" placeholder="Pick a date" />
        <button id="btnGo">GO</button>
    </p>
</div>
<div>

<table id="traffic_tbl" style="margin-top: 100px;">
    <thead>
    <tr>
        <th scope="col">Client IP</th>
        <th scope="col">Server IP</th>
        <th scope="col">Port</th>
        <th scope="col">Url Path</th>
        <th scope="col">Method</th>
        <th scope="col">Time (ms)</th>
        <th scope="col">Status</th>
        <th scope="col">Date</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script>
    var host_ = "{{ $site["name"] }}";
    var date_ = "{{ $site["date"] }}";

    $(document).ready( function() {
        swal({
            title: "Good Day!!!",
            text: "You will see the current date of visitors traffic table.",
            type: "success",
            confirmButtonColor: "#337ab7",
            confirmButtonText: "Ok, Let me in.",
        },
        function(){
            load_(host_, date_);
            swal(
                    'Fetching!',
                    'Your date is being updated...',
                    'success'
            );
        });
        $( "#datepicker" ).datepicker();
        $( "#datepicker" ).datepicker( "option", "dateFormat", "ymmdd");
        $( "#btnGo" ).click(function() {
            date_ = $( "#datepicker" ).val();
            load_(host_, date_);
        })
    } );

    function load_(host, date) {
        var data         = { host: host, date: date };
        var visitors     = [];

        $(document).ready( function() {
            $.ajax({
                type:'POST',
                url: "http://cpanel.scrapcatapp.com/api/web/site/traffic",
                dataType: "json",
                data: data,
                beforeSend: function () {
                    var html = "";
                    html += "<tr>";
                    html += "<td colspan='8' style='text-align: center;'>fetching...</td>";
                    html += "</tr>";
                    $("#traffic_tbl > tbody").empty().prepend(html);
                    $("#_traffic").text("***");
                    $("#_uni_traffic").text("***");
                    $("#btnGo").text("Please wait...");
                },
                success: function(json) {
                    var html = "";
                    console.log(json);

                    if(parseInt(json.Code) == 404) {
                        html += "<tr>";
                        html += "<td colspan='8'>No log file found.</td>";
                        html += "</tr>";
                    }
                    else {
                        $(json.Visitors).each(function(k, v) {
                            visitors.push(v.Client_IP);
                            html += "<tr>";
                            html += "<td scope='row' data-label='CLIENT IP'>"+v.Client_IP+"</td>";
                            html += "<td scope='row' data-label='SERVER IP'>"+v.Server_IP+"</td>";
                            html += "<td scope='row' data-label='PORT'>"+v.Port+"</td>";
                            html += "<td scope='row' data-label='URL PATH' style='text-align: left;'>"+v.Url_Path+"</td>";
                            html += "<td scope='row' data-label='METHOD'>"+v.Method+"</td>";
                            html += "<td scope='row' data-label='TIME (ms)'>"+v.Time+"</td>";
                            html += "<td scope='row' data-label='STATUS'>"+v.Status+"</td>";
                            html += "<td scope='row' data-label='DATE'>"+v.Created_At+"</td>";
                            html += "</tr>";
                        })
                    }

                    $("#traffic_tbl > tbody").empty().prepend(html);
                    var uniqueVisitor = Array.from(new Set(visitors));
                    $("#_traffic").text(numeral( visitors.length ).format('0,0'));
                    $("#_uni_traffic").text(numeral( uniqueVisitor.length ).format('0,0'));
                    $("#btnGo").text("GO");
                }
            });
        } )
    }
</script>

</body>

</html>
