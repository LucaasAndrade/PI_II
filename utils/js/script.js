const body = document.querySelector('body');
sidebar = body.querySelector('.sidebar');
toggle = body.querySelector('.toggle');
mode = body.querySelector('.mode');
modeSwitch = body.querySelector('.toggle-switch');
modeText = body.querySelector('.mode__text');


modeSwitch.addEventListener('click', () => {
    body.classList.toggle('dark');
});
