require('./bootstrap');

document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');

    imageInput.addEventListener('change', function(event) {
        const file = event.target.files[0];

        if (file) {
            imagePreview.src = URL.createObjectURL(file);
            imagePreview.style.display = 'inline-block';
        } else {
            imagePreview.src = '';
            imagePreview.style.display = 'none';
        }
    });
});
