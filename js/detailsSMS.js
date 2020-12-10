function pegardata(){
    
    var elemento = document.getElementById("data-plano").value;
        document.getElementById("data").innerHTML = elemento;
        var dataSms = elemento.split("-",2);
        
        let data = new FormData();
        data.append('ano',dataSms[0])
        data.append('mes',dataSms[1])        
        data.append('user',sessionStorage.getItem('user'))
        data.append('pass',sessionStorage.getItem('pass'))

        
            axios.post('http://localhost/Desafio_Web/controllers/DetailsSms.php',data).then(function (x){
                    document.getElementById("nameSms").innerHTML = x.data[0].NamePlan;
                    document.getElementById("UsadoSms").innerHTML = x.data[0].Request;
                    document.getElementById("RestSms").innerHTML = x.data[0].Restante;
                    Resquest = x.data[0].Request;
                    Restante = x.data[0].Restante;
                    SmsCredtis = (Number(Resquest) + Number(Restante))
                    document.getElementById("SmsContracted").innerHTML = SmsCredtis
                    document.getElementById("SmsTotal").innerHTML = SmsCredtis
            })
 }
