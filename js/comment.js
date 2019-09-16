
document.querySelectorAll('.like-button').forEach(el => {
    el.onclick = (ev) => {
        const data = new FormData();
        data.append('id', 0);
        fetch(resolveUrl('php/social.php?req=like_comment'), {method: 'post', body: data});
    };
});