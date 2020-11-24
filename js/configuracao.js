

function provedor() {
    var select = document.getElementById('provedores');
    var option = select.options[select.selectedIndex];

    var lixeira = document.createElement("a");
    lixeira.id = 'lixeira';

    var icone = document.createElement("i");
    icone.id = 'iconLixeira';
    icone.innerHTML = '<a href="#"><i class="far fa-trash-alt iconeLixeira"></i></a>';

    lixeira.appendChild(icone);

    var newValue = document.createElement('ul');
    newValue.id = 'ulText'
    newValue.appendChild(document.createTextNode(option.text));
    
    newValue.appendChild(lixeira);

    document.getElementById('text').insertAdjacentElement('beforeend', newValue);
}

let button = document.querySelector('form button.btn');
    button.addEventListener("click", () =>{
        let data = new FormData();
        data.append('user',document.getElementById('provedorEmail').value)
        data.append('pass',document.getElementById('provedorSenha').value)
        data.append('name',document.getElementById('provedores').value)
        

        if (document.getElementById("provedorEmail").value  != ""){
            axios.post('http://localhost/Desafio_Web_2.0/controllers/Provedor.php',data).then(function (x){
                if(x.data.resposta ==1){
                    provedor();
                    sessionStorage.setItem('user',document.getElementById('provedorEmail').value)
                    sessionStorage.setItem('pass',document.getElementById('provedorSenha').value)
                    sessionStorage.setItem('name',document.getElementById('provedores').value)
                }else{
                    document.querySelector("#provedorError").hidden = false;
                }
            })
        }else{
            document.querySelector("#userHide").hidden = false;
        }   
})