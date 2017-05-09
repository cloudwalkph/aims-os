<template>
    <div>
        <div class="form-group">
            <div class="col-sm-12">
                        <textarea class="comments" id="discussionMessage" placeholder="Write a comment..."
                                  @input="discussionMessageChanged"
                                  :value="discussionMessage"
                                  style=" width: 100%; height: 200px; font-size: 14px;
                                  line-height: 18px; border: 1px solid #dddddd; padding: 10px" >
                        </textarea>
            </div>
            <div class="col-sm-12">
                <button class="btn btn-default pull-right"
                        @click="createDiscussion"
                        type="button">Post</button>
            </div>
        </div>

        <hr/>

        <discussion-item v-for="(discussion, index) in discussions"
                         :key="discussion.id"
                         :discussion="discussion"
                         :index="index">

        </discussion-item>
    </div>
</template>

<script>
    import discussionItems from './discussion-item.vue';

    Vue.component('discussion-item', discussionItems);

    export default {
        data() {
            return {
                discussionMessage: '',
                discussions: []
            }
        },
        mounted() {
            this.getDiscussions()
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
                }, error => {
                    console.log(error)
                });
            },
            createDiscussion(e) {
                $(e.target).prop('disabled', true);

                let jobOrderId = $('#jobOrderId').val();
                let data = {
                    message: this.discussionMessage
                };

                let url = `/api/v1/job-orders/${jobOrderId}/discussions`;
                this.$http.post(url, data).then(response => {
                    this.discussions.push(response.data);
                    this.discussions = this.sortByTime(this.discussions);

                    toastr.success('Successfully posted a message', 'Success');
                    $(e.target).prop('disabled', false);
                }, error => {
                    toastr.error('Failed in posting a message', 'Error');
                    console.log(error);
                    $(e.target).prop('disabled', false);
                })
            },
            sortByTime(discussions) {
                if (discussions.length > 1) {
                    let sorted = discussions.sort(
                        (a, b)  => {
                            let key1 = new Date('1970/01/01 ' + a.created_at);
                            let key2 = new Date('1970/01/01 ' + b.created_at);

                            if (key1 < key2) {
                                return -1;
                            } else if (key1 == key2) {
                                return 0;
                            } else {
                                return 1;
                            }
                        }
                    );

                    return sorted;
                } else {
                    return discussions;
                }
            }
        }
    }
</script>
