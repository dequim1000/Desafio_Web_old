

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChartRosquinha);

function drawChartRosquinha() {

    var tipos_call = google.visualization.arrayToDataTable([
      ['Tipo', 'CALL'],
      ['Restante',    parseInt(document.getElementById("restantesCall").value)],
      ['Utilizado',   parseInt(document.getElementById("usadosCall").value)],
      ['Extras',     0],
    ]);

    var quantidade_call = {
      pieHole: 0.1,
      pieSliceTextStyle: {
        color: 'white',
      },
      fill: {
        color: 'green'
      },
      legend: 'none', 
      color: 'green'
    };

    var chart_call = new google.visualization.PieChart(document.getElementById('donut_single_call'));
    chart_call.draw(tipos_call, quantidade_call);
}


var restante = 0;
var utilizado = 0;
//Alimentar os 2 primeiros gráficos e as tabelas de Resumo
function ApiRequest(){
    fetch("http://localhost/Desafio_Web/controllers/APIRequest.php").then(json=>json.json()).then(function(x){
        document.getElementById("usadosSms").innerHTML = x[0].Request;
        document.getElementById("restantesSms").innerHTML = x[0].Restante;
        document.getElementById("PlanNameSms").innerHTML = x[0].NamePlan;
        document.getElementById("PlanNameCall").innerHTML = x[1].NamePlan;
        document.getElementById("Utilizadocall").innerHTML = x[1].Request;
        document.getElementById("PriceCall").innerHTML = x[1].PriceCall;
        document.getElementById("ValorChamada").innerHTML = x[1].PriceToCall;
        
        if (x[1].Restante < 0){
            document.getElementById("restantesCall").value = 0;
            document.getElementById("Restantecall").innerHTML = 0
        }else{
            document.getElementById("restantesCall").value = x[1].Restante;
            document.getElementById("Restantecall").innerHTML = x[1].Restante;
        }

        document.getElementById("usadosCall").value = x[1].Request; 

        if (x[1].Extras > 0){
            document.getElementById("Extrascall").innerHTML = x[1].Extras; 
        }else{
            document.getElementById("Extrascall").innerHTML = 0;
        }
    });
    
    
}
var x = [];
onload = ApiRequest();
