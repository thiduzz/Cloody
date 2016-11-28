
<template>
    <div class="widget-17 panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="pg-charts"></i> Truck Stats //TODO - USAR DADOS REAIS
            </div>
        </div>
        <div class="panel-body">
            <div class="p-l-5">
                <div class="row">
                    <div class="col-md-12 col-xlg-6">
                        <div class="row m-t-20">
                            <div class="col-md-5">
                                <h4 class="no-margin">Last Active in</h4>

                                <p class="small hint-text">9th August 2014</p>
                            </div>
                            <div class="col-md-7">
                                <div class="pull-left">
                                    <p class="small hint-text no-margin">Current Funds</p>
                                    <h4 class="text-danger bold no-margin">VALOR TOTAL
                                        <span class="small">/ VALOR SAQUE</span>
                                    </h4>
                                </div>
                            </div>
                        </div>

                        <p>Sales information</p>

                        <div class="widget-17-weather">
                            <div class="row">
                                <div class="col-xs-6 p-r-10">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="pull-left">Current Month Sales</p>

                                            <p class="pull-right bold">123</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="pull-left">Current Month Funds</p>

                                            <p class="pull-right bold">R$120,00</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="pull-left">Total Cloody Revenue</p>

                                            <p class="pull-right bold">R$120,00</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="pull-left">Last Promotion</p>

                                            <p class="pull-right bold">9th August 2014</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 p-l-10">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="pull-left">Most Requested Menu Item<br>
                                            <span class="pull-left bold">Shrimp with olives</span></p>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="pull-left">Least Requested Menu Item<br>
                                            <span class="pull-left bold">Cucumber with lettuce</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-10 timeslot">
                                <h2>TODO// INSERT FUNDS CHARTS</h2>
                        </div>
                    </div>
                    <div class="col-xlg-6 visible-xlg">
                        <div class="row">
                            <div class="forecast-day col-md-6 text-center m-t-10 ">
                                <div class="bg-master-lighter p-b-10 p-t-10">
                                    <h4 class="p-t-10 no-margin">Tuesday</h4>

                                    <p class="small hint-text m-b-20">11th Augest 2014</p>
                                    <canvas class="rain" width="64" height="64"></canvas>
                                    <h5 class="text-danger">32°</h5>

                                    <p>Feels like
                                        <span class="bold">sunny</span>
                                    </p>

                                    <p class="small">Wind
                                        <span class="bold p-l-20">11km/h</span>
                                    </p>

                                    <div class="m-t-20 block">
                                        <div class="padding-10">
                                            <div class="row">
                                                <div class="col-md-6 text-center">
                                                    <p class="small">Noon</p>
                                                    <canvas class="sleet" width="25" height="25"></canvas>
                                                    <p class="text-danger bold">30°C</p>
                                                </div>
                                                <div class="col-md-6 text-center">
                                                    <p class="small">Night</p>
                                                    <canvas class="wind" width="25" height="25"></canvas>
                                                    <p class="text-danger bold">30°C</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-center m-t-10 ">
                                <div class="bg-master-lighter p-b-10 p-t-10">
                                    <h4 class="p-t-10 no-margin">Wednesday</h4>

                                    <p class="small hint-text m-b-20">11th Augest 2014</p>
                                    <canvas class="rain" width="64" height="64"></canvas>
                                    <h5 class="text-danger">32°</h5>

                                    <p>Feels like
                                        <span class="bold">sunny</span>
                                    </p>

                                    <p class="small">Wind
                                        <span class="bold p-l-20">11km/h</span>
                                    </p>

                                    <div class="m-t-20 block">
                                        <div class="padding-10">
                                            <div class="row">
                                                <div class="col-md-6 text-center">
                                                    <p class="small">Noon</p>
                                                    <canvas class="sleet" width="25" height="25"></canvas>
                                                    <p class="text-danger bold">30°C</p>
                                                </div>
                                                <div class="col-md-6 text-center">
                                                    <p class="small">Night</p>
                                                    <canvas class="wind" width="25" height="25"></canvas>
                                                    <p class="text-danger bold">30°C</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
         locales: {
            //that.$t('p_category_e')
            //Vue.t('messages.fatal_title')
            //{{{ $t('title') }}}
            //{{{ $t('messages.hello') }}}
            en: {
                export_tooltip: 'Export',
                cal_week_su: 'Su',
                cal_week_mo: 'Mo',
                cal_week_tu: 'Tu',
                cal_week_we: 'We',
                cal_week_th: 'Th',
                cal_week_fr: 'Fr',
                cal_week_sa: 'Sa',
                cal_month_ja: 'January',
                cal_month_fe: 'February',
                cal_month_ma: 'March',
                cal_month_ap: 'April',
                cal_month_may: 'May',
                cal_month_jun: 'June',
                cal_month_jul: 'July',
                cal_month_au: 'August',
                cal_month_se: 'September',
                cal_month_oc: 'October',
                cal_month_no: 'November',
                cal_month_de: 'December',
                cal_format: "DD/MM/YYYY",
            },
            pt_BR: {
                export_tooltip: 'Exportar',
                cal_week_su: 'Dom',
                cal_week_mo: 'Seg',
                cal_week_tu: 'Ter',
                cal_week_we: 'Qua',
                cal_week_th: 'Qui',
                cal_week_fr: 'Sex',
                cal_week_sa: 'Sab',
                cal_month_ja: 'Janeiro',
                cal_month_fe: 'Fevereiro',
                cal_month_ma: 'Março',
                cal_month_ap: 'Abril',
                cal_month_may: 'Maio',
                cal_month_jun: 'Junho',
                cal_month_jul: 'Julho',
                cal_month_au: 'Agosto',
                cal_month_se: 'Setembro',
                cal_month_oc: 'Outubro',
                cal_month_no: 'Novembro',
                cal_month_de: 'Dezembro',
                cal_format: "DD/MM/YYYY",
            }

        },
        data() {
            return {
               
                export_filter:{
                  end:moment().format('YYYY-MM-DD'),
                  start:moment().subtract(1, 'months').format('YYYY-MM-DD')
                },
                
            };
        },
        ready() {
            var that = this;            
            $('#filter').daterangepicker({
                "singleDatePicker": false,
                "showDropdowns": true,
                "drops": "up",
                "startDate": moment().subtract(1, 'months').format('DD/MM/YYYY'),
                "endDate": moment().format('DD/MM/YYYY'),
                "minDate": moment().subtract(5, 'years').format('DD/MM/YYYY'),
                "locale":{
                    "format": that.$t('cal_format'),
                    "daysOfWeek": [
                        that.$t('cal_week_su'),
                        that.$t('cal_week_mo'),
                        that.$t('cal_week_tu'),
                        that.$t('cal_week_we'),
                        that.$t('cal_week_th'),
                        that.$t('cal_week_fr'),
                        that.$t('cal_week_sa')
                    ],
                    "monthNames": [
                        that.$t('cal_month_ja'),
                        that.$t('cal_month_fe'),
                        that.$t('cal_month_ma'),
                        that.$t('cal_month_ap'),
                        that.$t('cal_month_may'),
                        that.$t('cal_month_jun'),
                        that.$t('cal_month_jul'),
                        that.$t('cal_month_au'),
                        that.$t('cal_month_se'),
                        that.$t('cal_month_oc'),
                        that.$t('cal_month_no'),
                        that.$t('cal_month_de')
                    ]
                }
            }, function(start, end, label) {
                Vue.set(that.export_filter, 'start', start.format('YYYY-MM-DD'));
                Vue.set(that.export_filter, 'end', end.format('YYYY-MM-DD'));
            });
        },

        methods: {
            avatarUpload() {
                this.$els.fileinput.click()
            }            
        }
    }
</script>
