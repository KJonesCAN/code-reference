let output = 'Hello World!';
let container = document.getElementById('output');
const button = document.getElementById('button-1');

button.addEventListener('click', function() {
    container.classList.toggle('red');
});

container.innerHTML = output;
