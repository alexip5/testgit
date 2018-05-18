<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("location: login.php");
    exit;
}asdsadasdasdasdasdsadasdasdadas
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHILRO</title>
    <link rel="stylesheet" href="css/2.css">

</head>
<body>


<div class="topnav" id="myTopnav">

    <a href="main.php">
        <submit>Cantarire</submit>
    </a>
    <a href="istoric.php">
        <submit>Istoric</submit>
    </a>

    <div class="logout">
        <a href="logout.php">Logout</a>
    </div>

</div>

<div class="cantarire-wrap">

    <form method="post">
        <div class="radiobtn">
            <label>Mod cantarire</label>
            <br>


            <input type="radio" name="tipCantarire" id="1" value="Dinamic" onclick="show1();"/>
            Dinamic

            <input type="radio" name="tipCantarire" id="2" value="Static" onclick="show2();"/>
            Static

        </div>


        <div id="div1" class="hide">
            <br>
            <label><u>Livrare</u></label>
            <br>

            <input type="radio" name="livrare" id="1" value="Expeditie"/> Expeditie

            <input type="radio" name="livrare" id="2" value="Livrare"/> Receptie

            <br>
            <br>
            <label><u>Cantarire</u></label>
            <br>
            <input type="radio" name="cantarire" id="1" value="Tara"/> Tara

            <input type="radio" name="cantarire" id="2" value="Brut"/> Brut

            <br>
            <br>
            <label><u>Nr. locomotiva</u></label>
            <br>
            <input type="radio" name="locomotiva" id="1" value="1"/>1

            <input type="radio" name="locomotiva" id="2" value="2"/> 2

            <br>
            <br>
            <label><u>Directie</u></label>
            <br>
            <input type="radio" name="directie" id="1" value="S -> D"/> S -> D

            <input type="radio" name="directie" id="2" value="D -> S"/>D -> S

            <br>
            <br>
            <label><u>Client</u></label>
            <input list="clientDinamic" name="clientDinamic" class="mytext"/>
            <datalist id="clientDinamic">
                <?php
                require_once 'config.php';

                $sql = "SELECT Client FROM Client";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['Client'] . '">';
                    }
                }
                ?>
            </datalist>
            <br>
            <label><u>Produs</u></label>
            <input list="produsDinamic" name="produsDinamic" class="mytext"/>
            <datalist id="produsDinamic">
                <?php

                require_once 'config.php';

                $sql = "SELECT Produs FROM Produs";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['Produs'] . '">';
                    }
                }
                ?>
            </datalist>
            <br>
            <br>
            <input id="start" type="submit" value="START">

        </div>

        <div id="div2" class="hide">
            <br>

            <label><u>Serie vagon</u></label>

            <input list="client" name="client" class="mytext"/>
            <br>
            <br>
            <label><u>Livrare</u></label>
            <br>

            <input type="radio" name="expeditie" value="igotnone"/> Expeditie

            <input type="radio" name="receptie" value="igotnon"/> Receptie
            <br>
            <br>
            <label><u>Cantarire</u></label>
            <br>
            <input type="radio" name="tara" value="igot"/> Tara

            <input type="radio" name="brut" value="igotn"/> Brut

            <br>
            <br>
            <label><u>Client</u></label>
            <input list="client" name="client" class="mytext"/>
            <br>
            <label><u>Produs</u></label>

            <input list="produs" name="produs" class="mytext"/>
            <br>
            <br>
            <br>
            <input id="start" type="submit" value="START">
        </div>

        <?php
        $tipCantarire = $_POST['tipCantarire'];
        $livrare = $_POST['livrare'];
        $cantarire = $_POST['cantarire'];
        $locomotiva = $_POST['locomotiva'];
        $directie = $_POST['directie'];
        $client = $_POST['clientDinamic'];
        $produs = $_POST['produsDinamic'];
        $dataCurenta = date("d-m-Y h:i:sa");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require_once 'config.php';
            if (isset($_POST['tipCantarire']) and ($tipCantarire != null)) {
                if (isset($_POST['livrare'])) {
                    if (isset($_POST['cantarire'])) {
                        if (isset($_POST['locomotiva'])) {
                            if (isset($_POST['directie'])) {
                                $sql = "SELECT Client FROM Client WHERE Client = '$client'";
                                $result = mysqli_query($conn, $sql);
                                if ( mysqli_num_rows ( $result ) ) {
                                } else {
                                    $sql = "INSERT INTO Client(Client) VALUES ('$client')";
                                    mysqli_query($conn, $sql);
                                }

                                $sql = "SELECT Produs FROM Produs WHERE Produs = '$produs'";
                                $result = mysqli_query($conn, $sql);
                                if ( mysqli_num_rows ( $result ) ) {
                                } else {
                                    $sql = "INSERT INTO Produs(Produs) VALUES ('$produs')";
                                    mysqli_query($conn, $sql);
                                }

                                $sql = "INSERT INTO Cantarire(ModCantarire, Livrare, Cantarire, NrLocomotiva, Directie, Client, Produs, Data) VALUES ('$tipCantarire', '$livrare', '$cantarire', '$locomotiva', '$directie', '$client', '$produs', '$dataCurenta')";
                                mysqli_query($conn, $sql);
                                mysqli_close($conn);
                            } else {
                                echo 'Selectati directia';
                            }
                        } else {
                            echo 'Selectati numarul de locomotive';
                        }
                    }else {
                        echo 'Selectati tipul de cantarire';
                    }
                }else {
                    echo 'Selectati livrarea';
                }
            }else {
                echo 'Selectati tipul de cantarire';
            }
        }
        ?>
        <script>
            function show1() {
                document.getElementById('div1').style.display = 'block';
                document.getElementById('div2').style.display = 'none';

            }

            function show2() {
                document.getElementById('div2').style.display = 'block';
                document.getElementById('div1').style.display = 'none';

            }
        </script>


    </form>
</body>
</html>
