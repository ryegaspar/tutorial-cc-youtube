<template>
    <div v-if="subscribers != null">
        {{ this.subscribers }} subscribers &nbsp;
        <button class="btn btn-sm btn-info"
                type="button"
                v-if="canSubscribe"
                @click.prevent="handle"
        >
            {{ userSubscribed ? 'Unsubscribe' : 'Subscribe'}}
        </button>
    </div>
</template>
<script>
	export default {
		data() {
			return {
				subscribers: null,
				userSubscribed: false,
				canSubscribe: false,
			}
		},

		props: {
			channelSlug: null
		},

		methods: {
			getSubscriptionStatus() {
				axios.get(`/subscription/${this.channelSlug}`)
					.then((response) => {
						this.subscribers = response.data.data.count;
						this.userSubscribed = response.data.data.user_subscribed;
						this.canSubscribe = response.data.data.can_subscribe;
					})
			},

            subscribe() {
				this.userSubscribed = true;
				this.subscribers++;

				axios.post(`/subscription/${this.channelSlug}`);
            },

            unsubscribe() {
				this.userSubscribed = false;
				this.subscribers--;

				axios.delete(`/subscription/${this.channelSlug}`);
            },

            handle() {
				if (this.userSubscribed) {
					this.unsubscribe();
                } else {
					this.subscribe();
                }
            }
		},

		mounted() {
			this.getSubscriptionStatus();
		}
	}
</script>