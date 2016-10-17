<style scoped>
    .action-link {
        cursor: pointer;
    }

    .m-b-none {
        margin-bottom: 0;
    }
</style>

<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span>
                        Waiting Approval Trucks
                    </span>
                </div>
            </div>

            <div class="panel-body">
                <div id="pending_trucks">
                    <v-server-table url="/api/admin-pending-trucks" :columns="trucks_pending_columns" :options="trucks_pending_options"  v-ref:pendingtable></v-server-table>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span>
                        Current Trucks
                    </span>
                </div>
            </div>

            <div class="panel-body">
                <div id="pending_trucks">
                    <v-server-table url="/api/admin-current-trucks" :columns="trucks_current_columns" :options="trucks_current_options" v-ref:currenttable></v-server-table>
                </div>
            </div>
        </div>
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

                export_filter:{
                  end:moment().format('YYYY-MM-DD'),
                  start:moment().subtract(1, 'months').format('YYYY-MM-DD')
                },
                trucks_pending_columns: ['id','name','type','users', 'created_at'],
                trucks_pending_options: {
                    perPage: 5,
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
                        actions: "<div class='btn-group'><a @click='$parent.truckApproval({id},\"approve\")' class='btn btn-success'>"+
                        "<i class='fa fa-check' data-toggle='tooltip' data-original-title='Approve'></i>"+
                        "</a><a href='#' @click='$parent.truckApproval({id},\"deny\")' class='btn btn-danger'>"+
                        "<i data-toggle='tooltip' data-original-title='Deny' class='fa fa-ban'></i></a></div>"
                    },
                    customFilters: [{
                        name: 'alphabet',
                        callback: function(row, query) {
                            return row.name[0] == query;
                        }
                    }]
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
                        actions: "<div class='btn-group'><a href='/appointments/{id}/edit'  class='btn btn-success'>"+
                        "<i class='fa fa-edit' data-toggle='tooltip' data-original-title='Edit'></i>"+
                        "</a><a href='#' @click='$parent.deleteMe({id})' class='btn btn-success'>"+
                        "<i data-toggle='tooltip' data-original-title='Cancel' class='fa fa-trash-o'></i></a></div>"
                    },
                    customFilters: [{
                        name: 'alphabet',
                        callback: function(row, query) {
                            return row.name[0] == query;
                        }
                    }]
                },
                new_truck: {
                    errors: [],
                    name:'',
                    service_type: null,
                    identification: '',
                    phone: '',
                    address: '',
                    formal_name: '',
                    avatar_name: '',
                    avatar: '',
                    lets_negotiate: false,
                    delivery_bike: false,
                    delivery_motorcycle: false
                },

                selected_truck: null
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

            showEditTruckForm(truck) {
                this.selected_truck = truck;
                $('#modal-edit-client').modal('show');
            },

            showCreateTruckForm() {
                $('#modal-create-client').modal('show');
            },

            truckApproval(id,type){
                var that = this;
                if(type == 'approve')
                {
                        this.patch(id,type,'') ;      
                }else  if(type == 'deny'){
                    swal({
                        title: "Why?",
                        text: 'Write the user a reason (blank for default message):',
                        input: 'textarea',
                        showCancelButton: true,
                        closeOnConfirm: true,
                        animation: "slide-from-top",
                        timer: null,
                    }).then(function(result) {
                        that.patch(id,type,message) ;
                    });
                }
            },

            patch(id,type, user_message)
            {

                var that = this;
                this.$http.post('/api/truck-approval', {truck_id:id,type:type,message:user_message})
                    .then(function(response) {
                        that.$refs.currenttable.refresh();
                        that.$refs.pendingtable.refresh();
                        $('body').pgNotification({
                            style: 'circle',
                            title: 'Sucesso!',
                            message: response.data.message,
                            position: "top-right",
                            timeout: 5000,
                            type: "success"
                        }).show();
                    })
                    .catch(function(response) {
                        if (typeof response.data === 'object') {
                            var errors = _.flatten(_.toArray(response.data));
                            $(errors).each(function( index, error ) {
                                $('body').pgNotification({
                                    style: 'circle',
                                    title: 'Error!',
                                    message: error,
                                    position: "top-right",
                                    timeout: 5000,
                                    type: "danger"
                                }).show();
                            });
                        } else {
                            $('body').pgNotification({
                                style: 'circle',
                                title: 'Error!',
                                message: 'Something went wrong. Please try again.',
                                position: "top-right",
                                timeout: 5000,
                                type: "danger"
                            }).show();
                        }
                    });
            },
            /**
             * Create a new OAuth client for the user.
             */
            store() {
                this.persistClient(
                    'post', '/oauth/clients',
                    this.createForm, '#modal-create-client'
                );
            },

            /**
             * Edit the given client.
             */
            edit(client) {
                this.editForm.id = client.id;
                this.editForm.name = client.name;
                this.editForm.redirect = client.redirect;

                $('#modal-edit-client').modal('show');
            },

            /**
             * Update the client being edited.
             */
            update() {
                this.persistClient(
                    'put', '/oauth/clients/' + this.editForm.id,
                    this.editForm, '#modal-edit-client'
                );
            },

            /**
             * Persist the client to storage using the given form.
             */
            persistClient(method, uri, form, modal) {
                form.errors = [];

                this.$http[method](uri, form)
                    .then(response => {
                        this.getClients();

                        form.name = '';
                        form.redirect = '';
                        form.errors = [];

                        $(modal).modal('hide');
                    })
                    .catch(response => {
                        if (typeof response.data === 'object') {
                            form.errors = _.flatten(_.toArray(response.data));
                        } else {
                            form.errors = ['Something went wrong. Please try again.'];
                        }
                    });
            },

            /**
             * Destroy the given client.
             */
            destroy(client) {
                this.$http.delete('/oauth/clients/' + client.id)
                        .then(response => {
                            this.getClients();
                        });
            }
        }
    }
</script>
