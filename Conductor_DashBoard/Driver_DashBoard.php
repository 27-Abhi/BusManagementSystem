<?php
session_start();

if ($_SESSION['status'] != "Active") {
    header("location:../Login/dist/login.php");
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Driver Dashboard</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
        integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <style>
        html,
        body {
            min-height: 100%;
        }

        body,
        div,
        form,
        input,
        select,
        p {
            padding: 0;
            margin: 0;
            outline: none;
            font-family: Roboto, Arial, sans-serif;
            font-size: 16px;
            color: #eee;
        }

        body {
            background: url("https://ktclgoa.com/wp-content/uploads/2022/04/KTCL-Bus-1.jpeg") no-repeat center;
            background-size: cover;
        }

        h1,
        h2 {
            text-transform: uppercase;
            font-weight: 400;
        }

        h2 {
            margin: 0 0 0 8px;
        }

        .main-block {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            padding: 25px;
            background: rgba(0, 0, 0, 0.5);
        }

        .left-part,
        form {
            padding: 25px;
        }

        .left-part {
            text-align: center;
        }


        .btn-item,
        button {
            padding: 10px 5px;
            margin-top: 20px;
            border-radius: 5px;
            border: none;
            background: #26a9e0;
            text-decoration: none;
            font-size: 15px;
            font-weight: 400;
            color: #fff;
        }

        .btn-item {
            display: inline-block;
            margin: 20px 5px 0;
        }

        button {
            width: 100%;
        }

        button:hover,
        .btn-item:hover {
            background: #85d6de;
        }

        @media (min-width: 568px) {

            html,
            body {
                height: 100%;
            }

            .main-block {
                flex-direction: row;
                height: calc(100% - 50px);
            }

            .left-part,
            form {
                flex: 1;
                height: auto;
            }
        }
    </style>
</head>

<body>

    <div class="main-block">
        <div>
            <img src="https://cdn-icons-png.flaticon.com/512/2798/2798177.png">

            <h3>Driver ID:
                <?php echo $_SESSION['username'] ?>
            </h3>
            <h3>Bus Number: </h3>
            <a class="btn-item" type="" href="../Login/dist/logout.php">Log Out</a>

        </div>
        <div class=" left-part">

            <h1>Driver Dashboard</h1>

            <div class="btn-group">
                <a class="btn-item" href="driverDetails.php">Enter trip Details</a>
                <a class="btn-item" href="DriTripView.php">Assigned Trips</a>
                <!-- DISPLAYS ONLY THOSE TRIPS WHICH HE HAS BEEN ASSIGNED -->
            </div>
        </div>

    </div>
</body>

</html>