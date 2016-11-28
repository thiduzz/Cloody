<style scoped>
    .action-link {
        cursor: pointer;
    }

    .m-b-none {
        margin-bottom: 0;
    } 

    .alert ul li{
        list-style: none;
    }
    button i{
        top: 0 !important;
    }
    button span{
        padding-left: 10px;
    }
    .highlighted_holderImage{
        height: 100%;
        position:relative;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        text-align: center;
    }

    .highlighted_holder_sm{
        width: 100%;
        height: 180px;
        min-height: 180px;
        min-width: 180px;
        max-width: 180px;
        position: relative;
    }
    .switch-detail{

        line-height: 1.2;
        font-size: 13px;
    }
    </style>

<template>
    <div class="row">
        <div class="col-md-6">
            <!-- START PANEL -->
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-title">
                  Company Info
                </div>
              </div>
              <div class="panel-body">
                  <div class="form-group">
                    <label>Formal Name</label>
                    <input type="text" class="form-control" v-model="truck.formal_name">
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Identification</label>
                        <span class="help">For the invoice</span>
                        <input type="text" class="form-control" v-model="truck.identification">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Phone</label>
                        <span class="help">Office/Headquarters phone</span>
                        <input type="text" class="form-control" v-model="truck.phone">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <span class="help">Office/Headquarters address</span>
                    <input type="text" class="form-control" v-model="truck.address">
                  </div>
              </div>
            </div>
            <!-- END PANEL -->
            <foodtrucks-admin-stats></foodtrucks-admin-stats>
        </div>
        <div class="col-md-6">
            <!-- START PANEL -->
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-title">
                  Truck Info
                </div>
                  <div class="panel-controls">
                      <ul>
                          <li>
                              <i class="fa fa-circle" v-bind:style="{color: (truck.enabled == 1 && status != 'denied' ? 'green' : 'red')}"></i>&nbsp;&nbsp;<span>{{ (truck.enabled == 1 && status != 'denied' ? 'Enabled' : 'Disabled') }}</span>
                          </li>
                      </ul>
                  </div>
              </div>
              <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4">
                        <a href="javascript:;"  class="thumbnail highlighted_holder_sm" style="margin-bottom: 10px;" @click="avatarUpload">
                          <div v-if="truck.logo_url != ''" class="highlighted_holderImage" alt="Truck Logo" style="height: 170px; width: 170px; margin:0 auto; display: block;"  v-bind:style="{ 'background-image': 'url(' + truck.logo_url + ')' }"></div>
                          <div v-if="truck.logo_url == ''" class="highlighted_holderImage" alt="Truck Logo" style="height: 170px; width: 170px; margin:0 auto; display: block;"  v-bind:style="{ 'background-image': 'url(../../images/public/extras/200x200.gif)' }"></div>
                        </a>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 30px;">
                    <div class="col-lg-12" style="text-align: center;font-size: 12px;">
                        <input  type="file" id="fileInput" v-el:fileInput style="display:none;" @change="avatarChanged" accept="image/png, image/x-png, image/gif, image/jpeg" />
                        <a href="javascript:;" @click="avatarUpload">Change logo</a><br>
                        <a href="javascript:;" @click="removeAvatar" v-if="truck.logo_url != ''">Remove logo</a><br>
                        <span v-if="avatar_name != ''">Selected file: {{ avatar_name }}</span>
                    </div>
                </div>
                  <div class="form-group">
                    <label>Truck Name</label>
                    <input type="email" class="form-control" required="" v-model="truck.name">
                  </div>
                  <div class="form-group form-group-default form-group-default-select2 required">
                        <label class="">Status</label>
                        <select id="status-select" class="full-width" v-model="truck.status">
                            <option value="available">Available</option>
                            <option value="transit">Transit</option>
                            <option value="unavailable">Unavailable</option>
                            <option value="denied">Denied</option>
                        </select>
                  </div>
                  <div class="form-group form-group-default form-group-default-select2 required">
                      <label class="">Service Type</label>
                      <select id="type-select" class="full-width" placeholder="Loading...">
                          <option value="{{service.slug}}" v-for="service in service_types">{{service.name}}</option>
                      </select>
                  </div>
                  <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group" style="margin-bottom: 0;">
                          <label style="margin-bottom: 0;">Bike Delivery</label>  
                    </div>      
                    <div class="radio radio-success">
                      <input type="radio" value="1" name="deliverybike" id="deliverybike-yes" v-model="truck.delivery_bike">
                      <label for="deliverybike-yes">Enabled</label>
                      <input type="radio" value="0" name="deliverybike" id="deliverybike-no" v-model="truck.delivery_bike">
                      <label for="deliverybike-no">Disabled</label>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group" style="margin-bottom: 0;">
                      <label style="margin-bottom: 0;">Motorbike Delivery</label>  
                    </div>   
                    <div class="radio radio-success">
                      <input type="radio" value="1" name="deliverymotorcycle" id="deliverymotorcycle-yes" v-model="truck.delivery_motorcycle">
                      <label for="deliverymotorcycle-yes">Enabled</label>
                      <input type="radio" value="0" name="deliverymotorcycle" id="deliverymotorcycle-no" v-model="truck.delivery_motorcycle">
                      <label for="deliverymotorcycle-no">Disabled</label>
                    </div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group" style="margin-bottom: 0;">
                      <label style="margin-bottom: 0;">Let's Negotiate</label>  
                    </div>   
                    <div class="radio radio-success">
                      <input type="radio" value="1" name="lets_negotiate" id="lets_negotiate-yes" v-model="truck.lets_negotiate">
                      <label for="lets_negotiate-yes">Enabled</label>
                      <input type="radio" value="0" name="lets_negotiate" id="lets_negotiate-no" v-model="truck.lets_negotiate">
                      <label for="lets_negotiate-no">Disabled</label>
                    </div>
                  </div>                  
                  </div>
                    


              </div>
            </div>
            <!-- END PANEL -->
            <button class="btn btn-lg btn-rounded btn-primary m-b-20 center-block" @click="patch"   v-bind:class="{ 'disabled': progress }">
                    <span class="pull-left"><i class="pg-save"></i>
                    </span>
                    <span>Save</span>
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span>
                            Users
                        </span>
                    </div>
                </div>

                <div class="panel-body">
                    <div id="pending_trucks">
                        <v-server-table url="" :columns="userstable_columns" :options="userstable_options"  v-ref:userstable></v-server-table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span>
                             <h3>TODO// Payments List</h3>
                        </span>
                    </div>
                </div>

                <div class="panel-body">
                    <div id="current_trucks">
                        <v-server-table url="/api/admin-current-trucks" :columns="trucks_current_columns" :options="trucks_current_options" v-ref:currenttable></v-server-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        

    </div>
        <div class="row form-horizontal">

            <div class="col-sm-12 col-lg-6">

                <div class="form-group" style="padding-top: 0;">
                    <label for="filter" class="col-sm-5 control-label" style="text-align:right;">Export</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="filter" id="filter" readonly="true" style="background-color:white !important;">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-3" v-show="export_filter.start != '0000-00-00' && export_filter.end != '0000-00-00'">
                <a target="_blank" tabindex="-1" :href="'/admin_trucks/export/list?extension=xls&start='+export_filter.start+'&end='+export_filter.end" class="btn btn-social-icon" data-toggle="tooltip" data-title="{{{ $t('export_tooltip') }}} XLS"><i class="fa fa-file-excel-o"></i></a>
                <a target="_blank" tabindex="-1" :href="'/admin_trucks/export/list?extension=csv&start='+export_filter.start+'&end='+export_filter.end" class="btn btn-social-icon" data-toggle="tooltip" data-title="{{{ $t('export_tooltip') }}} CSV"><i class="fa fa-file-text-o"></i></a>
                <a target="_blank" tabindex="-1" :href="'/admin_trucks/export/list?extension=xml&start='+export_filter.start+'&end='+export_filter.end" class="btn btn-social-icon" data-toggle="tooltip" data-title="{{{ $t('export_tooltip') }}} XML"><i class="fa fa-file-code-o"></i></a>
            </div>
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
                truck: Cloody.truck,
                status: Cloody.truck.status,
                progress: false,
                avatar_name: '',
                previous_avatar:'',
                service_types: [],
                totalPages: 0,
                page: 0,
                paginationStart: 0,
                pages: [],
                export_filter:{
                  end:moment().format('YYYY-MM-DD'),
                  start:moment().subtract(1, 'months').format('YYYY-MM-DD')
                },
                userstable_columns: ['id','name','created_at'],
                userstable_options: {
                    perPage: 5,
                    dateColumns: ['created_at'],
                    perPageValues:[5,10,20,30,40,50,100],
                    texts:{
                        count:'{count} Users',
                        filter: 'Filter by:',
                        filterPlaceholder: 'Term',
                        limit: 'Max. records:',
                        noResults: 'No users were found',
                        page: 'Page:', // for dropdown pagination,
                        filterBy:'Filter', // Placeholder for search fields when filtering by column
                        loading: 'Loading...', // First request to server
                        defaultOption:'Select {column}' // default option for list filters
                    },
                    headings: {
                        id: 'ID',
                        created_at: 'Created At',
                        name: 'Name',
                        actions: 'Actions',
                    },
                    filterable:['id','name'],
                    sortable:['id','name','created_at'],
                    onRowClick:function(row){
                        console.debug(row);
                    },
                    templates: {
                        created_at: function(row) {
                            return moment(row.created_at).format('DD/MM/YYYY H:m');
                          } 
                    }
                },

                trucks_current_columns: ['id','name','type','users', 'created_at'],
                trucks_current_options: {
                    perPage: 10,
                    dateColumns: ['created_at'],
                    perPageValues:[5,10,20,30,40,50,100],
                    texts:{
                        count:'{count} Trucks',
                        filter: 'Filter by:',
                        filterPlaceholder: 'Term',
                        limit: 'Max. records:',
                        noResults: 'No foodtrucks were found',
                        page: 'Page:', // for dropdown pagination,
                        filterBy:'Filter', // Placeholder for search fields when filtering by column
                        loading: 'Loading...', // First request to server
                        defaultOption:'Select {column}' // default option for list filters
                    },
                    headings: {
                        id: 'ID',
                        created_at: 'Created At',
                        name: 'Truck',
                        type: 'Service Type',
                        users: 'Owner',
                        actions: 'Actions',
                    },
                    filterable:['id','name','created_at'],
                    sortable:['id','name','created_at'],
                    onRowClick:function(row){
                        console.debug(row);
                    },
                    templates: {

                        created_at: function(row) {
                            return moment(row.created_at).format('DD/MM/YYYY H:m');
                          } ,
                        type: function(row) {
                            return row.service_type.name;
                          } ,
                        users: function(row) {
                            return '<a href="/profile/'+row.users[0].slug+'">'+row.users[0].name+'</a>';
                          } ,
                        actions: "<div class='btn-group'><a href='/admin_trucks/{id}/edit'  class='btn btn-success'>"+
                        "<i class='fa fa-edit' data-toggle='tooltip' data-original-title='Edit'></i>"+
                        "</a><a href='javascript:;' @click='$parent.destroy({id})' class='btn btn-danger'>"+
                        "<i data-toggle='tooltip' data-original-title='Cancel' class='fa fa-trash-o'></i></a></div>"
                    },
                    customFilters: [{
                        name: 'alphabet',
                        callback: function(row, query) {
                            return row.name[0] == query;
                        }
                    }]
                }
            };
        },
        ready() {
            var that = this;
            
            this.$refs.userstable.url = "/api/truck/"+this.truck.id+"/users"
            this.$refs.userstable.refresh()
            this.$on('breadcrumbSave', function (param) {
                that.patch();
            });

            $('#status-select').select2({
                placeholder: 'Select a status',
                minimumResultsForSearch: ($(this).attr('data-disable-search') == 'true' ? -1 : 1)
            }).on('select2-opening', function() {
                $.fn.scrollbar && $('.select2-results').scrollbar({
                    ignoreMobile: false
                })
            });

            $('#type-select').select2({
                minimumResultsForSearch: ($(this).attr('data-disable-search') == 'true' ? -1 : 1)
            }).on('select2-opening', function() {
                $.fn.scrollbar && $('.select2-results').scrollbar({
                    ignoreMobile: false
                })
            }).on('select2-selected', function (evt) {

                var selected = that.service_types.filter(function (item) {
                  return (item.slug == evt.val);
                })
                if(selected.length > 0)
                {
                that.truck.service_type = selected[0];
                that.truck.service_type_di = selected[0].id;                    
                }
                return true;
            });

            this.$http.get('/api/service-type')
                        .then(response => {
                this.service_types = response.data;
                $("#type-select").select2().select2('data',{id:that.truck.service_type.slug,text:that.truck.service_type.name});

            })
            .catch(response => {
                console.log("Could not load service types. It is recommended to reload the page");
            });

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
            },
            avatarChanged() {
                if(this.$els.fileinput.files != null)
                {
                    if(this.$els.fileinput.files.length > 0)
                    {
                        if(this.$els.fileinput.files[0].type == 'image/png' || this.$els.fileinput.files[0].type == 'image/x-png' ||  this.$els.fileinput.files[0].type == 'image/gif' ||  this.$els.fileinput.files[0].type == 'image/jpeg')
                        {
                            this.avatar_name = this.$els.fileinput.files[0].name;
                            var reader = new FileReader();
                            var that = this;
                            reader.onload = function (e) {
                                that.previous_avatar = JSON.parse(JSON.stringify(that.truck.logo_url));
                                that.truck.logo_url = e.target.result;
                            }
                            reader.readAsDataURL(this.$els.fileinput.files[0]);
                        }else{
                            this.avatar_name = '';
                            this.truck.logo_url = '';
                            this.truck.logo = '';
                            $('body').pgNotification({
                                    style: 'flip',
                                    title: 'Error!',
                                    message: 'Invalid logo format, please try again with a different file.',
                                    position: "top-right",
                                    timeout: 5000,
                                    type: "danger"
                            }).show();

                        }
                    }else{
                        this.avatar_name = '';
                        this.truck.logo_url = '';
                        this.truck.logo = '';
                    }
                }else{
                    this.avatar_name = '';
                    this.truck.logo_url = '';
                    this.truck.logo = '';
                }
                
            },
            removeAvatar()
            {
                this.avatar_name = '';
                this.truck.logo_url = '';
                this.truck.logo = '';
            },
            patch()
            {
                var that = this;
                var data = new FormData();
                if(this.$els.fileinput.files != null)
                {
                    if(this.$els.fileinput.files.length > 0)
                    {
                        if(this.$els.fileinput.files[0].type == 'image/png' || this.$els.fileinput.files[0].type == 'image/x-png' ||  this.$els.fileinput.files[0].type == 'image/gif' ||  this.$els.fileinput.files[0].type == 'image/jpeg')
                        {
                            data.append('foodtruck_new_logo', this.$els.fileinput.files[0]);
                        }else{
                            $('body').pgNotification({
                                style: 'flip',
                                title: 'Error!',
                                message: 'The image format is invalid!',
                                position: "top-right",
                                timeout: 5000,
                                type: "danger"
                            }).show();
                        }
                   }
                }
                for(var key in this.truck){
                    if(typeof(this.truck[key]) == 'object' || typeof(this.truck[key]) == 'Array')
                    {
                        for(var sub_key in this.truck[key]){
                            data.append('foodtruck_'+key+'.'+sub_key, this.truck[key][sub_key]);                            
                        }
                    }else{
                        data.append('foodtruck_'+key, this.truck[key]);
                    }
                }
                Pace.track(function(){
                that.progress = true;
                that.$dispatch('breadcrumbToggleProgress', {});
                that.$http.post('/api/admin/truck/'+that.truck.id, data)
                    .then(function(response) {
                        that.$dispatch('breadcrumbToggleProgress', {});
                        that.progress = false;
                        //that.$refs.currenttable.refresh();
                        //that.$refs.pendingtable.refresh();
                        $('body').pgNotification({
                            style: 'flip',
                            title: 'Sucesso!',
                            message: response.data.message,
                            position: "top-right",
                            timeout: 5000,
                            type: "success"
                        }).show();
                    })
                    .catch(function(response) {
                        that.$dispatch('breadcrumbToggleProgress', {});
                        that.progress = false;
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
                                message: 'Something went wrong. Please try again.',
                                position: "top-right",
                                timeout: 5000,
                                type: "danger"
                            }).show();
                        }
                    })
                    .bind(that);

                });
            }
        }
    }
</script>
