/*$(document).ready(() => {
  $('#charge').change(() => {
    if ($('#charge').val() === '1') {
      $('#medic-especiality').css("display", "");
    } else {
      $("#medic-especiality").css("display", "none");
    }
  });
});*/

    function buscaEndereco(value)
    {
        //if (cep.length != 8)
          //  return;

        $.ajax({

            url: 'buscaEndereco.php',
            type: 'GET',
            data: {
                cep: value
            },
            async: true,
            dataType: 'json',         
            success: function(result) {

                // Neste exemplo, como dataType foi definido para o valor 'json', então a conversão
                // da string para um objeto JavaScript é realizada automaticamente.

                // NOTA IMPORTANTE 1: Entretanto, todo conteúdo gerado
                // pelo script PHP precisa ser convertido para JSON (no servidor, em PHP).
                // Caso contrário, teremos um erro de conversão para 
                // JSON no JavaScript/jQuery, o que faz com que esta parte
                // do código (success:) não seja executada, mas sim a parte 
                // definida em 'error:'. Isto pode acontecer mesmo
                // quando o script PHP termina sem gerar erros.

                // NOTA IMPORTANTE 2: Em algumas situações esta funçao pode ser
                // executada mesmo quando o script PHP não termina com sucesso 
                // (por exemplo, quando ocorrem erros de sintaxe na linguagem PHP). Isto acontece
                // porque o PHP (em conjunto com o servidor web) pode retornar
                // o código de STATUS '200-OK' mesmo quando há erros/warnings no script.        

                if (result != "")
                {                  
                    result.forEach(doc => {
                        document.forms[0]["address"].value = doc.rua;
                        document.forms[0]["neighborhood"].value = doc.bairro;
                        document.forms[0]["city"].value = doc.cidade;
                });
                } else {
                        document.forms[0]["neighborhood"].value = "he";
                        document.forms[0]["city"].value = "he";
                    //document.forms[0]["address"].value  = result.rua;
                    }
                
            },

            error: function(xhr, textStatus, error) {
                // xhr é o objecto XMLHttpRequest
                alert(textStatus + error + xhr.responseText);
            }

        });  

      }