import {DatePicker} from 'element-ui';
import moment from "moment/moment";

//import VueHighcharts from 'vue-highcharts';


Vue.component('statistics-index', {
    props: {
        statistics: Object,

    },
    mounted() {
        this.getStatistics();
        this.delegates_statistics.series[0].data=this.statistics.delegates_statistics;
        this.clients_statistics.series[0].data=this.statistics.clients_statistics;
        this.drivers_statistics.series[0].data=this.statistics.drivers_statistics;
        this.package_orders_statistics.series[0].data=this.statistics.package_orders_statistics;
        this.taxi_orders_statistics.series[0].data=this.statistics.taxi_orders_statistics;
        this.options_complaint.series[0].data=this.statistics.complains_statistics_client.data;
        this.options_complaint.series[1].data=this.statistics.complains_statistics_delegate.data;
        this.options_complaint.series[2].data=this.statistics.complains_statistics_drivers.data;
        this.options_complaint.xAxis.categories=this.statistics.complains_statistics_delegate.category;
        this.options_cities.series[0].data=this.statistics.cities_user_count;
        this.options_cities.xAxis.categories=this.statistics.cities;

    },
    data(){
      return {
          search_date: '',
          total_budget: 0,
          drivers_budget: 0,
          delegate_budget: 0,
          net_profit: 0,
          total_income: 0,
          total_delegate_dept: 0,
          total_driver_dept: 0,

          delegates_statistics : {
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'
              },
              title: {
                  text: 'المندوبين',
                  x: -20 //center
              },
              // subtitle: {
              //     text: 'المندوبين',
              //     x: -20
              // },
              plotOptions: {
                  pie: {
                      allowPointSelect: true,
                      cursor: 'pointer',
                      dataLabels: {
                          enabled: false
                      },
                      showInLegend: true
                  }
              },
              tooltip: {
                  valueSuffix: 'مندوب'
              },
              legend: {
                  layout: 'vertical',
                  align: 'right',
                  verticalAlign: 'middle',
                  borderWidth: 0
              },
              series: [{
                  name: 'count',
                  colorByPoint: true,
                  data: []
              }]
          },

          clients_statistics : {
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'
              },
              title: {
                  text: 'العملاء',
                  x: -20 //center
              },
              // subtitle: {
              //     text: 'المندوبين',
              //     x: -20
              // },
              plotOptions: {
                  pie: {
                      allowPointSelect: true,
                      cursor: 'pointer',
                      dataLabels: {
                          enabled: false
                      },
                      showInLegend: true
                  }
              },
              tooltip: {
                  valueSuffix: 'عميل'
              },
              legend: {
                  layout: 'vertical',
                  align: 'right',
                  verticalAlign: 'middle',
                  borderWidth: 0
              },
              series: [{
                  name: 'count',
                  colorByPoint: true,
                  data: []
              }]
          },

          drivers_statistics : {
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'
              },
              title: {
                  text: 'السائقين',
                  x: -20 //center
              },
              // subtitle: {
              //     text: 'المندوبين',
              //     x: -20
              // },
              plotOptions: {
                  pie: {
                      allowPointSelect: true,
                      cursor: 'pointer',
                      dataLabels: {
                          enabled: false
                      },
                      showInLegend: true
                  }
              },
              tooltip: {
                  valueSuffix: 'سائق'
              },
              legend: {
                  layout: 'vertical',
                  align: 'right',
                  verticalAlign: 'middle',
                  borderWidth: 0
              },
              series: [{
                  name: 'count',
                  colorByPoint: true,
                  data: []
              }]
          },

          package_orders_statistics : {
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'
              },
              title: {
                  text: 'طلبيات التوصيل',
                  x: -20 //center
              },
              // subtitle: {
              //     text: 'المندوبين',
              //     x: -20
              // },
              plotOptions: {
                  pie: {
                      allowPointSelect: true,
                      cursor: 'pointer',
                      dataLabels: {
                          enabled: false
                      },
                      showInLegend: true
                  }
              },
              tooltip: {
                  valueSuffix: 'طلب'
              },
              legend: {
                  layout: 'vertical',
                  align: 'right',
                  verticalAlign: 'middle',
                  borderWidth: 0
              },
              series: [{
                  name: 'count',
                  colorByPoint: true,
                  data: []
              }]
          },

          taxi_orders_statistics : {
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'
              },
              title: {
                  text: 'طلبيات التاكسي',
                  x: -20 //center
              },
              // subtitle: {
              //     text: 'المندوبين',
              //     x: -20
              // },
              plotOptions: {
                  pie: {
                      allowPointSelect: true,
                      cursor: 'pointer',
                      dataLabels: {
                          enabled: false
                      },
                      showInLegend: true
                  }
              },
              tooltip: {
                  valueSuffix: 'طلب'
              },
              legend: {
                  layout: 'vertical',
                  align: 'right',
                  verticalAlign: 'middle',
                  borderWidth: 0
              },
              series: [{
                  name: 'count',
                  colorByPoint: true,
                  data: []
              }]
          },

          options_complaint :{
              chart: {
                  type: 'line'
              },
              title: {
                  text: 'الشكاوي'
              },
              subtitle: {
                  text: 'شكاوي المندوبين والعملاءو السائقين'
              },
              xAxis: {
                  categories: []
              },
              yAxis: {
                  title: {
                      text: 'عدد الشكاوي'
                  }
              },
              plotOptions: {
                  line: {
                      dataLabels: {
                          enabled: true
                      },
                      enableMouseTracking: false
                  }
              },
              series: [{
                  name: 'العملاء',
                  data: []
              }, {
                  name: 'المندوبين',
                  data: []
              }, {
                  name: 'السائقين',
                  data: []
              }]
          },

          options_cities : {
              chart: {
                  type: 'column'
              },
              title: {
                  text: 'توزيع العملاء على المدن',
                  x: -20 //center
              },

              xAxis: {
                  categories: [ ]
              },
              yAxis: {
                  className: 'highcharts-color-1',
                  title: {
                      text: 'عدد العملاء'
                  },
                  plotLines: [{
                      value: 0,
                      width: 5,
                      color: '#808080'
                  }]
              },
              tooltip: {
                  headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                  pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style="padding:0"><b>{point.y}</b></td></tr>',
                  footerFormat: '</table>',
                  shared: true,
                  useHTML: true
              },
              plotOptions: {
                  column: {
                      pointPadding: 0.2,
                      borderWidth: 0
                  }
              },
              legend: {
                  layout: 'vertical',
                  align: 'right',
                  verticalAlign: 'middle',
                  borderWidth: 0
              },
              series: [{
                  name: 'المدن',
                  data: []
              }]
          },
      }
    },

    methods: {
        async fetchData({ page, filter, sort }) {
            const response = await axios.get('/dashboard/notifications/data', {params: { page, filter, sort }});
            this.loading = false;
            return {
                data: response.data.notifications.data,
                pagination: {
                    currentPage: response.data.notifications.current_page,
                    totalPages: response.data.notifications.last_page
                }
            };
        },

        getStatistics(){
            axios.get('/dashboard/statistics/getStatistics').then(response => {
                this.total_budget=response.data.total_budget;
                this.drivers_budget=response.data.drivers_budget;
                this.delegate_budget=response.data.delegate_budget;
                this.net_profit=response.data.net_profit;
                this.total_income=response.data.total_income;
                this.total_delegate_dept=response.data.total_delegate_dept;
                this.total_driver_dept=response.data.total_driver_dept;

            });
        }
    },
    components: {
        moment,
        'el-date-picker': DatePicker,
    }
})
