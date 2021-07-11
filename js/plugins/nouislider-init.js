
var rangeSlider = document.getElementById('range-slider');
if (typeof(rangeSlider) != 'undefined' && rangeSlider != null){

var lowerValue  = document.getElementById('lower-value');
var upperValue  = document.getElementById('upper-value');
var step        = parseInt(lowerValue.getAttribute('step'));

noUiSlider.create(rangeSlider, {
    //connect: true,
    //behaviour: 'tap',
    start: [lowerValue.value, upperValue.value],
    step: 1000,
    tooltips: true,
    behaviour: 'drag',
    connect: true,
    range: {
        // Starting at 500, step the value by 500,
        // until 4000 is reached. From there, step by 1000.
        'min': [0],
        //'10%': [500, 500],
        //'50%': [4000, 1000],
        'max': [10000]
    }
});


var nodes = [
    lowerValue,
    upperValue,
];
/*
var nodes = [
document.getElementById('lower-value'), // 0
document.getElementById('upper-value')  // 1
];

// Display the slider value and how far the handle moved
// from the left edge of the slider.
rangeSlider.noUiSlider.on('update', function (values, handle, unencoded, isTap, positions) {
    nodes[handle].innerHTML = values[handle];
    //nodes[handle].innerHTML = values[handle] + ', ' + positions[handle].toFixed(2) + '%';
});
*/

rangeSlider.noUiSlider.on('update', function (values, handle, unencoded, isTap, positions) {
    nodes[handle].value = values[handle];
});

lowerValue.addEventListener('change', function () {
    rangeSlider.noUiSlider.set([this.value, null]);
});
upperValue.addEventListener('change', function () {
    rangeSlider.noUiSlider.set([null, this.value]);
});

}
