require('../css/blog.css');

document.getElementById('blogFeaturedPhoto').onchange = function (evt) {
    var tgt = evt.target || window.event.srcElement,
        files = tgt.files;

    // FileReader support
    if (FileReader && files && files.length) {
        var fr = new FileReader();
        fr.onload = function () {
            document.getElementById('selectedImage').src = fr.result;
        }
        fr.readAsDataURL(files[0]);
    }
}