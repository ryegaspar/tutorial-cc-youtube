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

                        <div class="alert alert-danger" v-if="failed" role="alert">
                            Something went wrong. Please try again
                        </div>

                        <div id="video-form" v-if="uploading && !failed" class="mb-4">

                            <div class="alert alert-info" v-if="!uploadingComplete" role="alert">
                                Your video will be available at
                                <a :href=`${$root.url}/videos/${uid}` target="_blank">
                                    {{ $root.url }}/videos/{{ uid }}
                                </a>.
                            </div>

                            <div class="alert alert-succeess" v-if="uploadingComplete" role="alert">
                                Your upload is complete.  Your video is now processing.
                                <a href="#">Go to your video</a>
                            </div>

                            <div class="progress" v-if="!uploadingComplete">
                                <div class="progress-bar"
                                     role="progressbar"
                                     :style="{ width: fileProgress + '%' }"
                                     :aria-valuenow="fileProgress"
                                     aria-valuemin="0"
                                     aria-valuemax="100">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" v-model="title"/>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" v-model="description"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="visibility">Visibility</label>
                                <select class="form-control" v-model="visibility">
                                    <option value="private">Private</option>
                                    <option value="unlisted">Unlisted</option>
                                    <option value="public">Public</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <span class="form-text float-right">{{ saveStatus }}</span>
                                <button class="btn btn-primary" type="submit" @click.prevent="update">Save Changes
                                </button>
                            </div>
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
				visibility: 'private',
				saveStatus: null,
                fileProgress: 0,
			}
		},

		methods: {
			fileInputChange() {
				this.uploading = true;
				this.failed = false;

				var file = document.getElementById('video').files[0];
				this.file = file;

				this.store().then(() => {
					var form = new FormData();

					form.append('video', this.file);
					form.append('uid', this.uid);

					axios.post('/upload', form, {
						onUploadProgress: (e) => {
							if (e.lengthComputable) {
								this.updateProgress(e);
							}
						}
					}).then(() => {
						this.uploadingComplete = true;
                    }).catch(() => {
                    	this.failed = true;
                    });
				}).catch(() => {
					this.failed = true;
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
			},

			update() {
				this.saveStatus = 'Saving changes.';

				return axios.put(`/videos/${this.uid}`, {
					title: this.title,
					description: this.description,
					visibility: this.visibility
				}).then((response) => {
					this.saveStatus = 'Changes saved.';

					setTimeout(() => {
						this.saveStatus = null;
					}, 3000);
				}).catch(() => {
					this.saveStatus = 'Failed to save changes.';
				});
			},

            updateProgress(e) {
				e.percent = (e.loaded / e.total) * 100;
				this.fileProgress = e.percent;
            }
		}
	}
</script>
