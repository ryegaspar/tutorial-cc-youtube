<template>
    <div class="video__voting">
        <a href="#"
           class="video__voting-button"
           :class="{'video__voting-button--voted': userVote === 'up'}"
           @click.prevent="vote('up')"
        >
            <span class="fas fa-thumbs-up"></span>
        </a> {{ up }} &nbsp;

        <a href="#"
           class="video__voting-button"
           :class="{'video__voting-button--voted': userVote === 'down'}"
           @click.prevent="vote('down')"
        >
            <span class="fas fa-thumbs-down"></span>
        </a> {{ down }}
    </div>
</template>

<script>
	export default {
		data() {
			return {
				up: null,
				down: null,
				userVote: null,
				canVote: false,
			}
		},

		props: {
			videoUid: null,
		},

		methods: {
			getVotes() {
				axios.get(`/videos/${this.videoUid}/votes`)
					.then((response) => {
						this.up = response.data.data.up
						this.down = response.data.data.down
						this.userVote = response.data.data.user_vote
						this.canVote = response.data.data.can_vote
					});
			},

            vote(type) {
				if (this.userVote == type) {
					this[type]--;
					this.userVote = null;
					this.deleteVote(type);
					return;
                }

				if (this.userVote) {
					this[type == 'up' ? 'down' : 'up']--;
                }

				this[type]++;
				this.userVote = type;

				this.createVote(type);
            },

            deleteVote(type) {
				axios.delete(`/videos/${this.videoUid}/votes`)
			},

			createVote(type) {
				axios.post(`/videos/${this.videoUid}/votes`, {
					type: type
                })
			}
		},

		mounted() {
			this.getVotes()
		}
	}
</script>