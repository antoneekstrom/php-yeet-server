
const BASE_URL = new URL('http://localhost/php/');

const BASE_DIR = '/php-yeet-server/php/';

/**
 * Combine two paths correctly.
 * @param {string} a first path
 * @param {string} b second path
 * @returns {string} the resulting path
 */
function joinPaths(a, b) {
    let na = a;
    let nb = b;

    if (new RegExp(/([\/\\])$/).test(a)) {
        na = a.substring(0, a.length - 1);
    }
    if (new RegExp(/^([\/\\])/).test(b)) {
        nb = b.substring(1, a.length);
    }

    return na + "/" + nb;
}

function resolveUrl(path) {
    let url = new URL(window.location.href);
    url.pathname = joinPaths(BASE_DIR, path);
    return url;
}

/**
 * Change the page of the window.
 * @param {URL|string} url the url to navigate the window to 
 */
function redirect(url) {
    window.location.href = url == typeof(URL) ? url.href : url;
}

function logout() {
    const url = resolveUrl('user.php');
    url.searchParams.set('req', 'log_out');
    console.log(url);
    redirect(url);
}

onload = (e) => {
    const buttons = document.querySelectorAll('.logout');
    buttons.forEach((e) => {
        e.onclick = (e) => logout();
    });
};