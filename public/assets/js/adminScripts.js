//**// AdminCharts //**//
document.addEventListener("DOMContentLoaded", () => {
    dashboardCharts = {
    initDashboardPageCharts: function () {
        gradientChartOptionsConfigurationWithTooltipPurple = {
            maintainAspectRatio: false,
            legend: {
                display: false
            },

            tooltips: {
                backgroundColor: '#f5f5f5',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },
            responsive: true,
            scales: {
                yAxes: [{
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(29,140,248,0.0)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        suggestedMin: 60,
                        suggestedMax: 125,
                        padding: 20,
                        fontColor: "#9a9a9a"
                    }
                }],

                xAxes: [{
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(225,78,202,0.1)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        padding: 20,
                        fontColor: "#9a9a9a"
                    }
                }]
            }
        };

        gradientChartOptionsConfigurationWithTooltipGreen = {
            maintainAspectRatio: false,
            legend: {
                display: false
            },

            tooltips: {
                backgroundColor: '#f5f5f5',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },
            responsive: true,
            scales: {
                yAxes: [{
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(29,140,248,0.0)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        suggestedMin: 50,
                        suggestedMax: 125,
                        padding: 20,
                        fontColor: "#9e9e9e"
                    }
                }],

                xAxes: [{
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(0,242,195,0.1)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        padding: 20,
                        fontColor: "#9e9e9e"
                    }
                }]
            }
        };

        gradientBarChartConfiguration = {
            maintainAspectRatio: false,
            legend: {
                display: false
            },

            tooltips: {
                backgroundColor: '#f5f5f5',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },
            responsive: true,
            scales: {
                yAxes: [{

                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(29,140,248,0.1)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        suggestedMin: 60,
                        suggestedMax: 120,
                        padding: 20,
                        fontColor: "#9e9e9e"
                    }
                }],

                xAxes: [{

                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(29,140,248,0.1)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        padding: 20,
                        fontColor: "#9e9e9e"
                    }
                }]
            }
        };

        // Incomes Chart
        var ctx = document.getElementById("chartLinePurple").getContext("2d");
        var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);
        gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
        gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors

        var data = {
            labels: lastmonths,
            datasets: [{
                label: "Total",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: '#d048b6',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#d048b6',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#d048b6',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: lastincomes,
            }]
        };

        var incomesChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: gradientChartOptionsConfigurationWithTooltipPurple
        });


        // Expenses Chart
        var ctxGreen = document.getElementById("chartLineGreen").getContext("2d");
        var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);
        gradientStroke.addColorStop(1, 'rgba(66,134,121,0.15)');
        gradientStroke.addColorStop(0.4, 'rgba(66,134,121,0.0)'); //green colors
        gradientStroke.addColorStop(0, 'rgba(66,134,121,0)'); //green colors

        var data = {
            labels: lastmonths,
            datasets: [{
                label: "Total",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: '#00d6b4',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#00d6b4',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#00d6b4',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: lastexpenses,
            }]
        };

        var expensesChart = new Chart(ctxGreen, {
            type: 'line',
            data: data,
            options: gradientChartOptionsConfigurationWithTooltipGreen
        });

        // Anual Performance Chart
        var chart_labels = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
        var ctx = document.getElementById("chartBig1").getContext('2d');

        var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);
        gradientStroke.addColorStop(1, 'rgba(72,72,176,0.1)');
        gradientStroke.addColorStop(0.4, 'rgba(72,72,176,0.0)');
        gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors

        var config = {
            type: 'line',
            data: {
                labels: chart_labels,
                datasets: [{
                    label: "Total",
                    fill: true,
                    backgroundColor: gradientStroke,
                    borderColor: '#d346b1',
                    borderWidth: 2,
                    borderDash: [],
                    borderDashOffset: 0.0,
                    pointBackgroundColor: '#d346b1',
                    pointBorderColor: 'rgba(255,255,255,0)',
                    pointHoverBackgroundColor: '#d346b1',
                    pointBorderWidth: 20,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 15,
                    pointRadius: 4,
                    data: anualproducts,
                }]
            },
            options: gradientChartOptionsConfigurationWithTooltipPurple
        };
        
        var myChartData = new Chart(ctx, config);
        $("#0").click(function () {
            var chart_data = anualproducts;
            var data = myChartData.config.data;
            data.datasets[0].data = chart_data;
            data.labels = chart_labels;
            myChartData.update();
        });
        $("#1").click(function () {
            var chart_data = anualsales;
            var data = myChartData.config.data;
            data.datasets[0].data = chart_data;
            data.labels = chart_labels;
            myChartData.update();
        });

        $("#2").click(function () {
            var chart_data = anualclients;
            var data = myChartData.config.data;
            data.datasets[0].data = chart_data;
            data.labels = chart_labels;
            myChartData.update();
        });


        // Monthly Balance Chart
        var ctx = document.getElementById("CountryChart").getContext("2d");
        var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);
        gradientStroke.addColorStop(1, 'rgba(29,140,248,0.2)');
        gradientStroke.addColorStop(0.4, 'rgba(29,140,248,0.0)');
        gradientStroke.addColorStop(0, 'rgba(29,140,248,0)'); //blue colors


        var monthlyBalanceChart = new Chart(ctx, {
            type: 'bar',
            responsive: true,
            legend: {
                display: false
            },
            data: {
                labels: methods,
                datasets: [{
                    label: "Total",
                    fill: true,
                    backgroundColor: gradientStroke,
                    hoverBackgroundColor: gradientStroke,
                    borderColor: '#1f8ef1',
                    borderWidth: 2,
                    borderDash: [],
                    borderDashOffset: 0.0,
                    data: methods_stats,
                }]
            },
            options: gradientBarChartConfiguration
        });

    },
};
});
//**// slimselect //**//
!function(e,t){"object"==typeof exports&&"object"==typeof module?module.exports=t():"function"==typeof define&&define.amd?define([],t):"object"==typeof exports?exports.SlimSelect=t():e.SlimSelect=t()}(window,function(){return(s={},n.m=i=[function(e,t,i){"use strict";function s(e,t){t=t||{bubbles:!1,cancelable:!1,detail:void 0};var i=document.createEvent("CustomEvent");return i.initCustomEvent(e,t.bubbles,t.cancelable,t.detail),i}var n;t.__esModule=!0,t.hasClassInTree=function(e,t){function s(e,t){return t&&e&&e.classList&&e.classList.contains(t)?e:null}return s(e,t)||function e(t,i){return t&&t!==document?s(t,i)?t:e(t.parentNode,i):null}(e,t)},t.ensureElementInView=function(e,t){var i=e.scrollTop+e.offsetTop,s=i+e.clientHeight,n=t.offsetTop,a=n+t.clientHeight;n<i?e.scrollTop-=i-n:s<a&&(e.scrollTop+=a-s)},t.putContent=function(e,t,i){var s=e.offsetHeight,n=e.getBoundingClientRect(),a=i?n.top:n.top-s,l=i?n.bottom:n.bottom+s;return a<=0?"below":l>=window.innerHeight?"above":i?t:"below"},t.debounce=function(n,a,l){var o;return void 0===a&&(a=100),void 0===l&&(l=!1),function(){for(var e=[],t=0;t<arguments.length;t++)e[t]=arguments[t];var i=self,s=l&&!o;clearTimeout(o),o=setTimeout(function(){o=null,l||n.apply(i,e)},a),s&&n.apply(i,e)}},t.isValueInArrayOfObjects=function(e,t,i){if(!Array.isArray(e))return e[t]===i;for(var s=0,n=e;s<n.length;s++){var a=n[s];if(a&&a[t]&&a[t]===i)return!0}return!1},t.highlight=function(e,t,i){var s=e,n=new RegExp("("+t.trim()+")(?![^<]*>[^<>]*</)","i");if(!e.match(n))return e;var a=e.match(n).index,l=a+e.match(n)[0].toString().length,o=e.substring(a,l);return s=s.replace(n,'<mark class="'+i+'">'+o+"</mark>")},"function"!=typeof(n=window).CustomEvent&&(s.prototype=n.Event.prototype,n.CustomEvent=s)},function(e,t,i){"use strict";t.__esModule=!0;var s=(n.prototype.newOption=function(e){return{id:e.id?e.id:String(Math.floor(1e8*Math.random())),value:e.value?e.value:"",text:e.text?e.text:"",innerHTML:e.innerHTML?e.innerHTML:"",selected:!!e.selected&&e.selected,display:void 0===e.display||e.display,disabled:!!e.disabled&&e.disabled,placeholder:!!e.placeholder&&e.placeholder,class:e.class?e.class:void 0,data:e.data?e.data:{}}},n.prototype.add=function(e){this.data.push({id:String(Math.floor(1e8*Math.random())),value:e.value,text:e.text,innerHTML:"",selected:!1,display:!0,disabled:!1,placeholder:!1,class:void 0,data:{}})},n.prototype.parseSelectData=function(){this.data=[];for(var e=0,t=this.main.select.element.childNodes;e<t.length;e++){var i=t[e];if("OPTGROUP"===i.nodeName){for(var s={label:i.label,options:[]},n=0,a=i.childNodes;n<a.length;n++){var l=a[n];if("OPTION"===l.nodeName){var o=this.pullOptionData(l);s.options.push(o),o.placeholder&&""!==o.text.trim()&&(this.main.config.placeholderText=o.text)}}this.data.push(s)}else"OPTION"===i.nodeName&&(o=this.pullOptionData(i),this.data.push(o),o.placeholder&&""!==o.text.trim()&&(this.main.config.placeholderText=o.text))}},n.prototype.pullOptionData=function(e){return{id:!!e.dataset&&e.dataset.id||String(Math.floor(1e8*Math.random())),value:e.value,text:e.text,innerHTML:e.innerHTML,selected:e.selected,disabled:e.disabled,placeholder:"true"===e.dataset.placeholder,class:e.className,style:e.style.cssText,data:e.dataset}},n.prototype.setSelectedFromSelect=function(){if(this.main.config.isMultiple){for(var e=[],t=0,i=this.main.select.element.options;t<i.length;t++){var s=i[t];if(s.selected){var n=this.getObjectFromData(s.value,"value");n&&n.id&&e.push(n.id)}}this.setSelected(e,"id")}else{var a=this.main.select.element;if(-1!==a.selectedIndex){var l=a.options[a.selectedIndex].value;this.setSelected(l,"value")}}},n.prototype.setSelected=function(e,t){void 0===t&&(t="id");for(var i=0,s=this.data;i<s.length;i++){var n=s[i];if(n.hasOwnProperty("label")){if(n.hasOwnProperty("options")){var a=n.options;if(a)for(var l=0,o=a;l<o.length;l++){var r=o[l];r.placeholder||(r.selected=this.shouldBeSelected(r,e,t))}}}else n.selected=this.shouldBeSelected(n,e,t)}},n.prototype.shouldBeSelected=function(e,t,i){if(void 0===i&&(i="id"),Array.isArray(t))for(var s=0,n=t;s<n.length;s++){var a=n[s];if(i in e&&String(e[i])===String(a))return!0}else if(i in e&&String(e[i])===String(t))return!0;return!1},n.prototype.getSelected=function(){for(var e={text:""},t=[],i=0,s=this.data;i<s.length;i++){var n=s[i];if(n.hasOwnProperty("label")){if(n.hasOwnProperty("options")){var a=n.options;if(a)for(var l=0,o=a;l<o.length;l++){var r=o[l];r.selected&&(this.main.config.isMultiple?t.push(r):e=r)}}}else n.selected&&(this.main.config.isMultiple?t.push(n):e=n)}return this.main.config.isMultiple?t:e},n.prototype.addToSelected=function(e,t){if(void 0===t&&(t="id"),this.main.config.isMultiple){var i=[],s=this.getSelected();if(Array.isArray(s))for(var n=0,a=s;n<a.length;n++){var l=a[n];i.push(l[t])}i.push(e),this.setSelected(i,t)}},n.prototype.removeFromSelected=function(e,t){if(void 0===t&&(t="id"),this.main.config.isMultiple){for(var i=[],s=0,n=this.getSelected();s<n.length;s++){var a=n[s];String(a[t])!==String(e)&&i.push(a[t])}this.setSelected(i,t)}},n.prototype.onDataChange=function(){this.main.onChange&&this.isOnChangeEnabled&&this.main.onChange(JSON.parse(JSON.stringify(this.getSelected())))},n.prototype.getObjectFromData=function(e,t){void 0===t&&(t="id");for(var i=0,s=this.data;i<s.length;i++){var n=s[i];if(t in n&&String(n[t])===String(e))return n;if(n.hasOwnProperty("options")){var a=n;if(a.options)for(var l=0,o=a.options;l<o.length;l++){var r=o[l];if(String(r[t])===String(e))return r}}}return null},n.prototype.search=function(n){if(""!==(this.searchValue=n).trim()){var a=this.main.config.searchFilter,e=this.data.slice(0);n=n.trim();var t=e.map(function(e){if(e.hasOwnProperty("options")){var t=e,i=[];if(t.options&&(i=t.options.filter(function(e){return a(e,n)})),0!==i.length){var s=Object.assign({},t);return s.options=i,s}}return e.hasOwnProperty("text")&&a(e,n)?e:null});this.filtered=t.filter(function(e){return e})}else this.filtered=null},n);function n(e){this.contentOpen=!1,this.contentPosition="below",this.isOnChangeEnabled=!0,this.main=e.main,this.searchValue="",this.data=[],this.filtered=null,this.parseSelectData(),this.setSelectedFromSelect()}function r(e){return void 0!==e.text||(console.error("Data object option must have at least have a text value. Check object: "+JSON.stringify(e)),!1)}t.Data=s,t.validateData=function(e){if(!e)return console.error("Data must be an array of objects"),!1;for(var t=0,i=0,s=e;i<s.length;i++){var n=s[i];if(n.hasOwnProperty("label")){if(n.hasOwnProperty("options")){var a=n.options;if(a)for(var l=0,o=a;l<o.length;l++){r(o[l])||t++}}}else r(n)||t++}return 0===t},t.validateOption=r},function(e,t,i){"use strict";t.__esModule=!0;var s=i(3),n=i(4),a=i(5),l=i(1),o=i(0),r=(c.prototype.validate=function(e){var t="string"==typeof e.select?document.querySelector(e.select):e.select;if(!t)throw new Error("Could not find select element");if("SELECT"!==t.tagName)throw new Error("Element isnt of type select");return t},c.prototype.selected=function(){if(this.config.isMultiple){for(var e=[],t=0,i=n=this.data.getSelected();t<i.length;t++){var s=i[t];e.push(s.value)}return e}var n;return(n=this.data.getSelected())?n.value:""},c.prototype.set=function(e,t,i,s){void 0===t&&(t="value"),void 0===i&&(i=!0),void 0===s&&(s=!0),this.config.isMultiple&&!Array.isArray(e)?this.data.addToSelected(e,t):this.data.setSelected(e,t),this.select.setValue(),this.data.onDataChange(),this.render(),i&&this.close()},c.prototype.setSelected=function(e,t,i,s){void 0===t&&(t="value"),void 0===i&&(i=!0),void 0===s&&(s=!0),this.set(e,t,i,s)},c.prototype.setData=function(e){if(l.validateData(e)){var t=JSON.parse(JSON.stringify(e)),i=this.data.getSelected();if(this.config.isAjax&&i)if(this.config.isMultiple)for(var s=0,n=i.reverse();s<n.length;s++){var a=n[s];t.unshift(a)}else t.unshift(this.data.getSelected()),t.unshift({text:"",placeholder:!0});this.select.create(t),this.data.parseSelectData(),this.data.setSelectedFromSelect()}else console.error("Validation problem on: #"+this.select.element.id)},c.prototype.addData=function(e){l.validateData([e])?(this.data.add(this.data.newOption(e)),this.select.create(this.data.data),this.data.parseSelectData(),this.data.setSelectedFromSelect(),this.render()):console.error("Validation problem on: #"+this.select.element.id)},c.prototype.open=function(){var e=this;if(this.config.isEnabled&&!this.data.contentOpen){if(this.beforeOpen&&this.beforeOpen(),this.config.isMultiple&&this.slim.multiSelected?this.slim.multiSelected.plus.classList.add("ss-cross"):this.slim.singleSelected&&(this.slim.singleSelected.arrowIcon.arrow.classList.remove("arrow-down"),this.slim.singleSelected.arrowIcon.arrow.classList.add("arrow-up")),this.slim[this.config.isMultiple?"multiSelected":"singleSelected"].container.classList.add("above"===this.data.contentPosition?this.config.openAbove:this.config.openBelow),this.slim.content.classList.add(this.config.open),"up"===this.config.showContent.toLowerCase()?this.moveContentAbove():"down"===this.config.showContent.toLowerCase()?this.moveContentBelow():"above"===o.putContent(this.slim.content,this.data.contentPosition,this.data.contentOpen)?this.moveContentAbove():this.moveContentBelow(),!this.config.isMultiple){var t=this.data.getSelected();if(t){var i=t.id,s=this.slim.list.querySelector('[data-id="'+i+'"]');s&&o.ensureElementInView(this.slim.list,s)}}setTimeout(function(){e.data.contentOpen=!0,e.config.searchFocus&&e.slim.search.input.focus(),e.afterOpen&&e.afterOpen()},this.config.timeoutDelay)}},c.prototype.close=function(){var e=this;this.data.contentOpen&&(this.beforeClose&&this.beforeClose(),this.config.isMultiple&&this.slim.multiSelected?(this.slim.multiSelected.container.classList.remove(this.config.openAbove),this.slim.multiSelected.container.classList.remove(this.config.openBelow),this.slim.multiSelected.plus.classList.remove("ss-cross")):this.slim.singleSelected&&(this.slim.singleSelected.container.classList.remove(this.config.openAbove),this.slim.singleSelected.container.classList.remove(this.config.openBelow),this.slim.singleSelected.arrowIcon.arrow.classList.add("arrow-down"),this.slim.singleSelected.arrowIcon.arrow.classList.remove("arrow-up")),this.slim.content.classList.remove(this.config.open),this.data.contentOpen=!1,this.search(""),setTimeout(function(){e.slim.content.removeAttribute("style"),e.data.contentPosition="below",e.config.isMultiple&&e.slim.multiSelected?(e.slim.multiSelected.container.classList.remove(e.config.openAbove),e.slim.multiSelected.container.classList.remove(e.config.openBelow)):e.slim.singleSelected&&(e.slim.singleSelected.container.classList.remove(e.config.openAbove),e.slim.singleSelected.container.classList.remove(e.config.openBelow)),e.slim.search.input.blur(),e.afterClose&&e.afterClose()},this.config.timeoutDelay))},c.prototype.moveContentAbove=function(){var e=0;this.config.isMultiple&&this.slim.multiSelected?e=this.slim.multiSelected.container.offsetHeight:this.slim.singleSelected&&(e=this.slim.singleSelected.container.offsetHeight);var t=e+this.slim.content.offsetHeight-1;this.slim.content.style.margin="-"+t+"px 0 0 0",this.slim.content.style.height=t-e+1+"px",this.slim.content.style.transformOrigin="center bottom",this.data.contentPosition="above",this.config.isMultiple&&this.slim.multiSelected?(this.slim.multiSelected.container.classList.remove(this.config.openBelow),this.slim.multiSelected.container.classList.add(this.config.openAbove)):this.slim.singleSelected&&(this.slim.singleSelected.container.classList.remove(this.config.openBelow),this.slim.singleSelected.container.classList.add(this.config.openAbove))},c.prototype.moveContentBelow=function(){this.slim.content.removeAttribute("style"),this.data.contentPosition="below",this.config.isMultiple&&this.slim.multiSelected?(this.slim.multiSelected.container.classList.remove(this.config.openAbove),this.slim.multiSelected.container.classList.add(this.config.openBelow)):this.slim.singleSelected&&(this.slim.singleSelected.container.classList.remove(this.config.openAbove),this.slim.singleSelected.container.classList.add(this.config.openBelow))},c.prototype.enable=function(){this.config.isEnabled=!0,this.config.isMultiple&&this.slim.multiSelected?this.slim.multiSelected.container.classList.remove(this.config.disabled):this.slim.singleSelected&&this.slim.singleSelected.container.classList.remove(this.config.disabled),this.select.triggerMutationObserver=!1,this.select.element.disabled=!1,this.slim.search.input.disabled=!1,this.select.triggerMutationObserver=!0},c.prototype.disable=function(){this.config.isEnabled=!1,this.config.isMultiple&&this.slim.multiSelected?this.slim.multiSelected.container.classList.add(this.config.disabled):this.slim.singleSelected&&this.slim.singleSelected.container.classList.add(this.config.disabled),this.select.triggerMutationObserver=!1,this.select.element.disabled=!0,this.slim.search.input.disabled=!0,this.select.triggerMutationObserver=!0},c.prototype.search=function(t){if(this.data.searchValue!==t)if(this.slim.search.input.value=t,this.config.isAjax){var i=this;this.config.isSearching=!0,this.render(),this.ajax&&this.ajax(t,function(e){i.config.isSearching=!1,Array.isArray(e)?(e.unshift({text:"",placeholder:!0}),i.setData(e),i.data.search(t),i.render()):"string"==typeof e?i.slim.options(e):i.render()})}else this.data.search(t),this.render()},c.prototype.setSearchText=function(e){this.config.searchText=e},c.prototype.render=function(){this.config.isMultiple?this.slim.values():(this.slim.placeholder(),this.slim.deselect()),this.slim.options()},c.prototype.destroy=function(e){void 0===e&&(e=null);var t=e?document.querySelector("."+e):this.slim.container,i=e?document.querySelector("[data-ssid="+e+"]"):this.select.element;t&&i&&(i.style.display=null,delete i.dataset.ssid,i.slim=null,t.parentElement&&t.parentElement.removeChild(t))},c);function c(e){var t=this;this.ajax=null,this.addable=null,this.beforeOnChange=null,this.onChange=null,this.beforeOpen=null,this.afterOpen=null,this.beforeClose=null,this.afterClose=null;var i=this.validate(e);i.dataset.ssid&&this.destroy(i.dataset.ssid),e.ajax&&(this.ajax=e.ajax),e.addable&&(this.addable=e.addable),this.config=new s.Config({select:i,isAjax:!!e.ajax,showSearch:e.showSearch,searchPlaceholder:e.searchPlaceholder,searchText:e.searchText,searchingText:e.searchingText,searchFocus:e.searchFocus,searchHighlight:e.searchHighlight,searchFilter:e.searchFilter,closeOnSelect:e.closeOnSelect,showContent:e.showContent,placeholderText:e.placeholder,allowDeselect:e.allowDeselect,allowDeselectOption:e.allowDeselectOption,hideSelectedOption:e.hideSelectedOption,deselectLabel:e.deselectLabel,isEnabled:e.isEnabled,valuesUseText:e.valuesUseText,showOptionTooltips:e.showOptionTooltips,selectByGroup:e.selectByGroup,limit:e.limit,timeoutDelay:e.timeoutDelay}),this.select=new n.Select({select:i,main:this}),this.data=new l.Data({main:this}),this.slim=new a.Slim({main:this}),this.select.element.parentNode&&this.select.element.parentNode.insertBefore(this.slim.container,this.select.element.nextSibling),e.data?this.setData(e.data):this.render(),document.addEventListener("click",function(e){e.target&&!o.hasClassInTree(e.target,t.config.id)&&t.close()}),window.addEventListener("scroll",o.debounce(function(e){t.data.contentOpen&&"auto"===t.config.showContent&&("above"===o.putContent(t.slim.content,t.data.contentPosition,t.data.contentOpen)?t.moveContentAbove():t.moveContentBelow())}),!1),e.beforeOnChange&&(this.beforeOnChange=e.beforeOnChange),e.onChange&&(this.onChange=e.onChange),e.beforeOpen&&(this.beforeOpen=e.beforeOpen),e.afterOpen&&(this.afterOpen=e.afterOpen),e.beforeClose&&(this.beforeClose=e.beforeClose),e.afterClose&&(this.afterClose=e.afterClose),this.config.isEnabled||this.disable()}t.default=r},function(e,t,i){"use strict";t.__esModule=!0;var s=(n.prototype.searchFilter=function(e,t){return-1!==e.text.toLowerCase().indexOf(t.toLowerCase())},n);function n(e){this.id="",this.isMultiple=!1,this.isAjax=!1,this.isSearching=!1,this.showSearch=!0,this.searchFocus=!0,this.searchHighlight=!1,this.closeOnSelect=!0,this.showContent="auto",this.searchPlaceholder="Search",this.searchText="No Results",this.searchingText="Searching...",this.placeholderText="Select Value",this.allowDeselect=!1,this.allowDeselectOption=!1,this.hideSelectedOption=!1,this.deselectLabel="x",this.isEnabled=!0,this.valuesUseText=!1,this.showOptionTooltips=!1,this.selectByGroup=!1,this.limit=0,this.timeoutDelay=200,this.main="ss-main",this.singleSelected="ss-single-selected",this.arrow="ss-arrow",this.multiSelected="ss-multi-selected",this.add="ss-add",this.plus="ss-plus",this.values="ss-values",this.value="ss-value",this.valueText="ss-value-text",this.valueDelete="ss-value-delete",this.content="ss-content",this.open="ss-open",this.openAbove="ss-open-above",this.openBelow="ss-open-below",this.search="ss-search",this.searchHighlighter="ss-search-highlight",this.addable="ss-addable",this.list="ss-list",this.optgroup="ss-optgroup",this.optgroupLabel="ss-optgroup-label",this.optgroupLabelSelectable="ss-optgroup-label-selectable",this.option="ss-option",this.optionSelected="ss-option-selected",this.highlighted="ss-highlighted",this.disabled="ss-disabled",this.hide="ss-hide",this.id="ss-"+Math.floor(1e5*Math.random()),this.style=e.select.style.cssText,this.class=e.select.className.split(" "),this.isMultiple=e.select.multiple,this.isAjax=e.isAjax,this.showSearch=!1!==e.showSearch,this.searchFocus=!1!==e.searchFocus,this.searchHighlight=!0===e.searchHighlight,this.closeOnSelect=!1!==e.closeOnSelect,e.showContent&&(this.showContent=e.showContent),this.isEnabled=!1!==e.isEnabled,e.searchPlaceholder&&(this.searchPlaceholder=e.searchPlaceholder),e.searchText&&(this.searchText=e.searchText),e.searchingText&&(this.searchingText=e.searchingText),e.placeholderText&&(this.placeholderText=e.placeholderText),this.allowDeselect=!0===e.allowDeselect,this.allowDeselectOption=!0===e.allowDeselectOption,this.hideSelectedOption=!0===e.hideSelectedOption,e.deselectLabel&&(this.deselectLabel=e.deselectLabel),e.valuesUseText&&(this.valuesUseText=e.valuesUseText),e.showOptionTooltips&&(this.showOptionTooltips=e.showOptionTooltips),e.selectByGroup&&(this.selectByGroup=e.selectByGroup),e.limit&&(this.limit=e.limit),e.searchFilter&&(this.searchFilter=e.searchFilter),null!=e.timeoutDelay&&(this.timeoutDelay=e.timeoutDelay)}t.Config=s},function(e,t,i){"use strict";t.__esModule=!0;var s=(n.prototype.setValue=function(){if(this.main.data.getSelected()){if(this.main.config.isMultiple)for(var e=this.main.data.getSelected(),t=0,i=this.element.options;t<i.length;t++){var s=i[t];s.selected=!1;for(var n=0,a=e;n<a.length;n++)a[n].value===s.value&&(s.selected=!0)}else e=this.main.data.getSelected(),this.element.value=e?e.value:"";this.main.data.isOnChangeEnabled=!1,this.element.dispatchEvent(new CustomEvent("change",{bubbles:!0})),this.main.data.isOnChangeEnabled=!0}},n.prototype.addAttributes=function(){this.element.tabIndex=-1,this.element.style.display="none",this.element.dataset.ssid=this.main.config.id},n.prototype.addEventListeners=function(){var t=this;this.element.addEventListener("change",function(e){t.main.data.setSelectedFromSelect(),t.main.render()})},n.prototype.addMutationObserver=function(){var t=this;this.main.config.isAjax||(this.mutationObserver=new MutationObserver(function(e){t.triggerMutationObserver&&(t.main.data.parseSelectData(),t.main.data.setSelectedFromSelect(),t.main.render(),e.forEach(function(e){"class"===e.attributeName&&t.main.slim.updateContainerDivClass(t.main.slim.container)}))}),this.observeMutationObserver())},n.prototype.observeMutationObserver=function(){this.mutationObserver&&this.mutationObserver.observe(this.element,{attributes:!0,childList:!0,characterData:!0})},n.prototype.disconnectMutationObserver=function(){this.mutationObserver&&this.mutationObserver.disconnect()},n.prototype.create=function(e){this.element.innerHTML="";for(var t=0,i=e;t<i.length;t++){var s=i[t];if(s.hasOwnProperty("options")){var n=s,a=document.createElement("optgroup");if(a.label=n.label,n.options)for(var l=0,o=n.options;l<o.length;l++){var r=o[l];a.appendChild(this.createOption(r))}this.element.appendChild(a)}else this.element.appendChild(this.createOption(s))}},n.prototype.createOption=function(t){var i=document.createElement("option");return i.value=t.value||t.text,i.innerHTML=t.innerHTML||t.text,t.selected&&(i.selected=t.selected),t.disabled&&(i.disabled=!0),t.placeholder&&i.setAttribute("data-placeholder","true"),t.class&&t.class.split(" ").forEach(function(e){i.classList.add(e)}),t.data&&"object"==typeof t.data&&Object.keys(t.data).forEach(function(e){i.setAttribute("data-"+e,t.data[e])}),i},n);function n(e){this.triggerMutationObserver=!0,this.element=e.select,this.main=e.main,this.element.disabled&&(this.main.config.isEnabled=!1),this.addAttributes(),this.addEventListeners(),this.mutationObserver=null,this.addMutationObserver(),this.element.slim=e.main}t.Select=s},function(e,t,i){"use strict";t.__esModule=!0;var a=i(0),l=i(1),s=(n.prototype.containerDiv=function(){var e=document.createElement("div");return e.style.cssText=this.main.config.style,this.updateContainerDivClass(e),e},n.prototype.updateContainerDivClass=function(e){this.main.config.class=this.main.select.element.className.split(" "),e.className="",e.classList.add(this.main.config.id),e.classList.add(this.main.config.main);for(var t=0,i=this.main.config.class;t<i.length;t++){var s=i[t];""!==s.trim()&&e.classList.add(s)}},n.prototype.singleSelectedDiv=function(){var t=this,e=document.createElement("div");e.classList.add(this.main.config.singleSelected);var i=document.createElement("span");i.classList.add("placeholder"),e.appendChild(i);var s=document.createElement("span");s.innerHTML=this.main.config.deselectLabel,s.classList.add("ss-deselect"),s.onclick=function(e){e.stopPropagation(),t.main.config.isEnabled&&t.main.set("")},e.appendChild(s);var n=document.createElement("span");n.classList.add(this.main.config.arrow);var a=document.createElement("span");return a.classList.add("arrow-down"),n.appendChild(a),e.appendChild(n),e.onclick=function(){t.main.config.isEnabled&&(t.main.data.contentOpen?t.main.close():t.main.open())},{container:e,placeholder:i,deselect:s,arrowIcon:{container:n,arrow:a}}},n.prototype.placeholder=function(){var e=this.main.data.getSelected();if(null===e||e&&e.placeholder){var t=document.createElement("span");t.classList.add(this.main.config.disabled),t.innerHTML=this.main.config.placeholderText,this.singleSelected&&(this.singleSelected.placeholder.innerHTML=t.outerHTML)}else{var i="";e&&(i=e.innerHTML&&!0!==this.main.config.valuesUseText?e.innerHTML:e.text),this.singleSelected&&(this.singleSelected.placeholder.innerHTML=e?i:"")}},n.prototype.deselect=function(){if(this.singleSelected){if(!this.main.config.allowDeselect)return void this.singleSelected.deselect.classList.add("ss-hide");""===this.main.selected()?this.singleSelected.deselect.classList.add("ss-hide"):this.singleSelected.deselect.classList.remove("ss-hide")}},n.prototype.multiSelectedDiv=function(){var t=this,e=document.createElement("div");e.classList.add(this.main.config.multiSelected);var i=document.createElement("div");i.classList.add(this.main.config.values),e.appendChild(i);var s=document.createElement("div");s.classList.add(this.main.config.add);var n=document.createElement("span");return n.classList.add(this.main.config.plus),n.onclick=function(e){t.main.data.contentOpen&&(t.main.close(),e.stopPropagation())},s.appendChild(n),e.appendChild(s),e.onclick=function(e){t.main.config.isEnabled&&(e.target.classList.contains(t.main.config.valueDelete)||(t.main.data.contentOpen?t.main.close():t.main.open()))},{container:e,values:i,add:s,plus:n}},n.prototype.values=function(){if(this.multiSelected){for(var e,t=this.multiSelected.values.childNodes,i=this.main.data.getSelected(),s=[],n=0,a=t;n<a.length;n++){var l=a[n];e=!0;for(var o=0,r=i;o<r.length;o++){var c=r[o];String(c.id)===String(l.dataset.id)&&(e=!1)}e&&s.push(l)}for(var h=0,d=s;h<d.length;h++){var u=d[h];u.classList.add("ss-out"),this.multiSelected.values.removeChild(u)}for(t=this.multiSelected.values.childNodes,c=0;c<i.length;c++){e=!1;for(var p=0,m=t;p<m.length;p++)l=m[p],String(i[c].id)===String(l.dataset.id)&&(e=!0);e||(0!==t.length&&HTMLElement.prototype.insertAdjacentElement?0===c?this.multiSelected.values.insertBefore(this.valueDiv(i[c]),t[c]):t[c-1].insertAdjacentElement("afterend",this.valueDiv(i[c])):this.multiSelected.values.appendChild(this.valueDiv(i[c])))}if(0===i.length){var f=document.createElement("span");f.classList.add(this.main.config.disabled),f.innerHTML=this.main.config.placeholderText,this.multiSelected.values.innerHTML=f.outerHTML}}},n.prototype.valueDiv=function(a){var l=this,e=document.createElement("div");e.classList.add(this.main.config.value),e.dataset.id=a.id;var t=document.createElement("span");t.classList.add(this.main.config.valueText),t.innerHTML=a.innerHTML&&!0!==this.main.config.valuesUseText?a.innerHTML:a.text,e.appendChild(t);var i=document.createElement("span");return i.classList.add(this.main.config.valueDelete),i.innerHTML=this.main.config.deselectLabel,i.onclick=function(e){e.preventDefault(),e.stopPropagation();var t=!1;if(l.main.config.isEnabled){if(l.main.beforeOnChange||(t=!0),l.main.beforeOnChange){for(var i=l.main.data.getSelected(),s=JSON.parse(JSON.stringify(i)),n=0;n<s.length;n++)s[n].id===a.id&&s.splice(n,1);!1!==l.main.beforeOnChange(s)&&(t=!0)}t&&(l.main.data.removeFromSelected(a.id,"id"),l.main.render(),l.main.select.setValue(),l.main.data.onDataChange())}},e.appendChild(i),e},n.prototype.contentDiv=function(){var e=document.createElement("div");return e.classList.add(this.main.config.content),e},n.prototype.searchDiv=function(){var n=this,e=document.createElement("div"),s=document.createElement("input"),a=document.createElement("div");e.classList.add(this.main.config.search);var t={container:e,input:s};return this.main.config.showSearch||(e.classList.add(this.main.config.hide),s.readOnly=!0),s.type="search",s.placeholder=this.main.config.searchPlaceholder,s.tabIndex=0,s.setAttribute("aria-label",this.main.config.searchPlaceholder),s.onclick=function(e){setTimeout(function(){""===e.target.value&&n.main.search("")},10)},s.onkeydown=function(e){"ArrowUp"===e.key?(n.main.open(),n.highlightUp(),e.preventDefault()):"ArrowDown"===e.key?(n.main.open(),n.highlightDown(),e.preventDefault()):"Tab"===e.key?n.main.data.contentOpen?n.main.close():setTimeout(function(){n.main.close()},n.main.config.timeoutDelay):"Enter"===e.key&&e.preventDefault()},s.onkeyup=function(e){var t=e.target;if("Enter"===e.key){if(n.main.addable&&e.ctrlKey)return a.click(),e.preventDefault(),void e.stopPropagation();var i=n.list.querySelector("."+n.main.config.highlighted);i&&i.click()}else"ArrowUp"===e.key||"ArrowDown"===e.key||("Escape"===e.key?n.main.close():n.main.config.showSearch&&n.main.data.contentOpen?n.main.search(t.value):s.value="");e.preventDefault(),e.stopPropagation()},s.onfocus=function(){n.main.open()},e.appendChild(s),this.main.addable&&(a.classList.add(this.main.config.addable),a.innerHTML="+",a.onclick=function(e){if(n.main.addable){e.preventDefault(),e.stopPropagation();var t=n.search.input.value;if(""===t.trim())return void n.search.input.focus();var i=n.main.addable(t),s="";if(!i)return;"object"==typeof i?l.validateOption(i)&&(n.main.addData(i),s=i.value?i.value:i.text):(n.main.addData(n.main.data.newOption({text:i,value:i})),s=i),n.main.search(""),setTimeout(function(){n.main.set(s,"value",!1,!1)},100),n.main.config.closeOnSelect&&setTimeout(function(){n.main.close()},100)}},e.appendChild(a),t.addable=a),t},n.prototype.highlightUp=function(){var e=this.list.querySelector("."+this.main.config.highlighted),t=null;if(e)for(t=e.previousSibling;null!==t&&t.classList.contains(this.main.config.disabled);)t=t.previousSibling;else{var i=this.list.querySelectorAll("."+this.main.config.option+":not(."+this.main.config.disabled+")");t=i[i.length-1]}if(t&&t.classList.contains(this.main.config.optgroupLabel)&&(t=null),null===t){var s=e.parentNode;if(s.classList.contains(this.main.config.optgroup)&&s.previousSibling){var n=s.previousSibling.querySelectorAll("."+this.main.config.option+":not(."+this.main.config.disabled+")");n.length&&(t=n[n.length-1])}}t&&(e&&e.classList.remove(this.main.config.highlighted),t.classList.add(this.main.config.highlighted),a.ensureElementInView(this.list,t))},n.prototype.highlightDown=function(){var e=this.list.querySelector("."+this.main.config.highlighted),t=null;if(e)for(t=e.nextSibling;null!==t&&t.classList.contains(this.main.config.disabled);)t=t.nextSibling;else t=this.list.querySelector("."+this.main.config.option+":not(."+this.main.config.disabled+")");if(null===t&&null!==e){var i=e.parentNode;i.classList.contains(this.main.config.optgroup)&&i.nextSibling&&(t=i.nextSibling.querySelector("."+this.main.config.option+":not(."+this.main.config.disabled+")"))}t&&(e&&e.classList.remove(this.main.config.highlighted),t.classList.add(this.main.config.highlighted),a.ensureElementInView(this.list,t))},n.prototype.listDiv=function(){var e=document.createElement("div");return e.classList.add(this.main.config.list),e},n.prototype.options=function(e){void 0===e&&(e="");var t,i=this.main.data.filtered||this.main.data.data;if((this.list.innerHTML="")!==e)return(t=document.createElement("div")).classList.add(this.main.config.option),t.classList.add(this.main.config.disabled),t.innerHTML=e,void this.list.appendChild(t);if(this.main.config.isAjax&&this.main.config.isSearching)return(t=document.createElement("div")).classList.add(this.main.config.option),t.classList.add(this.main.config.disabled),t.innerHTML=this.main.config.searchingText,void this.list.appendChild(t);if(0===i.length){var s=document.createElement("div");return s.classList.add(this.main.config.option),s.classList.add(this.main.config.disabled),s.innerHTML=this.main.config.searchText,void this.list.appendChild(s)}for(var n=function(e){if(e.hasOwnProperty("label")){var t=e,n=document.createElement("div");n.classList.add(c.main.config.optgroup);var i=document.createElement("div");i.classList.add(c.main.config.optgroupLabel),c.main.config.selectByGroup&&c.main.config.isMultiple&&i.classList.add(c.main.config.optgroupLabelSelectable),i.innerHTML=t.label,n.appendChild(i);var s=t.options;if(s){for(var a=0,l=s;a<l.length;a++){var o=l[a];n.appendChild(c.option(o))}if(c.main.config.selectByGroup&&c.main.config.isMultiple){var r=c;i.addEventListener("click",function(e){e.preventDefault(),e.stopPropagation();for(var t=0,i=n.children;t<i.length;t++){var s=i[t];-1!==s.className.indexOf(r.main.config.option)&&s.click()}})}}c.list.appendChild(n)}else c.list.appendChild(c.option(e))},c=this,a=0,l=i;a<l.length;a++)n(l[a])},n.prototype.option=function(r){if(r.placeholder){var e=document.createElement("div");return e.classList.add(this.main.config.option),e.classList.add(this.main.config.hide),e}var t=document.createElement("div");t.classList.add(this.main.config.option),r.class&&r.class.split(" ").forEach(function(e){t.classList.add(e)}),r.style&&(t.style.cssText=r.style);var c=this.main.data.getSelected();t.dataset.id=r.id,this.main.config.searchHighlight&&this.main.slim&&r.innerHTML&&""!==this.main.slim.search.input.value.trim()?t.innerHTML=a.highlight(r.innerHTML,this.main.slim.search.input.value,this.main.config.searchHighlighter):r.innerHTML&&(t.innerHTML=r.innerHTML),this.main.config.showOptionTooltips&&t.textContent&&t.setAttribute("title",t.textContent);var h=this;t.addEventListener("click",function(e){e.preventDefault(),e.stopPropagation();var t=this.dataset.id;if(!0===r.selected&&h.main.config.allowDeselectOption){var i=!1;if(h.main.beforeOnChange&&h.main.config.isMultiple||(i=!0),h.main.beforeOnChange&&h.main.config.isMultiple){for(var s=h.main.data.getSelected(),n=JSON.parse(JSON.stringify(s)),a=0;a<n.length;a++)n[a].id===t&&n.splice(a,1);!1!==h.main.beforeOnChange(n)&&(i=!0)}i&&(h.main.config.isMultiple?(h.main.data.removeFromSelected(t,"id"),h.main.render(),h.main.select.setValue(),h.main.data.onDataChange()):h.main.set(""))}else{if(r.disabled||r.selected)return;if(h.main.config.limit&&Array.isArray(c)&&h.main.config.limit<=c.length)return;if(h.main.beforeOnChange){var l=void 0,o=JSON.parse(JSON.stringify(h.main.data.getObjectFromData(t)));o.selected=!0,h.main.config.isMultiple?(l=JSON.parse(JSON.stringify(c))).push(o):l=JSON.parse(JSON.stringify(o)),!1!==h.main.beforeOnChange(l)&&h.main.set(t,"id",h.main.config.closeOnSelect)}else h.main.set(t,"id",h.main.config.closeOnSelect)}});var i=c&&a.isValueInArrayOfObjects(c,"id",r.id);return(r.disabled||i)&&(t.onclick=null,h.main.config.allowDeselectOption||t.classList.add(this.main.config.disabled),h.main.config.hideSelectedOption&&t.classList.add(this.main.config.hide)),i?t.classList.add(this.main.config.optionSelected):t.classList.remove(this.main.config.optionSelected),t},n);function n(e){this.main=e.main,this.container=this.containerDiv(),this.content=this.contentDiv(),this.search=this.searchDiv(),this.list=this.listDiv(),this.options(),this.singleSelected=null,this.multiSelected=null,this.main.config.isMultiple?(this.multiSelected=this.multiSelectedDiv(),this.multiSelected&&this.container.appendChild(this.multiSelected.container)):(this.singleSelected=this.singleSelectedDiv(),this.container.appendChild(this.singleSelected.container)),this.container.appendChild(this.content),this.content.appendChild(this.search.container),this.content.appendChild(this.list)}t.Slim=s}],n.c=s,n.d=function(e,t,i){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:i})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var i=Object.create(null);if(n.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var s in t)n.d(i,s,function(e){return t[e]}.bind(null,s));return i},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=2)).default;function n(e){if(s[e])return s[e].exports;var t=s[e]={i:e,l:!1,exports:{}};return i[e].call(t.exports,t,t.exports,n),t.l=!0,t.exports}var i,s});
//**// jsTree - v3.2.1 //**//
!function(a){"use strict";"function"==typeof define&&define.amd?define(["jquery"],a):"undefined"!=typeof module&&module.exports?module.exports=a(require("jquery")):a(jQuery)}(function(a,b){"use strict";if(!a.jstree){var c=0,d=!1,e=!1,f=!1,g=[],h=a("script:last").attr("src"),i=window.document,j=i.createElement("LI"),k,l;j.setAttribute("role","treeitem"),k=i.createElement("I"),k.className="jstree-icon jstree-ocl",k.setAttribute("role","presentation"),j.appendChild(k),k=i.createElement("A"),k.className="jstree-anchor",k.setAttribute("href","#"),k.setAttribute("tabindex","-1"),l=i.createElement("I"),l.className="jstree-icon jstree-themeicon",l.setAttribute("role","presentation"),k.appendChild(l),j.appendChild(k),k=l=null,a.jstree={version:"3.2.1",defaults:{plugins:[]},plugins:{},path:h&&-1!==h.indexOf("/")?h.replace(/\/[^\/]+$/,""):"",idregex:/[\\:&!^|()\[\]<>@*'+~#";.,=\- \/${}%?`]/g,root:"#"},a.jstree.create=function(b,d){var e=new a.jstree.core(++c),f=d;return d=a.extend(!0,{},a.jstree.defaults,d),f&&f.plugins&&(d.plugins=f.plugins),a.each(d.plugins,function(a,b){"core"!==a&&(e=e.plugin(b,d[b]))}),a(b).data("jstree",e),e.init(b,d),e},a.jstree.destroy=function(){a(".jstree:jstree").jstree("destroy"),a(i).off(".jstree")},a.jstree.core=function(a){this._id=a,this._cnt=0,this._wrk=null,this._data={core:{themes:{name:!1,dots:!1,icons:!1},selected:[],last_error:{},working:!1,worker_queue:[],focused:null}}},a.jstree.reference=function(b){var c=null,d=null;if(!b||!b.id||b.tagName&&b.nodeType||(b=b.id),!d||!d.length)try{d=a(b)}catch(e){}if(!d||!d.length)try{d=a("#"+b.replace(a.jstree.idregex,"\\$&"))}catch(e){}return d&&d.length&&(d=d.closest(".jstree")).length&&(d=d.data("jstree"))?c=d:a(".jstree").each(function(){var d=a(this).data("jstree");return d&&d._model.data[b]?(c=d,!1):void 0}),c},a.fn.jstree=function(c){var d="string"==typeof c,e=Array.prototype.slice.call(arguments,1),f=null;return c!==!0||this.length?(this.each(function(){var g=a.jstree.reference(this),h=d&&g?g[c]:null;return f=d&&h?h.apply(g,e):null,g||d||c!==b&&!a.isPlainObject(c)||a.jstree.create(this,c),(g&&!d||c===!0)&&(f=g||!1),null!==f&&f!==b?!1:void 0}),null!==f&&f!==b?f:this):!1},a.expr[":"].jstree=a.expr.createPseudo(function(c){return function(c){return a(c).hasClass("jstree")&&a(c).data("jstree")!==b}}),a.jstree.defaults.core={data:!1,strings:!1,check_callback:!1,error:a.noop,animation:200,multiple:!0,themes:{name:!1,url:!1,dir:!1,dots:!0,icons:!0,stripes:!1,variant:!1,responsive:!1},expand_selected_onload:!0,worker:!0,force_text:!1,dblclick_toggle:!0},a.jstree.core.prototype={plugin:function(b,c){var d=a.jstree.plugins[b];return d?(this._data[b]={},d.prototype=this,new d(c,this)):this},init:function(b,c){this._model={data:{},changed:[],force_full_redraw:!1,redraw_timeout:!1,default_state:{loaded:!0,opened:!1,selected:!1,disabled:!1}},this._model.data[a.jstree.root]={id:a.jstree.root,parent:null,parents:[],children:[],children_d:[],state:{loaded:!1}},this.element=a(b).addClass("jstree jstree-"+this._id),this.settings=c,this._data.core.ready=!1,this._data.core.loaded=!1,this._data.core.rtl="rtl"===this.element.css("direction"),this.element[this._data.core.rtl?"addClass":"removeClass"]("jstree-rtl"),this.element.attr("role","tree"),this.settings.core.multiple&&this.element.attr("aria-multiselectable",!0),this.element.attr("tabindex")||this.element.attr("tabindex","0"),this.bind(),this.trigger("init"),this._data.core.original_container_html=this.element.find(" > ul > li").clone(!0),this._data.core.original_container_html.find("li").addBack().contents().filter(function(){return 3===this.nodeType&&(!this.nodeValue||/^\s+$/.test(this.nodeValue))}).remove(),this.element.html("<ul class='jstree-container-ul jstree-children' role='group'><li id='j"+this._id+"_loading' class='jstree-initial-node jstree-loading jstree-leaf jstree-last' role='tree-item'><i class='jstree-icon jstree-ocl'></i><a class='jstree-anchor' href='#'><i class='jstree-icon jstree-themeicon-hidden'></i>"+this.get_string("Loading ...")+"</a></li></ul>"),this.element.attr("aria-activedescendant","j"+this._id+"_loading"),this._data.core.li_height=this.get_container_ul().children("li").first().height()||24,this.trigger("loading"),this.load_node(a.jstree.root)},destroy:function(a){if(this._wrk)try{window.URL.revokeObjectURL(this._wrk),this._wrk=null}catch(b){}a||this.element.empty(),this.teardown()},teardown:function(){this.unbind(),this.element.removeClass("jstree").removeData("jstree").find("[class^='jstree']").addBack().attr("class",function(){return this.className.replace(/jstree[^ ]*|$/gi,"")}),this.element=null},bind:function(){var b="",c=null,d=0;this.element.on("dblclick.jstree",function(a){if(a.target.tagName&&"input"===a.target.tagName.toLowerCase())return!0;if(i.selection&&i.selection.empty)i.selection.empty();else if(window.getSelection){var b=window.getSelection();try{b.removeAllRanges(),b.collapse()}catch(c){}}}).on("mousedown.jstree",a.proxy(function(a){a.target===this.element[0]&&(a.preventDefault(),d=+new Date)},this)).on("mousedown.jstree",".jstree-ocl",function(a){a.preventDefault()}).on("click.jstree",".jstree-ocl",a.proxy(function(a){this.toggle_node(a.target)},this)).on("dblclick.jstree",".jstree-anchor",a.proxy(function(a){return a.target.tagName&&"input"===a.target.tagName.toLowerCase()?!0:void(this.settings.core.dblclick_toggle&&this.toggle_node(a.target))},this)).on("click.jstree",".jstree-anchor",a.proxy(function(b){b.preventDefault(),b.currentTarget!==i.activeElement&&a(b.currentTarget).focus(),this.activate_node(b.currentTarget,b)},this)).on("keydown.jstree",".jstree-anchor",a.proxy(function(b){if(b.target.tagName&&"input"===b.target.tagName.toLowerCase())return!0;if(32!==b.which&&13!==b.which&&(b.shiftKey||b.ctrlKey||b.altKey||b.metaKey))return!0;var c=null;switch(this._data.core.rtl&&(37===b.which?b.which=39:39===b.which&&(b.which=37)),b.which){case 32:b.ctrlKey&&(b.type="click",a(b.currentTarget).trigger(b));break;case 13:b.type="click",a(b.currentTarget).trigger(b);break;case 37:b.preventDefault(),this.is_open(b.currentTarget)?this.close_node(b.currentTarget):(c=this.get_parent(b.currentTarget),c&&c.id!==a.jstree.root&&this.get_node(c,!0).children(".jstree-anchor").focus());break;case 38:b.preventDefault(),c=this.get_prev_dom(b.currentTarget),c&&c.length&&c.children(".jstree-anchor").focus();break;case 39:b.preventDefault(),this.is_closed(b.currentTarget)?this.open_node(b.currentTarget,function(a){this.get_node(a,!0).children(".jstree-anchor").focus()}):this.is_open(b.currentTarget)&&(c=this.get_node(b.currentTarget,!0).children(".jstree-children")[0],c&&a(this._firstChild(c)).children(".jstree-anchor").focus());break;case 40:b.preventDefault(),c=this.get_next_dom(b.currentTarget),c&&c.length&&c.children(".jstree-anchor").focus();break;case 106:this.open_all();break;case 36:b.preventDefault(),c=this._firstChild(this.get_container_ul()[0]),c&&a(c).children(".jstree-anchor").filter(":visible").focus();break;case 35:b.preventDefault(),this.element.find(".jstree-anchor").filter(":visible").last().focus()}},this)).on("load_node.jstree",a.proxy(function(b,c){c.status&&(c.node.id!==a.jstree.root||this._data.core.loaded||(this._data.core.loaded=!0,this._firstChild(this.get_container_ul()[0])&&this.element.attr("aria-activedescendant",this._firstChild(this.get_container_ul()[0]).id),this.trigger("loaded")),this._data.core.ready||setTimeout(a.proxy(function(){if(this.element&&!this.get_container_ul().find(".jstree-loading").length){if(this._data.core.ready=!0,this._data.core.selected.length){if(this.settings.core.expand_selected_onload){var b=[],c,d;for(c=0,d=this._data.core.selected.length;d>c;c++)b=b.concat(this._model.data[this._data.core.selected[c]].parents);for(b=a.vakata.array_unique(b),c=0,d=b.length;d>c;c++)this.open_node(b[c],!1,0)}this.trigger("changed",{action:"ready",selected:this._data.core.selected})}this.trigger("ready")}},this),0))},this)).on("keypress.jstree",a.proxy(function(d){if(d.target.tagName&&"input"===d.target.tagName.toLowerCase())return!0;c&&clearTimeout(c),c=setTimeout(function(){b=""},500);var e=String.fromCharCode(d.which).toLowerCase(),f=this.element.find(".jstree-anchor").filter(":visible"),g=f.index(i.activeElement)||0,h=!1;if(b+=e,b.length>1){if(f.slice(g).each(a.proxy(function(c,d){return 0===a(d).text().toLowerCase().indexOf(b)?(a(d).focus(),h=!0,!1):void 0},this)),h)return;if(f.slice(0,g).each(a.proxy(function(c,d){return 0===a(d).text().toLowerCase().indexOf(b)?(a(d).focus(),h=!0,!1):void 0},this)),h)return}if(new RegExp("^"+e.replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&")+"+$").test(b)){if(f.slice(g+1).each(a.proxy(function(b,c){return a(c).text().toLowerCase().charAt(0)===e?(a(c).focus(),h=!0,!1):void 0},this)),h)return;if(f.slice(0,g+1).each(a.proxy(function(b,c){return a(c).text().toLowerCase().charAt(0)===e?(a(c).focus(),h=!0,!1):void 0},this)),h)return}},this)).on("init.jstree",a.proxy(function(){var a=this.settings.core.themes;this._data.core.themes.dots=a.dots,this._data.core.themes.stripes=a.stripes,this._data.core.themes.icons=a.icons,this.set_theme(a.name||"default",a.url),this.set_theme_variant(a.variant)},this)).on("loading.jstree",a.proxy(function(){this[this._data.core.themes.dots?"show_dots":"hide_dots"](),this[this._data.core.themes.icons?"show_icons":"hide_icons"](),this[this._data.core.themes.stripes?"show_stripes":"hide_stripes"]()},this)).on("blur.jstree",".jstree-anchor",a.proxy(function(b){this._data.core.focused=null,a(b.currentTarget).filter(".jstree-hovered").mouseleave(),this.element.attr("tabindex","0")},this)).on("focus.jstree",".jstree-anchor",a.proxy(function(b){var c=this.get_node(b.currentTarget);c&&c.id&&(this._data.core.focused=c.id),this.element.find(".jstree-hovered").not(b.currentTarget).mouseleave(),a(b.currentTarget).mouseenter(),this.element.attr("tabindex","-1")},this)).on("focus.jstree",a.proxy(function(){if(+new Date-d>500&&!this._data.core.focused){d=0;var a=this.get_node(this.element.attr("aria-activedescendant"),!0);a&&a.find("> .jstree-anchor").focus()}},this)).on("mouseenter.jstree",".jstree-anchor",a.proxy(function(a){this.hover_node(a.currentTarget)},this)).on("mouseleave.jstree",".jstree-anchor",a.proxy(function(a){this.dehover_node(a.currentTarget)},this))},unbind:function(){this.element.off(".jstree"),a(i).off(".jstree-"+this._id)},trigger:function(a,b){b||(b={}),b.instance=this,this.element.triggerHandler(a.replace(".jstree","")+".jstree",b)},get_container:function(){return this.element},get_container_ul:function(){return this.element.children(".jstree-children").first()},get_string:function(b){var c=this.settings.core.strings;return a.isFunction(c)?c.call(this,b):c&&c[b]?c[b]:b},_firstChild:function(a){a=a?a.firstChild:null;while(null!==a&&1!==a.nodeType)a=a.nextSibling;return a},_nextSibling:function(a){a=a?a.nextSibling:null;while(null!==a&&1!==a.nodeType)a=a.nextSibling;return a},_previousSibling:function(a){a=a?a.previousSibling:null;while(null!==a&&1!==a.nodeType)a=a.previousSibling;return a},get_node:function(b,c){b&&b.id&&(b=b.id);var d;try{if(this._model.data[b])b=this._model.data[b];else if("string"==typeof b&&this._model.data[b.replace(/^#/,"")])b=this._model.data[b.replace(/^#/,"")];else if("string"==typeof b&&(d=a("#"+b.replace(a.jstree.idregex,"\\$&"),this.element)).length&&this._model.data[d.closest(".jstree-node").attr("id")])b=this._model.data[d.closest(".jstree-node").attr("id")];else if((d=a(b,this.element)).length&&this._model.data[d.closest(".jstree-node").attr("id")])b=this._model.data[d.closest(".jstree-node").attr("id")];else{if(!(d=a(b,this.element)).length||!d.hasClass("jstree"))return!1;b=this._model.data[a.jstree.root]}return c&&(b=b.id===a.jstree.root?this.element:a("#"+b.id.replace(a.jstree.idregex,"\\$&"),this.element)),b}catch(e){return!1}},get_path:function(b,c,d){if(b=b.parents?b:this.get_node(b),!b||b.id===a.jstree.root||!b.parents)return!1;var e,f,g=[];for(g.push(d?b.id:b.text),e=0,f=b.parents.length;f>e;e++)g.push(d?b.parents[e]:this.get_text(b.parents[e]));return g=g.reverse().slice(1),c?g.join(c):g},get_next_dom:function(b,c){var d;if(b=this.get_node(b,!0),b[0]===this.element[0]){d=this._firstChild(this.get_container_ul()[0]);while(d&&0===d.offsetHeight)d=this._nextSibling(d);return d?a(d):!1}if(!b||!b.length)return!1;if(c){d=b[0];do d=this._nextSibling(d);while(d&&0===d.offsetHeight);return d?a(d):!1}if(b.hasClass("jstree-open")){d=this._firstChild(b.children(".jstree-children")[0]);while(d&&0===d.offsetHeight)d=this._nextSibling(d);if(null!==d)return a(d)}d=b[0];do d=this._nextSibling(d);while(d&&0===d.offsetHeight);return null!==d?a(d):b.parentsUntil(".jstree",".jstree-node").nextAll(".jstree-node:visible").first()},get_prev_dom:function(b,c){var d;if(b=this.get_node(b,!0),b[0]===this.element[0]){d=this.get_container_ul()[0].lastChild;while(d&&0===d.offsetHeight)d=this._previousSibling(d);return d?a(d):!1}if(!b||!b.length)return!1;if(c){d=b[0];do d=this._previousSibling(d);while(d&&0===d.offsetHeight);return d?a(d):!1}d=b[0];do d=this._previousSibling(d);while(d&&0===d.offsetHeight);if(null!==d){b=a(d);while(b.hasClass("jstree-open"))b=b.children(".jstree-children").first().children(".jstree-node:visible:last");return b}return d=b[0].parentNode.parentNode,d&&d.className&&-1!==d.className.indexOf("jstree-node")?a(d):!1},get_parent:function(b){return b=this.get_node(b),b&&b.id!==a.jstree.root?b.parent:!1},get_children_dom:function(a){return a=this.get_node(a,!0),a[0]===this.element[0]?this.get_container_ul().children(".jstree-node"):a&&a.length?a.children(".jstree-children").children(".jstree-node"):!1},is_parent:function(a){return a=this.get_node(a),a&&(a.state.loaded===!1||a.children.length>0)},is_loaded:function(a){return a=this.get_node(a),a&&a.state.loaded},is_loading:function(a){return a=this.get_node(a),a&&a.state&&a.state.loading},is_open:function(a){return a=this.get_node(a),a&&a.state.opened},is_closed:function(a){return a=this.get_node(a),a&&this.is_parent(a)&&!a.state.opened},is_leaf:function(a){return!this.is_parent(a)},load_node:function(b,c){var d,e,f,g,h;if(a.isArray(b))return this._load_nodes(b.slice(),c),!0;if(b=this.get_node(b),!b)return c&&c.call(this,b,!1),!1;if(b.state.loaded){for(b.state.loaded=!1,d=0,e=b.children_d.length;e>d;d++){for(f=0,g=b.parents.length;g>f;f++)this._model.data[b.parents[f]].children_d=a.vakata.array_remove_item(this._model.data[b.parents[f]].children_d,b.children_d[d]);this._model.data[b.children_d[d]].state.selected&&(h=!0,this._data.core.selected=a.vakata.array_remove_item(this._data.core.selected,b.children_d[d])),delete this._model.data[b.children_d[d]]}b.children=[],b.children_d=[],h&&this.trigger("changed",{action:"load_node",node:b,selected:this._data.core.selected})}return b.state.failed=!1,b.state.loading=!0,this.get_node(b,!0).addClass("jstree-loading").attr("aria-busy",!0),this._load_node(b,a.proxy(function(a){b=this._model.data[b.id],b.state.loading=!1,b.state.loaded=a,b.state.failed=!b.state.loaded;var d=this.get_node(b,!0),e=0,f=0,g=this._model.data,h=!1;for(e=0,f=b.children.length;f>e;e++)if(g[b.children[e]]&&!g[b.children[e]].state.hidden){h=!0;break}b.state.loaded&&!h&&d&&d.length&&!d.hasClass("jstree-leaf")&&d.removeClass("jstree-closed jstree-open").addClass("jstree-leaf"),d.removeClass("jstree-loading").attr("aria-busy",!1),this.trigger("load_node",{node:b,status:a}),c&&c.call(this,b,a)},this)),!0},_load_nodes:function(a,b,c){var d=!0,e=function(){this._load_nodes(a,b,!0)},f=this._model.data,g,h,i=[];for(g=0,h=a.length;h>g;g++)!f[a[g]]||(f[a[g]].state.loaded||f[a[g]].state.failed)&&c||(this.is_loading(a[g])||this.load_node(a[g],e),d=!1);if(d){for(g=0,h=a.length;h>g;g++)f[a[g]]&&f[a[g]].state.loaded&&i.push(a[g]);b&&!b.done&&(b.call(this,i),b.done=!0)}},load_all:function(b,c){if(b||(b=a.jstree.root),b=this.get_node(b),!b)return!1;var d=[],e=this._model.data,f=e[b.id].children_d,g,h;for(b.state&&!b.state.loaded&&d.push(b.id),g=0,h=f.length;h>g;g++)e[f[g]]&&e[f[g]].state&&!e[f[g]].state.loaded&&d.push(f[g]);d.length?this._load_nodes(d,function(){this.load_all(b,c)}):(c&&c.call(this,b),this.trigger("load_all",{node:b}))},_load_node:function(b,c){var d=this.settings.core.data,e;return d?a.isFunction(d)?d.call(this,b,a.proxy(function(d){d===!1&&c.call(this,!1),this["string"==typeof d?"_append_html_data":"_append_json_data"](b,"string"==typeof d?a(a.parseHTML(d)).filter(function(){return 3!==this.nodeType}):d,function(a){c.call(this,a)})},this)):"object"==typeof d?d.url?(d=a.extend(!0,{},d),a.isFunction(d.url)&&(d.url=d.url.call(this,b)),a.isFunction(d.data)&&(d.data=d.data.call(this,b)),a.ajax(d).done(a.proxy(function(d,e,f){var g=f.getResponseHeader("Content-Type");return g&&-1!==g.indexOf("json")||"object"==typeof d?this._append_json_data(b,d,function(a){c.call(this,a)}):g&&-1!==g.indexOf("html")||"string"==typeof d?this._append_html_data(b,a(a.parseHTML(d)).filter(function(){return 3!==this.nodeType}),function(a){c.call(this,a)}):(this._data.core.last_error={error:"ajax",plugin:"core",id:"core_04",reason:"Could not load node",data:JSON.stringify({id:b.id,xhr:f})},this.settings.core.error.call(this,this._data.core.last_error),c.call(this,!1))},this)).fail(a.proxy(function(a){c.call(this,!1),this._data.core.last_error={error:"ajax",plugin:"core",id:"core_04",reason:"Could not load node",data:JSON.stringify({id:b.id,xhr:a})},this.settings.core.error.call(this,this._data.core.last_error)},this))):(e=a.isArray(d)||a.isPlainObject(d)?JSON.parse(JSON.stringify(d)):d,b.id===a.jstree.root?this._append_json_data(b,e,function(a){c.call(this,a)}):(this._data.core.last_error={error:"nodata",plugin:"core",id:"core_05",reason:"Could not load node",data:JSON.stringify({id:b.id})},this.settings.core.error.call(this,this._data.core.last_error),c.call(this,!1))):"string"==typeof d?b.id===a.jstree.root?this._append_html_data(b,a(a.parseHTML(d)).filter(function(){return 3!==this.nodeType}),function(a){c.call(this,a)}):(this._data.core.last_error={error:"nodata",plugin:"core",id:"core_06",reason:"Could not load node",data:JSON.stringify({id:b.id})},this.settings.core.error.call(this,this._data.core.last_error),c.call(this,!1)):c.call(this,!1):b.id===a.jstree.root?this._append_html_data(b,this._data.core.original_container_html.clone(!0),function(a){c.call(this,a)}):c.call(this,!1)},_node_changed:function(a){a=this.get_node(a),a&&this._model.changed.push(a.id)},_append_html_data:function(b,c,d){b=this.get_node(b),b.children=[],b.children_d=[];var e=c.is("ul")?c.children():c,f=b.id,g=[],h=[],i=this._model.data,j=i[f],k=this._data.core.selected.length,l,m,n;for(e.each(a.proxy(function(b,c){l=this._parse_model_from_html(a(c),f,j.parents.concat()),l&&(g.push(l),h.push(l),i[l].children_d.length&&(h=h.concat(i[l].children_d)))},this)),j.children=g,j.children_d=h,m=0,n=j.parents.length;n>m;m++)i[j.parents[m]].children_d=i[j.parents[m]].children_d.concat(h);this.trigger("model",{nodes:h,parent:f}),f!==a.jstree.root?(this._node_changed(f),this.redraw()):(this.get_container_ul().children(".jstree-initial-node").remove(),this.redraw(!0)),this._data.core.selected.length!==k&&this.trigger("changed",{action:"model",selected:this._data.core.selected}),d.call(this,!0)},_append_json_data:function(b,c,d,e){if(null!==this.element){b=this.get_node(b),b.children=[],b.children_d=[],c.d&&(c=c.d,"string"==typeof c&&(c=JSON.parse(c))),a.isArray(c)||(c=[c]);var f=null,g={df:this._model.default_state,dat:c,par:b.id,m:this._model.data,t_id:this._id,t_cnt:this._cnt,sel:this._data.core.selected},h=function(a,b){a.data&&(a=a.data);var c=a.dat,d=a.par,e=[],f=[],g=[],h=a.df,i=a.t_id,j=a.t_cnt,k=a.m,l=k[d],m=a.sel,n,o,p,q,r=function(a,c,d){d=d?d.concat():[],c&&d.unshift(c);var e=a.id.toString(),f,i,j,l,m={id:e,text:a.text||"",icon:a.icon!==b?a.icon:!0,parent:c,parents:d,children:a.children||[],children_d:a.children_d||[],data:a.data,state:{},li_attr:{id:!1},a_attr:{href:"#"},original:!1};for(f in h)h.hasOwnProperty(f)&&(m.state[f]=h[f]);if(a&&a.data&&a.data.jstree&&a.data.jstree.icon&&(m.icon=a.data.jstree.icon),(m.icon===b||null===m.icon||""===m.icon)&&(m.icon=!0),a&&a.data&&(m.data=a.data,a.data.jstree))for(f in a.data.jstree)a.data.jstree.hasOwnProperty(f)&&(m.state[f]=a.data.jstree[f]);if(a&&"object"==typeof a.state)for(f in a.state)a.state.hasOwnProperty(f)&&(m.state[f]=a.state[f]);if(a&&"object"==typeof a.li_attr)for(f in a.li_attr)a.li_attr.hasOwnProperty(f)&&(m.li_attr[f]=a.li_attr[f]);if(m.li_attr.id||(m.li_attr.id=e),a&&"object"==typeof a.a_attr)for(f in a.a_attr)a.a_attr.hasOwnProperty(f)&&(m.a_attr[f]=a.a_attr[f]);for(a&&a.children&&a.children===!0&&(m.state.loaded=!1,m.children=[],m.children_d=[]),k[m.id]=m,f=0,i=m.children.length;i>f;f++)j=r(k[m.children[f]],m.id,d),l=k[j],m.children_d.push(j),l.children_d.length&&(m.children_d=m.children_d.concat(l.children_d));return delete a.data,delete a.children,k[m.id].original=a,m.state.selected&&g.push(m.id),m.id},s=function(a,c,d){d=d?d.concat():[],c&&d.unshift(c);var e=!1,f,l,m,n,o;do e="j"+i+"_"+ ++j;while(k[e]);o={id:!1,text:"string"==typeof a?a:"",icon:"object"==typeof a&&a.icon!==b?a.icon:!0,parent:c,parents:d,children:[],children_d:[],data:null,state:{},li_attr:{id:!1},a_attr:{href:"#"},original:!1};for(f in h)h.hasOwnProperty(f)&&(o.state[f]=h[f]);if(a&&a.id&&(o.id=a.id.toString()),a&&a.text&&(o.text=a.text),a&&a.data&&a.data.jstree&&a.data.jstree.icon&&(o.icon=a.data.jstree.icon),(o.icon===b||null===o.icon||""===o.icon)&&(o.icon=!0),a&&a.data&&(o.data=a.data,a.data.jstree))for(f in a.data.jstree)a.data.jstree.hasOwnProperty(f)&&(o.state[f]=a.data.jstree[f]);if(a&&"object"==typeof a.state)for(f in a.state)a.state.hasOwnProperty(f)&&(o.state[f]=a.state[f]);if(a&&"object"==typeof a.li_attr)for(f in a.li_attr)a.li_attr.hasOwnProperty(f)&&(o.li_attr[f]=a.li_attr[f]);if(o.li_attr.id&&!o.id&&(o.id=o.li_attr.id.toString()),o.id||(o.id=e),o.li_attr.id||(o.li_attr.id=o.id),a&&"object"==typeof a.a_attr)for(f in a.a_attr)a.a_attr.hasOwnProperty(f)&&(o.a_attr[f]=a.a_attr[f]);if(a&&a.children&&a.children.length){for(f=0,l=a.children.length;l>f;f++)m=s(a.children[f],o.id,d),n=k[m],o.children.push(m),n.children_d.length&&(o.children_d=o.children_d.concat(n.children_d));o.children_d=o.children_d.concat(o.children)}return a&&a.children&&a.children===!0&&(o.state.loaded=!1,o.children=[],o.children_d=[]),delete a.data,delete a.children,o.original=a,k[o.id]=o,o.state.selected&&g.push(o.id),o.id};if(c.length&&c[0].id!==b&&c[0].parent!==b){for(o=0,p=c.length;p>o;o++)c[o].children||(c[o].children=[]),k[c[o].id.toString()]=c[o];for(o=0,p=c.length;p>o;o++)k[c[o].parent.toString()].children.push(c[o].id.toString()),l.children_d.push(c[o].id.toString());for(o=0,p=l.children.length;p>o;o++)n=r(k[l.children[o]],d,l.parents.concat()),f.push(n),k[n].children_d.length&&(f=f.concat(k[n].children_d));for(o=0,p=l.parents.length;p>o;o++)k[l.parents[o]].children_d=k[l.parents[o]].children_d.concat(f);q={cnt:j,mod:k,sel:m,par:d,dpc:f,add:g}}else{for(o=0,p=c.length;p>o;o++)n=s(c[o],d,l.parents.concat()),n&&(e.push(n),f.push(n),k[n].children_d.length&&(f=f.concat(k[n].children_d)));for(l.children=e,l.children_d=f,o=0,p=l.parents.length;p>o;o++)k[l.parents[o]].children_d=k[l.parents[o]].children_d.concat(f);q={cnt:j,mod:k,sel:m,par:d,dpc:f,add:g}}return"undefined"!=typeof window&&"undefined"!=typeof window.document?q:void postMessage(q)},i=function(b,c){if(null!==this.element){if(this._cnt=b.cnt,this._model.data=b.mod,c){var e,f,g=b.add,h=b.sel,i=this._data.core.selected.slice(),j=this._model.data;if(h.length!==i.length||a.vakata.array_unique(h.concat(i)).length!==h.length){for(e=0,f=h.length;f>e;e++)-1===a.inArray(h[e],g)&&-1===a.inArray(h[e],i)&&(j[h[e]].state.selected=!1);for(e=0,f=i.length;f>e;e++)-1===a.inArray(i[e],h)&&(j[i[e]].state.selected=!0)}}b.add.length&&(this._data.core.selected=this._data.core.selected.concat(b.add)),this.trigger("model",{nodes:b.dpc,parent:b.par}),b.par!==a.jstree.root?(this._node_changed(b.par),this.redraw()):this.redraw(!0),b.add.length&&this.trigger("changed",{action:"model",selected:this._data.core.selected}),d.call(this,!0)}};if(this.settings.core.worker&&window.Blob&&window.URL&&window.Worker)try{null===this._wrk&&(this._wrk=window.URL.createObjectURL(new window.Blob(["self.onmessage = "+h.toString()],{type:"text/javascript"}))),!this._data.core.working||e?(this._data.core.working=!0,f=new window.Worker(this._wrk),f.onmessage=a.proxy(function(a){i.call(this,a.data,!0);try{f.terminate(),f=null}catch(b){}this._data.core.worker_queue.length?this._append_json_data.apply(this,this._data.core.worker_queue.shift()):this._data.core.working=!1},this),g.par?f.postMessage(g):this._data.core.worker_queue.length?this._append_json_data.apply(this,this._data.core.worker_queue.shift()):this._data.core.working=!1):this._data.core.worker_queue.push([b,c,d,!0])}catch(j){i.call(this,h(g),!1),this._data.core.worker_queue.length?this._append_json_data.apply(this,this._data.core.worker_queue.shift()):this._data.core.working=!1}else i.call(this,h(g),!1)}},_parse_model_from_html:function(c,d,e){e=e?[].concat(e):[],d&&e.unshift(d);var f,g,h=this._model.data,i={id:!1,text:!1,icon:!0,parent:d,parents:e,children:[],children_d:[],data:null,state:{},li_attr:{id:!1},a_attr:{href:"#"},original:!1},j,k,l;for(j in this._model.default_state)this._model.default_state.hasOwnProperty(j)&&(i.state[j]=this._model.default_state[j]);if(k=a.vakata.attributes(c,!0),a.each(k,function(b,c){return c=a.trim(c),c.length?(i.li_attr[b]=c,void("id"===b&&(i.id=c.toString()))):!0}),k=c.children("a").first(),k.length&&(k=a.vakata.attributes(k,!0),a.each(k,function(b,c){c=a.trim(c),c.length&&(i.a_attr[b]=c)})),k=c.children("a").first().length?c.children("a").first().clone():c.clone(),k.children("ins, i, ul").remove(),k=k.html(),k=a("<div />").html(k),i.text=this.settings.core.force_text?k.text():k.html(),k=c.data(),i.data=k?a.extend(!0,{},k):null,i.state.opened=c.hasClass("jstree-open"),i.state.selected=c.children("a").hasClass("jstree-clicked"),i.state.disabled=c.children("a").hasClass("jstree-disabled"),i.data&&i.data.jstree)for(j in i.data.jstree)i.data.jstree.hasOwnProperty(j)&&(i.state[j]=i.data.jstree[j]);k=c.children("a").children(".jstree-themeicon"),k.length&&(i.icon=k.hasClass("jstree-themeicon-hidden")?!1:k.attr("rel")),i.state.icon!==b&&(i.icon=i.state.icon),(i.icon===b||null===i.icon||""===i.icon)&&(i.icon=!0),k=c.children("ul").children("li");do l="j"+this._id+"_"+ ++this._cnt;while(h[l]);return i.id=i.li_attr.id?i.li_attr.id.toString():l,k.length?(k.each(a.proxy(function(b,c){f=this._parse_model_from_html(a(c),i.id,e),g=this._model.data[f],i.children.push(f),g.children_d.length&&(i.children_d=i.children_d.concat(g.children_d))},this)),i.children_d=i.children_d.concat(i.children)):c.hasClass("jstree-closed")&&(i.state.loaded=!1),i.li_attr["class"]&&(i.li_attr["class"]=i.li_attr["class"].replace("jstree-closed","").replace("jstree-open","")),i.a_attr["class"]&&(i.a_attr["class"]=i.a_attr["class"].replace("jstree-clicked","").replace("jstree-disabled","")),h[i.id]=i,i.state.selected&&this._data.core.selected.push(i.id),i.id},_parse_model_from_flat_json:function(a,c,d){d=d?d.concat():[],c&&d.unshift(c);var e=a.id.toString(),f=this._model.data,g=this._model.default_state,h,i,j,k,l={id:e,text:a.text||"",icon:a.icon!==b?a.icon:!0,parent:c,parents:d,children:a.children||[],children_d:a.children_d||[],data:a.data,state:{},li_attr:{id:!1},a_attr:{href:"#"},original:!1};for(h in g)g.hasOwnProperty(h)&&(l.state[h]=g[h]);if(a&&a.data&&a.data.jstree&&a.data.jstree.icon&&(l.icon=a.data.jstree.icon),(l.icon===b||null===l.icon||""===l.icon)&&(l.icon=!0),a&&a.data&&(l.data=a.data,a.data.jstree))for(h in a.data.jstree)a.data.jstree.hasOwnProperty(h)&&(l.state[h]=a.data.jstree[h]);if(a&&"object"==typeof a.state)for(h in a.state)a.state.hasOwnProperty(h)&&(l.state[h]=a.state[h]);if(a&&"object"==typeof a.li_attr)for(h in a.li_attr)a.li_attr.hasOwnProperty(h)&&(l.li_attr[h]=a.li_attr[h]);if(l.li_attr.id||(l.li_attr.id=e),a&&"object"==typeof a.a_attr)for(h in a.a_attr)a.a_attr.hasOwnProperty(h)&&(l.a_attr[h]=a.a_attr[h]);for(a&&a.children&&a.children===!0&&(l.state.loaded=!1,l.children=[],l.children_d=[]),f[l.id]=l,h=0,i=l.children.length;i>h;h++)j=this._parse_model_from_flat_json(f[l.children[h]],l.id,d),k=f[j],l.children_d.push(j),k.children_d.length&&(l.children_d=l.children_d.concat(k.children_d));return delete a.data,delete a.children,f[l.id].original=a,l.state.selected&&this._data.core.selected.push(l.id),l.id},_parse_model_from_json:function(a,c,d){d=d?d.concat():[],c&&d.unshift(c);var e=!1,f,g,h,i,j=this._model.data,k=this._model.default_state,l;do e="j"+this._id+"_"+ ++this._cnt;while(j[e]);l={id:!1,text:"string"==typeof a?a:"",icon:"object"==typeof a&&a.icon!==b?a.icon:!0,parent:c,parents:d,children:[],children_d:[],data:null,state:{},li_attr:{id:!1},a_attr:{href:"#"},original:!1};for(f in k)k.hasOwnProperty(f)&&(l.state[f]=k[f]);if(a&&a.id&&(l.id=a.id.toString()),a&&a.text&&(l.text=a.text),a&&a.data&&a.data.jstree&&a.data.jstree.icon&&(l.icon=a.data.jstree.icon),(l.icon===b||null===l.icon||""===l.icon)&&(l.icon=!0),a&&a.data&&(l.data=a.data,a.data.jstree))for(f in a.data.jstree)a.data.jstree.hasOwnProperty(f)&&(l.state[f]=a.data.jstree[f]);if(a&&"object"==typeof a.state)for(f in a.state)a.state.hasOwnProperty(f)&&(l.state[f]=a.state[f]);if(a&&"object"==typeof a.li_attr)for(f in a.li_attr)a.li_attr.hasOwnProperty(f)&&(l.li_attr[f]=a.li_attr[f]);if(l.li_attr.id&&!l.id&&(l.id=l.li_attr.id.toString()),l.id||(l.id=e),l.li_attr.id||(l.li_attr.id=l.id),a&&"object"==typeof a.a_attr)for(f in a.a_attr)a.a_attr.hasOwnProperty(f)&&(l.a_attr[f]=a.a_attr[f]);if(a&&a.children&&a.children.length){for(f=0,g=a.children.length;g>f;f++)h=this._parse_model_from_json(a.children[f],l.id,d),i=j[h],l.children.push(h),i.children_d.length&&(l.children_d=l.children_d.concat(i.children_d));l.children_d=l.children_d.concat(l.children)}return a&&a.children&&a.children===!0&&(l.state.loaded=!1,l.children=[],l.children_d=[]),delete a.data,delete a.children,l.original=a,j[l.id]=l,l.state.selected&&this._data.core.selected.push(l.id),l.id},_redraw:function(){var b=this._model.force_full_redraw?this._model.data[a.jstree.root].children.concat([]):this._model.changed.concat([]),c=i.createElement("UL"),d,e,f,g=this._data.core.focused;for(e=0,f=b.length;f>e;e++)d=this.redraw_node(b[e],!0,this._model.force_full_redraw),d&&this._model.force_full_redraw&&c.appendChild(d);this._model.force_full_redraw&&(c.className=this.get_container_ul()[0].className,c.setAttribute("role","group"),this.element.empty().append(c)),null!==g&&(d=this.get_node(g,!0),d&&d.length&&d.children(".jstree-anchor")[0]!==i.activeElement?d.children(".jstree-anchor").focus():this._data.core.focused=null),this._model.force_full_redraw=!1,this._model.changed=[],this.trigger("redraw",{nodes:b})},redraw:function(a){a&&(this._model.force_full_redraw=!0),this._redraw()},draw_children:function(b){var c=this.get_node(b),d=!1,e=!1,f=!1,g=i;if(!c)return!1;if(c.id===a.jstree.root)return this.redraw(!0);if(b=this.get_node(b,!0),!b||!b.length)return!1;if(b.children(".jstree-children").remove(),b=b[0],c.children.length&&c.state.loaded){for(f=g.createElement("UL"),f.setAttribute("role","group"),f.className="jstree-children",d=0,e=c.children.length;e>d;d++)f.appendChild(this.redraw_node(c.children[d],!0,!0));b.appendChild(f)}},redraw_node:function(b,c,d,e){var f=this.get_node(b),g=!1,h=!1,k=!1,l=!1,m=!1,n=!1,o="",p=i,q=this._model.data,r=!1,s=!1,t=null,u=0,v=0,w=!1,x=!1;if(!f)return!1;if(f.id===a.jstree.root)return this.redraw(!0);if(c=c||0===f.children.length,b=i.querySelector?this.element[0].querySelector("#"+(-1!=="0123456789".indexOf(f.id[0])?"\\3"+f.id[0]+" "+f.id.substr(1).replace(a.jstree.idregex,"\\$&"):f.id.replace(a.jstree.idregex,"\\$&"))):i.getElementById(f.id))b=a(b),d||(g=b.parent().parent()[0],g===this.element[0]&&(g=null),h=b.index()),c||!f.children.length||b.children(".jstree-children").length||(c=!0),
c||(k=b.children(".jstree-children")[0]),r=b.children(".jstree-anchor")[0]===i.activeElement,b.remove();else if(c=!0,!d){if(g=f.parent!==a.jstree.root?a("#"+f.parent.replace(a.jstree.idregex,"\\$&"),this.element)[0]:null,!(null===g||g&&q[f.parent].state.opened))return!1;h=a.inArray(f.id,null===g?q[a.jstree.root].children:q[f.parent].children)}b=j.cloneNode(!0),o="jstree-node ";for(l in f.li_attr)if(f.li_attr.hasOwnProperty(l)){if("id"===l)continue;"class"!==l?b.setAttribute(l,f.li_attr[l]):o+=f.li_attr[l]}for(f.a_attr.id||(f.a_attr.id=f.id+"_anchor"),b.setAttribute("aria-selected",!!f.state.selected),b.setAttribute("aria-level",f.parents.length),b.setAttribute("aria-labelledby",f.a_attr.id),f.state.disabled&&b.setAttribute("aria-disabled",!0),l=0,m=f.children.length;m>l;l++)if(!q[f.children[l]].state.hidden){w=!0;break}if(null!==f.parent&&q[f.parent]&&!f.state.hidden&&(l=a.inArray(f.id,q[f.parent].children),x=f.id,-1!==l))for(l++,m=q[f.parent].children.length;m>l;l++)if(q[q[f.parent].children[l]].state.hidden||(x=q[f.parent].children[l]),x!==f.id)break;f.state.hidden&&(o+=" jstree-hidden"),f.state.loaded&&!w?o+=" jstree-leaf":(o+=f.state.opened&&f.state.loaded?" jstree-open":" jstree-closed",b.setAttribute("aria-expanded",f.state.opened&&f.state.loaded)),x===f.id&&(o+=" jstree-last"),b.id=f.id,b.className=o,o=(f.state.selected?" jstree-clicked":"")+(f.state.disabled?" jstree-disabled":"");for(m in f.a_attr)if(f.a_attr.hasOwnProperty(m)){if("href"===m&&"#"===f.a_attr[m])continue;"class"!==m?b.childNodes[1].setAttribute(m,f.a_attr[m]):o+=" "+f.a_attr[m]}if(o.length&&(b.childNodes[1].className="jstree-anchor "+o),(f.icon&&f.icon!==!0||f.icon===!1)&&(f.icon===!1?b.childNodes[1].childNodes[0].className+=" jstree-themeicon-hidden":-1===f.icon.indexOf("/")&&-1===f.icon.indexOf(".")?b.childNodes[1].childNodes[0].className+=" "+f.icon+" jstree-themeicon-custom":(b.childNodes[1].childNodes[0].style.backgroundImage="url("+f.icon+")",b.childNodes[1].childNodes[0].style.backgroundPosition="center center",b.childNodes[1].childNodes[0].style.backgroundSize="auto",b.childNodes[1].childNodes[0].className+=" jstree-themeicon-custom")),this.settings.core.force_text?b.childNodes[1].appendChild(p.createTextNode(f.text)):b.childNodes[1].innerHTML+=f.text,c&&f.children.length&&(f.state.opened||e)&&f.state.loaded){for(n=p.createElement("UL"),n.setAttribute("role","group"),n.className="jstree-children",l=0,m=f.children.length;m>l;l++)n.appendChild(this.redraw_node(f.children[l],c,!0));b.appendChild(n)}if(k&&b.appendChild(k),!d){for(g||(g=this.element[0]),l=0,m=g.childNodes.length;m>l;l++)if(g.childNodes[l]&&g.childNodes[l].className&&-1!==g.childNodes[l].className.indexOf("jstree-children")){t=g.childNodes[l];break}t||(t=p.createElement("UL"),t.setAttribute("role","group"),t.className="jstree-children",g.appendChild(t)),g=t,h<g.childNodes.length?g.insertBefore(b,g.childNodes[h]):g.appendChild(b),r&&(u=this.element[0].scrollTop,v=this.element[0].scrollLeft,b.childNodes[1].focus(),this.element[0].scrollTop=u,this.element[0].scrollLeft=v)}return f.state.opened&&!f.state.loaded&&(f.state.opened=!1,setTimeout(a.proxy(function(){this.open_node(f.id,!1,0)},this),0)),b},open_node:function(c,d,e){var f,g,h,i;if(a.isArray(c)){for(c=c.slice(),f=0,g=c.length;g>f;f++)this.open_node(c[f],d,e);return!0}return c=this.get_node(c),c&&c.id!==a.jstree.root?(e=e===b?this.settings.core.animation:e,this.is_closed(c)?this.is_loaded(c)?(h=this.get_node(c,!0),i=this,h.length&&(e&&h.children(".jstree-children").length&&h.children(".jstree-children").stop(!0,!0),c.children.length&&!this._firstChild(h.children(".jstree-children")[0])&&this.draw_children(c),e?(this.trigger("before_open",{node:c}),h.children(".jstree-children").css("display","none").end().removeClass("jstree-closed").addClass("jstree-open").attr("aria-expanded",!0).children(".jstree-children").stop(!0,!0).slideDown(e,function(){this.style.display="",i.trigger("after_open",{node:c})})):(this.trigger("before_open",{node:c}),h[0].className=h[0].className.replace("jstree-closed","jstree-open"),h[0].setAttribute("aria-expanded",!0))),c.state.opened=!0,d&&d.call(this,c,!0),h.length||this.trigger("before_open",{node:c}),this.trigger("open_node",{node:c}),e&&h.length||this.trigger("after_open",{node:c}),!0):this.is_loading(c)?setTimeout(a.proxy(function(){this.open_node(c,d,e)},this),500):void this.load_node(c,function(a,b){return b?this.open_node(a,d,e):d?d.call(this,a,!1):!1}):(d&&d.call(this,c,!1),!1)):!1},_open_to:function(b){if(b=this.get_node(b),!b||b.id===a.jstree.root)return!1;var c,d,e=b.parents;for(c=0,d=e.length;d>c;c+=1)c!==a.jstree.root&&this.open_node(e[c],!1,0);return a("#"+b.id.replace(a.jstree.idregex,"\\$&"),this.element)},close_node:function(c,d){var e,f,g,h;if(a.isArray(c)){for(c=c.slice(),e=0,f=c.length;f>e;e++)this.close_node(c[e],d);return!0}return c=this.get_node(c),c&&c.id!==a.jstree.root?this.is_closed(c)?!1:(d=d===b?this.settings.core.animation:d,g=this,h=this.get_node(c,!0),h.length&&(d?h.children(".jstree-children").attr("style","display:block !important").end().removeClass("jstree-open").addClass("jstree-closed").attr("aria-expanded",!1).children(".jstree-children").stop(!0,!0).slideUp(d,function(){this.style.display="",h.children(".jstree-children").remove(),g.trigger("after_close",{node:c})}):(h[0].className=h[0].className.replace("jstree-open","jstree-closed"),h.attr("aria-expanded",!1).children(".jstree-children").remove())),c.state.opened=!1,this.trigger("close_node",{node:c}),void(d&&h.length||this.trigger("after_close",{node:c}))):!1},toggle_node:function(b){var c,d;if(a.isArray(b)){for(b=b.slice(),c=0,d=b.length;d>c;c++)this.toggle_node(b[c]);return!0}return this.is_closed(b)?this.open_node(b):this.is_open(b)?this.close_node(b):void 0},open_all:function(b,c,d){if(b||(b=a.jstree.root),b=this.get_node(b),!b)return!1;var e=b.id===a.jstree.root?this.get_container_ul():this.get_node(b,!0),f,g,h;if(!e.length){for(f=0,g=b.children_d.length;g>f;f++)this.is_closed(this._model.data[b.children_d[f]])&&(this._model.data[b.children_d[f]].state.opened=!0);return this.trigger("open_all",{node:b})}d=d||e,h=this,e=this.is_closed(b)?e.find(".jstree-closed").addBack():e.find(".jstree-closed"),e.each(function(){h.open_node(this,function(a,b){b&&this.is_parent(a)&&this.open_all(a,c,d)},c||0)}),0===d.find(".jstree-closed").length&&this.trigger("open_all",{node:this.get_node(d)})},close_all:function(b,c){if(b||(b=a.jstree.root),b=this.get_node(b),!b)return!1;var d=b.id===a.jstree.root?this.get_container_ul():this.get_node(b,!0),e=this,f,g;for(d.length&&(d=this.is_open(b)?d.find(".jstree-open").addBack():d.find(".jstree-open"),a(d.get().reverse()).each(function(){e.close_node(this,c||0)})),f=0,g=b.children_d.length;g>f;f++)this._model.data[b.children_d[f]].state.opened=!1;this.trigger("close_all",{node:b})},is_disabled:function(a){return a=this.get_node(a),a&&a.state&&a.state.disabled},enable_node:function(b){var c,d;if(a.isArray(b)){for(b=b.slice(),c=0,d=b.length;d>c;c++)this.enable_node(b[c]);return!0}return b=this.get_node(b),b&&b.id!==a.jstree.root?(b.state.disabled=!1,this.get_node(b,!0).children(".jstree-anchor").removeClass("jstree-disabled").attr("aria-disabled",!1),void this.trigger("enable_node",{node:b})):!1},disable_node:function(b){var c,d;if(a.isArray(b)){for(b=b.slice(),c=0,d=b.length;d>c;c++)this.disable_node(b[c]);return!0}return b=this.get_node(b),b&&b.id!==a.jstree.root?(b.state.disabled=!0,this.get_node(b,!0).children(".jstree-anchor").addClass("jstree-disabled").attr("aria-disabled",!0),void this.trigger("disable_node",{node:b})):!1},hide_node:function(b,c){var d,e;if(a.isArray(b)){for(b=b.slice(),d=0,e=b.length;e>d;d++)this.hide_node(b[d],!0);return this.redraw(),!0}return b=this.get_node(b),b&&b.id!==a.jstree.root?void(b.state.hidden||(b.state.hidden=!0,this._node_changed(b.parent),c||this.redraw(),this.trigger("hide_node",{node:b}))):!1},show_node:function(b,c){var d,e;if(a.isArray(b)){for(b=b.slice(),d=0,e=b.length;e>d;d++)this.show_node(b[d],!0);return this.redraw(),!0}return b=this.get_node(b),b&&b.id!==a.jstree.root?void(b.state.hidden&&(b.state.hidden=!1,this._node_changed(b.parent),c||this.redraw(),this.trigger("show_node",{node:b}))):!1},hide_all:function(b){var c,d=this._model.data,e=[];for(c in d)d.hasOwnProperty(c)&&c!==a.jstree.root&&!d[c].state.hidden&&(d[c].state.hidden=!0,e.push(c));return this._model.force_full_redraw=!0,b||this.redraw(),this.trigger("hide_all",{nodes:e}),e},show_all:function(b){var c,d=this._model.data,e=[];for(c in d)d.hasOwnProperty(c)&&c!==a.jstree.root&&d[c].state.hidden&&(d[c].state.hidden=!1,e.push(c));return this._model.force_full_redraw=!0,b||this.redraw(),this.trigger("show_all",{nodes:e}),e},activate_node:function(a,c){if(this.is_disabled(a))return!1;if(c&&"object"==typeof c||(c={}),this._data.core.last_clicked=this._data.core.last_clicked&&this._data.core.last_clicked.id!==b?this.get_node(this._data.core.last_clicked.id):null,this._data.core.last_clicked&&!this._data.core.last_clicked.state.selected&&(this._data.core.last_clicked=null),!this._data.core.last_clicked&&this._data.core.selected.length&&(this._data.core.last_clicked=this.get_node(this._data.core.selected[this._data.core.selected.length-1])),this.settings.core.multiple&&(c.metaKey||c.ctrlKey||c.shiftKey)&&(!c.shiftKey||this._data.core.last_clicked&&this.get_parent(a)&&this.get_parent(a)===this._data.core.last_clicked.parent))if(c.shiftKey){var d=this.get_node(a).id,e=this._data.core.last_clicked.id,f=this.get_node(this._data.core.last_clicked.parent).children,g=!1,h,i;for(h=0,i=f.length;i>h;h+=1)f[h]===d&&(g=!g),f[h]===e&&(g=!g),this.is_disabled(f[h])||!g&&f[h]!==d&&f[h]!==e?this.deselect_node(f[h],!0,c):this.select_node(f[h],!0,!1,c);this.trigger("changed",{action:"select_node",node:this.get_node(a),selected:this._data.core.selected,event:c})}else this.is_selected(a)?this.deselect_node(a,!1,c):this.select_node(a,!1,!1,c);else!this.settings.core.multiple&&(c.metaKey||c.ctrlKey||c.shiftKey)&&this.is_selected(a)?this.deselect_node(a,!1,c):(this.deselect_all(!0),this.select_node(a,!1,!1,c),this._data.core.last_clicked=this.get_node(a));this.trigger("activate_node",{node:this.get_node(a),event:c})},hover_node:function(a){if(a=this.get_node(a,!0),!a||!a.length||a.children(".jstree-hovered").length)return!1;var b=this.element.find(".jstree-hovered"),c=this.element;b&&b.length&&this.dehover_node(b),a.children(".jstree-anchor").addClass("jstree-hovered"),this.trigger("hover_node",{node:this.get_node(a)}),setTimeout(function(){c.attr("aria-activedescendant",a[0].id)},0)},dehover_node:function(a){return a=this.get_node(a,!0),a&&a.length&&a.children(".jstree-hovered").length?(a.children(".jstree-anchor").removeClass("jstree-hovered"),void this.trigger("dehover_node",{node:this.get_node(a)})):!1},select_node:function(b,c,d,e){var f,g,h,i;if(a.isArray(b)){for(b=b.slice(),g=0,h=b.length;h>g;g++)this.select_node(b[g],c,d,e);return!0}return b=this.get_node(b),b&&b.id!==a.jstree.root?(f=this.get_node(b,!0),void(b.state.selected||(b.state.selected=!0,this._data.core.selected.push(b.id),d||(f=this._open_to(b)),f&&f.length&&f.attr("aria-selected",!0).children(".jstree-anchor").addClass("jstree-clicked"),this.trigger("select_node",{node:b,selected:this._data.core.selected,event:e}),c||this.trigger("changed",{action:"select_node",node:b,selected:this._data.core.selected,event:e})))):!1},deselect_node:function(b,c,d){var e,f,g;if(a.isArray(b)){for(b=b.slice(),e=0,f=b.length;f>e;e++)this.deselect_node(b[e],c,d);return!0}return b=this.get_node(b),b&&b.id!==a.jstree.root?(g=this.get_node(b,!0),void(b.state.selected&&(b.state.selected=!1,this._data.core.selected=a.vakata.array_remove_item(this._data.core.selected,b.id),g.length&&g.attr("aria-selected",!1).children(".jstree-anchor").removeClass("jstree-clicked"),this.trigger("deselect_node",{node:b,selected:this._data.core.selected,event:d}),c||this.trigger("changed",{action:"deselect_node",node:b,selected:this._data.core.selected,event:d})))):!1},select_all:function(b){var c=this._data.core.selected.concat([]),d,e;for(this._data.core.selected=this._model.data[a.jstree.root].children_d.concat(),d=0,e=this._data.core.selected.length;e>d;d++)this._model.data[this._data.core.selected[d]]&&(this._model.data[this._data.core.selected[d]].state.selected=!0);this.redraw(!0),this.trigger("select_all",{selected:this._data.core.selected}),b||this.trigger("changed",{action:"select_all",selected:this._data.core.selected,old_selection:c})},deselect_all:function(a){var b=this._data.core.selected.concat([]),c,d;for(c=0,d=this._data.core.selected.length;d>c;c++)this._model.data[this._data.core.selected[c]]&&(this._model.data[this._data.core.selected[c]].state.selected=!1);this._data.core.selected=[],this.element.find(".jstree-clicked").removeClass("jstree-clicked").parent().attr("aria-selected",!1),this.trigger("deselect_all",{selected:this._data.core.selected,node:b}),a||this.trigger("changed",{action:"deselect_all",selected:this._data.core.selected,old_selection:b})},is_selected:function(b){return b=this.get_node(b),b&&b.id!==a.jstree.root?b.state.selected:!1},get_selected:function(b){return b?a.map(this._data.core.selected,a.proxy(function(a){return this.get_node(a)},this)):this._data.core.selected.slice()},get_top_selected:function(b){var c=this.get_selected(!0),d={},e,f,g,h;for(e=0,f=c.length;f>e;e++)d[c[e].id]=c[e];for(e=0,f=c.length;f>e;e++)for(g=0,h=c[e].children_d.length;h>g;g++)d[c[e].children_d[g]]&&delete d[c[e].children_d[g]];c=[];for(e in d)d.hasOwnProperty(e)&&c.push(e);return b?a.map(c,a.proxy(function(a){return this.get_node(a)},this)):c},get_bottom_selected:function(b){var c=this.get_selected(!0),d=[],e,f;for(e=0,f=c.length;f>e;e++)c[e].children.length||d.push(c[e].id);return b?a.map(d,a.proxy(function(a){return this.get_node(a)},this)):d},get_state:function(){var b={core:{open:[],scroll:{left:this.element.scrollLeft(),top:this.element.scrollTop()},selected:[]}},c;for(c in this._model.data)this._model.data.hasOwnProperty(c)&&c!==a.jstree.root&&(this._model.data[c].state.opened&&b.core.open.push(c),this._model.data[c].state.selected&&b.core.selected.push(c));return b},set_state:function(c,d){if(c){if(c.core){var e,f,g,h,i;if(c.core.open)return a.isArray(c.core.open)&&c.core.open.length?this._load_nodes(c.core.open,function(a){this.open_node(a,!1,0),delete c.core.open,this.set_state(c,d)},!0):(delete c.core.open,this.set_state(c,d)),!1;if(c.core.scroll)return c.core.scroll&&c.core.scroll.left!==b&&this.element.scrollLeft(c.core.scroll.left),c.core.scroll&&c.core.scroll.top!==b&&this.element.scrollTop(c.core.scroll.top),delete c.core.scroll,this.set_state(c,d),!1;if(c.core.selected)return h=this,this.deselect_all(),a.each(c.core.selected,function(a,b){h.select_node(b,!1,!0)}),delete c.core.selected,this.set_state(c,d),!1;for(i in c)c.hasOwnProperty(i)&&"core"!==i&&-1===a.inArray(i,this.settings.plugins)&&delete c[i];if(a.isEmptyObject(c.core))return delete c.core,this.set_state(c,d),!1}return a.isEmptyObject(c)?(c=null,d&&d.call(this),this.trigger("set_state"),!1):!0}return!1},refresh:function(b,c){this._data.core.state=c===!0?{}:this.get_state(),c&&a.isFunction(c)&&(this._data.core.state=c.call(this,this._data.core.state)),this._cnt=0,this._model.data={},this._model.data[a.jstree.root]={id:a.jstree.root,parent:null,parents:[],children:[],children_d:[],state:{loaded:!1}},this._data.core.selected=[],this._data.core.last_clicked=null,this._data.core.focused=null;var d=this.get_container_ul()[0].className;b||(this.element.html("<ul class='"+d+"' role='group'><li class='jstree-initial-node jstree-loading jstree-leaf jstree-last' role='treeitem' id='j"+this._id+"_loading'><i class='jstree-icon jstree-ocl'></i><a class='jstree-anchor' href='#'><i class='jstree-icon jstree-themeicon-hidden'></i>"+this.get_string("Loading ...")+"</a></li></ul>"),this.element.attr("aria-activedescendant","j"+this._id+"_loading")),this.load_node(a.jstree.root,function(b,c){c&&(this.get_container_ul()[0].className=d,this._firstChild(this.get_container_ul()[0])&&this.element.attr("aria-activedescendant",this._firstChild(this.get_container_ul()[0]).id),this.set_state(a.extend(!0,{},this._data.core.state),function(){this.trigger("refresh")})),this._data.core.state=null})},refresh_node:function(b){if(b=this.get_node(b),!b||b.id===a.jstree.root)return!1;var c=[],d=[],e=this._data.core.selected.concat([]);d.push(b.id),b.state.opened===!0&&c.push(b.id),this.get_node(b,!0).find(".jstree-open").each(function(){c.push(this.id)}),this._load_nodes(d,a.proxy(function(a){this.open_node(c,!1,0),this.select_node(this._data.core.selected),this.trigger("refresh_node",{node:b,nodes:a})},this))},set_id:function(b,c){if(b=this.get_node(b),!b||b.id===a.jstree.root)return!1;var d,e,f=this._model.data;for(c=c.toString(),f[b.parent].children[a.inArray(b.id,f[b.parent].children)]=c,d=0,e=b.parents.length;e>d;d++)f[b.parents[d]].children_d[a.inArray(b.id,f[b.parents[d]].children_d)]=c;for(d=0,e=b.children.length;e>d;d++)f[b.children[d]].parent=c;for(d=0,e=b.children_d.length;e>d;d++)f[b.children_d[d]].parents[a.inArray(b.id,f[b.children_d[d]].parents)]=c;return d=a.inArray(b.id,this._data.core.selected),-1!==d&&(this._data.core.selected[d]=c),d=this.get_node(b.id,!0),d&&(d.attr("id",c).children(".jstree-anchor").attr("id",c+"_anchor").end().attr("aria-labelledby",c+"_anchor"),this.element.attr("aria-activedescendant")===b.id&&this.element.attr("aria-activedescendant",c)),delete f[b.id],b.id=c,b.li_attr.id=c,f[c]=b,!0},get_text:function(b){return b=this.get_node(b),b&&b.id!==a.jstree.root?b.text:!1},set_text:function(b,c){var d,e;if(a.isArray(b)){for(b=b.slice(),d=0,e=b.length;e>d;d++)this.set_text(b[d],c);return!0}return b=this.get_node(b),b&&b.id!==a.jstree.root?(b.text=c,this.get_node(b,!0).length&&this.redraw_node(b.id),this.trigger("set_text",{obj:b,text:c}),!0):!1},get_json:function(b,c,d){if(b=this.get_node(b||a.jstree.root),!b)return!1;c&&c.flat&&!d&&(d=[]);var e={id:b.id,text:b.text,icon:this.get_icon(b),li_attr:a.extend(!0,{},b.li_attr),a_attr:a.extend(!0,{},b.a_attr),state:{},data:c&&c.no_data?!1:a.extend(!0,{},b.data)},f,g;if(c&&c.flat?e.parent=b.parent:e.children=[],!c||!c.no_state)for(f in b.state)b.state.hasOwnProperty(f)&&(e.state[f]=b.state[f]);if(c&&c.no_id&&(delete e.id,e.li_attr&&e.li_attr.id&&delete e.li_attr.id,e.a_attr&&e.a_attr.id&&delete e.a_attr.id),c&&c.flat&&b.id!==a.jstree.root&&d.push(e),!c||!c.no_children)for(f=0,g=b.children.length;g>f;f++)c&&c.flat?this.get_json(b.children[f],c,d):e.children.push(this.get_json(b.children[f],c));return c&&c.flat?d:b.id===a.jstree.root?e.children:e},create_node:function(c,d,e,f,g){if(null===c&&(c=a.jstree.root),c=this.get_node(c),!c)return!1;if(e=e===b?"last":e,!e.toString().match(/^(before|after)$/)&&!g&&!this.is_loaded(c))return this.load_node(c,function(){this.create_node(c,d,e,f,!0)});d||(d={text:this.get_string("New node")}),"string"==typeof d&&(d={text:d}),d.text===b&&(d.text=this.get_string("New node"));var h,i,j,k;switch(c.id===a.jstree.root&&("before"===e&&(e="first"),"after"===e&&(e="last")),e){case"before":h=this.get_node(c.parent),e=a.inArray(c.id,h.children),c=h;break;case"after":h=this.get_node(c.parent),e=a.inArray(c.id,h.children)+1,c=h;break;case"inside":case"first":e=0;break;case"last":e=c.children.length;break;default:e||(e=0)}if(e>c.children.length&&(e=c.children.length),d.id||(d.id=!0),!this.check("create_node",d,c,e))return this.settings.core.error.call(this,this._data.core.last_error),!1;if(d.id===!0&&delete d.id,d=this._parse_model_from_json(d,c.id,c.parents.concat()),!d)return!1;for(h=this.get_node(d),i=[],i.push(d),i=i.concat(h.children_d),this.trigger("model",{nodes:i,parent:c.id}),c.children_d=c.children_d.concat(i),j=0,k=c.parents.length;k>j;j++)this._model.data[c.parents[j]].children_d=this._model.data[c.parents[j]].children_d.concat(i);for(d=h,h=[],j=0,k=c.children.length;k>j;j++)h[j>=e?j+1:j]=c.children[j];return h[e]=d.id,c.children=h,this.redraw_node(c,!0),f&&f.call(this,this.get_node(d)),this.trigger("create_node",{node:this.get_node(d),parent:c.id,position:e}),d.id},rename_node:function(b,c){var d,e,f;if(a.isArray(b)){for(b=b.slice(),d=0,e=b.length;e>d;d++)this.rename_node(b[d],c);return!0}return b=this.get_node(b),b&&b.id!==a.jstree.root?(f=b.text,this.check("rename_node",b,this.get_parent(b),c)?(this.set_text(b,c),this.trigger("rename_node",{node:b,text:c,old:f}),!0):(this.settings.core.error.call(this,this._data.core.last_error),!1)):!1},delete_node:function(b){var c,d,e,f,g,h,i,j,k,l,m,n;if(a.isArray(b)){for(b=b.slice(),c=0,d=b.length;d>c;c++)this.delete_node(b[c]);return!0}if(b=this.get_node(b),!b||b.id===a.jstree.root)return!1;if(e=this.get_node(b.parent),f=a.inArray(b.id,e.children),l=!1,!this.check("delete_node",b,e,f))return this.settings.core.error.call(this,this._data.core.last_error),!1;for(-1!==f&&(e.children=a.vakata.array_remove(e.children,f)),g=b.children_d.concat([]),g.push(b.id),j=0,k=g.length;k>j;j++){for(h=0,i=b.parents.length;i>h;h++)f=a.inArray(g[j],this._model.data[b.parents[h]].children_d),-1!==f&&(this._model.data[b.parents[h]].children_d=a.vakata.array_remove(this._model.data[b.parents[h]].children_d,f));this._model.data[g[j]].state.selected&&(l=!0,f=a.inArray(g[j],this._data.core.selected),-1!==f&&(this._data.core.selected=a.vakata.array_remove(this._data.core.selected,f)))}for(this.trigger("delete_node",{node:b,parent:e.id}),l&&this.trigger("changed",{action:"delete_node",node:b,selected:this._data.core.selected,parent:e.id}),j=0,k=g.length;k>j;j++)delete this._model.data[g[j]];return-1!==a.inArray(this._data.core.focused,g)&&(this._data.core.focused=null,m=this.element[0].scrollTop,n=this.element[0].scrollLeft,e.id===a.jstree.root?this.get_node(this._model.data[a.jstree.root].children[0],!0).children(".jstree-anchor").focus():this.get_node(e,!0).children(".jstree-anchor").focus(),this.element[0].scrollTop=m,this.element[0].scrollLeft=n),this.redraw_node(e,!0),!0},check:function(b,c,d,e,f){c=c&&c.id?c:this.get_node(c),d=d&&d.id?d:this.get_node(d);var g=b.match(/^move_node|copy_node|create_node$/i)?d:c,h=this.settings.core.check_callback;return"move_node"!==b&&"copy_node"!==b||f&&f.is_multi||c.id!==d.id&&a.inArray(c.id,d.children)!==e&&-1===a.inArray(d.id,c.children_d)?(g&&g.data&&(g=g.data),g&&g.functions&&(g.functions[b]===!1||g.functions[b]===!0)?(g.functions[b]===!1&&(this._data.core.last_error={error:"check",plugin:"core",id:"core_02",reason:"Node data prevents function: "+b,data:JSON.stringify({chk:b,pos:e,obj:c&&c.id?c.id:!1,par:d&&d.id?d.id:!1})}),g.functions[b]):h===!1||a.isFunction(h)&&h.call(this,b,c,d,e,f)===!1||h&&h[b]===!1?(this._data.core.last_error={error:"check",plugin:"core",id:"core_03",reason:"User config for core.check_callback prevents function: "+b,data:JSON.stringify({chk:b,pos:e,obj:c&&c.id?c.id:!1,par:d&&d.id?d.id:!1})},!1):!0):(this._data.core.last_error={error:"check",plugin:"core",id:"core_01",reason:"Moving parent inside child",data:JSON.stringify({chk:b,pos:e,obj:c&&c.id?c.id:!1,par:d&&d.id?d.id:!1})},!1)},last_error:function(){return this._data.core.last_error},move_node:function(c,d,e,f,g,h,i){var j,k,l,m,n,o,p,q,r,s,t,u,v,w;if(d=this.get_node(d),e=e===b?0:e,!d)return!1;if(!e.toString().match(/^(before|after)$/)&&!g&&!this.is_loaded(d))return this.load_node(d,function(){this.move_node(c,d,e,f,!0,!1,i)});if(a.isArray(c)){if(1!==c.length){for(j=0,k=c.length;k>j;j++)(r=this.move_node(c[j],d,e,f,g,!1,i))&&(d=r,e="after");return this.redraw(),!0}c=c[0]}if(c=c&&c.id?c:this.get_node(c),!c||c.id===a.jstree.root)return!1;if(l=(c.parent||a.jstree.root).toString(),n=e.toString().match(/^(before|after)$/)&&d.id!==a.jstree.root?this.get_node(d.parent):d,o=i?i:this._model.data[c.id]?this:a.jstree.reference(c.id),p=!o||!o._id||this._id!==o._id,m=o&&o._id&&l&&o._model.data[l]&&o._model.data[l].children?a.inArray(c.id,o._model.data[l].children):-1,o&&o._id&&(c=o._model.data[c.id]),p)return(r=this.copy_node(c,d,e,f,g,!1,i))?(o&&o.delete_node(c),r):!1;switch(d.id===a.jstree.root&&("before"===e&&(e="first"),"after"===e&&(e="last")),e){case"before":e=a.inArray(d.id,n.children);break;case"after":e=a.inArray(d.id,n.children)+1;break;case"inside":case"first":e=0;break;case"last":e=n.children.length;break;default:e||(e=0)}if(e>n.children.length&&(e=n.children.length),!this.check("move_node",c,n,e,{core:!0,origin:i,is_multi:o&&o._id&&o._id!==this._id,is_foreign:!o||!o._id}))return this.settings.core.error.call(this,this._data.core.last_error),!1;if(c.parent===n.id){for(q=n.children.concat(),r=a.inArray(c.id,q),-1!==r&&(q=a.vakata.array_remove(q,r),e>r&&e--),r=[],s=0,t=q.length;t>s;s++)r[s>=e?s+1:s]=q[s];r[e]=c.id,n.children=r,this._node_changed(n.id),this.redraw(n.id===a.jstree.root)}else{for(r=c.children_d.concat(),r.push(c.id),s=0,t=c.parents.length;t>s;s++){for(q=[],w=o._model.data[c.parents[s]].children_d,u=0,v=w.length;v>u;u++)-1===a.inArray(w[u],r)&&q.push(w[u]);o._model.data[c.parents[s]].children_d=q}for(o._model.data[l].children=a.vakata.array_remove_item(o._model.data[l].children,c.id),s=0,t=n.parents.length;t>s;s++)this._model.data[n.parents[s]].children_d=this._model.data[n.parents[s]].children_d.concat(r);for(q=[],s=0,t=n.children.length;t>s;s++)q[s>=e?s+1:s]=n.children[s];for(q[e]=c.id,n.children=q,n.children_d.push(c.id),n.children_d=n.children_d.concat(c.children_d),c.parent=n.id,r=n.parents.concat(),r.unshift(n.id),w=c.parents.length,c.parents=r,r=r.concat(),s=0,t=c.children_d.length;t>s;s++)this._model.data[c.children_d[s]].parents=this._model.data[c.children_d[s]].parents.slice(0,-1*w),Array.prototype.push.apply(this._model.data[c.children_d[s]].parents,r);(l===a.jstree.root||n.id===a.jstree.root)&&(this._model.force_full_redraw=!0),this._model.force_full_redraw||(this._node_changed(l),this._node_changed(n.id)),h||this.redraw()}return f&&f.call(this,c,n,e),this.trigger("move_node",{node:c,parent:n.id,position:e,old_parent:l,old_position:m,is_multi:o&&o._id&&o._id!==this._id,is_foreign:!o||!o._id,old_instance:o,new_instance:this}),c.id},copy_node:function(c,d,e,f,g,h,i){var j,k,l,m,n,o,p,q,r,s,t;if(d=this.get_node(d),e=e===b?0:e,!d)return!1;if(!e.toString().match(/^(before|after)$/)&&!g&&!this.is_loaded(d))return this.load_node(d,function(){this.copy_node(c,d,e,f,!0,!1,i)});if(a.isArray(c)){if(1!==c.length){for(j=0,k=c.length;k>j;j++)(m=this.copy_node(c[j],d,e,f,g,!0,i))&&(d=m,e="after");return this.redraw(),!0}c=c[0]}if(c=c&&c.id?c:this.get_node(c),!c||c.id===a.jstree.root)return!1;switch(q=(c.parent||a.jstree.root).toString(),r=e.toString().match(/^(before|after)$/)&&d.id!==a.jstree.root?this.get_node(d.parent):d,s=i?i:this._model.data[c.id]?this:a.jstree.reference(c.id),t=!s||!s._id||this._id!==s._id,s&&s._id&&(c=s._model.data[c.id]),d.id===a.jstree.root&&("before"===e&&(e="first"),"after"===e&&(e="last")),e){case"before":e=a.inArray(d.id,r.children);break;case"after":e=a.inArray(d.id,r.children)+1;break;case"inside":case"first":e=0;break;case"last":e=r.children.length;break;default:e||(e=0)}if(e>r.children.length&&(e=r.children.length),!this.check("copy_node",c,r,e,{core:!0,origin:i,is_multi:s&&s._id&&s._id!==this._id,is_foreign:!s||!s._id}))return this.settings.core.error.call(this,this._data.core.last_error),!1;if(p=s?s.get_json(c,{no_id:!0,no_data:!0,no_state:!0}):c,!p)return!1;if(p.id===!0&&delete p.id,p=this._parse_model_from_json(p,r.id,r.parents.concat()),!p)return!1;for(m=this.get_node(p),c&&c.state&&c.state.loaded===!1&&(m.state.loaded=!1),l=[],l.push(p),l=l.concat(m.children_d),this.trigger("model",{nodes:l,parent:r.id}),n=0,o=r.parents.length;o>n;n++)this._model.data[r.parents[n]].children_d=this._model.data[r.parents[n]].children_d.concat(l);for(l=[],n=0,o=r.children.length;o>n;n++)l[n>=e?n+1:n]=r.children[n];return l[e]=m.id,r.children=l,r.children_d.push(m.id),r.children_d=r.children_d.concat(m.children_d),r.id===a.jstree.root&&(this._model.force_full_redraw=!0),this._model.force_full_redraw||this._node_changed(r.id),h||this.redraw(r.id===a.jstree.root),f&&f.call(this,m,r,e),this.trigger("copy_node",{node:m,original:c,parent:r.id,position:e,old_parent:q,old_position:s&&s._id&&q&&s._model.data[q]&&s._model.data[q].children?a.inArray(c.id,s._model.data[q].children):-1,is_multi:s&&s._id&&s._id!==this._id,is_foreign:!s||!s._id,old_instance:s,new_instance:this}),m.id},cut:function(b){if(b||(b=this._data.core.selected.concat()),a.isArray(b)||(b=[b]),!b.length)return!1;var c=[],g,h,i;for(h=0,i=b.length;i>h;h++)g=this.get_node(b[h]),g&&g.id&&g.id!==a.jstree.root&&c.push(g);return c.length?(d=c,f=this,e="move_node",void this.trigger("cut",{node:b})):!1},copy:function(b){if(b||(b=this._data.core.selected.concat()),a.isArray(b)||(b=[b]),!b.length)return!1;var c=[],g,h,i;for(h=0,i=b.length;i>h;h++)g=this.get_node(b[h]),g&&g.id&&g.id!==a.jstree.root&&c.push(g);return c.length?(d=c,f=this,e="copy_node",void this.trigger("copy",{node:b})):!1},get_buffer:function(){return{mode:e,node:d,inst:f}},can_paste:function(){return e!==!1&&d!==!1},paste:function(a,b){return a=this.get_node(a),a&&e&&e.match(/^(copy_node|move_node)$/)&&d?(this[e](d,a,b,!1,!1,!1,f)&&this.trigger("paste",{parent:a.id,node:d,mode:e}),d=!1,e=!1,void(f=!1)):!1},clear_buffer:function(){d=!1,e=!1,f=!1,this.trigger("clear_buffer")},edit:function(b,c,d){var e,f,g,h,i,j,k,l,m,n=!1;return(b=this.get_node(b))?this.settings.core.check_callback===!1?(this._data.core.last_error={error:"check",plugin:"core",id:"core_07",reason:"Could not edit node because of check_callback"},this.settings.core.error.call(this,this._data.core.last_error),!1):(m=b,c="string"==typeof c?c:b.text,this.set_text(b,""),b=this._open_to(b),m.text=c,e=this._data.core.rtl,f=this.element.width(),this._data.core.focused=m.id,g=b.children(".jstree-anchor").focus(),h=a("<span>"),i=c,j=a("<div />",{css:{position:"absolute",top:"-200px",left:e?"0px":"-1000px",visibility:"hidden"}}).appendTo("body"),k=a("<input />",{value:i,"class":"jstree-rename-input",css:{padding:"0",border:"1px solid silver","box-sizing":"border-box",display:"inline-block",height:this._data.core.li_height+"px",lineHeight:this._data.core.li_height+"px",width:"150px"},blur:a.proxy(function(c){c.stopImmediatePropagation(),c.preventDefault();var e=h.children(".jstree-rename-input"),f=e.val(),k=this.settings.core.force_text,l;""===f&&(f=i),j.remove(),h.replaceWith(g),h.remove(),i=k?i:a("<div></div>").append(a.parseHTML(i)).html(),this.set_text(b,i),l=!!this.rename_node(b,k?a("<div></div>").text(f).text():a("<div></div>").append(a.parseHTML(f)).html()),l||this.set_text(b,i),this._data.core.focused=m.id,setTimeout(a.proxy(function(){var a=this.get_node(m.id,!0);a.length&&(this._data.core.focused=m.id,a.children(".jstree-anchor").focus())},this),0),d&&d.call(this,m,l,n)},this),keydown:function(a){var b=a.which;27===b&&(n=!0,this.value=i),(27===b||13===b||37===b||38===b||39===b||40===b||32===b)&&a.stopImmediatePropagation(),(27===b||13===b)&&(a.preventDefault(),this.blur())},click:function(a){a.stopImmediatePropagation()},mousedown:function(a){a.stopImmediatePropagation()},keyup:function(a){k.width(Math.min(j.text("pW"+this.value).width(),f))},keypress:function(a){return 13===a.which?!1:void 0}}),l={fontFamily:g.css("fontFamily")||"",fontSize:g.css("fontSize")||"",fontWeight:g.css("fontWeight")||"",fontStyle:g.css("fontStyle")||"",fontStretch:g.css("fontStretch")||"",fontVariant:g.css("fontVariant")||"",letterSpacing:g.css("letterSpacing")||"",wordSpacing:g.css("wordSpacing")||""},h.attr("class",g.attr("class")).append(g.contents().clone()).append(k),g.replaceWith(h),j.css(l),void k.css(l).width(Math.min(j.text("pW"+k[0].value).width(),f))[0].select()):!1},set_theme:function(b,c){if(!b)return!1;if(c===!0){var d=this.settings.core.themes.dir;d||(d=a.jstree.path+"/themes"),c=d+"/"+b+"/style.css"}c&&-1===a.inArray(c,g)&&(a("head").append('<link rel="stylesheet" href="'+c+'" type="text/css" />'),g.push(c)),this._data.core.themes.name&&this.element.removeClass("jstree-"+this._data.core.themes.name),
this._data.core.themes.name=b,this.element.addClass("jstree-"+b),this.element[this.settings.core.themes.responsive?"addClass":"removeClass"]("jstree-"+b+"-responsive"),this.trigger("set_theme",{theme:b})},get_theme:function(){return this._data.core.themes.name},set_theme_variant:function(a){this._data.core.themes.variant&&this.element.removeClass("jstree-"+this._data.core.themes.name+"-"+this._data.core.themes.variant),this._data.core.themes.variant=a,a&&this.element.addClass("jstree-"+this._data.core.themes.name+"-"+this._data.core.themes.variant)},get_theme_variant:function(){return this._data.core.themes.variant},show_stripes:function(){this._data.core.themes.stripes=!0,this.get_container_ul().addClass("jstree-striped")},hide_stripes:function(){this._data.core.themes.stripes=!1,this.get_container_ul().removeClass("jstree-striped")},toggle_stripes:function(){this._data.core.themes.stripes?this.hide_stripes():this.show_stripes()},show_dots:function(){this._data.core.themes.dots=!0,this.get_container_ul().removeClass("jstree-no-dots")},hide_dots:function(){this._data.core.themes.dots=!1,this.get_container_ul().addClass("jstree-no-dots")},toggle_dots:function(){this._data.core.themes.dots?this.hide_dots():this.show_dots()},show_icons:function(){this._data.core.themes.icons=!0,this.get_container_ul().removeClass("jstree-no-icons")},hide_icons:function(){this._data.core.themes.icons=!1,this.get_container_ul().addClass("jstree-no-icons")},toggle_icons:function(){this._data.core.themes.icons?this.hide_icons():this.show_icons()},set_icon:function(c,d){var e,f,g,h;if(a.isArray(c)){for(c=c.slice(),e=0,f=c.length;f>e;e++)this.set_icon(c[e],d);return!0}return c=this.get_node(c),c&&c.id!==a.jstree.root?(h=c.icon,c.icon=d===!0||null===d||d===b||""===d?!0:d,g=this.get_node(c,!0).children(".jstree-anchor").children(".jstree-themeicon"),d===!1?this.hide_icon(c):d===!0||null===d||d===b||""===d?(g.removeClass("jstree-themeicon-custom "+h).css("background","").removeAttr("rel"),h===!1&&this.show_icon(c)):-1===d.indexOf("/")&&-1===d.indexOf(".")?(g.removeClass(h).css("background",""),g.addClass(d+" jstree-themeicon-custom").attr("rel",d),h===!1&&this.show_icon(c)):(g.removeClass(h).css("background",""),g.addClass("jstree-themeicon-custom").css("background","url('"+d+"') center center no-repeat").attr("rel",d),h===!1&&this.show_icon(c)),!0):!1},get_icon:function(b){return b=this.get_node(b),b&&b.id!==a.jstree.root?b.icon:!1},hide_icon:function(b){var c,d;if(a.isArray(b)){for(b=b.slice(),c=0,d=b.length;d>c;c++)this.hide_icon(b[c]);return!0}return b=this.get_node(b),b&&b!==a.jstree.root?(b.icon=!1,this.get_node(b,!0).children(".jstree-anchor").children(".jstree-themeicon").addClass("jstree-themeicon-hidden"),!0):!1},show_icon:function(b){var c,d,e;if(a.isArray(b)){for(b=b.slice(),c=0,d=b.length;d>c;c++)this.show_icon(b[c]);return!0}return b=this.get_node(b),b&&b!==a.jstree.root?(e=this.get_node(b,!0),b.icon=e.length?e.children(".jstree-anchor").children(".jstree-themeicon").attr("rel"):!0,b.icon||(b.icon=!0),e.children(".jstree-anchor").children(".jstree-themeicon").removeClass("jstree-themeicon-hidden"),!0):!1}},a.vakata={},a.vakata.attributes=function(b,c){b=a(b)[0];var d=c?{}:[];return b&&b.attributes&&a.each(b.attributes,function(b,e){-1===a.inArray(e.name.toLowerCase(),["style","contenteditable","hasfocus","tabindex"])&&null!==e.value&&""!==a.trim(e.value)&&(c?d[e.name]=e.value:d.push(e.name))}),d},a.vakata.array_unique=function(a){var c=[],d,e,f,g={};for(d=0,f=a.length;f>d;d++)g[a[d]]===b&&(c.push(a[d]),g[a[d]]=!0);return c},a.vakata.array_remove=function(a,b,c){var d=a.slice((c||b)+1||a.length);return a.length=0>b?a.length+b:b,a.push.apply(a,d),a},a.vakata.array_remove_item=function(b,c){var d=a.inArray(c,b);return-1!==d?a.vakata.array_remove(b,d):b},a.jstree.plugins.changed=function(a,b){var c=[];this.trigger=function(a,d){var e,f;if(d||(d={}),"changed"===a.replace(".jstree","")){d.changed={selected:[],deselected:[]};var g={};for(e=0,f=c.length;f>e;e++)g[c[e]]=1;for(e=0,f=d.selected.length;f>e;e++)g[d.selected[e]]?g[d.selected[e]]=2:d.changed.selected.push(d.selected[e]);for(e=0,f=c.length;f>e;e++)1===g[c[e]]&&d.changed.deselected.push(c[e]);c=d.selected.slice()}b.trigger.call(this,a,d)},this.refresh=function(a,d){return c=[],b.refresh.apply(this,arguments)}};var m=i.createElement("I");m.className="jstree-icon jstree-checkbox",m.setAttribute("role","presentation"),a.jstree.defaults.checkbox={visible:!0,three_state:!0,whole_node:!0,keep_selected_style:!0,cascade:"",tie_selection:!0},a.jstree.plugins.checkbox=function(c,d){this.bind=function(){d.bind.call(this),this._data.checkbox.uto=!1,this._data.checkbox.selected=[],this.settings.checkbox.three_state&&(this.settings.checkbox.cascade="up+down+undetermined"),this.element.on("init.jstree",a.proxy(function(){this._data.checkbox.visible=this.settings.checkbox.visible,this.settings.checkbox.keep_selected_style||this.element.addClass("jstree-checkbox-no-clicked"),this.settings.checkbox.tie_selection&&this.element.addClass("jstree-checkbox-selection")},this)).on("loading.jstree",a.proxy(function(){this[this._data.checkbox.visible?"show_checkboxes":"hide_checkboxes"]()},this)),-1!==this.settings.checkbox.cascade.indexOf("undetermined")&&this.element.on("changed.jstree uncheck_node.jstree check_node.jstree uncheck_all.jstree check_all.jstree move_node.jstree copy_node.jstree redraw.jstree open_node.jstree",a.proxy(function(){this._data.checkbox.uto&&clearTimeout(this._data.checkbox.uto),this._data.checkbox.uto=setTimeout(a.proxy(this._undetermined,this),50)},this)),this.settings.checkbox.tie_selection||this.element.on("model.jstree",a.proxy(function(a,b){var c=this._model.data,d=c[b.parent],e=b.nodes,f,g;for(f=0,g=e.length;g>f;f++)c[e[f]].state.checked=c[e[f]].state.checked||c[e[f]].original&&c[e[f]].original.state&&c[e[f]].original.state.checked,c[e[f]].state.checked&&this._data.checkbox.selected.push(e[f])},this)),(-1!==this.settings.checkbox.cascade.indexOf("up")||-1!==this.settings.checkbox.cascade.indexOf("down"))&&this.element.on("model.jstree",a.proxy(function(b,c){var d=this._model.data,e=d[c.parent],f=c.nodes,g=[],h,i,j,k,l,m,n=this.settings.checkbox.cascade,o=this.settings.checkbox.tie_selection;if(-1!==n.indexOf("down"))if(e.state[o?"selected":"checked"]){for(i=0,j=f.length;j>i;i++)d[f[i]].state[o?"selected":"checked"]=!0;this._data[o?"core":"checkbox"].selected=this._data[o?"core":"checkbox"].selected.concat(f)}else for(i=0,j=f.length;j>i;i++)if(d[f[i]].state[o?"selected":"checked"]){for(k=0,l=d[f[i]].children_d.length;l>k;k++)d[d[f[i]].children_d[k]].state[o?"selected":"checked"]=!0;this._data[o?"core":"checkbox"].selected=this._data[o?"core":"checkbox"].selected.concat(d[f[i]].children_d)}if(-1!==n.indexOf("up")){for(i=0,j=e.children_d.length;j>i;i++)d[e.children_d[i]].children.length||g.push(d[e.children_d[i]].parent);for(g=a.vakata.array_unique(g),k=0,l=g.length;l>k;k++){e=d[g[k]];while(e&&e.id!==a.jstree.root){for(h=0,i=0,j=e.children.length;j>i;i++)h+=d[e.children[i]].state[o?"selected":"checked"];if(h!==j)break;e.state[o?"selected":"checked"]=!0,this._data[o?"core":"checkbox"].selected.push(e.id),m=this.get_node(e,!0),m&&m.length&&m.attr("aria-selected",!0).children(".jstree-anchor").addClass(o?"jstree-clicked":"jstree-checked"),e=this.get_node(e.parent)}}}this._data[o?"core":"checkbox"].selected=a.vakata.array_unique(this._data[o?"core":"checkbox"].selected)},this)).on(this.settings.checkbox.tie_selection?"select_node.jstree":"check_node.jstree",a.proxy(function(b,c){var d=c.node,e=this._model.data,f=this.get_node(d.parent),g=this.get_node(d,!0),h,i,j,k,l=this.settings.checkbox.cascade,m=this.settings.checkbox.tie_selection;if(-1!==l.indexOf("down"))for(this._data[m?"core":"checkbox"].selected=a.vakata.array_unique(this._data[m?"core":"checkbox"].selected.concat(d.children_d)),h=0,i=d.children_d.length;i>h;h++)k=e[d.children_d[h]],k.state[m?"selected":"checked"]=!0,k&&k.original&&k.original.state&&k.original.state.undetermined&&(k.original.state.undetermined=!1);if(-1!==l.indexOf("up"))while(f&&f.id!==a.jstree.root){for(j=0,h=0,i=f.children.length;i>h;h++)j+=e[f.children[h]].state[m?"selected":"checked"];if(j!==i)break;f.state[m?"selected":"checked"]=!0,this._data[m?"core":"checkbox"].selected.push(f.id),k=this.get_node(f,!0),k&&k.length&&k.attr("aria-selected",!0).children(".jstree-anchor").addClass(m?"jstree-clicked":"jstree-checked"),f=this.get_node(f.parent)}-1!==l.indexOf("down")&&g.length&&g.find(".jstree-anchor").addClass(m?"jstree-clicked":"jstree-checked").parent().attr("aria-selected",!0)},this)).on(this.settings.checkbox.tie_selection?"deselect_all.jstree":"uncheck_all.jstree",a.proxy(function(b,c){var d=this.get_node(a.jstree.root),e=this._model.data,f,g,h;for(f=0,g=d.children_d.length;g>f;f++)h=e[d.children_d[f]],h&&h.original&&h.original.state&&h.original.state.undetermined&&(h.original.state.undetermined=!1)},this)).on(this.settings.checkbox.tie_selection?"deselect_node.jstree":"uncheck_node.jstree",a.proxy(function(b,c){var d=c.node,e=this.get_node(d,!0),f,g,h,i=this.settings.checkbox.cascade,j=this.settings.checkbox.tie_selection;if(d&&d.original&&d.original.state&&d.original.state.undetermined&&(d.original.state.undetermined=!1),-1!==i.indexOf("down"))for(f=0,g=d.children_d.length;g>f;f++)h=this._model.data[d.children_d[f]],h.state[j?"selected":"checked"]=!1,h&&h.original&&h.original.state&&h.original.state.undetermined&&(h.original.state.undetermined=!1);if(-1!==i.indexOf("up"))for(f=0,g=d.parents.length;g>f;f++)h=this._model.data[d.parents[f]],h.state[j?"selected":"checked"]=!1,h&&h.original&&h.original.state&&h.original.state.undetermined&&(h.original.state.undetermined=!1),h=this.get_node(d.parents[f],!0),h&&h.length&&h.attr("aria-selected",!1).children(".jstree-anchor").removeClass(j?"jstree-clicked":"jstree-checked");for(h=[],f=0,g=this._data[j?"core":"checkbox"].selected.length;g>f;f++)-1!==i.indexOf("down")&&-1!==a.inArray(this._data[j?"core":"checkbox"].selected[f],d.children_d)||-1!==i.indexOf("up")&&-1!==a.inArray(this._data[j?"core":"checkbox"].selected[f],d.parents)||h.push(this._data[j?"core":"checkbox"].selected[f]);this._data[j?"core":"checkbox"].selected=a.vakata.array_unique(h),-1!==i.indexOf("down")&&e.length&&e.find(".jstree-anchor").removeClass(j?"jstree-clicked":"jstree-checked").parent().attr("aria-selected",!1)},this)),-1!==this.settings.checkbox.cascade.indexOf("up")&&this.element.on("delete_node.jstree",a.proxy(function(b,c){var d=this.get_node(c.parent),e=this._model.data,f,g,h,i,j=this.settings.checkbox.tie_selection;while(d&&d.id!==a.jstree.root&&!d.state[j?"selected":"checked"]){for(h=0,f=0,g=d.children.length;g>f;f++)h+=e[d.children[f]].state[j?"selected":"checked"];if(!(g>0&&h===g))break;d.state[j?"selected":"checked"]=!0,this._data[j?"core":"checkbox"].selected.push(d.id),i=this.get_node(d,!0),i&&i.length&&i.attr("aria-selected",!0).children(".jstree-anchor").addClass(j?"jstree-clicked":"jstree-checked"),d=this.get_node(d.parent)}},this)).on("move_node.jstree",a.proxy(function(b,c){var d=c.is_multi,e=c.old_parent,f=this.get_node(c.parent),g=this._model.data,h,i,j,k,l,m=this.settings.checkbox.tie_selection;if(!d){h=this.get_node(e);while(h&&h.id!==a.jstree.root&&!h.state[m?"selected":"checked"]){for(i=0,j=0,k=h.children.length;k>j;j++)i+=g[h.children[j]].state[m?"selected":"checked"];if(!(k>0&&i===k))break;h.state[m?"selected":"checked"]=!0,this._data[m?"core":"checkbox"].selected.push(h.id),l=this.get_node(h,!0),l&&l.length&&l.attr("aria-selected",!0).children(".jstree-anchor").addClass(m?"jstree-clicked":"jstree-checked"),h=this.get_node(h.parent)}}h=f;while(h&&h.id!==a.jstree.root){for(i=0,j=0,k=h.children.length;k>j;j++)i+=g[h.children[j]].state[m?"selected":"checked"];if(i===k)h.state[m?"selected":"checked"]||(h.state[m?"selected":"checked"]=!0,this._data[m?"core":"checkbox"].selected.push(h.id),l=this.get_node(h,!0),l&&l.length&&l.attr("aria-selected",!0).children(".jstree-anchor").addClass(m?"jstree-clicked":"jstree-checked"));else{if(!h.state[m?"selected":"checked"])break;h.state[m?"selected":"checked"]=!1,this._data[m?"core":"checkbox"].selected=a.vakata.array_remove_item(this._data[m?"core":"checkbox"].selected,h.id),l=this.get_node(h,!0),l&&l.length&&l.attr("aria-selected",!1).children(".jstree-anchor").removeClass(m?"jstree-clicked":"jstree-checked")}h=this.get_node(h.parent)}},this))},this._undetermined=function(){if(null!==this.element){var c,d,e,f,g={},h=this._model.data,i=this.settings.checkbox.tie_selection,j=this._data[i?"core":"checkbox"].selected,k=[],l=this;for(c=0,d=j.length;d>c;c++)if(h[j[c]]&&h[j[c]].parents)for(e=0,f=h[j[c]].parents.length;f>e;e++)g[h[j[c]].parents[e]]===b&&h[j[c]].parents[e]!==a.jstree.root&&(g[h[j[c]].parents[e]]=!0,k.push(h[j[c]].parents[e]));for(this.element.find(".jstree-closed").not(":has(.jstree-children)").each(function(){var i=l.get_node(this),j;if(i.state.loaded){for(c=0,d=i.children_d.length;d>c;c++)if(j=h[i.children_d[c]],!j.state.loaded&&j.original&&j.original.state&&j.original.state.undetermined&&j.original.state.undetermined===!0)for(g[j.id]===b&&j.id!==a.jstree.root&&(g[j.id]=!0,k.push(j.id)),e=0,f=j.parents.length;f>e;e++)g[j.parents[e]]===b&&j.parents[e]!==a.jstree.root&&(g[j.parents[e]]=!0,k.push(j.parents[e]))}else if(i.original&&i.original.state&&i.original.state.undetermined&&i.original.state.undetermined===!0)for(g[i.id]===b&&i.id!==a.jstree.root&&(g[i.id]=!0,k.push(i.id)),e=0,f=i.parents.length;f>e;e++)g[i.parents[e]]===b&&i.parents[e]!==a.jstree.root&&(g[i.parents[e]]=!0,k.push(i.parents[e]))}),this.element.find(".jstree-undetermined").removeClass("jstree-undetermined"),c=0,d=k.length;d>c;c++)h[k[c]].state[i?"selected":"checked"]||(j=this.get_node(k[c],!0),j&&j.length&&j.children(".jstree-anchor").children(".jstree-checkbox").addClass("jstree-undetermined"))}},this.redraw_node=function(b,c,e,f){if(b=d.redraw_node.apply(this,arguments)){var g,h,i=null,j=null;for(g=0,h=b.childNodes.length;h>g;g++)if(b.childNodes[g]&&b.childNodes[g].className&&-1!==b.childNodes[g].className.indexOf("jstree-anchor")){i=b.childNodes[g];break}i&&(!this.settings.checkbox.tie_selection&&this._model.data[b.id].state.checked&&(i.className+=" jstree-checked"),j=m.cloneNode(!1),this._model.data[b.id].state.checkbox_disabled&&(j.className+=" jstree-checkbox-disabled"),i.insertBefore(j,i.childNodes[0]))}return e||-1===this.settings.checkbox.cascade.indexOf("undetermined")||(this._data.checkbox.uto&&clearTimeout(this._data.checkbox.uto),this._data.checkbox.uto=setTimeout(a.proxy(this._undetermined,this),50)),b},this.show_checkboxes=function(){this._data.core.themes.checkboxes=!0,this.get_container_ul().removeClass("jstree-no-checkboxes")},this.hide_checkboxes=function(){this._data.core.themes.checkboxes=!1,this.get_container_ul().addClass("jstree-no-checkboxes")},this.toggle_checkboxes=function(){this._data.core.themes.checkboxes?this.hide_checkboxes():this.show_checkboxes()},this.is_undetermined=function(b){b=this.get_node(b);var c=this.settings.checkbox.cascade,d,e,f=this.settings.checkbox.tie_selection,g=this._data[f?"core":"checkbox"].selected,h=this._model.data;if(!b||b.state[f?"selected":"checked"]===!0||-1===c.indexOf("undetermined")||-1===c.indexOf("down")&&-1===c.indexOf("up"))return!1;if(!b.state.loaded&&b.original.state.undetermined===!0)return!0;for(d=0,e=b.children_d.length;e>d;d++)if(-1!==a.inArray(b.children_d[d],g)||!h[b.children_d[d]].state.loaded&&h[b.children_d[d]].original.state.undetermined)return!0;return!1},this.disable_checkbox=function(b){var c,d,e;if(a.isArray(b)){for(b=b.slice(),c=0,d=b.length;d>c;c++)this.disable_checkbox(b[c]);return!0}return b=this.get_node(b),b&&b.id!==a.jstree.root?(e=this.get_node(b,!0),void(b.state.checkbox_disabled||(b.state.checkbox_disabled=!0,e&&e.length&&e.children(".jstree-anchor").children(".jstree-checkbox").addClass("jstree-checkbox-disabled"),this.trigger("disable_checkbox",{node:b})))):!1},this.enable_checkbox=function(b){var c,d,e;if(a.isArray(b)){for(b=b.slice(),c=0,d=b.length;d>c;c++)this.enable_checkbox(b[c]);return!0}return b=this.get_node(b),b&&b.id!==a.jstree.root?(e=this.get_node(b,!0),void(b.state.checkbox_disabled&&(b.state.checkbox_disabled=!1,e&&e.length&&e.children(".jstree-anchor").children(".jstree-checkbox").removeClass("jstree-checkbox-disabled"),this.trigger("enable_checkbox",{node:b})))):!1},this.activate_node=function(b,c){return a(c.target).hasClass("jstree-checkbox-disabled")?!1:(this.settings.checkbox.tie_selection&&(this.settings.checkbox.whole_node||a(c.target).hasClass("jstree-checkbox"))&&(c.ctrlKey=!0),this.settings.checkbox.tie_selection||!this.settings.checkbox.whole_node&&!a(c.target).hasClass("jstree-checkbox")?d.activate_node.call(this,b,c):this.is_disabled(b)?!1:(this.is_checked(b)?this.uncheck_node(b,c):this.check_node(b,c),void this.trigger("activate_node",{node:this.get_node(b)})))},this.check_node=function(b,c){if(this.settings.checkbox.tie_selection)return this.select_node(b,!1,!0,c);var d,e,f,g;if(a.isArray(b)){for(b=b.slice(),e=0,f=b.length;f>e;e++)this.check_node(b[e],c);return!0}return b=this.get_node(b),b&&b.id!==a.jstree.root?(d=this.get_node(b,!0),void(b.state.checked||(b.state.checked=!0,this._data.checkbox.selected.push(b.id),d&&d.length&&d.children(".jstree-anchor").addClass("jstree-checked"),this.trigger("check_node",{node:b,selected:this._data.checkbox.selected,event:c})))):!1},this.uncheck_node=function(b,c){if(this.settings.checkbox.tie_selection)return this.deselect_node(b,!1,c);var d,e,f;if(a.isArray(b)){for(b=b.slice(),d=0,e=b.length;e>d;d++)this.uncheck_node(b[d],c);return!0}return b=this.get_node(b),b&&b.id!==a.jstree.root?(f=this.get_node(b,!0),void(b.state.checked&&(b.state.checked=!1,this._data.checkbox.selected=a.vakata.array_remove_item(this._data.checkbox.selected,b.id),f.length&&f.children(".jstree-anchor").removeClass("jstree-checked"),this.trigger("uncheck_node",{node:b,selected:this._data.checkbox.selected,event:c})))):!1},this.check_all=function(){if(this.settings.checkbox.tie_selection)return this.select_all();var b=this._data.checkbox.selected.concat([]),c,d;for(this._data.checkbox.selected=this._model.data[a.jstree.root].children_d.concat(),c=0,d=this._data.checkbox.selected.length;d>c;c++)this._model.data[this._data.checkbox.selected[c]]&&(this._model.data[this._data.checkbox.selected[c]].state.checked=!0);this.redraw(!0),this.trigger("check_all",{selected:this._data.checkbox.selected})},this.uncheck_all=function(){if(this.settings.checkbox.tie_selection)return this.deselect_all();var a=this._data.checkbox.selected.concat([]),b,c;for(b=0,c=this._data.checkbox.selected.length;c>b;b++)this._model.data[this._data.checkbox.selected[b]]&&(this._model.data[this._data.checkbox.selected[b]].state.checked=!1);this._data.checkbox.selected=[],this.element.find(".jstree-checked").removeClass("jstree-checked"),this.trigger("uncheck_all",{selected:this._data.checkbox.selected,node:a})},this.is_checked=function(b){return this.settings.checkbox.tie_selection?this.is_selected(b):(b=this.get_node(b),b&&b.id!==a.jstree.root?b.state.checked:!1)},this.get_checked=function(b){return this.settings.checkbox.tie_selection?this.get_selected(b):b?a.map(this._data.checkbox.selected,a.proxy(function(a){return this.get_node(a)},this)):this._data.checkbox.selected},this.get_top_checked=function(b){if(this.settings.checkbox.tie_selection)return this.get_top_selected(b);var c=this.get_checked(!0),d={},e,f,g,h;for(e=0,f=c.length;f>e;e++)d[c[e].id]=c[e];for(e=0,f=c.length;f>e;e++)for(g=0,h=c[e].children_d.length;h>g;g++)d[c[e].children_d[g]]&&delete d[c[e].children_d[g]];c=[];for(e in d)d.hasOwnProperty(e)&&c.push(e);return b?a.map(c,a.proxy(function(a){return this.get_node(a)},this)):c},this.get_bottom_checked=function(b){if(this.settings.checkbox.tie_selection)return this.get_bottom_selected(b);var c=this.get_checked(!0),d=[],e,f;for(e=0,f=c.length;f>e;e++)c[e].children.length||d.push(c[e].id);return b?a.map(d,a.proxy(function(a){return this.get_node(a)},this)):d},this.load_node=function(b,c){var e,f,g,h,i,j;if(!a.isArray(b)&&!this.settings.checkbox.tie_selection&&(j=this.get_node(b),j&&j.state.loaded))for(e=0,f=j.children_d.length;f>e;e++)this._model.data[j.children_d[e]].state.checked&&(i=!0,this._data.checkbox.selected=a.vakata.array_remove_item(this._data.checkbox.selected,j.children_d[e]));return d.load_node.apply(this,arguments)},this.get_state=function(){var a=d.get_state.apply(this,arguments);return this.settings.checkbox.tie_selection?a:(a.checkbox=this._data.checkbox.selected.slice(),a)},this.set_state=function(b,c){var e=d.set_state.apply(this,arguments);if(e&&b.checkbox){if(!this.settings.checkbox.tie_selection){this.uncheck_all();var f=this;a.each(b.checkbox,function(a,b){f.check_node(b)})}return delete b.checkbox,this.set_state(b,c),!1}return e},this.refresh=function(a,b){return this.settings.checkbox.tie_selection||(this._data.checkbox.selected=[]),d.refresh.apply(this,arguments)}},a.jstree.defaults.conditionalselect=function(){return!0},a.jstree.plugins.conditionalselect=function(a,b){this.activate_node=function(a,c){this.settings.conditionalselect.call(this,this.get_node(a),c)&&b.activate_node.call(this,a,c)}},a.jstree.defaults.contextmenu={select_node:!0,show_at_node:!0,items:function(b,c){return{create:{separator_before:!1,separator_after:!0,_disabled:!1,label:"Create",action:function(b){var c=a.jstree.reference(b.reference),d=c.get_node(b.reference);c.create_node(d,{},"last",function(a){setTimeout(function(){c.edit(a)},0)})}},rename:{separator_before:!1,separator_after:!1,_disabled:!1,label:"Rename",action:function(b){var c=a.jstree.reference(b.reference),d=c.get_node(b.reference);c.edit(d)}},remove:{separator_before:!1,icon:!1,separator_after:!1,_disabled:!1,label:"Delete",action:function(b){var c=a.jstree.reference(b.reference),d=c.get_node(b.reference);c.is_selected(d)?c.delete_node(c.get_selected()):c.delete_node(d)}},ccp:{separator_before:!0,icon:!1,separator_after:!1,label:"Edit",action:!1,submenu:{cut:{separator_before:!1,separator_after:!1,label:"Cut",action:function(b){var c=a.jstree.reference(b.reference),d=c.get_node(b.reference);c.is_selected(d)?c.cut(c.get_top_selected()):c.cut(d)}},copy:{separator_before:!1,icon:!1,separator_after:!1,label:"Copy",action:function(b){var c=a.jstree.reference(b.reference),d=c.get_node(b.reference);c.is_selected(d)?c.copy(c.get_top_selected()):c.copy(d)}},paste:{separator_before:!1,icon:!1,_disabled:function(b){return!a.jstree.reference(b.reference).can_paste()},separator_after:!1,label:"Paste",action:function(b){var c=a.jstree.reference(b.reference),d=c.get_node(b.reference);c.paste(d)}}}}}}},a.jstree.plugins.contextmenu=function(c,d){this.bind=function(){d.bind.call(this);var b=0,c=null,e,f;this.element.on("contextmenu.jstree",".jstree-anchor",a.proxy(function(a,d){a.preventDefault(),b=a.ctrlKey?+new Date:0,(d||c)&&(b=+new Date+1e4),c&&clearTimeout(c),this.is_loading(a.currentTarget)||this.show_contextmenu(a.currentTarget,a.pageX,a.pageY,a)},this)).on("click.jstree",".jstree-anchor",a.proxy(function(c){this._data.contextmenu.visible&&(!b||+new Date-b>250)&&a.vakata.context.hide(),b=0},this)).on("touchstart.jstree",".jstree-anchor",function(b){b.originalEvent&&b.originalEvent.changedTouches&&b.originalEvent.changedTouches[0]&&(e=b.pageX,f=b.pageY,c=setTimeout(function(){a(b.currentTarget).trigger("contextmenu",!0)},750))}).on("touchmove.vakata.jstree",function(a){c&&a.originalEvent&&a.originalEvent.changedTouches&&a.originalEvent.changedTouches[0]&&(Math.abs(e-a.pageX)>50||Math.abs(f-a.pageY)>50)&&clearTimeout(c)}).on("touchend.vakata.jstree",function(a){c&&clearTimeout(c)}),a(i).on("context_hide.vakata.jstree",a.proxy(function(){this._data.contextmenu.visible=!1},this))},this.teardown=function(){this._data.contextmenu.visible&&a.vakata.context.hide(),d.teardown.call(this)},this.show_contextmenu=function(c,d,e,f){if(c=this.get_node(c),!c||c.id===a.jstree.root)return!1;var g=this.settings.contextmenu,h=this.get_node(c,!0),i=h.children(".jstree-anchor"),j=!1,k=!1;(g.show_at_node||d===b||e===b)&&(j=i.offset(),d=j.left,e=j.top+this._data.core.li_height),this.settings.contextmenu.select_node&&!this.is_selected(c)&&this.activate_node(c,f),k=g.items,a.isFunction(k)&&(k=k.call(this,c,a.proxy(function(a){this._show_contextmenu(c,d,e,a)},this))),a.isPlainObject(k)&&this._show_contextmenu(c,d,e,k)},this._show_contextmenu=function(b,c,d,e){var f=this.get_node(b,!0),g=f.children(".jstree-anchor");a(i).one("context_show.vakata.jstree",a.proxy(function(b,c){var d="jstree-contextmenu jstree-"+this.get_theme()+"-contextmenu";a(c.element).addClass(d)},this)),this._data.contextmenu.visible=!0,a.vakata.context.show(g,{x:c,y:d},e),this.trigger("show_contextmenu",{node:b,x:c,y:d})}},function(a){var b=!1,c={element:!1,reference:!1,position_x:0,position_y:0,items:[],html:"",is_visible:!1};a.vakata.context={settings:{hide_onmouseleave:0,icons:!0},_trigger:function(b){a(i).triggerHandler("context_"+b+".vakata",{reference:c.reference,element:c.element,position:{x:c.position_x,y:c.position_y}})},_execute:function(b){return b=c.items[b],b&&(!b._disabled||a.isFunction(b._disabled)&&!b._disabled({item:b,reference:c.reference,element:c.element}))&&b.action?b.action.call(null,{item:b,reference:c.reference,element:c.element,position:{x:c.position_x,y:c.position_y}}):!1},_parse:function(b,d){if(!b)return!1;d||(c.html="",c.items=[]);var e="",f=!1,g;return d&&(e+="<ul>"),a.each(b,function(b,d){return d?(c.items.push(d),!f&&d.separator_before&&(e+="<li class='vakata-context-separator'><a href='#' "+(a.vakata.context.settings.icons?"":'style="margin-left:0px;"')+">&#160;</a></li>"),f=!1,e+="<li class='"+(d._class||"")+(d._disabled===!0||a.isFunction(d._disabled)&&d._disabled({item:d,reference:c.reference,element:c.element})?" vakata-contextmenu-disabled ":"")+"' "+(d.shortcut?" data-shortcut='"+d.shortcut+"' ":"")+">",e+="<a href='#' rel='"+(c.items.length-1)+"'>",a.vakata.context.settings.icons&&(e+="<i ",d.icon&&(e+=-1!==d.icon.indexOf("/")||-1!==d.icon.indexOf(".")?" style='background:url(\""+d.icon+"\") center center no-repeat' ":" class='"+d.icon+"' "),e+="></i><span class='vakata-contextmenu-sep'>&#160;</span>"),e+=(a.isFunction(d.label)?d.label({item:b,reference:c.reference,element:c.element}):d.label)+(d.shortcut?' <span class="vakata-contextmenu-shortcut vakata-contextmenu-shortcut-'+d.shortcut+'">'+(d.shortcut_label||"")+"</span>":"")+"</a>",d.submenu&&(g=a.vakata.context._parse(d.submenu,!0),g&&(e+=g)),e+="</li>",void(d.separator_after&&(e+="<li class='vakata-context-separator'><a href='#' "+(a.vakata.context.settings.icons?"":'style="margin-left:0px;"')+">&#160;</a></li>",f=!0))):!0}),e=e.replace(/<li class\='vakata-context-separator'\><\/li\>$/,""),d&&(e+="</ul>"),d||(c.html=e,a.vakata.context._trigger("parse")),e.length>10?e:!1},_show_submenu:function(c){if(c=a(c),c.length&&c.children("ul").length){var d=c.children("ul"),e=c.offset().left+c.outerWidth(),f=c.offset().top,g=d.width(),h=d.height(),i=a(window).width()+a(window).scrollLeft(),j=a(window).height()+a(window).scrollTop();b?c[e-(g+10+c.outerWidth())<0?"addClass":"removeClass"]("vakata-context-left"):c[e+g+10>i?"addClass":"removeClass"]("vakata-context-right"),f+h+10>j&&d.css("bottom","-1px"),d.show()}},show:function(d,e,f){var g,h,i,j,k,l,m,n,o=!0;switch(c.element&&c.element.length&&c.element.width(""),o){case!e&&!d:return!1;case!!e&&!!d:c.reference=d,c.position_x=e.x,c.position_y=e.y;break;case!e&&!!d:c.reference=d,g=d.offset(),c.position_x=g.left+d.outerHeight(),c.position_y=g.top;break;case!!e&&!d:c.position_x=e.x,c.position_y=e.y}d&&!f&&a(d).data("vakata_contextmenu")&&(f=a(d).data("vakata_contextmenu")),a.vakata.context._parse(f)&&c.element.html(c.html),c.items.length&&(c.element.appendTo("body"),h=c.element,i=c.position_x,j=c.position_y,k=h.width(),l=h.height(),m=a(window).width()+a(window).scrollLeft(),n=a(window).height()+a(window).scrollTop(),b&&(i-=h.outerWidth()-a(d).outerWidth(),i<a(window).scrollLeft()+20&&(i=a(window).scrollLeft()+20)),i+k+20>m&&(i=m-(k+20)),j+l+20>n&&(j=n-(l+20)),c.element.css({left:i,top:j}).show().find("a").first().focus().parent().addClass("vakata-context-hover"),c.is_visible=!0,a.vakata.context._trigger("show"))},hide:function(){c.is_visible&&(c.element.hide().find("ul").hide().end().find(":focus").blur().end().detach(),c.is_visible=!1,a.vakata.context._trigger("hide"))}},a(function(){b="rtl"===a("body").css("direction");var d=!1;c.element=a("<ul class='vakata-context'></ul>"),c.element.on("mouseenter","li",function(b){b.stopImmediatePropagation(),a.contains(this,b.relatedTarget)||(d&&clearTimeout(d),c.element.find(".vakata-context-hover").removeClass("vakata-context-hover").end(),a(this).siblings().find("ul").hide().end().end().parentsUntil(".vakata-context","li").addBack().addClass("vakata-context-hover"),a.vakata.context._show_submenu(this))}).on("mouseleave","li",function(b){a.contains(this,b.relatedTarget)||a(this).find(".vakata-context-hover").addBack().removeClass("vakata-context-hover")}).on("mouseleave",function(b){a(this).find(".vakata-context-hover").removeClass("vakata-context-hover"),a.vakata.context.settings.hide_onmouseleave&&(d=setTimeout(function(b){return function(){a.vakata.context.hide()}}(this),a.vakata.context.settings.hide_onmouseleave))}).on("click","a",function(b){b.preventDefault(),a(this).blur().parent().hasClass("vakata-context-disabled")||a.vakata.context._execute(a(this).attr("rel"))===!1||a.vakata.context.hide()}).on("keydown","a",function(b){var d=null;switch(b.which){case 13:case 32:b.type="mouseup",b.preventDefault(),a(b.currentTarget).trigger(b);break;case 37:c.is_visible&&(c.element.find(".vakata-context-hover").last().closest("li").first().find("ul").hide().find(".vakata-context-hover").removeClass("vakata-context-hover").end().end().children("a").focus(),b.stopImmediatePropagation(),b.preventDefault());break;case 38:c.is_visible&&(d=c.element.find("ul:visible").addBack().last().children(".vakata-context-hover").removeClass("vakata-context-hover").prevAll("li:not(.vakata-context-separator)").first(),d.length||(d=c.element.find("ul:visible").addBack().last().children("li:not(.vakata-context-separator)").last()),d.addClass("vakata-context-hover").children("a").focus(),b.stopImmediatePropagation(),b.preventDefault());break;case 39:c.is_visible&&(c.element.find(".vakata-context-hover").last().children("ul").show().children("li:not(.vakata-context-separator)").removeClass("vakata-context-hover").first().addClass("vakata-context-hover").children("a").focus(),b.stopImmediatePropagation(),b.preventDefault());break;case 40:c.is_visible&&(d=c.element.find("ul:visible").addBack().last().children(".vakata-context-hover").removeClass("vakata-context-hover").nextAll("li:not(.vakata-context-separator)").first(),d.length||(d=c.element.find("ul:visible").addBack().last().children("li:not(.vakata-context-separator)").first()),d.addClass("vakata-context-hover").children("a").focus(),b.stopImmediatePropagation(),b.preventDefault());break;case 27:a.vakata.context.hide(),b.preventDefault()}}).on("keydown",function(a){a.preventDefault();var b=c.element.find(".vakata-contextmenu-shortcut-"+a.which).parent();b.parent().not(".vakata-context-disabled")&&b.click()}),a(i).on("mousedown.vakata.jstree",function(b){c.is_visible&&!a.contains(c.element[0],b.target)&&a.vakata.context.hide()}).on("context_show.vakata.jstree",function(a,d){c.element.find("li:has(ul)").children("a").addClass("vakata-context-parent"),b&&c.element.addClass("vakata-context-rtl").css("direction","rtl"),c.element.find("ul").hide().end()})})}(a),a.jstree.defaults.dnd={copy:!0,open_timeout:500,is_draggable:!0,check_while_dragging:!0,always_copy:!1,inside_pos:0,drag_selection:!0,touch:!0,large_drop_target:!1,large_drag_target:!1},a.jstree.plugins.dnd=function(b,c){this.bind=function(){c.bind.call(this),this.element.on("mousedown.jstree touchstart.jstree",this.settings.dnd.large_drag_target?".jstree-node":".jstree-anchor",a.proxy(function(b){
if(this.settings.dnd.large_drag_target&&a(b.target).closest(".jstree-node")[0]!==b.currentTarget)return!0;if("touchstart"===b.type&&(!this.settings.dnd.touch||"selected"===this.settings.dnd.touch&&!a(b.currentTarget).closest(".jstree-node").children(".jstree-anchor").hasClass("jstree-clicked")))return!0;var c=this.get_node(b.target),d=this.is_selected(c)&&this.settings.dnd.drag_selection?this.get_top_selected().length:1,e=d>1?d+" "+this.get_string("nodes"):this.get_text(b.currentTarget);return this.settings.core.force_text&&(e=a.vakata.html.escape(e)),c&&c.id&&c.id!==a.jstree.root&&(1===b.which||"touchstart"===b.type)&&(this.settings.dnd.is_draggable===!0||a.isFunction(this.settings.dnd.is_draggable)&&this.settings.dnd.is_draggable.call(this,d>1?this.get_top_selected(!0):[c],b))?(this.element.trigger("mousedown.jstree"),a.vakata.dnd.start(b,{jstree:!0,origin:this,obj:this.get_node(c,!0),nodes:d>1?this.get_top_selected():[c.id]},'<div id="jstree-dnd" class="jstree-'+this.get_theme()+" jstree-"+this.get_theme()+"-"+this.get_theme_variant()+" "+(this.settings.core.themes.responsive?" jstree-dnd-responsive":"")+'"><i class="jstree-icon jstree-er"></i>'+e+'<ins class="jstree-copy" style="display:none;">+</ins></div>')):void 0},this))}},a(function(){var b=!1,c=!1,d=!1,e=!1,f=a('<div id="jstree-marker">&#160;</div>').hide();a(i).on("dnd_start.vakata.jstree",function(a,c){b=!1,d=!1,c&&c.data&&c.data.jstree&&f.appendTo("body")}).on("dnd_move.vakata.jstree",function(g,h){if(e&&clearTimeout(e),h&&h.data&&h.data.jstree&&(!h.event.target.id||"jstree-marker"!==h.event.target.id)){d=h.event;var i=a.jstree.reference(h.event.target),j=!1,k=!1,l=!1,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A;if(i&&i._data&&i._data.dnd)if(f.attr("class","jstree-"+i.get_theme()+(i.settings.core.themes.responsive?" jstree-dnd-responsive":"")),h.helper.children().attr("class","jstree-"+i.get_theme()+" jstree-"+i.get_theme()+"-"+i.get_theme_variant()+" "+(i.settings.core.themes.responsive?" jstree-dnd-responsive":"")).find(".jstree-copy").first()[h.data.origin&&(h.data.origin.settings.dnd.always_copy||h.data.origin.settings.dnd.copy&&(h.event.metaKey||h.event.ctrlKey))?"show":"hide"](),h.event.target!==i.element[0]&&h.event.target!==i.get_container_ul()[0]||0!==i.get_container_ul().children().length){if(j=i.settings.dnd.large_drop_target?a(h.event.target).closest(".jstree-node").children(".jstree-anchor"):a(h.event.target).closest(".jstree-anchor"),j&&j.length&&j.parent().is(".jstree-closed, .jstree-open, .jstree-leaf")&&(k=j.offset(),l=h.event.pageY-k.top,p=j.outerHeight(),s=p/3>l?["b","i","a"]:l>p-p/3?["a","i","b"]:l>p/2?["i","a","b"]:["i","b","a"],a.each(s,function(d,g){switch(g){case"b":n=k.left-6,o=k.top,q=i.get_parent(j),r=j.parent().index();break;case"i":z=i.settings.dnd.inside_pos,A=i.get_node(j.parent()),n=k.left-2,o=k.top+p/2+1,q=A.id,r="first"===z?0:"last"===z?A.children.length:Math.min(z,A.children.length);break;case"a":n=k.left-6,o=k.top+p,q=i.get_parent(j),r=j.parent().index()+1}for(t=!0,u=0,v=h.data.nodes.length;v>u;u++)if(w=h.data.origin&&(h.data.origin.settings.dnd.always_copy||h.data.origin.settings.dnd.copy&&(h.event.metaKey||h.event.ctrlKey))?"copy_node":"move_node",x=r,"move_node"===w&&"a"===g&&h.data.origin&&h.data.origin===i&&q===i.get_parent(h.data.nodes[u])&&(y=i.get_node(q),x>a.inArray(h.data.nodes[u],y.children)&&(x-=1)),t=t&&(i&&i.settings&&i.settings.dnd&&i.settings.dnd.check_while_dragging===!1||i.check(w,h.data.origin&&h.data.origin!==i?h.data.origin.get_node(h.data.nodes[u]):h.data.nodes[u],q,x,{dnd:!0,ref:i.get_node(j.parent()),pos:g,origin:h.data.origin,is_multi:h.data.origin&&h.data.origin!==i,is_foreign:!h.data.origin})),!t){i&&i.last_error&&(c=i.last_error());break}return"i"===g&&j.parent().is(".jstree-closed")&&i.settings.dnd.open_timeout&&(e=setTimeout(function(a,b){return function(){a.open_node(b)}}(i,j),i.settings.dnd.open_timeout)),t?(b={ins:i,par:q,pos:"i"!==g||"last"!==z||0!==r||i.is_loaded(A)?r:"last"},f.css({left:n+"px",top:o+"px"}).show(),h.helper.find(".jstree-icon").first().removeClass("jstree-er").addClass("jstree-ok"),c={},s=!0,!1):void 0}),s===!0))return}else{for(t=!0,u=0,v=h.data.nodes.length;v>u;u++)if(t=t&&i.check(h.data.origin&&(h.data.origin.settings.dnd.always_copy||h.data.origin.settings.dnd.copy&&(h.event.metaKey||h.event.ctrlKey))?"copy_node":"move_node",h.data.origin&&h.data.origin!==i?h.data.origin.get_node(h.data.nodes[u]):h.data.nodes[u],a.jstree.root,"last",{dnd:!0,ref:i.get_node(a.jstree.root),pos:"i",origin:h.data.origin,is_multi:h.data.origin&&h.data.origin!==i,is_foreign:!h.data.origin}),!t)break;if(t)return b={ins:i,par:a.jstree.root,pos:"last"},f.hide(),void h.helper.find(".jstree-icon").first().removeClass("jstree-er").addClass("jstree-ok")}b=!1,h.helper.find(".jstree-icon").removeClass("jstree-ok").addClass("jstree-er"),f.hide()}}).on("dnd_scroll.vakata.jstree",function(a,c){c&&c.data&&c.data.jstree&&(f.hide(),b=!1,d=!1,c.helper.find(".jstree-icon").first().removeClass("jstree-ok").addClass("jstree-er"))}).on("dnd_stop.vakata.jstree",function(g,h){if(e&&clearTimeout(e),h&&h.data&&h.data.jstree){f.hide().detach();var i,j,k=[];if(b){for(i=0,j=h.data.nodes.length;j>i;i++)k[i]=h.data.origin?h.data.origin.get_node(h.data.nodes[i]):h.data.nodes[i];b.ins[h.data.origin&&(h.data.origin.settings.dnd.always_copy||h.data.origin.settings.dnd.copy&&(h.event.metaKey||h.event.ctrlKey))?"copy_node":"move_node"](k,b.par,b.pos,!1,!1,!1,h.data.origin)}else i=a(h.event.target).closest(".jstree"),i.length&&c&&c.error&&"check"===c.error&&(i=i.jstree(!0),i&&i.settings.core.error.call(this,c));d=!1,b=!1}}).on("keyup.jstree keydown.jstree",function(b,c){c=a.vakata.dnd._get(),c&&c.data&&c.data.jstree&&(c.helper.find(".jstree-copy").first()[c.data.origin&&(c.data.origin.settings.dnd.always_copy||c.data.origin.settings.dnd.copy&&(b.metaKey||b.ctrlKey))?"show":"hide"](),d&&(d.metaKey=b.metaKey,d.ctrlKey=b.ctrlKey,a.vakata.dnd._trigger("move",d)))})}),function(a){a.vakata.html={div:a("<div />"),escape:function(b){return a.vakata.html.div.text(b).html()},strip:function(b){return a.vakata.html.div.empty().append(a.parseHTML(b)).text()}};var b={element:!1,target:!1,is_down:!1,is_drag:!1,helper:!1,helper_w:0,data:!1,init_x:0,init_y:0,scroll_l:0,scroll_t:0,scroll_e:!1,scroll_i:!1,is_touch:!1};a.vakata.dnd={settings:{scroll_speed:10,scroll_proximity:20,helper_left:5,helper_top:10,threshold:5,threshold_touch:50},_trigger:function(b,c){var d=a.vakata.dnd._get();d.event=c,a(i).triggerHandler("dnd_"+b+".vakata",d)},_get:function(){return{data:b.data,element:b.element,helper:b.helper}},_clean:function(){b.helper&&b.helper.remove(),b.scroll_i&&(clearInterval(b.scroll_i),b.scroll_i=!1),b={element:!1,target:!1,is_down:!1,is_drag:!1,helper:!1,helper_w:0,data:!1,init_x:0,init_y:0,scroll_l:0,scroll_t:0,scroll_e:!1,scroll_i:!1,is_touch:!1},a(i).off("mousemove.vakata.jstree touchmove.vakata.jstree",a.vakata.dnd.drag),a(i).off("mouseup.vakata.jstree touchend.vakata.jstree",a.vakata.dnd.stop)},_scroll:function(c){if(!b.scroll_e||!b.scroll_l&&!b.scroll_t)return b.scroll_i&&(clearInterval(b.scroll_i),b.scroll_i=!1),!1;if(!b.scroll_i)return b.scroll_i=setInterval(a.vakata.dnd._scroll,100),!1;if(c===!0)return!1;var d=b.scroll_e.scrollTop(),e=b.scroll_e.scrollLeft();b.scroll_e.scrollTop(d+b.scroll_t*a.vakata.dnd.settings.scroll_speed),b.scroll_e.scrollLeft(e+b.scroll_l*a.vakata.dnd.settings.scroll_speed),(d!==b.scroll_e.scrollTop()||e!==b.scroll_e.scrollLeft())&&a.vakata.dnd._trigger("scroll",b.scroll_e)},start:function(c,d,e){"touchstart"===c.type&&c.originalEvent&&c.originalEvent.changedTouches&&c.originalEvent.changedTouches[0]&&(c.pageX=c.originalEvent.changedTouches[0].pageX,c.pageY=c.originalEvent.changedTouches[0].pageY,c.target=i.elementFromPoint(c.originalEvent.changedTouches[0].pageX-window.pageXOffset,c.originalEvent.changedTouches[0].pageY-window.pageYOffset)),b.is_drag&&a.vakata.dnd.stop({});try{c.currentTarget.unselectable="on",c.currentTarget.onselectstart=function(){return!1},c.currentTarget.style&&(c.currentTarget.style.MozUserSelect="none")}catch(f){}return b.init_x=c.pageX,b.init_y=c.pageY,b.data=d,b.is_down=!0,b.element=c.currentTarget,b.target=c.target,b.is_touch="touchstart"===c.type,e!==!1&&(b.helper=a("<div id='vakata-dnd'></div>").html(e).css({display:"block",margin:"0",padding:"0",position:"absolute",top:"-2000px",lineHeight:"16px",zIndex:"10000"})),a(i).on("mousemove.vakata.jstree touchmove.vakata.jstree",a.vakata.dnd.drag),a(i).on("mouseup.vakata.jstree touchend.vakata.jstree",a.vakata.dnd.stop),!1},drag:function(c){if("touchmove"===c.type&&c.originalEvent&&c.originalEvent.changedTouches&&c.originalEvent.changedTouches[0]&&(c.pageX=c.originalEvent.changedTouches[0].pageX,c.pageY=c.originalEvent.changedTouches[0].pageY,c.target=i.elementFromPoint(c.originalEvent.changedTouches[0].pageX-window.pageXOffset,c.originalEvent.changedTouches[0].pageY-window.pageYOffset)),b.is_down){if(!b.is_drag){if(!(Math.abs(c.pageX-b.init_x)>(b.is_touch?a.vakata.dnd.settings.threshold_touch:a.vakata.dnd.settings.threshold)||Math.abs(c.pageY-b.init_y)>(b.is_touch?a.vakata.dnd.settings.threshold_touch:a.vakata.dnd.settings.threshold)))return;b.helper&&(b.helper.appendTo("body"),b.helper_w=b.helper.outerWidth()),b.is_drag=!0,a.vakata.dnd._trigger("start",c)}var d=!1,e=!1,f=!1,g=!1,h=!1,j=!1,k=!1,l=!1,m=!1,n=!1;return b.scroll_t=0,b.scroll_l=0,b.scroll_e=!1,a(a(c.target).parentsUntil("body").addBack().get().reverse()).filter(function(){return/^auto|scroll$/.test(a(this).css("overflow"))&&(this.scrollHeight>this.offsetHeight||this.scrollWidth>this.offsetWidth)}).each(function(){var d=a(this),e=d.offset();return this.scrollHeight>this.offsetHeight&&(e.top+d.height()-c.pageY<a.vakata.dnd.settings.scroll_proximity&&(b.scroll_t=1),c.pageY-e.top<a.vakata.dnd.settings.scroll_proximity&&(b.scroll_t=-1)),this.scrollWidth>this.offsetWidth&&(e.left+d.width()-c.pageX<a.vakata.dnd.settings.scroll_proximity&&(b.scroll_l=1),c.pageX-e.left<a.vakata.dnd.settings.scroll_proximity&&(b.scroll_l=-1)),b.scroll_t||b.scroll_l?(b.scroll_e=a(this),!1):void 0}),b.scroll_e||(d=a(i),e=a(window),f=d.height(),g=e.height(),h=d.width(),j=e.width(),k=d.scrollTop(),l=d.scrollLeft(),f>g&&c.pageY-k<a.vakata.dnd.settings.scroll_proximity&&(b.scroll_t=-1),f>g&&g-(c.pageY-k)<a.vakata.dnd.settings.scroll_proximity&&(b.scroll_t=1),h>j&&c.pageX-l<a.vakata.dnd.settings.scroll_proximity&&(b.scroll_l=-1),h>j&&j-(c.pageX-l)<a.vakata.dnd.settings.scroll_proximity&&(b.scroll_l=1),(b.scroll_t||b.scroll_l)&&(b.scroll_e=d)),b.scroll_e&&a.vakata.dnd._scroll(!0),b.helper&&(m=parseInt(c.pageY+a.vakata.dnd.settings.helper_top,10),n=parseInt(c.pageX+a.vakata.dnd.settings.helper_left,10),f&&m+25>f&&(m=f-50),h&&n+b.helper_w>h&&(n=h-(b.helper_w+2)),b.helper.css({left:n+"px",top:m+"px"})),a.vakata.dnd._trigger("move",c),!1}},stop:function(c){if("touchend"===c.type&&c.originalEvent&&c.originalEvent.changedTouches&&c.originalEvent.changedTouches[0]&&(c.pageX=c.originalEvent.changedTouches[0].pageX,c.pageY=c.originalEvent.changedTouches[0].pageY,c.target=i.elementFromPoint(c.originalEvent.changedTouches[0].pageX-window.pageXOffset,c.originalEvent.changedTouches[0].pageY-window.pageYOffset)),b.is_drag)a.vakata.dnd._trigger("stop",c);else if("touchend"===c.type&&c.target===b.target){var d=setTimeout(function(){a(c.target).click()},100);a(c.target).one("click",function(){d&&clearTimeout(d)})}return a.vakata.dnd._clean(),!1}}}(a),a.jstree.defaults.massload=null,a.jstree.plugins.massload=function(b,c){this.init=function(a,b){c.init.call(this,a,b),this._data.massload={}},this._load_nodes=function(b,d,e){var f=this.settings.massload;return e&&!a.isEmptyObject(this._data.massload)?c._load_nodes.call(this,b,d,e):a.isFunction(f)?f.call(this,b,a.proxy(function(a){if(a)for(var f in a)a.hasOwnProperty(f)&&(this._data.massload[f]=a[f]);c._load_nodes.call(this,b,d,e)},this)):"object"==typeof f&&f&&f.url?(f=a.extend(!0,{},f),a.isFunction(f.url)&&(f.url=f.url.call(this,b)),a.isFunction(f.data)&&(f.data=f.data.call(this,b)),a.ajax(f).done(a.proxy(function(a,f,g){if(a)for(var h in a)a.hasOwnProperty(h)&&(this._data.massload[h]=a[h]);c._load_nodes.call(this,b,d,e)},this)).fail(a.proxy(function(a){c._load_nodes.call(this,b,d,e)},this))):c._load_nodes.call(this,b,d,e)},this._load_node=function(b,d){var e=this._data.massload[b.id];return e?this["string"==typeof e?"_append_html_data":"_append_json_data"](b,"string"==typeof e?a(a.parseHTML(e)).filter(function(){return 3!==this.nodeType}):e,function(a){d.call(this,a),delete this._data.massload[b.id]}):c._load_node.call(this,b,d)}},a.jstree.defaults.search={ajax:!1,fuzzy:!1,case_sensitive:!1,show_only_matches:!1,show_only_matches_children:!1,close_opened_onclear:!0,search_leaves_only:!1,search_callback:!1},a.jstree.plugins.search=function(c,d){this.bind=function(){d.bind.call(this),this._data.search.str="",this._data.search.dom=a(),this._data.search.res=[],this._data.search.opn=[],this._data.search.som=!1,this._data.search.smc=!1,this._data.search.hdn=[],this.element.on("search.jstree",a.proxy(function(b,c){if(this._data.search.som&&c.res.length){var d=this._model.data,e,f,g=[];for(e=0,f=c.res.length;f>e;e++)d[c.res[e]]&&!d[c.res[e]].state.hidden&&(g.push(c.res[e]),g=g.concat(d[c.res[e]].parents),this._data.search.smc&&(g=g.concat(d[c.res[e]].children_d)));g=a.vakata.array_remove_item(a.vakata.array_unique(g),a.jstree.root),this._data.search.hdn=this.hide_all(!0),this.show_node(g)}},this)).on("clear_search.jstree",a.proxy(function(a,b){this._data.search.som&&b.res.length&&this.show_node(this._data.search.hdn)},this))},this.search=function(c,d,e,f,g,h){if(c===!1||""===a.trim(c.toString()))return this.clear_search();f=this.get_node(f),f=f&&f.id?f.id:null,c=c.toString();var i=this.settings.search,j=i.ajax?i.ajax:!1,k=this._model.data,l=null,m=[],n=[],o,p;if(this._data.search.res.length&&!g&&this.clear_search(),e===b&&(e=i.show_only_matches),h===b&&(h=i.show_only_matches_children),!d&&j!==!1)return a.isFunction(j)?j.call(this,c,a.proxy(function(b){b&&b.d&&(b=b.d),this._load_nodes(a.isArray(b)?a.vakata.array_unique(b):[],function(){this.search(c,!0,e,f,g)},!0)},this),f):(j=a.extend({},j),j.data||(j.data={}),j.data.str=c,f&&(j.data.inside=f),a.ajax(j).fail(a.proxy(function(){this._data.core.last_error={error:"ajax",plugin:"search",id:"search_01",reason:"Could not load search parents",data:JSON.stringify(j)},this.settings.core.error.call(this,this._data.core.last_error)},this)).done(a.proxy(function(b){b&&b.d&&(b=b.d),this._load_nodes(a.isArray(b)?a.vakata.array_unique(b):[],function(){this.search(c,!0,e,f,g)},!0)},this)));if(g||(this._data.search.str=c,this._data.search.dom=a(),this._data.search.res=[],this._data.search.opn=[],this._data.search.som=e,this._data.search.smc=h),l=new a.vakata.search(c,!0,{caseSensitive:i.case_sensitive,fuzzy:i.fuzzy}),a.each(k[f?f:a.jstree.root].children_d,function(a,b){var d=k[b];d.text&&(!i.search_leaves_only||d.state.loaded&&0===d.children.length)&&(i.search_callback&&i.search_callback.call(this,c,d)||!i.search_callback&&l.search(d.text).isMatch)&&(m.push(b),n=n.concat(d.parents))}),m.length){for(n=a.vakata.array_unique(n),o=0,p=n.length;p>o;o++)n[o]!==a.jstree.root&&k[n[o]]&&this.open_node(n[o],null,0)===!0&&this._data.search.opn.push(n[o]);g?(this._data.search.dom=this._data.search.dom.add(a(this.element[0].querySelectorAll("#"+a.map(m,function(b){return-1!=="0123456789".indexOf(b[0])?"\\3"+b[0]+" "+b.substr(1).replace(a.jstree.idregex,"\\$&"):b.replace(a.jstree.idregex,"\\$&")}).join(", #")))),this._data.search.res=a.vakata.array_unique(this._data.search.res.concat(m))):(this._data.search.dom=a(this.element[0].querySelectorAll("#"+a.map(m,function(b){return-1!=="0123456789".indexOf(b[0])?"\\3"+b[0]+" "+b.substr(1).replace(a.jstree.idregex,"\\$&"):b.replace(a.jstree.idregex,"\\$&")}).join(", #"))),this._data.search.res=m),this._data.search.dom.children(".jstree-anchor").addClass("jstree-search")}this.trigger("search",{nodes:this._data.search.dom,str:c,res:this._data.search.res,show_only_matches:e})},this.clear_search=function(){this.settings.search.close_opened_onclear&&this.close_node(this._data.search.opn,0),this.trigger("clear_search",{nodes:this._data.search.dom,str:this._data.search.str,res:this._data.search.res}),this._data.search.res.length&&(this._data.search.dom=a(this.element[0].querySelectorAll("#"+a.map(this._data.search.res,function(b){return-1!=="0123456789".indexOf(b[0])?"\\3"+b[0]+" "+b.substr(1).replace(a.jstree.idregex,"\\$&"):b.replace(a.jstree.idregex,"\\$&")}).join(", #"))),this._data.search.dom.children(".jstree-anchor").removeClass("jstree-search")),this._data.search.str="",this._data.search.res=[],this._data.search.opn=[],this._data.search.dom=a()},this.redraw_node=function(b,c,e,f){if(b=d.redraw_node.apply(this,arguments),b&&-1!==a.inArray(b.id,this._data.search.res)){var g,h,i=null;for(g=0,h=b.childNodes.length;h>g;g++)if(b.childNodes[g]&&b.childNodes[g].className&&-1!==b.childNodes[g].className.indexOf("jstree-anchor")){i=b.childNodes[g];break}i&&(i.className+=" jstree-search")}return b}},function(a){a.vakata.search=function(b,c,d){d=d||{},d=a.extend({},a.vakata.search.defaults,d),d.fuzzy!==!1&&(d.fuzzy=!0),b=d.caseSensitive?b:b.toLowerCase();var e=d.location,f=d.distance,g=d.threshold,h=b.length,i,j,k,l;return h>32&&(d.fuzzy=!1),d.fuzzy&&(i=1<<h-1,j=function(){var a={},c=0;for(c=0;h>c;c++)a[b.charAt(c)]=0;for(c=0;h>c;c++)a[b.charAt(c)]|=1<<h-c-1;return a}(),k=function(a,b){var c=a/h,d=Math.abs(e-b);return f?c+d/f:d?1:c}),l=function(a){if(a=d.caseSensitive?a:a.toLowerCase(),b===a||-1!==a.indexOf(b))return{isMatch:!0,score:0};if(!d.fuzzy)return{isMatch:!1,score:1};var c,f,l=a.length,m=g,n=a.indexOf(b,e),o,p,q=h+l,r,s,t,u,v,w=1,x=[];for(-1!==n&&(m=Math.min(k(0,n),m),n=a.lastIndexOf(b,e+h),-1!==n&&(m=Math.min(k(0,n),m))),n=-1,c=0;h>c;c++){o=0,p=q;while(p>o)k(c,e+p)<=m?o=p:q=p,p=Math.floor((q-o)/2+o);for(q=p,s=Math.max(1,e-p+1),t=Math.min(e+p,l)+h,u=new Array(t+2),u[t+1]=(1<<c)-1,f=t;f>=s;f--)if(v=j[a.charAt(f-1)],0===c?u[f]=(u[f+1]<<1|1)&v:u[f]=(u[f+1]<<1|1)&v|((r[f+1]|r[f])<<1|1)|r[f+1],u[f]&i&&(w=k(c,f-1),m>=w)){if(m=w,n=f-1,x.push(n),!(n>e))break;s=Math.max(1,2*e-n)}if(k(c+1,e)>m)break;r=u}return{isMatch:n>=0,score:w}},c===!0?{search:l}:l(c)},a.vakata.search.defaults={location:0,distance:100,threshold:.6,fuzzy:!1,caseSensitive:!1}}(a),a.jstree.defaults.sort=function(a,b){return this.get_text(a)>this.get_text(b)?1:-1},a.jstree.plugins.sort=function(b,c){this.bind=function(){c.bind.call(this),this.element.on("model.jstree",a.proxy(function(a,b){this.sort(b.parent,!0)},this)).on("rename_node.jstree create_node.jstree",a.proxy(function(a,b){this.sort(b.parent||b.node.parent,!1),this.redraw_node(b.parent||b.node.parent,!0)},this)).on("move_node.jstree copy_node.jstree",a.proxy(function(a,b){this.sort(b.parent,!1),this.redraw_node(b.parent,!0)},this))},this.sort=function(b,c){var d,e;if(b=this.get_node(b),b&&b.children&&b.children.length&&(b.children.sort(a.proxy(this.settings.sort,this)),c))for(d=0,e=b.children_d.length;e>d;d++)this.sort(b.children_d[d],!1)}};var n=!1;a.jstree.defaults.state={key:"jstree",events:"changed.jstree open_node.jstree close_node.jstree check_node.jstree uncheck_node.jstree",ttl:!1,filter:!1},a.jstree.plugins.state=function(b,c){this.bind=function(){c.bind.call(this);var b=a.proxy(function(){this.element.on(this.settings.state.events,a.proxy(function(){n&&clearTimeout(n),n=setTimeout(a.proxy(function(){this.save_state()},this),100)},this)),this.trigger("state_ready")},this);this.element.on("ready.jstree",a.proxy(function(a,c){this.element.one("restore_state.jstree",b),this.restore_state()||b()},this))},this.save_state=function(){var b={state:this.get_state(),ttl:this.settings.state.ttl,sec:+new Date};a.vakata.storage.set(this.settings.state.key,JSON.stringify(b))},this.restore_state=function(){var b=a.vakata.storage.get(this.settings.state.key);if(b)try{b=JSON.parse(b)}catch(c){return!1}return b&&b.ttl&&b.sec&&+new Date-b.sec>b.ttl?!1:(b&&b.state&&(b=b.state),b&&a.isFunction(this.settings.state.filter)&&(b=this.settings.state.filter.call(this,b)),b?(this.element.one("set_state.jstree",function(c,d){d.instance.trigger("restore_state",{state:a.extend(!0,{},b)})}),this.set_state(b),!0):!1)},this.clear_state=function(){return a.vakata.storage.del(this.settings.state.key)}},function(a,b){a.vakata.storage={set:function(a,b){return window.localStorage.setItem(a,b)},get:function(a){return window.localStorage.getItem(a)},del:function(a){return window.localStorage.removeItem(a)}}}(a),a.jstree.defaults.types={"default":{}},a.jstree.defaults.types[a.jstree.root]={},a.jstree.plugins.types=function(c,d){this.init=function(c,e){var f,g;if(e&&e.types&&e.types["default"])for(f in e.types)if("default"!==f&&f!==a.jstree.root&&e.types.hasOwnProperty(f))for(g in e.types["default"])e.types["default"].hasOwnProperty(g)&&e.types[f][g]===b&&(e.types[f][g]=e.types["default"][g]);d.init.call(this,c,e),this._model.data[a.jstree.root].type=a.jstree.root},this.refresh=function(b,c){d.refresh.call(this,b,c),this._model.data[a.jstree.root].type=a.jstree.root},this.bind=function(){this.element.on("model.jstree",a.proxy(function(c,d){var e=this._model.data,f=d.nodes,g=this.settings.types,h,i,j="default";for(h=0,i=f.length;i>h;h++)j="default",e[f[h]].original&&e[f[h]].original.type&&g[e[f[h]].original.type]&&(j=e[f[h]].original.type),e[f[h]].data&&e[f[h]].data.jstree&&e[f[h]].data.jstree.type&&g[e[f[h]].data.jstree.type]&&(j=e[f[h]].data.jstree.type),e[f[h]].type=j,e[f[h]].icon===!0&&g[j].icon!==b&&(e[f[h]].icon=g[j].icon);e[a.jstree.root].type=a.jstree.root},this)),d.bind.call(this)},this.get_json=function(b,c,e){var f,g,h=this._model.data,i=c?a.extend(!0,{},c,{no_id:!1}):{},j=d.get_json.call(this,b,i,e);if(j===!1)return!1;if(a.isArray(j))for(f=0,g=j.length;g>f;f++)j[f].type=j[f].id&&h[j[f].id]&&h[j[f].id].type?h[j[f].id].type:"default",c&&c.no_id&&(delete j[f].id,j[f].li_attr&&j[f].li_attr.id&&delete j[f].li_attr.id,j[f].a_attr&&j[f].a_attr.id&&delete j[f].a_attr.id);else j.type=j.id&&h[j.id]&&h[j.id].type?h[j.id].type:"default",c&&c.no_id&&(j=this._delete_ids(j));return j},this._delete_ids=function(b){if(a.isArray(b)){for(var c=0,d=b.length;d>c;c++)b[c]=this._delete_ids(b[c]);return b}return delete b.id,b.li_attr&&b.li_attr.id&&delete b.li_attr.id,b.a_attr&&b.a_attr.id&&delete b.a_attr.id,b.children&&a.isArray(b.children)&&(b.children=this._delete_ids(b.children)),b},this.check=function(c,e,f,g,h){if(d.check.call(this,c,e,f,g,h)===!1)return!1;e=e&&e.id?e:this.get_node(e),f=f&&f.id?f:this.get_node(f);var i=e&&e.id?h&&h.origin?h.origin:a.jstree.reference(e.id):null,j,k,l,m;switch(i=i&&i._model&&i._model.data?i._model.data:null,c){case"create_node":case"move_node":case"copy_node":if("move_node"!==c||-1===a.inArray(e.id,f.children)){if(j=this.get_rules(f),j.max_children!==b&&-1!==j.max_children&&j.max_children===f.children.length)return this._data.core.last_error={error:"check",plugin:"types",id:"types_01",reason:"max_children prevents function: "+c,data:JSON.stringify({chk:c,pos:g,obj:e&&e.id?e.id:!1,par:f&&f.id?f.id:!1})},!1;if(j.valid_children!==b&&-1!==j.valid_children&&-1===a.inArray(e.type||"default",j.valid_children))return this._data.core.last_error={error:"check",plugin:"types",id:"types_02",reason:"valid_children prevents function: "+c,data:JSON.stringify({chk:c,pos:g,obj:e&&e.id?e.id:!1,par:f&&f.id?f.id:!1})},!1;if(i&&e.children_d&&e.parents){for(k=0,l=0,m=e.children_d.length;m>l;l++)k=Math.max(k,i[e.children_d[l]].parents.length);k=k-e.parents.length+1}(0>=k||k===b)&&(k=1);do{if(j.max_depth!==b&&-1!==j.max_depth&&j.max_depth<k)return this._data.core.last_error={error:"check",plugin:"types",id:"types_03",reason:"max_depth prevents function: "+c,data:JSON.stringify({chk:c,pos:g,obj:e&&e.id?e.id:!1,par:f&&f.id?f.id:!1})},!1;f=this.get_node(f.parent),j=this.get_rules(f),k++}while(f)}}return!0},this.get_rules=function(a){if(a=this.get_node(a),!a)return!1;var c=this.get_type(a,!0);return c.max_depth===b&&(c.max_depth=-1),c.max_children===b&&(c.max_children=-1),c.valid_children===b&&(c.valid_children=-1),c},this.get_type=function(b,c){return b=this.get_node(b),b?c?a.extend({type:b.type},this.settings.types[b.type]):b.type:!1},this.set_type=function(c,d){var e,f,g,h,i;if(a.isArray(c)){for(c=c.slice(),f=0,g=c.length;g>f;f++)this.set_type(c[f],d);return!0}return e=this.settings.types,c=this.get_node(c),e[d]&&c?(h=c.type,i=this.get_icon(c),c.type=d,(i===!0||e[h]&&e[h].icon!==b&&i===e[h].icon)&&this.set_icon(c,e[d].icon!==b?e[d].icon:!0),!0):!1}},a.jstree.defaults.unique={case_sensitive:!1,duplicate:function(a,b){return a+" ("+b+")"}},a.jstree.plugins.unique=function(c,d){this.check=function(b,c,e,f,g){if(d.check.call(this,b,c,e,f,g)===!1)return!1;if(c=c&&c.id?c:this.get_node(c),e=e&&e.id?e:this.get_node(e),!e||!e.children)return!0;var h="rename_node"===b?f:c.text,i=[],j=this.settings.unique.case_sensitive,k=this._model.data,l,m;for(l=0,m=e.children.length;m>l;l++)i.push(j?k[e.children[l]].text:k[e.children[l]].text.toLowerCase());switch(j||(h=h.toLowerCase()),b){case"delete_node":return!0;case"rename_node":return l=-1===a.inArray(h,i)||c.text&&c.text[j?"toString":"toLowerCase"]()===h,l||(this._data.core.last_error={error:"check",plugin:"unique",id:"unique_01",reason:"Child with name "+h+" already exists. Preventing: "+b,data:JSON.stringify({chk:b,pos:f,obj:c&&c.id?c.id:!1,par:e&&e.id?e.id:!1})}),l;case"create_node":return l=-1===a.inArray(h,i),l||(this._data.core.last_error={error:"check",plugin:"unique",id:"unique_04",reason:"Child with name "+h+" already exists. Preventing: "+b,data:JSON.stringify({chk:b,pos:f,obj:c&&c.id?c.id:!1,par:e&&e.id?e.id:!1})}),l;case"copy_node":return l=-1===a.inArray(h,i),l||(this._data.core.last_error={error:"check",plugin:"unique",id:"unique_02",reason:"Child with name "+h+" already exists. Preventing: "+b,data:JSON.stringify({chk:b,pos:f,obj:c&&c.id?c.id:!1,par:e&&e.id?e.id:!1})}),l;case"move_node":return l=c.parent===e.id&&(!g||!g.is_multi)||-1===a.inArray(h,i),l||(this._data.core.last_error={error:"check",plugin:"unique",id:"unique_03",reason:"Child with name "+h+" already exists. Preventing: "+b,data:JSON.stringify({chk:b,pos:f,obj:c&&c.id?c.id:!1,par:e&&e.id?e.id:!1})}),l}return!0},this.create_node=function(c,e,f,g,h){if(!e||e.text===b){if(null===c&&(c=a.jstree.root),c=this.get_node(c),!c)return d.create_node.call(this,c,e,f,g,h);if(f=f===b?"last":f,!f.toString().match(/^(before|after)$/)&&!h&&!this.is_loaded(c))return d.create_node.call(this,c,e,f,g,h);e||(e={});var i,j,k,l,m,n=this._model.data,o=this.settings.unique.case_sensitive,p=this.settings.unique.duplicate;for(j=i=this.get_string("New node"),k=[],l=0,m=c.children.length;m>l;l++)k.push(o?n[c.children[l]].text:n[c.children[l]].text.toLowerCase());l=1;while(-1!==a.inArray(o?j:j.toLowerCase(),k))j=p.call(this,i,++l).toString();e.text=j}return d.create_node.call(this,c,e,f,g,h)}};var o=i.createElement("DIV");if(o.setAttribute("unselectable","on"),o.setAttribute("role","presentation"),o.className="jstree-wholerow",o.innerHTML="&#160;",a.jstree.plugins.wholerow=function(b,c){this.bind=function(){c.bind.call(this),this.element.on("ready.jstree set_state.jstree",a.proxy(function(){this.hide_dots()},this)).on("init.jstree loading.jstree ready.jstree",a.proxy(function(){this.get_container_ul().addClass("jstree-wholerow-ul")},this)).on("deselect_all.jstree",a.proxy(function(a,b){this.element.find(".jstree-wholerow-clicked").removeClass("jstree-wholerow-clicked")},this)).on("changed.jstree",a.proxy(function(a,b){this.element.find(".jstree-wholerow-clicked").removeClass("jstree-wholerow-clicked");var c=!1,d,e;for(d=0,e=b.selected.length;e>d;d++)c=this.get_node(b.selected[d],!0),c&&c.length&&c.children(".jstree-wholerow").addClass("jstree-wholerow-clicked")},this)).on("open_node.jstree",a.proxy(function(a,b){this.get_node(b.node,!0).find(".jstree-clicked").parent().children(".jstree-wholerow").addClass("jstree-wholerow-clicked")},this)).on("hover_node.jstree dehover_node.jstree",a.proxy(function(a,b){"hover_node"===a.type&&this.is_disabled(b.node)||this.get_node(b.node,!0).children(".jstree-wholerow")["hover_node"===a.type?"addClass":"removeClass"]("jstree-wholerow-hovered")},this)).on("contextmenu.jstree",".jstree-wholerow",a.proxy(function(b){b.preventDefault();var c=a.Event("contextmenu",{metaKey:b.metaKey,ctrlKey:b.ctrlKey,altKey:b.altKey,shiftKey:b.shiftKey,pageX:b.pageX,pageY:b.pageY});a(b.currentTarget).closest(".jstree-node").children(".jstree-anchor").first().trigger(c)},this)).on("click.jstree",".jstree-wholerow",function(b){b.stopImmediatePropagation();var c=a.Event("click",{metaKey:b.metaKey,ctrlKey:b.ctrlKey,altKey:b.altKey,shiftKey:b.shiftKey});a(b.currentTarget).closest(".jstree-node").children(".jstree-anchor").first().trigger(c).focus()}).on("click.jstree",".jstree-leaf > .jstree-ocl",a.proxy(function(b){b.stopImmediatePropagation();var c=a.Event("click",{metaKey:b.metaKey,ctrlKey:b.ctrlKey,altKey:b.altKey,shiftKey:b.shiftKey});a(b.currentTarget).closest(".jstree-node").children(".jstree-anchor").first().trigger(c).focus()},this)).on("mouseover.jstree",".jstree-wholerow, .jstree-icon",a.proxy(function(a){return a.stopImmediatePropagation(),this.is_disabled(a.currentTarget)||this.hover_node(a.currentTarget),!1},this)).on("mouseleave.jstree",".jstree-node",a.proxy(function(a){this.dehover_node(a.currentTarget)},this))},this.teardown=function(){this.settings.wholerow&&this.element.find(".jstree-wholerow").remove(),c.teardown.call(this)},this.redraw_node=function(b,d,e,f){if(b=c.redraw_node.apply(this,arguments)){var g=o.cloneNode(!0);-1!==a.inArray(b.id,this._data.core.selected)&&(g.className+=" jstree-wholerow-clicked"),this._data.core.focused&&this._data.core.focused===b.id&&(g.className+=" jstree-wholerow-hovered"),b.insertBefore(g,b.childNodes[0])}return b}},i.registerElement&&Object&&Object.create){var p=Object.create(HTMLElement.prototype);p.createdCallback=function(){var b={core:{},plugins:[]},c;for(c in a.jstree.plugins)a.jstree.plugins.hasOwnProperty(c)&&this.attributes[c]&&(b.plugins.push(c),this.getAttribute(c)&&JSON.parse(this.getAttribute(c))&&(b[c]=JSON.parse(this.getAttribute(c))));for(c in a.jstree.defaults.core)a.jstree.defaults.core.hasOwnProperty(c)&&this.attributes[c]&&(b.core[c]=JSON.parse(this.getAttribute(c))||this.getAttribute(c));a(this).jstree(b)};try{i.registerElement("vakata-jstree",{prototype:p})}catch(q){}}}});
//**// DataTables 1.13.6 //**//
!function(n){"use strict";var a;"function"==typeof define&&define.amd?define(["jquery"],function(t){return n(t,window,document)}):"object"==typeof exports?(a=require("jquery"),"undefined"==typeof window?module.exports=function(t,e){return t=t||window,e=e||a(t),n(e,t,t.document)}:n(a,window,window.document)):window.DataTable=n(jQuery,window,document)}(function(P,j,v,H){"use strict";function d(t){var e=parseInt(t,10);return!isNaN(e)&&isFinite(t)?e:null}function l(t,e,n){var a=typeof t,r="string"==a;return"number"==a||"bigint"==a||!!h(t)||(e&&r&&(t=$(t,e)),n&&r&&(t=t.replace(q,"")),!isNaN(parseFloat(t))&&isFinite(t))}function a(t,e,n){var a;return!!h(t)||(h(a=t)||"string"==typeof a)&&!!l(t.replace(V,"").replace(/<script/i,""),e,n)||null}function m(t,e,n,a){var r=[],o=0,i=e.length;if(a!==H)for(;o<i;o++)t[e[o]][n]&&r.push(t[e[o]][n][a]);else for(;o<i;o++)r.push(t[e[o]][n]);return r}function f(t,e){var n,a=[];e===H?(e=0,n=t):(n=e,e=t);for(var r=e;r<n;r++)a.push(r);return a}function _(t){for(var e=[],n=0,a=t.length;n<a;n++)t[n]&&e.push(t[n]);return e}function s(t,e){return-1!==this.indexOf(t,e=e===H?0:e)}var p,e,t,w=function(t,v){if(w.factory(t,v))return w;if(this instanceof w)return P(t).DataTable(v);v=t,this.$=function(t,e){return this.api(!0).$(t,e)},this._=function(t,e){return this.api(!0).rows(t,e).data()},this.api=function(t){return new B(t?ge(this[p.iApiIndex]):this)},this.fnAddData=function(t,e){var n=this.api(!0),t=(Array.isArray(t)&&(Array.isArray(t[0])||P.isPlainObject(t[0]))?n.rows:n.row).add(t);return e!==H&&!e||n.draw(),t.flatten().toArray()},this.fnAdjustColumnSizing=function(t){var e=this.api(!0).columns.adjust(),n=e.settings()[0],a=n.oScroll;t===H||t?e.draw(!1):""===a.sX&&""===a.sY||Qt(n)},this.fnClearTable=function(t){var e=this.api(!0).clear();t!==H&&!t||e.draw()},this.fnClose=function(t){this.api(!0).row(t).child.hide()},this.fnDeleteRow=function(t,e,n){var a=this.api(!0),t=a.rows(t),r=t.settings()[0],o=r.aoData[t[0][0]];return t.remove(),e&&e.call(this,r,o),n!==H&&!n||a.draw(),o},this.fnDestroy=function(t){this.api(!0).destroy(t)},this.fnDraw=function(t){this.api(!0).draw(t)},this.fnFilter=function(t,e,n,a,r,o){var i=this.api(!0);(null===e||e===H?i:i.column(e)).search(t,n,a,o),i.draw()},this.fnGetData=function(t,e){var n,a=this.api(!0);return t!==H?(n=t.nodeName?t.nodeName.toLowerCase():"",e!==H||"td"==n||"th"==n?a.cell(t,e).data():a.row(t).data()||null):a.data().toArray()},this.fnGetNodes=function(t){var e=this.api(!0);return t!==H?e.row(t).node():e.rows().nodes().flatten().toArray()},this.fnGetPosition=function(t){var e=this.api(!0),n=t.nodeName.toUpperCase();return"TR"==n?e.row(t).index():"TD"==n||"TH"==n?[(n=e.cell(t).index()).row,n.columnVisible,n.column]:null},this.fnIsOpen=function(t){return this.api(!0).row(t).child.isShown()},this.fnOpen=function(t,e,n){return this.api(!0).row(t).child(e,n).show().child()[0]},this.fnPageChange=function(t,e){t=this.api(!0).page(t);e!==H&&!e||t.draw(!1)},this.fnSetColumnVis=function(t,e,n){t=this.api(!0).column(t).visible(e);n!==H&&!n||t.columns.adjust().draw()},this.fnSettings=function(){return ge(this[p.iApiIndex])},this.fnSort=function(t){this.api(!0).order(t).draw()},this.fnSortListener=function(t,e,n){this.api(!0).order.listener(t,e,n)},this.fnUpdate=function(t,e,n,a,r){var o=this.api(!0);return(n===H||null===n?o.row(e):o.cell(e,n)).data(t),r!==H&&!r||o.columns.adjust(),a!==H&&!a||o.draw(),0},this.fnVersionCheck=p.fnVersionCheck;var e,y=this,D=v===H,_=this.length;for(e in D&&(v={}),this.oApi=this.internal=p.internal,w.ext.internal)e&&(this[e]=$e(e));return this.each(function(){var r=1<_?be({},v,!0):v,o=0,t=this.getAttribute("id"),i=!1,e=w.defaults,l=P(this);if("table"!=this.nodeName.toLowerCase())W(null,0,"Non-table node initialisation ("+this.nodeName+")",2);else{K(e),Q(e.column),C(e,e,!0),C(e.column,e.column,!0),C(e,P.extend(r,l.data()),!0);for(var n=w.settings,o=0,s=n.length;o<s;o++){var a=n[o];if(a.nTable==this||a.nTHead&&a.nTHead.parentNode==this||a.nTFoot&&a.nTFoot.parentNode==this){var u=(r.bRetrieve!==H?r:e).bRetrieve,c=(r.bDestroy!==H?r:e).bDestroy;if(D||u)return a.oInstance;if(c){a.oInstance.fnDestroy();break}return void W(a,0,"Cannot reinitialise DataTable",3)}if(a.sTableId==this.id){n.splice(o,1);break}}null!==t&&""!==t||(t="DataTables_Table_"+w.ext._unique++,this.id=t);var f,d,h=P.extend(!0,{},w.models.oSettings,{sDestroyWidth:l[0].style.width,sInstance:t,sTableId:t}),p=(h.nTable=this,h.oApi=y.internal,h.oInit=r,n.push(h),h.oInstance=1===y.length?y:l.dataTable(),K(r),Z(r.oLanguage),r.aLengthMenu&&!r.iDisplayLength&&(r.iDisplayLength=(Array.isArray(r.aLengthMenu[0])?r.aLengthMenu[0]:r.aLengthMenu)[0]),r=be(P.extend(!0,{},e),r),F(h.oFeatures,r,["bPaginate","bLengthChange","bFilter","bSort","bSortMulti","bInfo","bProcessing","bAutoWidth","bSortClasses","bServerSide","bDeferRender"]),F(h,r,["asStripeClasses","ajax","fnServerData","fnFormatNumber","sServerMethod","aaSorting","aaSortingFixed","aLengthMenu","sPaginationType","sAjaxSource","sAjaxDataProp","iStateDuration","sDom","bSortCellsTop","iTabIndex","fnStateLoadCallback","fnStateSaveCallback","renderer","searchDelay","rowId",["iCookieDuration","iStateDuration"],["oSearch","oPreviousSearch"],["aoSearchCols","aoPreSearchCols"],["iDisplayLength","_iDisplayLength"]]),F(h.oScroll,r,[["sScrollX","sX"],["sScrollXInner","sXInner"],["sScrollY","sY"],["bScrollCollapse","bCollapse"]]),F(h.oLanguage,r,"fnInfoCallback"),L(h,"aoDrawCallback",r.fnDrawCallback,"user"),L(h,"aoServerParams",r.fnServerParams,"user"),L(h,"aoStateSaveParams",r.fnStateSaveParams,"user"),L(h,"aoStateLoadParams",r.fnStateLoadParams,"user"),L(h,"aoStateLoaded",r.fnStateLoaded,"user"),L(h,"aoRowCallback",r.fnRowCallback,"user"),L(h,"aoRowCreatedCallback",r.fnCreatedRow,"user"),L(h,"aoHeaderCallback",r.fnHeaderCallback,"user"),L(h,"aoFooterCallback",r.fnFooterCallback,"user"),L(h,"aoInitComplete",r.fnInitComplete,"user"),L(h,"aoPreDrawCallback",r.fnPreDrawCallback,"user"),h.rowIdFn=A(r.rowId),tt(h),h.oClasses),g=(P.extend(p,w.ext.classes,r.oClasses),l.addClass(p.sTable),h.iInitDisplayStart===H&&(h.iInitDisplayStart=r.iDisplayStart,h._iDisplayStart=r.iDisplayStart),null!==r.iDeferLoading&&(h.bDeferLoading=!0,t=Array.isArray(r.iDeferLoading),h._iRecordsDisplay=t?r.iDeferLoading[0]:r.iDeferLoading,h._iRecordsTotal=t?r.iDeferLoading[1]:r.iDeferLoading),h.oLanguage),t=(P.extend(!0,g,r.oLanguage),g.sUrl?(P.ajax({dataType:"json",url:g.sUrl,success:function(t){C(e.oLanguage,t),Z(t),P.extend(!0,g,t,h.oInit.oLanguage),R(h,null,"i18n",[h]),Jt(h)},error:function(){Jt(h)}}),i=!0):R(h,null,"i18n",[h]),null===r.asStripeClasses&&(h.asStripeClasses=[p.sStripeOdd,p.sStripeEven]),h.asStripeClasses),b=l.children("tbody").find("tr").eq(0),m=(-1!==P.inArray(!0,P.map(t,function(t,e){return b.hasClass(t)}))&&(P("tbody tr",this).removeClass(t.join(" ")),h.asDestroyStripes=t.slice()),[]),t=this.getElementsByTagName("thead");if(0!==t.length&&(wt(h.aoHeader,t[0]),m=Ct(h)),null===r.aoColumns)for(f=[],o=0,s=m.length;o<s;o++)f.push(null);else f=r.aoColumns;for(o=0,s=f.length;o<s;o++)nt(h,m?m[o]:null);st(h,r.aoColumnDefs,f,function(t,e){at(h,t,e)}),b.length&&(d=function(t,e){return null!==t.getAttribute("data-"+e)?e:null},P(b[0]).children("th, td").each(function(t,e){var n,a=h.aoColumns[t];a||W(h,0,"Incorrect column count",18),a.mData===t&&(n=d(e,"sort")||d(e,"order"),e=d(e,"filter")||d(e,"search"),null===n&&null===e||(a.mData={_:t+".display",sort:null!==n?t+".@data-"+n:H,type:null!==n?t+".@data-"+n:H,filter:null!==e?t+".@data-"+e:H},a._isArrayHost=!0,at(h,t)))}));var S=h.oFeatures,t=function(){if(r.aaSorting===H){var t=h.aaSorting;for(o=0,s=t.length;o<s;o++)t[o][1]=h.aoColumns[o].asSorting[0]}ce(h),S.bSort&&L(h,"aoDrawCallback",function(){var t,n;h.bSorted&&(t=I(h),n={},P.each(t,function(t,e){n[e.src]=e.dir}),R(h,null,"order",[h,t,n]),le(h))}),L(h,"aoDrawCallback",function(){(h.bSorted||"ssp"===E(h)||S.bDeferRender)&&ce(h)},"sc");var e=l.children("caption").each(function(){this._captionSide=P(this).css("caption-side")}),n=l.children("thead"),a=(0===n.length&&(n=P("<thead/>").appendTo(l)),h.nTHead=n[0],l.children("tbody")),n=(0===a.length&&(a=P("<tbody/>").insertAfter(n)),h.nTBody=a[0],l.children("tfoot"));if(0===(n=0===n.length&&0<e.length&&(""!==h.oScroll.sX||""!==h.oScroll.sY)?P("<tfoot/>").appendTo(l):n).length||0===n.children().length?l.addClass(p.sNoFooter):0<n.length&&(h.nTFoot=n[0],wt(h.aoFooter,h.nTFoot)),r.aaData)for(o=0;o<r.aaData.length;o++)x(h,r.aaData[o]);else!h.bDeferLoading&&"dom"!=E(h)||ut(h,P(h.nTBody).children("tr"));h.aiDisplay=h.aiDisplayMaster.slice(),!(h.bInitialised=!0)===i&&Jt(h)};L(h,"aoDrawCallback",de,"state_save"),r.bStateSave?(S.bStateSave=!0,he(h,0,t)):t()}}),y=null,this},c={},U=/[\r\n\u2028]/g,V=/<.*?>/g,X=/^\d{2,4}[\.\/\-]\d{1,2}[\.\/\-]\d{1,2}([T ]{1}\d{1,2}[:\.]\d{2}([\.:]\d{2})?)?$/,J=new RegExp("(\\"+["/",".","*","+","?","|","(",")","[","]","{","}","\\","$","^","-"].join("|\\")+")","g"),q=/['\u00A0,$£€¥%\u2009\u202F\u20BD\u20a9\u20BArfkɃΞ]/gi,h=function(t){return!t||!0===t||"-"===t},$=function(t,e){return c[e]||(c[e]=new RegExp(Ot(e),"g")),"string"==typeof t&&"."!==e?t.replace(/\./g,"").replace(c[e],"."):t},N=function(t,e,n){var a=[],r=0,o=t.length;if(n!==H)for(;r<o;r++)t[r]&&t[r][e]&&a.push(t[r][e][n]);else for(;r<o;r++)t[r]&&a.push(t[r][e]);return a},G=function(t){if(!(t.length<2))for(var e=t.slice().sort(),n=e[0],a=1,r=e.length;a<r;a++){if(e[a]===n)return!1;n=e[a]}return!0},z=function(t){if(G(t))return t.slice();var e,n,a,r=[],o=t.length,i=0;t:for(n=0;n<o;n++){for(e=t[n],a=0;a<i;a++)if(r[a]===e)continue t;r.push(e),i++}return r},Y=function(t,e){if(Array.isArray(e))for(var n=0;n<e.length;n++)Y(t,e[n]);else t.push(e);return t};function i(n){var a,r,o={};P.each(n,function(t,e){(a=t.match(/^([^A-Z]+?)([A-Z])/))&&-1!=="a aa ai ao as b fn i m o s ".indexOf(a[1]+" ")&&(r=t.replace(a[0],a[2].toLowerCase()),o[r]=t,"o"===a[1])&&i(n[t])}),n._hungarianMap=o}function C(n,a,r){var o;n._hungarianMap||i(n),P.each(a,function(t,e){(o=n._hungarianMap[t])===H||!r&&a[o]!==H||("o"===o.charAt(0)?(a[o]||(a[o]={}),P.extend(!0,a[o],a[t]),C(n[o],a[o],r)):a[o]=a[t])})}function Z(t){var e,n=w.defaults.oLanguage,a=n.sDecimal;a&&Me(a),t&&(e=t.sZeroRecords,!t.sEmptyTable&&e&&"No data available in table"===n.sEmptyTable&&F(t,t,"sZeroRecords","sEmptyTable"),!t.sLoadingRecords&&e&&"Loading..."===n.sLoadingRecords&&F(t,t,"sZeroRecords","sLoadingRecords"),t.sInfoThousands&&(t.sThousands=t.sInfoThousands),e=t.sDecimal)&&a!==e&&Me(e)}Array.isArray||(Array.isArray=function(t){return"[object Array]"===Object.prototype.toString.call(t)}),Array.prototype.includes||(Array.prototype.includes=s),String.prototype.trim||(String.prototype.trim=function(){return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,"")}),String.prototype.includes||(String.prototype.includes=s),w.util={throttle:function(a,t){var r,o,i=t!==H?t:200;return function(){var t=this,e=+new Date,n=arguments;r&&e<r+i?(clearTimeout(o),o=setTimeout(function(){r=H,a.apply(t,n)},i)):(r=e,a.apply(t,n))}},escapeRegex:function(t){return t.replace(J,"\\$1")},set:function(a){var d;return P.isPlainObject(a)?w.util.set(a._):null===a?function(){}:"function"==typeof a?function(t,e,n){a(t,"set",e,n)}:"string"!=typeof a||-1===a.indexOf(".")&&-1===a.indexOf("[")&&-1===a.indexOf("(")?function(t,e){t[a]=e}:(d=function(t,e,n){for(var a,r,o,i,l=dt(n),n=l[l.length-1],s=0,u=l.length-1;s<u;s++){if("__proto__"===l[s]||"constructor"===l[s])throw new Error("Cannot set prototype values");if(a=l[s].match(ft),r=l[s].match(g),a){if(l[s]=l[s].replace(ft,""),t[l[s]]=[],(a=l.slice()).splice(0,s+1),i=a.join("."),Array.isArray(e))for(var c=0,f=e.length;c<f;c++)d(o={},e[c],i),t[l[s]].push(o);else t[l[s]]=e;return}r&&(l[s]=l[s].replace(g,""),t=t[l[s]](e)),null!==t[l[s]]&&t[l[s]]!==H||(t[l[s]]={}),t=t[l[s]]}n.match(g)?t[n.replace(g,"")](e):t[n.replace(ft,"")]=e},function(t,e){return d(t,e,a)})},get:function(r){var o,d;return P.isPlainObject(r)?(o={},P.each(r,function(t,e){e&&(o[t]=w.util.get(e))}),function(t,e,n,a){var r=o[e]||o._;return r!==H?r(t,e,n,a):t}):null===r?function(t){return t}:"function"==typeof r?function(t,e,n,a){return r(t,e,n,a)}:"string"!=typeof r||-1===r.indexOf(".")&&-1===r.indexOf("[")&&-1===r.indexOf("(")?function(t,e){return t[r]}:(d=function(t,e,n){var a,r,o;if(""!==n)for(var i=dt(n),l=0,s=i.length;l<s;l++){if(f=i[l].match(ft),a=i[l].match(g),f){if(i[l]=i[l].replace(ft,""),""!==i[l]&&(t=t[i[l]]),r=[],i.splice(0,l+1),o=i.join("."),Array.isArray(t))for(var u=0,c=t.length;u<c;u++)r.push(d(t[u],e,o));var f=f[0].substring(1,f[0].length-1);t=""===f?r:r.join(f);break}if(a)i[l]=i[l].replace(g,""),t=t[i[l]]();else{if(null===t||null===t[i[l]])return null;if(t===H||t[i[l]]===H)return H;t=t[i[l]]}}return t},function(t,e){return d(t,e,r)})}};var r=function(t,e,n){t[e]!==H&&(t[n]=t[e])};function K(t){r(t,"ordering","bSort"),r(t,"orderMulti","bSortMulti"),r(t,"orderClasses","bSortClasses"),r(t,"orderCellsTop","bSortCellsTop"),r(t,"order","aaSorting"),r(t,"orderFixed","aaSortingFixed"),r(t,"paging","bPaginate"),r(t,"pagingType","sPaginationType"),r(t,"pageLength","iDisplayLength"),r(t,"searching","bFilter"),"boolean"==typeof t.sScrollX&&(t.sScrollX=t.sScrollX?"100%":""),"boolean"==typeof t.scrollX&&(t.scrollX=t.scrollX?"100%":"");var e=t.aoSearchCols;if(e)for(var n=0,a=e.length;n<a;n++)e[n]&&C(w.models.oSearch,e[n])}function Q(t){r(t,"orderable","bSortable"),r(t,"orderData","aDataSort"),r(t,"orderSequence","asSorting"),r(t,"orderDataType","sortDataType");var e=t.aDataSort;"number"!=typeof e||Array.isArray(e)||(t.aDataSort=[e])}function tt(t){var e,n,a,r;w.__browser||(w.__browser=e={},r=(a=(n=P("<div/>").css({position:"fixed",top:0,left:-1*P(j).scrollLeft(),height:1,width:1,overflow:"hidden"}).append(P("<div/>").css({position:"absolute",top:1,left:1,width:100,overflow:"scroll"}).append(P("<div/>").css({width:"100%",height:10}))).appendTo("body")).children()).children(),e.barWidth=a[0].offsetWidth-a[0].clientWidth,e.bScrollOversize=100===r[0].offsetWidth&&100!==a[0].clientWidth,e.bScrollbarLeft=1!==Math.round(r.offset().left),e.bBounding=!!n[0].getBoundingClientRect().width,n.remove()),P.extend(t.oBrowser,w.__browser),t.oScroll.iBarWidth=w.__browser.barWidth}function et(t,e,n,a,r,o){var i,l=a,s=!1;for(n!==H&&(i=n,s=!0);l!==r;)t.hasOwnProperty(l)&&(i=s?e(i,t[l],l,t):t[l],s=!0,l+=o);return i}function nt(t,e){var n=w.defaults.column,a=t.aoColumns.length,n=P.extend({},w.models.oColumn,n,{nTh:e||v.createElement("th"),sTitle:n.sTitle||(e?e.innerHTML:""),aDataSort:n.aDataSort||[a],mData:n.mData||a,idx:a}),n=(t.aoColumns.push(n),t.aoPreSearchCols);n[a]=P.extend({},w.models.oSearch,n[a]),at(t,a,P(e).data())}function at(t,e,n){function a(t){return"string"==typeof t&&-1!==t.indexOf("@")}var e=t.aoColumns[e],r=t.oClasses,o=P(e.nTh),i=(!e.sWidthOrig&&(e.sWidthOrig=o.attr("width")||null,u=(o.attr("style")||"").match(/width:\s*(\d+[pxem%]+)/))&&(e.sWidthOrig=u[1]),n!==H&&null!==n&&(Q(n),C(w.defaults.column,n,!0),n.mDataProp===H||n.mData||(n.mData=n.mDataProp),n.sType&&(e._sManualType=n.sType),n.className&&!n.sClass&&(n.sClass=n.className),n.sClass&&o.addClass(n.sClass),u=e.sClass,P.extend(e,n),F(e,n,"sWidth","sWidthOrig"),u!==e.sClass&&(e.sClass=u+" "+e.sClass),n.iDataSort!==H&&(e.aDataSort=[n.iDataSort]),F(e,n,"aDataSort"),e.ariaTitle||(e.ariaTitle=o.attr("aria-label"))),e.mData),l=A(i),s=e.mRender?A(e.mRender):null,u=(e._bAttrSrc=P.isPlainObject(i)&&(a(i.sort)||a(i.type)||a(i.filter)),e._setter=null,e.fnGetData=function(t,e,n){var a=l(t,e,H,n);return s&&e?s(a,e,t,n):a},e.fnSetData=function(t,e,n){return b(i)(t,e,n)},"number"==typeof i||e._isArrayHost||(t._rowReadObject=!0),t.oFeatures.bSort||(e.bSortable=!1,o.addClass(r.sSortableNone)),-1!==P.inArray("asc",e.asSorting)),n=-1!==P.inArray("desc",e.asSorting);e.bSortable&&(u||n)?u&&!n?(e.sSortingClass=r.sSortableAsc,e.sSortingClassJUI=r.sSortJUIAscAllowed):!u&&n?(e.sSortingClass=r.sSortableDesc,e.sSortingClassJUI=r.sSortJUIDescAllowed):(e.sSortingClass=r.sSortable,e.sSortingClassJUI=r.sSortJUI):(e.sSortingClass=r.sSortableNone,e.sSortingClassJUI="")}function O(t){if(!1!==t.oFeatures.bAutoWidth){var e=t.aoColumns;ee(t);for(var n=0,a=e.length;n<a;n++)e[n].nTh.style.width=e[n].sWidth}var r=t.oScroll;""===r.sY&&""===r.sX||Qt(t),R(t,null,"column-sizing",[t])}function rt(t,e){t=it(t,"bVisible");return"number"==typeof t[e]?t[e]:null}function ot(t,e){t=it(t,"bVisible"),e=P.inArray(e,t);return-1!==e?e:null}function T(t){var n=0;return P.each(t.aoColumns,function(t,e){e.bVisible&&"none"!==P(e.nTh).css("display")&&n++}),n}function it(t,n){var a=[];return P.map(t.aoColumns,function(t,e){t[n]&&a.push(e)}),a}function lt(t){for(var e,n,a,r,o,i,l,s=t.aoColumns,u=t.aoData,c=w.ext.type.detect,f=0,d=s.length;f<d;f++)if(l=[],!(o=s[f]).sType&&o._sManualType)o.sType=o._sManualType;else if(!o.sType){for(e=0,n=c.length;e<n;e++){for(a=0,r=u.length;a<r&&(l[a]===H&&(l[a]=S(t,a,f,"type")),(i=c[e](l[a],t))||e===c.length-1)&&("html"!==i||h(l[a]));a++);if(i){o.sType=i;break}}o.sType||(o.sType="string")}}function st(t,e,n,a){var r,o,i,l,s=t.aoColumns;if(e)for(r=e.length-1;0<=r;r--)for(var u,c=(u=e[r]).target!==H?u.target:u.targets!==H?u.targets:u.aTargets,f=0,d=(c=Array.isArray(c)?c:[c]).length;f<d;f++)if("number"==typeof c[f]&&0<=c[f]){for(;s.length<=c[f];)nt(t);a(c[f],u)}else if("number"==typeof c[f]&&c[f]<0)a(s.length+c[f],u);else if("string"==typeof c[f])for(i=0,l=s.length;i<l;i++)"_all"!=c[f]&&!P(s[i].nTh).hasClass(c[f])||a(i,u);if(n)for(r=0,o=n.length;r<o;r++)a(r,n[r])}function x(t,e,n,a){for(var r=t.aoData.length,o=P.extend(!0,{},w.models.oRow,{src:n?"dom":"data",idx:r}),i=(o._aData=e,t.aoData.push(o),t.aoColumns),l=0,s=i.length;l<s;l++)i[l].sType=null;t.aiDisplayMaster.push(r);e=t.rowIdFn(e);return e!==H&&(t.aIds[e]=o),!n&&t.oFeatures.bDeferRender||St(t,r,n,a),r}function ut(n,t){var a;return(t=t instanceof P?t:P(t)).map(function(t,e){return a=mt(n,e),x(n,a.data,e,a.cells)})}function S(t,e,n,a){"search"===a?a="filter":"order"===a&&(a="sort");var r=t.iDraw,o=t.aoColumns[n],i=t.aoData[e]._aData,l=o.sDefaultContent,s=o.fnGetData(i,a,{settings:t,row:e,col:n});if(s===H)return t.iDrawError!=r&&null===l&&(W(t,0,"Requested unknown parameter "+("function"==typeof o.mData?"{function}":"'"+o.mData+"'")+" for row "+e+", column "+n,4),t.iDrawError=r),l;if(s!==i&&null!==s||null===l||a===H){if("function"==typeof s)return s.call(i)}else s=l;return null===s&&"display"===a?"":"filter"===a&&(e=w.ext.type.search)[o.sType]?e[o.sType](s):s}function ct(t,e,n,a){var r=t.aoColumns[n],o=t.aoData[e]._aData;r.fnSetData(o,a,{settings:t,row:e,col:n})}var ft=/\[.*?\]$/,g=/\(\)$/;function dt(t){return P.map(t.match(/(\\.|[^\.])+/g)||[""],function(t){return t.replace(/\\\./g,".")})}var A=w.util.get,b=w.util.set;function ht(t){return N(t.aoData,"_aData")}function pt(t){t.aoData.length=0,t.aiDisplayMaster.length=0,t.aiDisplay.length=0,t.aIds={}}function gt(t,e,n){for(var a=-1,r=0,o=t.length;r<o;r++)t[r]==e?a=r:t[r]>e&&t[r]--;-1!=a&&n===H&&t.splice(a,1)}function bt(n,a,t,e){function r(t,e){for(;t.childNodes.length;)t.removeChild(t.firstChild);t.innerHTML=S(n,a,e,"display")}var o,i,l=n.aoData[a];if("dom"!==t&&(t&&"auto"!==t||"dom"!==l.src)){var s=l.anCells;if(s)if(e!==H)r(s[e],e);else for(o=0,i=s.length;o<i;o++)r(s[o],o)}else l._aData=mt(n,l,e,e===H?H:l._aData).data;l._aSortData=null,l._aFilterData=null;var u=n.aoColumns;if(e!==H)u[e].sType=null;else{for(o=0,i=u.length;o<i;o++)u[o].sType=null;vt(n,l)}}function mt(t,e,n,a){function r(t,e){var n;"string"==typeof t&&-1!==(n=t.indexOf("@"))&&(n=t.substring(n+1),b(t)(a,e.getAttribute(n)))}function o(t){n!==H&&n!==f||(l=d[f],s=t.innerHTML.trim(),l&&l._bAttrSrc?(b(l.mData._)(a,s),r(l.mData.sort,t),r(l.mData.type,t),r(l.mData.filter,t)):h?(l._setter||(l._setter=b(l.mData)),l._setter(a,s)):a[f]=s),f++}var i,l,s,u=[],c=e.firstChild,f=0,d=t.aoColumns,h=t._rowReadObject;a=a!==H?a:h?{}:[];if(c)for(;c;)"TD"!=(i=c.nodeName.toUpperCase())&&"TH"!=i||(o(c),u.push(c)),c=c.nextSibling;else for(var p=0,g=(u=e.anCells).length;p<g;p++)o(u[p]);var e=e.firstChild?e:e.nTr;return e&&(e=e.getAttribute("id"))&&b(t.rowId)(a,e),{data:a,cells:u}}function St(t,e,n,a){var r,o,i,l,s,u,c=t.aoData[e],f=c._aData,d=[];if(null===c.nTr){for(r=n||v.createElement("tr"),c.nTr=r,c.anCells=d,r._DT_RowIndex=e,vt(t,c),l=0,s=t.aoColumns.length;l<s;l++)i=t.aoColumns[l],(o=(u=!n)?v.createElement(i.sCellType):a[l])||W(t,0,"Incorrect column count",18),o._DT_CellIndex={row:e,column:l},d.push(o),!u&&(!i.mRender&&i.mData===l||P.isPlainObject(i.mData)&&i.mData._===l+".display")||(o.innerHTML=S(t,e,l,"display")),i.sClass&&(o.className+=" "+i.sClass),i.bVisible&&!n?r.appendChild(o):!i.bVisible&&n&&o.parentNode.removeChild(o),i.fnCreatedCell&&i.fnCreatedCell.call(t.oInstance,o,S(t,e,l),f,e,l);R(t,"aoRowCreatedCallback",null,[r,f,e,d])}}function vt(t,e){var n=e.nTr,a=e._aData;n&&((t=t.rowIdFn(a))&&(n.id=t),a.DT_RowClass&&(t=a.DT_RowClass.split(" "),e.__rowc=e.__rowc?z(e.__rowc.concat(t)):t,P(n).removeClass(e.__rowc.join(" ")).addClass(a.DT_RowClass)),a.DT_RowAttr&&P(n).attr(a.DT_RowAttr),a.DT_RowData)&&P(n).data(a.DT_RowData)}function yt(t){var e,n,a,r=t.nTHead,o=t.nTFoot,i=0===P("th, td",r).length,l=t.oClasses,s=t.aoColumns;for(i&&(n=P("<tr/>").appendTo(r)),c=0,f=s.length;c<f;c++)a=s[c],e=P(a.nTh).addClass(a.sClass),i&&e.appendTo(n),t.oFeatures.bSort&&(e.addClass(a.sSortingClass),!1!==a.bSortable)&&(e.attr("tabindex",t.iTabIndex).attr("aria-controls",t.sTableId),ue(t,a.nTh,c)),a.sTitle!=e[0].innerHTML&&e.html(a.sTitle),ve(t,"header")(t,e,a,l);if(i&&wt(t.aoHeader,r),P(r).children("tr").children("th, td").addClass(l.sHeaderTH),P(o).children("tr").children("th, td").addClass(l.sFooterTH),null!==o)for(var u=t.aoFooter[0],c=0,f=u.length;c<f;c++)(a=s[c])?(a.nTf=u[c].cell,a.sClass&&P(a.nTf).addClass(a.sClass)):W(t,0,"Incorrect column count",18)}function Dt(t,e,n){var a,r,o,i,l,s,u,c,f,d=[],h=[],p=t.aoColumns.length;if(e){for(n===H&&(n=!1),a=0,r=e.length;a<r;a++){for(d[a]=e[a].slice(),d[a].nTr=e[a].nTr,o=p-1;0<=o;o--)t.aoColumns[o].bVisible||n||d[a].splice(o,1);h.push([])}for(a=0,r=d.length;a<r;a++){if(u=d[a].nTr)for(;s=u.firstChild;)u.removeChild(s);for(o=0,i=d[a].length;o<i;o++)if(f=c=1,h[a][o]===H){for(u.appendChild(d[a][o].cell),h[a][o]=1;d[a+c]!==H&&d[a][o].cell==d[a+c][o].cell;)h[a+c][o]=1,c++;for(;d[a][o+f]!==H&&d[a][o].cell==d[a][o+f].cell;){for(l=0;l<c;l++)h[a+l][o+f]=1;f++}P(d[a][o].cell).attr("rowspan",c).attr("colspan",f)}}}}function y(t,e){n="ssp"==E(s=t),(l=s.iInitDisplayStart)!==H&&-1!==l&&(s._iDisplayStart=!n&&l>=s.fnRecordsDisplay()?0:l,s.iInitDisplayStart=-1);var n=R(t,"aoPreDrawCallback","preDraw",[t]);if(-1!==P.inArray(!1,n))D(t,!1);else{var a=[],r=0,o=t.asStripeClasses,i=o.length,l=t.oLanguage,s="ssp"==E(t),u=t.aiDisplay,n=t._iDisplayStart,c=t.fnDisplayEnd();if(t.bDrawing=!0,t.bDeferLoading)t.bDeferLoading=!1,t.iDraw++,D(t,!1);else if(s){if(!t.bDestroying&&!e)return void xt(t)}else t.iDraw++;if(0!==u.length)for(var f=s?t.aoData.length:c,d=s?0:n;d<f;d++){var h,p=u[d],g=t.aoData[p],b=(null===g.nTr&&St(t,p),g.nTr);0!==i&&(h=o[r%i],g._sRowStripe!=h)&&(P(b).removeClass(g._sRowStripe).addClass(h),g._sRowStripe=h),R(t,"aoRowCallback",null,[b,g._aData,r,d,p]),a.push(b),r++}else{e=l.sZeroRecords;1==t.iDraw&&"ajax"==E(t)?e=l.sLoadingRecords:l.sEmptyTable&&0===t.fnRecordsTotal()&&(e=l.sEmptyTable),a[0]=P("<tr/>",{class:i?o[0]:""}).append(P("<td />",{valign:"top",colSpan:T(t),class:t.oClasses.sRowEmpty}).html(e))[0]}R(t,"aoHeaderCallback","header",[P(t.nTHead).children("tr")[0],ht(t),n,c,u]),R(t,"aoFooterCallback","footer",[P(t.nTFoot).children("tr")[0],ht(t),n,c,u]);s=P(t.nTBody);s.children().detach(),s.append(P(a)),R(t,"aoDrawCallback","draw",[t]),t.bSorted=!1,t.bFiltered=!1,t.bDrawing=!1}}function u(t,e){var n=t.oFeatures,a=n.bSort,n=n.bFilter;a&&ie(t),n?Rt(t,t.oPreviousSearch):t.aiDisplay=t.aiDisplayMaster.slice(),!0!==e&&(t._iDisplayStart=0),t._drawHold=e,y(t),t._drawHold=!1}function _t(t){for(var e,n,a,r,o,i,l,s=t.oClasses,u=P(t.nTable),u=P("<div/>").insertBefore(u),c=t.oFeatures,f=P("<div/>",{id:t.sTableId+"_wrapper",class:s.sWrapper+(t.nTFoot?"":" "+s.sNoFooter)}),d=(t.nHolding=u[0],t.nTableWrapper=f[0],t.nTableReinsertBefore=t.nTable.nextSibling,t.sDom.split("")),h=0;h<d.length;h++){if(e=null,"<"==(n=d[h])){if(a=P("<div/>")[0],"'"==(r=d[h+1])||'"'==r){for(o="",i=2;d[h+i]!=r;)o+=d[h+i],i++;"H"==o?o=s.sJUIHeader:"F"==o&&(o=s.sJUIFooter),-1!=o.indexOf(".")?(l=o.split("."),a.id=l[0].substr(1,l[0].length-1),a.className=l[1]):"#"==o.charAt(0)?a.id=o.substr(1,o.length-1):a.className=o,h+=i}f.append(a),f=P(a)}else if(">"==n)f=f.parent();else if("l"==n&&c.bPaginate&&c.bLengthChange)e=Gt(t);else if("f"==n&&c.bFilter)e=Lt(t);else if("r"==n&&c.bProcessing)e=Zt(t);else if("t"==n)e=Kt(t);else if("i"==n&&c.bInfo)e=Ut(t);else if("p"==n&&c.bPaginate)e=zt(t);else if(0!==w.ext.feature.length)for(var p=w.ext.feature,g=0,b=p.length;g<b;g++)if(n==p[g].cFeature){e=p[g].fnInit(t);break}e&&((l=t.aanFeatures)[n]||(l[n]=[]),l[n].push(e),f.append(e))}u.replaceWith(f),t.nHolding=null}function wt(t,e){var n,a,r,o,i,l,s,u,c,f,d=P(e).children("tr");for(t.splice(0,t.length),r=0,l=d.length;r<l;r++)t.push([]);for(r=0,l=d.length;r<l;r++)for(a=(n=d[r]).firstChild;a;){if("TD"==a.nodeName.toUpperCase()||"TH"==a.nodeName.toUpperCase())for(u=(u=+a.getAttribute("colspan"))&&0!=u&&1!=u?u:1,c=(c=+a.getAttribute("rowspan"))&&0!=c&&1!=c?c:1,s=function(t,e,n){for(var a=t[e];a[n];)n++;return n}(t,r,0),f=1==u,i=0;i<u;i++)for(o=0;o<c;o++)t[r+o][s+i]={cell:a,unique:f},t[r+o].nTr=n;a=a.nextSibling}}function Ct(t,e,n){var a=[];n||(n=t.aoHeader,e&&wt(n=[],e));for(var r=0,o=n.length;r<o;r++)for(var i=0,l=n[r].length;i<l;i++)!n[r][i].unique||a[i]&&t.bSortCellsTop||(a[i]=n[r][i].cell);return a}function Tt(r,t,n){function e(t){var e=r.jqXHR?r.jqXHR.status:null;(null===t||"number"==typeof e&&204==e)&&Ft(r,t={},[]),(e=t.error||t.sError)&&W(r,0,e),r.json=t,R(r,null,"xhr",[r,t,r.jqXHR]),n(t)}R(r,"aoServerParams","serverParams",[t]),t&&Array.isArray(t)&&(a={},o=/(.*?)\[\]$/,P.each(t,function(t,e){var n=e.name.match(o);n?(n=n[0],a[n]||(a[n]=[]),a[n].push(e.value)):a[e.name]=e.value}),t=a);var a,o,i,l=r.ajax,s=r.oInstance,u=(P.isPlainObject(l)&&l.data&&(u="function"==typeof(i=l.data)?i(t,r):i,t="function"==typeof i&&u?u:P.extend(!0,t,u),delete l.data),{data:t,success:e,dataType:"json",cache:!1,type:r.sServerMethod,error:function(t,e,n){var a=R(r,null,"xhr",[r,null,r.jqXHR]);-1===P.inArray(!0,a)&&("parsererror"==e?W(r,0,"Invalid JSON response",1):4===t.readyState&&W(r,0,"Ajax error",7)),D(r,!1)}});r.oAjaxData=t,R(r,null,"preXhr",[r,t]),r.fnServerData?r.fnServerData.call(s,r.sAjaxSource,P.map(t,function(t,e){return{name:e,value:t}}),e,r):r.sAjaxSource||"string"==typeof l?r.jqXHR=P.ajax(P.extend(u,{url:l||r.sAjaxSource})):"function"==typeof l?r.jqXHR=l.call(s,t,e,r):(r.jqXHR=P.ajax(P.extend(u,l)),l.data=i)}function xt(e){e.iDraw++,D(e,!0);var n=e._drawHold;Tt(e,At(e),function(t){e._drawHold=n,It(e,t),e._drawHold=!1})}function At(t){for(var e,n,a,r=t.aoColumns,o=r.length,i=t.oFeatures,l=t.oPreviousSearch,s=t.aoPreSearchCols,u=[],c=I(t),f=t._iDisplayStart,d=!1!==i.bPaginate?t._iDisplayLength:-1,h=function(t,e){u.push({name:t,value:e})},p=(h("sEcho",t.iDraw),h("iColumns",o),h("sColumns",N(r,"sName").join(",")),h("iDisplayStart",f),h("iDisplayLength",d),{draw:t.iDraw,columns:[],order:[],start:f,length:d,search:{value:l.sSearch,regex:l.bRegex}}),g=0;g<o;g++)n=r[g],a=s[g],e="function"==typeof n.mData?"function":n.mData,p.columns.push({data:e,name:n.sName,searchable:n.bSearchable,orderable:n.bSortable,search:{value:a.sSearch,regex:a.bRegex}}),h("mDataProp_"+g,e),i.bFilter&&(h("sSearch_"+g,a.sSearch),h("bRegex_"+g,a.bRegex),h("bSearchable_"+g,n.bSearchable)),i.bSort&&h("bSortable_"+g,n.bSortable);i.bFilter&&(h("sSearch",l.sSearch),h("bRegex",l.bRegex)),i.bSort&&(P.each(c,function(t,e){p.order.push({column:e.col,dir:e.dir}),h("iSortCol_"+t,e.col),h("sSortDir_"+t,e.dir)}),h("iSortingCols",c.length));f=w.ext.legacy.ajax;return null===f?t.sAjaxSource?u:p:f?u:p}function It(t,n){function e(t,e){return n[t]!==H?n[t]:n[e]}var a=Ft(t,n),r=e("sEcho","draw"),o=e("iTotalRecords","recordsTotal"),i=e("iTotalDisplayRecords","recordsFiltered");if(r!==H){if(+r<t.iDraw)return;t.iDraw=+r}a=a||[],pt(t),t._iRecordsTotal=parseInt(o,10),t._iRecordsDisplay=parseInt(i,10);for(var l=0,s=a.length;l<s;l++)x(t,a[l]);t.aiDisplay=t.aiDisplayMaster.slice(),y(t,!0),t._bInitComplete||qt(t,n),D(t,!1)}function Ft(t,e,n){t=P.isPlainObject(t.ajax)&&t.ajax.dataSrc!==H?t.ajax.dataSrc:t.sAjaxDataProp;if(!n)return"data"===t?e.aaData||e[t]:""!==t?A(t)(e):e;b(t)(e,n)}function Lt(n){function e(t){i.f;var e=this.value||"";o.return&&"Enter"!==t.key||e!=o.sSearch&&(Rt(n,{sSearch:e,bRegex:o.bRegex,bSmart:o.bSmart,bCaseInsensitive:o.bCaseInsensitive,return:o.return}),n._iDisplayStart=0,y(n))}var t=n.oClasses,a=n.sTableId,r=n.oLanguage,o=n.oPreviousSearch,i=n.aanFeatures,l='<input type="search" class="'+t.sFilterInput+'"/>',s=(s=r.sSearch).match(/_INPUT_/)?s.replace("_INPUT_",l):s+l,l=P("<div/>",{id:i.f?null:a+"_filter",class:t.sFilter}).append(P("<label/>").append(s)),t=null!==n.searchDelay?n.searchDelay:"ssp"===E(n)?400:0,u=P("input",l).val(o.sSearch).attr("placeholder",r.sSearchPlaceholder).on("keyup.DT search.DT input.DT paste.DT cut.DT",t?ne(e,t):e).on("mouseup.DT",function(t){setTimeout(function(){e.call(u[0],t)},10)}).on("keypress.DT",function(t){if(13==t.keyCode)return!1}).attr("aria-controls",a);return P(n.nTable).on("search.dt.DT",function(t,e){if(n===e)try{u[0]!==v.activeElement&&u.val(o.sSearch)}catch(t){}}),l[0]}function Rt(t,e,n){function a(t){o.sSearch=t.sSearch,o.bRegex=t.bRegex,o.bSmart=t.bSmart,o.bCaseInsensitive=t.bCaseInsensitive,o.return=t.return}function r(t){return t.bEscapeRegex!==H?!t.bEscapeRegex:t.bRegex}var o=t.oPreviousSearch,i=t.aoPreSearchCols;if(lt(t),"ssp"!=E(t)){Ht(t,e.sSearch,n,r(e),e.bSmart,e.bCaseInsensitive),a(e);for(var l=0;l<i.length;l++)jt(t,i[l].sSearch,l,r(i[l]),i[l].bSmart,i[l].bCaseInsensitive);Pt(t)}else a(e);t.bFiltered=!0,R(t,null,"search",[t])}function Pt(t){for(var e,n,a=w.ext.search,r=t.aiDisplay,o=0,i=a.length;o<i;o++){for(var l=[],s=0,u=r.length;s<u;s++)n=r[s],e=t.aoData[n],a[o](t,e._aFilterData,n,e._aData,s)&&l.push(n);r.length=0,P.merge(r,l)}}function jt(t,e,n,a,r,o){if(""!==e){for(var i,l=[],s=t.aiDisplay,u=Nt(e,a,r,o),c=0;c<s.length;c++)i=t.aoData[s[c]]._aFilterData[n],u.test(i)&&l.push(s[c]);t.aiDisplay=l}}function Ht(t,e,n,a,r,o){var i,l,s,u=Nt(e,a,r,o),r=t.oPreviousSearch.sSearch,o=t.aiDisplayMaster,c=[];if(0!==w.ext.search.length&&(n=!0),l=Wt(t),e.length<=0)t.aiDisplay=o.slice();else{for((l||n||a||r.length>e.length||0!==e.indexOf(r)||t.bSorted)&&(t.aiDisplay=o.slice()),i=t.aiDisplay,s=0;s<i.length;s++)u.test(t.aoData[i[s]]._sFilterRow)&&c.push(i[s]);t.aiDisplay=c}}function Nt(t,e,n,a){return t=e?t:Ot(t),n&&(t="^(?=.*?"+P.map(t.match(/["\u201C][^"\u201D]+["\u201D]|[^ ]+/g)||[""],function(t){var e;return'"'===t.charAt(0)?t=(e=t.match(/^"(.*)"$/))?e[1]:t:"“"===t.charAt(0)&&(t=(e=t.match(/^\u201C(.*)\u201D$/))?e[1]:t),t.replace('"',"")}).join(")(?=.*?")+").*$"),new RegExp(t,a?"i":"")}var Ot=w.util.escapeRegex,kt=P("<div>")[0],Mt=kt.textContent!==H;function Wt(t){for(var e,n,a,r,o,i=t.aoColumns,l=!1,s=0,u=t.aoData.length;s<u;s++)if(!(o=t.aoData[s])._aFilterData){for(a=[],e=0,n=i.length;e<n;e++)i[e].bSearchable?"string"!=typeof(r=null===(r=S(t,s,e,"filter"))?"":r)&&r.toString&&(r=r.toString()):r="",r.indexOf&&-1!==r.indexOf("&")&&(kt.innerHTML=r,r=Mt?kt.textContent:kt.innerText),r.replace&&(r=r.replace(/[\r\n\u2028]/g,"")),a.push(r);o._aFilterData=a,o._sFilterRow=a.join("  "),l=!0}return l}function Et(t){return{search:t.sSearch,smart:t.bSmart,regex:t.bRegex,caseInsensitive:t.bCaseInsensitive}}function Bt(t){return{sSearch:t.search,bSmart:t.smart,bRegex:t.regex,bCaseInsensitive:t.caseInsensitive}}function Ut(t){var e=t.sTableId,n=t.aanFeatures.i,a=P("<div/>",{class:t.oClasses.sInfo,id:n?null:e+"_info"});return n||(t.aoDrawCallback.push({fn:Vt,sName:"information"}),a.attr("role","status").attr("aria-live","polite"),P(t.nTable).attr("aria-describedby",e+"_info")),a[0]}function Vt(t){var e,n,a,r,o,i,l=t.aanFeatures.i;0!==l.length&&(i=t.oLanguage,e=t._iDisplayStart+1,n=t.fnDisplayEnd(),a=t.fnRecordsTotal(),o=(r=t.fnRecordsDisplay())?i.sInfo:i.sInfoEmpty,r!==a&&(o+=" "+i.sInfoFiltered),o=Xt(t,o+=i.sInfoPostFix),null!==(i=i.fnInfoCallback)&&(o=i.call(t.oInstance,t,e,n,a,r,o)),P(l).html(o))}function Xt(t,e){var n=t.fnFormatNumber,a=t._iDisplayStart+1,r=t._iDisplayLength,o=t.fnRecordsDisplay(),i=-1===r;return e.replace(/_START_/g,n.call(t,a)).replace(/_END_/g,n.call(t,t.fnDisplayEnd())).replace(/_MAX_/g,n.call(t,t.fnRecordsTotal())).replace(/_TOTAL_/g,n.call(t,o)).replace(/_PAGE_/g,n.call(t,i?1:Math.ceil(a/r))).replace(/_PAGES_/g,n.call(t,i?1:Math.ceil(o/r)))}function Jt(n){var a,t,e,r=n.iInitDisplayStart,o=n.aoColumns,i=n.oFeatures,l=n.bDeferLoading;if(n.bInitialised){for(_t(n),yt(n),Dt(n,n.aoHeader),Dt(n,n.aoFooter),D(n,!0),i.bAutoWidth&&ee(n),a=0,t=o.length;a<t;a++)(e=o[a]).sWidth&&(e.nTh.style.width=M(e.sWidth));R(n,null,"preInit",[n]),u(n);i=E(n);"ssp"==i&&!l||("ajax"==i?Tt(n,[],function(t){var e=Ft(n,t);for(a=0;a<e.length;a++)x(n,e[a]);n.iInitDisplayStart=r,u(n),D(n,!1),qt(n,t)}):(D(n,!1),qt(n)))}else setTimeout(function(){Jt(n)},200)}function qt(t,e){t._bInitComplete=!0,(e||t.oInit.aaData)&&O(t),R(t,null,"plugin-init",[t,e]),R(t,"aoInitComplete","init",[t,e])}function $t(t,e){e=parseInt(e,10);t._iDisplayLength=e,Se(t),R(t,null,"length",[t,e])}function Gt(a){for(var t=a.oClasses,e=a.sTableId,n=a.aLengthMenu,r=Array.isArray(n[0]),o=r?n[0]:n,i=r?n[1]:n,l=P("<select/>",{name:e+"_length","aria-controls":e,class:t.sLengthSelect}),s=0,u=o.length;s<u;s++)l[0][s]=new Option("number"==typeof i[s]?a.fnFormatNumber(i[s]):i[s],o[s]);var c=P("<div><label/></div>").addClass(t.sLength);return a.aanFeatures.l||(c[0].id=e+"_length"),c.children().append(a.oLanguage.sLengthMenu.replace("_MENU_",l[0].outerHTML)),P("select",c).val(a._iDisplayLength).on("change.DT",function(t){$t(a,P(this).val()),y(a)}),P(a.nTable).on("length.dt.DT",function(t,e,n){a===e&&P("select",c).val(n)}),c[0]}function zt(t){function c(t){y(t)}var e=t.sPaginationType,f=w.ext.pager[e],d="function"==typeof f,e=P("<div/>").addClass(t.oClasses.sPaging+e)[0],h=t.aanFeatures;return d||f.fnInit(t,e,c),h.p||(e.id=t.sTableId+"_paginate",t.aoDrawCallback.push({fn:function(t){if(d)for(var e=t._iDisplayStart,n=t._iDisplayLength,a=t.fnRecordsDisplay(),r=-1===n,o=r?0:Math.ceil(e/n),i=r?1:Math.ceil(a/n),l=f(o,i),s=0,u=h.p.length;s<u;s++)ve(t,"pageButton")(t,h.p[s],s,l,o,i);else f.fnUpdate(t,c)},sName:"pagination"})),e}function Yt(t,e,n){var a=t._iDisplayStart,r=t._iDisplayLength,o=t.fnRecordsDisplay(),o=(0===o||-1===r?a=0:"number"==typeof e?o<(a=e*r)&&(a=0):"first"==e?a=0:"previous"==e?(a=0<=r?a-r:0)<0&&(a=0):"next"==e?a+r<o&&(a+=r):"last"==e?a=Math.floor((o-1)/r)*r:W(t,0,"Unknown paging action: "+e,5),t._iDisplayStart!==a);return t._iDisplayStart=a,o?(R(t,null,"page",[t]),n&&y(t)):R(t,null,"page-nc",[t]),o}function Zt(t){return P("<div/>",{id:t.aanFeatures.r?null:t.sTableId+"_processing",class:t.oClasses.sProcessing,role:"status"}).html(t.oLanguage.sProcessing).append("<div><div></div><div></div><div></div><div></div></div>").insertBefore(t.nTable)[0]}function D(t,e){t.oFeatures.bProcessing&&P(t.aanFeatures.r).css("display",e?"block":"none"),R(t,null,"processing",[t,e])}function Kt(t){var e,n,a,r,o,i,l,s,u,c,f,d,h=P(t.nTable),p=t.oScroll;return""===p.sX&&""===p.sY?t.nTable:(e=p.sX,n=p.sY,a=t.oClasses,o=(r=h.children("caption")).length?r[0]._captionSide:null,s=P(h[0].cloneNode(!1)),i=P(h[0].cloneNode(!1)),u=function(t){return t?M(t):null},(l=h.children("tfoot")).length||(l=null),s=P(f="<div/>",{class:a.sScrollWrapper}).append(P(f,{class:a.sScrollHead}).css({overflow:"hidden",position:"relative",border:0,width:e?u(e):"100%"}).append(P(f,{class:a.sScrollHeadInner}).css({"box-sizing":"content-box",width:p.sXInner||"100%"}).append(s.removeAttr("id").css("margin-left",0).append("top"===o?r:null).append(h.children("thead"))))).append(P(f,{class:a.sScrollBody}).css({position:"relative",overflow:"auto",width:u(e)}).append(h)),l&&s.append(P(f,{class:a.sScrollFoot}).css({overflow:"hidden",border:0,width:e?u(e):"100%"}).append(P(f,{class:a.sScrollFootInner}).append(i.removeAttr("id").css("margin-left",0).append("bottom"===o?r:null).append(h.children("tfoot"))))),u=s.children(),c=u[0],f=u[1],d=l?u[2]:null,e&&P(f).on("scroll.DT",function(t){var e=this.scrollLeft;c.scrollLeft=e,l&&(d.scrollLeft=e)}),P(f).css("max-height",n),p.bCollapse||P(f).css("height",n),t.nScrollHead=c,t.nScrollBody=f,t.nScrollFoot=d,t.aoDrawCallback.push({fn:Qt,sName:"scrolling"}),s[0])}function Qt(n){function t(t){(t=t.style).paddingTop="0",t.paddingBottom="0",t.borderTopWidth="0",t.borderBottomWidth="0",t.height=0}var e,a,r,o,i,l=n.oScroll,s=l.sX,u=l.sXInner,c=l.sY,l=l.iBarWidth,f=P(n.nScrollHead),d=f[0].style,h=f.children("div"),p=h[0].style,h=h.children("table"),g=n.nScrollBody,b=P(g),m=g.style,S=P(n.nScrollFoot).children("div"),v=S.children("table"),y=P(n.nTHead),D=P(n.nTable),_=D[0],w=_.style,C=n.nTFoot?P(n.nTFoot):null,T=n.oBrowser,x=T.bScrollOversize,A=(N(n.aoColumns,"nTh"),[]),I=[],F=[],L=[],R=g.scrollHeight>g.clientHeight;n.scrollBarVis!==R&&n.scrollBarVis!==H?(n.scrollBarVis=R,O(n)):(n.scrollBarVis=R,D.children("thead, tfoot").remove(),C&&(R=C.clone().prependTo(D),i=C.find("tr"),a=R.find("tr"),R.find("[id]").removeAttr("id")),R=y.clone().prependTo(D),y=y.find("tr"),e=R.find("tr"),R.find("th, td").removeAttr("tabindex"),R.find("[id]").removeAttr("id"),s||(m.width="100%",f[0].style.width="100%"),P.each(Ct(n,R),function(t,e){r=rt(n,t),e.style.width=n.aoColumns[r].sWidth}),C&&k(function(t){t.style.width=""},a),f=D.outerWidth(),""===s?(w.width="100%",x&&(D.find("tbody").height()>g.offsetHeight||"scroll"==b.css("overflow-y"))&&(w.width=M(D.outerWidth()-l)),f=D.outerWidth()):""!==u&&(w.width=M(u),f=D.outerWidth()),k(t,e),k(function(t){var e=j.getComputedStyle?j.getComputedStyle(t).width:M(P(t).width());F.push(t.innerHTML),A.push(e)},e),k(function(t,e){t.style.width=A[e]},y),P(e).css("height",0),C&&(k(t,a),k(function(t){L.push(t.innerHTML),I.push(M(P(t).css("width")))},a),k(function(t,e){t.style.width=I[e]},i),P(a).height(0)),k(function(t,e){t.innerHTML='<div class="dataTables_sizing">'+F[e]+"</div>",t.childNodes[0].style.height="0",t.childNodes[0].style.overflow="hidden",t.style.width=A[e]},e),C&&k(function(t,e){t.innerHTML='<div class="dataTables_sizing">'+L[e]+"</div>",t.childNodes[0].style.height="0",t.childNodes[0].style.overflow="hidden",t.style.width=I[e]},a),Math.round(D.outerWidth())<Math.round(f)?(o=g.scrollHeight>g.offsetHeight||"scroll"==b.css("overflow-y")?f+l:f,x&&(g.scrollHeight>g.offsetHeight||"scroll"==b.css("overflow-y"))&&(w.width=M(o-l)),""!==s&&""===u||W(n,1,"Possible column misalignment",6)):o="100%",m.width=M(o),d.width=M(o),C&&(n.nScrollFoot.style.width=M(o)),c||x&&(m.height=M(_.offsetHeight+l)),R=D.outerWidth(),h[0].style.width=M(R),p.width=M(R),y=D.height()>g.clientHeight||"scroll"==b.css("overflow-y"),p[i="padding"+(T.bScrollbarLeft?"Left":"Right")]=y?l+"px":"0px",C&&(v[0].style.width=M(R),S[0].style.width=M(R),S[0].style[i]=y?l+"px":"0px"),D.children("colgroup").insertBefore(D.children("thead")),b.trigger("scroll"),!n.bSorted&&!n.bFiltered||n._drawHold||(g.scrollTop=0))}function k(t,e,n){for(var a,r,o=0,i=0,l=e.length;i<l;){for(a=e[i].firstChild,r=n?n[i].firstChild:null;a;)1===a.nodeType&&(n?t(a,r,o):t(a,o),o++),a=a.nextSibling,r=n?r.nextSibling:null;i++}}var te=/<.*?>/g;function ee(t){var e,n,a=t.nTable,r=t.aoColumns,o=t.oScroll,i=o.sY,l=o.sX,o=o.sXInner,s=r.length,u=it(t,"bVisible"),c=P("th",t.nTHead),f=a.getAttribute("width"),d=a.parentNode,h=!1,p=t.oBrowser,g=p.bScrollOversize,b=a.style.width;for(b&&-1!==b.indexOf("%")&&(f=b),D=0;D<u.length;D++)null!==(e=r[u[D]]).sWidth&&(e.sWidth=ae(e.sWidthOrig,d),h=!0);if(g||!h&&!l&&!i&&s==T(t)&&s==c.length)for(D=0;D<s;D++){var m=rt(t,D);null!==m&&(r[m].sWidth=M(c.eq(D).width()))}else{var b=P(a).clone().css("visibility","hidden").removeAttr("id"),S=(b.find("tbody tr").remove(),P("<tr/>").appendTo(b.find("tbody")));for(b.find("thead, tfoot").remove(),b.append(P(t.nTHead).clone()).append(P(t.nTFoot).clone()),b.find("tfoot th, tfoot td").css("width",""),c=Ct(t,b.find("thead")[0]),D=0;D<u.length;D++)e=r[u[D]],c[D].style.width=null!==e.sWidthOrig&&""!==e.sWidthOrig?M(e.sWidthOrig):"",e.sWidthOrig&&l&&P(c[D]).append(P("<div/>").css({width:e.sWidthOrig,margin:0,padding:0,border:0,height:1}));if(t.aoData.length)for(D=0;D<u.length;D++)e=r[n=u[D]],P(re(t,n)).clone(!1).append(e.sContentPadding).appendTo(S);P("[name]",b).removeAttr("name");for(var v=P("<div/>").css(l||i?{position:"absolute",top:0,left:0,height:1,right:0,overflow:"hidden"}:{}).append(b).appendTo(d),y=(l&&o?b.width(o):l?(b.css("width","auto"),b.removeAttr("width"),b.width()<d.clientWidth&&f&&b.width(d.clientWidth)):i?b.width(d.clientWidth):f&&b.width(f),0),D=0;D<u.length;D++){var _=P(c[D]),w=_.outerWidth()-_.width(),_=p.bBounding?Math.ceil(c[D].getBoundingClientRect().width):_.outerWidth();y+=_,r[u[D]].sWidth=M(_-w)}a.style.width=M(y),v.remove()}f&&(a.style.width=M(f)),!f&&!l||t._reszEvt||(o=function(){P(j).on("resize.DT-"+t.sInstance,ne(function(){O(t)}))},g?setTimeout(o,1e3):o(),t._reszEvt=!0)}var ne=w.util.throttle;function ae(t,e){return t?(e=(t=P("<div/>").css("width",M(t)).appendTo(e||v.body))[0].offsetWidth,t.remove(),e):0}function re(t,e){var n,a=oe(t,e);return a<0?null:(n=t.aoData[a]).nTr?n.anCells[e]:P("<td/>").html(S(t,a,e,"display"))[0]}function oe(t,e){for(var n,a=-1,r=-1,o=0,i=t.aoData.length;o<i;o++)(n=(n=(n=S(t,o,e,"display")+"").replace(te,"")).replace(/&nbsp;/g," ")).length>a&&(a=n.length,r=o);return r}function M(t){return null===t?"0px":"number"==typeof t?t<0?"0px":t+"px":t.match(/\d$/)?t+"px":t}function I(t){function e(t){t.length&&!Array.isArray(t[0])?h.push(t):P.merge(h,t)}var n,a,r,o,i,l,s,u=[],c=t.aoColumns,f=t.aaSortingFixed,d=P.isPlainObject(f),h=[];for(Array.isArray(f)&&e(f),d&&f.pre&&e(f.pre),e(t.aaSorting),d&&f.post&&e(f.post),n=0;n<h.length;n++)for(r=(o=c[s=h[n][a=0]].aDataSort).length;a<r;a++)l=c[i=o[a]].sType||"string",h[n]._idx===H&&(h[n]._idx=P.inArray(h[n][1],c[i].asSorting)),u.push({src:s,col:i,dir:h[n][1],index:h[n]._idx,type:l,formatter:w.ext.type.order[l+"-pre"]});return u}function ie(t){var e,n,a,r,c,f=[],u=w.ext.type.order,d=t.aoData,o=(t.aoColumns,0),i=t.aiDisplayMaster;for(lt(t),e=0,n=(c=I(t)).length;e<n;e++)(r=c[e]).formatter&&o++,fe(t,r.col);if("ssp"!=E(t)&&0!==c.length){for(e=0,a=i.length;e<a;e++)f[i[e]]=e;o===c.length?i.sort(function(t,e){for(var n,a,r,o,i=c.length,l=d[t]._aSortData,s=d[e]._aSortData,u=0;u<i;u++)if(0!=(r=(n=l[(o=c[u]).col])<(a=s[o.col])?-1:a<n?1:0))return"asc"===o.dir?r:-r;return(n=f[t])<(a=f[e])?-1:a<n?1:0}):i.sort(function(t,e){for(var n,a,r,o=c.length,i=d[t]._aSortData,l=d[e]._aSortData,s=0;s<o;s++)if(n=i[(r=c[s]).col],a=l[r.col],0!==(r=(u[r.type+"-"+r.dir]||u["string-"+r.dir])(n,a)))return r;return(n=f[t])<(a=f[e])?-1:a<n?1:0})}t.bSorted=!0}function le(t){for(var e=t.aoColumns,n=I(t),a=t.oLanguage.oAria,r=0,o=e.length;r<o;r++){var i=e[r],l=i.asSorting,s=i.ariaTitle||i.sTitle.replace(/<.*?>/g,""),u=i.nTh;u.removeAttribute("aria-sort"),i=i.bSortable?s+("asc"===(0<n.length&&n[0].col==r&&(u.setAttribute("aria-sort","asc"==n[0].dir?"ascending":"descending"),l[n[0].index+1])||l[0])?a.sSortAscending:a.sSortDescending):s,u.setAttribute("aria-label",i)}}function se(t,e,n,a){function r(t,e){var n=t._idx;return(n=n===H?P.inArray(t[1],s):n)+1<s.length?n+1:e?null:0}var o,i=t.aoColumns[e],l=t.aaSorting,s=i.asSorting;"number"==typeof l[0]&&(l=t.aaSorting=[l]),n&&t.oFeatures.bSortMulti?-1!==(i=P.inArray(e,N(l,"0")))?null===(o=null===(o=r(l[i],!0))&&1===l.length?0:o)?l.splice(i,1):(l[i][1]=s[o],l[i]._idx=o):(l.push([e,s[0],0]),l[l.length-1]._idx=0):l.length&&l[0][0]==e?(o=r(l[0]),l.length=1,l[0][1]=s[o],l[0]._idx=o):(l.length=0,l.push([e,s[0]]),l[0]._idx=0),u(t),"function"==typeof a&&a(t)}function ue(e,t,n,a){var r=e.aoColumns[n];me(t,{},function(t){!1!==r.bSortable&&(e.oFeatures.bProcessing?(D(e,!0),setTimeout(function(){se(e,n,t.shiftKey,a),"ssp"!==E(e)&&D(e,!1)},0)):se(e,n,t.shiftKey,a))})}function ce(t){var e,n,a,r=t.aLastSort,o=t.oClasses.sSortColumn,i=I(t),l=t.oFeatures;if(l.bSort&&l.bSortClasses){for(e=0,n=r.length;e<n;e++)a=r[e].src,P(N(t.aoData,"anCells",a)).removeClass(o+(e<2?e+1:3));for(e=0,n=i.length;e<n;e++)a=i[e].src,P(N(t.aoData,"anCells",a)).addClass(o+(e<2?e+1:3))}t.aLastSort=i}function fe(t,e){for(var n,a,r,o=t.aoColumns[e],i=w.ext.order[o.sSortDataType],l=(i&&(n=i.call(t.oInstance,t,e,ot(t,e))),w.ext.type.order[o.sType+"-pre"]),s=0,u=t.aoData.length;s<u;s++)(a=t.aoData[s])._aSortData||(a._aSortData=[]),a._aSortData[e]&&!i||(r=i?n[s]:S(t,s,e,"sort"),a._aSortData[e]=l?l(r):r)}function de(n){var t;n._bLoadingState||(t={time:+new Date,start:n._iDisplayStart,length:n._iDisplayLength,order:P.extend(!0,[],n.aaSorting),search:Et(n.oPreviousSearch),columns:P.map(n.aoColumns,function(t,e){return{visible:t.bVisible,search:Et(n.aoPreSearchCols[e])}})},n.oSavedState=t,R(n,"aoStateSaveParams","stateSaveParams",[n,t]),n.oFeatures.bStateSave&&!n.bDestroying&&n.fnStateSaveCallback.call(n.oInstance,n,t))}function he(e,t,n){var a;if(e.oFeatures.bStateSave)return(a=e.fnStateLoadCallback.call(e.oInstance,e,function(t){pe(e,t,n)}))!==H&&pe(e,a,n),!0;n()}function pe(n,t,e){var a,r,o=n.aoColumns,i=(n._bLoadingState=!0,n._bInitComplete?new w.Api(n):null);if(t&&t.time){var l=R(n,"aoStateLoadParams","stateLoadParams",[n,t]);if(-1!==P.inArray(!1,l))n._bLoadingState=!1;else{l=n.iStateDuration;if(0<l&&t.time<+new Date-1e3*l)n._bLoadingState=!1;else if(t.columns&&o.length!==t.columns.length)n._bLoadingState=!1;else{if(n.oLoadedState=P.extend(!0,{},t),t.length!==H&&(i?i.page.len(t.length):n._iDisplayLength=t.length),t.start!==H&&(null===i?(n._iDisplayStart=t.start,n.iInitDisplayStart=t.start):Yt(n,t.start/n._iDisplayLength)),t.order!==H&&(n.aaSorting=[],P.each(t.order,function(t,e){n.aaSorting.push(e[0]>=o.length?[0,e[1]]:e)})),t.search!==H&&P.extend(n.oPreviousSearch,Bt(t.search)),t.columns){for(a=0,r=t.columns.length;a<r;a++){var s=t.columns[a];s.visible!==H&&(i?i.column(a).visible(s.visible,!1):o[a].bVisible=s.visible),s.search!==H&&P.extend(n.aoPreSearchCols[a],Bt(s.search))}i&&i.columns.adjust()}n._bLoadingState=!1,R(n,"aoStateLoaded","stateLoaded",[n,t])}}}else n._bLoadingState=!1;e()}function ge(t){var e=w.settings,t=P.inArray(t,N(e,"nTable"));return-1!==t?e[t]:null}function W(t,e,n,a){if(n="DataTables warning: "+(t?"table id="+t.sTableId+" - ":"")+n,a&&(n+=". For more information about this error, please see http://datatables.net/tn/"+a),e)j.console&&console.log&&console.log(n);else{e=w.ext,e=e.sErrMode||e.errMode;if(t&&R(t,null,"error",[t,a,n]),"alert"==e)alert(n);else{if("throw"==e)throw new Error(n);"function"==typeof e&&e(t,a,n)}}}function F(n,a,t,e){Array.isArray(t)?P.each(t,function(t,e){Array.isArray(e)?F(n,a,e[0],e[1]):F(n,a,e)}):(e===H&&(e=t),a[t]!==H&&(n[e]=a[t]))}function be(t,e,n){var a,r;for(r in e)e.hasOwnProperty(r)&&(a=e[r],P.isPlainObject(a)?(P.isPlainObject(t[r])||(t[r]={}),P.extend(!0,t[r],a)):n&&"data"!==r&&"aaData"!==r&&Array.isArray(a)?t[r]=a.slice():t[r]=a);return t}function me(e,t,n){P(e).on("click.DT",t,function(t){P(e).trigger("blur"),n(t)}).on("keypress.DT",t,function(t){13===t.which&&(t.preventDefault(),n(t))}).on("selectstart.DT",function(){return!1})}function L(t,e,n,a){n&&t[e].push({fn:n,sName:a})}function R(n,t,e,a){var r=[];return t&&(r=P.map(n[t].slice().reverse(),function(t,e){return t.fn.apply(n.oInstance,a)})),null!==e&&(t=P.Event(e+".dt"),(e=P(n.nTable)).trigger(t,a),0===e.parents("body").length&&P("body").trigger(t,a),r.push(t.result)),r}function Se(t){var e=t._iDisplayStart,n=t.fnDisplayEnd(),a=t._iDisplayLength;n<=e&&(e=n-a),e-=e%a,t._iDisplayStart=e=-1===a||e<0?0:e}function ve(t,e){var t=t.renderer,n=w.ext.renderer[e];return P.isPlainObject(t)&&t[e]?n[t[e]]||n._:"string"==typeof t&&n[t]||n._}function E(t){return t.oFeatures.bServerSide?"ssp":t.ajax||t.sAjaxSource?"ajax":"dom"}function ye(t,n){var a;return Array.isArray(t)?P.map(t,function(t){return ye(t,n)}):"number"==typeof t?[n[t]]:(a=P.map(n,function(t,e){return t.nTable}),P(a).filter(t).map(function(t){var e=P.inArray(this,a);return n[e]}).toArray())}function De(r,o,t){var e,n;t&&(e=new B(r)).one("draw",function(){t(e.ajax.json())}),"ssp"==E(r)?u(r,o):(D(r,!0),(n=r.jqXHR)&&4!==n.readyState&&n.abort(),Tt(r,[],function(t){pt(r);for(var e=Ft(r,t),n=0,a=e.length;n<a;n++)x(r,e[n]);u(r,o),D(r,!1)}))}function _e(t,e,n,a,r){for(var o,i,l,s,u=[],c=typeof e,f=0,d=(e=e&&"string"!=c&&"function"!=c&&e.length!==H?e:[e]).length;f<d;f++)for(l=0,s=(i=e[f]&&e[f].split&&!e[f].match(/[\[\(:]/)?e[f].split(","):[e[f]]).length;l<s;l++)(o=n("string"==typeof i[l]?i[l].trim():i[l]))&&o.length&&(u=u.concat(o));var h=p.selector[t];if(h.length)for(f=0,d=h.length;f<d;f++)u=h[f](a,r,u);return z(u)}function we(t){return(t=t||{}).filter&&t.search===H&&(t.search=t.filter),P.extend({search:"none",order:"current",page:"all"},t)}function Ce(t){for(var e=0,n=t.length;e<n;e++)if(0<t[e].length)return t[0]=t[e],t[0].length=1,t.length=1,t.context=[t.context[e]],t;return t.length=0,t}function Te(o,t,e,n){function i(t,e){var n;if(Array.isArray(t)||t instanceof P)for(var a=0,r=t.length;a<r;a++)i(t[a],e);else t.nodeName&&"tr"===t.nodeName.toLowerCase()?l.push(t):(n=P("<tr><td></td></tr>").addClass(e),P("td",n).addClass(e).html(t)[0].colSpan=T(o),l.push(n[0]))}var l=[];i(e,n),t._details&&t._details.detach(),t._details=P(l),t._detailsShow&&t._details.insertAfter(t.nTr)}function xe(t,e){var n=t.context;if(n.length&&t.length){var a=n[0].aoData[t[0]];if(a._details){(a._detailsShow=e)?(a._details.insertAfter(a.nTr),P(a.nTr).addClass("dt-hasChild")):(a._details.detach(),P(a.nTr).removeClass("dt-hasChild")),R(n[0],null,"childRow",[e,t.row(t[0])]);var s=n[0],r=new B(s),a=".dt.DT_details",e="draw"+a,t="column-sizing"+a,a="destroy"+a,u=s.aoData;if(r.off(e+" "+t+" "+a),N(u,"_details").length>0){r.on(e,function(t,e){if(s!==e)return;r.rows({page:"current"}).eq(0).each(function(t){var e=u[t];if(e._detailsShow)e._details.insertAfter(e.nTr)})});r.on(t,function(t,e,n,a){if(s!==e)return;var r,o=T(e);for(var i=0,l=u.length;i<l;i++){r=u[i];if(r._details)r._details.children("td[colspan]").attr("colspan",o)}});r.on(a,function(t,e){if(s!==e)return;for(var n=0,a=u.length;n<a;n++)if(u[n]._details)Re(r,n)})}Le(n)}}}function Ae(t,e,n,a,r){for(var o=[],i=0,l=r.length;i<l;i++)o.push(S(t,r[i],e));return o}var Ie=[],o=Array.prototype,B=function(t,e){if(!(this instanceof B))return new B(t,e);function n(t){var e,n,a,r;t=t,a=w.settings,r=P.map(a,function(t,e){return t.nTable}),(t=t?t.nTable&&t.oApi?[t]:t.nodeName&&"table"===t.nodeName.toLowerCase()?-1!==(e=P.inArray(t,r))?[a[e]]:null:t&&"function"==typeof t.settings?t.settings().toArray():("string"==typeof t?n=P(t):t instanceof P&&(n=t),n?n.map(function(t){return-1!==(e=P.inArray(this,r))?a[e]:null}).toArray():void 0):[])&&o.push.apply(o,t)}var o=[];if(Array.isArray(t))for(var a=0,r=t.length;a<r;a++)n(t[a]);else n(t);this.context=z(o),e&&P.merge(this,e),this.selector={rows:null,cols:null,opts:null},B.extend(this,this,Ie)},Fe=(w.Api=B,P.extend(B.prototype,{any:function(){return 0!==this.count()},concat:o.concat,context:[],count:function(){return this.flatten().length},each:function(t){for(var e=0,n=this.length;e<n;e++)t.call(this,this[e],e,this);return this},eq:function(t){var e=this.context;return e.length>t?new B(e[t],this[t]):null},filter:function(t){var e=[];if(o.filter)e=o.filter.call(this,t,this);else for(var n=0,a=this.length;n<a;n++)t.call(this,this[n],n,this)&&e.push(this[n]);return new B(this.context,e)},flatten:function(){var t=[];return new B(this.context,t.concat.apply(t,this.toArray()))},join:o.join,indexOf:o.indexOf||function(t,e){for(var n=e||0,a=this.length;n<a;n++)if(this[n]===t)return n;return-1},iterator:function(t,e,n,a){var r,o,i,l,s,u,c,f,d=[],h=this.context,p=this.selector;for("string"==typeof t&&(a=n,n=e,e=t,t=!1),o=0,i=h.length;o<i;o++){var g=new B(h[o]);if("table"===e)(r=n.call(g,h[o],o))!==H&&d.push(r);else if("columns"===e||"rows"===e)(r=n.call(g,h[o],this[o],o))!==H&&d.push(r);else if("column"===e||"column-rows"===e||"row"===e||"cell"===e)for(c=this[o],"column-rows"===e&&(u=Fe(h[o],p.opts)),l=0,s=c.length;l<s;l++)f=c[l],(r="cell"===e?n.call(g,h[o],f.row,f.column,o,l):n.call(g,h[o],f,o,l,u))!==H&&d.push(r)}return d.length||a?((t=(a=new B(h,t?d.concat.apply([],d):d)).selector).rows=p.rows,t.cols=p.cols,t.opts=p.opts,a):this},lastIndexOf:o.lastIndexOf||function(t,e){return this.indexOf.apply(this.toArray.reverse(),arguments)},length:0,map:function(t){var e=[];if(o.map)e=o.map.call(this,t,this);else for(var n=0,a=this.length;n<a;n++)e.push(t.call(this,this[n],n));return new B(this.context,e)},pluck:function(t){var e=w.util.get(t);return this.map(function(t){return e(t)})},pop:o.pop,push:o.push,reduce:o.reduce||function(t,e){return et(this,t,e,0,this.length,1)},reduceRight:o.reduceRight||function(t,e){return et(this,t,e,this.length-1,-1,-1)},reverse:o.reverse,selector:null,shift:o.shift,slice:function(){return new B(this.context,this)},sort:o.sort,splice:o.splice,toArray:function(){return o.slice.call(this)},to$:function(){return P(this)},toJQuery:function(){return P(this)},unique:function(){return new B(this.context,z(this))},unshift:o.unshift}),B.extend=function(t,e,n){if(n.length&&e&&(e instanceof B||e.__dt_wrapper))for(var a,r=0,o=n.length;r<o;r++)e[(a=n[r]).name]="function"===a.type?function(e,n,a){return function(){var t=n.apply(e,arguments);return B.extend(t,t,a.methodExt),t}}(t,a.val,a):"object"===a.type?{}:a.val,e[a.name].__dt_wrapper=!0,B.extend(t,e[a.name],a.propExt)},B.register=e=function(t,e){if(Array.isArray(t))for(var n=0,a=t.length;n<a;n++)B.register(t[n],e);else for(var r=t.split("."),o=Ie,i=0,l=r.length;i<l;i++){var s,u,c=function(t,e){for(var n=0,a=t.length;n<a;n++)if(t[n].name===e)return t[n];return null}(o,u=(s=-1!==r[i].indexOf("()"))?r[i].replace("()",""):r[i]);c||o.push(c={name:u,val:{},methodExt:[],propExt:[],type:"object"}),i===l-1?(c.val=e,c.type="function"==typeof e?"function":P.isPlainObject(e)?"object":"other"):o=s?c.methodExt:c.propExt}},B.registerPlural=t=function(t,e,n){B.register(t,n),B.register(e,function(){var t=n.apply(this,arguments);return t===this?this:t instanceof B?t.length?Array.isArray(t[0])?new B(t.context,t[0]):t[0]:H:t})},e("tables()",function(t){return t!==H&&null!==t?new B(ye(t,this.context)):this}),e("table()",function(t){var t=this.tables(t),e=t.context;return e.length?new B(e[0]):t}),t("tables().nodes()","table().node()",function(){return this.iterator("table",function(t){return t.nTable},1)}),t("tables().body()","table().body()",function(){return this.iterator("table",function(t){return t.nTBody},1)}),t("tables().header()","table().header()",function(){return this.iterator("table",function(t){return t.nTHead},1)}),t("tables().footer()","table().footer()",function(){return this.iterator("table",function(t){return t.nTFoot},1)}),t("tables().containers()","table().container()",function(){return this.iterator("table",function(t){return t.nTableWrapper},1)}),e("draw()",function(e){return this.iterator("table",function(t){"page"===e?y(t):u(t,!1===(e="string"==typeof e?"full-hold"!==e:e))})}),e("page()",function(e){return e===H?this.page.info().page:this.iterator("table",function(t){Yt(t,e)})}),e("page.info()",function(t){var e,n,a,r,o;return 0===this.context.length?H:(n=(e=this.context[0])._iDisplayStart,a=e.oFeatures.bPaginate?e._iDisplayLength:-1,r=e.fnRecordsDisplay(),{page:(o=-1===a)?0:Math.floor(n/a),pages:o?1:Math.ceil(r/a),start:n,end:e.fnDisplayEnd(),length:a,recordsTotal:e.fnRecordsTotal(),recordsDisplay:r,serverSide:"ssp"===E(e)})}),e("page.len()",function(e){return e===H?0!==this.context.length?this.context[0]._iDisplayLength:H:this.iterator("table",function(t){$t(t,e)})}),e("ajax.json()",function(){var t=this.context;if(0<t.length)return t[0].json}),e("ajax.params()",function(){var t=this.context;if(0<t.length)return t[0].oAjaxData}),e("ajax.reload()",function(e,n){return this.iterator("table",function(t){De(t,!1===n,e)})}),e("ajax.url()",function(e){var t=this.context;return e===H?0===t.length?H:(t=t[0]).ajax?P.isPlainObject(t.ajax)?t.ajax.url:t.ajax:t.sAjaxSource:this.iterator("table",function(t){P.isPlainObject(t.ajax)?t.ajax.url=e:t.ajax=e})}),e("ajax.url().load()",function(e,n){return this.iterator("table",function(t){De(t,!1===n,e)})}),function(t,e){var n,a=[],r=t.aiDisplay,o=t.aiDisplayMaster,i=e.search,l=e.order,e=e.page;if("ssp"==E(t))return"removed"===i?[]:f(0,o.length);if("current"==e)for(u=t._iDisplayStart,c=t.fnDisplayEnd();u<c;u++)a.push(r[u]);else if("current"==l||"applied"==l){if("none"==i)a=o.slice();else if("applied"==i)a=r.slice();else if("removed"==i){for(var s={},u=0,c=r.length;u<c;u++)s[r[u]]=null;a=P.map(o,function(t){return s.hasOwnProperty(t)?null:t})}}else if("index"==l||"original"==l)for(u=0,c=t.aoData.length;u<c;u++)("none"==i||-1===(n=P.inArray(u,r))&&"removed"==i||0<=n&&"applied"==i)&&a.push(u);return a}),Le=(e("rows()",function(e,n){e===H?e="":P.isPlainObject(e)&&(n=e,e=""),n=we(n);var t=this.iterator("table",function(t){return _e("row",e,function(n){var t=d(n),a=r.aoData;if(null!==t&&!o)return[t];if(i=i||Fe(r,o),null!==t&&-1!==P.inArray(t,i))return[t];if(null===n||n===H||""===n)return i;if("function"==typeof n)return P.map(i,function(t){var e=a[t];return n(t,e._aData,e.nTr)?t:null});if(n.nodeName)return t=n._DT_RowIndex,e=n._DT_CellIndex,t!==H?a[t]&&a[t].nTr===n?[t]:[]:e?a[e.row]&&a[e.row].nTr===n.parentNode?[e.row]:[]:(t=P(n).closest("*[data-dt-row]")).length?[t.data("dt-row")]:[];if("string"==typeof n&&"#"===n.charAt(0)){var e=r.aIds[n.replace(/^#/,"")];if(e!==H)return[e.idx]}t=_(m(r.aoData,i,"nTr"));return P(t).filter(n).map(function(){return this._DT_RowIndex}).toArray()},r=t,o=n);var r,o,i},1);return t.selector.rows=e,t.selector.opts=n,t}),e("rows().nodes()",function(){return this.iterator("row",function(t,e){return t.aoData[e].nTr||H},1)}),e("rows().data()",function(){return this.iterator(!0,"rows",function(t,e){return m(t.aoData,e,"_aData")},1)}),t("rows().cache()","row().cache()",function(n){return this.iterator("row",function(t,e){t=t.aoData[e];return"search"===n?t._aFilterData:t._aSortData},1)}),t("rows().invalidate()","row().invalidate()",function(n){return this.iterator("row",function(t,e){bt(t,e,n)})}),t("rows().indexes()","row().index()",function(){return this.iterator("row",function(t,e){return e},1)}),t("rows().ids()","row().id()",function(t){for(var e=[],n=this.context,a=0,r=n.length;a<r;a++)for(var o=0,i=this[a].length;o<i;o++){var l=n[a].rowIdFn(n[a].aoData[this[a][o]]._aData);e.push((!0===t?"#":"")+l)}return new B(n,e)}),t("rows().remove()","row().remove()",function(){var f=this;return this.iterator("row",function(t,e,n){var a,r,o,i,l,s,u=t.aoData,c=u[e];for(u.splice(e,1),a=0,r=u.length;a<r;a++)if(s=(l=u[a]).anCells,null!==l.nTr&&(l.nTr._DT_RowIndex=a),null!==s)for(o=0,i=s.length;o<i;o++)s[o]._DT_CellIndex.row=a;gt(t.aiDisplayMaster,e),gt(t.aiDisplay,e),gt(f[n],e,!1),0<t._iRecordsDisplay&&t._iRecordsDisplay--,Se(t);n=t.rowIdFn(c._aData);n!==H&&delete t.aIds[n]}),this.iterator("table",function(t){for(var e=0,n=t.aoData.length;e<n;e++)t.aoData[e].idx=e}),this}),e("rows.add()",function(o){var t=this.iterator("table",function(t){for(var e,n=[],a=0,r=o.length;a<r;a++)(e=o[a]).nodeName&&"TR"===e.nodeName.toUpperCase()?n.push(ut(t,e)[0]):n.push(x(t,e));return n},1),e=this.rows(-1);return e.pop(),P.merge(e,t),e}),e("row()",function(t,e){return Ce(this.rows(t,e))}),e("row().data()",function(t){var e,n=this.context;return t===H?n.length&&this.length?n[0].aoData[this[0]]._aData:H:((e=n[0].aoData[this[0]])._aData=t,Array.isArray(t)&&e.nTr&&e.nTr.id&&b(n[0].rowId)(t,e.nTr.id),bt(n[0],this[0],"data"),this)}),e("row().node()",function(){var t=this.context;return t.length&&this.length&&t[0].aoData[this[0]].nTr||null}),e("row.add()",function(e){e instanceof P&&e.length&&(e=e[0]);var t=this.iterator("table",function(t){return e.nodeName&&"TR"===e.nodeName.toUpperCase()?ut(t,e)[0]:x(t,e)});return this.row(t[0])}),P(v).on("plugin-init.dt",function(t,e){var n=new B(e),a="on-plugin-init",r="stateSaveParams."+a,o="destroy. "+a,a=(n.on(r,function(t,e,n){for(var a=e.rowIdFn,r=e.aoData,o=[],i=0;i<r.length;i++)r[i]._detailsShow&&o.push("#"+a(r[i]._aData));n.childRows=o}),n.on(o,function(){n.off(r+" "+o)}),n.state.loaded());a&&a.childRows&&n.rows(P.map(a.childRows,function(t){return t.replace(/:/g,"\\:")})).every(function(){R(e,null,"requestChild",[this])})}),w.util.throttle(function(t){de(t[0])},500)),Re=function(t,e){var n=t.context;n.length&&(e=n[0].aoData[e!==H?e:t[0]])&&e._details&&(e._details.remove(),e._detailsShow=H,e._details=H,P(e.nTr).removeClass("dt-hasChild"),Le(n))},Pe="row().child",je=Pe+"()",He=(e(je,function(t,e){var n=this.context;return t===H?n.length&&this.length?n[0].aoData[this[0]]._details:H:(!0===t?this.child.show():!1===t?Re(this):n.length&&this.length&&Te(n[0],n[0].aoData[this[0]],t,e),this)}),e([Pe+".show()",je+".show()"],function(t){return xe(this,!0),this}),e([Pe+".hide()",je+".hide()"],function(){return xe(this,!1),this}),e([Pe+".remove()",je+".remove()"],function(){return Re(this),this}),e(Pe+".isShown()",function(){var t=this.context;return t.length&&this.length&&t[0].aoData[this[0]]._detailsShow||!1}),/^([^:]+):(name|visIdx|visible)$/),Ne=(e("columns()",function(n,a){n===H?n="":P.isPlainObject(n)&&(a=n,n=""),a=we(a);var t=this.iterator("table",function(t){return e=n,l=a,s=(i=t).aoColumns,u=N(s,"sName"),c=N(s,"nTh"),_e("column",e,function(n){var a,t=d(n);if(""===n)return f(s.length);if(null!==t)return[0<=t?t:s.length+t];if("function"==typeof n)return a=Fe(i,l),P.map(s,function(t,e){return n(e,Ae(i,e,0,0,a),c[e])?e:null});var r="string"==typeof n?n.match(He):"";if(r)switch(r[2]){case"visIdx":case"visible":var e,o=parseInt(r[1],10);return o<0?[(e=P.map(s,function(t,e){return t.bVisible?e:null}))[e.length+o]]:[rt(i,o)];case"name":return P.map(u,function(t,e){return t===r[1]?e:null});default:return[]}return n.nodeName&&n._DT_CellIndex?[n._DT_CellIndex.column]:(t=P(c).filter(n).map(function(){return P.inArray(this,c)}).toArray()).length||!n.nodeName?t:(t=P(n).closest("*[data-dt-column]")).length?[t.data("dt-column")]:[]},i,l);var i,e,l,s,u,c},1);return t.selector.cols=n,t.selector.opts=a,t}),t("columns().header()","column().header()",function(t,e){return this.iterator("column",function(t,e){return t.aoColumns[e].nTh},1)}),t("columns().footer()","column().footer()",function(t,e){return this.iterator("column",function(t,e){return t.aoColumns[e].nTf},1)}),t("columns().data()","column().data()",function(){return this.iterator("column-rows",Ae,1)}),t("columns().dataSrc()","column().dataSrc()",function(){return this.iterator("column",function(t,e){return t.aoColumns[e].mData},1)}),t("columns().cache()","column().cache()",function(o){return this.iterator("column-rows",function(t,e,n,a,r){return m(t.aoData,r,"search"===o?"_aFilterData":"_aSortData",e)},1)}),t("columns().nodes()","column().nodes()",function(){return this.iterator("column-rows",function(t,e,n,a,r){return m(t.aoData,r,"anCells",e)},1)}),t("columns().visible()","column().visible()",function(f,n){var e=this,t=this.iterator("column",function(t,e){if(f===H)return t.aoColumns[e].bVisible;var n,a,r=e,e=f,o=t.aoColumns,i=o[r],l=t.aoData;if(e===H)i.bVisible;else if(i.bVisible!==e){if(e)for(var s=P.inArray(!0,N(o,"bVisible"),r+1),u=0,c=l.length;u<c;u++)a=l[u].nTr,n=l[u].anCells,a&&a.insertBefore(n[r],n[s]||null);else P(N(t.aoData,"anCells",r)).detach();i.bVisible=e}});return f!==H&&this.iterator("table",function(t){Dt(t,t.aoHeader),Dt(t,t.aoFooter),t.aiDisplay.length||P(t.nTBody).find("td[colspan]").attr("colspan",T(t)),de(t),e.iterator("column",function(t,e){R(t,null,"column-visibility",[t,e,f,n])}),n!==H&&!n||e.columns.adjust()}),t}),t("columns().indexes()","column().index()",function(n){return this.iterator("column",function(t,e){return"visible"===n?ot(t,e):e},1)}),e("columns.adjust()",function(){return this.iterator("table",function(t){O(t)},1)}),e("column.index()",function(t,e){var n;if(0!==this.context.length)return n=this.context[0],"fromVisible"===t||"toData"===t?rt(n,e):"fromData"===t||"toVisible"===t?ot(n,e):void 0}),e("column()",function(t,e){return Ce(this.columns(t,e))}),e("cells()",function(g,t,b){var a,r,o,i,l,s,e;return P.isPlainObject(g)&&(g.row===H?(b=g,g=null):(b=t,t=null)),P.isPlainObject(t)&&(b=t,t=null),null===t||t===H?this.iterator("table",function(t){return a=t,t=g,e=we(b),f=a.aoData,d=Fe(a,e),n=_(m(f,d,"anCells")),h=P(Y([],n)),p=a.aoColumns.length,_e("cell",t,function(t){var e,n="function"==typeof t;if(null===t||t===H||n){for(o=[],i=0,l=d.length;i<l;i++)for(r=d[i],s=0;s<p;s++)u={row:r,column:s},(!n||(c=f[r],t(u,S(a,r,s),c.anCells?c.anCells[s]:null)))&&o.push(u);return o}return P.isPlainObject(t)?t.column!==H&&t.row!==H&&-1!==P.inArray(t.row,d)?[t]:[]:(e=h.filter(t).map(function(t,e){return{row:e._DT_CellIndex.row,column:e._DT_CellIndex.column}}).toArray()).length||!t.nodeName?e:(c=P(t).closest("*[data-dt-row]")).length?[{row:c.data("dt-row"),column:c.data("dt-column")}]:[]},a,e);var a,e,r,o,i,l,s,u,c,f,d,n,h,p}):(e=b?{page:b.page,order:b.order,search:b.search}:{},a=this.columns(t,e),r=this.rows(g,e),e=this.iterator("table",function(t,e){var n=[];for(o=0,i=r[e].length;o<i;o++)for(l=0,s=a[e].length;l<s;l++)n.push({row:r[e][o],column:a[e][l]});return n},1),e=b&&b.selected?this.cells(e,b):e,P.extend(e.selector,{cols:t,rows:g,opts:b}),e)}),t("cells().nodes()","cell().node()",function(){return this.iterator("cell",function(t,e,n){t=t.aoData[e];return t&&t.anCells?t.anCells[n]:H},1)}),e("cells().data()",function(){return this.iterator("cell",function(t,e,n){return S(t,e,n)},1)}),t("cells().cache()","cell().cache()",function(a){return a="search"===a?"_aFilterData":"_aSortData",this.iterator("cell",function(t,e,n){return t.aoData[e][a][n]},1)}),t("cells().render()","cell().render()",function(a){return this.iterator("cell",function(t,e,n){return S(t,e,n,a)},1)}),t("cells().indexes()","cell().index()",function(){return this.iterator("cell",function(t,e,n){return{row:e,column:n,columnVisible:ot(t,n)}},1)}),t("cells().invalidate()","cell().invalidate()",function(a){return this.iterator("cell",function(t,e,n){bt(t,e,a,n)})}),e("cell()",function(t,e,n){return Ce(this.cells(t,e,n))}),e("cell().data()",function(t){var e=this.context,n=this[0];return t===H?e.length&&n.length?S(e[0],n[0].row,n[0].column):H:(ct(e[0],n[0].row,n[0].column,t),bt(e[0],n[0].row,"data",n[0].column),this)}),e("order()",function(e,t){var n=this.context;return e===H?0!==n.length?n[0].aaSorting:H:("number"==typeof e?e=[[e,t]]:e.length&&!Array.isArray(e[0])&&(e=Array.prototype.slice.call(arguments)),this.iterator("table",function(t){t.aaSorting=e.slice()}))}),e("order.listener()",function(e,n,a){return this.iterator("table",function(t){ue(t,e,n,a)})}),e("order.fixed()",function(e){var t;return e?this.iterator("table",function(t){t.aaSortingFixed=P.extend(!0,{},e)}):(t=(t=this.context).length?t[0].aaSortingFixed:H,Array.isArray(t)?{pre:t}:t)}),e(["columns().order()","column().order()"],function(a){var r=this;return this.iterator("table",function(t,e){var n=[];P.each(r[e],function(t,e){n.push([e,a])}),t.aaSorting=n})}),e("search()",function(e,n,a,r){var t=this.context;return e===H?0!==t.length?t[0].oPreviousSearch.sSearch:H:this.iterator("table",function(t){t.oFeatures.bFilter&&Rt(t,P.extend({},t.oPreviousSearch,{sSearch:e+"",bRegex:null!==n&&n,bSmart:null===a||a,bCaseInsensitive:null===r||r}),1)})}),t("columns().search()","column().search()",function(a,r,o,i){return this.iterator("column",function(t,e){var n=t.aoPreSearchCols;if(a===H)return n[e].sSearch;t.oFeatures.bFilter&&(P.extend(n[e],{sSearch:a+"",bRegex:null!==r&&r,bSmart:null===o||o,bCaseInsensitive:null===i||i}),Rt(t,t.oPreviousSearch,1))})}),e("state()",function(){return this.context.length?this.context[0].oSavedState:null}),e("state.clear()",function(){return this.iterator("table",function(t){t.fnStateSaveCallback.call(t.oInstance,t,{})})}),e("state.loaded()",function(){return this.context.length?this.context[0].oLoadedState:null}),e("state.save()",function(){return this.iterator("table",function(t){de(t)})}),w.use=function(t,e){"lib"===e||t.fn?P=t:"win"==e||t.document?v=(j=t).document:"datetime"!==e&&"DateTime"!==t.type||(w.DateTime=t)},w.factory=function(t,e){var n=!1;return t&&t.document&&(v=(j=t).document),e&&e.fn&&e.fn.jquery&&(P=e,n=!0),n},w.versionCheck=w.fnVersionCheck=function(t){for(var e,n,a=w.version.split("."),r=t.split("."),o=0,i=r.length;o<i;o++)if((e=parseInt(a[o],10)||0)!==(n=parseInt(r[o],10)||0))return n<e;return!0},w.isDataTable=w.fnIsDataTable=function(t){var r=P(t).get(0),o=!1;return t instanceof w.Api||(P.each(w.settings,function(t,e){var n=e.nScrollHead?P("table",e.nScrollHead)[0]:null,a=e.nScrollFoot?P("table",e.nScrollFoot)[0]:null;e.nTable!==r&&n!==r&&a!==r||(o=!0)}),o)},w.tables=w.fnTables=function(e){var t=!1,n=(P.isPlainObject(e)&&(t=e.api,e=e.visible),P.map(w.settings,function(t){if(!e||P(t.nTable).is(":visible"))return t.nTable}));return t?new B(n):n},w.camelToHungarian=C,e("$()",function(t,e){e=this.rows(e).nodes(),e=P(e);return P([].concat(e.filter(t).toArray(),e.find(t).toArray()))}),P.each(["on","one","off"],function(t,n){e(n+"()",function(){var t=Array.prototype.slice.call(arguments),e=(t[0]=P.map(t[0].split(/\s/),function(t){return t.match(/\.dt\b/)?t:t+".dt"}).join(" "),P(this.tables().nodes()));return e[n].apply(e,t),this})}),e("clear()",function(){return this.iterator("table",function(t){pt(t)})}),e("settings()",function(){return new B(this.context,this.context)}),e("init()",function(){var t=this.context;return t.length?t[0].oInit:null}),e("data()",function(){return this.iterator("table",function(t){return N(t.aoData,"_aData")}).flatten()}),e("destroy()",function(c){return c=c||!1,this.iterator("table",function(e){var n,t=e.oClasses,a=e.nTable,r=e.nTBody,o=e.nTHead,i=e.nTFoot,l=P(a),r=P(r),s=P(e.nTableWrapper),u=P.map(e.aoData,function(t){return t.nTr}),i=(e.bDestroying=!0,R(e,"aoDestroyCallback","destroy",[e]),c||new B(e).columns().visible(!0),s.off(".DT").find(":not(tbody *)").off(".DT"),P(j).off(".DT-"+e.sInstance),a!=o.parentNode&&(l.children("thead").detach(),l.append(o)),i&&a!=i.parentNode&&(l.children("tfoot").detach(),l.append(i)),e.aaSorting=[],e.aaSortingFixed=[],ce(e),P(u).removeClass(e.asStripeClasses.join(" ")),P("th, td",o).removeClass(t.sSortable+" "+t.sSortableAsc+" "+t.sSortableDesc+" "+t.sSortableNone),r.children().detach(),r.append(u),e.nTableWrapper.parentNode),o=c?"remove":"detach",u=(l[o](),s[o](),!c&&i&&(i.insertBefore(a,e.nTableReinsertBefore),l.css("width",e.sDestroyWidth).removeClass(t.sTable),n=e.asDestroyStripes.length)&&r.children().each(function(t){P(this).addClass(e.asDestroyStripes[t%n])}),P.inArray(e,w.settings));-1!==u&&w.settings.splice(u,1)})}),P.each(["column","row","cell"],function(t,s){e(s+"s().every()",function(o){var i=this.selector.opts,l=this;return this.iterator(s,function(t,e,n,a,r){o.call(l[s](e,"cell"===s?n:i,"cell"===s?i:H),e,n,a,r)})})}),e("i18n()",function(t,e,n){var a=this.context[0],t=A(t)(a.oLanguage);return t===H&&(t=e),"string"==typeof(t=n!==H&&P.isPlainObject(t)?t[n]!==H?t[n]:t._:t)?t.replace("%d",n):t}),w.version="1.13.6",w.settings=[],w.models={},w.models.oSearch={bCaseInsensitive:!0,sSearch:"",bRegex:!1,bSmart:!0,return:!1},w.models.oRow={nTr:null,anCells:null,_aData:[],_aSortData:null,_aFilterData:null,_sFilterRow:null,_sRowStripe:"",src:null,idx:-1},w.models.oColumn={idx:null,aDataSort:null,asSorting:null,bSearchable:null,bSortable:null,bVisible:null,_sManualType:null,_bAttrSrc:!1,fnCreatedCell:null,fnGetData:null,fnSetData:null,mData:null,mRender:null,nTh:null,nTf:null,sClass:null,sContentPadding:null,sDefaultContent:null,sName:null,sSortDataType:"std",sSortingClass:null,sSortingClassJUI:null,sTitle:null,sType:null,sWidth:null,sWidthOrig:null},w.defaults={aaData:null,aaSorting:[[0,"asc"]],aaSortingFixed:[],ajax:null,aLengthMenu:[10,25,50,100],aoColumns:null,aoColumnDefs:null,aoSearchCols:[],asStripeClasses:null,bAutoWidth:!0,bDeferRender:!1,bDestroy:!1,bFilter:!0,bInfo:!0,bLengthChange:!0,bPaginate:!0,bProcessing:!1,bRetrieve:!1,bScrollCollapse:!1,bServerSide:!1,bSort:!0,bSortMulti:!0,bSortCellsTop:!1,bSortClasses:!0,bStateSave:!1,fnCreatedRow:null,fnDrawCallback:null,fnFooterCallback:null,fnFormatNumber:function(t){return t.toString().replace(/\B(?=(\d{3})+(?!\d))/g,this.oLanguage.sThousands)},fnHeaderCallback:null,fnInfoCallback:null,fnInitComplete:null,fnPreDrawCallback:null,fnRowCallback:null,fnServerData:null,fnServerParams:null,fnStateLoadCallback:function(t){try{return JSON.parse((-1===t.iStateDuration?sessionStorage:localStorage).getItem("DataTables_"+t.sInstance+"_"+location.pathname))}catch(t){return{}}},fnStateLoadParams:null,fnStateLoaded:null,fnStateSaveCallback:function(t,e){try{(-1===t.iStateDuration?sessionStorage:localStorage).setItem("DataTables_"+t.sInstance+"_"+location.pathname,JSON.stringify(e))}catch(t){}},fnStateSaveParams:null,iStateDuration:7200,iDeferLoading:null,iDisplayLength:10,iDisplayStart:0,iTabIndex:0,oClasses:{},oLanguage:{oAria:{sSortAscending:": activate to sort column ascending",sSortDescending:": activate to sort column descending"},oPaginate:{sFirst:"First",sLast:"Last",sNext:"Next",sPrevious:"Previous"},sEmptyTable:"No data available in table",sInfo:"Showing _START_ to _END_ of _TOTAL_ entries",sInfoEmpty:"Showing 0 to 0 of 0 entries",sInfoFiltered:"(filtered from _MAX_ total entries)",sInfoPostFix:"",sDecimal:"",sThousands:",",sLengthMenu:"Show _MENU_ entries",sLoadingRecords:"Loading...",sProcessing:"",sSearch:"Search:",sSearchPlaceholder:"",sUrl:"",sZeroRecords:"No matching records found"},oSearch:P.extend({},w.models.oSearch),sAjaxDataProp:"data",sAjaxSource:null,sDom:"lfrtip",searchDelay:null,sPaginationType:"simple_numbers",sScrollX:"",sScrollXInner:"",sScrollY:"",sServerMethod:"GET",renderer:null,rowId:"DT_RowId"},i(w.defaults),w.defaults.column={aDataSort:null,iDataSort:-1,asSorting:["asc","desc"],bSearchable:!0,bSortable:!0,bVisible:!0,fnCreatedCell:null,mData:null,mRender:null,sCellType:"td",sClass:"",sContentPadding:"",sDefaultContent:null,sName:"",sSortDataType:"std",sTitle:null,sType:null,sWidth:null},i(w.defaults.column),w.models.oSettings={oFeatures:{bAutoWidth:null,bDeferRender:null,bFilter:null,bInfo:null,bLengthChange:null,bPaginate:null,bProcessing:null,bServerSide:null,bSort:null,bSortMulti:null,bSortClasses:null,bStateSave:null},oScroll:{bCollapse:null,iBarWidth:0,sX:null,sXInner:null,sY:null},oLanguage:{fnInfoCallback:null},oBrowser:{bScrollOversize:!1,bScrollbarLeft:!1,bBounding:!1,barWidth:0},ajax:null,aanFeatures:[],aoData:[],aiDisplay:[],aiDisplayMaster:[],aIds:{},aoColumns:[],aoHeader:[],aoFooter:[],oPreviousSearch:{},aoPreSearchCols:[],aaSorting:null,aaSortingFixed:[],asStripeClasses:null,asDestroyStripes:[],sDestroyWidth:0,aoRowCallback:[],aoHeaderCallback:[],aoFooterCallback:[],aoDrawCallback:[],aoRowCreatedCallback:[],aoPreDrawCallback:[],aoInitComplete:[],aoStateSaveParams:[],aoStateLoadParams:[],aoStateLoaded:[],sTableId:"",nTable:null,nTHead:null,nTFoot:null,nTBody:null,nTableWrapper:null,bDeferLoading:!1,bInitialised:!1,aoOpenRows:[],sDom:null,searchDelay:null,sPaginationType:"two_button",iStateDuration:0,aoStateSave:[],aoStateLoad:[],oSavedState:null,oLoadedState:null,sAjaxSource:null,sAjaxDataProp:null,jqXHR:null,json:H,oAjaxData:H,fnServerData:null,aoServerParams:[],sServerMethod:null,fnFormatNumber:null,aLengthMenu:null,iDraw:0,bDrawing:!1,iDrawError:-1,_iDisplayLength:10,_iDisplayStart:0,_iRecordsTotal:0,_iRecordsDisplay:0,oClasses:{},bFiltered:!1,bSorted:!1,bSortCellsTop:null,oInit:null,aoDestroyCallback:[],fnRecordsTotal:function(){return"ssp"==E(this)?+this._iRecordsTotal:this.aiDisplayMaster.length},fnRecordsDisplay:function(){return"ssp"==E(this)?+this._iRecordsDisplay:this.aiDisplay.length},fnDisplayEnd:function(){var t=this._iDisplayLength,e=this._iDisplayStart,n=e+t,a=this.aiDisplay.length,r=this.oFeatures,o=r.bPaginate;return r.bServerSide?!1===o||-1===t?e+a:Math.min(e+t,this._iRecordsDisplay):!o||a<n||-1===t?a:n},oInstance:null,sInstance:null,iTabIndex:0,nScrollHead:null,nScrollFoot:null,aLastSort:[],oPlugins:{},rowIdFn:null,rowId:null},w.ext=p={buttons:{},classes:{},builder:"dt/dt-1.13.6",errMode:"alert",feature:[],search:[],selector:{cell:[],column:[],row:[]},internal:{},legacy:{ajax:null},pager:{},renderer:{pageButton:{},header:{}},order:{},type:{detect:[],search:{},order:{}},_unique:0,fnVersionCheck:w.fnVersionCheck,iApiIndex:0,oJUIClasses:{},sVersion:w.version},P.extend(p,{afnFiltering:p.search,aTypes:p.type.detect,ofnSearch:p.type.search,oSort:p.type.order,afnSortData:p.order,aoFeatures:p.feature,oApi:p.internal,oStdClasses:p.classes,oPagination:p.pager}),P.extend(w.ext.classes,{sTable:"dataTable",sNoFooter:"no-footer",sPageButton:"paginate_button",sPageButtonActive:"current",sPageButtonDisabled:"disabled",sStripeOdd:"odd",sStripeEven:"even",sRowEmpty:"dataTables_empty",sWrapper:"dataTables_wrapper",sFilter:"dataTables_filter",sInfo:"dataTables_info",sPaging:"dataTables_paginate paging_",sLength:"dataTables_length",sProcessing:"dataTables_processing",sSortAsc:"sorting_asc",sSortDesc:"sorting_desc",sSortable:"sorting",sSortableAsc:"sorting_desc_disabled",sSortableDesc:"sorting_asc_disabled",sSortableNone:"sorting_disabled",sSortColumn:"sorting_",sFilterInput:"",sLengthSelect:"",sScrollWrapper:"dataTables_scroll",sScrollHead:"dataTables_scrollHead",sScrollHeadInner:"dataTables_scrollHeadInner",sScrollBody:"dataTables_scrollBody",sScrollFoot:"dataTables_scrollFoot",sScrollFootInner:"dataTables_scrollFootInner",sHeaderTH:"",sFooterTH:"",sSortJUIAsc:"",sSortJUIDesc:"",sSortJUI:"",sSortJUIAscAllowed:"",sSortJUIDescAllowed:"",sSortJUIWrapper:"",sSortIcon:"",sJUIHeader:"",sJUIFooter:""}),w.ext.pager);function Oe(t,e){var n=[],a=Ne.numbers_length,r=Math.floor(a/2);return e<=a?n=f(0,e):t<=r?((n=f(0,a-2)).push("ellipsis"),n.push(e-1)):((e-1-r<=t?n=f(e-(a-2),e):((n=f(t-r+2,t+r-1)).push("ellipsis"),n.push(e-1),n)).splice(0,0,"ellipsis"),n.splice(0,0,0)),n.DT_el="span",n}P.extend(Ne,{simple:function(t,e){return["previous","next"]},full:function(t,e){return["first","previous","next","last"]},numbers:function(t,e){return[Oe(t,e)]},simple_numbers:function(t,e){return["previous",Oe(t,e),"next"]},full_numbers:function(t,e){return["first","previous",Oe(t,e),"next","last"]},first_last_numbers:function(t,e){return["first",Oe(t,e),"last"]},_numbers:Oe,numbers_length:7}),P.extend(!0,w.ext.renderer,{pageButton:{_:function(u,t,c,e,f,d){function h(t,e){for(var n,a=b.sPageButtonDisabled,r=function(t){Yt(u,t.data.action,!0)},o=0,i=e.length;o<i;o++)if(n=e[o],Array.isArray(n)){var l=P("<"+(n.DT_el||"div")+"/>").appendTo(t);h(l,n)}else{var s=!1;switch(p=null,g=n){case"ellipsis":t.append('<span class="ellipsis">&#x2026;</span>');break;case"first":p=m.sFirst,0===f&&(s=!0);break;case"previous":p=m.sPrevious,0===f&&(s=!0);break;case"next":p=m.sNext,0!==d&&f!==d-1||(s=!0);break;case"last":p=m.sLast,0!==d&&f!==d-1||(s=!0);break;default:p=u.fnFormatNumber(n+1),g=f===n?b.sPageButtonActive:""}null!==p&&(l=u.oInit.pagingTag||"a",s&&(g+=" "+a),me(P("<"+l+">",{class:b.sPageButton+" "+g,"aria-controls":u.sTableId,"aria-disabled":s?"true":null,"aria-label":S[n],role:"link","aria-current":g===b.sPageButtonActive?"page":null,"data-dt-idx":n,tabindex:s?-1:u.iTabIndex,id:0===c&&"string"==typeof n?u.sTableId+"_"+n:null}).html(p).appendTo(t),{action:n},r))}}var p,g,n,b=u.oClasses,m=u.oLanguage.oPaginate,S=u.oLanguage.oAria.paginate||{};try{n=P(t).find(v.activeElement).data("dt-idx")}catch(t){}h(P(t).empty(),e),n!==H&&P(t).find("[data-dt-idx="+n+"]").trigger("focus")}}}),P.extend(w.ext.type.detect,[function(t,e){e=e.oLanguage.sDecimal;return l(t,e)?"num"+e:null},function(t,e){var n;return(!t||t instanceof Date||X.test(t))&&(null!==(n=Date.parse(t))&&!isNaN(n)||h(t))?"date":null},function(t,e){e=e.oLanguage.sDecimal;return l(t,e,!0)?"num-fmt"+e:null},function(t,e){e=e.oLanguage.sDecimal;return a(t,e)?"html-num"+e:null},function(t,e){e=e.oLanguage.sDecimal;return a(t,e,!0)?"html-num-fmt"+e:null},function(t,e){return h(t)||"string"==typeof t&&-1!==t.indexOf("<")?"html":null}]),P.extend(w.ext.type.search,{html:function(t){return h(t)?t:"string"==typeof t?t.replace(U," ").replace(V,""):""},string:function(t){return!h(t)&&"string"==typeof t?t.replace(U," "):t}});function ke(t,e,n,a){var r;return 0===t||t&&"-"!==t?"number"==(r=typeof t)||"bigint"==r?t:+(t=(t=e?$(t,e):t).replace&&(n&&(t=t.replace(n,"")),a)?t.replace(a,""):t):-1/0}function Me(n){P.each({num:function(t){return ke(t,n)},"num-fmt":function(t){return ke(t,n,q)},"html-num":function(t){return ke(t,n,V)},"html-num-fmt":function(t){return ke(t,n,V,q)}},function(t,e){p.type.order[t+n+"-pre"]=e,t.match(/^html\-/)&&(p.type.search[t+n]=p.type.search.html)})}P.extend(p.type.order,{"date-pre":function(t){t=Date.parse(t);return isNaN(t)?-1/0:t},"html-pre":function(t){return h(t)?"":t.replace?t.replace(/<.*?>/g,"").toLowerCase():t+""},"string-pre":function(t){return h(t)?"":"string"==typeof t?t.toLowerCase():t.toString?t.toString():""},"string-asc":function(t,e){return t<e?-1:e<t?1:0},"string-desc":function(t,e){return t<e?1:e<t?-1:0}}),Me(""),P.extend(!0,w.ext.renderer,{header:{_:function(r,o,i,l){P(r.nTable).on("order.dt.DT",function(t,e,n,a){r===e&&(e=i.idx,o.removeClass(l.sSortAsc+" "+l.sSortDesc).addClass("asc"==a[e]?l.sSortAsc:"desc"==a[e]?l.sSortDesc:i.sSortingClass))})},jqueryui:function(r,o,i,l){P("<div/>").addClass(l.sSortJUIWrapper).append(o.contents()).append(P("<span/>").addClass(l.sSortIcon+" "+i.sSortingClassJUI)).appendTo(o),P(r.nTable).on("order.dt.DT",function(t,e,n,a){r===e&&(e=i.idx,o.removeClass(l.sSortAsc+" "+l.sSortDesc).addClass("asc"==a[e]?l.sSortAsc:"desc"==a[e]?l.sSortDesc:i.sSortingClass),o.find("span."+l.sSortIcon).removeClass(l.sSortJUIAsc+" "+l.sSortJUIDesc+" "+l.sSortJUI+" "+l.sSortJUIAscAllowed+" "+l.sSortJUIDescAllowed).addClass("asc"==a[e]?l.sSortJUIAsc:"desc"==a[e]?l.sSortJUIDesc:i.sSortingClassJUI))})}}});function We(t){return"string"==typeof(t=Array.isArray(t)?t.join(","):t)?t.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;"):t}function Ee(t,e,n,a,r){return j.moment?t[e](r):j.luxon?t[n](r):a?t[a](r):t}var Be=!1;function Ue(t,e,n){var a;if(j.moment){if(!(a=j.moment.utc(t,e,n,!0)).isValid())return null}else if(j.luxon){if(!(a=e&&"string"==typeof t?j.luxon.DateTime.fromFormat(t,e):j.luxon.DateTime.fromISO(t)).isValid)return null;a.setLocale(n)}else e?(Be||alert("DataTables warning: Formatted date without Moment.js or Luxon - https://datatables.net/tn/17"),Be=!0):a=new Date(t);return a}function Ve(s){return function(a,r,o,i){0===arguments.length?(o="en",a=r=null):1===arguments.length?(o="en",r=a,a=null):2===arguments.length&&(o=r,r=a,a=null);var l="datetime-"+r;return w.ext.type.order[l]||(w.ext.type.detect.unshift(function(t){return t===l&&l}),w.ext.type.order[l+"-asc"]=function(t,e){t=t.valueOf(),e=e.valueOf();return t===e?0:t<e?-1:1},w.ext.type.order[l+"-desc"]=function(t,e){t=t.valueOf(),e=e.valueOf();return t===e?0:e<t?-1:1}),function(t,e){var n;return null!==t&&t!==H||(t="--now"===i?(n=new Date,new Date(Date.UTC(n.getFullYear(),n.getMonth(),n.getDate(),n.getHours(),n.getMinutes(),n.getSeconds()))):""),"type"===e?l:""===t?"sort"!==e?"":Ue("0000-01-01 00:00:00",null,o):!(null===r||a!==r||"sort"===e||"type"===e||t instanceof Date)||null===(n=Ue(t,a,o))?t:"sort"===e?n:(t=null===r?Ee(n,"toDate","toJSDate","")[s]():Ee(n,"format","toFormat","toISOString",r),"display"===e?We(t):t)}}}var Xe=",",Je=".";if(j.Intl!==H)try{for(var qe=(new Intl.NumberFormat).formatToParts(100000.1),n=0;n<qe.length;n++)"group"===qe[n].type?Xe=qe[n].value:"decimal"===qe[n].type&&(Je=qe[n].value)}catch(t){}function $e(e){return function(){var t=[ge(this[w.ext.iApiIndex])].concat(Array.prototype.slice.call(arguments));return w.ext.internal[e].apply(this,t)}}return w.datetime=function(n,a){var r="datetime-detect-"+n;a=a||"en",w.ext.type.order[r]||(w.ext.type.detect.unshift(function(t){var e=Ue(t,n,a);return!(""!==t&&!e)&&r}),w.ext.type.order[r+"-pre"]=function(t){return Ue(t,n,a)||0})},w.render={date:Ve("toLocaleDateString"),datetime:Ve("toLocaleString"),time:Ve("toLocaleTimeString"),number:function(a,r,o,i,l){return null!==a&&a!==H||(a=Xe),null!==r&&r!==H||(r=Je),{display:function(t){if("number"!=typeof t&&"string"!=typeof t)return t;if(""===t||null===t)return t;var e=t<0?"-":"",n=parseFloat(t);if(isNaN(n))return We(t);n=n.toFixed(o),t=Math.abs(n);n=parseInt(t,10),t=o?r+(t-n).toFixed(o).substring(2):"";return(e=0===n&&0===parseFloat(t)?"":e)+(i||"")+n.toString().replace(/\B(?=(\d{3})+(?!\d))/g,a)+t+(l||"")}}},text:function(){return{display:We,filter:We}}},P.extend(w.ext.internal,{_fnExternApiFunc:$e,_fnBuildAjax:Tt,_fnAjaxUpdate:xt,_fnAjaxParameters:At,_fnAjaxUpdateDraw:It,_fnAjaxDataSrc:Ft,_fnAddColumn:nt,_fnColumnOptions:at,_fnAdjustColumnSizing:O,_fnVisibleToColumnIndex:rt,_fnColumnIndexToVisible:ot,_fnVisbleColumns:T,_fnGetColumns:it,_fnColumnTypes:lt,_fnApplyColumnDefs:st,_fnHungarianMap:i,_fnCamelToHungarian:C,_fnLanguageCompat:Z,_fnBrowserDetect:tt,_fnAddData:x,_fnAddTr:ut,_fnNodeToDataIndex:function(t,e){return e._DT_RowIndex!==H?e._DT_RowIndex:null},_fnNodeToColumnIndex:function(t,e,n){return P.inArray(n,t.aoData[e].anCells)},_fnGetCellData:S,_fnSetCellData:ct,_fnSplitObjNotation:dt,_fnGetObjectDataFn:A,_fnSetObjectDataFn:b,_fnGetDataMaster:ht,_fnClearTable:pt,_fnDeleteIndex:gt,_fnInvalidate:bt,_fnGetRowElements:mt,_fnCreateTr:St,_fnBuildHead:yt,_fnDrawHead:Dt,_fnDraw:y,_fnReDraw:u,_fnAddOptionsHtml:_t,_fnDetectHeader:wt,_fnGetUniqueThs:Ct,_fnFeatureHtmlFilter:Lt,_fnFilterComplete:Rt,_fnFilterCustom:Pt,_fnFilterColumn:jt,_fnFilter:Ht,_fnFilterCreateSearch:Nt,_fnEscapeRegex:Ot,_fnFilterData:Wt,_fnFeatureHtmlInfo:Ut,_fnUpdateInfo:Vt,_fnInfoMacros:Xt,_fnInitialise:Jt,_fnInitComplete:qt,_fnLengthChange:$t,_fnFeatureHtmlLength:Gt,_fnFeatureHtmlPaginate:zt,_fnPageChange:Yt,_fnFeatureHtmlProcessing:Zt,_fnProcessingDisplay:D,_fnFeatureHtmlTable:Kt,_fnScrollDraw:Qt,_fnApplyToChildren:k,_fnCalculateColumnWidths:ee,_fnThrottle:ne,_fnConvertToWidth:ae,_fnGetWidestNode:re,_fnGetMaxLenString:oe,_fnStringToCss:M,_fnSortFlatten:I,_fnSort:ie,_fnSortAria:le,_fnSortListener:se,_fnSortAttachListener:ue,_fnSortingClasses:ce,_fnSortData:fe,_fnSaveState:de,_fnLoadState:he,_fnImplementState:pe,_fnSettingsFromNode:ge,_fnLog:W,_fnMap:F,_fnBindAction:me,_fnCallbackReg:L,_fnCallbackFire:R,_fnLengthOverflow:Se,_fnRenderer:ve,_fnDataSource:E,_fnRowAttributes:vt,_fnExtend:be,_fnCalculateEnd:function(){}}),((P.fn.dataTable=w).$=P).fn.dataTableSettings=w.settings,P.fn.dataTableExt=w.ext,P.fn.DataTable=function(t){return P(this).dataTable(t).api()},P.each(w,function(t,e){P.fn.DataTable[t]=e}),w});

/*! DataTables styling integration
 * ©2018 SpryMedia Ltd - datatables.net/license
 */
!function(t){var o,d;"function"==typeof define&&define.amd?define(["jquery","datatables.net"],function(e){return t(e,window,document)}):"object"==typeof exports?(o=require("jquery"),d=function(e,n){n.fn.dataTable||require("datatables.net")(e,n)},"undefined"==typeof window?module.exports=function(e,n){return e=e||window,n=n||o(e),d(e,n),t(n,0,e.document)}:(d(window,o),module.exports=t(o,window,window.document))):t(jQuery,window,document)}(function(e,n,t,o){"use strict";return e.fn.dataTable});


!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?module.exports=e():"function"==typeof define&&define.amd?define(e):t.Sweetalert2=e()}(this,function(){"use strict";function r(t){return(r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function o(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function i(t,e){for(var n=0;n<e.length;n++){var o=e[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(t,o.key,o)}}function a(t,e,n){return e&&i(t.prototype,e),n&&i(t,n),t}function c(){return(c=Object.assign||function(t){for(var e=1;e<arguments.length;e++){var n=arguments[e];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(t[o]=n[o])}return t}).apply(this,arguments)}function s(t){return(s=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}function u(t,e){return(u=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function l(t,e,n){return(l=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],function(){})),!0}catch(t){return!1}}()?Reflect.construct:function(t,e,n){var o=[null];o.push.apply(o,e);var i=new(Function.bind.apply(t,o));return n&&u(i,n.prototype),i}).apply(null,arguments)}function d(t,e){return!e||"object"!=typeof e&&"function"!=typeof e?function(t){if(void 0===t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return t}(t):e}function p(t,e,n){return(p="undefined"!=typeof Reflect&&Reflect.get?Reflect.get:function(t,e,n){var o=function(t,e){for(;!Object.prototype.hasOwnProperty.call(t,e)&&null!==(t=s(t)););return t}(t,e);if(o){var i=Object.getOwnPropertyDescriptor(o,e);return i.get?i.get.call(n):i.value}})(t,e,n||t)}function f(e){return Object.keys(e).map(function(t){return e[t]})}function m(t){return Array.prototype.slice.call(t)}function h(t){console.error("".concat(N," ").concat(t))}function g(t,e){!function(t){-1===U.indexOf(t)&&(U.push(t),D(t))}('"'.concat(t,'" is deprecated and will be removed in the next major release. Please use "').concat(e,'" instead.'))}function v(t){return t&&Promise.resolve(t)===t}function b(t){return t instanceof Element||function(t){return"object"===r(t)&&t.jquery}(t)}function t(t){var e={};for(var n in t)e[t[n]]="swal2-"+t[n];return e}function y(){return document.body.querySelector(".".concat(z.container))}function w(t){var e=y();return e?e.querySelector(t):null}function e(t){return w(".".concat(t))}function C(){return e(z.popup)}function n(){var t=C();return m(t.querySelectorAll(".".concat(z.icon)))}function k(){var t=n().filter(function(t){return dt(t)});return t.length?t[0]:null}function x(){return e(z.title)}function A(){return e(z.content)}function P(){return e(z.image)}function B(){return e(z["progress-steps"])}function E(){return e(z["validation-message"])}function S(){return w(".".concat(z.actions," .").concat(z.confirm))}function T(){return w(".".concat(z.actions," .").concat(z.cancel))}function L(){return e(z.actions)}function O(){return e(z.header)}function M(){return e(z.footer)}function H(){return e(z["timer-progress-bar"])}function j(){return e(z.close)}function V(){var t=m(C().querySelectorAll('[tabindex]:not([tabindex="-1"]):not([tabindex="0"])')).sort(function(t,e){return t=parseInt(t.getAttribute("tabindex")),(e=parseInt(e.getAttribute("tabindex")))<t?1:t<e?-1:0}),e=m(C().querySelectorAll('\n  a[href],\n  area[href],\n  input:not([disabled]),\n  select:not([disabled]),\n  textarea:not([disabled]),\n  button:not([disabled]),\n  iframe,\n  object,\n  embed,\n  [tabindex="0"],\n  [contenteditable],\n  audio[controls],\n  video[controls],\n  summary\n')).filter(function(t){return"-1"!==t.getAttribute("tabindex")});return function(t){for(var e=[],n=0;n<t.length;n++)-1===e.indexOf(t[n])&&e.push(t[n]);return e}(t.concat(e)).filter(function(t){return dt(t)})}function I(){return!K()&&!document.body.classList.contains(z["no-backdrop"])}function q(t,e){if(!e)return!1;for(var n=e.split(/\s+/),o=0;o<n.length;o++)if(!t.classList.contains(n[o]))return!1;return!0}function R(t,e,n){if(!function(e,n){m(e.classList).forEach(function(t){-1===f(z).indexOf(t)&&-1===f(W).indexOf(t)&&-1===f(n.showClass).indexOf(t)&&e.classList.remove(t)})}(t,e),e.customClass&&e.customClass[n]){if("string"!=typeof e.customClass[n]&&!e.customClass[n].forEach)return D("Invalid type of customClass.".concat(n,'! Expected string or iterable object, got "').concat(r(e.customClass[n]),'"'));st(t,e.customClass[n])}}var N="SweetAlert2:",D=function(t){console.warn("".concat(N," ").concat(t))},U=[],F=function(t){return"function"==typeof t?t():t},_=Object.freeze({cancel:"cancel",backdrop:"backdrop",close:"close",esc:"esc",timer:"timer"}),z=t(["container","shown","height-auto","iosfix","popup","modal","no-backdrop","toast","toast-shown","toast-column","show","hide","close","title","header","content","html-container","actions","confirm","cancel","footer","icon","icon-content","image","input","file","range","select","radio","checkbox","label","textarea","inputerror","validation-message","progress-steps","active-progress-step","progress-step","progress-step-line","loading","styled","top","top-start","top-end","top-left","top-right","center","center-start","center-end","center-left","center-right","bottom","bottom-start","bottom-end","bottom-left","bottom-right","grow-row","grow-column","grow-fullscreen","rtl","timer-progress-bar","scrollbar-measure","icon-success","icon-warning","icon-info","icon-question","icon-error"]),W=t(["success","warning","info","question","error"]),K=function(){return document.body.classList.contains(z["toast-shown"])},Y={previousBodyPadding:null};function Z(t,e){if(!e)return null;switch(e){case"select":case"textarea":case"file":return lt(t,z[e]);case"checkbox":return t.querySelector(".".concat(z.checkbox," input"));case"radio":return t.querySelector(".".concat(z.radio," input:checked"))||t.querySelector(".".concat(z.radio," input:first-child"));case"range":return t.querySelector(".".concat(z.range," input"));default:return lt(t,z.input)}}function Q(t){if(t.focus(),"file"!==t.type){var e=t.value;t.value="",t.value=e}}function $(t,e,n){t&&e&&("string"==typeof e&&(e=e.split(/\s+/).filter(Boolean)),e.forEach(function(e){t.forEach?t.forEach(function(t){n?t.classList.add(e):t.classList.remove(e)}):n?t.classList.add(e):t.classList.remove(e)}))}function J(t,e,n){n||0===parseInt(n)?t.style[e]="number"==typeof n?"".concat(n,"px"):n:t.style.removeProperty(e)}function X(t,e){var n=1<arguments.length&&void 0!==e?e:"flex";t.style.opacity="",t.style.display=n}function G(t){t.style.opacity="",t.style.display="none"}function tt(t,e,n){e?X(t,n):G(t)}function et(t){var e=window.getComputedStyle(t),n=parseFloat(e.getPropertyValue("animation-duration")||"0"),o=parseFloat(e.getPropertyValue("transition-duration")||"0");return 0<n||0<o}function nt(t,e){var n=1<arguments.length&&void 0!==e&&e,o=H();dt(o)&&(n&&(o.style.transition="none",o.style.width="100%"),setTimeout(function(){o.style.transition="width ".concat(t/1e3,"s linear"),o.style.width="0%"},10))}function ot(){return"undefined"==typeof window||"undefined"==typeof document}function it(t){Je.isVisible()&&ct!==t.target.value&&Je.resetValidationMessage(),ct=t.target.value}function rt(t,e){t instanceof HTMLElement?e.appendChild(t):"object"===r(t)?mt(e,t):t&&(e.innerHTML=t)}function at(t,e){var n=L(),o=S(),i=T();e.showConfirmButton||e.showCancelButton||G(n),R(n,e,"actions"),gt(o,"confirm",e),gt(i,"cancel",e),e.buttonsStyling?function(t,e,n){st([t,e],z.styled),n.confirmButtonColor&&(t.style.backgroundColor=n.confirmButtonColor);n.cancelButtonColor&&(e.style.backgroundColor=n.cancelButtonColor);var o=window.getComputedStyle(t).getPropertyValue("background-color");t.style.borderLeftColor=o,t.style.borderRightColor=o}(o,i,e):(ut([o,i],z.styled),o.style.backgroundColor=o.style.borderLeftColor=o.style.borderRightColor="",i.style.backgroundColor=i.style.borderLeftColor=i.style.borderRightColor=""),e.reverseButtons&&o.parentNode.insertBefore(i,o)}var ct,st=function(t,e){$(t,e,!0)},ut=function(t,e){$(t,e,!1)},lt=function(t,e){for(var n=0;n<t.childNodes.length;n++)if(q(t.childNodes[n],e))return t.childNodes[n]},dt=function(t){return!(!t||!(t.offsetWidth||t.offsetHeight||t.getClientRects().length))},pt='\n <div aria-labelledby="'.concat(z.title,'" aria-describedby="').concat(z.content,'" class="').concat(z.popup,'" tabindex="-1">\n   <div class="').concat(z.header,'">\n     <ul class="').concat(z["progress-steps"],'"></ul>\n     <div class="').concat(z.icon," ").concat(W.error,'"></div>\n     <div class="').concat(z.icon," ").concat(W.question,'"></div>\n     <div class="').concat(z.icon," ").concat(W.warning,'"></div>\n     <div class="').concat(z.icon," ").concat(W.info,'"></div>\n     <div class="').concat(z.icon," ").concat(W.success,'"></div>\n     <img class="').concat(z.image,'" />\n     <h2 class="').concat(z.title,'" id="').concat(z.title,'"></h2>\n     <button type="button" class="').concat(z.close,'"></button>\n   </div>\n   <div class="').concat(z.content,'">\n     <div id="').concat(z.content,'" class="').concat(z["html-container"],'"></div>\n     <input class="').concat(z.input,'" />\n     <input type="file" class="').concat(z.file,'" />\n     <div class="').concat(z.range,'">\n       <input type="range" />\n       <output></output>\n     </div>\n     <select class="').concat(z.select,'"></select>\n     <div class="').concat(z.radio,'"></div>\n     <label for="').concat(z.checkbox,'" class="').concat(z.checkbox,'">\n       <input type="checkbox" />\n       <span class="').concat(z.label,'"></span>\n     </label>\n     <textarea class="').concat(z.textarea,'"></textarea>\n     <div class="').concat(z["validation-message"],'" id="').concat(z["validation-message"],'"></div>\n   </div>\n   <div class="').concat(z.actions,'">\n     <button type="button" class="').concat(z.confirm,'">OK</button>\n     <button type="button" class="').concat(z.cancel,'">Cancel</button>\n   </div>\n   <div class="').concat(z.footer,'"></div>\n   <div class="').concat(z["timer-progress-bar"],'"></div>\n </div>\n').replace(/(^|\n)\s*/g,""),ft=function(t){if(!function(){var t=y();t&&(t.parentNode.removeChild(t),ut([document.documentElement,document.body],[z["no-backdrop"],z["toast-shown"],z["has-column"]]))}(),ot())h("SweetAlert2 requires document to initialize");else{var e=document.createElement("div");e.className=z.container,e.innerHTML=pt;var n=function(t){return"string"==typeof t?document.querySelector(t):t}(t.target);n.appendChild(e),function(t){var e=C();e.setAttribute("role",t.toast?"alert":"dialog"),e.setAttribute("aria-live",t.toast?"polite":"assertive"),t.toast||e.setAttribute("aria-modal","true")}(t),function(t){"rtl"===window.getComputedStyle(t).direction&&st(y(),z.rtl)}(n),function(){var t=A(),e=lt(t,z.input),n=lt(t,z.file),o=t.querySelector(".".concat(z.range," input")),i=t.querySelector(".".concat(z.range," output")),r=lt(t,z.select),a=t.querySelector(".".concat(z.checkbox," input")),c=lt(t,z.textarea);e.oninput=it,n.onchange=it,r.onchange=it,a.onchange=it,c.oninput=it,o.oninput=function(t){it(t),i.value=o.value},o.onchange=function(t){it(t),o.nextSibling.value=o.value}}()}},mt=function(t,e){if(t.innerHTML="",0 in e)for(var n=0;n in e;n++)t.appendChild(e[n].cloneNode(!0));else t.appendChild(e.cloneNode(!0))},ht=function(){if(ot())return!1;var t=document.createElement("div"),e={WebkitAnimation:"webkitAnimationEnd",OAnimation:"oAnimationEnd oanimationend",animation:"animationend"};for(var n in e)if(Object.prototype.hasOwnProperty.call(e,n)&&void 0!==t.style[n])return e[n];return!1}();function gt(t,e,n){tt(t,n["show".concat(function(t){return t.charAt(0).toUpperCase()+t.slice(1)}(e),"Button")],"inline-block"),t.innerHTML=n["".concat(e,"ButtonText")],t.setAttribute("aria-label",n["".concat(e,"ButtonAriaLabel")]),t.className=z[e],R(t,n,"".concat(e,"Button")),st(t,n["".concat(e,"ButtonClass")])}function vt(t,e){var n=y();if(n){!function(t,e){"string"==typeof e?t.style.background=e:e||st([document.documentElement,document.body],z["no-backdrop"])}(n,e.backdrop),!e.backdrop&&e.allowOutsideClick&&D('"allowOutsideClick" parameter requires `backdrop` parameter to be set to `true`'),function(t,e){e in z?st(t,z[e]):(D('The "position" parameter is not valid, defaulting to "center"'),st(t,z.center))}(n,e.position),function(t,e){if(e&&"string"==typeof e){var n="grow-".concat(e);n in z&&st(t,z[n])}}(n,e.grow),R(n,e,"container");var o=document.body.getAttribute("data-swal2-queue-step");o&&(n.setAttribute("data-queue-step",o),document.body.removeAttribute("data-swal2-queue-step"))}}function bt(t,e){t.placeholder&&!e.inputPlaceholder||(t.placeholder=e.inputPlaceholder)}var yt={promise:new WeakMap,innerParams:new WeakMap,domCache:new WeakMap},wt=["input","file","range","select","radio","checkbox","textarea"],Ct=function(t){if(!Pt[t.input])return h('Unexpected type of input! Expected "text", "email", "password", "number", "tel", "select", "radio", "checkbox", "textarea", "file" or "url", got "'.concat(t.input,'"'));var e=At(t.input),n=Pt[t.input](e,t);X(n),setTimeout(function(){Q(n)})},kt=function(t,e){var n=Z(A(),t);if(n)for(var o in!function(t){for(var e=0;e<t.attributes.length;e++){var n=t.attributes[e].name;-1===["type","value","style"].indexOf(n)&&t.removeAttribute(n)}}(n),e)"range"===t&&"placeholder"===o||n.setAttribute(o,e[o])},xt=function(t){var e=At(t.input);t.customClass&&st(e,t.customClass.input)},At=function(t){var e=z[t]?z[t]:z.input;return lt(A(),e)},Pt={};Pt.text=Pt.email=Pt.password=Pt.number=Pt.tel=Pt.url=function(t,e){return"string"==typeof e.inputValue||"number"==typeof e.inputValue?t.value=e.inputValue:v(e.inputValue)||D('Unexpected type of inputValue! Expected "string", "number" or "Promise", got "'.concat(r(e.inputValue),'"')),bt(t,e),t.type=e.input,t},Pt.file=function(t,e){return bt(t,e),t},Pt.range=function(t,e){var n=t.querySelector("input"),o=t.querySelector("output");return n.value=e.inputValue,n.type=e.input,o.value=e.inputValue,t},Pt.select=function(t,e){if(t.innerHTML="",e.inputPlaceholder){var n=document.createElement("option");n.innerHTML=e.inputPlaceholder,n.value="",n.disabled=!0,n.selected=!0,t.appendChild(n)}return t},Pt.radio=function(t){return t.innerHTML="",t},Pt.checkbox=function(t,e){var n=Z(A(),"checkbox");return n.value=1,n.id=z.checkbox,n.checked=Boolean(e.inputValue),t.querySelector("span").innerHTML=e.inputPlaceholder,t},Pt.textarea=function(e,t){if(e.value=t.inputValue,bt(e,t),"MutationObserver"in window){var n=parseInt(window.getComputedStyle(C()).width),o=parseInt(window.getComputedStyle(C()).paddingLeft)+parseInt(window.getComputedStyle(C()).paddingRight);new MutationObserver(function(){var t=e.offsetWidth+o;C().style.width=n<t?"".concat(t,"px"):null}).observe(e,{attributes:!0,attributeFilter:["style"]})}return e};function Bt(t,e){var n=A().querySelector("#".concat(z.content));e.html?(rt(e.html,n),X(n,"block")):e.text?(n.textContent=e.text,X(n,"block")):G(n),function(t,o){var i=A(),e=yt.innerParams.get(t),r=!e||o.input!==e.input;wt.forEach(function(t){var e=z[t],n=lt(i,e);kt(t,o.inputAttributes),n.className=e,r&&G(n)}),o.input&&(r&&Ct(o),xt(o))}(t,e),R(A(),e,"content")}function Et(){return y().getAttribute("data-queue-step")}function St(t,i){var r=B();if(!i.progressSteps||0===i.progressSteps.length)return G(r);X(r),r.innerHTML="";var a=parseInt(void 0===i.currentProgressStep?Et():i.currentProgressStep);a>=i.progressSteps.length&&D("Invalid currentProgressStep parameter, it should be less than progressSteps.length (currentProgressStep like JS arrays starts from 0)"),i.progressSteps.forEach(function(t,e){var n=function(t){var e=document.createElement("li");return st(e,z["progress-step"]),e.innerHTML=t,e}(t);if(r.appendChild(n),e===a&&st(n,z["active-progress-step"]),e!==i.progressSteps.length-1){var o=function(t){var e=document.createElement("li");return st(e,z["progress-step-line"]),t.progressStepsDistance&&(e.style.width=t.progressStepsDistance),e}(t);r.appendChild(o)}})}function Tt(t,e){var n=O();R(n,e,"header"),St(0,e),function(t,e){var n=yt.innerParams.get(t);if(n&&e.icon===n.icon&&k())R(k(),e,"icon");else if(Mt(),e.icon)if(-1!==Object.keys(W).indexOf(e.icon)){var o=w(".".concat(z.icon,".").concat(W[e.icon]));X(o),jt(o,e),Ht(),R(o,e,"icon"),st(o,e.showClass.icon)}else h('Unknown icon! Expected "success", "error", "warning", "info" or "question", got "'.concat(e.icon,'"'))}(t,e),function(t,e){var n=P();if(!e.imageUrl)return G(n);X(n),n.setAttribute("src",e.imageUrl),n.setAttribute("alt",e.imageAlt),J(n,"width",e.imageWidth),J(n,"height",e.imageHeight),n.className=z.image,R(n,e,"image")}(0,e),function(t,e){var n=x();tt(n,e.title||e.titleText),e.title&&rt(e.title,n),e.titleText&&(n.innerText=e.titleText),R(n,e,"title")}(0,e),function(t,e){var n=j();n.innerHTML=e.closeButtonHtml,R(n,e,"closeButton"),tt(n,e.showCloseButton),n.setAttribute("aria-label",e.closeButtonAriaLabel)}(0,e)}function Lt(t,e){!function(t,e){var n=C();J(n,"width",e.width),J(n,"padding",e.padding),e.background&&(n.style.background=e.background),qt(n,e)}(0,e),vt(0,e),Tt(t,e),Bt(t,e),at(0,e),function(t,e){var n=M();tt(n,e.footer),e.footer&&rt(e.footer,n),R(n,e,"footer")}(0,e),"function"==typeof e.onRender&&e.onRender(C())}function Ot(){return S()&&S().click()}var Mt=function(){for(var t=n(),e=0;e<t.length;e++)G(t[e])},Ht=function(){for(var t=C(),e=window.getComputedStyle(t).getPropertyValue("background-color"),n=t.querySelectorAll("[class^=swal2-success-circular-line], .swal2-success-fix"),o=0;o<n.length;o++)n[o].style.backgroundColor=e},jt=function(t,e){if(t.innerHTML="",e.iconHtml)t.innerHTML=Vt(e.iconHtml);else if("success"===e.icon)t.innerHTML='\n      <div class="swal2-success-circular-line-left"></div>\n      <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>\n      <div class="swal2-success-ring"></div> <div class="swal2-success-fix"></div>\n      <div class="swal2-success-circular-line-right"></div>\n    ';else if("error"===e.icon)t.innerHTML='\n      <span class="swal2-x-mark">\n        <span class="swal2-x-mark-line-left"></span>\n        <span class="swal2-x-mark-line-right"></span>\n      </span>\n    ';else{t.innerHTML=Vt({question:"?",warning:"!",info:"i"}[e.icon])}},Vt=function(t){return'<div class="'.concat(z["icon-content"],'">').concat(t,"</div>")},It=[],qt=function(t,e){t.className="".concat(z.popup," ").concat(dt(t)?e.showClass.popup:""),e.toast?(st([document.documentElement,document.body],z["toast-shown"]),st(t,z.toast)):st(t,z.modal),R(t,e,"popup"),"string"==typeof e.customClass&&st(t,e.customClass),e.icon&&st(t,z["icon-".concat(e.icon)])};function Rt(){var t=C();t||Je.fire(),t=C();var e=L(),n=S();X(e),X(n,"inline-block"),st([t,e],z.loading),n.disabled=!0,t.setAttribute("data-loading",!0),t.setAttribute("aria-busy",!0),t.focus()}function Nt(){return new Promise(function(t){var e=window.scrollX,n=window.scrollY;zt.restoreFocusTimeout=setTimeout(function(){zt.previousActiveElement&&zt.previousActiveElement.focus?(zt.previousActiveElement.focus(),zt.previousActiveElement=null):document.body&&document.body.focus(),t()},100),void 0!==e&&void 0!==n&&window.scrollTo(e,n)})}function Dt(){if(zt.timeout)return function(){var t=H(),e=parseInt(window.getComputedStyle(t).width);t.style.removeProperty("transition"),t.style.width="100%";var n=parseInt(window.getComputedStyle(t).width),o=parseInt(e/n*100);t.style.removeProperty("transition"),t.style.width="".concat(o,"%")}(),zt.timeout.stop()}function Ut(){if(zt.timeout){var t=zt.timeout.start();return nt(t),t}}function Ft(t){return Object.prototype.hasOwnProperty.call(Wt,t)}function _t(t){return Yt[t]}var zt={},Wt={title:"",titleText:"",text:"",html:"",footer:"",icon:void 0,iconHtml:void 0,toast:!1,animation:!0,showClass:{popup:"swal2-show",backdrop:"swal2-backdrop-show",icon:"swal2-icon-show"},hideClass:{popup:"swal2-hide",backdrop:"swal2-backdrop-hide",icon:"swal2-icon-hide"},customClass:void 0,target:"body",backdrop:!0,heightAuto:!0,allowOutsideClick:!0,allowEscapeKey:!0,allowEnterKey:!0,stopKeydownPropagation:!0,keydownListenerCapture:!1,showConfirmButton:!0,showCancelButton:!1,preConfirm:void 0,confirmButtonText:"OK",confirmButtonAriaLabel:"",confirmButtonColor:void 0,cancelButtonText:"Cancel",cancelButtonAriaLabel:"",cancelButtonColor:void 0,buttonsStyling:!0,reverseButtons:!1,focusConfirm:!0,focusCancel:!1,showCloseButton:!1,closeButtonHtml:"&times;",closeButtonAriaLabel:"Close this dialog",showLoaderOnConfirm:!1,imageUrl:void 0,imageWidth:void 0,imageHeight:void 0,imageAlt:"",timer:void 0,timerProgressBar:!1,width:void 0,padding:void 0,background:void 0,input:void 0,inputPlaceholder:"",inputValue:"",inputOptions:{},inputAutoTrim:!0,inputAttributes:{},inputValidator:void 0,validationMessage:void 0,grow:!1,position:"center",progressSteps:[],currentProgressStep:void 0,progressStepsDistance:void 0,onBeforeOpen:void 0,onOpen:void 0,onRender:void 0,onClose:void 0,onAfterClose:void 0,scrollbarPadding:!0},Kt=["title","titleText","text","html","icon","customClass","showConfirmButton","showCancelButton","confirmButtonText","confirmButtonAriaLabel","confirmButtonColor","cancelButtonText","cancelButtonAriaLabel","cancelButtonColor","buttonsStyling","reverseButtons","imageUrl","imageWidth","imageHeight","imageAlt","progressSteps","currentProgressStep"],Yt={animation:'showClass" and "hideClass'},Zt=["allowOutsideClick","allowEnterKey","backdrop","focusConfirm","focusCancel","heightAuto","keydownListenerCapture"],Qt=Object.freeze({isValidParameter:Ft,isUpdatableParameter:function(t){return-1!==Kt.indexOf(t)},isDeprecatedParameter:_t,argsToParams:function(o){var i={};return"object"!==r(o[0])||b(o[0])?["title","html","icon"].forEach(function(t,e){var n=o[e];"string"==typeof n||b(n)?i[t]=n:void 0!==n&&h("Unexpected type of ".concat(t,'! Expected "string" or "Element", got ').concat(r(n)))}):c(i,o[0]),i},isVisible:function(){return dt(C())},clickConfirm:Ot,clickCancel:function(){return T()&&T().click()},getContainer:y,getPopup:C,getTitle:x,getContent:A,getHtmlContainer:function(){return e(z["html-container"])},getImage:P,getIcon:k,getIcons:n,getCloseButton:j,getActions:L,getConfirmButton:S,getCancelButton:T,getHeader:O,getFooter:M,getFocusableElements:V,getValidationMessage:E,isLoading:function(){return C().hasAttribute("data-loading")},fire:function(){for(var t=arguments.length,e=new Array(t),n=0;n<t;n++)e[n]=arguments[n];return l(this,e)},mixin:function(n){return function(t){function e(){return o(this,e),d(this,s(e).apply(this,arguments))}return function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&u(t,e)}(e,t),a(e,[{key:"_main",value:function(t){return p(s(e.prototype),"_main",this).call(this,c({},n,t))}}]),e}(this)},queue:function(t){var r=this;It=t;function a(t,e){It=[],t(e)}var c=[];return new Promise(function(i){!function e(n,o){n<It.length?(document.body.setAttribute("data-swal2-queue-step",n),r.fire(It[n]).then(function(t){void 0!==t.value?(c.push(t.value),e(n+1,o)):a(i,{dismiss:t.dismiss})})):a(i,{value:c})}(0)})},getQueueStep:Et,insertQueueStep:function(t,e){return e&&e<It.length?It.splice(e,0,t):It.push(t)},deleteQueueStep:function(t){void 0!==It[t]&&It.splice(t,1)},showLoading:Rt,enableLoading:Rt,getTimerLeft:function(){return zt.timeout&&zt.timeout.getTimerLeft()},stopTimer:Dt,resumeTimer:Ut,toggleTimer:function(){var t=zt.timeout;return t&&(t.running?Dt():Ut())},increaseTimer:function(t){if(zt.timeout){var e=zt.timeout.increase(t);return nt(e,!0),e}},isTimerRunning:function(){return zt.timeout&&zt.timeout.isRunning()}});function $t(){var t=yt.innerParams.get(this);if(t){var e=yt.domCache.get(this);t.showConfirmButton||(G(e.confirmButton),t.showCancelButton||G(e.actions)),ut([e.popup,e.actions],z.loading),e.popup.removeAttribute("aria-busy"),e.popup.removeAttribute("data-loading"),e.confirmButton.disabled=!1,e.cancelButton.disabled=!1}}function Jt(){null===Y.previousBodyPadding&&document.body.scrollHeight>window.innerHeight&&(Y.previousBodyPadding=parseInt(window.getComputedStyle(document.body).getPropertyValue("padding-right")),document.body.style.paddingRight="".concat(Y.previousBodyPadding+function(){var t=document.createElement("div");t.className=z["scrollbar-measure"],document.body.appendChild(t);var e=t.getBoundingClientRect().width-t.clientWidth;return document.body.removeChild(t),e}(),"px"))}function Xt(){return!!window.MSInputMethodContext&&!!document.documentMode}function Gt(){var t=y(),e=C();t.style.removeProperty("align-items"),e.offsetTop<0&&(t.style.alignItems="flex-start")}var te=function(){var e,n=y();n.ontouchstart=function(t){e=t.target===n||!function(t){return!!(t.scrollHeight>t.clientHeight)}(n)&&"INPUT"!==t.target.tagName},n.ontouchmove=function(t){e&&(t.preventDefault(),t.stopPropagation())}},ee={swalPromiseResolve:new WeakMap};function ne(t,e,n,o){n?ae(t,o):(Nt().then(function(){return ae(t,o)}),zt.keydownTarget.removeEventListener("keydown",zt.keydownHandler,{capture:zt.keydownListenerCapture}),zt.keydownHandlerAdded=!1),e.parentNode&&e.parentNode.removeChild(e),I()&&(null!==Y.previousBodyPadding&&(document.body.style.paddingRight="".concat(Y.previousBodyPadding,"px"),Y.previousBodyPadding=null),function(){if(q(document.body,z.iosfix)){var t=parseInt(document.body.style.top,10);ut(document.body,z.iosfix),document.body.style.top="",document.body.scrollTop=-1*t}}(),"undefined"!=typeof window&&Xt()&&window.removeEventListener("resize",Gt),m(document.body.children).forEach(function(t){t.hasAttribute("data-previous-aria-hidden")?(t.setAttribute("aria-hidden",t.getAttribute("data-previous-aria-hidden")),t.removeAttribute("data-previous-aria-hidden")):t.removeAttribute("aria-hidden")})),ut([document.documentElement,document.body],[z.shown,z["height-auto"],z["no-backdrop"],z["toast-shown"],z["toast-column"]])}function oe(t){var e=C();if(e){var n=yt.innerParams.get(this);if(n&&!q(e,n.hideClass.popup)){var o=ee.swalPromiseResolve.get(this);ut(e,n.showClass.popup),st(e,n.hideClass.popup);var i=y();ut(i,n.showClass.backdrop),st(i,n.hideClass.backdrop),function(t,e,n){var o=y(),i=ht&&et(e),r=n.onClose,a=n.onAfterClose;if(r!==null&&typeof r==="function"){r(e)}if(i){re(t,e,o,a)}else{ne(t,o,K(),a)}}(this,e,n),o(t||{})}}}function ie(t){for(var e in t)t[e]=new WeakMap}var re=function(t,e,n,o){zt.swalCloseEventFinishedCallback=ne.bind(null,t,n,K(),o),e.addEventListener(ht,function(t){t.target===e&&(zt.swalCloseEventFinishedCallback(),delete zt.swalCloseEventFinishedCallback)})},ae=function(t,e){setTimeout(function(){null!==e&&"function"==typeof e&&e(),C()||function(t){delete t.params,delete zt.keydownHandler,delete zt.keydownTarget,ie(yt),ie(ee)}(t)})};function ce(t,e,n){var o=yt.domCache.get(t);e.forEach(function(t){o[t].disabled=n})}function se(t,e){if(!t)return!1;if("radio"===t.type)for(var n=t.parentNode.parentNode.querySelectorAll("input"),o=0;o<n.length;o++)n[o].disabled=e;else t.disabled=e}var ue=function(){function n(t,e){o(this,n),this.callback=t,this.remaining=e,this.running=!1,this.start()}return a(n,[{key:"start",value:function(){return this.running||(this.running=!0,this.started=new Date,this.id=setTimeout(this.callback,this.remaining)),this.remaining}},{key:"stop",value:function(){return this.running&&(this.running=!1,clearTimeout(this.id),this.remaining-=new Date-this.started),this.remaining}},{key:"increase",value:function(t){var e=this.running;return e&&this.stop(),this.remaining+=t,e&&this.start(),this.remaining}},{key:"getTimerLeft",value:function(){return this.running&&(this.stop(),this.start()),this.remaining}},{key:"isRunning",value:function(){return this.running}}]),n}(),le={email:function(t,e){return/^[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9-]{2,24}$/.test(t)?Promise.resolve():Promise.resolve(e||"Invalid email address")},url:function(t,e){return/^https?:\/\/(www\.)?[-a-zA-Z0-9@:%._+~#=]{2,256}\.[a-z]{2,63}\b([-a-zA-Z0-9@:%_+.~#?&/=]*)$/.test(t)?Promise.resolve():Promise.resolve(e||"Invalid URL")}};function de(t){!function(e){e.inputValidator||Object.keys(le).forEach(function(t){e.input===t&&(e.inputValidator=le[t])})}(t),t.showLoaderOnConfirm&&!t.preConfirm&&D("showLoaderOnConfirm is set to true, but preConfirm is not defined.\nshowLoaderOnConfirm should be used together with preConfirm, see usage example:\nhttps://sweetalert2.github.io/#ajax-request"),t.animation=F(t.animation),function(t){t.target&&("string"!=typeof t.target||document.querySelector(t.target))&&("string"==typeof t.target||t.target.appendChild)||(D('Target parameter is not valid, defaulting to "body"'),t.target="body")}(t),"string"==typeof t.title&&(t.title=t.title.split("\n").join("<br />")),ft(t)}function pe(t,e){t.removeEventListener(ht,pe),e.style.overflowY="auto"}function fe(t){var e=y(),n=C();"function"==typeof t.onBeforeOpen&&t.onBeforeOpen(n),xe(e,n,t),Ce(e,n),I()&&ke(e,t.scrollbarPadding),K()||zt.previousActiveElement||(zt.previousActiveElement=document.activeElement),"function"==typeof t.onOpen&&setTimeout(function(){return t.onOpen(n)})}function me(t,e){"select"===e.input||"radio"===e.input?Ee(t,e):-1!==["text","email","number","tel","textarea"].indexOf(e.input)&&v(e.inputValue)&&Se(t,e)}function he(t,e){t.disableButtons(),e.input?Oe(t,e):Me(t,e,!0)}function ge(t,e){t.disableButtons(),e(_.cancel)}function ve(t,e){t.closePopup({value:e})}function be(e,t,n,o){t.keydownTarget&&t.keydownHandlerAdded&&(t.keydownTarget.removeEventListener("keydown",t.keydownHandler,{capture:t.keydownListenerCapture}),t.keydownHandlerAdded=!1),n.toast||(t.keydownHandler=function(t){return Ve(e,t,n,o)},t.keydownTarget=n.keydownListenerCapture?window:C(),t.keydownListenerCapture=n.keydownListenerCapture,t.keydownTarget.addEventListener("keydown",t.keydownHandler,{capture:t.keydownListenerCapture}),t.keydownHandlerAdded=!0)}function ye(t,e,n){for(var o=V(),i=0;i<o.length;i++)return(e+=n)===o.length?e=0:-1===e&&(e=o.length-1),o[e].focus();C().focus()}function we(t,e,n){e.toast?De(t,e,n):(Fe(t),_e(t),ze(t,e,n))}var Ce=function(e,n){ht&&et(n)?(e.style.overflowY="hidden",n.addEventListener(ht,function(t){t.target===n&&pe.bind(null,n,e)})):e.style.overflowY="auto"},ke=function(t,e){!function(){if((/iPad|iPhone|iPod/.test(navigator.userAgent)&&!window.MSStream||"MacIntel"===navigator.platform&&1<navigator.maxTouchPoints)&&!q(document.body,z.iosfix)){var t=document.body.scrollTop;document.body.style.top="".concat(-1*t,"px"),st(document.body,z.iosfix),te()}}(),"undefined"!=typeof window&&Xt()&&(Gt(),window.addEventListener("resize",Gt)),m(document.body.children).forEach(function(t){t===y()||function(t,e){if("function"==typeof t.contains)return t.contains(e)}(t,y())||(t.hasAttribute("aria-hidden")&&t.setAttribute("data-previous-aria-hidden",t.getAttribute("aria-hidden")),t.setAttribute("aria-hidden","true"))}),e&&Jt(),setTimeout(function(){t.scrollTop=0})},xe=function(t,e,n){st(t,n.showClass.backdrop),X(e),st(e,n.showClass.popup),st([document.documentElement,document.body],z.shown),n.heightAuto&&n.backdrop&&!n.toast&&st([document.documentElement,document.body],z["height-auto"])},Ae=function(t){return t.checked?1:0},Pe=function(t){return t.checked?t.value:null},Be=function(t){return t.files.length?null!==t.getAttribute("multiple")?t.files:t.files[0]:null},Ee=function(e,n){function o(t){return Te[n.input](i,Le(t),n)}var i=A();v(n.inputOptions)?(Rt(),n.inputOptions.then(function(t){e.hideLoading(),o(t)})):"object"===r(n.inputOptions)?o(n.inputOptions):h("Unexpected type of inputOptions! Expected object, Map or Promise, got ".concat(r(n.inputOptions)))},Se=function(e,n){var o=e.getInput();G(o),n.inputValue.then(function(t){o.value="number"===n.input?parseFloat(t)||0:"".concat(t),X(o),o.focus(),e.hideLoading()}).catch(function(t){h("Error in inputValue promise: ".concat(t)),o.value="",X(o),o.focus(),e.hideLoading()})},Te={select:function(t,e,i){var r=lt(t,z.select);e.forEach(function(t){var e=t[0],n=t[1],o=document.createElement("option");o.value=e,o.innerHTML=n,i.inputValue.toString()===e.toString()&&(o.selected=!0),r.appendChild(o)}),r.focus()},radio:function(t,e,a){var c=lt(t,z.radio);e.forEach(function(t){var e=t[0],n=t[1],o=document.createElement("input"),i=document.createElement("label");o.type="radio",o.name=z.radio,o.value=e,a.inputValue.toString()===e.toString()&&(o.checked=!0);var r=document.createElement("span");r.innerHTML=n,r.className=z.label,i.appendChild(o),i.appendChild(r),c.appendChild(i)});var n=c.querySelectorAll("input");n.length&&n[0].focus()}},Le=function(e){var n=[];return"undefined"!=typeof Map&&e instanceof Map?e.forEach(function(t,e){n.push([e,t])}):Object.keys(e).forEach(function(t){n.push([t,e[t]])}),n},Oe=function(e,n){var o=function(t,e){var n=t.getInput();if(!n)return null;switch(e.input){case"checkbox":return Ae(n);case"radio":return Pe(n);case"file":return Be(n);default:return e.inputAutoTrim?n.value.trim():n.value}}(e,n);n.inputValidator?(e.disableInput(),Promise.resolve().then(function(){return n.inputValidator(o,n.validationMessage)}).then(function(t){e.enableButtons(),e.enableInput(),t?e.showValidationMessage(t):Me(e,n,o)})):e.getInput().checkValidity()?Me(e,n,o):(e.enableButtons(),e.showValidationMessage(n.validationMessage))},Me=function(e,t,n){(t.showLoaderOnConfirm&&Rt(),t.preConfirm)?(e.resetValidationMessage(),Promise.resolve().then(function(){return t.preConfirm(n,t.validationMessage)}).then(function(t){dt(E())||!1===t?e.hideLoading():ve(e,void 0===t?n:t)})):ve(e,n)},He=["ArrowLeft","ArrowRight","ArrowUp","ArrowDown","Left","Right","Up","Down"],je=["Escape","Esc"],Ve=function(t,e,n,o){n.stopKeydownPropagation&&e.stopPropagation(),"Enter"===e.key?Ie(t,e,n):"Tab"===e.key?qe(e,n):-1!==He.indexOf(e.key)?Re():-1!==je.indexOf(e.key)&&Ne(e,n,o)},Ie=function(t,e,n){if(!e.isComposing&&e.target&&t.getInput()&&e.target.outerHTML===t.getInput().outerHTML){if(-1!==["textarea","file"].indexOf(n.input))return;Ot(),e.preventDefault()}},qe=function(t){for(var e=t.target,n=V(),o=-1,i=0;i<n.length;i++)if(e===n[i]){o=i;break}t.shiftKey?ye(0,o,-1):ye(0,o,1),t.stopPropagation(),t.preventDefault()},Re=function(){var t=S(),e=T();document.activeElement===t&&dt(e)?e.focus():document.activeElement===e&&dt(t)&&t.focus()},Ne=function(t,e,n){F(e.allowEscapeKey)&&(t.preventDefault(),n(_.esc))},De=function(t,e,n){t.popup.onclick=function(){e.showConfirmButton||e.showCancelButton||e.showCloseButton||e.input||n(_.close)}},Ue=!1,Fe=function(e){e.popup.onmousedown=function(){e.container.onmouseup=function(t){e.container.onmouseup=void 0,t.target===e.container&&(Ue=!0)}}},_e=function(e){e.container.onmousedown=function(){e.popup.onmouseup=function(t){e.popup.onmouseup=void 0,t.target!==e.popup&&!e.popup.contains(t.target)||(Ue=!0)}}},ze=function(e,n,o){e.container.onclick=function(t){Ue?Ue=!1:t.target===e.container&&F(n.allowOutsideClick)&&o(_.backdrop)}};var We=function(t,e,n){var o=H();G(o),e.timer&&(t.timeout=new ue(function(){n("timer"),delete t.timeout},e.timer),e.timerProgressBar&&(X(o),setTimeout(function(){nt(e.timer)})))},Ke=function(t,e){if(!e.toast)return F(e.allowEnterKey)?e.focusCancel&&dt(t.cancelButton)?t.cancelButton.focus():e.focusConfirm&&dt(t.confirmButton)?t.confirmButton.focus():void ye(0,-1,1):Ye()},Ye=function(){document.activeElement&&"function"==typeof document.activeElement.blur&&document.activeElement.blur()};var Ze,Qe=Object.freeze({hideLoading:$t,disableLoading:$t,getInput:function(t){var e=yt.innerParams.get(t||this),n=yt.domCache.get(t||this);return n?Z(n.content,e.input):null},close:oe,closePopup:oe,closeModal:oe,closeToast:oe,enableButtons:function(){ce(this,["confirmButton","cancelButton"],!1)},disableButtons:function(){ce(this,["confirmButton","cancelButton"],!0)},enableInput:function(){return se(this.getInput(),!1)},disableInput:function(){return se(this.getInput(),!0)},showValidationMessage:function(t){var e=yt.domCache.get(this);e.validationMessage.innerHTML=t;var n=window.getComputedStyle(e.popup);e.validationMessage.style.marginLeft="-".concat(n.getPropertyValue("padding-left")),e.validationMessage.style.marginRight="-".concat(n.getPropertyValue("padding-right")),X(e.validationMessage);var o=this.getInput();o&&(o.setAttribute("aria-invalid",!0),o.setAttribute("aria-describedBy",z["validation-message"]),Q(o),st(o,z.inputerror))},resetValidationMessage:function(){var t=yt.domCache.get(this);t.validationMessage&&G(t.validationMessage);var e=this.getInput();e&&(e.removeAttribute("aria-invalid"),e.removeAttribute("aria-describedBy"),ut(e,z.inputerror))},getProgressSteps:function(){return yt.domCache.get(this).progressSteps},_main:function(t){!function(t){for(var e in t)Ft(i=e)||D('Unknown parameter "'.concat(i,'"')),t.toast&&(o=e,-1!==Zt.indexOf(o)&&D('The parameter "'.concat(o,'" is incompatible with toasts'))),_t(n=e)&&g(n,_t(n));var n,o,i}(t),C()&&zt.swalCloseEventFinishedCallback&&(zt.swalCloseEventFinishedCallback(),delete zt.swalCloseEventFinishedCallback),zt.deferDisposalTimer&&(clearTimeout(zt.deferDisposalTimer),delete zt.deferDisposalTimer);var e=function(t){var e=c({},Wt.showClass,t.showClass),n=c({},Wt.hideClass,t.hideClass),o=c({},Wt,t);if(o.showClass=e,o.hideClass=n,t.animation===false){o.showClass={popup:"",backdrop:"swal2-backdrop-show swal2-noanimation"};o.hideClass={}}return o}(t);de(e),Object.freeze(e),zt.timeout&&(zt.timeout.stop(),delete zt.timeout),clearTimeout(zt.restoreFocusTimeout);var n=function(t){var e={popup:C(),container:y(),content:A(),actions:L(),confirmButton:S(),cancelButton:T(),closeButton:j(),validationMessage:E(),progressSteps:B()};return yt.domCache.set(t,e),e}(this);return Lt(this,e),yt.innerParams.set(this,e),function(n,o,i){return new Promise(function(t){var e=function t(e){n.closePopup({dismiss:e})};ee.swalPromiseResolve.set(n,t);We(zt,i,e);o.confirmButton.onclick=function(){return he(n,i)};o.cancelButton.onclick=function(){return ge(n,e)};o.closeButton.onclick=function(){return e(_.close)};we(o,i,e);be(n,zt,i,e);if(i.toast&&(i.input||i.footer||i.showCloseButton)){st(document.body,z["toast-column"])}else{ut(document.body,z["toast-column"])}me(n,i);fe(i);Ke(o,i);o.container.scrollTop=0})}(this,n,e)},update:function(e){var t=C(),n=yt.innerParams.get(this);if(!t||q(t,n.hideClass.popup))return D("You're trying to update the closed or closing popup, that won't work. Use the update() method in preConfirm parameter or show a new popup.");var o={};Object.keys(e).forEach(function(t){Je.isUpdatableParameter(t)?o[t]=e[t]:D('Invalid parameter to update: "'.concat(t,'". Updatable params are listed here: https://github.com/sweetalert2/sweetalert2/blob/master/src/utils/params.js'))});var i=c({},n,o);Lt(this,i),yt.innerParams.set(this,i),Object.defineProperties(this,{params:{value:c({},this.params,e),writable:!1,enumerable:!0}})}});function $e(){if("undefined"!=typeof window){"undefined"==typeof Promise&&h("This package requires a Promise library, please include a shim to enable it in this browser (See: https://github.com/sweetalert2/sweetalert2/wiki/Migration-from-SweetAlert-to-SweetAlert2#1-ie-support)"),Ze=this;for(var t=arguments.length,e=new Array(t),n=0;n<t;n++)e[n]=arguments[n];var o=Object.freeze(this.constructor.argsToParams(e));Object.defineProperties(this,{params:{value:o,writable:!1,enumerable:!0,configurable:!0}});var i=this._main(this.params);yt.promise.set(this,i)}}$e.prototype.then=function(t){return yt.promise.get(this).then(t)},$e.prototype.finally=function(t){return yt.promise.get(this).finally(t)},c($e.prototype,Qe),c($e,Qt),Object.keys(Qe).forEach(function(e){$e[e]=function(){var t;if(Ze)return(t=Ze)[e].apply(t,arguments)}}),$e.DismissReason=_,$e.version="9.5.3";var Je=$e;return Je.default=Je}),void 0!==this&&this.Sweetalert2&&(this.swal=this.sweetAlert=this.Swal=this.SweetAlert=this.Sweetalert2);
"undefined"!=typeof document&&function(e,t){var n=e.createElement("style");if(e.getElementsByTagName("head")[0].appendChild(n),n.styleSheet)n.styleSheet.disabled||(n.styleSheet.cssText=t);else try{n.innerHTML=t}catch(e){n.innerText=t}}(document,".swal2-popup.swal2-toast{-webkit-box-orient:horizontal;-webkit-box-direction:normal;flex-direction:row;-webkit-box-align:center;align-items:center;width:auto;padding:.625em;overflow-y:hidden;background:#fff;box-shadow:0 0 .625em #d9d9d9}.swal2-popup.swal2-toast .swal2-header{-webkit-box-orient:horizontal;-webkit-box-direction:normal;flex-direction:row}.swal2-popup.swal2-toast .swal2-title{-webkit-box-flex:1;flex-grow:1;-webkit-box-pack:start;justify-content:flex-start;margin:0 .6em;font-size:1em}.swal2-popup.swal2-toast .swal2-footer{margin:.5em 0 0;padding:.5em 0 0;font-size:.8em}.swal2-popup.swal2-toast .swal2-close{position:static;width:.8em;height:.8em;line-height:.8}.swal2-popup.swal2-toast .swal2-content{-webkit-box-pack:start;justify-content:flex-start;font-size:1em}.swal2-popup.swal2-toast .swal2-icon{width:2em;min-width:2em;height:2em;margin:0}.swal2-popup.swal2-toast .swal2-icon .swal2-icon-content{display:-webkit-box;display:flex;-webkit-box-align:center;align-items:center;font-size:1.8em;font-weight:700}@media all and (-ms-high-contrast:none),(-ms-high-contrast:active){.swal2-popup.swal2-toast .swal2-icon .swal2-icon-content{font-size:.25em}}.swal2-popup.swal2-toast .swal2-icon.swal2-success .swal2-success-ring{width:2em;height:2em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line]{top:.875em;width:1.375em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left]{left:.3125em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right]{right:.3125em}.swal2-popup.swal2-toast .swal2-actions{flex-basis:auto!important;width:auto;height:auto;margin:0 .3125em}.swal2-popup.swal2-toast .swal2-styled{margin:0 .3125em;padding:.3125em .625em;font-size:1em}.swal2-popup.swal2-toast .swal2-styled:focus{box-shadow:0 0 0 1px #fff,0 0 0 3px rgba(50,100,150,.4)}.swal2-popup.swal2-toast .swal2-success{border-color:#a5dc86}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line]{position:absolute;width:1.6em;height:3em;-webkit-transform:rotate(45deg);transform:rotate(45deg);border-radius:50%}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=left]{top:-.8em;left:-.5em;-webkit-transform:rotate(-45deg);transform:rotate(-45deg);-webkit-transform-origin:2em 2em;transform-origin:2em 2em;border-radius:4em 0 0 4em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=right]{top:-.25em;left:.9375em;-webkit-transform-origin:0 1.5em;transform-origin:0 1.5em;border-radius:0 4em 4em 0}.swal2-popup.swal2-toast .swal2-success .swal2-success-ring{width:2em;height:2em}.swal2-popup.swal2-toast .swal2-success .swal2-success-fix{top:0;left:.4375em;width:.4375em;height:2.6875em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line]{height:.3125em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=tip]{top:1.125em;left:.1875em;width:.75em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=long]{top:.9375em;right:.1875em;width:1.375em}.swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-tip{-webkit-animation:swal2-toast-animate-success-line-tip .75s;animation:swal2-toast-animate-success-line-tip .75s}.swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-long{-webkit-animation:swal2-toast-animate-success-line-long .75s;animation:swal2-toast-animate-success-line-long .75s}.swal2-popup.swal2-toast.swal2-show{-webkit-animation:swal2-toast-show .5s;animation:swal2-toast-show .5s}.swal2-popup.swal2-toast.swal2-hide{-webkit-animation:swal2-toast-hide .1s forwards;animation:swal2-toast-hide .1s forwards}.swal2-container{display:-webkit-box;display:flex;position:fixed;z-index:1060;top:0;right:0;bottom:0;left:0;-webkit-box-orient:horizontal;-webkit-box-direction:normal;flex-direction:row;-webkit-box-align:center;align-items:center;-webkit-box-pack:center;justify-content:center;padding:.625em;overflow-x:hidden;-webkit-transition:background-color .1s;transition:background-color .1s;-webkit-overflow-scrolling:touch}.swal2-container.swal2-backdrop-show{background:rgba(0,0,0,.4)}.swal2-container.swal2-backdrop-hide{background:0 0!important}.swal2-container.swal2-top{-webkit-box-align:start;align-items:flex-start}.swal2-container.swal2-top-left,.swal2-container.swal2-top-start{-webkit-box-align:start;align-items:flex-start;-webkit-box-pack:start;justify-content:flex-start}.swal2-container.swal2-top-end,.swal2-container.swal2-top-right{-webkit-box-align:start;align-items:flex-start;-webkit-box-pack:end;justify-content:flex-end}.swal2-container.swal2-center{-webkit-box-align:center;align-items:center}.swal2-container.swal2-center-left,.swal2-container.swal2-center-start{-webkit-box-align:center;align-items:center;-webkit-box-pack:start;justify-content:flex-start}.swal2-container.swal2-center-end,.swal2-container.swal2-center-right{-webkit-box-align:center;align-items:center;-webkit-box-pack:end;justify-content:flex-end}.swal2-container.swal2-bottom{-webkit-box-align:end;align-items:flex-end}.swal2-container.swal2-bottom-left,.swal2-container.swal2-bottom-start{-webkit-box-align:end;align-items:flex-end;-webkit-box-pack:start;justify-content:flex-start}.swal2-container.swal2-bottom-end,.swal2-container.swal2-bottom-right{-webkit-box-align:end;align-items:flex-end;-webkit-box-pack:end;justify-content:flex-end}.swal2-container.swal2-bottom-end>:first-child,.swal2-container.swal2-bottom-left>:first-child,.swal2-container.swal2-bottom-right>:first-child,.swal2-container.swal2-bottom-start>:first-child,.swal2-container.swal2-bottom>:first-child{margin-top:auto}.swal2-container.swal2-grow-fullscreen>.swal2-modal{display:-webkit-box!important;display:flex!important;-webkit-box-flex:1;flex:1;align-self:stretch;-webkit-box-pack:center;justify-content:center}.swal2-container.swal2-grow-row>.swal2-modal{display:-webkit-box!important;display:flex!important;-webkit-box-flex:1;flex:1;align-content:center;-webkit-box-pack:center;justify-content:center}.swal2-container.swal2-grow-column{-webkit-box-flex:1;flex:1;-webkit-box-orient:vertical;-webkit-box-direction:normal;flex-direction:column}.swal2-container.swal2-grow-column.swal2-bottom,.swal2-container.swal2-grow-column.swal2-center,.swal2-container.swal2-grow-column.swal2-top{-webkit-box-align:center;align-items:center}.swal2-container.swal2-grow-column.swal2-bottom-left,.swal2-container.swal2-grow-column.swal2-bottom-start,.swal2-container.swal2-grow-column.swal2-center-left,.swal2-container.swal2-grow-column.swal2-center-start,.swal2-container.swal2-grow-column.swal2-top-left,.swal2-container.swal2-grow-column.swal2-top-start{-webkit-box-align:start;align-items:flex-start}.swal2-container.swal2-grow-column.swal2-bottom-end,.swal2-container.swal2-grow-column.swal2-bottom-right,.swal2-container.swal2-grow-column.swal2-center-end,.swal2-container.swal2-grow-column.swal2-center-right,.swal2-container.swal2-grow-column.swal2-top-end,.swal2-container.swal2-grow-column.swal2-top-right{-webkit-box-align:end;align-items:flex-end}.swal2-container.swal2-grow-column>.swal2-modal{display:-webkit-box!important;display:flex!important;-webkit-box-flex:1;flex:1;align-content:center;-webkit-box-pack:center;justify-content:center}.swal2-container:not(.swal2-top):not(.swal2-top-start):not(.swal2-top-end):not(.swal2-top-left):not(.swal2-top-right):not(.swal2-center-start):not(.swal2-center-end):not(.swal2-center-left):not(.swal2-center-right):not(.swal2-bottom):not(.swal2-bottom-start):not(.swal2-bottom-end):not(.swal2-bottom-left):not(.swal2-bottom-right):not(.swal2-grow-fullscreen)>.swal2-modal{margin:auto}@media all and (-ms-high-contrast:none),(-ms-high-contrast:active){.swal2-container .swal2-modal{margin:0!important}}.swal2-popup{display:none;position:relative;box-sizing:border-box;-webkit-box-orient:vertical;-webkit-box-direction:normal;flex-direction:column;-webkit-box-pack:center;justify-content:center;width:32em;max-width:100%;padding:1.25em;border:none;border-radius:.3125em;background:#fff;font-family:inherit;font-size:1rem}.swal2-popup:focus{outline:0}.swal2-popup.swal2-loading{overflow-y:hidden}.swal2-header{display:-webkit-box;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;flex-direction:column;-webkit-box-align:center;align-items:center}.swal2-title{position:relative;max-width:100%;margin:0 0 .4em;padding:0;color:#595959;font-size:1.875em;font-weight:600;text-align:center;text-transform:none;word-wrap:break-word}.swal2-actions{display:-webkit-box;display:flex;z-index:1;flex-wrap:wrap;-webkit-box-align:center;align-items:center;-webkit-box-pack:center;justify-content:center;width:100%;margin:1.25em auto 0}.swal2-actions:not(.swal2-loading) .swal2-styled[disabled]{opacity:.4}.swal2-actions:not(.swal2-loading) .swal2-styled:hover{background-image:-webkit-gradient(linear,left top,left bottom,from(rgba(0,0,0,.1)),to(rgba(0,0,0,.1)));background-image:linear-gradient(rgba(0,0,0,.1),rgba(0,0,0,.1))}.swal2-actions:not(.swal2-loading) .swal2-styled:active{background-image:-webkit-gradient(linear,left top,left bottom,from(rgba(0,0,0,.2)),to(rgba(0,0,0,.2)));background-image:linear-gradient(rgba(0,0,0,.2),rgba(0,0,0,.2))}.swal2-actions.swal2-loading .swal2-styled.swal2-confirm{box-sizing:border-box;width:2.5em;height:2.5em;margin:.46875em;padding:0;-webkit-animation:swal2-rotate-loading 1.5s linear 0s infinite normal;animation:swal2-rotate-loading 1.5s linear 0s infinite normal;border:.25em solid transparent;border-radius:100%;border-color:transparent;background-color:transparent!important;color:transparent;cursor:default;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.swal2-actions.swal2-loading .swal2-styled.swal2-cancel{margin-right:30px;margin-left:30px}.swal2-actions.swal2-loading :not(.swal2-styled).swal2-confirm::after{content:\"\";display:inline-block;width:15px;height:15px;margin-left:5px;-webkit-animation:swal2-rotate-loading 1.5s linear 0s infinite normal;animation:swal2-rotate-loading 1.5s linear 0s infinite normal;border:3px solid #999;border-radius:50%;border-right-color:transparent;box-shadow:1px 1px 1px #fff}.swal2-styled{margin:.3125em;padding:.625em 2em;box-shadow:none;font-weight:500}.swal2-styled:not([disabled]){cursor:pointer}.swal2-styled.swal2-confirm{border:0;border-radius:.25em;background:initial;background-color:#3085d6;color:#fff;font-size:1.0625em}.swal2-styled.swal2-cancel{border:0;border-radius:.25em;background:initial;background-color:#aaa;color:#fff;font-size:1.0625em}.swal2-styled:focus{outline:0;box-shadow:0 0 0 1px #fff,0 0 0 3px rgba(50,100,150,.4)}.swal2-styled::-moz-focus-inner{border:0}.swal2-footer{-webkit-box-pack:center;justify-content:center;margin:1.25em 0 0;padding:1em 0 0;border-top:1px solid #eee;color:#545454;font-size:1em}.swal2-timer-progress-bar{position:absolute;bottom:0;left:0;width:100%;height:.25em;background:rgba(0,0,0,.2)}.swal2-image{max-width:100%;margin:1.25em auto}.swal2-close{position:absolute;z-index:2;top:0;right:0;-webkit-box-pack:center;justify-content:center;width:1.2em;height:1.2em;padding:0;overflow:hidden;-webkit-transition:color .1s ease-out;transition:color .1s ease-out;border:none;border-radius:0;outline:initial;background:0 0;color:#ccc;font-family:serif;font-size:2.5em;line-height:1.2;cursor:pointer}.swal2-close:hover{-webkit-transform:none;transform:none;background:0 0;color:#f27474}.swal2-close::-moz-focus-inner{border:0}.swal2-content{z-index:1;-webkit-box-pack:center;justify-content:center;margin:0;padding:0;color:#545454;font-size:1.125em;font-weight:400;line-height:normal;text-align:center;word-wrap:break-word}.swal2-checkbox,.swal2-file,.swal2-input,.swal2-radio,.swal2-select,.swal2-textarea{margin:1em auto}.swal2-file,.swal2-input,.swal2-textarea{box-sizing:border-box;width:100%;-webkit-transition:border-color .3s,box-shadow .3s;transition:border-color .3s,box-shadow .3s;border:1px solid #d9d9d9;border-radius:.1875em;background:inherit;box-shadow:inset 0 1px 1px rgba(0,0,0,.06);color:inherit;font-size:1.125em}.swal2-file.swal2-inputerror,.swal2-input.swal2-inputerror,.swal2-textarea.swal2-inputerror{border-color:#f27474!important;box-shadow:0 0 2px #f27474!important}.swal2-file:focus,.swal2-input:focus,.swal2-textarea:focus{border:1px solid #b4dbed;outline:0;box-shadow:0 0 3px #c4e6f5}.swal2-file::-webkit-input-placeholder,.swal2-input::-webkit-input-placeholder,.swal2-textarea::-webkit-input-placeholder{color:#ccc}.swal2-file::-moz-placeholder,.swal2-input::-moz-placeholder,.swal2-textarea::-moz-placeholder{color:#ccc}.swal2-file:-ms-input-placeholder,.swal2-input:-ms-input-placeholder,.swal2-textarea:-ms-input-placeholder{color:#ccc}.swal2-file::-ms-input-placeholder,.swal2-input::-ms-input-placeholder,.swal2-textarea::-ms-input-placeholder{color:#ccc}.swal2-file::placeholder,.swal2-input::placeholder,.swal2-textarea::placeholder{color:#ccc}.swal2-range{margin:1em auto;background:#fff}.swal2-range input{width:80%}.swal2-range output{width:20%;color:inherit;font-weight:600;text-align:center}.swal2-range input,.swal2-range output{height:2.625em;padding:0;font-size:1.125em;line-height:2.625em}.swal2-input{height:2.625em;padding:0 .75em}.swal2-input[type=number]{max-width:10em}.swal2-file{background:inherit;font-size:1.125em}.swal2-textarea{height:6.75em;padding:.75em}.swal2-select{min-width:50%;max-width:100%;padding:.375em .625em;background:inherit;color:inherit;font-size:1.125em}.swal2-checkbox,.swal2-radio{-webkit-box-align:center;align-items:center;-webkit-box-pack:center;justify-content:center;background:#fff;color:inherit}.swal2-checkbox label,.swal2-radio label{margin:0 .6em;font-size:1.125em}.swal2-checkbox input,.swal2-radio input{margin:0 .4em}.swal2-validation-message{display:none;-webkit-box-align:center;align-items:center;-webkit-box-pack:center;justify-content:center;padding:.625em;overflow:hidden;background:#f0f0f0;color:#666;font-size:1em;font-weight:300}.swal2-validation-message::before{content:\"!\";display:inline-block;width:1.5em;min-width:1.5em;height:1.5em;margin:0 .625em;border-radius:50%;background-color:#f27474;color:#fff;font-weight:600;line-height:1.5em;text-align:center}.swal2-icon{position:relative;box-sizing:content-box;-webkit-box-pack:center;justify-content:center;width:5em;height:5em;margin:1.25em auto 1.875em;border:.25em solid transparent;border-radius:50%;font-family:inherit;line-height:5em;cursor:default;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.swal2-icon .swal2-icon-content{display:-webkit-box;display:flex;-webkit-box-align:center;align-items:center;font-size:3.75em}.swal2-icon.swal2-error{border-color:#f27474;color:#f27474}.swal2-icon.swal2-error .swal2-x-mark{position:relative;-webkit-box-flex:1;flex-grow:1}.swal2-icon.swal2-error [class^=swal2-x-mark-line]{display:block;position:absolute;top:2.3125em;width:2.9375em;height:.3125em;border-radius:.125em;background-color:#f27474}.swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left]{left:1.0625em;-webkit-transform:rotate(45deg);transform:rotate(45deg)}.swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right]{right:1em;-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}.swal2-icon.swal2-error.swal2-icon-show{-webkit-animation:swal2-animate-error-icon .5s;animation:swal2-animate-error-icon .5s}.swal2-icon.swal2-error.swal2-icon-show .swal2-x-mark{-webkit-animation:swal2-animate-error-x-mark .5s;animation:swal2-animate-error-x-mark .5s}.swal2-icon.swal2-warning{border-color:#facea8;color:#f8bb86}.swal2-icon.swal2-info{border-color:#9de0f6;color:#3fc3ee}.swal2-icon.swal2-question{border-color:#c9dae1;color:#87adbd}.swal2-icon.swal2-success{border-color:#a5dc86;color:#a5dc86}.swal2-icon.swal2-success [class^=swal2-success-circular-line]{position:absolute;width:3.75em;height:7.5em;-webkit-transform:rotate(45deg);transform:rotate(45deg);border-radius:50%}.swal2-icon.swal2-success [class^=swal2-success-circular-line][class$=left]{top:-.4375em;left:-2.0635em;-webkit-transform:rotate(-45deg);transform:rotate(-45deg);-webkit-transform-origin:3.75em 3.75em;transform-origin:3.75em 3.75em;border-radius:7.5em 0 0 7.5em}.swal2-icon.swal2-success [class^=swal2-success-circular-line][class$=right]{top:-.6875em;left:1.875em;-webkit-transform:rotate(-45deg);transform:rotate(-45deg);-webkit-transform-origin:0 3.75em;transform-origin:0 3.75em;border-radius:0 7.5em 7.5em 0}.swal2-icon.swal2-success .swal2-success-ring{position:absolute;z-index:2;top:-.25em;left:-.25em;box-sizing:content-box;width:100%;height:100%;border:.25em solid rgba(165,220,134,.3);border-radius:50%}.swal2-icon.swal2-success .swal2-success-fix{position:absolute;z-index:1;top:.5em;left:1.625em;width:.4375em;height:5.625em;-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}.swal2-icon.swal2-success [class^=swal2-success-line]{display:block;position:absolute;z-index:2;height:.3125em;border-radius:.125em;background-color:#a5dc86}.swal2-icon.swal2-success [class^=swal2-success-line][class$=tip]{top:2.875em;left:.875em;width:1.5625em;-webkit-transform:rotate(45deg);transform:rotate(45deg)}.swal2-icon.swal2-success [class^=swal2-success-line][class$=long]{top:2.375em;right:.5em;width:2.9375em;-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}.swal2-icon.swal2-success.swal2-icon-show .swal2-success-line-tip{-webkit-animation:swal2-animate-success-line-tip .75s;animation:swal2-animate-success-line-tip .75s}.swal2-icon.swal2-success.swal2-icon-show .swal2-success-line-long{-webkit-animation:swal2-animate-success-line-long .75s;animation:swal2-animate-success-line-long .75s}.swal2-icon.swal2-success.swal2-icon-show .swal2-success-circular-line-right{-webkit-animation:swal2-rotate-success-circular-line 4.25s ease-in;animation:swal2-rotate-success-circular-line 4.25s ease-in}.swal2-progress-steps{-webkit-box-align:center;align-items:center;margin:0 0 1.25em;padding:0;background:inherit;font-weight:600}.swal2-progress-steps li{display:inline-block;position:relative}.swal2-progress-steps .swal2-progress-step{z-index:20;width:2em;height:2em;border-radius:2em;background:#3085d6;color:#fff;line-height:2em;text-align:center}.swal2-progress-steps .swal2-progress-step.swal2-active-progress-step{background:#3085d6}.swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step{background:#add8e6;color:#fff}.swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step-line{background:#add8e6}.swal2-progress-steps .swal2-progress-step-line{z-index:10;width:2.5em;height:.4em;margin:0 -1px;background:#3085d6}[class^=swal2]{-webkit-tap-highlight-color:transparent}.swal2-show{-webkit-animation:swal2-show .3s;animation:swal2-show .3s}.swal2-hide{-webkit-animation:swal2-hide .15s forwards;animation:swal2-hide .15s forwards}.swal2-noanimation{-webkit-transition:none;transition:none}.swal2-scrollbar-measure{position:absolute;top:-9999px;width:50px;height:50px;overflow:scroll}.swal2-rtl .swal2-close{right:auto;left:0}.swal2-rtl .swal2-timer-progress-bar{right:0;left:auto}@supports (-ms-accelerator:true){.swal2-range input{width:100%!important}.swal2-range output{display:none}}@media all and (-ms-high-contrast:none),(-ms-high-contrast:active){.swal2-range input{width:100%!important}.swal2-range output{display:none}}@-moz-document url-prefix(){.swal2-close:focus{outline:2px solid rgba(50,100,150,.4)}}@-webkit-keyframes swal2-toast-show{0%{-webkit-transform:translateY(-.625em) rotateZ(2deg);transform:translateY(-.625em) rotateZ(2deg)}33%{-webkit-transform:translateY(0) rotateZ(-2deg);transform:translateY(0) rotateZ(-2deg)}66%{-webkit-transform:translateY(.3125em) rotateZ(2deg);transform:translateY(.3125em) rotateZ(2deg)}100%{-webkit-transform:translateY(0) rotateZ(0);transform:translateY(0) rotateZ(0)}}@keyframes swal2-toast-show{0%{-webkit-transform:translateY(-.625em) rotateZ(2deg);transform:translateY(-.625em) rotateZ(2deg)}33%{-webkit-transform:translateY(0) rotateZ(-2deg);transform:translateY(0) rotateZ(-2deg)}66%{-webkit-transform:translateY(.3125em) rotateZ(2deg);transform:translateY(.3125em) rotateZ(2deg)}100%{-webkit-transform:translateY(0) rotateZ(0);transform:translateY(0) rotateZ(0)}}@-webkit-keyframes swal2-toast-hide{100%{-webkit-transform:rotateZ(1deg);transform:rotateZ(1deg);opacity:0}}@keyframes swal2-toast-hide{100%{-webkit-transform:rotateZ(1deg);transform:rotateZ(1deg);opacity:0}}@-webkit-keyframes swal2-toast-animate-success-line-tip{0%{top:.5625em;left:.0625em;width:0}54%{top:.125em;left:.125em;width:0}70%{top:.625em;left:-.25em;width:1.625em}84%{top:1.0625em;left:.75em;width:.5em}100%{top:1.125em;left:.1875em;width:.75em}}@keyframes swal2-toast-animate-success-line-tip{0%{top:.5625em;left:.0625em;width:0}54%{top:.125em;left:.125em;width:0}70%{top:.625em;left:-.25em;width:1.625em}84%{top:1.0625em;left:.75em;width:.5em}100%{top:1.125em;left:.1875em;width:.75em}}@-webkit-keyframes swal2-toast-animate-success-line-long{0%{top:1.625em;right:1.375em;width:0}65%{top:1.25em;right:.9375em;width:0}84%{top:.9375em;right:0;width:1.125em}100%{top:.9375em;right:.1875em;width:1.375em}}@keyframes swal2-toast-animate-success-line-long{0%{top:1.625em;right:1.375em;width:0}65%{top:1.25em;right:.9375em;width:0}84%{top:.9375em;right:0;width:1.125em}100%{top:.9375em;right:.1875em;width:1.375em}}@-webkit-keyframes swal2-show{0%{-webkit-transform:scale(.7);transform:scale(.7)}45%{-webkit-transform:scale(1.05);transform:scale(1.05)}80%{-webkit-transform:scale(.95);transform:scale(.95)}100%{-webkit-transform:scale(1);transform:scale(1)}}@keyframes swal2-show{0%{-webkit-transform:scale(.7);transform:scale(.7)}45%{-webkit-transform:scale(1.05);transform:scale(1.05)}80%{-webkit-transform:scale(.95);transform:scale(.95)}100%{-webkit-transform:scale(1);transform:scale(1)}}@-webkit-keyframes swal2-hide{0%{-webkit-transform:scale(1);transform:scale(1);opacity:1}100%{-webkit-transform:scale(.5);transform:scale(.5);opacity:0}}@keyframes swal2-hide{0%{-webkit-transform:scale(1);transform:scale(1);opacity:1}100%{-webkit-transform:scale(.5);transform:scale(.5);opacity:0}}@-webkit-keyframes swal2-animate-success-line-tip{0%{top:1.1875em;left:.0625em;width:0}54%{top:1.0625em;left:.125em;width:0}70%{top:2.1875em;left:-.375em;width:3.125em}84%{top:3em;left:1.3125em;width:1.0625em}100%{top:2.8125em;left:.875em;width:1.5625em}}@keyframes swal2-animate-success-line-tip{0%{top:1.1875em;left:.0625em;width:0}54%{top:1.0625em;left:.125em;width:0}70%{top:2.1875em;left:-.375em;width:3.125em}84%{top:3em;left:1.3125em;width:1.0625em}100%{top:2.8125em;left:.875em;width:1.5625em}}@-webkit-keyframes swal2-animate-success-line-long{0%{top:3.375em;right:2.875em;width:0}65%{top:3.375em;right:2.875em;width:0}84%{top:2.1875em;right:0;width:3.4375em}100%{top:2.375em;right:.5em;width:2.9375em}}@keyframes swal2-animate-success-line-long{0%{top:3.375em;right:2.875em;width:0}65%{top:3.375em;right:2.875em;width:0}84%{top:2.1875em;right:0;width:3.4375em}100%{top:2.375em;right:.5em;width:2.9375em}}@-webkit-keyframes swal2-rotate-success-circular-line{0%{-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}5%{-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}12%{-webkit-transform:rotate(-405deg);transform:rotate(-405deg)}100%{-webkit-transform:rotate(-405deg);transform:rotate(-405deg)}}@keyframes swal2-rotate-success-circular-line{0%{-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}5%{-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}12%{-webkit-transform:rotate(-405deg);transform:rotate(-405deg)}100%{-webkit-transform:rotate(-405deg);transform:rotate(-405deg)}}@-webkit-keyframes swal2-animate-error-x-mark{0%{margin-top:1.625em;-webkit-transform:scale(.4);transform:scale(.4);opacity:0}50%{margin-top:1.625em;-webkit-transform:scale(.4);transform:scale(.4);opacity:0}80%{margin-top:-.375em;-webkit-transform:scale(1.15);transform:scale(1.15)}100%{margin-top:0;-webkit-transform:scale(1);transform:scale(1);opacity:1}}@keyframes swal2-animate-error-x-mark{0%{margin-top:1.625em;-webkit-transform:scale(.4);transform:scale(.4);opacity:0}50%{margin-top:1.625em;-webkit-transform:scale(.4);transform:scale(.4);opacity:0}80%{margin-top:-.375em;-webkit-transform:scale(1.15);transform:scale(1.15)}100%{margin-top:0;-webkit-transform:scale(1);transform:scale(1);opacity:1}}@-webkit-keyframes swal2-animate-error-icon{0%{-webkit-transform:rotateX(100deg);transform:rotateX(100deg);opacity:0}100%{-webkit-transform:rotateX(0);transform:rotateX(0);opacity:1}}@keyframes swal2-animate-error-icon{0%{-webkit-transform:rotateX(100deg);transform:rotateX(100deg);opacity:0}100%{-webkit-transform:rotateX(0);transform:rotateX(0);opacity:1}}@-webkit-keyframes swal2-rotate-loading{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes swal2-rotate-loading{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown){overflow:hidden}body.swal2-height-auto{height:auto!important}body.swal2-no-backdrop .swal2-container{top:auto;right:auto;bottom:auto;left:auto;max-width:calc(100% - .625em * 2);background-color:transparent!important}body.swal2-no-backdrop .swal2-container>.swal2-modal{box-shadow:0 0 10px rgba(0,0,0,.4)}body.swal2-no-backdrop .swal2-container.swal2-top{top:0;left:50%;-webkit-transform:translateX(-50%);transform:translateX(-50%)}body.swal2-no-backdrop .swal2-container.swal2-top-left,body.swal2-no-backdrop .swal2-container.swal2-top-start{top:0;left:0}body.swal2-no-backdrop .swal2-container.swal2-top-end,body.swal2-no-backdrop .swal2-container.swal2-top-right{top:0;right:0}body.swal2-no-backdrop .swal2-container.swal2-center{top:50%;left:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}body.swal2-no-backdrop .swal2-container.swal2-center-left,body.swal2-no-backdrop .swal2-container.swal2-center-start{top:50%;left:0;-webkit-transform:translateY(-50%);transform:translateY(-50%)}body.swal2-no-backdrop .swal2-container.swal2-center-end,body.swal2-no-backdrop .swal2-container.swal2-center-right{top:50%;right:0;-webkit-transform:translateY(-50%);transform:translateY(-50%)}body.swal2-no-backdrop .swal2-container.swal2-bottom{bottom:0;left:50%;-webkit-transform:translateX(-50%);transform:translateX(-50%)}body.swal2-no-backdrop .swal2-container.swal2-bottom-left,body.swal2-no-backdrop .swal2-container.swal2-bottom-start{bottom:0;left:0}body.swal2-no-backdrop .swal2-container.swal2-bottom-end,body.swal2-no-backdrop .swal2-container.swal2-bottom-right{right:0;bottom:0}@media print{body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown){overflow-y:scroll!important}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown)>[aria-hidden=true]{display:none}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) .swal2-container{position:static!important}}body.swal2-toast-shown .swal2-container{background-color:transparent}body.swal2-toast-shown .swal2-container.swal2-top{top:0;right:auto;bottom:auto;left:50%;-webkit-transform:translateX(-50%);transform:translateX(-50%)}body.swal2-toast-shown .swal2-container.swal2-top-end,body.swal2-toast-shown .swal2-container.swal2-top-right{top:0;right:0;bottom:auto;left:auto}body.swal2-toast-shown .swal2-container.swal2-top-left,body.swal2-toast-shown .swal2-container.swal2-top-start{top:0;right:auto;bottom:auto;left:0}body.swal2-toast-shown .swal2-container.swal2-center-left,body.swal2-toast-shown .swal2-container.swal2-center-start{top:50%;right:auto;bottom:auto;left:0;-webkit-transform:translateY(-50%);transform:translateY(-50%)}body.swal2-toast-shown .swal2-container.swal2-center{top:50%;right:auto;bottom:auto;left:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}body.swal2-toast-shown .swal2-container.swal2-center-end,body.swal2-toast-shown .swal2-container.swal2-center-right{top:50%;right:0;bottom:auto;left:auto;-webkit-transform:translateY(-50%);transform:translateY(-50%)}body.swal2-toast-shown .swal2-container.swal2-bottom-left,body.swal2-toast-shown .swal2-container.swal2-bottom-start{top:auto;right:auto;bottom:0;left:0}body.swal2-toast-shown .swal2-container.swal2-bottom{top:auto;right:auto;bottom:0;left:50%;-webkit-transform:translateX(-50%);transform:translateX(-50%)}body.swal2-toast-shown .swal2-container.swal2-bottom-end,body.swal2-toast-shown .swal2-container.swal2-bottom-right{top:auto;right:0;bottom:0;left:auto}body.swal2-toast-column .swal2-toast{-webkit-box-orient:vertical;-webkit-box-direction:normal;flex-direction:column;-webkit-box-align:stretch;align-items:stretch}body.swal2-toast-column .swal2-toast .swal2-actions{-webkit-box-flex:1;flex:1;align-self:stretch;height:2.2em;margin-top:.3125em}body.swal2-toast-column .swal2-toast .swal2-loading{-webkit-box-pack:center;justify-content:center}body.swal2-toast-column .swal2-toast .swal2-input{height:2em;margin:.3125em auto;font-size:1em}body.swal2-toast-column .swal2-toast .swal2-validation-message{font-size:1em}");
//**// adminscripts start //**//
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// tinymce.init({selector: '.crud-richtext'});

//**/dataTables initialize/**//
document.addEventListener("DOMContentLoaded", () => {
  $('#dataTable').DataTable();
});

//**/charts initialize/**//
document.addEventListener("DOMContentLoaded", () => {
	dashboardCharts.initDashboardPageCharts();
});

document.addEventListener("DOMContentLoaded", () => {
	$(".form-select").each((i, e) => {
		new SlimSelect({
			select: e
		})
	});
});

//**/currencies/**//
function currencies_update()
{
	$.ajax({
		url: '/currencies_update',
		type: 'POST',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			location.reload();
		}
	});
};

//**/receipt/**//
$(document).on("click", "#receipt-single-product-add", function()
{
	var id = $('[name="productLive"]').val();
	if (checkId(id)) {
		$('#receipt-form-single-product-add').ajaxSubmit({
			url: '/receipt_add_single_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="receipt_selected_product-${response.info.product_id}" class="pointer" ondblclick="receipt_edit_product('${response.info.receipt_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
					
					
				}
			}
		});
	}
	$('#singleProduct').modal('hide')
});

function receipt_add_product(receipt_id, product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/receipt_add_product',
		type: 'POST',
		data: {receipt_id:receipt_id,product_id:product_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};
       
$(document).on("click", "#receipt-product-add", function()
{
	var id = $('[name="product_id"]').val();
	if (checkId(id)) {
		$('#receipt-form-product-add').ajaxSubmit({
			url: '/receipt_add_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="receipt_selected_product-${response.info.product_id}" class="pointer" ondblclick="receipt_edit_product('${response.info.receipt_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)

					//header
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				}
			}
		});
	}
	$('#modaledit').modal('hide')
});

function receipt_edit_product(receipt_id,product_id)
{
	const modal = $('#modaledit');
	
	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{
		$.ajax({
			url: '/receipt_edit_product',
			type: 'POST',
			data: {receipt_id:receipt_id,product_id:product_id},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(data)
			{
				modal.html(data);
				modal.find('.modaledit__close').on('click', function()
				{
					modal.modal('hide');
				});
				modal.modal('show');
			}
		});
	};
};

$(document).on("click", "#receipt-product-update", function()
{
	$('#receipt-form-product-update').ajaxSubmit({
		url: '/receipt_update_product_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedProductsTable tbody #receipt_selected_product-${response.info.product_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))
				
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

				$('#modaledit').modal('hide')

                $('#selectedProductsTable div').append(`<div id="add-receipt_selected_product-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)
            }
        }
	});
});

$(document).on("click", "#receipt-product-delete", function()
{
    $('#receipt-form-product-update').ajaxSubmit({
		url: '/receipt_delete_product',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedProductsTable tbody #receipt_selected_product-${response.info.product_id}`).remove()
				
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

				$('#modaledit').modal('hide')
            }
		}
    })
})

function receipt_comment(receipt_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/receipt_comment',
		type: 'POST',
		data: {receipt_id:receipt_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#receipt-comment-update", function()
{
	$('#receipt-form-comment-update').ajaxSubmit({
		url: '/receipt_comment_update',
		type: 'post',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				$('#receiptComment').html('');
				$('#receiptComment').append(`${response.comment}`);
			}
			$('#modaledit').modal('hide')
		}
	});
});

$(document).on("click", "#receipt-comment-delete", function()
{
	$('#receipt-form-comment-update').ajaxSubmit({
		url: '/receipt_comment_delete',
		type: 'DELETE',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				$('#receiptComment').html('');
			}
			$('#modaledit').modal('hide')
		}
	});
});

$(document).on("click", "#receipts-create-new-provider-store", function()
{
	$('#form-receipt_create_new_provider_store').ajaxSubmit({
		url: '/receipt_create_new_provider_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				var html="";
				html += '<option value="'+response.info.id+'">'+response.info.name+'</option>';
				$('[name="provider_id"]').append(html)
				$('#createNewProvider').modal('hide')
			}
		}
	});
});

/////////////////////////////////////**sale**////////////////////////////////////////////////
$(document).on("click", "#sale-single-product-add", function()
{
	var id = $('[name="productLive"]').val();
	if (checkId(id)) {
		$('#sale-form-single-product-add').ajaxSubmit({
			url: '/sale_add_single_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="sale_selected_product-${response.info.product_id}" class="pointer" ondblclick="sale_edit_product('${response.info.sale_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price_in">${parseFloat(response.info.price_in).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total">${parseFloat(response.info.total).toFixed(2)}</td>
							<td scope="row" class="text-center discount">${parseFloat(response.info.discount).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
					$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

					
				}
			}
		});
	}
	$('#singleProduct').modal('hide')
});

function sale_add_product(sale_id, product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/sale_add_product',
		type: 'POST',
		data: {sale_id:sale_id,product_id:product_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#sale-product-add", function()
{
	var id = $('[name="product_id"]').val();
	if (checkId(id)) {
		$('#sale-form-product-add').ajaxSubmit({
			url: '/sale_add_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="sale_selected_product-${response.info.product_id}" class="pointer" ondblclick="sale_edit_product('${response.info.sale_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price_in">${parseFloat(response.info.price_in).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total">${parseFloat(response.info.total).toFixed(2)}</td>
							<td scope="row" class="text-center discount">${parseFloat(response.info.discount).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
					$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))					
				}
			}
		});
	}
	$('#modaledit').modal('hide')
});

function sale_edit_product(sale_id,product_id)
{
	const modal = $('#modaledit');
	
	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{
		$.ajax({
			url: '/sale_edit_product',
			type: 'POST',
			data: {sale_id:sale_id,product_id:product_id},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(data)
			{
				modal.html(data);
				modal.find('.modaledit__close').on('click', function()
				{
					modal.modal('hide');
				});
				modal.modal('show');
			}
		});
	};
};

$(document).on("click", "#sale-product-update", function()
{
	$('#sale-form-product-update').ajaxSubmit({
		url: '/sale_update_product_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedProductsTable tbody #sale_selected_product-${response.info.product_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price_in').html(parseFloat(response.info.price_in).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total').html(parseFloat(response.info.total).toFixed(2))
                tr.find('.discount').html(parseFloat(response.info.discount).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))
				//header
				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

                $('#modaledit').modal('hide')
                $('#selectedProductsTable div').append(`<div id="add-sale_selected_product-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)

            }
        }
	});
});

$(document).on("click", "#sale-product-delete", function()
{
    $('#sale-form-product-update').ajaxSubmit({
		url: '/sale_delete_product',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedProductsTable tbody #sale_selected_product-${response.info.product_id}`).remove()
				//header
				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

                $('#modaledit').modal('hide')
            }
		}
    })
})

$('[name="sale_discount"]').on("change", function(e)
{
	$.ajax({
		url: '/sales_change_discount',
		type: 'POST',
		dataType: 'json',
		data: { discount: $('[name="sale_discount"]').val(), sale: $('[name="sale"]').val()},
		
		success: response => {
		if (response.status == 1) {
			$('#selectedProductsTable tbody').html('')
			let tbody = ''
			response.info.forEach(item => {
				tbody += 
				`<tr id="sale_selected_product-${item.product_id}" class="pointer" ondblclick="sale_edit_product('${item.sale_id}','${item.product_id}');">
						<td scope="row" class="article">${item.article}</td>
						<td scope="row" class="brand">${item.brand}</td>
						<td scope="row" class="name">${item.name}</td>
						<td scope="row" class="text-center stock">${parseFloat(item.stock).toFixed(2)}</td>
						<td scope="row" class="text-center quantity">${parseFloat(item.quantity).toFixed(2)}</td>
						<td scope="row" class="text-center price_in">${parseFloat(item.price_in).toFixed(2)}</td>
						<td scope="row" class="text-center price">${parseFloat(item.price).toFixed(2)}</td>
						<td scope="row" class="text-center total">${parseFloat(item.total).toFixed(2)}</td>
						<td scope="row" class="text-center discount">${parseFloat(item.discount).toFixed(2)}</td>
						<td scope="row" class="text-center total_amount">${parseFloat(item.total_amount).toFixed(2)}</td>
					</tr>`
			})
			$('#selectedProductsTable tbody').html(tbody)

				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
			}
		}

	});
});

function sale_comment(sale_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/sale_comment',
		type: 'POST',
		data: {sale_id:sale_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#sale-comment-update", function()
{
	$('#sale-form-comment-update').ajaxSubmit({
		url: '/sale_comment_update',
		type: 'post',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				$('#saleComment').html('');
				$('#saleComment').append(`${response.comment}`);
			}
			$('#modaledit').modal('hide')
		}
	});
});

$(document).on("click", "#sale-comment-delete", function()
{
	$('#sale-form-comment-update').ajaxSubmit({
		url: '/sale_comment_delete',
		type: 'DELETE',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				$('#saleComment').html('');
			}
			$('#modaledit').modal('hide')
		}
	});
});

//**/client_order/**//
function client_order_sale(client_order_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/client_order_sale',
		type: 'POST',
		data: {client_order_id:client_order_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#client_order-single-product-add", function()
{
	var id = $('[name="productLive"]').val();
	if (checkId(id)) {
		$('#client_order-form-single-product-add').ajaxSubmit({
			url: '/client_order_add_single_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="client_order_selected_product-${response.info.product_id}" class="pointer" ondblclick="client_order_edit_product('${response.info.client_order_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				}
			}
		});
	}
	$('#singleProduct').modal('hide')
});

function client_order_add_product(client_order_id, product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/client_order_add_product',
		type: 'POST',
		data: {client_order_id:client_order_id,product_id:product_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#client_order-product-add", function()
{
	var id = $('[name="product_id"]').val();
	if (checkId(id)) {
		$('#client_order-form-product-add').ajaxSubmit({
			url: '/client_order_add_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="client_order_selected_product-${response.info.product_id}" class="pointer" ondblclick="client_order_edit_product('${response.info.client_order_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				}
			}
		});
	}
	$('#modaledit').modal('hide')
});

function client_order_edit_product(client_order_id,product_id)
{
	const modal = $('#modaledit');
	
	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{		
		$.ajax({
			url: '/client_order_edit_product',
			type: 'POST',
			data: {client_order_id:client_order_id,product_id:product_id},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(data)
			{
				modal.html(data);
				modal.find('.modaledit__close').on('click', function()
				{
					modal.modal('hide');
				});
				modal.modal('show');
			}
		});
	};
};

$(document).on("click", "#client_order-product-update", function()
{
	$('#client_order-form-product-update').ajaxSubmit({
		url: '/client_order_update_product_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedProductsTable tbody #client_order_selected_product-${response.info.product_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')

                $('#selectedProductsTable div').append(`<div id="add-client_order_selected_product-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)
            }
        }
	});
});

$(document).on("click", "#client_order-product-delete", function()
{
    $('#client_order-form-product-update').ajaxSubmit({
		url: '/client_order_delete_product',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedProductsTable tbody #client_order_selected_product-${response.info.product_id}`).remove()
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')
            }
		}
    })
})

//**/to_provider_order/**//
function to_provider_order_receipt(to_provider_order_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/to_provider_order_receipt',
		type: 'POST',
		data: {to_provider_order_id:to_provider_order_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

//**/to_provider_order/**//
function to_provider_order_sale(to_provider_order_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/to_provider_order_sale',
		type: 'POST',
		data: {to_provider_order_id:to_provider_order_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

function to_provider_order_create_modal()
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/to_provider_order_create_modal',
		type: 'POST',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#to_provider_order-single-product-add", function()
{
	var id = $('[name="productLive"]').val();
	if (checkId(id)) {
		$('#to_provider_order-form-single-product-add').ajaxSubmit({
			url: '/to_provider_order_add_single_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="to_provider_order_selected_product-${response.info.product_id}" class="pointer" ondblclick="to_provider_order_edit_product('${response.info.to_provider_order_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				}
			}
		});
	}
	$('#singleProduct').modal('hide')
});

function to_provider_order_add_product(to_provider_order_id, product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/to_provider_order_add_product',
		type: 'POST',
		data: {to_provider_order_id:to_provider_order_id,product_id:product_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#to_provider_order-product-add", function()
{
	var id = $('[name="product_id"]').val();
	if (checkId(id)) {
		$('#to_provider_order-form-product-add').ajaxSubmit({
			url: '/to_provider_order_add_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="to_provider_order_selected_product-${response.info.product_id}" class="pointer" ondblclick="to_provider_order_edit_product('${response.info.to_provider_order_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
					
					
				}
			}
		});
	}
	$('#modaledit').modal('hide')
});

function to_provider_order_edit_product(to_provider_order_id,product_id)
{
	const modal = $('#modaledit');
	
	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{
		$.ajax({
			url: '/to_provider_order_edit_product',
			type: 'POST',
			data: {to_provider_order_id:to_provider_order_id,product_id:product_id},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(data)
			{
				modal.html(data);
				modal.find('.modaledit__close').on('click', function()
				{
					modal.modal('hide');
				});
				modal.modal('show');
			}
		});
	};
};

$(document).on("click", "#to_provider_order-product-update", function()
{
	$('#to_provider_order-form-product-update').ajaxSubmit({
		url: '/to_provider_order_update_product_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedProductsTable tbody #to_provider_order_selected_product-${response.info.product_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))

				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')
				
                $('#selectedProductsTable div').append(`<div id="add-to_provider_order_selected_product-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)
            }
        }
	});
});

$(document).on("click", "#to_provider_order-product-delete", function()
{
    $('#to_provider_order-form-product-update').ajaxSubmit({
		url: '/to_provider_order_delete_product',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedProductsTable tbody #to_provider_order_selected_product-${response.info.product_id}`).remove()
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')
            }
		}
    })
})

//**// online_client_order_product_create_button //**//
function online_client_orders_product_create(online_client_order_id, product_ordered_id)
{
	const modal = $('#modaledit');        
	$.ajax({
		url: '/online_client_orders_product_create',
		type: 'POST',
		data: {online_client_order_id:online_client_order_id, product_ordered_id:product_ordered_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-category'});
			new SlimSelect({select: '#input-group'});
			modal.modal('show');

		}
	});
};

$(document).on("click", "#online_client_order_product_create_button", function()
{
	$('#form-online_client_order_product_create_store').ajaxSubmit({
		url: '/online_client_orders_product_create_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#modaledit').modal('hide')
			}
		}
	});
});

const checkId = id => {
	const list = $('table tbody tr.pointer')
	notExist = true
	list.each(function()
	{
		let tr_id = $(this).attr('id')
		if (tr_id.split('-')[1] == id)
		{
		notExist = false
		let tr = $(`#${tr_id}`)
		tr.css("background-color", "#E76F51")
		setTimeout(function() {tr.css("background-color", "")},5000)
		}
	})
	return notExist
}

// **payroll** //
function payroll_add_employee(payroll_id, employee_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/payroll_add_employee',
		type: 'POST',
		data: {payroll_id:payroll_id,employee_id:employee_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#payroll-employee-add", function()
{
	$('#payroll-form-employee-add').ajaxSubmit({
		url: '/payroll_add_employee_store',
		type: 'PUT',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#selectedemployeesTable tbody').append(`
					<tr id="payroll_selected_employee-${response.info.employee_id}" class="pointer" onclick="payroll_edit_employee('${response.info.payroll_id}','${response.info.employee_id}');">
						<td scope="row">${response.info.lastname}</td>
						<td scope="row">${response.info.firstname}</td>
						<td scope="row">${response.info.secondname}</td>
						<td scope="row" class="text-center salary">${parseFloat(response.info.salary).toFixed(2)}</td>
					</tr>
				`)
				$('#modaledit').modal('hide')
			}
		}
	});
});

function payroll_edit_employee(payroll_id,employee_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/payroll_edit_employee',
		type: 'POST',
		data: {payroll_id:payroll_id,employee_id:employee_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#payroll-employee-update", function()
{
	$('#payroll-form-employee-update').ajaxSubmit({
		url: '/payroll_update_employee_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				const tr = $(`#selectedemployeesTable tbody #payroll_selected_employee-${response.info.employee_id}`)
				tr.find('.salary').html(parseFloat(response.info.salary).toFixed(2))
				$('#modaledit').modal('hide')
				$('#selectedemployeesTable div').append(`<div id="add-payroll_selected_employee-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)
			}
		}
	});
});

$(document).on("click", "#payroll-employee-delete", function()
{
	$('#payroll-form-employee-update').ajaxSubmit({
		url: '/payroll_delete_employee',
		type: 'DELETE',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$(`#selectedemployeesTable tbody #payroll_selected_employee-${response.info.employee_id}`).remove()
				$('#modaledit').modal('hide')
			}
		}
	})
});


// **salary_payment** //
function salary_payment_add_employee(salary_payment_id, employee_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/salary_payment_add_employee',
		type: 'POST',
		data: {salary_payment_id:salary_payment_id,employee_id:employee_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#salary_payment-employee-add", function()
{
	$('#salary_payment-form-employee-add').ajaxSubmit({
		url: '/salary_payment_add_employee_store',
		type: 'PUT',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#selectedemployeesTable tbody').append(`
					<tr id="salary_payment_selected_employee-${response.info.employee_id}" class="pointer" onclick="salary_payment_edit_employee('${response.info.salary_payment_id}','${response.info.employee_id}');">
						<td scope="row">
							${response.info.lastname}
						</td>
						<td scope="row">
							${response.info.firstname}
						</td>
						<td scope="row">
							${response.info.secondname}
						</td>
						<td scope="row" class="text-center salary">
							${parseFloat(response.info.salary).toFixed(2)}
						</td>
					</tr>
				`)
				$('#modaledit').modal('hide')
			}
		}
	});
});

function salary_payment_edit_employee(salary_payment_id,employee_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/salary_payment_edit_employee',
		type: 'POST',
		data: {salary_payment_id:salary_payment_id,employee_id:employee_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#salary_payment-employee-update", function()
{
	$('#salary_payment-form-employee-update').ajaxSubmit({
		url: '/salary_payment_update_employee_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				const tr = $(`#selectedemployeesTable tbody #salary_payment_selected_employee-${response.info.employee_id}`)
				tr.find('.salary').html(parseFloat(response.info.salary).toFixed(2))
				$('#modaledit').modal('hide')
				$('#selectedemployeesTable div').append(`<div id="add-salary_payment_selected_employee-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)
			}
		}
	});
});

$(document).on("click", "#salary_payment-employee-delete", function()
{
	$('#salary_payment-form-employee-update').ajaxSubmit({
		url: '/salary_payment_delete_employee',
		type: 'DELETE',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$(`#selectedemployeesTable tbody #salary_payment_selected_employee-${response.info.employee_id}`).remove()
				$('#modaledit').modal('hide')
			}
		}
	})
});


// ** services_receipts ** //
$(document).on("click", "#services_receipts-create-new-provider-store", function()
{
	$('#form-services_receipt_create_new_provider_store').ajaxSubmit({
		url: '/services_receipt_create_new_provider_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				var html="";
				html += '<option value="'+response.info.id+'">'+response.info.name+'</option>';
				$('[name="provider_id"]').append(html)
				$('#createNewProvider').modal('hide')
			}
		}
	});
});

function services_receipt_add_service(services_receipt_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/services_receipt_add_service',
		type: 'POST',
		data: {services_receipt_id:services_receipt_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-service'});
			modal.modal('show');
		}
	});
};
       
$(document).on("click", "#services_receipt-service-add", function()
{
	$('#services_receipt-form-service-add').ajaxSubmit({
		url: '/services_receipt_add_service_store',
		type: 'PUT',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#selectedServicesTable tbody').append(`
					<tr id="services_receipt_selected_service-${response.info.service_id}" class="pointer" ondblclick="services_receipt_edit_service('${response.info.services_receipt_id}','${response.info.service_id}');">
						<td scope="row">${response.info.article}</td>
						<td scope="row">${response.info.name}</td>
						<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
						<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
						<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
					</tr>
				`)

				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')
			}
		}
	});
});

function services_receipt_edit_service(services_receipt_id, service_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/services_receipt_edit_service',
		type: 'POST',
		data: {services_receipt_id:services_receipt_id,service_id:service_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-service'});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#services_receipt-service-update", function()
{
	$('#services_receipt-form-service-update').ajaxSubmit({
		url: '/services_receipt_update_service_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedServicesTable tbody #services_receipt_selected_service-${response.info.service_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')

                $('#selectedServicesTable div').append(`<div id="add-services_receipt_selected_service-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)
            }
        }
	});
});

$(document).on("click", "#services_receipt-service-delete", function()
{
    $('#services_receipt-form-service-update').ajaxSubmit({
		url: '/services_receipt_delete_service',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedServicesTable tbody #services_receipt_selected_service-${response.info.service_id}`).remove()
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')
            }
		}
    })
})


// ** ** //
function price_settings_addproduct(pricesetting_id, product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/price_settings_addproduct',
		type: 'POST',
		data: {pricesetting_id:pricesetting_id,product_id:product_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

//client phones
function client_addphone(client_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/clients_addphone',
		type: 'POST',
		data: {client_id:client_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#client-phone-store", function()
{
	$('#client-form-phone-store').ajaxSubmit({
		url: '/clients_addphone_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#clientPhonesTable tbody').append(`
					<tr id="client_selected_phone-${response.info.phone_id}" class="pointer" onclick="client_editphone('${response.info.client_id}','${response.info.phone_id}');">
						<td scope="row" class="phone">${response.info.phone}</td>
						<td scope="row" class="telegram">${response.info.telegram == 1 ? '<i class="far fa-check-square text-success"></i>': ''}</td>
						<td scope="row" class="viber">${response.info.viber == 1 ? '<i class="far fa-check-square text-success"></i>': ''}</td>
						<td scope="row" class="whatsapp">${response.info.whatsapp == 1 ? '<i class="far fa-check-square text-success"></i>': ''}</td>
						<td scope="row" class="default">${response.info.default == 1 ? '<i class="far fa-check-square text-success"></i>': ''}</td>
						<td scope="row" class="comment">${response.info.comment}</td>
					</tr>
				`)
				$('#modaledit').modal('hide')
			}
		}
	});
});

function client_editphone(client_id,phone_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/clients_editphone',
		type: 'POST',
		data: {client_id:client_id,phone_id:phone_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#client-phone-update", function()
{
	$('#client-form-phone-update').ajaxSubmit({
		url: '/clients_editphone_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#clientPhonesTable tbody #client_selected_phone-${response.info.phone_id}`)
                tr.find('.phone').html(response.info.phone)
				tr.find('.telegram').html(`${response.info.telegram == 1 ? '<i class="far fa-check-square text-success"></i>': ''}`)
				tr.find('.viber').html(`${response.info.viber == 1 ? '<i class="far fa-check-square text-success"></i>': ''}`)
				tr.find('.whatsapp').html(`${response.info.whatsapp == 1 ? '<i class="far fa-check-square text-success"></i>': ''}`)
				tr.find('.default').html(`${response.info.default == 1 ? '<i class="far fa-check-square text-success"></i>': ''}`)
                tr.find('.comment').html(response.info.comment)
                $('#modaledit').modal('hide')
            }
        }
	});
});

$(document).on("click", "#client-phone-delete", function()
{
    $('#client-form-phone-update').ajaxSubmit({
		url: '/clients_phone_delete',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#clientPhonesTable tbody #client_selected_phone-${response.info.phone_id}`).remove()
                $('#modaledit').modal('hide')
            }
		}
    })
})

//client addaddress
function client_addaddress(client_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/clients_addaddress',
		type: 'POST',
		data: {client_id:client_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#client-address-store", function()
{
	$('#client-form-address-store').ajaxSubmit({
		url: '/clients_addaddress_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#clientAddressesTable tbody').append(`
					<tr id="client_selected_address-${response.info.address_id}" class="pointer" onclick="client_editaddress('${response.info.client_id}','${response.info.address_id}');">
						<td scope="row" class="default">${response.info.default == 1 ? '<i class="far fa-check-square text-success"></i>': ''}</td>
						<td scope="row" class="zipcode">${response.info.zipcode != null ? response.info.zipcode : ''}</td>
						<td scope="row" class="country">${response.info.country != null ? response.info.country : ''}</td>
						<td scope="row" class="state">${response.info.state != null ? response.info.state : ''}</td>
						<td scope="row" class="city">${response.info.city != null ? response.info.city : ''}</td>
						<td scope="row" class="street">${response.info.street != null ? response.info.street : ''}</td>
						<td scope="row" class="address">${response.info.address != null ? response.info.address : ''} / ${response.info.apartment != null ? response.info.apartment : ''}</td>
						<td scope="row" class="comment">${response.info.comment != null ? response.info.comment : ''}</td>
					</tr>
				`)
				$('#modaledit').modal('hide')
			}
		}
	});
});

function client_editaddress(client_id,address_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/clients_editaddress',
		type: 'POST',
		data: {client_id:client_id,address_id:address_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#client-address-update", function()
{
	$('#client-form-address-update').ajaxSubmit({
		url: '/clients_address_update',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#clientAddressesTable tbody #client_selected_address-${response.info.address_id}`)
				tr.find('.zipcode').html(`${response.info.zipcode != null ? response.info.zipcode : ''}`)
				tr.find('.country').html(`${response.info.country != null ? response.info.country : ''}`)
				tr.find('.state').html(`${response.info.state != null ? response.info.state : ''}`)
				tr.find('.city').html(`${response.info.city != null ? response.info.city : ''}`)
				tr.find('.street').html(`${response.info.street != null ? response.info.street : ''}`)
				tr.find('.address').html(`${response.info.address != null ? response.info.address : ''} / ${response.info.apartment != null ? response.info.apartment : ''}`)
				tr.find('.comment').html(`${response.info.comment != null ? response.info.comment : ''}`)
				tr.find('.default').html(`${response.info.default == 1 ? '<i class="far fa-check-square text-success"></i>': ''}`)
                $('#modaledit').modal('hide')
            }
        }
	});
});

$(document).on("click", "#client-address-delete", function()
{
    $('#client-form-address-update').ajaxSubmit({
		url: '/clients_address_delete',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1)
			{
                $(`#clientAddressesTable tbody #client_selected_address-${response.info.address_id}`).remove()
                $('#modaledit').modal('hide')
            }
		}
    })
})


function client_addauto(client_id)
{
	const route					= '/clients/client_addauto';
	
	const group					= $('[name="group"]').val();
	const manufacturer			= $('[name="manufacturer"]').val();
	const model					= $('[name="model"]').val();
	const modification			= $('[name="modification"]').val();
	
	
	const plate					= $('[name="plate"]').val();
	const year					= $('[name="year"]').val();
	const vin					= $('[name="vin"]').val();
	const color					= $('[name="color"]').val();
	
	$.ajax({
		url: route,
		type: 'POST',
		data: { group:group,manufacturer:manufacturer,model:model,modification:modification,plate:plate,year:year,vin:vin,color:color,client_id:client_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			location.reload();
		}
	});
};

// client_delete_auto
function client_delete_auto(client_id,auto_id)
{
	const route = '/clients/client_delete_auto';
	$.ajax({
		url: route,
		type: 'POST',
		data: {client_id:client_id,auto_id:auto_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			location.reload();
		}
	});
};

////////////////////////////////////crosses////////////////////////////////////
function product_addcross(product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/product_addcross',
		type: 'POST',
		data: {product_id:product_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '.modal-select'});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#product-cross-add", function()
{
	$('#product-cross-form-add').ajaxSubmit({
		url: '/product_addcross_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#crossesTable tbody').html('')
				let tbody = ''
				response.info.forEach(item => {
					tbody += 
						`<tr id="selected_cross-${item.id}" class="pointer" ondblclick="product_editcross('${item.id}','${item.uid}')">
							<td scope="row" class="article">${item.article}</td>
							<td scope="row" class="brand">${item.brand}</td>
							<td scope="row" class="name">${item.name != null ? item.name : ''}</td>
							<td scope="row" class="main_by_group">${item.main_by_group == 1 ? '<i class="far fa-check-square text-success"></i>' : ''}</td>
							<td scope="row" class="main_by_brand">${item.main_by_brand == 1 ? '<i class="far fa-check-square text-success"></i>' : ''}</td>
							</tr>`
				})
				$('#crossesTable tbody').html(tbody)
				$('#modaledit').modal('hide')
			}
		}
	});
});

function product_editcross(cross_id,uid)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/product_editcross',
		type: 'POST',
		data: {cross_id:cross_id,uid:uid},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '.modal-select'});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#product-cross-update", function()
{
	$('#product-cross-form-update').ajaxSubmit({
		url: '/product_update_cross',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#crossesTable tbody').html('')
				let tbody = ''
				response.info.forEach(item => {
					tbody += 
						`<tr id="selected_cross-${item.id}" class="pointer" ondblclick="product_editcross('${item.id}','${item.uid}')">
							<td scope="row" class="article">${item.article}</td>
							<td scope="row" class="brand">${item.brand}</td>
							<td scope="row" class="name">${item.name != null ? item.name : ''}</td>
							<td scope="row" class="main_by_group">${item.main_by_group == 1 ? '<i class="far fa-check-square text-success"></i>' : ''}</td>
							<td scope="row" class="main_by_brand">${item.main_by_brand == 1 ? '<i class="far fa-check-square text-success"></i>' : ''}</td>
							</tr>`
				})
				$('#crossesTable tbody').html(tbody)
				$('#modaledit').modal('hide')
			}
		}
	});
});

$(document).on("click", "#product-cross-delete", function()
{
    $('#product-cross-form-update').ajaxSubmit({
		url: '/product_delete_cross',
		type: 'DELETE',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#crossesTable tbody').html('')
				let tbody = ''
				response.info.forEach(item => {
					tbody += 
						`<tr id="selected_cross-${item.id}" class="pointer" ondblclick="product_editcross('${item.id}','${item.uid}')">
							<td scope="row" class="article">${item.article}</td>
							<td scope="row" class="brand">${item.brand}</td>
							<td scope="row" class="name">${item.name != null ? item.name : ''}</td>
							<td scope="row" class="main_by_group">${item.main_by_group == 1 ? '<i class="far fa-check-square text-success"></i>' : ''}</td>
							<td scope="row" class="main_by_brand">${item.main_by_brand == 1 ? '<i class="far fa-check-square text-success"></i>' : ''}</td>
							</tr>`
				})
				$('#crossesTable tbody').html(tbody)
				$('#modaledit').modal('hide')
			}
		}
    })
})

//eans
function product_addean(product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/products/product_addean',
		type: 'POST',
		data: {product_id:product_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

function product_editean(product_id,ean_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/products/product_editean',
		type: 'POST',
		data: {product_id:product_id,ean_id:ean_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

function product_delete_ean(product_id,ean_id)
{
	const route = '/products/product_delete_ean';
	$.ajax({
		url: route,
		type: 'POST',
		data: {product_id:product_id,ean_id:ean_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			location.reload();
		}
	});
};
//gtins
function product_addgtin(product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/products/product_addgtin',
		type: 'POST',
		data: {product_id:product_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

function product_editgtin(product_id,gtin_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/products/product_editgtin',
		type: 'POST',
		data: {product_id:product_id,gtin_id:gtin_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

function product_delete_gtin(product_id,gtin_id)
{
	const route = '/products/product_delete_gtin';
	$.ajax({
		url: route,
		type: 'POST',
		data: {product_id:product_id,gtin_id:gtin_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			location.reload();
		}
	});
};

$('[name="client_id"]').on("change", function(e)
{
	$.ajax({
		url: '/admincarts/client_vehicles',
		type: 'POST',
		data: { client_id: $('[name="client_id"]').val()},
		dataType: 'json',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			$('[name="client_auto_id"]').html('');
			var html="";
			html += '<option value="">Not Specified</option>';
			for(var i = 0; i < data.length; i++)
			{
				html += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
			}
			$('[name="client_auto_id"]').append(html)
		},
		error: function(xhr, textStatus, thrownError)
		{
			alert(xhr.status);
			alert(thrownError);
		}
	});
});

function catalog_product_info(brand,article)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/admincarts/catalog_product_info',
		type: 'POST',
		data: {brand:brand,article:article},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#products-create-new-brand-store", function()
{
	$('#form-product_create_new_brand_store').ajaxSubmit({
		url: '/product_create_new_brand_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				var html="";
				html += '<option value="'+response.info.brand+'">'+response.info.brand+'</option>';
				$('[name="brand"]').append(html)
				$('#createNewBrand').modal('hide')
			}
		}
	});
});

function client_phones_upate()
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/clients_phones_renew_settings',
		type: 'POST',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
}

/////////////////////
var table = $('#service_parts').DataTable();
// Handle form submission event
$(document).on("click", "#client_auto_serviceparts_create_client_order", function()
{
	var form = this;
	var user_id = $('#user_id').val();
	var client_id = $('#client_id').val();
	var currency = $('#input-currency').val();
	var warehouse_id = $('#input-warehouse').val();
	let checkedRows = [];
	let table_info = [];
	var rowCount = table.rows().data().length;
	var columnCount = table.columns().data().length;
	for (let i = 0; i < rowCount; i++)
	{
		for (let y = 0; y < columnCount; y++)
		{
			if (table.cell({ row: i, column: y }).node().firstElementChild?.checked)
			{
				checkedRows.push(i);
			}
		}
	}
	checkedRows.forEach((i) => {
		let y = {
			product_id: table.cell({ row: i, column: 0 }).node().firstElementChild?.value, 
			quantity: table.cell({ row: i, column: 5 }).node().firstElementChild?.value, 
		};
		table_info.push(y); 
	});
	$.ajax({
		url: '/client_autos/servicepart_client_order_create',
		type: 'POST',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		data: {table_info:table_info,user_id:user_id,client_id:client_id,currency:currency,warehouse_id:warehouse_id},
		success:function(data)
		{
			window.location.replace(data);
		}
	});
});

$(document).on("click", "#client_auto_serviceparts_create_sale", function()
{
	var form = this;
	var user_id = $('#user_id').val();
	var client_id = $('#client_id').val();
	var currency = $('#input-currency').val();
	var warehouse_id = $('#input-warehouse').val();
	let checkedRows = [];
	let table_info = [];
	var rowCount = table.rows().data().length;
	var columnCount = table.columns().data().length;
	for (let i = 0; i < rowCount; i++)
	{
		for (let y = 0; y < columnCount; y++)
		{
			if (table.cell({ row: i, column: y }).node().firstElementChild?.checked)
			{
				checkedRows.push(i);
			}
		}
	}
	checkedRows.forEach((i) => {
		let y = {
			product_id: table.cell({ row: i, column: 0 }).node().firstElementChild?.value, 
			quantity: table.cell({ row: i, column: 5 }).node().firstElementChild?.value, 
		};
		table_info.push(y); 
	});
	$.ajax({
		url: '/client_autos/servicepart_sale_create',
		type: 'POST',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		data: {table_info:table_info,user_id:user_id,client_id:client_id,currency:currency,warehouse_id:warehouse_id},
		success:function(data)
		{
			window.location.replace(data);
		}
	});
});

//**// return_from_the_client //**//
function return_from_the_client_add_single_product(return_from_the_client_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/return_from_the_client_add_single_product',
		type: 'POST',
		data: {return_from_the_client_id:return_from_the_client_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-product'});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#return_from_the_client-single-product-add", function()
{
	$('#return_from_the_client-form-single-product-add').ajaxSubmit({
		url: '/return_from_the_client_add_single_product_store',
		type: 'PUT',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				$('#selectedProductsTable tbody').append(`
					<tr id="return_from_the_client_selected_product-${response.info.product_id}" class="pointer" ondblclick="return_from_the_client_edit_product('${response.info.return_from_the_client_id}','${response.info.product_id}');">
						<td scope="row">${response.info.article}</td>
						<td scope="row">${response.info.brand}</td>
						<td scope="row">${response.info.name}</td>
						<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
						<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
						<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
						<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
					</tr>
				`)

				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

				$('#modaledit').modal('hide')
			}
		}
	});
});

function return_from_the_client_edit_product(return_from_the_client_id,product_id)
{
	const modal = $('#modaledit');
	
	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{
		$.ajax({
			url: '/return_from_the_client_edit_product',
			type: 'POST',
			data: {return_from_the_client_id:return_from_the_client_id,product_id:product_id},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(data)
			{
				modal.html(data);
				modal.find('.modaledit__close').on('click', function()
				{
					modal.modal('hide');
				});
				modal.modal('show');
			}
		});
	};
};

$(document).on("click", "#returns_from_the_client-product-update", function()
{
	$('#returns_from_the_client-form-product-update').ajaxSubmit({
		url: '/return_from_the_client_update_product_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedProductsTable tbody #return_from_the_client_selected_product-${response.info.product_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))
                $('#modaledit').modal('hide')
                

            }
        }
	});
});

$(document).on("click", "#returns_from_the_client-product-delete", function()
{
    $('#returns_from_the_client-form-product-update').ajaxSubmit({
		url: '/return_from_the_client_delete_product',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1)
			{
                $(`#selectedProductsTable tbody #return_from_the_client_selected_product-${response.info.product_id}`).remove()
				$('#return_from_the_clientDiscountSum').html(parseFloat(response.info.return_from_the_clientDiscountSum).toFixed(2))//discount test

				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
                $('#modaledit').modal('hide')
            }
		}
    })
})


//**// return_to_provider //**//
function return_to_provider_add_single_product(return_to_provider_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/return_to_provider_add_single_product',
		type: 'POST',
		data: {return_to_provider_id:return_to_provider_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-product'});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#return_to_provider-single-product-add", function()
{
	$('#return_to_provider-form-single-product-add').ajaxSubmit({
		url: '/return_to_provider_add_single_product_store',
		type: 'PUT',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#selectedProductsTable tbody').append(`
					<tr id="return_to_provider_selected_product-${response.info.product_id}" class="pointer" ondblclick="return_to_provider_edit_product('${response.info.return_to_provider_id}','${response.info.product_id}');">
						<td scope="row">
							${response.info.article}
						</td>
						<td scope="row">
							${response.info.brand}
						</td>
						<td scope="row">
							${response.info.name}
						</td>
						<td scope="row" class="text-center stock">
							${parseFloat(response.info.stock).toFixed(2)}
						</td>
						<td scope="row" class="text-center quantity">
							${parseFloat(response.info.quantity).toFixed(2)}
						</td>
						<td scope="row" class="text-center price">
							${parseFloat(response.info.price).toFixed(2)}
						</td>
						<td scope="row" class="text-center total_amount">
						${parseFloat(response.info.total_amount).toFixed(2)}
						</td>
					</tr>
				`)
				$('#modaledit').modal('hide')
			}
		}
	});
});

function return_to_provider_edit_product(return_to_provider_id,product_id)
{
	const modal = $('#modaledit');
	
	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{
		$.ajax({
			url: '/return_to_provider_edit_product',
			type: 'POST',
			data: {return_to_provider_id:return_to_provider_id,product_id:product_id},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(data)
			{
				modal.html(data);
				modal.find('.modaledit__close').on('click', function()
				{
					modal.modal('hide');
				});
				modal.modal('show');
			}
		});
	};
};

$(document).on("click", "#returns_to_provider-product-update", function()
{
	$('#returns_to_provider-form-product-update').ajaxSubmit({
		url: '/return_to_provider_update_product_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedProductsTable tbody #return_to_provider_selected_product-${response.info.product_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))
                $('#modaledit').modal('hide')
                $('#selectedProductsTable div').append(`<div id="add-return_to_provider_selected_product-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)

            }
        }
	});
});

$(document).on("click", "#returns_to_provider-product-delete", function()
{
    $('#returns_to_provider-form-product-update').ajaxSubmit({
		url: '/return_to_provider_delete_product',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedProductsTable tbody #return_to_provider_selected_product-${response.info.product_id}`).remove()
				$('#return_to_providerDiscountSum').html(parseFloat(response.info.return_to_providerDiscountSum).toFixed(2))//discount test
                $('#modaledit').modal('hide')
            }
		}
    })
})


// min_stocks //
function product_add_min_stock(product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/product_add_min_stock',
		type: 'POST',
		data: {product_id:product_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-warehouse'});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#product-min_stock-add", function()
{
	$('#product-min_stock-form-add').ajaxSubmit({
		url: '/product_add_min_stock_store',
		type: 'PUT',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#minStocksTable tbody').append(`
				<tr id="selected_min_stock-{{ $min_stock->id }}" class="pointer" OnClick="product_edit_min_stock('{{$product->id}}','{{$min_stock->id}}')">
					<tr id="selected_min_stock-${response.info.min_stock_id}" class="pointer" onclick="product_edit_min_stock('${response.info.product_id}','${response.info.min_stock_id}');">
						<td scope="row" class="date">${response.info.date}</td>
						<td scope="row" class="warehouse">${response.info.warehouse}</td>						
						<td scope="row" class="quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
					</tr>
				`)
				$('#modaledit').modal('hide')
			}
		}
	});
});

function product_edit_min_stock(product_id,min_stock_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/product_edit_min_stock',
		type: 'POST',
		data: {product_id:product_id,min_stock_id:min_stock_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-warehouse'});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#product-min_stock-update", function()
{
	$('#product-min_stock-form-update').ajaxSubmit({
		url: '/product_update_min_stock',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#minStocksTable tbody #selected_min_stock-${response.info.min_stock_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.date').html(response.info.date)
                tr.find('.warehouse').html(response.info.warehouse)
                $('#modaledit').modal('hide')
            }
        }
	});
});

$(document).on("click", "#product-min_stock-delete", function()
{
    $('#product-min_stock-form-update').ajaxSubmit({
		url: '/product_delete_min_stock',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#minStocksTable tbody #selected_min_stock-${response.info.min_stock_id}`).remove()
                $('#modaledit').modal('hide')
            }
		}
    })
})

/////////////////////////////////////**serviceparts**////////////////////////////////////////////////
function servicepart_add(client_auto_id)
{
	const modal = $('#modaledit');

	$.ajax({
		url: '/client_autos_servicepart_add',
		type: 'POST',
		data: {client_auto_id:client_auto_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-product'});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#auto-servicepart-add", function()
{
	$('#auto-servicepart-form-add').ajaxSubmit({
		url: '/client_autos_servicepart_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#servicepartsTable tbody').append(`
					<tr id="selected_servicepart-${response.info.servicepart_id}" class="pointer" OnClick="servicepart_edit('${response.info.client_auto_id}','${response.info.servicepart_id}')">
						<td scope="row" class="article">${response.info.article}</td>
						<td scope="row" class="brand">${response.info.brand}</td>
						<td scope="row" class="name">${response.info.name != null ? response.info.name : ''}</td>
						<td scope="row" class="quantity">${response.info.quantity}</td>
						
						<td scope="row" class="stock">${response.info.stock != null ? response.info.stock : '0.00'}</td>
						<td scope="row" class="price">${response.info.price != null ? response.info.price : '0.00'}</td>
						<td scope="row" class="comment">${response.info.comment != null ? response.info.comment : ''}</td>
					</tr>
				`)
				$('#modaledit').modal('hide')
			}
		}
	});
});

function servicepart_edit(client_auto_id,item_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/client_autos_servicepart_edit',
		type: 'POST',
		data: {client_auto_id:client_auto_id,item_id:item_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-product'});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#auto-servicepart-update", function()
{
	$('#auto-servicepart-form-update').ajaxSubmit({
		url: '/client_autos_servicepart_update',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#servicepartsTable tbody #selected_servicepart-${response.info.servicepart_id}`)
				tr.find('.article').html(response.info.article)
				tr.find('.brand').html(response.info.brand)
				tr.find('.name').html(response.info.name)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
				tr.find('.stock').html(parseFloat(response.info.stock).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                
                tr.find('.comment').html(response.info.comment != null ? response.info.comment : '')
                $('#modaledit').modal('hide')
            }
        }
	});
});

$(document).on("click", "#auto-servicepart-delete", function()
{
    $('#auto-servicepart-form-update').ajaxSubmit({
		url: '/client_autos_servicepart_delete',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#servicepartsTable tbody #selected_servicepart-${response.info.servicepart_id}`).remove()
                $('#modaledit').modal('hide')
            }
		}
    })
})
/////////////////////////////////////**serviceparts**////////////////////////////////////////////////

////////////////////////////////////**repair_order**////////////////////////////////////////////////
$(document).on("click", "#repair_order-single-product-add", function()
{
	var id = $('[name="productLive"]').val();
	if (checkId(id))
	{
		$('#repair_order-form-single-product-add').ajaxSubmit({
			url: '/repair_order_add_single_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="repair_order_selected_product-${response.info.product_id}" class="pointer" ondblclick="repair_order_edit_product('${response.info.repair_order_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total">${parseFloat(response.info.total).toFixed(2)}</td>
							<td scope="row" class="text-center discount">${parseFloat(response.info.discount).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
					$('[name="docServicesDiscountSum"]').html(parseFloat(response.docHeaderValues.docServicesDiscountSum).toFixed(2))
					$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
					$('[name="docServicesDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docServicesDiscountedTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docServicesCount"]').html(parseFloat(response.docHeaderValues.docServicesCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
					$('[name="docServicesQuantity"]').html(parseFloat(response.docHeaderValues.docServicesQuantity).toFixed(2))
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))

					// $('#singleProduct').modal('hide')
				}
			}
		});
	}
	$('#singleProduct').modal('hide')
});

function repair_order_add_product(repair_order_id, product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/repair_order_add_product',
		type: 'POST',
		data: {repair_order_id:repair_order_id,product_id:product_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#repair_order-product-add", function()
{
	var id = $('[name="product_id"]').val();
	if (checkId(id))
	{
		$('#repair_order-form-product-add').ajaxSubmit({
			url: '/repair_order_add_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="repair_order_selected_product-${response.info.product_id}" class="pointer" ondblclick="repair_order_edit_product('${response.info.repair_order_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total">${parseFloat(response.info.total).toFixed(2)}</td>
							<td scope="row" class="text-center discount">${parseFloat(response.info.discount).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
					$('[name="docServicesDiscountSum"]').html(parseFloat(response.docHeaderValues.docServicesDiscountSum).toFixed(2))
					$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
					$('[name="docServicesDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docServicesDiscountedTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docServicesCount"]').html(parseFloat(response.docHeaderValues.docServicesCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
					$('[name="docServicesQuantity"]').html(parseFloat(response.docHeaderValues.docServicesQuantity).toFixed(2))
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))

					// $('#modaledit').modal('hide')
				}
			}
		});
	}
	$('#modaledit').modal('hide')
});

function repair_order_edit_product(repair_order_id,product_id)
{
	const modal = $('#modaledit');
	
	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{
		$.ajax({
			url: '/repair_order_edit_product',
			type: 'POST',
			data: {repair_order_id:repair_order_id,product_id:product_id},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(data)
			{
				modal.html(data);
				modal.find('.modaledit__close').on('click', function()
				{
					modal.modal('hide');
				});
				modal.modal('show');
			}
		});
	};
};

$(document).on("click", "#repair_order-product-update", function()
{
	$('#repair_order-form-product-update').ajaxSubmit({
		url: '/repair_order_update_product_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedProductsTable tbody #repair_order_selected_product-${response.info.product_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total').html(parseFloat(response.info.total).toFixed(2))
                tr.find('.discount').html(parseFloat(response.info.discount).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))
				//header
				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

                $('#modaledit').modal('hide')
                $('#selectedProductsTable div').append(`<div id="add-repair_order_selected_product-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)

            }
        }
	});
});

$(document).on("click", "#repair_order-product-delete", function()
{
    $('#repair_order-form-product-update').ajaxSubmit({
		url: '/repair_order_delete_product',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedProductsTable tbody #repair_order_selected_product-${response.info.product_id}`).remove()
				//header
				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docServicesDiscountSum"]').html(parseFloat(response.docHeaderValues.docServicesDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docServicesDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docServicesDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docServicesCount"]').html(parseFloat(response.docHeaderValues.docServicesCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				$('[name="docServicesQuantity"]').html(parseFloat(response.docHeaderValues.docServicesQuantity).toFixed(2))
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))

                $('#modaledit').modal('hide')
            }
		}
    })
})

$('[name="repair_order_discount"]').on("change", function(e)
{
	$.ajax({
		url: '/repair_orders_change_discount',
		type: 'POST',
		dataType: 'json',
		data: { discount: $('[name="repair_order_discount"]').val(), repair_order: $('[name="repair_order"]').val()},
		
		success: response => {
		if (response.status == 1) {
			$('#selectedProductsTable tbody').html('')
			let tbody = ''
			response.info.forEach(item => {
				tbody += 
				`<tr id="repair_order_selected_product-${item.product_id}" class="pointer" ondblclick="repair_order_edit_product('${item.repair_order_id}','${item.product_id}');">
						<td scope="row" class="article">${item.article}</td>
						<td scope="row" class="brand">${item.brand}</td>
						<td scope="row" class="name">${item.name}</td>
						<td scope="row" class="text-center stock">${parseFloat(item.stock).toFixed(2)}</td>
						<td scope="row" class="text-center quantity">${parseFloat(item.quantity).toFixed(2)}</td>
						<td scope="row" class="text-center price">${parseFloat(item.price).toFixed(2)}</td>
						<td scope="row" class="text-center total">${parseFloat(item.total).toFixed(2)}</td>
						<td scope="row" class="text-center discount">${parseFloat(item.discount).toFixed(2)}</td>
						<td scope="row" class="text-center total_amount">${parseFloat(item.total_amount).toFixed(2)}</td>
					</tr>`
			})
			$('#selectedProductsTable tbody').html(tbody)

			$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
			$('[name="docServicesDiscountSum"]').html(parseFloat(response.docHeaderValues.docServicesDiscountSum).toFixed(2))
			$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
			$('[name="docServicesDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docServicesDiscountedTotal).toFixed(2))
			$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
			$('[name="docServicesCount"]').html(parseFloat(response.docHeaderValues.docServicesCount).toFixed(2))
			$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
			$('[name="docServicesQuantity"]').html(parseFloat(response.docHeaderValues.docServicesQuantity).toFixed(2))
			$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
			}
		}

	});
});
//repair order services
$(document).on("click", "#repair_order-single-service-add", function()
{
	var id = $('[name="service_id"]').val();
	if (checkId(id))
	{
		$('#repair_order-form-single-service-add').ajaxSubmit({
			url: '/repair_order_add_single_service_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedServicesTable tbody').append(`
						<tr id="repair_order_selected_service-${response.info.service_id}" class="pointer" onclick="repair_order_edit_service('${response.info.repair_order_id}','${response.info.service_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center employee">${response.info.employee}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center discount">${parseFloat(response.info.discount).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
					$('[name="docServicesDiscountSum"]').html(parseFloat(response.docHeaderValues.docServicesDiscountSum).toFixed(2))
					$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
					$('[name="docServicesDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docServicesDiscountedTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docServicesCount"]').html(parseFloat(response.docHeaderValues.docServicesCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
					$('[name="docServicesQuantity"]').html(parseFloat(response.docHeaderValues.docServicesQuantity).toFixed(2))
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				}
			}
		});
	}
	$('#singleService').modal('hide')
});

function repair_order_add_service(repair_order_id, service_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/repair_order_add_service',
		type: 'POST',
		data: {repair_order_id:repair_order_id,service_id:service_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			
			modal.modal('show');
		}
	});
};

$(document).on("click", "#repair_order-service-add", function()
{
	$('#repair_order-form-service-add').ajaxSubmit({
		url: '/repair_order_add_service_store',
		type: 'PUT',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#selectedServicesTable tbody').append(`
					<tr id="repair_order_selected_service-${response.info.service_id}" class="pointer" onclick="repair_order_edit_service('${response.info.repair_order_id}','${response.info.service_id}');">
						<td scope="row">${response.info.article}</td>
						<td scope="row">${response.info.name}</td>
						<td scope="row" class="text-center employee">${response.info.employee}</td>
						<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
						<td scope="row" class="text-center discount">${parseFloat(response.info.discount).toFixed(2)}</td>
						<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
					</tr>
				`)
				//header
				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docServicesDiscountSum"]').html(parseFloat(response.docHeaderValues.docServicesDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docServicesDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docServicesDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docServicesCount"]').html(parseFloat(response.docHeaderValues.docServicesCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				$('[name="docServicesQuantity"]').html(parseFloat(response.docHeaderValues.docServicesQuantity).toFixed(2))
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))

				$('#modaledit').modal('hide')
			}
		}
	});
});

function repair_order_edit_service(repair_order_id,service_id)
{
	const modal = $('#modaledit');
	
	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{
		$.ajax({
			url: '/repair_order_edit_service',
			type: 'POST',
			data: {repair_order_id:repair_order_id,service_id:service_id},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(data)
			{
				modal.html(data);
				modal.find('.modaledit__close').on('click', function()
				{
					modal.modal('hide');
				});
				new SlimSelect({select: '#input-employee'});
				modal.modal('show');
			}
		});
	};
};

$(document).on("click", "#repair_order-service-update", function()
{
	$('#repair_order-form-service-update').ajaxSubmit({
		url: '/repair_order_update_service_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedServicesTable tbody #repair_order_selected_service-${response.info.service_id}`)
                tr.find('.employee').html(response.info.employee)
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.discount').html(parseFloat(response.info.discount).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))
				//header
				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docServicesDiscountSum"]').html(parseFloat(response.docHeaderValues.docServicesDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docServicesDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docServicesDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docServicesCount"]').html(parseFloat(response.docHeaderValues.docServicesCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				$('[name="docServicesQuantity"]').html(parseFloat(response.docHeaderValues.docServicesQuantity).toFixed(2))
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))

                $('#modaledit').modal('hide')
                $('#selectedServicesTable div').append(`<div id="add-repair_order_selected_service-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)

            }
        }
	});
});

$(document).on("click", "#repair_order-service-delete", function()
{
    $('#repair_order-form-service-update').ajaxSubmit({
		url: '/repair_order_delete_service',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedServicesTable tbody #repair_order_selected_service-${response.info.service_id}`).remove()
				//header
				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docServicesDiscountSum"]').html(parseFloat(response.docHeaderValues.docServicesDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docServicesDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docServicesDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docServicesCount"]').html(parseFloat(response.docHeaderValues.docServicesCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				$('[name="docServicesQuantity"]').html(parseFloat(response.docHeaderValues.docServicesQuantity).toFixed(2))
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))

                $('#modaledit').modal('hide')
            }
		}
    })
})

$('[name="repair_order_service_discount"]').on("change", function(e)
{
	$.ajax({
		url: '/repair_orders_change_services_discount',
		type: 'POST',
		dataType: 'json',
		data: { service_discount: $('[name="repair_order_service_discount"]').val(), repair_order: $('[name="repair_order"]').val()},
		
		success: response => {
		if (response.status == 1) {
			$('#selectedServicesTable tbody').html('')
			let tbody = ''
			response.info.forEach(item => {
				tbody += 
					`<tr id="repair_order_selected_service-${item.service_id}" class="pointer" onclick="repair_order_edit_service('${item.repair_order_id}','${item.service_id}');">
						<td scope="row">${item.article}</td>
						<td scope="row">${item.name}</td>
						<td scope="row" class="text-center employee">${item.employee}</td>
						<td scope="row" class="text-center price">${parseFloat(item.price).toFixed(2)}</td>
						<td scope="row" class="text-center discount">${parseFloat(item.discount).toFixed(2)}</td>
						<td scope="row" class="text-center total_amount">${parseFloat(item.total_amount).toFixed(2)}</td>
					</tr>`
			})
			$('#selectedServicesTable tbody').html(tbody)

			$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
			$('[name="docServicesDiscountSum"]').html(parseFloat(response.docHeaderValues.docServicesDiscountSum).toFixed(2))
			$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
			$('[name="docServicesDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docServicesDiscountedTotal).toFixed(2))
			$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
			$('[name="docServicesCount"]').html(parseFloat(response.docHeaderValues.docServicesCount).toFixed(2))
			$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
			$('[name="docServicesQuantity"]').html(parseFloat(response.docHeaderValues.docServicesQuantity).toFixed(2))
			$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
			}
		}
	});
});

/////////////////////////////////////**admincart**////////////////////////////////////////////////
function admincart_comment(admincart_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/admincart_comment',
		type: 'POST',
		data: {admincart_id:admincart_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#admincart-comment-update", function()
{
	$('#admincart-form-comment-update').ajaxSubmit({
		url: '/admincart_comment_update',
		type: 'post',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				$('#admincartComment').html('');
				$('#admincartComment').append(`${response.comment}`);
			}
			$('#modaledit').modal('hide')
		}
	});
});

$(document).on("click", "#admincart-comment-delete", function()
{
	$('#admincart-form-comment-update').ajaxSubmit({
		url: '/admincart_comment_delete',
		type: 'DELETE',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				$('#admincartComment').html('');
			}
			$('#modaledit').modal('hide')
		}
	});
});

$(document).on("click", "#admincart-single-product-add", function()
{
	var id = $('[name="productLive"]').val();
	if (checkId(id))
	{
		$('#admincart-form-single-product-add').ajaxSubmit({
			url: '/admincart_add_single_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
				$('#selectedProductsTable tbody').append(`
					<tr id="admincart_selected_product-${response.info.product_id}" class="pointer" ondblclick="admincart_edit_product('${response.info.admincart_id}','${response.info.product_id}');">
					<td scope="row">${response.info.article}</td>
					<td scope="row">${response.info.brand}</td>
					<td scope="row">${response.info.name}</td>
					<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
					<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
					<td scope="row" class="text-center price_in">${parseFloat(response.info.price_in).toFixed(2)}</td>
					<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
					<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
					</tr>
				`)
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				}
			}
		});
	}
	$('#singleProduct').modal('hide')
});
  
function admincart_add_product(admincart_id, product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/admincart_add_product',
		type: 'POST',
		data: {admincart_id:admincart_id,product_id:product_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#admincart-product-add", function()
{
	var id = $('[name="product_id"]').val();
	if (checkId(id)) {
		$('#admincart-form-product-add').ajaxSubmit({
			url: '/admincart_add_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="admincart_selected_product-${response.info.product_id}" class="pointer" ondblclick="admincart_edit_product('${response.info.admincart_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price_in">${parseFloat(response.info.price_in).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
					
					$('#modaledit').modal('hide')
				}
			}
		});
	}
	$('#modaledit').modal('hide')
});

function admincart_edit_product(admincart_id, product_id)
{
	const modal = $('#modaledit');

	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{
		$.ajax({
			url: '/admincart_edit_product',
			type: 'POST',
			data: {admincart_id:admincart_id, product_id:product_id},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(data)
			{
				modal.html(data);
				modal.find('.modaledit__close').on('click', function()
				{
					modal.modal('hide');
				});
				modal.modal('show');
			}
		});
	};
};

$(document).on("click", "#admincart-product-update", function()
{
	$('#admincart-form-product-update').ajaxSubmit({
		url: '/admincart_update_product_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedProductsTable tbody #admincart_selected_product-${response.info.product_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price_in').html(parseFloat(response.info.price_in).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))

				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')
				
                $('#selectedProductsTable div').append(`<div id="add-admincart_selected_product-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)
            }
        }
	});
});

$(document).on("click", "#admincart-product-delete", function()
{
    $('#admincart-form-product-update').ajaxSubmit({
		url: '/admincart_delete_product',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedProductsTable tbody #admincart_selected_product-${response.info.product_id}`).remove()
				
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')
            }
		}
    })
})

function admincart_search()
{
	var admincart_id = jQuery('#admincart_id').val();

	var catalog_search = document.getElementById("catalog_search").checked;//catalog_search
	var prices_search = document.getElementById("prices_search").checked;
	var oem_search = document.getElementById("oem_search").checked;//oem_search
	var ws_search = document.getElementById("ws_search").checked;//ws_search

	var admincart_product_search_input = jQuery('#admincart_product_search_input').val();
	
	if(admincart_product_search_input != '')
	{
		admincart_product_search_input = admincart_product_search_input.replace(/[^-a-zA-Z0-9.]+/g, '');
		{
			$.ajax({
				url: '/admincart_search',
				type: 'POST',
				data: {
					admincart_id:admincart_id,
					catalog_search:catalog_search,
					ws_search:ws_search,
					oem_search:oem_search,
					admincart_product_search_input:admincart_product_search_input,
					prices_search:prices_search
				},
				dataType: 'json',
				headers: {'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')},
				beforeSend: function ()
                {
					$('#admin_search_loader').removeClass('hidden');
				
				},
				success:function(data)
				{
					$('[name = "searchTable"]').html('');
					var html = "";
					for(var i = 0; i < data.length; i++)
					{
						html += `<tr>`;
						if(!data[i].product_id)
						{
							html += `<td>`+data[i].article+`</td>`;
						}
						else
						{
							html += `<td><a href="/products/`+data[i].product_id+`" title = "`+data[i].name+`" target="_blank">`+data[i].article+`</a></td>`;
						}
						html += `<td>`+data[i].brand+`</td>`;
						if(!data[i].name)
						{
							html += `<td> Name not set </td>`; 
						}
						else
						{
							html += `<td>`+data[i].name+`</td>`;
						}
						html += `<td>`+data[i].stocks+`</td>`;
						html += `<td>`+data[i].price+`</td>`;
						html += `<td><button type="button" class="btn btn-simple btn-selector btn-sm" OnClick="catalog_product_info('${data[i].bkey}','${data[i].akey}')"><i class="fas fa-info"></i></button></td>`;
						if(!data[i].product_id)
						{
							html += `<td><button type="button" class="btn btn-simple btn-selector btn-sm" OnClick="catalog_product_add_to_base(`+data[i].admincart_id+`,'${data[i].brand}','${data[i].article}','${data[i].name}')"><i class="fas fa-file-import"></i></button></td>`;
						}
						else
						{
							html += `<td></td>`; 
						}
						if(!data[i].product_id)
						{
							html += `<td name="tocart${data[i].pkey}"></td>`; 
						}
						else
						{
							html += `<td name="tocart${data[i].pkey}"><button type="button" class="btn btn-simple btn-selector btn-sm" OnClick="admincart_add_product(`+data[i].admincart_id+`,`+data[i].product_id+`)"><i class="fas fa-plus"></i></button></td>`;
						}
						
						html += `</tr>`;
					}
					$('[name="searchTable"]').append(html)
				},
				complete: function ()
                {
					$('#admin_search_loader').addClass('hidden')
				},
				error: function(xhr, textStatus, thrownError)
				{
					alert(xhr.status);alert(thrownError);
				}
			});
		};
	};
};

//**// admincart add from search product magic //**//

//adding from search table
function catalog_product_add_to_base(admincart_id, brand, article, product_name)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/admincarts/catalog_product_add_to_base',
		type: 'POST',
		data: {admincart_id:admincart_id, brand:brand, article:article, product_name:product_name},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-category'});
			new SlimSelect({select: '#input-group'});

			modal.modal('show');
		}
	});
};

//manual product add
function catalog_product_create(admincart_id)
{
	const modal = $('#modaledit');        
	$.ajax({
		url: '/admincarts/catalog_product_create',
		type: 'POST',
		data: {admincart_id:admincart_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-category'});
			new SlimSelect({select: '#input-brand'});
			new SlimSelect({select: '#input-group'});
			modal.modal('show');

		}
	});
};

$(document).on("click", "#admincart-product-create-from-search", function()
{
	$('#admincart-form-product_add_tobase_from_search').ajaxSubmit({
		url: '/admincarts/catalog_product_add_to_base_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#modaledit').modal('hide')
			}
		}
	});
});

$(document).on("click", "#admincart-product-create-from-search-add", function()
{
	$('#admincart-form-product_add_tobase_from_search').ajaxSubmit({
		url: '/admincarts/catalog_product_add_to_base_and_cart_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				$('#selectedProductsTable tbody').append(`
					<tr id="admincart_selected_product-${response.info.product_id}" class="pointer" ondblclick="admincart_edit_product('${response.info.admincart_id}','${response.info.product_id}');">
						<td scope="row">${response.info.article}</td>
						<td scope="row">${response.info.brand}</td>
						<td scope="row">${response.info.name}</td>
						<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
						<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
						<td scope="row" class="text-center price_in">${parseFloat(response.info.price_in).toFixed(2)}</td>
						<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
						<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
					</tr>
				`)

				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')
			}
		}
	});
});

//admincart add manual product magic
$(document).on("click", "#admincart-product-create-manual", function()
{
	$('#admincart-form-product_create_store').ajaxSubmit({
		url: '/admincarts/catalog_product_create_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#modaledit').modal('hide')
			}
		}
	});
});

$(document).on("click", "#admincart-product-create-manual-add", function()
{
	$('#admincart-form-product_create_store').ajaxSubmit({
		url: '/admincarts/catalog_product_create_add_to_cart_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#selectedProductsTable tbody').append(`
					<tr id="admincart_selected_product-${response.info.product_id}" class="pointer" ondblclick="admincart_edit_product('${response.info.admincart_id}','${response.info.product_id}');">
						<td scope="row">${response.info.article}</td>
						<td scope="row">${response.info.brand}</td>
						<td scope="row">${response.info.name}</td>
						<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
						<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
						<td scope="row" class="text-center price_in">${parseFloat(response.info.price_in).toFixed(2)}</td>
						<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
						<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
					</tr>
				`)
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')
			}
		}
	});
});

/////////////////////////////////////**client_order_correction**////////////////////////////////////////////////
$(document).on("click", "#client_order_correction-single-product-add", function()
{
	var id = $('[name="productLive"]').val();
	if (checkId(id)) {
		$('#client_order_correction-form-single-product-add').ajaxSubmit({
			url: '/client_order_correction_add_single_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="client_order_correction_selected_product-${response.info.product_id}" class="pointer" ondblclick="client_order_correction_edit_product('${response.info.client_order_correction_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total">${parseFloat(response.info.total).toFixed(2)}</td>
							<td scope="row" class="text-center discount">${parseFloat(response.info.discount).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
					$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

					
				}
			}
		});
	}
	$('#singleProduct').modal('hide')
});

function client_order_correction_add_product(client_order_correction_id, product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/client_order_correction_add_product',
		type: 'POST',
		data: {client_order_correction_id:client_order_correction_id,product_id:product_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#client_order_correction-product-add", function()
{
	var id = $('[name="product_id"]').val();
	if (checkId(id)) {
		$('#client_order_correction-form-product-add').ajaxSubmit({
			url: '/client_order_correction_add_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="client_order_correction_selected_product-${response.info.product_id}" class="pointer" ondblclick="client_order_correction_edit_product('${response.info.client_order_correction_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total">${parseFloat(response.info.total).toFixed(2)}</td>
							<td scope="row" class="text-center discount">${parseFloat(response.info.discount).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
					$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))					
				}
			}
		});
	}
	$('#modaledit').modal('hide')
});

function client_order_correction_edit_product(client_order_correction_id,product_id)
{
	const modal = $('#modaledit');
	
	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{
		$.ajax({
			url: '/client_order_correction_edit_product',
			type: 'POST',
			data: {client_order_correction_id:client_order_correction_id,product_id:product_id},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(data)
			{
				modal.html(data);
				modal.find('.modaledit__close').on('click', function()
				{
					modal.modal('hide');
				});
				modal.modal('show');
			}
		});
	};
};

$(document).on("click", "#client_order_correction-product-update", function()
{
	$('#client_order_correction-form-product-update').ajaxSubmit({
		url: '/client_order_correction_update_product_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedProductsTable tbody #client_order_correction_selected_product-${response.info.product_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total').html(parseFloat(response.info.total).toFixed(2))
                tr.find('.discount').html(parseFloat(response.info.discount).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))
				//header
				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

                $('#modaledit').modal('hide')
                $('#selectedProductsTable div').append(`<div id="add-client_order_correction_selected_product-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)

            }
        }
	});
});

$(document).on("click", "#client_order_correction-product-delete", function()
{
    $('#client_order_correction-form-product-update').ajaxSubmit({
		url: '/client_order_correction_delete_product',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedProductsTable tbody #client_order_correction_selected_product-${response.info.product_id}`).remove()
				//header
				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

                $('#modaledit').modal('hide')
            }
		}
    })
})

$('[name="client_order_correction_discount"]').on("change", function(e)
{
	$.ajax({
		url: '/client_order_corrections_change_discount',
		type: 'POST',
		dataType: 'json',
		data: { discount: $('[name="client_order_correction_discount"]').val(), client_order_correction: $('[name="client_order_correction"]').val()},
		
		success: response => {
		if (response.status == 1) {
			$('#selectedProductsTable tbody').html('')
			let tbody = ''
			response.info.forEach(item => {
				tbody += 
				`<tr id="client_order_correction_selected_product-${item.product_id}" class="pointer" ondblclick="client_order_correction_edit_product('${item.client_order_correction_id}','${item.product_id}');">
						<td scope="row" class="article">${item.article}</td>
						<td scope="row" class="brand">${item.brand}</td>
						<td scope="row" class="name">${item.name}</td>
						<td scope="row" class="text-center stock">${parseFloat(item.stock).toFixed(2)}</td>
						<td scope="row" class="text-center quantity">${parseFloat(item.quantity).toFixed(2)}</td>
						<td scope="row" class="text-center price">${parseFloat(item.price).toFixed(2)}</td>
						<td scope="row" class="text-center total">${parseFloat(item.total).toFixed(2)}</td>
						<td scope="row" class="text-center discount">${parseFloat(item.discount).toFixed(2)}</td>
						<td scope="row" class="text-center total_amount">${parseFloat(item.total_amount).toFixed(2)}</td>
					</tr>`
			})
			$('#selectedProductsTable tbody').html(tbody)

				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
			}
		}

	});
});

/////////////////////////////////////**warehouse_write_offs**////////////////////////////////////////////////
$(document).on("click", "#warehouse_write_off-single-product-add", function()
{
	var id = $('[name="productLive"]').val();
	if (checkId(id)) {
		$('#warehouse_write_off-form-single-product-add').ajaxSubmit({
			url: '/warehouse_write_off_add_single_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="warehouse_write_off_selected_product-${response.info.product_id}" class="pointer" ondblclick="warehouse_write_off_edit_product('${response.info.warehouse_write_off_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
					
					
				}
			}
		});
	}
	$('#singleProduct').modal('hide')
});

function warehouse_write_off_add_product(warehouse_write_off_id, product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/warehouse_write_off_add_product',
		type: 'POST',
		data: {warehouse_write_off_id:warehouse_write_off_id,product_id:product_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};
       
$(document).on("click", "#warehouse_write_off-product-add", function()
{
	var id = $('[name="product_id"]').val();
	if (checkId(id)) {
		$('#warehouse_write_off-form-product-add').ajaxSubmit({
			url: '/warehouse_write_off_add_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="warehouse_write_off_selected_product-${response.info.product_id}" class="pointer" ondblclick="warehouse_write_off_edit_product('${response.info.warehouse_write_off_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)

					//header
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				}
			}
		});
	}
	$('#modaledit').modal('hide')
});

function warehouse_write_off_edit_product(warehouse_write_off_id,product_id)
{
	const modal = $('#modaledit');
	
	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{
		$.ajax({
			url: '/warehouse_write_off_edit_product',
			type: 'POST',
			data: {warehouse_write_off_id:warehouse_write_off_id,product_id:product_id},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(data)
			{
				modal.html(data);
				modal.find('.modaledit__close').on('click', function()
				{
					modal.modal('hide');
				});
				modal.modal('show');
			}
		});
	};
};

$(document).on("click", "#warehouse_write_off-product-update", function()
{
	$('#warehouse_write_off-form-product-update').ajaxSubmit({
		url: '/warehouse_write_off_update_product_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedProductsTable tbody #warehouse_write_off_selected_product-${response.info.product_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))
				
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

				$('#modaledit').modal('hide')

                $('#selectedProductsTable div').append(`<div id="add-warehouse_write_off_selected_product-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)
            }
        }
	});
});

$(document).on("click", "#warehouse_write_off-product-delete", function()
{
    $('#warehouse_write_off-form-product-update').ajaxSubmit({
		url: '/warehouse_write_off_delete_product',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedProductsTable tbody #warehouse_write_off_selected_product-${response.info.product_id}`).remove()
				
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

				$('#modaledit').modal('hide')
            }
		}
    })
})

function warehouse_write_off_comment(warehouse_write_off_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/warehouse_write_off_comment',
		type: 'POST',
		data: {warehouse_write_off_id:warehouse_write_off_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#warehouse_write_off-comment-update", function()
{
	$('#warehouse_write_off-form-comment-update').ajaxSubmit({
		url: '/warehouse_write_off_comment_update',
		type: 'post',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				$('#warehouse_write_offComment').html('');
				$('#warehouse_write_offComment').append(`${response.comment}`);
			}
			$('#modaledit').modal('hide')
		}
	});
});

$(document).on("click", "#warehouse_write_off-comment-delete", function()
{
	$('#warehouse_write_off-form-comment-update').ajaxSubmit({
		url: '/warehouse_write_off_comment_delete',
		type: 'DELETE',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				$('#warehouse_write_offComment').html('');
			}
			$('#modaledit').modal('hide')
		}
	});
});

/////////////////////////////////////**alerts**////////////////////////////////////////////////

setTimeout(() => $('#alert-error').remove(), 30000)
setTimeout(() => $('#alert-errors').remove(), 30000)
setTimeout(() => $('#alert-feedback').remove(), 5000)
setTimeout(() => $('#alert-info').remove(), 5000)
setTimeout(() => $('#alert-success').remove(), 5000)