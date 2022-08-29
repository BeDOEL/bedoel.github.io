<?php 
    require '../functions.php';
    $keyword = $_GET["keyword"];

    $query = "SELECT * FROM lbl_data
                WHERE
                nama_game LIKE '%$keyword%' OR
                judul LIKE '%$keyword%' OR
                nama LIKE '%$keyword%'
                ";
    $games = query($query);

?>
<?php $i = 1 ?>
<?php foreach($games as $game) : ?>
<div class="sub-content cf">
    <ul>
        <div class="sub-content-judul">
            <nav class="nav-edithapus cf">
                    <a href="edit.php?id=<?= $game["id"] ; ?>" class="linked">edit</a>
                    <a href="hapus.php?id=<?= $game["id"] ; ?>" onclick="
                            return confirm('Apakah Anda yakin ingin menghapus?')" class="linked">hapus</a>
            </nav>
            <div class="bar-judul">
                <h2 class="sub-judul"><?= $game["judul"] ; ?></h2>
            </div>
        </div>
        <div class="sub-content-content">
            <video src="vid/<?= $game["nama_vid"] ; ?>" width="300" class="video" controls></video>
            <li class="huruf"><span class="space"> Nickname </span> : <?= $game["nama"] ; ?></li>
            <li class="huruf"><span class="space"> Tanggal </span> : <?= $game["tanggal"] ; ?></li>
        </div>
    </ul>
</div>
<?php $i++; ?>
<?php endforeach; ?>