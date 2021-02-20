$(document).ready(function(){
    $('#email').on('change',function(e) {
        var email = e.target.value;
        $.ajax({
            url:"/admin/usercompanies",
            type:"POST",
            data: {
                email: email
            },
            success:function(data){
                console.log(data)
                $('#usercompanies').empty()
                var cant = 0

                $.each(data,function(c,company){
                    cant++
                })
                if (cant == 1){
                    $.each(data,function(c,company){
                        $('#usercompanies').append('<option value="'+company.id+'">'+company.company+'</option>').attr("disabled", true)
                    })
                } else {
                    $('#usercompanies').empty().append('<option selected="selected">Seleccionar Empresa</option>')
                    $.each(data,function(c,company){
                        //console.log("data "+company.id)
                        $('#usercompanies').append('<option value="'+company.id+'">'+company.company+'</option>').attr("disabled", false)
                    })
                }
            }
        })
    });
})
