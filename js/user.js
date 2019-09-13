
/**
 * 
 * @param {{file : File}} img 
 */
async function uploadProfileImage(img) {
    console.log(img);

    const uploadUrl = resolveUrl('php/user.php');
    uploadUrl.searchParams.set('req', 'upload_profile_image');

    const data = new FormData();
    data.append('profile_image', img);

    const result = await fetch(uploadUrl, {method: 'POST', body: data});
    const text = await result.text();
}