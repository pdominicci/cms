var base = location.protocol+'//'+location.host;

// document.addEventListener('DOMContentLoaded', function(){
    // var btn_product_file_image = document.getElementById('btn_product_file_image')
    // var product_file_image = document.getElementById('product_file_image')
    // btn_product_file_image.addEventListener('click', function(){
    //     product_file_image.click()

    // },false)
    // product_file_image.addEventListener('change', function(){
    //     document.getElementById('form_product_gallery').submit()
    // })
// })

$.ajaxSetup({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
});

$(document).ready(function(){
    var company_id = localStorage.getItem("company_id")
    $('[name="company_id"]').val(company_id)
    $('#company_id').val(company_id)

    //// combo anidado pais provincia
    $('#country').on('change',function(e) {
        var country_id = e.target.value;
        $.ajax({
            url:"/admin/state",
            type:"POST",
            data: {
                country_id: country_id
            },
            success:function(data){
                $('#state').empty().append('<option selected>Seleccionar Provincia</option>')
                $('#city').empty().append('<option selected="selected">Seleccionar Ciudad</option>')
                $('#company').empty().append('<option selected="selected">Seleccionar Empresa</option>')

                $.each(data.states[0].states,function(country,state){
                    $('#state').append('<option value="'+state.id+'">'+state.state+'</option>');
                })
            }
        })
    });

    $('#state').on('change',function(e) {
        var state_id = e.target.value;
        $.ajax({
            url:"/admin/city",
            type:"POST",
            data: {
                state_id: state_id
            },
            success:function(data){
                $('#city').empty().append('<option selected="selected">Seleccionar Ciudad</option>')
                $('#company').empty().append('<option selected="selected">Seleccionar Empresa</option>')
                $.each(data.cities[0].cities,function(state,city){
                    $('#city').append('<option value="'+city.id+'">'+city.city+'</option>');
                })
            }
        })
    });

    $('#city').on('change',function(e) {
        var city_id = e.target.value;
        $.ajax({
            url:"/admin/company",
            type:"POST",
            data: {
                city_id: city_id
            },
            success:function(data){
                $('#company').empty().append('<option selected="selected">Seleccionar Empresa</option>')
                $.each(data.companies,function(city,company){
                    $('#company').append('<option value="'+company.id+'">'+company.company+'</option>');
                })
            }
        })
    });

    // $('#email').on('change',function(e) {
    //     var email = e.target.value;
    // });

    editor_init('editor');


})

function editor_init(field){
    CKEDITOR.replace(field,{
        toolbar: [
            { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo']},
            { name: 'basicstyles', items: [ 'Bold'  , 'Italic', 'BulletedList', 'Strike', 'Image', 'Link', 'Unlink', 'Blockquote'] },
            { name: 'document', items: ['CodeSnippet', 'EmojiPanel', 'Preview', 'Source']}
        ]
    });
}





