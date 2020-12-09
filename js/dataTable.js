google.charts.load('49', {'packages': ['vegachart']}).then(DataTabelaSMS);
google.charts.load('49', {'packages': ['vegachart']}).then(DataTabelaCALL);

//SMS
function drawChartTableSMS(t) {
      const dataTable_sms = new google.visualization.DataTable();
      dataTable_sms.addColumn({type: 'string', 'id': 'category'});
      dataTable_sms.addColumn({type: 'number', 'id': 'amount'});
      dataTable_sms.addRows(t);
      const options_sms = {
          "vega": {
          "$schema": "https://vega.github.io/schema/vega/v4.json",
          "padding": 1,

          'data': [{'name': 'table', 'source': 'datatable'}],

          "signals": [
              {
              "name": "tooltip",
              "value": {},
              "on": [
                  {"events": "rect:mouseover", "update": "datum"},
                  {"events": "rect:mouseout",  "update": "{}"}
              ]
              }
          ],

          "scales": [
              {
              "name": "xscale",
              "type": "band",
              "domain": {"data": "table", "field": "category"},
              "range": "width",
              "padding": 0.35,
              "round": true
              },
              {
              "name": "yscale",
              "domain": {"data": "table", "field": "amount"},
              "nice": true,
              "range": "height"
              }
          ],

          "axes": [
              { "orient": "bottom", "scale": "xscale" },
              { "orient": "left", "scale": "yscale" }
          ],

          "marks": [
              {
              "type": "rect",
              "from": {"data":"table"},
              "encode": {
                  "enter": {
                  "x": {"scale": "xscale", "field": "category"},
                  "width": {"scale": "xscale", "band": 1},
                  "y": {"scale": "yscale", "field": "amount"},
                  "y2": {"scale": "yscale", "value": 0}
                  },
                  "update": {
                  "fill": {"value": "rgb(37, 74, 104)"}
                  },
                  "hover": {
                  "fill": {"value": "firebrick"}
                  }
              }
              },
              {
              "type": "text",
              "encode": {
                  "enter": {
                  "align": {"value": "center"},
                  "baseline": {"value": "bottom"},
                  "fill": {"value": "#333"}
                  },
                  "update": {
                  "x": {"scale": "xscale", "signal": "tooltip.category", "band": 0.5},
                  "y": {"scale": "yscale", "signal": "tooltip.amount", "offset": -2},
                  "text": {"signal": "tooltip.amount"},
                  "fillOpacity": [
                      {"test": "datum === tooltip", "value": 0},
                      {"value": 1}
                  ]
                  }
              }
              }
          ]
          }
    };

    const chart_sms = new google.visualization.VegaChart(document.getElementById('chart-div_sms'));
    chart_sms.draw(dataTable_sms, options_sms);
    }

    //CALL
    function drawChartTableCall(t) {
        const dataTable_call = new google.visualization.DataTable();
        dataTable_call.addColumn({type: 'string', 'id': 'category'});
        dataTable_call.addColumn({type: 'number', 'id': 'amount'});
        dataTable_call.addRows(t);
        
        const options_call = {
            "vega": {
            "$schema": "https://vega.github.io/schema/vega/v4.json",
            "padding": 4,
        
            'data': [{'name': 'table', 'source': 'datatable'}],
        
            "signals": [
                {
                "name": "tooltip",
                "value": {},
                "on": [
                    {"events": "rect:mouseover", "update": "datum"},
                    {"events": "rect:mouseout",  "update": "{}"}
                ]
                }
            ],
        
            "scales": [
                {
                "name": "xscale",
                "type": "band",
                "domain": {"data": "table", "field": "category"},
                "range": "width",
                "padding": 0.35,
                "round": true
                },
                {
                "name": "yscale",
                "domain": {"data": "table", "field": "amount"},
                "nice": true,
                "range": "height"
                }
            ],
        
            "axes": [
                { "orient": "bottom", "scale": "xscale" },
                { "orient": "left", "scale": "yscale" }
            ],
        
            "marks": [
                {
                "type": "rect",
                "from": {"data":"table"},
                "encode": {
                    "enter": {
                    "x": {"scale": "xscale", "field": "category"},
                    "width": {"scale": "xscale", "band": 1},
                    "y": {"scale": "yscale", "field": "amount"},
                    "y2": {"scale": "yscale", "value": 0}
                    },
                    "update": {
                    "fill": {"value": "rgb(37, 74, 104)"}
                    },
                    "hover": {
                    "fill": {"value": "firebrick"}
                    }
                }
                },
                {
                "type": "text",
                "encode": {
                    "enter": {
                    "align": {"value": "center"},
                    "baseline": {"value": "bottom"},
                    "fill": {"value": "#333"}
                    },
                    "update": {
                    "x": {"scale": "xscale", "signal": "tooltip.category", "band": 0.5},
                    "y": {"scale": "yscale", "signal": "tooltip.amount", "offset": -2},
                    "text": {"signal": "tooltip.amount"},
                    "fillOpacity": [
                        {"test": "datum === tooltip", "value": 0},
                        {"value": 1}
                    ]
                    }
                }
                }
            ]
            }
        };
        
        const chart_call = new google.visualization.VegaChart(document.getElementById('chart-div_call'));
        chart_call.draw(dataTable_call, options_call);
    }
   
    function DataTabelaSMS(){
        
        fetch("http://localhost/Desafio_Web/controllers/MonthRequest_controllers.php").then(json=>json.json()).then(function(x){
                var dataTable_sms = new google.visualization.DataTable();
                dataTable_sms.addColumn({type: 'string', 'id': 'category'});
                dataTable_sms.addColumn({type: 'number', 'id': 'amount'});
                
                var usado = [];
                var somaSms = 0;
                var MediaSms = 0;
                var MediaSmsFormat = 0;
                x.forEach((el) => {
                    if (el.Url === '/api/sms/send'){
                        usado.push([el.Dtrequest,Number (el.Request)]);
                        somaSms = somaSms + Number(el.Request);
                    }
                });               
                drawChartTableSMS(usado);
                MediaSms = (somaSms/12);
                MediaSmsFormat = MediaSms.toFixed(2)
                document.getElementById("MediaSms").innerHTML = MediaSmsFormat;
                
        });
    }

    function DataTabelaCALL(){
        
        fetch("http://localhost/Desafio_Web/controllers/MonthRequest_controllers.php").then(json=>json.json()).then(function(x){
                var dataTable_sms = new google.visualization.DataTable();
                dataTable_sms.addColumn({type: 'string', 'id': 'category'});
                dataTable_sms.addColumn({type: 'number', 'id': 'amount'});
                var usado = [];
                var somaCall = 0;
                var MediaCall = 0;
                var MediacallFormat = 0;
                x.forEach((el) => {
                    if (el.Url === '/api/call/send'){
                    usado.push([el.Dtrequest,Number (el.Request)]);
                    somaCall = somaCall + Number(el.Request);
                    }
                });               
                drawChartTableCall(usado);
                MediaCall = (somaCall/12);
                MediacallFormat = MediaCall.toFixed(2)
                document.getElementById("MediaCall").innerHTML = MediacallFormat;
        });
    }
 
    
