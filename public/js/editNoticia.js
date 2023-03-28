
$(
  
  function (){

    tituloAntes="";
    descricaoAntes="";
    imagensAntes="";

    $(document).ready(function() {

      tituloAntes=$("#alterarTitulo").val();
      descricaoAntes=$("#alterarDescricao").val();
      imagensAntes=$("#imagemAdicionadas").html ();
      
    });
    function escondeMensagemErro(){

      $("#mensagemErroAlterar").hide();

    }
    // Mostar o alert com o erro
    function mensagemErro(mensagem){

      display= $("#mensagemErroAlterar").css("display");

      $("#mensagemErroAlterar").html(mensagem);

      if(display=== 'none'){
  
        $("#mensagemErroAlterar").show();
        
      }
      
    }
    

    // Mosta as imagens quando inseridas no input
    $("#alterarImagem").change(function(){

      $('#imagemAdicionadas').empty();  

      for(i=0; i < $(this)[0].files.length; i++){

        imagens=$(this)[0].files[i];
        
        src= URL.createObjectURL(imagens);

        $('#imagemAdicionadas').append("<img src='"+src+"'>");
        
      }
    });

    // Verifica se descricão e valida
    $("#alterarDescricao").keypress(function(){

      valor=$(this).val();

      if(valor.length>400){

        $(this).css("border-color", "red");
        mensagemErro("Descrição é grande demais!");

      }
    });

    // Verifica se descricão e valida
    $("#alterarTitulo").keypress(function(){

      valor=$(this).val();
      
      if(valor.length>100){

        $(this).css("border-color", "red");
        mensagemErro("Título é grande demais!");

      }
    });

    // Faz o link com input dos files
    $("#imagensEditInput").click(function(){

      $("#alterarImagem").click();

    });
    
    // Alterar noticia noticia
    $("#alterarNoticia").click(function(){

      // Variesveis recebidas
      titulo=$("#alterarTitulo").val();
      descricao=$("#alterarDescricao").val();
      imagem=$("#alterarImagem").val();
      idNoticia=$("#idNoticia").val();
      imagensExiste=$("#imagemAdicionadas").html ();

      // Verficando se variaveis são validas
      if(titulo=="" || titulo.length>100 || descricao=="" || descricao.length>400 || imagensExiste==""){

        if(titulo==""){

          $("#alterarTitulo").css("border-color", "red");
    
        }

        if(descricao==""){

          $("#alterarDescricao").css("border-color", "red");
    
        }
        
        if(imagensExiste==""){

          $("#imagemAdicionadas").css("background-color", "rgba(254, 174, 174, 0.7)");
    
        }

        mensagemErro("Preencha todos campos corretamente!");

      }else{

        // Faz form data para o Ajax
        dados= new FormData();
        if(imagem!=""){

          imagemData= $("#alterarImagem")[0].files[0];

        }else{

          imagemData="";

        }

        dados.append("titulo", titulo);
        dados.append("descricao", descricao);
        dados.append("imagem", imagemData);
        dados.append("idNoticia", idNoticia);

        // Envia os dados
        $.ajax({

          url:'noticia/alterarNoticia',
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
        
                  $("#alterarTitulo").css("border-color", "red");
            
                }
        
                if(descricao==""){
        
                  $("#alterarDescricao").css("border-color", "red");
            
                }
                
                if(imagem==""){
        
                  $("#imagemAdicionadas").css("background-color", "rgba(254, 174, 174, 0.7)");
            
                }
        
                mensagemErro("Preencha todos campos corretamente!");
        
              }

            }else if(resposta.indexOf("erro2")>-1){
              
              $("#alterarTitulo").css("border-color", "red");
              $("#imagemAdicionadas").css("background-color", "rgba(254, 174, 174, 0.7)");

              mensagemErro("Título ou nome da imagem já foram cadastrados!");

            }else if(resposta.indexOf("sucesso")>-1){

              location.reload();

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

    // Delvove os valores originais da noticia
    $("#cancelarAlteracao").click(function () { 
      
        $('#alterarTitulo').val(tituloAntes);
        $('#alterarDescricao').val(descricaoAntes);
        $('#imagensEditInput').val("");
        $('#imagemAdicionadas').html(imagensAntes);

    });

    $("#btnExcluirNoticia").click(function(){

      idNoticia=$("#idNoticia").val();

      if(idNoticia!==""){

        dados= new FormData();

        dados.append("idNoticia", idNoticia);

        $.ajax({

          url:'noticia/excluirNoticia',
          type: 'POST',
          data: dados,
          processData: false,
          contentType: false,
          success: function (resposta){

            if(resposta.indexOf("erro0")>-1){

              alert("Tente novamente mais tarde!");

            }else if(resposta.indexOf("sucesso")>-1){

              location.href="home";

            }

          },
          error: function(){

            alert("Tentte novamente mais tarde!");
          }

        });
      
      }
    });
    // Retorana ao normal
    $("#mensagemErroAlterar").click(function(){escondeMensagemErro();});
    
    $("#alterarDescricao").click(function(){$(this).css("border-color", "#ced4da"); escondeMensagemErro();});

    $("#alterarTitulo").click(function(){$(this).css("border-color", "#ced4da"); escondeMensagemErro();});

    $(".imagensAddOrf").click(function(){$("#imagemAdicionadas").css("background-color", "rgb(144, 143, 143, 0.70)"); escondeMensagemErro();});


  }
)