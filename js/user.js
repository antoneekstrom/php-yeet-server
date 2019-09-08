
/**
 * @param {{name: string, type : string, data : string}} imgData 
 */
async function uploadProfileImage(imgData) {
    const uploadUrl = resolveUrl('user.php');
    uploadUrl.searchParams.set('req', 'upload_profile_image');

    const body = await JSON.stringify(imgData);

    fetch(uploadUrl.href, {method: 'post', body: body}).then((r) => {
        r.text().then(t => console.log(t));
    });
}