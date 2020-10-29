//// Toggle info story in storypages -> index

let infostorybutton = document.getElementById('infostorybutton');
let nodisplay = document.getElementById('nodisplay');

if (infostorybutton) {

    infostorybutton.addEventListener('click', function () {
        if (nodisplay.id == 'nodisplay') {
            nodisplay.removeAttribute('id');
        } else {
            nodisplay.setAttribute('id', 'nodisplay');
        }
    });
}




//// Arrows up and down in storypages -> index



let storypageLinkUp = document.getElementsByClassName('storypage-link-up');
if (storypageLinkUp.length > 0) {
    let firstStorypageLinkUp = storypageLinkUp[0];
    firstStorypageLinkUp.setAttribute('id', 'nodisplay');
}

let storypageLinkDown = document.getElementsByClassName('storypage-link-down');
if (storypageLinkDown.length > 0) {
    let lastStorypageLinkDown = storypageLinkDown[storypageLinkDown.length - 1];
    lastStorypageLinkDown.setAttribute('id', 'nodisplay');
}