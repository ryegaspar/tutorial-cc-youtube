<template>
    <div>
        <p>{{ comments.length }} comments</p>

        <div class="video-comment clearfix" v-if="$root.user.authenticated">
            <textarea placeholder="Say something" class="form-control video-comment__input" v-model="body"></textarea>

            <div class="float-right">
                <button type="submit" class="btn btn-info" @click="createComment">Post</button>
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

                    <div class="media" v-for="reply in comment.replies.data">
                        <div class="media-left">
                            <a :href="`/channel/${reply.channel.data.slug}`">
                                <img :src="reply.channel.data.image"
                                     :alt="`${reply.channel.data.name} image`"
                                     class="media-object">
                            </a>
                        </div>
                        <div class="media-body pl-3">
                            <a :href="`/channel/${comment.channel.data.slug}`">{{ comment.channel.data.name }}</a> {{
                            comment.created_at_human }}
                            <p>{{ comment.body }}</p>
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
				body: null
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
			}
		},
		mounted() {
			this.getComments();
		}
	}
</script>