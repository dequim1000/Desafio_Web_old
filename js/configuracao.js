function deleta(exclui){
    let data = new FormData();
    data.append('tipo',3)
    data.append('idClient',sessionStorage.getItem('idClient'))
    data.append('idApi',Number(exclui));
    axios.post('http://localhost/Desafio_Web/controllers/Provedor.php',data).then(function (x){
        provedor();
    });
}

function provedor() {
    let data = new FormData();
    data.append('tipo',2)
    data.append('idClient',sessionStorage.getItem('idClient'))
    axios.post('http://localhost/Desafio_Web/controllers/Provedor.php',data).then(function (x){
        document.getElementById('text').innerHTML = "";
        x.data.forEach((e) => {
            var lixeira = document.createElement("a");
            lixeira.id = 'lixeira';

            var icone = document.createElement("i");
            icone.id = 'iconLixeira';
            icone.innerHTML = `<a id="${e.idApi}" onclick="deleta(this.id)" href="#"><i class="far fa-trash-alt iconeLixeira"></i></a>`;

            lixeira.appendChild(icone);

            var newValue = document.createElement('ul');
            newValue.id = 'ulText'
            var name = document.createElement("ul");
            name.appendChild(document.createTextNode(e.name));

            var user = document.createElement("ul");
            user.appendChild(document.createTextNode(e.user));
            
            var pass = document.createElement("ul")            
            pass.appendChild(document.createTextNode(e.pass));
            
            
            newValue.appendChild(name);
            newValue.appendChild(user);
            newValue.appendChild(pass);
            newValue.appendChild(lixeira);
            

            document.getElementById('text').insertAdjacentElement('beforeend', newValue);
        });
    
    });
}

let button = document.querySelector('form button.btn');
    button.addEventListener("click", () =>{
        let data = new FormData();
        data.append('tipo',1)
        data.append('user',document.getElementById('provedorEmail').value)
        data.append('pass',document.getElementById('provedorSenha').value)
        data.append('ApiId',Number(document.getElementById('provedores').value))
        data.append('idClient',sessionStorage.getItem('idClient'))
        
        

        if (document.getElementById("provedorEmail").value  != ""){
            axios.post('http://localhost/Desafio_Web/controllers/Provedor.php',data).then(function (x){
                window.location.reload();
                provedor();     
               
            })
        }else{
            document.querySelector("#userHide").hidden = false;
        }   
})
onload = provedor();