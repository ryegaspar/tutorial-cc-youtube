#### setup ngrock
- to run ngrok `valet share`
- copy the link given, e.g. `http://5d912c11.ngrok.io`
- login to your account in [https://cloud.telestream.net](https://cloud.telestream.net), then go to notifications
- edit the settings, in the url, put e.g. `http://5d912c11.ngrok.io/webhook/encoding`

#### to update algolia indices
- run queue worker `php artisan queue:work`
- `php artisan scout:import "App\Models\Channel` and `php artisan scout:import "App\Models\Video"`



