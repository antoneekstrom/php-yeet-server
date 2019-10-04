
const main = document.querySelector('main');
const bod = document.querySelector('body');

if (new URL(window.location.href).searchParams.has('input')) {

    main.style.display = 'none';

    const cd = document.createElement('h1');
    const c = document.createElement('main');

    cd.classList.add('countdown');
    c.appendChild(cd);
    bod.append(c);
    cd.textContent = '3';

    setTimeout(() => {
        cd.textContent = '2';
        setTimeout(() => {
            cd.textContent = '1';
            setTimeout(() => {
                c.remove();
                main.style.display = 'flex';
            }, 600);
        }, 600);
    }, 600);

}
else {
    main.style.display = 'flex';
}