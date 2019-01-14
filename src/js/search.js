$(document).ready(function () {
   $('.JS-search-trigger').on('click', function () {
       var input = $('#search-text').val().trim();
       $.post("backend/php/search.php", {input: input}, function(result){
           $('#main-content').html(result);
       });
   })
});