function pegardata(){
    
    var elemento = document.getElementById("data-plano").value;
        document.getElementById("data").innerHTML = elemento;
        var dataCall = elemento.split("-",2);
        
        let data = new FormData();
        data.append('ano',dataCall[0])
        data.append('mes',dataCall[1])        
        data.append('user',sessionStorage.getItem('user'))
        data.append('pass',sessionStorage.getItem('pass'))

        
            axios.post('http://localhost/Desafio_Web/controllers/DetailsCall.php',data).then(function (x){
                    document.getElementById("nameCalldetails").innerHTML = x.data[0].NamePlan;
                    document.getElementById("valormensalCalldetails").innerHTML = x.data[0].PriceCall;
                    document.getElementById("qtdeContratadaCall").innerHTML = x.data[0].ContractedQuantityCall;
                    document.getElementById("usadosCall").innerHTML = x.data[0].Request;
                    document.getElementById("disponivelCall").innerHTML = x.data[0].Restante;
                    document.getElementById("ExtrasCall").innerHTML = x.data[0].Extras;
                    document.getElementById("mesalCall").innerHTML =x.data[0].PriceCall;
                    document.getElementById("valoradcionalCalldetails").innerHTML = x.data[0].PriceToCall;
                    precoCallTo = x.data[0].PriceToCall;
                    precoCAll = x.data[0].PriceCall;
                    Restante=x.data[0].Restante;
                    if (Restante < 0){
                        QtdeExtras = x.data[0].Extras;
                        Extras = x.data[0].Extras;
                        document.getElementById("qtdeextraCalldetails").innerHTML = QtdeExtras;
                        document.getElementById("ExtrasCall").innerHTML = Extras;
                        valorExtra = (QtdeExtras * precoCallTo);
                        document.getElementById("valorExtraCall").innerHTML = valorExtra;
                        ValorTotal =  precoCAll + valorExtra;
                    }else{
                        document.getElementById("qtdeextraCalldetails").innerHTML = 0;
                        document.getElementById("ExtrasCall").innerHTML = 0;
                        document.getElementById("valorExtraCall").innerHTML = 0;
                        ValorTotal =  precoCAll
                    }
                    document.getElementById("valorTotalCall").innerHTML = ValorTotal
                    
                    /*
                     x[0].;
                    document.getElementById("valorTotalCall").innerHTML = x[0].;
                    */
            })
 }

