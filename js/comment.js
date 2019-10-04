
document.querySelectorAll('.like-button').forEach(el => {
    el.onclick = (ev) => {
        rateComment(el.id, false, el.parentNode);
    };
});

document.querySelectorAll('.dislike-button').forEach(el => {
    el.onclick = (ev) => {
        rateComment(el.id, true, el.parentNode);
    };
});

async function rateComment(id, dislike, element) {

    const url = new URL(resolveUrl('php/social.php'));
    url.searchParams.set('id', id);
    url.searchParams.set('req', 'rate_comment');
    url.searchParams.set('is_dislike', dislike ? 1 : 0);

    const r = await (await fetch(url.href)).json();

    fakeRating(element, r);
}

/**
 * @param {HTMLElement} el 
 * @param {{dislike : boolean, exists : boolean, same : boolean}} result 
 */
function fakeRating(el, result) {
    const count = el.querySelector('p.likes');
    const up = el.querySelector('.like-button');
    const down = el.querySelector('.dislike-button');

    if (!result.same && !result.exists) {
        count.textContent = parseInt(count.textContent) + (result.dislike ? -1 : 1);
        (result.dislike ? down : up).classList.add('active');
    }
    else if (result.same && result.exists) {
        count.textContent = parseInt(count.textContent) + (result.dislike ? 1 : -1);
        (result.dislike ? down : up).classList.remove('active');
    }
}