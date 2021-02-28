$(document).ready(function(){
    $('#divcompanies').hide()
    $('#usercompanies').hide()
    $("#btnlogin").attr("disabled", true)

    $('#email').on('change',function(e) {
        var email = e.target.value;
        $.ajax({
            url:"/admin/usercompanies",
            type:"POST",
            data: {
                email: email
            },
            success:function(data){
                $('#usercompanies').empty()
                $('#divcompanies').empty()

                if(email){
                    var cant = 0
                    $.each(data,function(c,company){
                        cant++
                    })
                    if(cant == 1){
                        $('#divcompanies').show()
                        $('#usercompanies').hide()

                        $.each(data,function(c,company){
                            habilitarbotonlogin(company.company_id)
                            $('#divcompanies').append('<option value="'+company.company_id+'">'+company.company+'</option>').attr("disabled", true)
                        })
                    } else
                         if(cant == 0){
                            $('#divcompanies').show()
                            $('#usercompanies').hide()
                            $('#divcompanies').append('<div>Ingrese un email válido.</div>').attr("disabled", true)
                        } else {
                            $('#divcompanies').hide()
                            $('#usercompanies').show()
                            $('#usercompanies').append('<option value="0">Seleccione una Empresa</option>')
                            $.each(data,function(c,company){
                                $('#usercompanies').append('<option value="'+company.company_id+'">'+company.company+'</option>').attr("disabled", false)
                            })
                        }
                }else {
                    $('#divcompanies').show()
                    $('#usercompanies').hide()
                    habilitarbotonlogin(0)
                    $('#divcompanies').append('Por favor, Ingrese un Email')
                }
            }
        })

    })

    $('#usercompanies').on('change',function(e) {
        var company_id = e.target.value
        habilitarbotonlogin(company_id)
    });
})
function habilitarbotonlogin(company_id){
    if (company_id) {
        $("#btnlogin").attr("disabled", false)
        localStorage.setItem('company_id', company_id)
    } else {
        $("#btnlogin").attr("disabled", true)
    }
}
