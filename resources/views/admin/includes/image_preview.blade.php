<script>
    function previewImage(input, element){
        var file = input.files[0];
        if(file){
            var image = $('#'+element+'_image');
            var deleteBtn = $('#'+element+'_deleteBtn');
            var reader = new FileReader();
            reader.onload = function(){
                image.attr("src", reader.result);
                image.removeClass('d-none');
                deleteBtn.removeClass('d-none');
            }
            reader.readAsDataURL(file);
        }
    }

    function clearImage(element){
        var image = $('#'+element+'_image');
        var deleteBtn = $('#'+element+'_deleteBtn');
        var input = $('#'+element+'_input');
        image.attr("src", '');
        image.addClass('d-none');
        deleteBtn.addClass('d-none');
    }
</script>
