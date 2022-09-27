const placeholder = "https://www.runningin.info/wp-content/uploads/2018/07/no-image.jpg"
const preview = document.getElementById('preview');
const imageField = document.getElementById('image-field');

imageField.addEventListener('input', () =>{
    // if (imageField.value) preview.src = imageField.value;
    // else preview.src = placeholder;

    preview.src = imageField.value ?? placeholder;
})