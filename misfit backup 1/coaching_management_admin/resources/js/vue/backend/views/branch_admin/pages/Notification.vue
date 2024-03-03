<template>
    <section class="p-5 custom_scroll" style="overflow-y: auto !important; height: calc(100vh - 100px);">
        <div class="row">
            <div class="col-xl-12 mb-4 col-lg-12 col-12">
                <!-- <div v-if="notification_status" class="alert alert-primary alert-dismissible fade show" role="alert">
                    You have <strong>{{ notification_count }}</strong> new notification.
                    <a href="" class="alert-link font-weight-bold"> View all notifications</a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div> -->
                <div class="card">
                    <h5 class="card-header">Notification</h5>
                    <div class="card-body">
                        <div class="row">
                            <!-- Notification Style -->
                            <div class="col-lg-12 col-12 p-2">
                                <!-- <div class="demo-inline-spacing"> -->
                                    <div class="list-group">
                                        <a v-for="(item, index) in get_auth_information.user_notification" :key="index" href="javascript:void(0);" class="list-group-item list-group-item-action d-flex justify-content-between notification_active">
                                            <div class="li-wrapper d-flex justify-content-start align-items-center">
                                                <div class="list-content">
                                                    <h6 class="mb-1">{{ item.notification.title }}</h6>
                                                    <small class="text-muted">{{ item.notification.description }}</small>
                                                </div>
                                            </div>
                                            
                                            <div class="table_actions">
                                                <div class="text-end">
                                                    <a href="#"><i class="fas fa-ellipsis-v"></i></a>
                                                </div>
                                                <ul>
                                                    <li>
                                                        <a href="javascript:void(0)" @click.prevent="update_single_notification(item.id)">
                                                            <i class="fas text-info fa-eye-slash"></i>
                                                            Mark unread
                                                        </a>
                                                        
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)" @click.prevent="delete_notification(item.notification.id)">
                                                            <i class="fas text-danger fa-trash"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                    
                                                </ul>
                                                <div class="d-block text-center">
                                                    <small>{{ new Date(item.notification.created_at).toDateString() }} {{ new Date(item.notification.created_at).toLocaleTimeString() }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <!-- </div> -->
                            </div>
                            <!--/ Notification Style -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {
      notification_status: false,
      notification_count: 0
    }
  },
  created: function() {
    this.update_user_notification_status();
    this.fetch_check_auth();
  },
  methods: {
    ...mapActions([
        `update_user_notification_status`,
        `update_single_notification`,
        `fetch_check_auth`,
        `delete_notification`
    ]),
  },
  computed: {
    ...mapGetters([
      `get_auth_information`
    ])
  },
  watch: {
    get_auth_information: {
        handler: function (newv, oldv) {
            if(newv.user_notification.length > 0) {
                newv.user_notification.forEach(element => {
                    if(element.seen == "0") {
                        this.notification_status = true;
                    }
                });
            }
        },
    }
  },
}
</script>
<style scoped>
.table_actions ul li a {
    color: #b4b7be;
    -webkit-transition-duration: 0.3s;
    -o-transition-duration: 0.3s;
    transition-duration: 0.3s;
    text-transform: capitalize;
    display: block;
    padding: 0.28rem 0.28rem;
}
</style>