function changeInput() {
    var number = $('#insert_rows').val();
    $('#number-track li').remove();
    if (number > 1 && number < 20) {
        $('#number-track').html('');
        for (var i = 0; i < number-1; i++) {
            var t = i+2;
            $('#number-track').append(' <li id="track-'+t+'">\n' +
                '                                                track-'+t+'<br>\n' +
                '                                                <input type="number" name="duration_'+t+'" id="duration" min="1"\n' +
                '                                                       placeholder="Duration">\n' +
                '                                                <input type="number" name="start_'+t+'" id="start" min="1" placeholder="Start">\n' +
                '                                                <input type="number" name="end_'+t+'" id="end" min="1" placeholder="End">\n' +
                '<br>Lyrics:<br> <textarea cols="48" name="lyrics_'+t+'"rows="3"></textarea> \n' +
                '                                            </li>')
        }
    }
}