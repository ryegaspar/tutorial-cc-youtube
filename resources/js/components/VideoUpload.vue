<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Upload</div>

                    <div class="card-body">
                        <input type="file"
                               name="video"
                               id="video"
                               @change="fileInputChange"
                               v-if="!uploading"
                        />

                        <div id="video-form" v-if="uploading && !failed">
                            Form
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	export default {

		data() {
			return {
				uid: null,
				uploading: false,
				uploadingComplete: false,
				failed: false,
				title: 'Untitled',
				description: null,
				visibility: 'private'
			}
		},

		methods: {
			fileInputChange() {
				this.uploading = true;
				this.failed = false;

				var file = document.getElementById('video').files[0];
				this.file = file;

				this.store().then(() => {
				})
			},

			store() {
				return axios.post('/videos', {
					title: this.title,
					description: this.description,
					visibility: this.visibility,
					extension: this.file.name.split('.').pop(),
				}).then((response) => {
					this.uid = response.data.uid;
                });
			}
		}
	}
</script>
