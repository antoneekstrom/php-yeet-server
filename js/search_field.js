
document.querySelectorAll(".search-user-field").forEach(el => {
    const params = new URL(window.location.href).searchParams;
    const val = params.get('input');
    el.value = val;
});