//aktualne zdjecie i ilosc zdjec dla danego prodktu ??
function openGallery(id){ 
    var l1 = '<div id="photo_gallery" style="background: rgba(0, 0, 0, 0.8);width:100vw;height:100vh;position:fixed;top:0;left:0;z-index:40;">';
    var l2 = '    <div class="exit_gallery noSelect" onclick="exitGallery()" style="position:fixed;top:0;right:0;z-index:40;color:#eee;font-size:1em;font-weight:700;margin: 20px;">&#9587;</div>';
    var l3 = '    <div class="left_gallery noSelect" onclick="prevPhoto('+ id+')">&#10094;</div>';
    var l4 = '    <div id="image_div" style="display:flex;justify-content:space-around;align-items:center;width:100vw;height:100vh;"class="photo_inside_gallery">';
    var l5 = '        <img class="noSelect" style="align-self:center;max-width:95vw;max-height:90vh; "src="files/images/products/'+id+'/fullsize/photo1.jpg" alt="foto">';
    var l6 = '    </div>';
    var l7 = '    <div class="right_gallery noSelect" onclick="nextPhoto('+ id+')" >&#10095;</div>';
    var l8 = '</div>';
    $("body").append(l1+l2+l3+l4+l5+l6+l7+l8);
    $("#photo_gallery").append('<input id="img_value" value="1" type="hidden">');
    $("#photo_gallery").append('<input id="product_id_gallery" value="'+id+'" type="hidden">');
}

//przesyłac ilosc zdjec i ktore aktualnie??
function nextPhoto(id){
    let photo = parseInt($('#img_value').val());
    let number_of_photos = parseInt($('#how_many_photos_'+id).val());
    if ( photo == number_of_photos ){
        photo=1;
    }
    else{
        photo+=1;
    }
    $('#img_value').val(photo);
    $("#image_div >img").remove();
    $("#image_div").append('<img id class="noSelect" style="align-self:center;max-width:95vw;max-height:90vh; "src="files/images/products/'+id+'/fullsize/photo' + photo + '.jpg" alt="foto">');
}

function prevPhoto(id){
    let photo = parseInt($('#img_value').val());
    let number_of_photos = parseInt($('#how_many_photos_'+id).val());
    if(photo == 1){
        photo=number_of_photos;
    }
    else{
        photo-=1;
    }   
    $('#img_value').val(photo);
    $("#image_div >img").remove();
    $("#image_div").append('<img class="noSelect" style="align-self:center;max-width:95vw;max-height:90vh; "src="files/images/products/'+id+'/fullsize/photo' + photo + '.jpg" alt="foto">');
}

//close gallery by delating all elements
function exitGallery(){
    $("#photo_gallery").remove();
}

$(document).on('keydown',function(e) {
    switch(e.which) {
        case 37: // left
            if ($('#photo_gallery').length){
                prevPhoto($("#product_id_gallery").val());
            }
        break;
        case 39: // right
            if ($('#photo_gallery').length){
                nextPhoto($("#product_id_gallery").val());
            }
        break;
        case 27: // esc
            if ($('#photo_gallery').length){
                exitGallery();
            }
        break;
        default: return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
});
