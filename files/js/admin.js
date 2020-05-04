
function viewProductEdit(id,name,date,status,ilosc_zdjec){
    var l1 = '<div id="product_'+id+'" class="product">';
    var l2 = '    <div class="product_miniature" onclick="openGallery(' + id + ')">';
    var l3 = '    </div>';
    var l4 = '</div>';
    $("main").append(l1+l2+l3+l4);
    var product_img = new Image;
    product_img.src="files/images/products/" + id + "/small/smallphoto.jpg";
    product_img.alt="product";
    product_img.className="noSelect";
    product_img.onload=function(){
       // $('#productloader').hide();
        $("#product_"+id).show();
    };
    $("#product_"+id+">div").append(product_img);
    if(status==1){
        $("#product_"+id).append('<h2 class="product_title">' + name + '</h2>');
        $("#product_"+id).append('<p class="product_id">id:' + id + '</p>');
        $("#product_"+id).append('<p class="product_date">' + date.split(' ')[0] + '</p>');
    }
    else{
        $("#product_"+id).append('<h2 class="grey product_title">' + name + '</h2>');
        $("#product_"+id).append('<p class="grey product_id">id:' + id + '</p>');
        $("#product_"+id).append('<p class="grey product_date">' + date.split(' ')[0] + '</p>');
    }

    $("#product_"+id).append('<div class="product_edit" onclick="editProduct('+id+')">Edytuj</div>');
    $("#product_"+id).append('<div class="product_delete" onclick="deleteProduct('+id+')">Usuń</div>');
    $("#product_"+id).append('<input id="how_many_photos_'+id+'" value="'+ilosc_zdjec+'" type="hidden">');
}

function loadProductsEdit(){
    if($('#last_product_id').val()!=-1){
        var id_of_product = $('#last_product_id').val();
        $('#last_product_id').val(-1);
        $.ajax({ url: 'admin/loadProducts/'+id_of_product,
            method: 'get', 
            dataType: 'json',
            success:function(data){
                data.forEach(d => {
                    viewProductEdit(d["ID"],d["NAME"],d["DATE"],d["STATUS"],d["ILOSC_ZDJEC"]);
                    $("#product_"+d["ID"]+"").hide();
                    $('#last_product_id').val(d["ID"]);
                });
            }
        });
    }
}

function loadProductsDeleted(){
    if($('#last_product_id').val()!=-1){
        var id_of_product = $('#last_product_id').val();
        $('#last_product_id').val(-1);
        $.ajax({ url: 'admin/loadProducts/'+id_of_product,
            method: 'get', 
            dataType: 'json',
            success:function(data){
                data.forEach(d => {
                    viewProductEdit(d["ID"],d["NAME"],d["DATE"],d["STATUS"],d["ILOSC_ZDJEC"]);
                    $("#product_"+d["ID"]+"").hide();
                    $('#last_product_id').val(d["ID"]);
                });
            }
        });
    }
}

function closeOverlay(overlayid){
    $("#"+overlayid).remove();
}

function addNewProduct(){
    $.ajax({ url: 'admin/addproduct',
            method: 'get', 
            success:function(data){
                var overlay = '<div id="addoverlay" class="noSelect overlay"><div><p class="overlayTitle">Nowy produkt</p><p onclick="closeOverlay(\'addoverlay\')" class="exitOverlay">X</p></div></div>';
                $("body").append(overlay);
                $("#addoverlay>div").append(data);
            }
            });
}

function editProduct(id){
    $.ajax({ url: 'admin/editproduct/'+id,
            method: 'get', 
            success:function(data){
                var overlay = '<div id="addoverlay" class="noSelect overlay"><div><p class="overlayTitle">Edycja produktu: '+id+'</p><p onclick="closeOverlay(\'addoverlay\')" class="exitOverlay">X</p></div></div>';
                $("body").append(overlay);
                $("#addoverlay>div").append(data);
            }
            });
}

function deleteProduct(id){
    if(confirm("Czy na pewno usunąć produkt o id: "+id+"?")){
        $.ajax({ url: 'admin/deleteProduct/'+id,
        method: 'get',
        success:function(){
            window.location.reload(true);
        }
        });
    }
}

function logoutUser(){
    window.location.href = "admin/logout";
}

function previewMiniature(input){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            $('#miniature_preview>img').remove();
            var miniature_prev = new Image;
            miniature_prev.src=e.target.result;
            miniature_prev.alt="miniatura";
            miniature_prev.className="noSelect";
            
            /*$('#miniature_preview>img').attr('src', e.target.result);*/
            $('#miniature_preview').append(miniature_prev);
            $('#miniature_preview>img').show();
        }
        reader.readAsDataURL(input.files[0]); 
    }
}

function previewPhotos(input){
    if (input.files) {
        var filesAmount = input.files.length;
        var idiv=1;
        $('#photos_preview>div').remove()
        for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();
            $('#photos_preview').append("<div></div>");
            reader.onload = function(event) {
                var photo_prev = new Image;
                photo_prev.src=event.target.result;
                photo_prev.alt="zdjecie";
                photo_prev.className="noSelect";
                $('#photos_preview>div:nth-child('+idiv+')').append(photo_prev);
                $('#photos_preview>div:nth-child('+idiv+')>img').show();
                idiv++;
            }

            reader.readAsDataURL(input.files[i]);
        }
    }
}

function insertProduct(){
    confirm("Czy na pewno chcesz zamienić miniature? Poprzednia zostanie usunięta!");
    //if idedytowalnego not null i nowa miniatura to zapytaj o wstawiana miniaturke 
    //else if pusta miniatura lub puste zdjecia alert musisz dodac zdjecia
    return false;
}