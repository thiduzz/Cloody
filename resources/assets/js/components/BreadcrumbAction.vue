<template>
    <li class="pull-right upper-action" v-if="this.action == 'admin-edit-truck'">
        <button class="btn btn-sm btn-rounded btn-primary" @click="send"  v-bind:class="{ 'disabled': progress }">
                <span><i class="pg-save"></i>
                </span>
        </button>
    </li>
</template>

<script>
    export default {
        ready() {
            var that = this;
            this.$on('breadcrumbToggleProgress', function (param) {
                that.progress = !that.progress;
            });
        },
        props:['action'],
        data(){
            return {
                progress: false
            };
        },
        methods: {
            send() {
                switch(this.action)
                {
                    case 'admin-edit-truck':
                        this.$dispatch('breadcrumbSave', {});
                    break;
                }
            },
        }
    }
</script>
