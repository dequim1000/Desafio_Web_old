function pegardata(){
    
    var elemento = document.getElementById("data-plano").value;
        document.getElementById("data").innerHTML = elemento;
        var dataSms = elemento.split("-",2);
        
        let data = new FormData();
        data.append('ano',dataSms[0])
        data.append('mes',dataSms[1])        
        data.append('user',sessionStorage.getItem('user'))
        data.append('pass',sessionStorage.getItem('pass'))
        data.append('idClient',sessionStorage.getItem('idClient'))

        
            axios.post('http://localhost/Desafio_Web/controllers/DetailsSms.php',data).then(function (x){
            try {
                document.getElementById("nameSms").innerHTML = "";
                document.getElementById("UsadoSms").innerHTML = x.data[0].Request;
                document.getElementById("RestSms").innerHTML = x.data[0].Restante;
                Resquest = x.data[0].Request;
                Restante = x.data[0].Restante;
                SmsCredtis = (Number(Resquest) + Number(Restante))
                document.getElementById("SmsContracted").innerHTML = SmsCredtis
                document.getElementById("SmsTotal").innerHTML = SmsCredtis
            } catch (error) {
                alert("Nenhum SMS encontrado nessa data");
                document.getElementById("nameSms").innerHTML = "";
                document.getElementById("UsadoSms").innerHTML = "";
                document.getElementById("RestSms").innerHTML = "";
                Resquest = x.data[0].Request;
                Restante = x.data[0].Restante;
                SmsCredtis = (Number(Resquest) + Number(Restante))
                document.getElementById("SmsContracted").innerHTML = ""
                document.getElementById("SmsTotal").innerHTML = ""
            }
                    
            }).catch(function(x){
                document.getElementById("nameSms").innerHTML = "";
                document.getElementById("UsadoSms").innerHTML = "";
                document.getElementById("RestSms").innerHTML = "";
                Resquest = x.data[0].Request;
                Restante = x.data[0].Restante;
                SmsCredtis = (Number(Resquest) + Number(Restante))
                document.getElementById("SmsContracted").innerHTML = ""
                document.getElementById("SmsTotal").innerHTML = ""
            });
 }
