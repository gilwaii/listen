// window.onhashchange = function() {
//     if (window.innerDocClick) {
//         //Your own in-page mechanism triggered the hash change
//         alert("fuck you onhashchange");
//     } else {
//         //Browser back button was clicked
//         alert("lozz");
//     }
// };
var fullMode = 0;
var quickMode = 0;
var blankMode = 0;
var newMode = 0;

var summarit = ['j\'u', 'j\'e', 'j\'o', 'j\'a', 'j\'i',
                'l\'u', 'l\'e', 'l\'o', 'l\'a', 'l\'i',
                'd\'u', 'd\'e', 'd\'o', 'd\'a', 'd\'i',
                'n\'u', 'n\'e', 'n\'o', 'n\'a', 'n\'i'];
var word_sum = ['je', 'le', 'la', 'de', 'du', 'ne'];
var vowel = ['u', 'e', 'o', 'a', 'i'];

var compound_word =['je u','je e','je o','je a','je i',
                    'le u','le e','le o','le a','le i',
                    'la u','la e','la o','la a','la i',
                    'de u','de e','de o','de a','de i',
                    'du u','du e','du o','du a','du i',
                    'ne u','ne e','ne o','ne a','ne i'];

var timeout ;

function loadFullMode(id) {
    $.post("backend/php/full_mode.php", {id: id,mode:'fullMode'}, function(result){
        $('#main-content').html(result);
    });
    // $('#main-content').load('views/mode/fullmode.html')

}
function loadBlankMode(id) {
    $.post("backend/php/full_mode.php", {id: id,mode:'blankMode'}, function(result){
        $('#main-content').html(result);
    });
    // $('#main-content').load('views/mode/blankmode.html')
}
function loadQuickMode(id) {
    $.post("backend/php/full_mode.php", {id: id,mode:'quickMode'}, function(result){
        $('#main-content').html(result);
    });
}
function loadNewMode(id) {
    $.post("backend/php/full_mode.php", {id: id,mode:'newMode'}, function(result){
        $('#main-content').html(result);
    });
    // $('#main-content').load('views/mode/newmode.html')
}

function playStart() {
    clearTimeout(timeout);
    $(".before_check").show();
    $(".after_check").hide();
    var a = $("#sentences_no :selected").text();
    $('#controlPlay').css('display', 'none');

    var start = $('#track-' + parseInt(a) + ' div:first').text();
    var end = $('#track-' + parseInt(a) + ' div:eq(1)').text();
    play(start, end);
}

function getStart() {
    var a = $("#sentences_no :selected").text();
    var start = $('#track-' + parseInt(a) + ' div:first').text();
    return parseInt(start);
}

function getEnd() {
    var a = $("#sentences_no :selected").text();
    var end = $('#track-' + parseInt(a) + ' div:eq(1)').text();
    return parseInt(end);
}

