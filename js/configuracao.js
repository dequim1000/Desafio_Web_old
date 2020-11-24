

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