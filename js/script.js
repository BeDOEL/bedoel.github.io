$(document).ready(function () {

    // Menghilangkan Tombol cari
    $('#tombol-cari').hide();

    // event ketika keyword ditulis
    $('#keyword').on('keyup', function(){
        // Munculkan gambar loading
        $('.loader').show();

        // ajax Menggunakan load
        // $('#conte').load('ajax/games.php?keyword=' + $('#keyword').val());

        // $.get()
        $.get('ajax/games.php?keyword=' + $('#keyword').val(), function(data){
            $('#conte').html(data);
            $('.loader').hide();
        });
    });
    
});