function play(s, e) {
    var audio = document.querySelector('audio');
    var video = document.querySelector('video');
    var av ;

    if (audio != null){
        av = audio;
        av.currentTime = 0;
    }else{
        av = video;
        av.currentTime = 0;
    }

    var start = parseInt(s);
    var end = parseInt(e);
    if (start >= 0 && end >= 0) {
        av.load();
        av.currentTime = start;
        av.play();
    }
    av.addEventListener('timeupdate', function (ev) {
        var progres = (parseInt(av.currentTime)/(end))*100;
        $('#slimprogress').attr('value',parseInt(progres));
        console.log("currentTime", av.currentTime);
        if (av.currentTime > getEnd()) {
            av.currentTime = getStart();
            av.play();
        }
    }, false);
}
function checkFullMode() {
    var a = $("#sentences_no :selected").text();
     a = parseInt(a);//id of track
    var x = document.getElementById("audioScript");
    var scriptok = document.getElementById("scriptok");

    // answer
    var result = $('#track-' + parseInt(a) + ' div:eq(2)').text();
    var point = $('#track-' + parseInt(a) + ' div:eq(3)').text();

    var splitted = result.split(" ");
    point = parseInt(point);
    var sum_point = splitted.length;
    var per_point = (sum_point/point);
    if (fullMode < splitted.length){
        var word = splitted[fullMode].split("");
        for (var i = 0; i < x.value.length; i++) {
            if (word.length >=3){
                if (summarit.indexOf((word[0]+word[1]+word[2]).toLowerCase()) !== -1){
                    if (x.value.length >=2 && x.value.length<=4){
                        // var rs = word_sum.indexOf(x.value.toLowerCase());
                        var pos = compound_word.indexOf(x.value.toLowerCase());
                        if (pos !== -1){
                            if (pos>=10 && pos<=14){
                                pos = pos - 5;
                            } else if (pos>=20 && pos<=29){
                                pos = pos -5;
                            }
                            x.value = summarit[pos];
                        }
                        if (x.value.toLocaleLowerCase() === splitted[fullMode].toLocaleLowerCase()) {
                            var srct = "";
                            for (var n =0;n<=fullMode;n++){
                                srct += splitted[n]+" ";
                            }
                            scriptok.innerText = srct;
                            x.value = "";
                            fullMode +=1;
                            loadPoint(fullMode * per_point);
                        }
                        continue;
                    }
                    // break;
                }
            }
            if (x.value.toLocaleLowerCase() === splitted[fullMode].toLocaleLowerCase()) {
                var srct = "";
                for (var n =0;n<=fullMode;n++){
                     srct += splitted[n]+" ";
                }
                scriptok.innerText = srct;
                x.value = "";
                fullMode +=1;
                loadPoint(fullMode * per_point);
            } else if (x.value[i].toLocaleLowerCase() === word[i].toLocaleLowerCase()) {
                console.log("");
            }
            else {
                var temp_value = "";
                for (var j =0; j < i;j++){
                    temp_value += x.value[j]
                }
                x.value = temp_value;
            }
        }
    }else{
        loadPoint(fullMode * per_point);
        // finish
    }
}

function checkNewMode() {
    var res = $('#audioScriptTmode');//cho dien dap an
    var r = confirm("Check Vowel!");
    if (r === true) {
        //stop listen
        var audio = document.querySelector('audio');
        var video = document.querySelector('video');

        if (audio != null){
            a = audio;
        }else{
            a = video;
        }
        a.pause();

        var re = res.text();
        var newHTML = "";
        for (var n=0;n<re.length;n++){
            if (re[n] === 'u' || re[n] === 'e' || re[n] === 'o' || re[n] === 'a' || re[n] === 'i'){
                newHTML += "<span class='statement' contenteditable='true'>" + re[n] + "</span>";
            }else{
                newHTML += "<span class='other'>" + re[n] + "</span>";
            }
        }
        $('#audioScriptTmode').attr('contenteditable','false');
        $('#audioScriptTmode').html(newHTML);
    } else {
        stopListen();
        $('.before_check').hide();
        $('.after_check').show();
        var a = $("#sentences_no :selected").text();
        a = parseInt(a);//id of track
        var answer = document.getElementById("answer");//hien thi dap an

        // answer
        var result = $('#track-' + parseInt(a) + ' div:eq(2)').text();

        var point = $('#track-' + parseInt(a) + ' div:eq(3)').text();

        //convert word
        var poo = 0;
        var res_value = res.text();
        for (var k=0;k<compound_word.length;k++){
            poo = res_value.toLowerCase().indexOf(compound_word[k]);
            if (poo>=0){
                if (k>=10 && k<=14){
                    k = k - 5;
                } else if (k>=20 && k<=29){
                    k = k -5;
                }
                res_value = res_value.replace(new RegExp(compound_word[k], 'g'),summarit[k]);
            }
        }

        var arrPostion = [];//vi tri ket qua dung
        var temp = res_value.trim().split(" ");//mang cac dap an dien vao tu nguoi dung

        point = parseInt(point);
        var sum_point = temp.length;
        var per_point = (sum_point/point);

        var position = 0;
        for (var i=0;i<temp.length;i++){
            position = result.toLowerCase().indexOf(temp[i].toLowerCase());
            if (position >= 0){
                arrPostion.push(i);
                result = result.substr(position+temp[i].length,result.length);
            }
        }

        var str = "";
        for (var j=0;j<arrPostion.length;j++){
            str = str + temp[j] + " ";
        }

        //hien thi ket qua len browser
        answer.innerText = str;
        loadPoint(str.length * per_point);
        timeout = setTimeout(function () {
            $("#sentences_no").val(a+1);
            playStart();
        },3000);
    }

}

