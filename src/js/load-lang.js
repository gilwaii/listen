$(document).ready(function () {
    $('#lang-en').click(function () {
        $.post("backend/php/language.php", {lang: 'en'}, function(result){
            $('#main-content').html(result);
            location.reload();
        });
    });
    $('#lang-fr').click(function () {
        $.post("backend/php/language.php", {lang:'fr'}, function(result){
            $('#main-content').html(result);
            location.reload();
        });
    });
});