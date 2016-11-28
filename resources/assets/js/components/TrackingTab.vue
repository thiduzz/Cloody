<template>
    <div class="tab-pane fade no-padding" id="quickview-alerts">
        <div class="view-port clearfix" id="alerts">
            <div class="view bg-white">
                <div class="navbar navbar-default navbar-sm">
                    <div class="navbar-inner">
                        <div class="view-heading">
                            Notifications
                        </div>
                    </div>
                </div>
                <div data-init-list-view="ioslist" class="list-view boreded no-top-border">
                    <div class="list-view-group-container">
                        <div class="list-view-group-header text-uppercase">
                            Latest
                        </div>

                        <p v-if="error == true">
                            An error happened, try again clicking <a href="javascript:;" @click="loadPage('')">here</a>
                        </p>
                        <p v-if="tracks == undefined && error == false">
                            No activities were tracked
                        </p>
                        <div  v-if="tracks.data != undefined && error == false">
                            <ul v-if="tracks.data.length > 0">
                                <li class="alert-list" v-for="track in tracks.data">
                                    <a href="javascript:;" class="" data-navigate="view" data-view-port="#chat" data-view-animation="push-parrallax">
                                        <p class="col-xs-height col-middle">
                                            <span class="fs-10" v-bind:style="{color: track.icon_color}"><i class="fa fa-2x {{ track.icon_code }}"></i></span>
                                        </p>
                                        <p class="p-l-10 col-xs-height col-middle col-xs-9 overflow-ellipsis fs-12">
                                            <span class="text-master" v-text="track.translated"></span>
                                            <span style="display:block;font-size:10px;text-align:right;" class="text-master link" v-text="track.created_at | moment 'DD/MM/YYYY HH:mm'"></span>
                                        </p>
                                        <p class="p-r-10 col-xs-height col-middle fs-12 text-right">
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>

                            <div class="row" v-show="requesting == false" style="padding:30px;">
                                <div class="col-lg-6"><span class="link-style" v-if="tracks.prev_page_url != null" @click="loadPage('previous')"> <i class="fa fa-arrow-left"></i> </span> </div>
                                <div class="col-lg-6" style="text-align: right;"> <span class="link-style" v-if="tracks.next_page_url != null" @click="loadPage('next')"> <i class="fa fa-arrow-right"></i> </span> </div>
                            </div>
                            <div class="row"  v-show="requesting == true" style="padding:30px;">
                                <div class="col-lg-12" style="text-align: center"><i class="fa fa-cog fa-spin"></i>&nbsp;&nbsp;Loading...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>

</style>
<script>
    export default{
        props: ['type','subject'],
        data(){
            return{
                tracks: [],
                current_page: 0,
                requesting: false,
                error: false
            }
        },
        ready() {
            this.loadPage('');
        },
        methods: {
            loadPage(direction)
            {
                var that = this;
                this.requesting = true;
                this.error = false;
                this.$http.get(this.getCurrentUrl(direction))
                    .then(function(response) {

                        that.requesting = false;
                        that.tracks = null;
                        that.tracks = response.data.tracks;
                    })
                    .catch(function(response) {
                        that.requesting = false;
                        that.error = true;
                        console.log('Tracking-tab:'+response);

                    })
                    .bind(this);
            },
            getCurrentUrl(direction)
            {
                    var url = '';
                    if(direction == '')
                    {
                        if(this.subject != undefined)
                        {
                            url = '/api/tracking/'+this.type +'/'+this.subject;
                        }else{
                            url = '/api/tracking/'+this.type;
                        }
                    }else if(direction == 'previous')
                    {
                        url = this.tracks.prev_page_url;
                    }else if(direction == 'next')
                    {
                        url = this.tracks.next_page_url;
                    }
                    return url;
            }
        }
    }
</script>
