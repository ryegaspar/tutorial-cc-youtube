<template>
    <div>
        <p>{{ comments.length }} comments</p>

        <div class="video-comment clearfix" v-if="$root.user.authenticated">
            <textarea placeholder="Say something" class="form-control video-comment__input" v-model="body"></textarea>

            <div class="float-right">
                <button type="submit" class="btn btn-info" @click.prevent="createComment">Post</button>
            </div>
        </div>

        <ul class="card-body">
            <li class="media" v-for="comment in comments">
                <div class="media-left">
                    <a :href="`/channel/${comment.channel.data.slug}`">
                        <img :src="comment.channel.data.image"
                             :alt="`${comment.channel.data.name} image`"
                             class="media-object">
                    </a>
                </div>
                <div class="media-body pl-3">
                    <a :href="`/channel/${comment.channel.data.slug}`">{{ comment.channel.data.name }}</a> {{
                    comment.created_at_human }}
                    <p>{{ comment.body }}</p>

                    <ul class="list-inline">
                        <li class="list-inline-item" v-if="$root.user.authenticated">
                            <a href="#" @click.prevent="toggleReplyForm(comment.id)">{{ replyFormVisible === comment.id
                                ? 'Cancel' : 'Reply'}}</a>
                        </li>
                    </ul>

                    <div class="video-comment clear" v-if="replyFormVisible === comment.id">
                        <textarea class="form-control video-comment__input" v-model="replyBody"></textarea>
                        <div class="float-right">
                            <button type="submit" class="btn btn-info" @click.prevent="createReply(comment.id)">Reply
                            </button>
                        </div>
                    </div>

                    <div class="media" v-for="reply in comment.replies.data">
                        <div class="media-left">
                            <a :href="`/channel/${reply.channel.data.slug}`">
                                <img :src="reply.channel.data.image"
                                     :alt="`${reply.channel.data.name} image`"
                                     class="media-object">
                            </a>
                        </div>
                        <div class="media-body pl-3">
                            <a :href="`/channel/${reply.channel.data.slug}`">{{ reply.channel.data.name }}</a> {{
                            comment.created_at_human }}
                            <p>{{ reply.body }}</p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>
<script>
	export default {
		data() {
			return {
				comments: [],
				body: null,
				replyBody: null,
				replyFormVisible: null
			}
		},
		props: {
			videoUid: null,
		},
		methods: {
			getComments() {
				axios.get(`/videos/${this.videoUid}/comments`)
					.then((response) => {
						this.comments = response.data.data;
					})
			},

			createComment() {
				axios.post(`/videos/${this.videoUid}/comments`, {
					body: this.body
				}).then((response) => {
					this.comments.unshift(response.data.data);
					this.body = null;
				})
			},

			createReply(commentId) {
				axios.post(`/videos/${this.videoUid}/comments`, {
					body: this.replyBody,
					reply_id: commentId.id.toString()
				}).then((response) => {
					this.comments.map((comment, index) => {
						if (comment.id === commentId) {
							this.comments[index].replies.data.push(response.data.data)
                        }
					});

					this.replyBody = null;
					this.replyFormVisible = null;
				});
			},

			toggleReplyForm(commentId) {
				this.replyBody = null;

				if (this.replyFormVisible === commentId) {
					this.replyFormVisible = null
					return;
				}

				this.replyFormVisible = commentId;
			}
		},
		mounted() {
			this.getComments();
		}
	}
</script>