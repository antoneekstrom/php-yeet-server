onload = (ev) => {
    console.log("onload");
    const el = document.querySelector("input#upload_profile_image");
    el.onchange = () => uploadProfileImage(el.files[0]);
    console.log(el.files[0]);
};