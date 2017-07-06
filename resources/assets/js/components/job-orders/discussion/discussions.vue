<template>
    <div>
        <div class="messages">
            <ul id="comments-list" class="comments-list">
                <li v-for="(discussion, index) in discussions" class="item">
                    <div class="comment-box">
                        <div class="comment-head">
                            <h6 class="comment-name">{{ discussion.user.profile.first_name }} {{ discussion.user.profile.last_name }}</h6>
                            <h6 class="comment-date">{{ discussion.created_at }}</h6>
                        </div>

                        <p class="comment-content">
                            {{ discussion.message }}
                        </p>

                    </div>
                </li>
                <div id="contentBottom"></div>
            </ul>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="comments form-control" id="discussionMessage"
                           @input="discussionMessageChanged"
                           :value="discussionMessage"
                           placeholder="What are you working on?">

                    <span class="input-group-btn">
                    <button class="btn btn-default btn-block"
                            href="#contentBottom"
                            @click="createDiscussion"
                            type="button"><i class="fa fa-send"></i></button>
                </span>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                discussionMessage: '',
                discussions: []
            }
        },
        mounted() {
            this.getDiscussions()

            this.listenForEcho();
        },
        methods: {
            resetForm() {
                this.user_id = ''
            },
            discussionMessageChanged(e) {
                this.discussionMessage = e.target.value;
            },
            getDiscussions() {
                let jobOrderId = $('#jobOrderId').val();

                // the department id of ae == 7
                this.$http.get(`/api/v1/job-orders/${jobOrderId}/discussions`).then(response => {
                    this.discussions = this.sortByTime(response.data);
                    this.scrollToEnd();
                }, error => {
                    console.log(error)
                })
            },
            createDiscussion(e) {
                $(e.target).prop('disabled', true);

                let jobOrderId = $('#jobOrderId').val();
                let data = {
                    message: this.discussionMessage
                };

                let url = `/api/v1/job-orders/${jobOrderId}/discussions`;
                this.$http.post(url, data).then(response => {
//                    this.discussions.push(response.data);
//                    this.discussions = this.sortByTime(this.discussions);

                    toastr.success('Successfully posted a message', 'Success');
                    $(e.target).prop('disabled', false);
                    this.scrollToEnd();
                }, error => {
                    toastr.error('Failed in posting a message', 'Error');
                    console.log(error);
                    $(e.target).prop('disabled', false);
                })
            },
            scrollToEnd: function() {
                var container = this.$el.querySelector(".messages");
                container.scrollTop = container.scrollHeight;
            },
            listenForEcho() {
                let notifSound = new Audio('/sounds/notification.mp3');
                let jobOrderId = $('#jobOrderId').val();

                Echo.channel(`jo.${jobOrderId}`)
                    .listen('NewDiscussion', (response) => {
                        notifSound.play();
                        console.log(response);
                        this.discussions.push(response);

                        setTimeout(() => {
                            this.scrollToEnd();
                        }, 4);
                    });

            },
            sortByTime(discussions) {
//                if (discussions.length > 1) {
//                    let sorted = discussions.sort(
//                        (a, b)  => {
//                            let key1 = new Date('1970/01/01 ' + a.created_at);
//                            let key2 = new Date('1970/01/01 ' + b.created_at);
//
//                            if (key1 < key2) {
//                                return -1;
//                            } else if (key1 == key2) {
//                                return 0;
//                            } else {
//                                return 1;
//                            }
//                        }
//                )
//                    return sorted;
//                } else {
//                    return discussions;
//                }
                return discussions;
            }
        }
    }
</script>