function checkBlankMode(answer0,answer1,answer2) {
    var $qword_0 =  $('#qword_0').val();
    var $qword_1 =  $('#qword_1').val();
    var $qword_2 =  $('#qword_2').val();
    if ($qword_0 === answer0){
        $('#qword_0').css('color','green');
    }else{
        $('#qword_0').val('');
    }
    if ($qword_1 === answer1){
        $('#qword_1').css('color','green');
    }else{
        $('#qword_1').val('');
    }
    if ($qword_2 === answer1){
        $('#qword_2').css('color','green');
    }else{
        $('#qword_2').val('');
    }
}

function checkQuickMode() {
    var a = 1;//id of track
    var x = document.getElementById("audioScript");
    var scriptok = document.getElementById("scriptok");
    var point = $('#track-' + parseInt(a) + ' div:eq(3)').text();

    // answer
    var result = $('#track-' + parseInt(a) + ' div:eq(2)').text();
    var splitted = result.split(" ");

    if (quickMode < splitted.length){
        var word = splitted[quickMode].split("");
        for (var i = 0; i < x.value.length; i++) {
            if (x.value.toLocaleLowerCase() === splitted[quickMode].toLocaleLowerCase()) {
                var srct = "";
                for (var n =0;n<=quickMode;n++){
                    srct += splitted[n]+" ";
                }
                scriptok.innerText = srct;
                x.value = "";
                quickMode +=1;
            } else if (x.value[i].toLocaleLowerCase() === word[i].toLocaleLowerCase()) {
                if (x.value.length >= 2){
                    var temp = "";
                    for (var m =0;m<=quickMode;m++){
                        temp += splitted[m]+" ";
                    }
                    scriptok.innerText = temp;
                    x.value = "";
                    quickMode +=1;
                }
            }
            else {
                var temp_value = "";
                for (var j =0; j < i;j++){
                    temp_value += x.value[j]
                }
                x.value = temp_value;
            }
        }
    }else{

    }
}

function stopListen() {
    var audio = document.querySelector('audio');
    var video = document.querySelector('video');

    if (audio != null){
        audio.pause();
    }else{
        video.pause()
    }

    $('#controlPlay').css('display', '');
}

function stopListenBlank() {
    var audio = document.querySelector('audio');
    var video = document.querySelector('video');

    if (audio != null){
        a = audio;
    }else{
        a = video;
    }
    a.pause();
    $('#controlPlay').css('display', '');
    loadBlank();
}

function loadLevelAudio(id) {
    $.post("backend/php/load_level_audios.php", {id: id}, function(result){
        $('html').html(result);
    });
}

function generateRandomNumber(min , max)
{
    var random1 = Math.ceil(Math.random() * (max-min) + min);
    var random2 = Math.ceil(Math.random() * (max-min) + min);
    var random3 = Math.ceil(Math.random() * (max-min) + min);
    if (random1 !== random2 !== random3){
        return [random1,random2, random3]
    }else{
        generateRandomNumber(min,max);
    }
}

function loadBlank() {
    var a = $("#sentences_no :selected").text();
    a = parseInt(a);//id of track

    // answer
    var result = $('#track-' + parseInt(a) + ' div:eq(2)').text();
    var point = $('#track-' + parseInt(a) + ' div:eq(3)').text();
    point = parseInt(point);
    var sum_point = result.length;
    var per_point = (sum_point/point);

    var temp = result.trim().split(" ");


    if (temp.length > 40){
        var random = generateRandomNumber(1,40);
    } else{
        var random = generateRandomNumber(1,temp.length-1);
    }

    var answer0= temp[random[0]];
    var answer1= temp[random[1]];
    var answer2= temp[random[2]];

    if (temp[random[0]] !== " "){
        temp[random[0]] = "<input id=\"qword_0\" size=\"7\"  onfocus=\"current_input=this;current_qindex=0;\" class=\"quiz-input\">";
    }
    if (temp[random[1]] !== " "){
        temp[random[1]] = "<input id=\"qword_1\" size=\"7\"  onfocus=\"current_input=this;current_qindex=0;\" class=\"quiz-input\">";
    }
    if (temp[random[2]] !== " "){
        temp[random[2]] = "<input id=\"qword_2\" size=\"7\"  onfocus=\"current_input=this;current_qindex=0;\" class=\"quiz-input\">";
    }
    result = "";
    for (var i=0;i<40;i++){
        result += temp[i]+" ";
    }
    $('#answer-question').html(result);
}

function checkVowel() {
    alert("Fuck you that");
}