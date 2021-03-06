<div id="markaekle">
    <table id="marka">
        <tr >
            <th>Markalar</th>
            <th>Duzenle</th>
            <th>Sil</th>
        </tr>
        <?php
        require_once "../baglan.php";
        $liste = $conn->query(" SELECT * FROM marka ", PDO::FETCH_ASSOC);
        foreach ($liste as $row) {

            echo "<tr>";
            echo "<td style=\"width:80%\">" . $row["markaadi"] . "</td>";
            echo "<td><a href="."duzenlemarka.php?id=".$row["idmarka"]." <button class=\"buttonduzenle\" >Duzenle</button></a></td>";

            echo "<td><a href="."silmarka.php?id=".$row["idmarka"]." <button onclick=\"return confirm('Silmek istiyor musun?'); \" class=\"buttonsil\" >Sil</button></a></td>";
            echo "<tr>";
        }
        ?>
    </table>
    <style><?php include('panelcss/markaekle.css'); ?></style>
    <div id="form"  >
        <h3>Eklemek İsteğiniz Marka</h3>

        <form method="post">
            <label for="markaadi">Marka Adı</label>
            <input type="text" id="markaadi" name="markaadi" placeholder="Marka Adı.." required>
            <input type="submit" value="Ekle" name="markaekle">
        </form>

        <?php

        if(isset($_POST["markaekle"])){
            require_once "../baglan.php";
            $markaadi=$_POST["markaadi"];
            $sql = "INSERT INTO marka (markaadi) VALUES (:markaadi)";
            $stmt=$conn->prepare($sql);
            $stmt->bindParam(':markaadi',$markaadi);
            $stmt->execute();
            if($stmt){
                $alert = "Marka Eklendi";
                echo "<script type='text/javascript'>alert('$alert');</script>";
                include "../yonlendirme.php";
                yonlendir("markaekle.php");
            }
            else{
                $alert = "Hata Olustu";
                echo "<script type='text/javascript'>alert('$alert');</script>";
            }
        }
        ?>

    </div>

</div>