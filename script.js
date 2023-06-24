function handleClick(button) {
    button.classList.add('clicked');
    button.innerHTML = '';
    setTimeout(function () {
        button.innerHTML = '✔';
    }, 2000);
}