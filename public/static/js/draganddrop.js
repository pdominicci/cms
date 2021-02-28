let drop = document.getElementById('drop')


drop.addEventListener('dragenter', e =>{
    e.preventDefault()
    console.log('estoy adentro del drop')
})

drop.addEventListener('dragleave', e =>{
    e.preventDefault()
    console.log('estoy afuera del drop')
})

drop.addEventListener('dragover', e =>{
    e.preventDefault()
    console.log('estoy encima del drop')
})

drop.addEventListener('drop', e =>{
    e.preventDefault()
    let archivos = Array.from(e.dataTransfer.files)
    console.log(archivos)
    archivos.forEach(archivo =>{
        upload(archivo)
    })
    console.log('hice un drop')
    // let archivo = e.dataTransfer.files[0].name
    // console.log(archivo)
    // cargarImagen(archivo)

})

function cargarImagen(archivo){
    // console.log("aaaaaaaa " +archivo)
    let progress = document.querySelector('progress')
    let span = document.querySelector('span')
    let img = document.querySelector('img')
    progress.value = 0
    span.innerHTML = '0 %'

    img.src = ''
    let xhr = new XMLHttpRequest

    // para que cada vez que se ejecute sea diferente
    let urlSinCache = archivo + '?' + Date.now()
    console.log("urlSinCache " + urlSinCache)

    xhr.open('get', urlSinCache)
    xhr.responseType = 'blob'
    xhr.addEventListener('load', () => {
        console.log("aaadddd")
        if (xhr.status == 200){
            let imgBlob = xhr.response
            let url = URL.createObjectURL(imgBlob)

            img.src = url
            console.log("url " + url)
        }
    })

    xhr.addEventListener('progress', e => {
        if (e.lengthComputable) {
            let porcentaje = parseInt((e.loaded * 100) / e.total)
            progress.value = porcentaje
            span.innerHTML = porcentaje + '%'

            console.log(porcentaje + '%')
        }
    })

    xhr.send()
}

function upload(archivo){
    var company_id = localStorage.getItem("company_id")

    var formData = new FormData()
    formData.append("company_id", company_id)
    formData.append("uploadImage", archivo)
    $.ajax({
            url:"/admin/upload",
            type: "POST",
            data:  formData,
            contentType: false,
                cache: false,
            processData:false,
            // beforeSend : function()
            // {
            // //$("#preview").fadeOut();
            // $("#err").fadeOut();
            // },
            // success: function(data)
            //     {
            // if(data=='invalid')
            // {
            // // invalid file format.
            // $("#err").html("Invalid File !").fadeIn();
            // }
            // else
            // {
            // // view uploaded file.
            // $("#preview").html(data).fadeIn();
            // $("#form")[0].reset();
            // }
            //     },
            // error: function(e)
            //     {
            // $("#err").html(e).fadeIn();
            //     }
            })
}

//    console.log("aaaaaaaaaaaaaaaaaac "+archivo.name)

    // //$("#image").attr("src",archivo);
    // $.ajax({
    //     url:"/admin/upload",
    //     type:"POST",
    //     data: {
    //         imagen: archivo
    //     },
    //     success:function(){


    //     }

