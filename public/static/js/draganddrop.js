$(document).ready(function(){
    $("#uploadImage").css("display", "none");
    $("#uploadImageMiniature").css("display", "none");
    let progress = $('#progressbar')
    let span = $('#progressspan')
    $("drop").removeClass("droping")
    $("drop").addClass("drop")

})

let drop = document.getElementById('drop')

drop.addEventListener('dragenter', e =>{
    e.preventDefault()
    console.log('estoy adentro del drop')
})

drop.addEventListener('dragleave', e =>{
    e.preventDefault()
    console.log('estoy afuera del drop')
    drop.classList.remove('droping');
    drop.classList.add('drop');
})

drop.addEventListener('dragover', e =>{
    e.preventDefault()
    console.log('estoy encima del drop')
    drop.classList.remove('drop');
    drop.classList.add('droping');

})

drop.addEventListener('drop', e =>{
    e.preventDefault()

    drop.classList.remove('droping');
    drop.classList.add('drop');
    let archivos = Array.from(e.dataTransfer.files)
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
        data:  formData,
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
            })

            complete_file = '../../../'+file_path+file_name
            $('#gallery').append('<article><img src="'+complete_file+'"></img><i class="far fa-trash-alt" data-toggle="tooltip" data-placement="top" title="Eliminar Producto"></i></article>')
        }
    })
}

// let progress = document.querySelector('progress')
// let span = document.querySelector('span')
// let img = document.querySelector('img')
// progress.value = 0
// span.innerHTML = '0 %'

// let xhr = new XMLHttpRequest

// // para que cada vez que se ejecute sea diferente
// let urlSinCache = complete_file

// xhr.open('get', urlSinCache)
// xhr.responseType = 'blob'
// xhr.addEventListener('load', () => {
//     if (xhr.status == 200){
//         let imgBlob = xhr.response
//         let url = URL.createObjectURL(imgBlob)
//         console.log("200")
//         img.src = url
//     }else {
//         console.log("400")
//     }
// })

// xhr.addEventListener('progress', e => {
//     if (e.lengthComputable) {
//         console.log("aca")
//         let porcentaje = parseInt((e.loaded * 100) / e.total)
//         $('#progressspan').append("<div >"+porcentaje + " %</div>")
//         //span.innerHTML = porcentaje + '%'
//     }
// })
// xhr.send()
