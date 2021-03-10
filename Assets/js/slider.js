$(document).ready(function () {
    var indexSilder = 0;
    function changeSlider() {
        process();
    }
    function process() {
        var arrSlider = document.getElementsByClassName('slide');

        for (var i = 0; i < arrSlider.length; i++) {
            arrSlider[i].style.display = "none";
        }
        indexSilder += 1;
        if (indexSilder > arrSlider.length) indexSilder = 1;

        arrSlider[indexSilder - 1].style.display = "block";
        setTimeout(process, 2000);
    }
    changeSlider();
})