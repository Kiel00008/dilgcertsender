# Certificate Sender Route Fix - TODO

## Steps:
- [x] Step 1: Edit resources/views/welcome.blade.php - Fix single send route('certificate.send') → route('certificates.send')
- [x] Step 2: Edit resources/views/welcome.blade.php - Fix bulk route('certificate.bulk') → route('certificates.bulk')
- [x] Step 3: Edit routes/web.php - Add POST /bulk route named 'certificates.bulk' pointing to CertificateController@send (reuse existing logic)
- [x] Step 4: Clear caches - php artisan route:clear & php artisan config:clear & php artisan view:clear (Windows cmd)
- [x] Step 5: Test application - Single send and bulk upload
- [ ] Complete: attempt_completion
