$(function () {
    
    function removeCampo() {
        $(".removerCampo").unbind("click");
        $(".removerCampo").bind("click", function () {
            /*CONDIÇÃO QUE PERMITE FAZER A EXCLUSÃO DA LINHA APARTIR DA SEGUNDA LINHA >1*/
            if ($("tr.linhas").length > 1) {
                $(this).parent().parent().remove();
            }

        });
    }

    $(".adicionarCampo").click(function () {
        novoCampo = $("tr.linhas:first").clone();
        novoCampo.find("input").val("");
        novoCampo.find("select").val("");
        novoCampo.insertAfter("tr.linhas:last");
        removeCampo();
    });
     
    function removeCampoRES() {
        $(".removerCampoRES").unbind("click");
        $(".removerCampoRES").bind("click", function () {
            /*CONDIÇÃO QUE PERMITE FAZER A EXCLUSÃO DA LINHA APARTIR DA SEGUNDA LINHA >1*/
            if ($("tr.linhasRES").length > 1) {
                $(this).parent().parent().remove();
            }
        });
    }

    $(".adicionarCampoRES").click(function () {
        novoCampo = $("tr.linhasRES:first").clone();
        novoCampo.find("input").val("");
        novoCampo.find("select").val("");
        novoCampo.insertAfter("tr.linhasRES:last");
        removeCampoRES();
    });
    
    function removeCampoTEL() {
        $(".removerCampoTEL").unbind("click");
        $(".removerCampoTEL").bind("click", function () {
            /*CONDIÇÃO QUE PERMITE FAZER A EXCLUSÃO DA LINHA APARTIR DA SEGUNDA LINHA >1*/
            if ($("tr.linhasTEL").length > 1) {
                $(this).parent().parent().remove();
            }
        });
    }

    $(".adicionarCampoTEL").click(function () {
        novoCampo = $("tr.linhasTEL:first").clone();
        novoCampo.find("input").val("");
        novoCampo.find("select").val("");
        novoCampo.insertAfter("tr.linhasTEL:last");
        removeCampoTEL();
    });
    
    function removeCampoEMAIL() {
        $(".removerCampoEMAIL").unbind("click");
        $(".removerCampoEMAIL").bind("click", function () {
            /*CONDIÇÃO QUE PERMITE FAZER A EXCLUSÃO DA LINHA APARTIR DA SEGUNDA LINHA >1*/
            if ($("tr.linhasEMAIL").length > 1) {
                $(this).parent().parent().remove();
            }
        });
    }

    $(".adicionarCampoEMAIL").click(function () {
        novoCampo = $("tr.linhasEMAIL:first").clone();
        novoCampo.find("input").val("");
        novoCampo.find("select").val("");
        novoCampo.insertAfter("tr.linhasEMAIL:last");
        removeCampoEMAIL();
    });

});
/*
 * exemplo
  
  <div class="form-group">
 <label class="col-xs-2 col-xs-2 control-label">Telefone Adicionais</label>
 <table class="col-xs-6">
 <tr> 
 <td class="col-xs-11" >&nbsp;</td>
 <td class="col-xs-1" align="right">
 <a href="#" class="adicionarCampo" title="Adicionar item">
 Adicionar 
 </a>
 </td>                    
 </tr>
 
 <tr class="linhas"> 
 <td class="col-xs-11"> 
 <input type="text" name="telefone[]" value="" class="form-control" required/>  
 </td>  
 <td class="col-xs-1" align="right">
 <a href="#" class="removerCampo" title="Remover item" >
 Remover
 </a>
 </td>
 </tr> 
 </table>
 </div>
 
 */