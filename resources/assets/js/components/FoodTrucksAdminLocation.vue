   <style scoped>
      .modal.fill-in{
        background-color: #fff !important;
      }
    </style>

<template>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1YvebOcyhWtWsGhTiP6tHS3FX39UFYy4"
            async defer></script>

    <div class="modal fade fill-in" id="locationModal" tabindex="-1" role="dialog" aria-hidden="true">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="pg-close"></i>
        </button>
        <div class="modal-dialog full-width full-height"  style="padding-top: 0;">
            <div class="modal-content"  style="padding-top: 0;vertical-align: top;">
                <div class="modal-header" style="padding-top: 0;">
                    <h5 class="text-left p-b-5">Truck <span class="semi-bold">Location</span></h5>
                </div>
                <div class="modal-body">
                    <!-- START CONTENT INNER -->
                    <div class="map-controls">
                      <div class="pull-left">
                        <div class="btn-group btn-group-vertical" data-toggle="buttons-radio">
                          <button id="map-zoom-in" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>
                          </button>
                          <button id="map-zoom-out" class="btn btn-success btn-xs"><i class="fa fa-minus"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                    <!-- Map -->
                    <div class="map-container full-width full-height">
                      <div id="google-map" class="full-width full-height" style="min-height: 500px;"></div>
                    </div>
                    <!-- END CONTENT INNER -->
                </div>
                <div class="modal-footer">
                  <div class="row form-horizontal">
                    <div class="col-sm-12 col-lg-offset-4 col-lg-4">

                        <div class="form-group" style="padding-top: 0;">
                            <label for="filter" class="col-sm-5 control-label" style="text-align:right;">Filter</label>
                            <div class="input-group">
                              <input type="text" class="form-control" name="location-filter" id="location-filter" readonly="true" style="background-color:white !important;">
                              <span class="input-group-addon primary" v-show="export_filter.start != '0000-00-00' && export_filter.end != '0000-00-00'" target="_blank" tabindex="-1" :href="'/admin_trucks/export/list?extension=xls&start='+export_filter.start+'&end='+export_filter.end" class="btn btn-social-icon" data-toggle="tooltip" data-title="Filter">
                                        
                                        <i class="fa fa-align-justify"></i> 
                              </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-3" >
                    </div>
                  </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


</template>

<script>
    export default {
        /*
         * The component's data.
         */
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
                map: null,
                markers:[],
                export_filter:{
                  end:moment().subtract(1, 'days').startOf('day').format('YYYY-MM-DD'),
                  start:moment().endOf('day').format('YYYY-MM-DD')
                },
            };
        },
        ready() {
            var that = this;         
            $('#locationModal').on('shown.bs.modal', function () {
                google.maps.event.trigger(that.map, "resize");
                var reCenter = new google.maps.LatLng(-25.414014, -49.262028);
                that.map.setCenter(reCenter);

                /**
                  var bounds = new google.maps.LatLngBounds();
                  for (var i = 0; i < markers.length; i++) {
                   bounds.extend(that.markers[i].getPosition());
                  }
                  that.map.fitBounds(bounds);
                **/
            }); 
            $('#location-filter').daterangepicker({
                "singleDatePicker": false,
                "showDropdowns": true,
                "drops": "up",
                "startDate": moment().subtract(1, 'days').startOf('day').format('DD/MM/YYYY'),
                "endDate": moment().endOf('day').format('DD/MM/YYYY'),
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

            that.$http.post('/api/truck-approval', {truck_id:id,type:type,message:user_message})
              .then(function(response) {
                if(response.data.success)
                {
                  $(response.data.results).each(function( index, error ) {
                    //Create markers
                    that.markers.push()
                  });
                  this.initMap(); 
                }
              })
              .catch(function(response) {
                  if (typeof response.data === 'object') {
                      var errors = _.flatten(_.toArray(response.data));
                      $(errors).each(function( index, error ) {
                          $('body').pgNotification({
                              style: 'flip',
                              title: 'Error!',
                              message: error,
                              position: "top-right",
                              timeout: 5000,
                              type: "danger"
                          }).show();
                      });
                  } else {
                      $('body').pgNotification({
                          style: 'flip',
                          title: 'Error!',
                          message: 'Something went wrong when requesting truck locations. Please try again.',
                          position: "top-right",
                          timeout: 5000,
                          type: "danger"
                      }).show();
                  }
              })
              .bind(that); 
        },

        methods: {
            initMap() {
              this.map = new google.maps.Map(document.getElementById('google-map'), {
                  center: new google.maps.LatLng(-25.414014, -49.262028), // New York
                  zoom: 11,
                  disableDefaultUI: true,
                  styles: [{
                  featureType: 'water',
                  elementType: 'all',
                  stylers: [{
                      hue: '#e9ebed'
                  }, {
                      saturation: -78
                  }, {
                      lightness: 67
                  }, {
                      visibility: 'simplified'
                  }]
              }, {
                  featureType: 'landscape',
                  elementType: 'all',
                  stylers: [{
                      hue: '#ffffff'
                  }, {
                      saturation: -100
                  }, {
                      lightness: 100
                  }, {
                      visibility: 'simplified'
                  }]
              }, {
                  featureType: 'road',
                  elementType: 'geometry',
                  stylers: [{
                      hue: '#bbc0c4'
                  }, {
                      saturation: -93
                  }, {
                      lightness: 31
                  }, {
                      visibility: 'simplified'
                  }]
              }, {
                  featureType: 'poi',
                  elementType: 'all',
                  stylers: [{
                      hue: '#ffffff'
                  }, {
                      saturation: -100
                  }, {
                      lightness: 100
                  }, {
                      visibility: 'off'
                  }]
              }, {
                  featureType: 'road.local',
                  elementType: 'geometry',
                  stylers: [{
                      hue: '#e9ebed'
                  }, {
                      saturation: -90
                  }, {
                      lightness: -8
                  }, {
                      visibility: 'simplified'
                  }]
              }, {
                  featureType: 'transit',
                  elementType: 'all',
                  stylers: [{
                      hue: '#e9ebed'
                  }, {
                      saturation: 10
                  }, {
                      lightness: 69
                  }, {
                      visibility: 'on'
                  }]
              }, {
                  featureType: 'administrative.locality',
                  elementType: 'all',
                  stylers: [{
                      hue: '#2c2e33'
                  }, {
                      saturation: 7
                  }, {
                      lightness: 19
                  }, {
                      visibility: 'on'
                  }]
              }, {
                  featureType: 'road',
                  elementType: 'labels',
                  stylers: [{
                      hue: '#bbc0c4'
                  }, {
                      saturation: -93
                  }, {
                      lightness: 31
                  }, {
                      visibility: 'on'
                  }]
              }, {
                  featureType: 'road.arterial',
                  elementType: 'labels',
                  stylers: [{
                      hue: '#bbc0c4'
                  }, {
                      saturation: -93
                  }, {
                      lightness: -2
                  }, {
                      visibility: 'simplified'
                  }]
              }]
              });
          }
            
        }
    }
</script>
