<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gry komputerowe</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>

<header>
    <h1>Ranking gier komputerowych</h1>
</header>

<main>
    <section class="left-aside">
        <h3>Top 5 gier w tym miesiącu</h3>

        <ul>

            <?php
            $connection = new mysqli("localhost", "root", "", "gry");
            $sqlkw1 = "SELECT nazwa, punkty FROM gry ORDER BY punkty DESC LIMIT 5";
            $result1 = $connection->query($sqlkw1);

            while($row = $result1->fetch_assoc()) {
                echo "<li>" . $row['nazwa'] . " <span class='pkt'>" . $row['punkty'] . "</span></li>";
            }
            ?>
            
        </ul>

        <h3>Nasz sklep</h3>
        <a href="http://sklep.gry.pl">Tu kupisz gry</a>
        <h3>Stronę wykonał</h3>
        <p>000 (numer zdającego)</p>

    </section>




    <section class="middle">

        <?php
        $sqlkw2 = "SELECT id, nazwa, zdjecie FROM gry";
        $result2 = $connection->query($sqlkw2);

        while($row = $result2->fetch_assoc()) {
            echo "<div class='gra'>";
            echo "<img src='" . $row['zdjecie'] . "' alt='" . $row['nazwa'] . "' title='" . $row['id'] . "'>";
            echo "<p>" . $row['nazwa'] . "</p>";
            echo "</div>";
        }
        ?>

    </section>

    <section class="right-aside">

        <h3>Dodaj nową grę</h3>
        <form method="POST">
            <label>Nazwa:</label><br>
            <input type="text" name="nazwa"><br>
            <label>Opis:</label><br>
            <input type="text" name="opis"><br>
            <label>Cena:</label><br>
            <input type="text" name="cena"><br>
            <label>Zdjęcie:</label><br>
            <input type="text" name="zdjecie"><br>
            <input type="submit" value="DODAJ">
        </form>


        <?php
      
        if(!empty($_POST['nazwa'])) {
            $nazwa = $_POST['nazwa'];
            $opis = $_POST['opis'];
            $cena = $_POST['cena'];
            $zdjecie = $_POST['zdjecie'];

            $sqlkw3 = "INSERT INTO gry (nazwa, opis, cena, zdjecie, punkty) VALUES ('$nazwa', '$opis', '$cena', '$zdjecie', 0)";
            $connection->query($sqlkw3);
        }
        ?>

    </section>
</main>



<footer>

    <form method="POST">
        <input type="text" name="id">
        <input type="submit" value="Pokaż opis">
    </form>

    <?php
  
        if(!empty($_POST['id'])) {
            $id = $_POST['id'];
            $sqlkw4 = "SELECT nazwa, opis, cena, punkty FROM gry WHERE id = $id";
            $result4 = $connection->query($sqlkw4);

            if($row = $result4->fetch_assoc()) {
                echo "<h2>" . $row['nazwa'] . ", " . $row['punkty'] . " punktów, " . $row['cena'] . " zł</h2>";
                echo "<p>" . $row['opis'] . "</p>";
            }
        }

    $connection->close();
    ?>


</footer>
</body>
</html>