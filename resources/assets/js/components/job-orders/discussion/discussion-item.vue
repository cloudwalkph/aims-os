<template>
    <div class="row">
        <div class="comments-container">
            <ul id="comments-list" class="comments-list">
                <li>
                    <div class="comment-main-level">
                        <div class="comment-box">
                            <div class="comment-head">
                                <h6 class="comment-name">{{ discussion.user.profile.first_name }} {{ discussion.user.profile.last_name }}</h6>
                                <h6 class="comment-date">{{ discussion.created_at }}</h6>
                            </div>

                            <p class="comment-content">
                                {{ discussion.message }}
                            </p>

                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {

        },
        props: ['discussion']
    }
</script>
