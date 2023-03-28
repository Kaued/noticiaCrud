
$(
  
  function (){

    function escondeMensagemErro(){

      $("#mensagemErroAdd").hide();

    }
    // Mostar o alert com o erro
    function mensagemErro(mensagem){

      display= $("#mensagemErroAdd").css("display");

      $("#mensagemErroAdd").html(mensagem);

      if(display=== 'none'){
  
        $("#mensagemErroAdd").show();
        
      }
      
    }
    

    // Mosta as imagens quando inseridas no input
    $("#addImagens").change(function(){

      $('#imagemAdicionadas').empty();  

      for(i=0; i < $(this)[0].files.length; i++){

        imagens=$(this)[0].files[i];
        
        src= URL.createObjectURL(imagens);

        $('#imagemAdicionadas').append("<img src='"+src+"'>");
        
      }
    });

    // Verifica se descricão e valida
    $("#addDescricao").keypress(function(){

      valor=$(this).val();

      
      if(valor.length>400){
        console.log(valor.length);
        $(this).css("border-color", "red");
        mensagemErro("Descrição é grande demais!");

      }
    });

    // Verifica se descricão e valida
    $("#addTitulo").keypress(function(){

      valor=$(this).val();

      if(valor.length>100){

        $(this).css("border-color", "red");
        mensagemErro("Título é grande demais!");

      }
    });

    // Faz o link com input dos files
    $("#imagensEditInput").click(function(){

      $("#addImagens").click();

    });
    
    // Adicionar a nova noticia
    $("#adicionarNoticia").click(function(){

      // Variesveis recebidas
      titulo=$("#addTitulo").val();
      descricao=$("#addDescricao").val();
      imagem=$("#addImagens").val();
      
      // Verficando se variaveis são validas
      if(titulo=="" || titulo.length>100 || descricao=="" || descricao.length>400 || imagem==""){

        if(titulo==""){

          $("#addTitulo").css("border-color", "red");
    
        }

        if(descricao==""){

          $("#addDescricao").css("border-color", "red");
    
        }
        
        if(imagem==""){

          $("#imagemAdicionadas").css("background-color", "rgba(254, 174, 174, 0.7)");
    
        }

        mensagemErro("Preencha todos campos corretamente!");

      }else{

        // Faz form data para o Ajax
        dados= new FormData();
        imagemData= $("#addImagens")[0].files[0];

        dados.append("titulo", titulo);
        dados.append("descricao", descricao);
        dados.append("imagem", imagemData);

        // Envia os dados
        $.ajax({

          url:'add/adicionar',
          type: 'POST',
          data: dados,
          processData: false,
          contentType: false,
          success: function (resposta){

            // Recebendo o resultado erro ou sucesso
            if(resposta.indexOf("erro0")>-1){

              mensagemErro("Tente novamente mais tarde!");

            }else if(resposta.indexOf("erro1")>-1){

              if(titulo=="" || titulo.length>100 || descricao=="" || descricao.length>400 || imagem==""){

                if(titulo==""){
        
                  $("#addTitulo").css("border-color", "red");
            
                }
        
                if(descricao==""){
        
                  $("#addDescricao").css("border-color", "red");
            
                }
                
                if(imagem==""){
        
                  $("#imagemAdicionadas").css("background-color", "rgba(254, 174, 174, 0.7)");
            
                }
        
                mensagemErro("Preencha todos campos corretamente!");
        
              }

            }else if(resposta.indexOf("erro2")>-1){
              
              $("#addTitulo").css("border-color", "red");
              $("#imagemAdicionadas").css("background-color", "rgba(254, 174, 174, 0.7)");

              mensagemErro("Título ou nome da imagem já foram cadastrados!");

            }else if(resposta.indexOf("sucesso")>-1){

              window.location.href="home";

            }else{

              mensagemErro("Tente novamente mais tarde");
            }
        
          },
          error: function(){

            mensagemErro("Tente novamente mais tarde");

          }

        });

      }

    });

    // DA
    $("#cancelarAdd").click(function () { 
      
      window.location.href = 'home';
    });
    // Retorana ao normal
    $("#mensagemErroAdd").click(function(){escondeMensagemErro();});
    
    $("#addDescricao").click(function(){$(this).css("border-color", "#ced4da"); escondeMensagemErro();});

    $("#addTitulo").click(function(){$(this).css("border-color", "#ced4da"); escondeMensagemErro();});

    $(".imagensAddOrf").click(function(){$("#imagemAdicionadas").css("background-color", "rgb(144, 143, 143, 0.70)"); escondeMensagemErro();});


  }
)