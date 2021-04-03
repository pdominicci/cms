$(document).ready(function(){
    // $(function () {
    //     $('[data-toggle="tooltip"]').tooltip()
    // })

    $("#uploadImage").css("display", "none")
    $("#uploadImageMiniature").css("display", "none")
    $("drop").removeClass("droping")
    $("drop").addClass("open")

    // DELEGATE
    // registro el evento en document y cuando se agregue un elemento dinamicamente
    // el listener del click va a estar registrado (antes lo agregaba dos veces)
    $(document).on('click','i','.eliminar_foto',function(e) {
        var hijo = $(this).parent().children()[0]
        var id = hijo['value']
        var array_elim = $(this).parent()[0].classList
        var seguir_elim = false
        for(var j in array_elim){
            if (array_elim.item(j) == 'eliminar_foto'){
                seguir_elim = true
            }
        }

        if (seguir_elim){
            if ($('#'+id).lenght!==0){
                $('#'+id).remove()
                var formData = new FormData()
                formData.append("id", id)
                $.ajax({
                    url:"/admin/deletePhoto",
                    type:"POST",
                    data: formData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,   // tell jQuery not to set contentType
                    success:function(){
                    }
                })
            }
        }
    })

    $(document).on('click','i','.cover',function(e) {


        var hijo = $(this).parent().children()[0]
        var id = hijo['value']
        var array_cover = $(this).parent()[0].classList
        var seguir = false
        for(var j in array_cover){
            if (array_cover.item(j) == 'cover'){
                seguir = true
            }
        }
        if (seguir){
            var hijos = document.getElementsByClassName('base')

            for(var z in hijos){
                var array_cover = hijos.item(z).classList

                for (var w in array_cover){
                    if (array_cover.item(w) == 'fas'){
                        hijos.item(z).classList.remove('fas')
                        hijos.item(z).classList.add('far')
                        break
                    }
                }
            }

            var formData = new FormData()
            formData.append("id", id)
            $.ajax({
                url:"/admin/setCoverImage",
                type:"POST",
                data: formData,
                processData: false,
                contentType: false,
                success:function(){

                    var star = document.getElementsByName(id)[0]
                    var array_star = star.classList

                    for(var i in array_star){
                        if (array_star.item(i) == 'far'){
                            star.classList.remove('far')
                            star.classList.add('fas')
                            break
                        }

                    }
                }
            })
        }
    })
})

let drop = document.getElementById('drop')
let open_file = document.getElementById('open_file')
let counter = 0
drop.addEventListener('dragenter', e =>{
    e.preventDefault()
    counter++
    drop.classList.remove('open');
    //$('#open_label').hide()
    drop.classList.add('droping');
})

drop.addEventListener('dragleave', e =>{
    e.preventDefault()
    counter--
    drop.classList.remove('droping');
    // if (counter == 0) {
    //     drop.classList.remove('droping');
    //     drop.classList.add('open');
    // }
})

drop.addEventListener('dragover', e =>{
    e.preventDefault()
    drop.classList.remove('open');
    drop.classList.add('droping');
})

drop.addEventListener('drop', e =>{
    e.preventDefault()

    drop.classList.remove('droping');
    //drop.classList.add('open');
    //$('#open_label').show()
    let archivos = Array.from(e.dataTransfer.files)
    let sub_id = 0
    archivos.forEach(archivo =>{
        sub_id++
        upload(archivo, sub_id)
    })
})

open_file.addEventListener('change', e =>{
    e.preventDefault()

    var archivos = new Array()

    for (var i = 0; i < open_file.files.length; ++i) {
        archivos.push(open_file.files.item(i));

    }
    let sub_id = 0
    archivos.forEach(archivo =>{
        sub_id++
        upload(archivo, sub_id)
    })
})

function upload(archivo,sub_id){
    var company_id = localStorage.getItem("company_id")
    var product_id = $('#product_id').val()
    var formData = new FormData()
    formData.append("product_id", product_id)
    formData.append("company_id", company_id)
    formData.append("sub_id", sub_id)
    formData.append("uploadImage", archivo)
    formData.append("uploadImageMiniature", archivo)

    $.ajax({
        url:"/admin/upload",
        type: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData:false,
        success:function(data){
            $.each(data, function(key,value) {
                if (key == 'file_path'){
                    file_path = value
                }
                if (key == 'file_name'){
                    file_name = value
                }
                if (key == 'id'){
                    id = value
                }
                if (key == 'cover'){
                    cover = value
                }
            })

            complete_file = window.location.origin + '/' + file_path+file_name

            if (cover == 'S'){
                var clase = "base fas fa-star"
            } else {
                var clase = "base far fa-star"
            }
            html = '<article id="'+id+'">'
            html +=     '<img src="'+complete_file+'"></img>'
            html +=     '<div class="row">'
            html +=         '<div class="col-md-6 d-flex justify-content-center">'
            html +=             '<a class="eliminar_foto" alt="Eliminar Foto">'
            html +=                 '<input type="hidden" value="'+id+'">'
            html +=                 '<i class="far fa-trash-alt"></i>'
            html +=              '</a>'
            html +=         '</div>'
            html +=         '<div class="col-md-6 d-flex justify-content-center">'
            html +=             '<a class="cover" alt="Foto de Portada">'
            html +=                 '<input type="hidden" value="'+id+'">'
            html +=                 '<i id="star" name="'+id+'" class="'+clase+'"></i>'
            html +=             '</a>'
            html +=         '</div>'
            html +=     '</div>'
            html +='</article>'

            $('#gallery').append(html)
        }
    })
}
