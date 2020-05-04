<form name="product" onsubmit="insertProduct()" enctype="multipart/form-data" action="admin/insertProduct" method="post">
    <label id="title_input">Nazwa
        <input type="text" name="title" <?php if(isset($model['NAME'])){echo "value=".$model['NAME'];} ?>>
    </label>
    <label id="info_input">Opis
        <input type="textarea" name="info" <?php if(isset($model['INFO'])){echo "value=".$model['INFO'];} ?>>
    </label>
    <label id="price_input">Cena
        <input type="text" name="price" <?php if(isset($model['PRICE'])){echo "value=".$model['PRICE'];} ?>>
    </label>
    <label id="miniature_input">Miniatura:
        <input onchange="previewMiniature(this)" name="miniature" type="file"/>
        <div id="miniature_preview"></div>
    </label>
    <label id="photos_input">Zdjęcia:
        <input name="photos[]" onchange="previewPhotos(this)" type="file" multiple/>
        <div id="photos_preview"></div>
    </label>
    <div class="checkboxes_input">
        <label class="container" >Aktywny
            <input type="checkbox" name="status"  <?php if((isset($model['STATUS']) && $model['STATUS']==1) || !isset($model['STATUS'])){echo "checked";} ?>>
            <span class="checkmark"></span>    
        </label>
        <label class="container">Muszla
            <input type="checkbox" name="muszla" <?php if(isset($model['NAME'])){echo "value=".$model['NAME'];} ?>>
            <span class="checkmark"></span>
        </label>
    </div>
    <input id="edited_product_id" name="id" type="hidden" <?php if(isset($model['ID'])){echo "value=".$model['ID'];} ?>>
    <input class="button" type="submit" value="Wstaw"/>
</form>