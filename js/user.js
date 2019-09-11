
async function uploadProfileImageForm() {
    const uploadUrl = resolveUrl('user.php');
    uploadUrl.searchParams.set('req', 'upload_profile_image');

    const data = new FormData(document.querySelector("#upload_profile_image_form"));
    console.log(data);

    fetch(uploadUrl.href, {method: 'post', body: data}).then((r) => {
        r.text().then(t => console.log(t));
    });
}

/**
 * 
 * @param {{file : File}} img 
 */
async function uploadProfileImage(img) {
    console.log(img);

    const uploadUrl = resolveUrl('user.php');
    uploadUrl.searchParams.set('req', 'upload_profile_image');

    const data = new FormData();
    data.append('profile_image', img);

    const result = await fetch(uploadUrl, {method: 'POST', body: data});
    const text = await result.text();
    console.log(result);
    console.log(text);
}