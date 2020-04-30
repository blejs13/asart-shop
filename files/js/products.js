//cena, id, data... i inne dane pobrane z bd 
function viewProduct(id,name,info,price,date,status,muszla,ilosc_zdjec){
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
    $("#product_"+id).append('<h2 class="product_title">' + name + '</h2>');
    $("#product_"+id).append('<h2 class="product_price">' + price + 'zł</h2>');
    $("#product_"+id).append('<p class="product_info">' + info + '</p>');
    $("#product_"+id).append('<p class="product_id">id:' + id + '</p>');
    $("#product_"+id).append('<p class="product_date">' + date.split(' ')[0] + '</p>');
    $("#product_"+id).append('<input id="how_many_photos_'+id+'" value="'+ilosc_zdjec+'" type="hidden">');
}

function loadProducts(){
    if($('#last_product_id').val()!=-1){
        var id_of_product = $('#last_product_id').val();
        $('#last_product_id').val(-1);
        $.ajax({ url: 'products/loadProducts/'+id_of_product,
            method: 'get', 
            dataType: 'json',
            success:function(data){
                data.forEach(d => {
                    //$('#productloader').show();
                    viewProduct(d["ID"],d["NAME"],d["INFO"],d["PRICE"],d["DATE"],d["STATUS"],d["MUSZLA"],d["ILOSC_ZDJEC"]);
                    $("#product_"+d["ID"]+"").hide();
                    $('#last_product_id').val(d["ID"]);
                });
            }
        });
    }
}


