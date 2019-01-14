function playStart() {
    var a = $("#sentences_no :selected").text();
    $('#controlPlay').css('display','none');

    var start = $('#track-' +parseInt(a) + ' div:first').text();
    var end = $('#track-' +parseInt(a) + ' div:eq(1)').text();

    play(start,end);
}

function play(start , end) {
    var a = document.querySelector('audio');
    var start = parseInt(start);
    var end = parseInt(end);
    if ( start >=0 && end >=0 ) {
        a.currentTime = start;
        end = end;
        a.play();
    }

    a.addEventListener('timeupdate', function(ev) {
        if (a.currentTime > end) { a.pause(); }
    },false);
}