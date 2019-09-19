
document.querySelectorAll('.like-button').forEach(el => {
    el.onclick = (ev) => {
        rateComment(el.id, false);
    };
});

document.querySelectorAll('.dislike-button').forEach(el => {
    el.onclick = (ev) => {
        rateComment(el.id, true);
    };
});

async function rateComment(id, dislike) {

    const url = new URL(resolveUrl('php/social.php'));
    url.searchParams.set('id', id);
    url.searchParams.set('req', 'rate_comment');
    url.searchParams.set('is_dislike', dislike ? 1 : 0);

    console.log(url);

    const r = await fetch(url.href);
    const t = await r.text();
    console.log(t);
}