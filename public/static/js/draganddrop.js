$(document).ready(function(){
    $("#uploadImage").css("display", "none")
    $("#uploadImageMiniature").css("display", "none")
    let progress = $('#progressbar')
    let span = $('#progressspan')
    $("drop").removeClass("droping")
    $("drop").addClass("open")

    // puse dos veces este codigo del click del eliminar foto porque
    // si lo declaraba una solamente aca cuando hacia el upload de la foto
    // no me tomaba el evento y si lo declaraba solamente arriba no me tomaba
    // el evento onclick para las fotos que ya estaban cargadas
    $('.eliminar_foto').on('click',function(e) {
        var hijo = $(this).children('input')[0]
        var id = hijo['value']
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
    })
})


let drop = document.getElementById('drop')
let open_file = document.getElementById('open_file')
let counter = 0
drop.addEventListener('dragenter', e =>{
    e.preventDefault()
    counter++
    drop.classList.remove('open');
    $('#open_label').hide()
    drop.classList.add('droping');
})

drop.addEventListener('dragleave', e =>{
    e.preventDefault()
    counter--
    if (counter == 0) {
        drop.classList.remove('droping');
        drop.classList.add('open');
    }
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
    $('#open_label').show()
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
            })

            complete_file = window.location.origin + '/' + file_path+file_name
            $('#gallery').append('<article id="'+id+'"><img src="'+complete_file+'"></img><a class="eliminar_foto"><input type="hidden" value="'+id+'"><i class="far fa-trash-alt"></i></a></article>')

            $('.eliminar_foto').on('click',function(e) {
                var hijo = $(this).children('input')[0]
                var id = hijo['value']
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
            })
        }
    })
}
