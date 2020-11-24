function helpEmail(){
    if (document.getElementById("inputEmail").value  != ""){
        document.querySelector("#emailHelp").hidden = true;
    }else{
        document.querySelector("#emailHelp").hidden = false;
    }
}

let button = document.querySelector('form button.btn');
    button.addEventListener("click", () =>{
        let data = new FormData();
        data.append('user',document.getElementById('inputEmail').value)
        data.append('pass',document.getElementById('inputSenha').value)
        

        if (document.getElementById("inputEmail").value  != ""){
            axios.post('http://localhost/Desafio_Web/controllers/Usuario.php',data).then(function (x){
                if(x.data.resposta ==1){
                    location.href = "views/dashboard.html"
                    sessionStorage.setItem('user',document.getElementById('inputEmail').value)
                    sessionStorage.setItem('pass',document.getElementById('inputSenha').value)
                }else{
                    document.querySelector("#passError").hidden = false;
                }
            })
        }else{
            document.querySelector("#emailHide").hidden = false;
        }

        
       
})

