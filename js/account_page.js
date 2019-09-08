onload = (ev) => {
    const el = document.querySelector("input#upload_profile_image");
    el.onchange = handleProfileImageUpload;
};

async function handleProfileImageUpload() {
    const file = this.files[0];
    const text = await file.text();
    const data = {name: file.name, type: file.type, data: text};
}