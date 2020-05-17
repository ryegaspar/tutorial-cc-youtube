<template>
    <div>
        <p>{{ comments.length }} comments</p>

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

                    <div class="media" v-for="reply in comments.replies.data">
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
				comments: []
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
			}
		},
		mounted() {
			this.getComments();
		}
	}
</script>